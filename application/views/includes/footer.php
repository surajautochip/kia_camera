<footer>
  <div class="container text-center">
    <!-- <p>&copy;Copyright <a href="https://www.kia.com/"><span>AutoEver</span></a></p> -->
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://<?=$dealer['web_server_ip']?>/assets/js/bootstrap.min.js"></script>
<!-- <script src="http://<?=$dealer['web_server_ip']?>/assets/js/SmoothScroll.js"></script> -->
<script src="http://<?=$dealer['web_server_ip']?>/assets/js/theme-scripts.js"></script>
<?php
	$js_token = isset($token) ? $token : '';
	$server_ip = $dealer['live_chat_server'];
?>
<script type="text/javascript" src="http://<?php echo $server_ip; ?>/im_livechat/external_lib.js"></script>
<script type="text/javascript" src="http://<?php echo $server_ip; ?>/im_livechat/loader/<?php echo $js_token; ?>"></script>
 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>