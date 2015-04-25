<?php
	require_once('update/functions.php');
	// Connect to the database server
	if (isset($_POST['record']) and is_numeric($_POST['record'])) {
		
		$dbcnx = mysqli_connect("localhost", "root", "", "compsys");
		if (mysqli_connect_errno($dbcnx ))
		{
			echo "Failed to connect to MySQL: " .mysqli_connect_error();
			exit();
		}
		
		
		$id = $_POST['record'];
		
		$sql="SELECT * FROM repairs WHERE rep_id=$id";
		
		$res = mysqli_query($dbcnx, $sql);
		if ( !$res ) {
			echo('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
			exit();
		}
		
		else 
		{
			$row = mysqli_fetch_array($res); 
			$cust_id = $row['Cust_ID'];
			$staff_id = $row['Staff_ID'];
			$brand = $row['Brand'];
			$model = $row['Model'];
			$description = $row['Description'];
		}
		

			//free results
			mysqli_free_result($res);
			
			//close connection
			mysqli_close($dbcnx);
		}
	?>			