<!DOCTYPE html>
<html>
	<head>
        <title>Update Player's Information</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Update Player's Information</b></h1><br>
		<div class="login">
			<?php
				$number = $_GET['id'];
				$fname = $_GET['oldFirst'];
			?>

			<p class="text"><b>You're updating: </b><?php echo str_repeat('&nbsp;', 2); echo $number; echo str_repeat('&nbsp;', 2); echo $fname; ?></p>

			<?php
				ini_set('display_errors', 'on');
				error_reporting(E_ALL);
				require_once 'config.php';
				$id = $_GET['id'];
				$playerFName = $_GET['newFirst'];
				$playerLName = $_GET['newLast'];
				$team = $_GET['newTeam'];
				$batting = $_GET['newBat'];
				$throwing = $_GET['newThrow'];
				$dob = $_GET['newDOB'];

				$udpate_result = pg_query($PGDB, "UPDATE Player SET first_name='$playerFName', last_name='$playerLName', team='$team', batting_hand='$batting', throwing_hand='$throwing', dob='$dob'  WHERE ID='$id'");

				if($udpate_result) 
				{
					$user_result = pg_query($PGDB, "SELECT * FROM Player WHERE ID='$id'");
					$row = pg_fetch_assoc($user_result);

					$id = $row["id"];
					$fname = $row["first_name"];
					$lname = $row["last_name"];
					$team = $row['team'];
					$batting = $row['batting_hand'];
					$throwing = $row['throwing_hand'];
					$dob = $row['dob'];

					?>
						<br>
						<p class="text">Updated Player: <?php echo str_repeat('&nbsp;', 2); echo $id; echo str_repeat('&nbsp;', 1); echo $fname; echo str_repeat('&nbsp;', 1); echo $lname; echo str_repeat('&nbsp;', 1); echo $team; echo str_repeat('&nbsp;', 1); echo $batting; echo str_repeat('&nbsp;', 1); echo $throwing; echo str_repeat('&nbsp;', 1); echo $dob;?></p>
					<?php
				}
				else
				{
					echo "Failed to update";
				}
			?>
			<input type="button" class="right" value="Back" onclick="history.back()">
		</div>
	</body>
</html>
