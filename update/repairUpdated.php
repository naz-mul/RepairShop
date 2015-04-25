<?php
	// Connect to the database server
	$success = '';
	$error =  '';
	
	if (isset($_POST['submit'])) {
		
		$dbcnx = mysqli_connect("localhost", "root", "", "compsys");
		
		if (mysqli_connect_errno($dbcnx )) {
			$error = "Failed to connect to MySQL: " .mysqli_connect_error();
			exit();
		}
		
		
		$id = $_POST['ud_id'];
		$description = $_POST['ud_description'];
		$device = $_POST['ud_device'];
		$brand = $_POST['ud_brand'];
		$model = $_POST['ud_model'];
		$os = $_POST['ud_os'];
		$status = $_POST['ud_status'];
		
		$sql = "UPDATE repairs SET description = '$description',  devicetype = '$device', brand = '$brand', model = '$model', os = '$os', status = '$status' WHERE rep_id = $id";
		
		$res = mysqli_query($dbcnx, $sql);	
		if ( !$res ) {
			$error = ('Query failed ' . $sql . ' Error:' . mysqli_error());
			exit();
		}
		
		else
		{
			//echo $res;
			if(mysqli_affected_rows($dbcnx)< 1){
				
				$error = "<br><br><p><em>You have not amended anything! Redirecting....</em></p>";  
				header("refresh:2; url=repairs.php");
			}
			else
			{
				$success =  "<br><p><em>Repair details have been updated successfully! Redirecting....</em></p>";
				header("refresh:2; url=repairs.php");
			}
			
			
			if ( isset($_POST['submit']) ) {
				//Display the results again
				$sql="SELECT * FROM repairs WHERE rep_id = $id";
				
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
			}
			//free results
			mysqli_free_result($res);
			
			//close the connection
			mysqli_close($dbcnx);
			
		}
	}
?>	