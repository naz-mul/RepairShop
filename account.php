<?php
	require_once('session.php');
?>

<!DOCTYPE html>
<html ng-app="myApp" ng-app lang="en">
	<head>
		<title>PC Solutions - Account</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta charset="utf-8">
		<meta name="description" content="Lakeside Books">
		<meta name="keywords" content="books, lakeside, cork, shop, online">
		
		<link rel="shortcut icon" href="favicon.ico"> 
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/global.css">
		
		<link rel="stylesheet" href="css/menu.css" />
		<script src="js/modernizr.custom.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			ul>li, a{cursor: pointer;}
		</style>
		
		<style>@import url(http://fonts.googleapis.com/css?family=Raleway:400,700); </style>
		
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		
	</head>
	
	<body id="top" style="font-size: 62.5%;">
		<!-- BEGIN Header -->
		<header id="header-wrapper">
			
			<div id="top-bar" class="clearfix">
				
				<div id="top-bar-inner">
					
					<!-- Search Bar by http://www.paulund.co.uk/create-a-slide-out-search-box -->
					<div class="search_form">
						<form action="customer-search.php" method="post">
							<input type="text" name="search_box" id="search_box" placeholder="Search for a customer...">
						</form>
					</div>
					<!-- Search Bar by http://www.paulund.co.uk/create-a-slide-out-search-box -->
					
					
					<div class="topbar-right clearfix">
						
						<ul class="clearfix">
							<li class="login-user">
								<a title="<?php echo $login_session; ?>" href="account.php">
									<span class="icon"><i aria-hidden="true" class="icon-user"></i></span>
									<?php echo $login_session; ?>
								</a>
							</li>
						</ul>
						
						<div class="log-out">
							<!-- <p><a title="Sign out" href="#">Sign out</a></p> -->
							<p>
								<a href="logout.php" title="Sign out">
									<span>Sign-out</span>
									<span class="icon"> 
										<i aria-hidden="true" class="icon-exit"></i>
									</span>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="full-shadow"></div>
			
			
		</header>
		<!-- END Header -->
		
		
		<div class="main clearfix">
			
			<!-- START OF NAVIGATION -->
			<nav id="menu" class="nav">					
				<ul>
					<li>
						<a href="dashboard.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-home"></i>
							</span>
							<span>Home</span>
						</a>
					</li>
					<li>
						<a href="customer.php">
							<span class="icon"> 
								<i aria-hidden="true" class="icon-users"></i>
							</span>
							<span>Customers</span>
						</a>
					</li>
					<li>
						<a href="repairs.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-hammer"></i>
							</span>
							<span>Repairs</span>
						</a>
					</li>
					<li>
						<a href="estimates.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-sigma"></i>
							</span>
							<span>Estimates</span>
						</a>
					</li>
					<li>
						<a href="inventory.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-barcode"></i>
							</span>
							<span>Inventory</span>
						</a>
					</li>
					<li class="active">
						<a href="account.php">
							<span class="icon">
								<i aria-hidden="true" class="icon-user"></i>
							</span>
							<span>Account</span>
						</a>
					</li>
				</ul>
			</nav>
			<!-- END OF NAVIGATION -->
			
			
			<!--Breadcrumb -->
			<div class="bread">
				<div class="submenu">
					<ul>
						<li id="back" value="Update Inventory">Update Account Details</li>
					</ul>
				</div>
				<h3>Account</h3>
			</div>
			<!--Breadcrumb -->
			
			
			<div class="floats">
				<div class=" full-widget">
					<?php
						$staff = '';
						$conn= mysqli_connect("localhost", "root", "", "compsys");
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}
						
						$query = "SELECT * FROM staff WHERE staff_id = $login_id";
						
						$result= mysqli_query($conn, $query);
						
						if (!$result) {
							$error = "Could not connect to the database!";
						}
						
						if(mysqli_num_rows($result) == 0) {
							$error = "<ul> <li>Sorry, your search query (\"" .$name ."\") did not find any results!</li></ul>";
						}
						//-create  while loop and loop through result set
						while($row = mysqli_fetch_array($result)){
							$ID = $row['staff_id'];
							$firstname  =$row['forename'];
							$lastname=$row['surname'];
							$town = $row['town'];
							$county = $row['county'];
							$tel = $row ['tel'];
							
							//-display the result of the array
							$staff = "<ul><h1><li>" .$firstname . " " . $lastname .  "</li><li> "   .$town . "</li><li> "   .$county . "</li><li> "   .$tel . "</li></h1></ul>";
							echo $staff;
						}
						mysqli_close($conn);

				?>
				
			</div> 
			<!-- END OF FULL WIDGET-->
		</div> 
		<!-- END OF FLOATS-->
	</div>
	<!-- END OF MAIN-->
	
	<!-- SCRIPT FOR THE MENU -->
	<script src="js/menu.js"></script>
	<!-- SCRIPT FOR THE MENU --> 
	
</body>

</html>