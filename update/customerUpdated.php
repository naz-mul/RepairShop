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
		
		
		
		$ud_id=$_POST['ud_id'];
		$ud_name=$_POST['ud_surname'];
		$ud_forename=$_POST['ud_forename'];
		$ud_town=$_POST['ud_town'];
		$ud_county=$_POST['ud_county'];
		$ud_tel = $_POST['ud_tel'];
		
		$sql = "UPDATE customers SET surname ='$ud_name', forename ='$ud_forename', town = '$ud_town', county = '$ud_county', tel = '$ud_tel' WHERE cust_id=$ud_id";
		
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
				header("refresh:2; url=customer.php");
			}
			else
			{
				$success =  "<br><p><em>Customer details have been updated successfully! Redirecting....</em></p>";
				header("refresh:2; url=customer.php");
			}
			
			
			
			//Display the results again
			
			
			$sql="SELECT * FROM customers WHERE cust_id = $ud_id";
			
			$res = mysqli_query($dbcnx, $sql);
			if ( !$res ) {
				$error = ('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
				exit();
			}
			
			else 
			{
				$row = mysqli_fetch_array($res); 
				$id = $ud_id;
				$surname = $row['surname'];
				$forename = $row['forename'];
				$town = $row['town'];
				$county = $row['county'];
				$tel = $row['tel'];
			}
			//free results
			mysqli_free_result($res);
			
			
			
			//close the connection
			mysqli_close($dbcnx);
			
		}
	}
?>




