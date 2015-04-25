<?php
	include('../includes/config.php');
	$edit = '';
	$query="SELECT DISTINCT c.cust_id, c.surname, c.forename, c.town, c.county, c.tel FROM customers c ORDER BY c.cust_id";
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
