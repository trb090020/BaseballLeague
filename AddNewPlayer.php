<!DOCTYPE html>
<html>
	<head>
        <title>Add New Player</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Add New Player</b></h1><br>
		<div class="login">
			<?php
				ini_set('display_errors', 'on');
				error_reporting(E_ALL);
				require_once 'config.php';

				$fname = $_GET["fname"];
				$lname = $_GET["lname"];
				$team = $_GET["team"];
				$throwing = $_GET["throwing"];
				$batting = $_GET["batting"];
				$dob = $_GET["dob"];

				$result = pg_query($PGDB, "INSERT INTO Player (first_name, last_name, team, throwing_hand, batting_hand, dob) VALUES
					('$fname', '$lname', '$team', '$throwing', '$batting', '$dob')");

				if($result) 
				{
					?>
						<br>
						<p class="text">New Player:</p>
						<p class="text">Name: <?php echo str_repeat('&nbsp;', 2); echo $fname; echo str_repeat('&nbsp;', 1); echo $lname; ?></p>
						<p class="text">Team: <?php echo str_repeat('&nbsp;', 2); echo $team; ?></p>
						<p class="text">Throwing Hand: <?php echo str_repeat('&nbsp;', 2); echo $throwing; ?></p>
						<p class="text">Batting Hand: <?php echo str_repeat('&nbsp;', 2); echo $batting; ?></p>
						<p class="text">Date of Birth: <?php echo str_repeat('&nbsp;', 2); echo $dob; ?></p>
					<?php
				}
				else
				{
					echo "Failed to add player";
				}
			?>
			<input type="button" class="right" value="Back" onclick="history.back()">
		</div>
	</body>
</html>
