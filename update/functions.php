<?php
	// Get Enum Fields
	function enumDropdown($table_name, $column_name, $name)
	{
		$dbcnx = mysqli_connect("localhost", "root", "", "compsys");
		
		$selectDropdown = "<select name=\"$name\">";
		
		$query = "SHOW FIELDS FROM $table_name WHERE Field = '$column_name'";
		
		$result = mysqli_query($dbcnx , $query );
		$row = mysqli_fetch_array($result); //MYSQL_NUM
		#extract the values
		#the values are enclosed in single quotes
		#and separated by commas
		$regex = "/'(.*?)'/";
		preg_match_all( $regex , $row[1], $enum_array );
		$enum_fields = $enum_array[1];	
		
		foreach($enum_fields as $value) {
			$selectDropdown .= "<option value=\"$value\">$value</option>";
		}				
		$selectDropdown .= "</select>";
		mysqli_close($dbcnx);
		
		return $selectDropdown;	
	}
	
	
	function productExists($product_id) {
		$dbcnx = mysqli_connect("localhost", "root", "", "compsys");
		$sql = "SELECT * FROM stock WHERE stock_id = $product_id;";
		$result = mysqli_query($dbcnx , $sql );
		
		return mysqli_num_rows($result) > 0;
	}
	
?>