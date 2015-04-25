<?php
	$success = '';
	$error =  '';
	if (isset($_POST['submit'])) {
		// Define $username and $password
		$surname = $_POST['surname'];
		$forename = $_POST['forename'];
		$town = $_POST['town'];
		$county = $_POST['county'];
		$tel = $_POST['telephone'];
		
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn= mysqli_connect("localhost", "root", "", "compsys");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// To protect MySQL injection for Security purpose
		$surname = stripslashes($surname );
		$forename = stripslashes($forename);
		$town = stripslashes($town);
		$county = stripslashes($county);
		$tel = stripslashes($tel);
		
		$surname = mysqli_real_escape_string($conn, $surname );
		$forename = mysqli_real_escape_string($conn, $forename);
		$town = mysqli_real_escape_string($conn, $town);
		$county = mysqli_real_escape_string($conn, $county);
		$tel = mysqli_real_escape_string($conn, $tel);
		
		
		if ( is_numeric($tel) ) {
			$query = "SELECT * FROM customers WHERE tel = '$tel'";
			$valid = mysqli_query($conn, $query);
			
			if (!$valid) {
				$error = "Could not connect to the database!";
			}
			
			if (mysqli_num_rows($valid) == 0 ) {
				$sql = "INSERT INTO customers (surname, forename, town, county, tel)
				VALUES ('$surname', '$forename', '$town', '$county', '$tel');";
				$res = mysqli_query($conn, $sql);
				
				if (!$res) {
					$error = "Error registering....";
				}
				
				if (mysqli_affected_rows($conn) == 1) {
					$success =  "Customer created successfully. Redirecting.....";
					header("refresh:5; url=customer.php");
					
					} else {
					$error =  ("Could not register due to system error!");
				}
				
				} else {
				$error = "The customer already exist in the system.";
			}
			
			} else {
			$error = "Telephone number should numeric!";
		}
		
		mysqli_close($conn);
	}
?>