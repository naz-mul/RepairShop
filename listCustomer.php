<?php
	$conn = mysqli_connect("localhost","root","", "compsys");
	
	if(!$conn) {
		die("Could not connect to the database" .mysqli_connect_errno()) ;
	}
	
	$query= "SELECT * FROM customers ORDER BY surname";
	
	$result = mysqli_query($conn, $query);	
	
	if (!$result) {
		$error = "No customer was found in the database!";
	}
	
	while($data = mysqli_fetch_row($result)) {
		echo("<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td></tr>");
	}
?>