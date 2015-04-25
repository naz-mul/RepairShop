<?php
	require('addNewStaff.php'); //includes adding new staff script
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PC Solutions - Register</title>
		<link rel="shortcut icon" href="favicon.ico"> 
		
		<link rel="stylesheet" href="css/global.css">	
        <link rel="stylesheet" href="css/login.css" />
	
		<script src="js/modernizr.custom.63321.js"></script>
		
		<style>
			@import url(http://fonts.googleapis.com/css?family=Raleway:400,700);		
		</style>
	</head>
	
	<body>
		<div class="container">
			<div class="rect reg">
				<img src="images/logo-pcs.jpg">
				<form class="form-4" method="POST" action="">
					<h1>Register / <span class="reg"><a href="index.php">Login</a></span></h1>
						<span id="error"><?php echo $error; ?></span>
						<span id="error"><?php echo $success; ?></span>
						<label for="surname">surname</label>
						<input type="text" name="surname" placeholder="Surname" required>
						
						<label for="forename">forename</label>
						<input type="text" name="forename" placeholder="Forename" required>
						
						<label for="email">email</label>
						<input type="text" name="email" placeholder="Email" required>
						
						<label for="town">town</label>
						<input type="text" name="town" placeholder="Town">
						
						<label for="county">county</label>
						<input type="text" name="county" placeholder="County">
						
						<label for="telephone">telephone</label>
						<input type="text" name="telephone" placeholder="Telephone/Mobile">
						
						<label for="login">username</label>
						<input type="text" name="username" placeholder="Username" required>
					
						<label for="password">password</label>
						<input type="password" name="password" placeholder="Password" required> 

						<input type="submit" name="submit" value="Register">
					     
				</form>
				
			</div>
		</div>
	</body>
	
</html> 