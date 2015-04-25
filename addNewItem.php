<?php
	$success = '';
	$error =  '';
	if (isset($_POST['submit'])) {
		// Define $username and $password
		$description = $_POST['description'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn= mysqli_connect("localhost", "root", "", "compsys");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// To protect MySQL injection for Security purpose
		$description = stripslashes($description);
		$quantity = stripslashes($quantity);
		$price = stripslashes($price);
		
		$description = mysqli_real_escape_string($conn, $description);
		$quantity = mysqli_real_escape_string($conn, $quantity);
		$price = mysqli_real_escape_string($conn, $price);
		
		
		if ( is_numeric($price) ) {
			$query = "SELECT * FROM stock WHERE description = '$description'";
			$valid = mysqli_query($conn, $query);
			
			if (!$valid) {
				$error = "Could not connect to the database!";
			}
			
			if (mysqli_num_rows($valid) == 0 ) {
				$sql = "INSERT INTO stock (description, quantity, price)
				VALUES ('$description', '$quantity', '$price');";
				$res = mysqli_query($conn, $sql);
				
				if (!$res) {
					$error = "Error adding....";
				}
				
				if (mysqli_affected_rows($conn) == 1) {
					$success =  "New item has been added successfully to the inventory. Redirecting.....";
					header("refresh:5; url=inventory.php");
					
					} else {
					$error =  ("Could not add due to system error!");
				}
				
				} else {
				$error = "The item already exist in the system.";
			}
			
			} else {
			$error = "Price should be numeric!";
		}
		
		mysqli_close($conn);
	}
?>