<?php
	
    if(isset($_GET['action']) && $_GET['action']=="add"){
		
        $id=intval($_GET['id']);
		
        if(isset($_SESSION['cart'][$id])){
			
            $_SESSION['cart'][$id]['quantity']++;
			
			}else{
			$conn= mysqli_connect("localhost", "root", "", "compsys");
			
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
            $sql_s="SELECT * FROM stock
			WHERE stock_id ={$id}";
            //$query_s=mysql_query($sql_s);
			$res = mysqli_query($conn, $sql_s);
			
			if(mysqli_num_rows($res)!=0) {
                $row_s=mysqli_fetch_array($res);
				
                $_SESSION['cart'][$row_s['stock_id']]=array(
				"quantity" => 1,
				"price" => $row_s['price']
				);
				
				
				} else {
				
                $message="This product id is invalid!";
				
			}
			// Free result set
			mysqli_free_result($res);
			
			mysqli_close($conn);
		}
		
	}
	
?>

<h1>Product List</h1>
<?php
    if(isset($message)){
        echo "<h2>$message</h2>";
	}
?>
<table>
	<tr>
		<th>Stock#</th>
		<th>Description</th>
		<th>Price</th>
		<th>Action</th>
	</tr>
	<?php
		$conn= mysqli_connect("localhost", "root", "", "compsys");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$sql="SELECT * FROM stock ORDER BY stock_id ASC";
		$res = mysqli_query($conn, $sql);
		//$result2 = mysql_query($sql) or die($sql."<br/><br/>".mysql_error());
		
		//$query=mysql_query($sql);
		
		while ($row=mysqli_fetch_array($res)) {
			
		?>
		<tr>
			<td><?php echo $row['stock_id'] ?></td>
			<td><?php echo $row['description'] ?></td>
			<td><?php echo '&euro;' .$row['price'] ?></td>
			<td><a href="index.php?page=products&action=add&id=<?php echo $row['stock_id'] ?>">Add to cart</a></td>
		</tr>
		<?php
			
		}
		
	?>
</table>
