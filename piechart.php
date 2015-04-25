<?php
	date_default_timezone_set('Europe/Dublin');
	//include database connection
	$conn= mysqli_connect("localhost", "root", "", "compsys");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	//query all records from the database
	/* For this to work I had to create a view in the database
		* 	SELECT status, COUNT(status) AS total
		FROM Repairs
		WHERE month(repairDate) = EXTRACT(month FROM (NOW()))
		GROUP BY status
		ORDER BY repairDate DESC;
	*/
	$query = "select * from monthlyrepairs";
	
	//execute the query
	
	$result= mysqli_query($conn, $query);
	
	//get number of rows returned
	//$num_results = $result->num_rows;
	
	if( mysqli_num_rows($result) > 0){
		
	?>
	<!-- load api -->
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	
	<script type="text/javascript">
		//load package
		google.load('visualization', '1', {packages: ['corechart']});
	</script>
	
	<script type="text/javascript">
		function drawVisualization() {
			// Create and populate the data table.
			var data = google.visualization.arrayToDataTable([		
			['Status', 'Total'],
			<?php
				while( $row = $result->fetch_assoc() ){
					extract($row);
					echo "['{$status}', {$total}],";
				}
			?>
			]);
			
			var options = {
				title: '<?php echo "FROM " .date('01 F Y')  ." until " .date('h:i:s a', time()) ." NOW."?>',
				is3D: 'true',
				pieSliceText: 'value',
				slices: {  7: {offset: 0.2},
                 
				},
				legend: {position: 'left', textStyle: {color: '#3f3f3f', fontSize: 12}}
			};
			// Create and draw the visualization.
			new google.visualization.PieChart(document.getElementById('pie_chart')).
			// {title:"<?php echo "FROM " .date('01 F Y')  ." until " .date('h:i:s a', time()) ." NOW."?>"}
			draw(data, options);
		}
		
		google.setOnLoadCallback(drawVisualization);
	</script>
	<?php
		
		}else{
		$title = "No programming languages found in the database.";
	}
?>