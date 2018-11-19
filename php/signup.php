<?php

if (!isset($_POST['signup-username']) || !isset($_POST['signup-email']) || !isset($_POST['signup-password'])) exit("Illegal Access!");

$servername = "localhost";
$adminUsername = "root";
$adminPassword = "root";

$conn = new mysqli($servername, $adminUsername, $adminPassword);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Using database
$sql = "USE playermansystem";
if ($conn->query($sql) !== TRUE) {
    die("Error Using database: " . $conn->error);
}
echo "<br>";

/* We shall insert user msg into database next. The code within the comment is safer way.*/

/*
if( $stmt = $conn->prepare("INSERT INTO users(Alias,email,password) VALUES (?,?,?)") ){

	$inAlias = test_input($_POST['signup-username']);
	$inEmail = test_input($_POST["signup-email"]);
	$inPass = md5( test_input($_POST["signup-password"]) );
	$stmt->bind_param("sss",$inAlias,$inEmail, $inPass);

	if( $stmt->execute() ) $info = "sign up successfully!";
	else $info = $conn->error;
}
*/

$sql = "INSERT INTO users(Alias, email, password) VALUES ('".
    $_POST["signup-username"]."', '".$_POST["signup-email"]."', '".md5($_POST["signup-password"])."');";

if( $conn->query($sql) == TRUE ) $info = "sign up successfully";
else $info = $conn->error;

$conn->close();
?>
<html>
<link rel="stylesheet" type="text/css"  href="../css/countdown.css">
<div class="content">
	<div id="head">
		<h><?php echo $info ?></h>
	</div>
	<div id="countdown">
		<h>REDIRACTE in 5 seconds</h>
	</div>
</div>
<script type="text/javascript" src="../js/countdown5.js"></script>
<head><meta http-equiv="refresh" content="5;url=../index.php"> </head>
</html>
<?php

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
