<?php
 
	$dataPoints = array();
	//$dataPoints2 = array();

    //$result = pg_query($PGDB, "SELECT DISTINCT DATE(gdate) FROM AB WHERE PID='$id' ORDER by gdate DESC");
	$result = pg_query($PGDB, "SELECT DISTINCT DATE(gdate) , AVG(strikeCount) as avgStrike FROM ( SELECT gdate , sum(strikes) AS strikeCount FROM AB GROUP BY gdate) AS foo GROUP BY gdate   ");
	//$result2 = pg_query($PGDB, "SELECT DISTINCT DATE(gdate), AVG(strikeCount) as avgStrike FROM ( SELECT gdate, sum(strikes) AS strikeCount FROM AB GROUP BY gdate) GROUP BY gdate ");
	
    foreach($result as $row){
        array_push($dataPoints, array("gdate"=> $row->x, "avgStrike"=> $row->y));
    }
	


	
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Search DB for Player</title>
        <link rel="stylesheet" type="text/css" href="style.css">
		<script>
		window.onload = function () {
		
		var chart = new CanvasJS.Chart("graphContainer", {
			title: {
				text: "Date"
			},
			axisY: {
				title: "Strikes"
			},
			data: [{
				type: "line",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		
		}
		</script>
    </head>
	<body>
		<h1><b>Search for Player</b></h1><br>
		<div class="login">
			<?php
				$number = $_GET['id'];
				$fname = $_GET['first'];
			?>

			<p class="text"><b>You searched for: </b><?php echo str_repeat('&nbsp;', 2); echo $number; echo str_repeat('&nbsp;', 2); echo $fname; ?></p>
			<div id="graphContainer" style="height: 400px; width: 100%;"></div>
			<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
			<?php
				ini_set('display_errors', 'on');
				error_reporting(E_ALL);
				require_once 'config.php';
				$playerName = $_GET['first'];
				$id = $_GET['id'];
				
				$result = pg_query($PGDB, "SELECT * FROM Player WHERE first_name='$playerName' or ID='$id'");
				$numRows = pg_num_rows($result);
				if ($result) {
					if($numRows > 0) 
					{
						while($row = pg_fetch_assoc($result)) {
							$resultID = $row["id"];
							$resultPlayerFName = $row["first_name"];
							$resultPlayerLName = $row["last_name"];

							?>
								<p class="text"><b>ID: </b><?php echo str_repeat('&nbsp;', 2); echo $resultID; ?></p>
								<p class="text"><b>First Name: </b><?php echo str_repeat('&nbsp;', 2); echo $resultPlayerFName; ?></p>
								<p class="text"><b>Last Name: </b><?php echo str_repeat('&nbsp;', 2); echo $resultPlayerLName; ?></p>
							<?php

							// printf("ID: %d First name: %s, Last Name: %s\n", $row["id"], $row["first_name"], $row["last_name"]);
						}
					}
					else
					{
						?>
							<p class="text">Player not found.</p>
						<?php
					}
				}
				else {
					echo "Query failed";
				}
			?>

			<input type="button" class="right" value="Back" onclick="history.back()">
		</div>
	</body>
</html>
