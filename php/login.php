<?php

if ( !isset($_POST['signin-key']) || !isset($_POST['signin-password']) ) exit("Illegal Access!");

$servername = "localhost";
$adminUsername = "root";
$adminPassword = "root";

$conn = new mysqli($servername, $adminUsername, $adminPassword);
$exResult = array(false, false, false);

if( $conn->connect_error ) $exResult[2] = "Connection failed: " . $conn->connect_error;
elseif( $conn->query("USE playermansystem") !== TRUE) $exResult[2] = "Error swift database: " . $conn->error;
else{
	$info = $conn->query("select Alias,email,password from users");
	$inputkey = test_input($_POST['signin-key']);
	$password = md5( test_input($_POST['signin-password']) );
	
	$exResult[0] = "User doesn't exist";
	if( $info->num_rows > 0 )
		while( $row = $info->fetch_assoc() )
			if($row['Alias'] === $inputkey || $row['email'] === $inputkey){
				$exResult[0] = false;
				($row['password'] === $password) ? ($exResult[2] = true && $exResult[0] = $row['Alias']) : ($exResult[1] = "Incorrect password") ;
				break;
			}
}

$conn->close();

echo json_encode($exResult);

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
