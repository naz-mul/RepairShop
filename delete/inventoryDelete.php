<?php
	$deleted = '';
	$notDeleted = '';
	
	if (isset($_POST['delete'])) {
		$stockid = $_POST['stock_id'];
		
		if ($stockid == '' or !is_numeric($stockid))
		{
			$notDeleted = ("<p><em>You did not complete the delete form correctly</em></p>\n");
		} 
		else
		{
			$dbcnx = mysqli_connect("localhost", "root", "", "compsys");
			if (mysqli_connect_errno($dbcnx )){
				$notDeleted = "Failed to connect to MySQL: " .mysqli_connect_error();
			exit();}
			
			$sql = "DELETE from stock WHERE stock_id = $stockid";
			$res = mysqli_query($dbcnx, $sql);
			if($res) {
				$count = mysqli_affected_rows($dbcnx);
			}
			if($count>0){
				
				$deleted = ("<br><br><p><em>Stock no. " . " ". $stockid. " " . "has been deleted successfully\n</em></p><br>");
			}
			else{
				
				$notDeleted = "<br><br><p><em>Deleting stock was unsuccessful. Please enter valid Stock ID!</em></p><br>";
			}
			
			mysqli_close($dbcnx);	
			
		}
	}
?>