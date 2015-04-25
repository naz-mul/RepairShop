<?php
	$success = '';
	$error =  '';
	if (isset($_POST['submit'])) {
		// Define $username and $password
		$surname = $_POST['surname'];
		$forename = $_POST['forename'];
		$email = $_POST['email'];
		$town = $_POST['town'];
		$county = $_POST['county'];
		$tel = $_POST['telephone'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		if ( empty($town) or empty($county) or empty($tel) ) 
		{
			$town = "Not Set";
			$county = "Not Set";
			$tel = "0830000000";
		}
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn= mysqli_connect("localhost", "root", "", "compsys");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// To protect MySQL injection for Security purpose
		$surname = stripslashes($surname );
		$forename = stripslashes($forename);
		$email = stripslashes($email);
		$town = stripslashes($town);
		$county = stripslashes($county);
		$tel = stripslashes($tel);
		$username = stripslashes($username);
		$password = stripslashes($password);
		
		$surname = mysqli_real_escape_string($conn, $surname );
		$forename = mysqli_real_escape_string($conn, $forename);
		$email = mysqli_real_escape_string($conn, $email);
		$town = mysqli_real_escape_string($conn, $town);
		$county = mysqli_real_escape_string($conn, $county);
		$tel = mysqli_real_escape_string($conn, $tel);
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		
		if (strlen($username) <= 11) {
			if ( is_numeric($tel) ) {
				$query = "SELECT * FROM staff WHERE username = '$username'";
				$valid = mysqli_query($conn, $query);
				
				if (!$valid) {
					$error = "Could not connect to the database!";
				}
				
				if (mysqli_num_rows($valid) == 0 ) {
					$sql = "INSERT INTO staff (forename, surname, username, password, email, town, county, tel)
					VALUES ('$forename', '$surname', '$username', '$password', '$email', '$town', '$county', '$tel');";
					$res = mysqli_query($conn, $sql);
					
					if (!$res) {
						$error = "Error registering....";
					}
					
					if (mysqli_affected_rows($conn) == 1) {
						$success =  "Staff created successfully. Redirecting.....";
						header("refresh:5; url=index.php");
						
						} else {
						$error =  ("Could not register due to system error!");
					}
					
					} else {
					$error = "The user name already exist in the system.";
				}
				
				} else {
				$error = "Telephone number should numeric!";
			}
			
			} else {
			$error = "Username should be <= 11 characters long!";
		}
		
		mysqli_close($conn);
	}
?>