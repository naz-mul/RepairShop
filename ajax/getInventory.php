<?php
	include('../includes/config.php');
	$edit = '';
	$query="SELECT DISTINCT s.stock_id, s.description, s.quantity, s.price FROM stock s ORDER BY s.stock_id asc";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	
	$arr = array();
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$arr[] = $row;	  
		}
	}
	# JSON-encode the response
	$json_response = json_encode($arr);
	
	// # Return the response
	echo $json_response;
?>
