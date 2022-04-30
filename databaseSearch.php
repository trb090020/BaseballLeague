<?php
 
	$dataPoints = array();
	$dataPoints2 = array();

 
	$result = pg_query($PGDB, "SELECT DISTINCT DATE(gdate) as bdate , AVG(strikeCount) as avgStrike FROM ( SELECT gdate , sum(strikes) AS strikeCount FROM AB GROUP BY gdate) AS foo GROUP BY gdate   ");
	$result2 = pg_query($PGDB, "SELECT DISTINCT DATE(gdate) as bdate , AVG(ballCount) as avgBall FROM ( SELECT gdate , sum(balls) AS ballCount FROM AB GROUP BY gdate) AS foo GROUP BY gdate   ");
	
    foreach($result as $row){
	console.log($row["bdate"]);
	console.log($row["avgStrike"]);
        array_push($dataPoints, array("x"=> $row["bdate"], "y"=> $row["avgStrike"]));
    }
    foreach($result2 as $row){
        array_push($dataPoints, array("x"=> $row["bdate"], "y"=> $row["avgBall"]));
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
				text: "Pitcher"
			},
			axisY: {
				title: "Strikes"
			},
			axisX: {
				title: "Date"
			},
			data: [{
				type: "line",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		var chart2 = new CanvasJS.Chart("graphContainer2", {
			title: {
				text: "Batter"
			},
			axisY: {
				title: "balls"
			},
			data: [{
				type: "line",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});	       
		chart.render();
		chart2.render();
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
			<div id="graphContainer2" style="height: 400px; width: 100%;"></div>
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
