<?php

	if ( !isset($_POST['signin-key']) || !isset($_POST['signin-password']) ) exit("Illegal Access!");
	if( setcookie('Authority','login',time() + 3600,'/') && setcookie('userName',$_POST['signin-key'],time() + 3600,'/')){
?>
<html>
<link rel="stylesheet" type="text/css"  href="../css/countdown.css">
<div class="content">
	<div id="head">
		<h>loggin successfully</h>
	</div>
	<div id="countdown">
		<h>REDIRACTE in 5 seconds</h>
	</div>
</div>
<script type="text/javascript" src="../js/countdown5.js"></script>
<head><meta http-equiv="refresh" content="5;url=../index.php"> </head>
</html>
<?php }	?>