<?php
	// Connect to the database server
	if (isset($_POST['record']) and is_numeric($_POST['record'])) {
		
		$dbcnx = mysqli_connect("localhost", "root", "", "compsys");
		if (mysqli_connect_errno($dbcnx ))
		{
			echo "Failed to connect to MySQL: " .mysqli_connect_error();
			exit();
		}
		
		
		$sid = $_POST['record'];
		
		$sql = "SELECT * FROM stock WHERE stock_id=$sid";
		
		$res = mysqli_query($dbcnx, $sql);
		if ( !$res ) {
			echo('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
			exit();
		}
		
		else 
		{
			$row = mysqli_fetch_array($res); 
			$id = $row['stock_id'];
			$description = $row['description'];
			$quantity = $row['quantity'];
			$price = $row['price'];
		}
		//free results
		mysqli_free_result($res);
		
		//close connection
		mysqli_close($dbcnx);
	}
?>