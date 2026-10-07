<!-- <link href="http://<?=$dealer['web_server_ip']?>/assets/css/bootstrap.min.css" rel="stylesheet">  -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
<!-- Custom styles for this template -->
<link href="http://<?=$dealer['web_server_ip']?>/assets/css/style.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="http://122.176.100.173:9000/im_livechat/external_lib.css"/> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<script src="http://<?=$dealer['web_server_ip']?>/assets/js/pingServer.js"></script>
<?php
	$server_ip = $dealer['live_chat_server'];
?>
<link rel="stylesheet" href="http://<?php echo $server_ip; ?>/im_livechat/external_lib.css"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>