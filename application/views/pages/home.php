<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title><?php echo $title?></title>
    <?php
        $this->load->view('includes/assets');
    ?>
    <style type="text/css">
    .modal-dialog {
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
    }


    .btn_container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .button-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 200px;
        padding: 10px;
        background-color: #f1f1f1;
        border-radius: 5px;
    }

    .button-box i {
        font-size: 24px;
        cursor: pointer;
    }
    </style>
</head>

<body class="home-banner">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <?php
        $this->load->view('includes/menu');
        $this->load->view('pages/modal');
    ?>

    <?php  
        if (!empty($error)) {
    ?>
    <link href="http://<?=$dealer['web_server_ip']?>/assets/css/rating.css" rel="stylesheet"> 
    
    
    <input type="hidden" name="token_status" id="token_status" value="0">
    <section id="portfolio">
        <div class="container">   

        
            <div class="row" style="margin-top:20px;"> 

            <div class="alert alert-success" id="success-msg" style="display:none" role="alert">
  <h4 class="alert-heading alert-dismissible fade show">Thank you!</h4>
  <p>Thank you, you successfully updated the feedback.</p>
 <!--<hr>
   <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
  <button type="button" id="alert-close" style="display:none" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
              
                <div class="col-lg-12 text-center">
                    <h2 style="width:100%;margin-top: 20px !important;color:#000;font-weight: bold;">
                        <MARQUEE>Live Streaming Completed!</MARQUEE>
                    </h2>

                    <div class="col-lg-12" id="rating-div" style="text-align: center;display:none">
                
                            
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text"></label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text"></label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text"></label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text"></label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text"></label>

                </div><br/> 
                <!-- <input type="text" id="feedback" name="feedback" placeholder="Enter your comment here"/><br/> -->
                <textarea style="padding:5px" rows="4" cols="35" id="feedback" name="feedback" class="form-control feedback" placeholder="Enter your comment here(Maximum 50 characters)" maxlength="50"></textarea><br/>
                <button style="margin-top:5px;margin-bottom:10px;" type="button" name="submit_feedback" id="submit_feedback">Submit</button>
                
            </div>
                <div class="row row-0-gutter image-container" style="margin-bottom: 30px;text-decoration:none">
                    <p class="image-disply page-scroll noHover" href="#page-top"><img
                            src="http://<?=$dealer['web_server_ip']?>/assets/images/logo.jpeg"
                            alt="AutoChip logo" class="change">
                        <h2 style="margin-top: 100px !important;color: #000;font-weight: bold;">
                            <MARQUEE>Live Streaming Completed!</MARQUEE>
                        </h2> 
                    </p>
                    <p><?=$error?></p>
                </div>
            </div>
        </div>
        </div>

    </section>
    <?php } else {?>
        <div id="alert-box" class="alert alert-secondary alert-dismissible" style="display:none;">
            <a href="#" style="float:right;text-decoration:none;color:#05141f" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span id="msg" style="text-transform: capitalize;"><strong>Success!</strong> Indicates a successful or positive action.</span>
        </div>
    <input type="hidden" name="last_status" id="last_status" value="">
    <input type="hidden" name="token_status" id="token_status" value="1">
    <section  id="portfolio" style="padding:0 !important;">
        	

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title" style="margin-top:45px;padding:20px 0 20px 0 !important;">
                        <h2 class="welcome-heading" style="font-size:25px; padding:0 !important;">Welcome to<br/> <span style="font-weight: 500;"><?php echo $dealer['name'];  ?></span><br/>
                            Live Streaming</h2>
                        <!-- <p>Your vehicle is safe with us, we care your car as you do. Please see the live video of your car.</p> -->
                    </div>
                </div>
            </div>

            <div>
                <div class="btn_container" class="button-box">
                    <button type="button" id="play_all">
                        <i class="fa fa-play-circle" style="pointer-events:none" aria-hidden="true"></i>
                    </button>
                    <button type="button" id="pause_all">
                        <i class="fas fa-pause-circle" style="pointer-events:none" aria-hidden="true"></i>
                    </button>
                    <button type="button" id="stop_all">
                        <i class="fas fa-stop-circle" style="pointer-events:none" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div class="row row-0-gutter">
                <!-- start portfolio item -->

                <?php for($i = 1; $i <= $total_camera; $i++) {?>
                <div class="col-md-<?=$split_cnt?> col-0-gutter text-center">
                    <span>Camera <?=$i?></span>
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba" style="background:#fff">
                            <video autoplay controls playsinline id="stream<?=$i?>" muted="muted" style="width: 98%; aspect-ratio: 16/9; object-fit: contain; background: #000;">
                            </video>
                        </figure>
                    </div>
                </div>
                <?php }    ?>
                <!-- end portfolio item -->
            </div>

            <div style="width:90%;margin-left:auto;margin-right:auto;">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Status</button>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Parts View</button>
                    </li> -->
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="tab-pane" id="overview">
                            <div style="width: 100%;margin-top:20px;margin-left:auto;margin-right:auto;background-color:#fff;border-color: rgba(0, 0, 0, 0.5);color:#05141f;padding:5px"
                                class="alert alert-primary alert-dismissible fade show" role="alert">
                                <span id="veh_no">Your vehicle task list loading...</span><!-- <span id="tasks"
                                    style="display:none"> - Task
                                </span> <a id="view_task_details" href="#" class="alert-link" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" style="display:none;color:#fff">
                                    View Details</a> -->
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                                <table id="task-tbl" style="display:none" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Task</th>
                                        <!-- <th scope="col">Start Time</th> -->
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="task-list">
                                        <!-- <tr>
                                            <th scope="row">1</th>
                                            <td>Task 1</td>
                                            <td>May-14-23, 15:00:00</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Task 2</td>
                                            <td>May-15-23, 09:00:00</td>
                                            <td><span class="badge bg-secondary">In Progress</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Task 3</td>
                                            <td>--</td>
                                            <td><span class="badge bg-light text-dark">Not Started</span></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade text-center" style="margin-top:20px" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">

                        <!-- Image Map Generated by http://www.image-map.net/ -->
                        <img id="my_car" src="" usemap="#image-map">

                        <map name="image-map" id="image_mapping">

                        </map>

                    </div>
                </div>
            </div>


            <div class="row row-0-gutter" style="margin-bottom: 30px;">

            </div>
            <div class="row row-0-gutter image-container" style="margin-bottom: 30px;">
                <p class="image-disply page-scroll noHover" href="#page-top"><img
                        src="http://<?=$dealer['web_server_ip']?>/assets/images/logo.jpeg" alt="AutoChip logo"
                        class="change"></p>
                <!-- start portfolio item -->
                <!-- <div class="col-md-6 col-0-gutter">
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba">
                            <video controls id="stream3" muted="muted">
                            </video>
                        </figure>
                    </div>
                </div> -->
                <!-- end portfolio item -->

            </div>

        </div><!-- container -->
    </section>


    <div class="overlay">
        <div class="overlay-message" style="text-transform: capitalize;">Video Paused. Please wait till it resumes.</div>
    </div>
    <div class="full-screen-overlay"></div>

    <input type="hidden" name="ip" id="ip" value="<?=$dealer['web_server_ip']?>">
    <input type="hidden" name="dir_name" id="dir_name" value="<?=$dealer['dir_name']?>">
    <input type="hidden" name="bay_name" id="bay_name" value="<?=$vehicle['bay_name']?>">
    <input type="hidden" name="cam_server" id="cam_server" value="<?=$dealer['cam_server']?>">
    <?php } ?>

    <!-- <p id="back-top">
        <a href="#top"><i class="fa fa-angle-up"></i></a>
    </p> -->
    
    <div class="chat-icon" id="chatIcon" >
        <img style="width:65px" src="http://<?=$dealer['web_server_ip']?>/assets/images/chat.png" alt="Chat Icon">
    </div>
    <?php
        $this->load->view('includes/footer');
    ?>
    <input type="hidden" name="token" id="token" value="<?=$token?>">
    

    <?php  
        if (!empty($error)) {
    ?>
        <script> 
            $("#submit_feedback").click(function(){
                var cntr = 0;                            
                var feedback = $("#feedback").val();
                var token = $('#token').val();

                if($("#star5").is(':checked')){
                    cntr = 5;
                }
                if($("#star4").is(':checked')){
                    cntr = 4;
                }
                if($("#star3").is(':checked')){
                    cntr = 3;
                }
                if($("#star2").is(':checked')){
                    cntr = 2;
                }
                if($("#star1").is(':checked')){
                    cntr = 1;
                }  
                $.ajax({
                    url: "/index.php/updateFeedback?token=" + token+"&count="+cntr+"&feedback="+feedback,
                    cache: false,
                    data: {},
                    success: function(result) {

                        var res = JSON.parse(result['message'])
                        var task_list = '';
                        if (typeof(res['result']) != 'undefined') {
                            var cnt = res['result']['review'];
                            var fdbk = res['result']['feedback'];
                            
                            $("#feedback").val(fdbk) 
                            if(cnt == 1){
                                $("#star1").trigger('click')
                            }
                            if(cnt == 2){
                               $("#star2").trigger('click')
                            }
                            if(cnt == 3){
                                $("#star3").trigger('click')
                            }
                            if(cnt == 4){
                                $("#star4").trigger('click')
                            }
                            if(cnt == 5){
                                $("#star5").trigger('click')
                            }
                            //alert('Thank you for your feedback')
                            // document.getElementById('rating-div').style.display = 'none';
                            $("#rating-div").css("display", "none");
                            $("#success-msg").css("display", "block");

                            setTimeout(() => {
                                $("#alert-close").trigger('click')
                            }, 5000);
                        }
                    }
                });
            })

            setTimeout(function() { 

                var token = $('#token').val();

                $.ajax({
                    url: "/index.php/getFeedback?token=" + token,
                    cache: false,
                    data: {},
                    success: function(result) {
                        var res = JSON.parse(result['message'])

                        var task_list = '';
                        if (typeof(res['result']) != 'undefined') {
                            var cnt = res['result']['review'];
                            var fdbk = res['result']['feedback'];
                            var is_updated = res['result']['update'];
                            if (!is_updated){
                                // document.getElementById('rating-div').style.display = 'block';
                                $("#rating-div").css("display", "flex");
                            } 

                            $("#feedback").val(fdbk) 
                            if(cnt == 1){
                                $("#star1").trigger('click')
                            }
                            if(cnt == 2){
                               $("#star2").trigger('click')
                            }
                            if(cnt == 3){
                                $("#star3").trigger('click')
                            }
                            if(cnt == 4){
                                $("#star4").trigger('click')
                            }
                            if(cnt == 5){
                                $("#star5").trigger('click')
                            }
                        }
                    }
                });
            }, 3000)
        </script>

    <?php  
       } else {
    ?>
    <script>
        setInterval(function(){
                var   token = $('#token').val();            
                $.ajax({
                url: "/index.php/gettokenstatus?token="+token,
                cache: false,
                success: function(result){
                    if(result.state != 1){
                        location.reload();
                    }
                }
                });
                }, 5000);    
        </script>
    <?php
       }
       ?>



    <script>
    var ip = $('#ip').val();
    var dir_name = $('#dir_name').val();
    var bay_name = $('#bay_name').val();
    var cam_server = $('#cam_server').val();
    var video1 = document.getElementById('stream1');
    var video2 = document.getElementById('stream2');

    const video = document.getElementById('my-video'); 
    const overlay = document.querySelector('.overlay');
    const fullScreenOverlay = document.querySelector('.full-screen-overlay');

    // $(document).ready(function() {
    $("#play_all").click(function(event, type) {
        if (video1) video1.play()
        if (video2) video2.play()
        overlay.style.display = 'none';
        fullScreenOverlay.style.display = 'none';

        if (type !== 'backend') {
            updateOdooBackendStatus('live');
        }
    })

    $("#pause_all").click(function(event, type) {
        if (video1) video1.pause();
        if (video2) video2.pause();
        if(type == 'auto'){
            overlay.style.display = 'block';
            fullScreenOverlay.style.display = 'block';
        }

        if (type !== 'backend' && type !== 'auto') {
            updateOdooBackendStatus('hold');
        }
    })
    $("#stop_all").click(function(event, type) {
        if(confirm("Are you sure you want to stop this streaming? You can't restart it once stopped.")){
           
            var token = $('#token').val();
            $.ajax({
                url: "/index.php/stopStreaming?token=" + token,
                cache: false,
                data: {},
                success: function(result) {
                    var res = JSON.parse(result['message'])                     
                }
            });
            
        }
        else{
            return false
        }
    });



     if (Hls.isSupported()) {
        if (video1) {
            var hls1 = new Hls();
            hls1.loadSource('http://' + cam_server + (cam_server.includes(':8088') && !cam_server.includes('/streams') ? '/streams/' : '/') + dir_name + '/' + bay_name + '/stream1.m3u8');
            hls1.attachMedia(video1);
            hls1.on(Hls.Events.MANIFEST_PARSED, function() {
                video1.muted = true; video1.play();
            });
        }
        if (video2) {
            var hls2 = new Hls();
            hls2.loadSource('http://' + cam_server + (cam_server.includes(':8088') && !cam_server.includes('/streams') ? '/streams/' : '/') + dir_name + '/' + bay_name + '/stream2.m3u8');
            hls2.attachMedia(video2);
            hls2.on(Hls.Events.MANIFEST_PARSED, function() {
                video2.muted = true; video2.play();
            });
        }
        setTimeout(function() {
            if(video1) { video1.muted = true; video1.play(); }
            if(video2) { video2.muted = true; video2.play(); }
        }, 5000);
    }
    else if (video1 && video1.canPlayType('application/vnd.apple.mpegurl')) {
        if(video1) {
            video1.src = 'http://' + cam_server + (cam_server.includes(':8088') && !cam_server.includes('/streams') ? '/streams/' : '/') + dir_name + '/' + bay_name + '/stream1.m3u8';
            video1.addEventListener('canplay', function() { video1.muted = true; video1.play(); });
        }
        if(video2) {
            video2.src = 'http://' + cam_server + (cam_server.includes(':8088') && !cam_server.includes('/streams') ? '/streams/' : '/') + dir_name + '/' + bay_name + '/stream2.m3u8';
            video2.addEventListener('canplay', function() { video2.muted = true; video2.play(); });
        }
    } else {
        console.log("Nothing Supported")
    }


    if(video1){
        video1.onpause = function() {
            $("#play_all").show()
            $("#pause_all").hide()
        };

        video1.onplay = function() {
            $("#play_all").hide()
            $("#pause_all").show()
        };
    }

    if(video2){
        video2.onpause = function() {
            $("#play_all").show()
            $("#pause_all").hide()
        };

        video2.onplay = function() {
            $("#play_all").hide()
            $("#pause_all").show()
        };
    }

    $('#chatIcon').on('click', function() {
        var chatwindow = document.getElementsByClassName("o_livechat_button"); 
        if(chatwindow.length){
            chatwindow[0].style.display = 'block';
            $('#chatIcon').css("display", "none");
            $('.o_livechat_button').trigger("click");
        } else {
            alert('Sorry, no agents are available now.')
        }
    });
    $(".o_chat_window_close").on('click', function() {
        $('#chatIcon').css("display", "block");
    });

    setTimeout(() => {
        var live_chatwindow = document.getElementsByClassName("o_chat_window");
        if(live_chatwindow.length){
            $('#chatIcon').css("display", "none");
        }
    }, 1000);

    // setInterval(function() {
    //     console.log('in setInterval')
    //     var chatwindow = document.getElementsByClassName("o_livechat_button"); 
    //     // if(typeof(chatwindow) != 'undefined'){
    //     //     chatwindow[0].style.display = 'none';
    //     // }        
    // }, 3000);


    setTimeout(function() {
        var token = $('#token').val();
        $.ajax({
            url: "/index.php/getStages?token=" + token,
            cache: false,
            data: {},
            success: function(result) {
                var res = JSON.parse(result['message'])
                var task_list = '';
                if (typeof(res['result']) != 'undefined') {
                    $("#overview").show();
                    console.log(res['result'])
                    var cnt = res['result'].length - 1;
                    var in_progress_task = '';

                    $(res['result']).each(function(i) {

                        if (typeof(res['result'][i][0]['vehicleNumber']) != 'undefined') {
                            $("#veh_no").text('Task list of your vehicle ' + res['result'][
                                i
                            ][0]['vehicleNumber'])
                            $("#view_task_details").show()
                            $(".task_list").text('Task List - ' + res['result'][i][0][
                                'vehicleNumber'
                            ])
                        } else {
                            var cls = 'bg-success'
                            if (res['result'][i][0]['status'] != "completed") {
                                cls = 'bg-secondary'
                            }
                            if (res['result'][i][0]['status'] == "Work In Progress"){
                                in_progress_task = res['result'][i][0]['stage']
                            }

                            task_list +=
                                '<tr style="text-transform:capitalize"><th scope="row">' + i
                                .toString() + '</th> <td>' + res['result'][i][0]['stage'] +
                                '</td>   <td><span class="badge ' + cls + '">' + res[
                                    'result'][i][0]['status'] + '</span></td></tr>';
                        }
                    });
                    $("#task-list").html(task_list)
                    $("#task-tbl").show()
                    // $("#tasks").text(", "+in_progress_task +" in progress (total " + cnt.toString() + " tasks)").show()
                }
            }
        });
    }, 3000)

    $('#profile-tab').on('click', function() {
        var token = $('#token').val();
        $.ajax({
            url: "/index.php/getComponents?token=" + token,
            cache: false,
            success: function(result) {
                var res = JSON.parse(result['message'])
                if (typeof(res['result']) != 'undefined') {
                    $("#my_car").attr('src', res['result'][0]['image'])
                    $(".comp-list").text(res['result'][0]['name'])
                    var body_parts = res['result'][0]['body_parts']

                    $(body_parts).each(function(i) {
                        $("#image_mapping").html(body_parts[i]['coordinates'])
                        // console.log(body_parts[i])
                        // var comp = body_parts[i]['components']
                        // $(comp).each( function( k ) {    
                        //     console.log(comp[k])
                        // });
                    });
                }
            }
        });
    })

    $('body').on('click', 'area.load-modal', function(elem) {

        var part_name = $.trim($(this).attr('title')).toLowerCase();
        $.ajax({
            url: "/index.php/getComponents?token=" + token,
            cache: false,
            success: function(result) {
                var res = JSON.parse(result['message'])
                if (typeof(res['result']) != 'undefined') {
                    var body_parts = res['result'][0]['body_parts']
                    var component_list = ''

                    $(body_parts).each(function(i) {
                        if ($.trim(body_parts[i]['name']).toLowerCase() == part_name) {
                            var comp = body_parts[i]['components']
                            var comp_text = $(".comp-list").text();
                            $(".comp-list").text(comp_text + ' - ' + part_name + ' parts')

                            $(comp).each(function(k) {
                                component_list +=
                                    '<tr style="text-transform:capitalize"><th scope="row">' +
                                    (k + 1).toString() + '</th> <td>' + comp[k][0][
                                        'name'
                                    ] + '</td>   <td><img height="65px" src="' +
                                    comp[k][0]['image'] + '"></img></td></tr>';
                            });
                            $("#component_list").html(component_list);
                            $("#partsModalBT").show()
                        }
                    });
                }
            }
        });
    });

    $('body').on('click', '.btn-cls', function(elem) {
        $("#partsModalBT").hide()
    })

    $("#buddt_upload").click(function() {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
                    alert('file uploaded');
                } else {
                    alert('file not uploaded');
                }
            },
        });
    });

    
        function updateOdooBackendStatus(status) {
        var server_ip = $('#ip').val().split(":")[0] + ":8069";
        var token = $('#token').val();
        var payload = {
            "token": token,
            "status": status
        };
        $.ajax({
            type: 'POST',
            url: 'http://' + server_ip + '/api/update_stream_status',
            data: JSON.stringify(payload),
            contentType: "application/json",
            dataType: 'json',
            success: function(data) {
                console.log("Backend status updated to " + status);
            }
        });
    }
</script>
</body>

</html>





