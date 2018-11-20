<?php
    if ( !isset($_POST['signin-key']) || !isset($_POST['signin-password']) ) exit("Illegal Access!");
    setcookie('userName',$_POST['signin-key'],time() + 3600,'/');

    $conn = new mysqli("localhost","root", "root");
    if( $conn->connect_error ) echo "Connection failed: " . $conn->connect_error;
    elseif( $conn->query("USE playermansystem") !== TRUE) echo "Error swift database: " . $conn->error;
    else {
      $info = $conn->query("select Alias,email from users");
      if ($info->num_rows > 0) while ($row = $info->fetch_assoc())
        if ($row['Alias'] === $_POST['signin-key'] || $row['email'] === $_POST['signin-key']s) {
          $queryResult = "Alias: " . $row["Alias"] . "<br>email: " . $row["email"] . "<br>";
          break;
        }
    }
    $conn->close();
    setcookie('queryResult',$queryResult,time() + 3600,'/');
    setcookie('Authority','login',time() + 3600,'/');
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