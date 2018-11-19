<?php
	setcookie("Authority","",time() - 3600);
	setcookie("Authority","newer",time() + 86400);
?>
<html>
	<link rel="stylesheet" type="text/css"  href="css/countdown.css">
	<div class="content">
		<div id="head">
			<h>goodbye from the shesl-db</h>
		</div>
		<div id="countdown">
			<h>REDIRACTE in 5 seconds</h>
		</div>
	</div>
	<script type="text/javascript" src="js/countdown5.js"></script>
	<head><meta http-equiv="refresh" content="5;url=index.php"> </head>
</html>
