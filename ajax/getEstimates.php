<?php
	include('../includes/config.php');
	$edit = '';
	$query="SELECT DISTINCT r.rep_id, r.description,  r.model, r.repairdate, r.collectiondate, r.status FROM repairs r WHERE r.status != 'Invoiced' ORDER BY r.rep_id desc";
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
