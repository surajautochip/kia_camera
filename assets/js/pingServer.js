
		ping_interval = 10
        timeout_duration = 30

        start_time = new Date();
		session_id = null
		last_ping_time = start_time

        server_ip = ""
        token = ""
        token_status = ""
			
        $(document).ready(function () {

            var is_local = (window.location.hostname === "localhost" || window.location.hostname === "127.0.0.1");

            if (is_local) {
                server_ip = window.location.hostname + ":8069";
            } else if ($('#odoo_server_ip').length && $('#odoo_server_ip').val()) {
                server_ip = $('#odoo_server_ip').val().trim();
            } else if ($('#ip').val()) {
                var host = $('#ip').val().split(":")[0];
                server_ip = host + ":8079";
            } else {
                server_ip = "192.168.101.111:8079";
            }

            odoo_db = ($('#odoo_db').length && $('#odoo_db').val()) ? $('#odoo_db').val().trim() : (is_local ? "kia_test" : "kia_ars");
            odoo_user = ($('#odoo_user').length && $('#odoo_user').val()) ? $('#odoo_user').val().trim() : (is_local ? "kia@gmail.com" : "admin");
            odoo_pass = ($('#odoo_password').length && $('#odoo_password').val()) ? $('#odoo_password').val().trim() : (is_local ? "kia" : "admin");

            token = $('#token').val();
            token_status = $('#token_status').val();

            console.log("Server IP:" + server_ip)

                if(token_status != "1") return

			     getSessionId()
			
				setInterval(function() {
					if (session_id == null) {
						getSessionId()
					} else {
						sendPingRequest()
					}

				}, ping_interval * 1000);			//Interval of last_time Update
						
			})


        function getSessionId() {

            console.log(timeFormat(start_time))

            payload = {
                "db": odoo_db,
                "user": odoo_user,
                "password": odoo_pass,
                "token": token,
                "start_time": timeFormat(start_time)
            }
            $.ajax({
                type: 'POST',
                url: 'http://' + server_ip + '/api/no_view_receive',
                data: JSON.stringify(payload),
                success: function(data) { session_id = data.result.session_id; handleBackendAction(data.result.action); },
                contentType: "application/json",
                dataType: 'json'
            });

        }

        function sendPingRequest() {

            if (document.hidden) {
                // console.log("Document hidden")
                return
            }
            current_ping_time = new Date()
			// console.log(current_ping_time - last_ping_time)
            if (((current_ping_time - last_ping_time) / 1000) > timeout_duration) { //30 Secods of inactivity start a new session
                start_time = new Date()
                last_ping_time = start_time
                getSessionId()
                return
            }
			
			last_ping_time = current_ping_time
            payload = {
                "db": odoo_db,
                "user": odoo_user,
                "password": odoo_pass,
                "token": token,
                "session_id": session_id,
                "start_time": timeFormat(start_time),
                "end_time": timeFormat(current_ping_time)
            }
            $.ajax({
                type: 'POST',
                url: 'http://' + server_ip + '/api/no_view_receive',
                data: JSON.stringify(payload),
                success: function(data) { handleBackendAction(data.result.action); },
                contentType: "application/json",
                dataType: 'json'
            });
        }

        function timeFormat(input_time) {
            if (input_time == null) input_time = new Date();
            var date = input_time.getFullYear() + '-' + (input_time.getMonth() + 1) + '-' + input_time.getDate();
            var time = input_time.getHours() + ":" + input_time.getMinutes() + ":" + input_time.getSeconds();
            return dateTime = date + ' ' + time;
        }







        window.backend_action_state = null;
        function handleBackendAction(action) {
            if (!action || action === window.backend_action_state) return;
            window.backend_action_state = action;
            
            var video1 = document.getElementById('stream1');
            var video2 = document.getElementById('stream2');
            
            if (action === 'hold') {
                if (video1) video1.pause();
                if (video2) video2.pause();
                $("#pause_all").hide();
                $("#play_all").show();
            } else if (action === 'live') {
                if (video1) { video1.muted = true; video1.play(); }
                if (video2) { video2.muted = true; video2.play(); }
                $("#play_all").hide();
                $("#pause_all").show();
            } else if (action === 'completed') {
                $("#stop_all").trigger("click", ["backend"]);
            }
        }

