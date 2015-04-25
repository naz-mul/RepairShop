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
		$quantity = $_POST['ud_quantity'];
		$price = $_POST['ud_price'];
		
		if (is_numeric($price) ) {
			$sql = "UPDATE stock SET description ='$description', quantity = '$quantity', price = '$price' WHERE stock_id=$id";
			
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
					header("refresh:2; url=inventory.php");
				}
				else
				{
					$success =  "<br><p><em>Stock details have been updated successfully! Redirecting....</em></p>";
					header("refresh:2; url=inventory.php");
				}
				
				
				
				//Display the results again
				$sql="SELECT * FROM stock WHERE stock_id = $id";
				
				$res = mysqli_query($dbcnx, $sql);
				if ( !$res ) {
					$error = ('Query failed ' . $sql . ' Error:' . mysqli_error($dbcnx));
					exit();
				}
				
				else 
				{
					$row = mysqli_fetch_array($res); 
					$id = $_POST['ud_id'];
					$description = $_POST['ud_description'];
					$quantity = $_POST['ud_quantity'];
					$price = $_POST['ud_price'];
				}
				//free results
				mysqli_free_result($res);
				
				
				
				//close the connection
				mysqli_close($dbcnx);
				
			}
			
			} else {
			$error = "Price should be numeric!";
		}
	}
?>