const express = require('express');
const { spawn } = require('child_process');
const fs = require('fs');
const path = require('path');
const cors = require('cors');

const app = express();
app.use(cors());

// The PHP app is in C:\Users\saiki\Downloads\camera\camera
const streamsBaseDir = path.join(__dirname, '..', 'streams');

// Keep track of running ffmpeg processes
const activeStreams = {};

app.get('/start', (req, res) => {
    // Extract BAY along with dirPath
    const { path: dirPath, BAY, name, RTSP_URL } = req.query;
    if (!dirPath || !BAY || !name || !RTSP_URL) {
        return res.status(400).send("Missing required query parameters");
    }
    // Include BAY in the directory path
    const streamDir = path.join(streamsBaseDir, dirPath, BAY);
    const m3u8Path = path.join(streamDir, `${name}.m3u8`);
    // Create the directory if it doesn't exist
    if (!fs.existsSync(streamDir)) {
        fs.mkdirSync(streamDir, { recursive: true });
    }
    // Stop existing stream if running for the same path
    if (activeStreams[m3u8Path]) {
        console.log(`Stopping existing stream for ${m3u8Path}`);
        activeStreams[m3u8Path].kill('SIGKILL');
    }

    console.log(`Starting FFmpeg stream:`);
    console.log(`RTSP_URL: ${RTSP_URL}`);
    console.log(`Output: ${m3u8Path}`);

    // Run FFmpeg to convert RTSP to HLS
    const ffmpegArgs = [
        '-rtsp_transport', 'tcp',
        '-i', RTSP_URL,
        '-c:v', 'libx264',
        '-preset', 'ultrafast',
        '-tune', 'zerolatency',
        '-c:a', 'aac',
        '-f', 'hls',
        '-hls_time', '4',
        '-hls_list_size', '5',
        '-hls_flags', 'delete_segments',
        '-hls_segment_filename', path.join(streamDir, `${name}_%03d.ts`),
        m3u8Path
    ];

    const ffmpegProcess = spawn('ffmpeg', ffmpegArgs);

    ffmpegProcess.stderr.on('data', (data) => {
        // console.log(`ffmpeg: ${data}`); // Optional: uncomment to see ffmpeg logs
    });

    ffmpegProcess.on('close', (code) => {
        console.log(`ffmpeg process exited with code ${code}`);
        delete activeStreams[m3u8Path];
    });

    activeStreams[m3u8Path] = ffmpegProcess;

    // Send the PID back as the response text (Odoo expects the PID integer)
    res.send(ffmpegProcess.pid.toString());
});


app.get('/stop', (req, res) => {
    const pid = req.query.pid;
    if (!pid) {
        return res.status(400).send("Missing pid");
    }
    try {
        console.log("Stopping FFmpeg process with PID: " + pid);
        process.kill(parseInt(pid), 'SIGKILL');
        res.send({"status": true, "message": "Stopped process"});
    } catch (e) {
        console.error("Failed to kill process " + pid + ":", e);
        res.status(500).send({"status": false, "message": "Failed to kill process"});
    }
});
// Serve the generated stream files to the PHP frontend
app.use('/streams', express.static(streamsBaseDir));

const PORT = 8088;
app.listen(PORT, () => {
    console.log(`NodeJS Streaming Proxy is running on port ${PORT}`);
    console.log(`Configure Odoo 'Server Location' as 'localhost:${PORT}'`);
});






