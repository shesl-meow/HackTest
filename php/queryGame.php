<?php
	if ( !isset($_POST['query-game']) ) exit("Illegal Access!");

	$servername = "localhost";
	$adminUsername = "root";
	$adminPassword = "root";
	$conn = new mysqli($servername, $adminUsername, $adminPassword);
	
	$queryResult = "";

	if ($conn->connect_error) {
		$queryResult = "Connection failed: " . $conn->connect_error;
	}elseif($conn->query("USE playermansystem;") === FALSE) {
		$queryResult = "Error swift database: " . $conn->error;
	}elseif( isset($_POST["query-game"]) ){
		$gamename = test_input($_POST["query-game"]);
		$conn->query("CALL update_rank('".$gamename."');");
		$sql1 = "SELECT GName,Alias,BestScore,UserRank FROM Play
				LEFT JOIN Users ON Users.HumanID = Play.HumanID
				LEFT JOIN Games ON Games.GameID = Play.GameID
				WHERE GName='".$gamename."';";
		$sql2 = "SELECT PName,AvgRank FROM ProvidedGames WHERE GName='".$gamename."';";
		$Info = "";

		if( $res1 = $conn->query($sql1) ){
			$Info = $Info."<li>User Play game Info</li><br>";
			$Info = $Info."<table style='border: 1px solid black;'>";
			$Info = $Info."<tr><th> Game Name </th>"."<th> User Name </th>"."<th> User score </th>"."<th> User rank the game </th></tr>";
			while( $row = $res1->fetch_assoc() ){
				$Info = $Info."<tr>";
				foreach ($row as $key => $value) {
					if( !isset($value) ) $value = "null";
					$Info = $Info."<th>".$value."</th>";
				}
				$Info = $Info . "</tr>";
			}
			$Info = $Info."</table>";
			$Info = $Info."<style>table, th, td { 
				border: 2px solid black;
				border-collapse: collapse;
				text-align: center;} </style><br>";
		}
		if( $res2 = $conn->query($sql2) )
			while( $row = $res2->fetch_assoc() ){
				foreach ($row as $key => $value) {
					if($key == "PName" && isset($value)) $Info = $Info."<li>This is a game built in ".$value." platform.</li><br>";
					if($key == "AvgRank" && isset($value)) $Info = $Info."<li>User average rank on this game is ".$value."</li><br>";
				}
				$Info = $Info . "<br>";
			}
		else $Info = "game ".$gamename." does not exist";
		$queryResult = $Info;
	}
	$conn->close();
	echo json_encode($queryResult);

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>