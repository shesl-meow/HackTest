<?php

if ( !isset($_POST["signup-username"]) || !isset($_POST["signup-email"])) exit("Illegal Access!"); 

$servername = "localhost";
$adminUsername = "root";
$adminPassword = "root";
$conn = new mysqli($servername, $adminUsername, $adminPassword);

$exResult = array(True, True, True);
if ($conn->connect_error) {
    $exResult[2] = "Connection failed: " . $conn->connect_error;
}elseif ($conn->query("USE playermansystem;") === FALSE) {
	// Connect to database
	$exResult[2] = "Error swift database: " . $conn->error;
}else{
	$alias = $conn->query("select Alias from users;");
	$email = $conn->query("select email from users;");
	$inputname = test_input($_POST["signup-username"]);
	$inputemail = test_input($_POST["signup-email"]);
	if( $alias->num_rows > 0 )
		while( $row = $alias->fetch_assoc())
			if( $inputname === $row["Alias"] ){
				$exResult[2] = FALSE;
				$exResult[0] = $row["Alias"] . " Exists.";
				break;
			}
	if( $email->num_rows > 0 )
		while( $row = $email->fetch_assoc()){
			if( $inputemail === $row["email"] ){
				$exResult[2] = FALSE;
				$exResult[1] = $row["email"] . " Exists.";
				break;
			}
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
