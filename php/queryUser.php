<?php
	if ( !isset($_POST['query-user']) ) exit("Illegal Access!");

	$servername = "localhost";
	$adminUsername = "root";
	$adminPassword = "root";
	$conn = new mysqli($servername, $adminUsername, $adminPassword);
	
	$queryResult = "";

	if ($conn->connect_error) {
		$queryResult = "Connection failed: " . $conn->connect_error;
	}elseif($conn->query("USE playermansystem;") === FALSE) {
		$queryResult = "Error swift database: " . $conn->error;
	}elseif( isset($_POST["query-user"]) ){
		$inputkey = test_input($_POST["query-user"]);
		$Info = "";
		if( $res1 = $conn->query("SELECT HumanID,email,Alias,GameID,gender FROM users WHERE Alias='".$inputkey."';") ){
			while( $row = $res1->fetch_assoc() ){
				foreach ($row as $key => $value) {
					if( !isset($value) ) $value = "null";
					if( $key == "GameID" ) $key = "Favorate Game";
					$Info = $Info.$key.": ".$value.";<br>";
				}
				$Info = $Info . "<br>";
			}
			$queryResult = $Info;
      }
		}elseif( $res2 = $conn->query("SELECT HumanID,email,Alias,GameID,gender FROM users WHERE email='".$inputkey."';") ){
			while( $row = $res2->fetch_assoc() ){
				foreach ($row as $key => $value) {
					if( !isset($value) ) $value = "null";
					if( $key == "GameID" ) $key = "Favorate Game";
					$Info = $Info.$key.": ".$value.";<br>";
				}
				$Info = $Info . "<br>";
			}
			$queryResult = $Info;
		}else $queryResult = "user ".$inputkey." does not exist";
	
	$conn->close();
	echo $queryResult;

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>