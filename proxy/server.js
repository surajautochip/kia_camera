const express = require('express');
const { spawn } = require('child_process');
const fs = require('fs');
const path = require('path');
const cors = require('cors');

const app = express();
app.use(cors());

// The PHP app is in C:\Users\saiki\Downloads\camera\camera
const streamsBaseDir = path.join(__dirname, '..', 'streams');

// Keep track of running stream sessions:
// activeStreams: m3u8Path -> session object
const activeStreams = {};
// streamsByPid: pid -> session object (supports original PID and restarted PIDs)
const streamsByPid = {};

/**
 * Spawns an FFmpeg process for the given stream session.
 * Includes auto-reconnect watchdog, socket timeout protection, and playlist continuity.
 */
function launchFFmpeg(session, isRestart = false) {
    if (session.isStopped) {
        return;
    }

    const ffmpegArgs = [
        '-fflags', '+nobuffer+genpts+discardcorrupt',
        '-rtsp_transport', 'tcp',
        '-timeout', '5000000', // 5 seconds socket I/O timeout (in microseconds)
        '-i', session.rtspUrl,
        '-c:v', 'libx264',
        '-preset', 'ultrafast',
        '-tune', 'zerolatency',
        '-c:a', 'aac',
        '-f', 'hls',
        '-hls_time', '4',
        '-hls_list_size', '10', // 10 segments buffer window
        '-hls_flags', 'delete_segments+append_list+omit_endlist',
        '-hls_segment_filename', session.segmentPattern,
        session.m3u8Path
    ];

    const proc = spawn('ffmpeg', ffmpegArgs);
    session.currentProcess = proc;
    session.processStartTime = Date.now();

    if (proc.pid) {
        session.pids.add(proc.pid);
        session.pids.add(proc.pid + 1); // Accommodate Odoo's +1 offset
        streamsByPid[proc.pid] = session;
        streamsByPid[proc.pid + 1] = session;
    }

    proc.stderr.on('data', (data) => {
        // Optional debug logging
    });

    proc.on('close', (code, signal) => {
        console.log(`FFmpeg process for ${session.name} (PID: ${proc.pid}) exited with code ${code}${signal ? ', signal: ' + signal : ''}`);

        // If stopped intentionally, clean up and do not restart
        if (session.isStopped) {
            console.log(`Stream ${session.name} stopped intentionally. Watchdog will not restart.`);
            delete activeStreams[session.m3u8Path];
            if (session.pids) {
                session.pids.forEach((p) => delete streamsByPid[p]);
            }
            return;
        }

        // Camera or network dropped: trigger watchdog auto-reconnect
        const lifetimeMs = Date.now() - session.processStartTime;
        if (lifetimeMs > 10000) {
            // Ran for more than 10 seconds before dropping, reset quick failure counter
            session.consecutiveQuickFailures = 0;
        } else {
            session.consecutiveQuickFailures++;
        }

        // Delay before reconnecting: 1s normally, or 3s if failing repeatedly
        const reconnectDelay = session.consecutiveQuickFailures > 5 ? 3000 : 1000;
        session.restartCount++;

        console.log(`[WATCHDOG] Camera stream ${session.name} disconnected. Reconnecting in ${reconnectDelay / 1000}s (reconnect #${session.restartCount})...`);

        clearTimeout(session.restartTimer);
        session.restartTimer = setTimeout(() => {
            if (!session.isStopped) {
                console.log(`[WATCHDOG] Resuming FFmpeg stream: ${session.name}`);
                launchFFmpeg(session, true);
            }
        }, reconnectDelay);
    });

    proc.on('error', (err) => {
        console.error(`FFmpeg process error for ${session.name}:`, err.message);
    });
}

/**
 * Stop and clean up an active stream session
 */
function terminateSession(session) {
    if (!session) return;
    session.isStopped = true;
    clearTimeout(session.restartTimer);

    if (session.currentProcess) {
        try {
            console.log(`Terminating FFmpeg process PID: ${session.currentProcess.pid}`);
            session.currentProcess.kill('SIGKILL');
        } catch (e) {
            console.error(`Failed to kill process PID ${session.currentProcess.pid}:`, e.message);
        }
    }

    delete activeStreams[session.m3u8Path];
    if (session.pids) {
        session.pids.forEach((p) => delete streamsByPid[p]);
    }
}

app.get('/start', (req, res) => {
    const { path: dirPath, BAY, name, RTSP_URL } = req.query;

    if (!dirPath || !BAY || !name || !RTSP_URL) {
        return res.status(400).send("Missing required query parameters");
    }

    const streamDir = path.join(streamsBaseDir, dirPath, BAY);
    const m3u8Path = path.join(streamDir, `${name}.m3u8`);

    // Create the directory if it doesn't exist
    if (!fs.existsSync(streamDir)) {
        fs.mkdirSync(streamDir, { recursive: true });
    }

    // Stop existing stream if running for the same path
    if (activeStreams[m3u8Path]) {
        console.log(`Stopping existing stream for ${m3u8Path}`);
        terminateSession(activeStreams[m3u8Path]);
    }

    // Clean up old playlist and segments for fresh start
    try {
        if (fs.existsSync(m3u8Path)) {
            fs.unlinkSync(m3u8Path);
        }
        const files = fs.readdirSync(streamDir);
        for (const file of files) {
            if (file.startsWith(`${name}_`) && file.endsWith('.ts')) {
                fs.unlinkSync(path.join(streamDir, file));
            }
        }
    } catch (err) {
        console.warn(`Could not clean old segments in ${streamDir}:`, err.message);
    }

    console.log(`Starting FFmpeg stream:`);
    console.log(`RTSP_URL: ${RTSP_URL}`);
    console.log(`Output: ${m3u8Path}`);

    const session = {
        name: name,
        streamDir: streamDir,
        m3u8Path: m3u8Path,
        segmentPattern: path.join(streamDir, `${name}_%03d.ts`),
        rtspUrl: RTSP_URL,
        currentProcess: null,
        pids: new Set(),
        isStopped: false,
        restartTimer: null,
        restartCount: 0,
        consecutiveQuickFailures: 0,
        processStartTime: 0
    };

    activeStreams[m3u8Path] = session;

    launchFFmpeg(session, false);

    // Send the initial PID back to Odoo (Odoo expects the PID integer as text)
    const returnedPid = session.currentProcess && session.currentProcess.pid ? session.currentProcess.pid : 0;
    res.send(returnedPid.toString());
});


app.get('/stop', (req, res) => {
    const pidStr = req.query.pid;
    if (!pidStr) {
        return res.status(400).send("Missing pid");
    }

    const pid = parseInt(pidStr, 10);
    console.log("Stopping FFmpeg process requested for PID: " + pid);

    let session = streamsByPid[pid];

    // Fallback: check all active streams if this pid was in its pids set
    if (!session) {
        for (const key in activeStreams) {
            const s = activeStreams[key];
            if (s.pids && (s.pids.has(pid) || s.pids.has(pid - 1) || s.pids.has(pid + 1))) {
                session = s;
                break;
            }
        }
    }

    if (session) {
        terminateSession(session);
    }

    // Attempt direct process.kill as well for safety
    try {
        process.kill(pid, 'SIGKILL');
    } catch (e) {
        // Expected if process already terminated
    }

    res.send({ status: true, message: "Stopped process" });
});

// Serve the generated stream files to the PHP frontend with no-cache headers for .m3u8 playlists
app.use('/streams', express.static(streamsBaseDir, {
    setHeaders: (res, filePath) => {
        if (filePath.endsWith('.m3u8')) {
            res.setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
            res.setHeader('Pragma', 'no-cache');
            res.setHeader('Expires', '0');
        }
    }
}));

const PORT = 8088;
app.listen(PORT, () => {
    console.log(`NodeJS Streaming Proxy is running on port ${PORT}`);
    console.log(`Configure Odoo 'Server Location' as 'localhost:${PORT}'`);
});






