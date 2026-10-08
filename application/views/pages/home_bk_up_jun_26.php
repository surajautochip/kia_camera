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
    </style>
</head>

<body class="home-banner">

    <?php
            $this->load->view('includes/menu');
            $this->load->view('pages/modal');

        ?>



    <?php  

            if (!empty($error)) {
        ?>
    <input type="hidden" name="token_status" id="token_status" value="0">
    <section id="portfolio">
        <div class="container">
            <div class="row" style="margin-top: -60px;">
                <div class="col-lg-12 text-center">
                    <h2 style="margin-top: 100px !important;color: #FFC0CB;font-weight: bold;">
                        <MARQUEE>Live Streaming Completed!</MARQUEE>
                    </h2>
                    <a class="image-disply page-scroll" href="#page-top"><img
                            src="https://<?=$dealer['web_server_ip']?>/camera/assets/images/logo.jpeg"
                            alt="AutoChip logo" class="change">
                        <h2 style="margin-top: 100px !important;color: #FFC0CB;font-weight: bold;">
                            <MARQUEE>Live Streaming Completed!</MARQUEE>
                        </h2>
                        <p><?=$error?></p>
                    </a>
                </div>
            </div>
        </div>
        </div>





    </section>
    <?php } else {?>
    <input type="hidden" name="token_status" id="token_status" value="1">
    <section id="portfolio" style="padding:0 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title" style="padding:0 !important;">
                        <h2 style="font-size:33px; padding:0 !important;">Welcome to <?php echo $dealer['name'];  ?>
                            Live Streamingg</h2>
                        <!-- <p>Your vehicle is safe with us, we care your car as you do. Please see the live video of your car.</p> -->
                    </div>
                </div>
            </div>
            <div class="row row-0-gutter">
                <!-- start portfolio item -->
                <div class="col-md-6 col-0-gutter">
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba">
                            <video controls id="stream1" muted="muted">
                            </video>
                        </figure>
                    </div>
                </div>
                <!-- end portfolio item -->
                <!-- start portfolio item -->
                <div class="col-md-6 col-0-gutter">
                    <div class="ot-portfolio-item">
                        <figure class="effect-bubba">
                            <video controls id="stream2" muted="muted">
                            </video>
                        </figure>
                    </div>
                </div>
                <!-- end portfolio item -->
            </div>



            <div style="width:90%;margin-left:auto;margin-right:auto;">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                            role="tab" aria-controls="home" aria-selected="true">Status</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                            role="tab" aria-controls="profile" aria-selected="false">Parts View</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="tab-pane" id="overview">
                            <div style="width: 90%;margin-top:20px;margin-left:auto;margin-right:auto;"
                                class="alert alert-primary alert-dismissible fade show" role="alert">
                                <span id="veh_no">Your vehicle task list loading...</span><span id="tasks" style="display:none"> - Task
                                </span><a id="view_task_details" href="#" class="alert-link" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display:none">
                                    View Details</a>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade text-center" style="margin-top:20px" id="profile" role="tabpanel"
                        aria-labelledby="profile-tab">

                        <!-- Image Map Generated by http://www.image-map.net/ -->
                        <img id="my_car" src="" usemap="#image-map">

                        <map name="image-map" id="image_mapping">
                            <!-- <area target="_self" alt="Bonet" title="Bonet" href="javascript:;" coords="87,152,136,136,191,141,134,157" data-bs-toggle="modal" data-bs-target="#partsModalBT"  shape="poly">
                            <area target="_self" alt="Front Glass" title="Front Glass" href="javascript:;" data-bs-toggle="modal" data-bs-target="#partsModalFG" coords="149,129,176,114,215,115,204,133" shape="poly">
                            <area target="_self" alt="Front Door" title="Front Door" href="javascript:;" data-bs-toggle="modal" data-bs-target="#partsModalFD" coords="229,121,214,165,217,188,259,188,262,153,260,117" shape="poly">
                            <area target="_self" alt="Back Door" title="Back Door" href="javascript:;" coords="270,118,302,119,320,137,304,180,269,188,270,151" shape="poly" data-bs-toggle="modal" data-bs-target="#partsModalBD">
                            <area target="_self" data-bs-target="#partsModalSF" data-bs-toggle="modal" id="partsModalSF" alt="Grill" title="Grill" href="javascript:;" coords="73,170,75,193,147,194,137,169" shape="poly"> -->
                        </map>

                    </div>
                </div>
            </div>

















            <div class="row row-0-gutter" style="margin-bottom: 30px;">

            </div>
            <div class="row row-0-gutter" style="margin-bottom: 30px;">
                <a class="image-disply page-scroll" href="#page-top"><img
                        src="https://<?=$dealer['web_server_ip']?>/camera/assets/images/logo.jpeg" alt="AutoChip logo"
                        class="change"></a>
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



    <input type="hidden" name="ip" id="ip" value="<?=$dealer['web_server_ip']?>">
    <input type="hidden" name="dir_name" id="dir_name" value="<?=$dealer['dir_name']?>">
    <input type="hidden" name="bay_name" id="bay_name" value="<?=$vehicle['bay_name']?>">
    <input type="hidden" name="cam_server" id="cam_server" value="<?=$dealer['cam_server']?>">
    <?php } ?>

    <p id="back-top">
        <a href="#top"><i class="fa fa-angle-up"></i></a>
    </p>

    <?php

            $this->load->view('includes/footer');
        ?>
    <input type="hidden" name="token" id="token" value="<?=$token?>">

    <script>
    // $('.modal').on('shown.bs.modal', function (e) { 

    //     var offset = $(document).scrollTop(),

    //     // Get the window viewport height
    //     viewportHeight = $(window).height(),

    //     // cache your dialog element
    //     $myDialog = $('.modal');

    //     // now set your dialog position
    //     var idattr = $(this).attr('id');
    //     if(idattr == 'partsModalFD') {
    //         $myDialog.css('left',  "20%");
    //     }
    //     if(idattr == 'partsModalBD') {
    //         $myDialog.css('left',  "50%");
    //     }
    //     if(idattr == 'partsModalSF') {
    //         $myDialog.css('left', "30%");
    //     }            

    // });


    var ip = $('#ip').val();
    var dir_name = $('#dir_name').val();
    var bay_name = $('#bay_name').val();
    var cam_server = $('#cam_server').val();

    if (Hls.isSupported()) { 

        var video1 = document.getElementById('stream1');
        var hls1 = new Hls();
        //          hls.loadSource('https://video-dev.github.io/streams/x36xhzz/x36xhzz.m3u8');
        hls1.loadSource('https://' + cam_server + '/' + dir_name + '/' + bay_name + '/stream1.m3u8');
        hls1.attachMedia(video1);
        hls1.on(Hls.Events.MANIFEST_PARSED, function() {
            //video1.play();
        });

        var video2 = document.getElementById('stream2');
        var hls2 = new Hls();
        //          hls.loadSource('ss://video-dev.github.io/streams/x36xhzz/x36xhzz.m3u8');
        hls2.loadSource('https://' + cam_server + '/' + dir_name + '/' + bay_name + '/stream2.m3u8');
        hls2.attachMedia(video2);
        hls2.on(Hls.Events.MANIFEST_PARSED, function() {
            //video2.play();

        });

        //                     var video3 = document.getElementById('stream3');
        //           var hls3 = new Hls();
        // //          hls.loadSource('https://video-dev.github.io/streams/x36xhzz/x36xhzz.m3u8');
        //         hls3.loadSource('http://103.226.0.202:4500/live/stream3.m3u8');
        //           hls3.attachMedia(video3);
        //           hls3.on(Hls.Events.MANIFEST_PARSED,function() {
        //             video3.play();

        //     });

        setTimeout(function() {
            video1.play();
            video2.play();
        }, 5000);



    }
    // hls.js is not supported on platforms that do not have Media Source Extensions (MSE) enabled.
    // When the browser has built-in HLS support (check using `canPlayType`), we can provide an HLS manifest (i.e. .m3u8 URL) directly to the video element throught the `src` property.
    // This is using the built-in support of the plain video element, without using hls.js.
    else if (video1.canPlayType('application/vnd.apple.mpegurl')) {
        alert("Here")

        video1.src = 'https://' + cam_server + '/' + dir_name + '/' + bay_name + '/stream1.m3u8';
        video2.src = 'https://' + cam_server + '/' + dir_name + '/' + bay_name + '/stream2.m3u8';
        video1.addEventListener('canplay', function() {
            video1.play();
        });
        video2.addEventListener('canplay', function() {
            video2.play();
        });
    }

    setInterval(function() {
        var chatwindow = document.getElementsByClassName("o_livechat_button");
        chatwindow[0].style.display = 'block';
    }, 5000);

    // setInterval(function(){
    //     var   token = $('#token').val();            
    //     $.ajax({
    //       url: "https://"+ip+"/camera/index.php/gettokenstatus?token="+token,
    //       cache: false,
    //       success: function(result){
    //         if(result.state != 1){
    //             location.reload();
    //         }
    //       }
    //     });
    // }, 5000);

    setTimeout(function() {
        var token = $('#token').val();
        $.ajax({
            url: "/camera/index.php/getStages?token=" + token,
            cache: false,
            data: {
            },
            success: function(result) {

                var res = JSON.parse(result['message'])
                var task_list = '';
                if (typeof(res['result']) != 'undefined') {
                    $("#overview").show();
                    var cnt = res['result'].length - 1;
                    $(res['result']).each(function(i) {

                        if (typeof(res['result'][i][0]['vehicleNumber']) != 'undefined') {
                            $("#veh_no").text(res['result'][i][0]['vehicleNumber'])
                            $(".task_list").text('Task List - ' + res['result'][i][0][
                                'vehicleNumber'
                            ])
                        } else {
                            var cls = 'bg-success'
                            if (res['result'][i][0]['status'] != "completed") {
                                cls = 'bg-secondary'
                            }

                            task_list +=
                                '<tr style="text-transform:capitalize"><th scope="row">' + i
                                .toString() + '</th> <td>' + res['result'][i][0]['stage'] +
                                '</td>   <td><span class="badge ' + cls + '">' + res[
                                    'result'][i][0]['status'] + '</span></td></tr>';
                        }
                    });
                    $("#task-list").html(task_list)
                    $("#tasks").text("Total " + cnt.toString() + " tasks")
                }
            }
        });
    }, 3000)

    $('#profile-tab').on('click', function() {
        var token = $('#token').val();
        $.ajax({
            url: "/camera/index.php/getComponents?token=" + token,
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
            url: "/camera/index.php/getComponents?token=" + token,
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
    </script>

    <!-- <link rel="stylesheet" href="https://hyundailivestreaming.com/im_livechat/external_lib.css"/>
        <script type="text/javascript" src="https://hyundailivestreaming.com/im_livechat/external_lib.js"></script>
        <script type="text/javascript" src="https://hyundailivestreaming.com/im_livechat/loader/6"></script> -->

    <!-- <form method="post" action="/camera/index.php/upload/fileupload" enctype="multipart/form-data" id="myform">  
            <div > 
                <input type="file" id="file" name="file" /> 
                <input type="submit" class="button" value="Upload"
                        id="but_upload"> 
            </div> 
        </form>  -->


    <script>
    // setTimeout(() => { 
    //     $('body').find('.o_composer_button_add_attachment').on('click',function(){
    //         $("#file").trigger('click');
    //         console.log('- - --this.channel -- - - - - -')
    //         console.log(this.channel)
    // })
    // }, 3000);

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
    </script>
</body>

</html>