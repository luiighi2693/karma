<?php
	$servername = "localhost";
	$username = "karmathe_KarmaAI";
	$password = "Reality2012";
	$dbname = "karmathe_databox_karma";
	
	//Make Connection
	$conn = new mysqli ($servername, $username, $password, $dbname);
	//Check Connection
	if(!$conn){
		die("Connection Failed.". mysqli_connect_error());
		
	}
	

	$sql = "SELECT email, username, aboutme FROM users WHERE username = 'Raven' ";
	$result = mysqli_query($conn, $sql);
	
	
	if(mysqli_num_rows($result) > 0) {
		//show data for each row
		while($row = mysqli_fetch_assoc($result)) {
			echo 
			"Email:".$row['email']. 
			"--|--Username:".$row['username']. 
			"--|--Tagline: ".$row['aboutme'] 
			; 
		}
	}
?>