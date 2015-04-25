<?
	$mysqli = mysqli_connect("localhost","root","", "compsys");
	
	if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
?>