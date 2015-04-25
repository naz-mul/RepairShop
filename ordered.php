<?php
	if(isset($_POST['order'])) {
		$dbcnx = mysqli_connect("localhost", "root", "", "compsys");
		$ordcnx = mysqli_connect("localhost", "root", "", "compsys");
		
		$staff = $login_id;
		$repair = $_POST['rep_id'];
		
		$checkorder = "SELECT * FROM orders";
		$valid = mysqli_query($ordcnx, $checkorder);
		
		if (!$valid) {
			$error = "Could not connect to the database!";
		}
		
		
		$insertorder = "INSERT INTO orders (rep_id, staff_id)
		VALUES ('$repair', '$staff');";
		$result = mysqli_query($ordcnx, $insertorder);
		
		if (!$result) {
			$error = "Error ordering....";
		}
		
		if (mysqli_affected_rows($ordcnx) == 1) {
			//GET THE LAST ORDER ID
			$ord_id = mysqli_insert_id($ordcnx);
			
			//RETRIEVE THE ITEMS FROM THE SESSION
			$sql="SELECT * FROM stock WHERE stock_id IN (";
			
			foreach($_SESSION['cart'] as $id => $value) {	
				$sql .= $id .",";
			}
			
			//$sql[37] = ' ';  
			$sql=substr($sql, 0, -1) .") ORDER BY stock_id ASC";
			//$query=mysql_query($sql);
			
			$res = mysqli_query($dbcnx, $sql);
			if (!$res) {
				exit();
			}
			
			$totalprice = 0;
			while($row = mysqli_fetch_array($res)) {
				$subtotal = $_SESSION['cart'][$row['stock_id']]['quantity']*$row['price'];
				$totalprice += $subtotal;
				
				$quantity = $_SESSION['cart'][$row['stock_id']]['quantity'];
				$price = $row['price'];
				$stock_id = $row['stock_id'];
				
				echo "      " .$ord_id;
				echo "      " . $stock_id;
				echo "      " .$quantity;
				echo "      " . $totalprice .'<br>';
				$values = " ";
			}
			
			//NOW INSERT
			$checkitems = "SELECT * FROM orderitems";
			$val = mysqli_query($dbcnx, $checkitems);
			
			if(!$val) {
				$error = "Couldn't connect to the database!";
			}
			
			$insertitems = "INSERT INTO orderitems (ord_id, stock_id, quantity)
			VALUES('$ord_id', '$stock_id', '$quantity');";
			
			
			//header("refresh:5; url=customer.php");
			} else {
			$error =  "Could not order due to system error!";
		}
		
		//close connection
		mysqli_close($dbcnx);
		mysqli_close($ordcnx);
	}
	
?>