<?php
    //session_start();
    require_once("dbconnect.php");
    if(isset($_GET['page'])){
		
        $pages = array("process/products", "process/cart");
		
        if(in_array($_GET['page'], $pages)) {
			
            $_page = $_GET['page'];
			
			}else{
			
            $_page="products";
			
		}
		
		}else{
		
        $_page="products";
		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/reset.css" />
		<style>
			body {
			font-family: Verdana;
			font-size: 12px;
			color: #444;
			}
			
			
			#container {
			width: 700px;
			margin: 150px auto;
			background-color: #eee;
			overflow: hidden; /* Set overflow: hidden to clear the floats on #main and #sidebar */
			padding: 15px;
			}
			
			#main {
			width: 490px;
			float: left;
			}
			
			#sidebar {
			width: 200px;
			float: left;
			}
			
			a {color: #48577D; text-decoration: none;}
			
			a:hover {text-decoration: underline;}
			
			h1, h2 {margin-bottom: 15px}
			
			h1 {font-size: 18px;}
			h2 {font-size: 16px}
			#main table {
            width: 480px;
			}
			
            #main table th {
			padding: 10px;
			background-color: #48577D;
			color: #fff;
			text-align: left;
            }
			
            #main table td {
			padding: 5px;
            }
            #main table tr {
			background-color: #d3dcf2;
            }
			
		</style>
		
		<title>Shopping cart</title>
		
	</head>
	
	<body>
		
		<div id="container">
			
			<div id="main">
				<?php require($_page.".php"); ?>
				<?php //require($_page.".php"); ?>
			</div><!--end main-->
			
			<div id="sidebar">
				<h1>Cart</h1>
				<?php
					
					if(isset($_SESSION['cart'])){
						$conn= mysqli_connect("localhost", "root", "", "compsys");
						$sql="SELECT * FROM stock WHERE stock_id IN (";
						
						foreach($_SESSION['cart'] as $id => $value) {
								$sql .= $id .",";
						}
						//echo strlen($sql);
						//$sql[39] = ' '; // getting rid of the first comma
						$sql = substr($sql, 0, -1) .") ORDER BY stock_id ASC";

						$res = mysqli_query($conn, $sql);
						
						if (!$res) {
							printf("<h2>Basket is empty.</h2> %s", "<br><strong>Please choose your products from the left!<strong>"); //mysqli_error($conn)
							exit();
						}
						
						while($row=mysqli_fetch_array($res)){
							
						?>
						<p><?php echo $row['description'] ?> x <?php echo $_SESSION['cart'][$row['stock_id']]['quantity'] ?></p>
						<?php
							
						}
					?>
					<hr />
					<a href="index.php?page=cart">Go to cart</a>
					<?php
						
						}else{
						
						echo "<p>Your Cart is empty. Please add some products.</p>";
						
					}
					
				?>
			</div><!--end sidebar-->
			
		</div><!--end container-->
		
	</body>
</html>