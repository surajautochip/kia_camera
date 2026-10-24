
		ping_interval = 10
        timeout_duration = 30

        start_time = new Date();
		session_id = null
		last_ping_time = start_time

        server_ip = ""
        token = ""
        token_status = ""
			
        $(document).ready(function () {

            if ($('#odoo_server_ip').length && $('#odoo_server_ip').val()) {
                server_ip = $('#odoo_server_ip').val().trim();
            } else if ($('#ip').val()) {
                var host = $('#ip').val().split(":")[0];
                if (host === "localhost" || host === "127.0.0.1") {
                    server_ip = host + ":8069";
                } else {
                    server_ip = host + ":8079";
                }
            } else {
                server_ip = "192.168.101.111:8079";
            }
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
                "db": "kia_test",
                "user": "kia@gmail.com",
                "password": "kia",
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
                "db": "kia_test",
                "user": "kia@gmail.com",
                "password": "kia",
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
            
            if (action === 'hold') {
                $("#pause_all").trigger("click", ["backend"]);
            } else if (action === 'live') {
                $("#play_all").trigger("click", ["backend"]);
            } else if (action === 'completed') {
                $("#stop_all").trigger("click", ["backend"]);
            }
        }

