<!DOCTYPE html>
<html>
	<head>
        <title>Change Player's Name</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Change Player's Name</b></h1><br>
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
				$playerName = $_GET['newFirst'];
				$id = $_GET['id'];
									
				try {
					$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
					
					// Make a database connection using info from config.php
					if ($PGDB) 
					{
						?>
							<p class="text">-Successfully connected to remote database-</p>
						<?php
					}
				} 
				catch (PDOException $e) 
				{
					die($e->getMessage());
				}

				$udpate_result = pg_query($PGDB, "UPDATE Player SET first_name='$playerName'  WHERE ID='$id'");

				if($udpate_result) 
				{
					$user_result = pg_query($PGDB, "SELECT * FROM Player WHERE ID='$id'");
					$row = pg_fetch_assoc($user_result);

					$id = $row["id"];
					$fname = $row["first_name"];
					$lname = $row["last_name"];

					?>
						<br>
						<p class="text">Updated Player: <?php echo str_repeat('&nbsp;', 2); echo $id; echo str_repeat('&nbsp;', 3); echo $fname; echo str_repeat('&nbsp;', 3); echo $lname; ?></p>
					<?php
				}
				else
				{
					echo "Failed to update";
				}
			?>
			<form><input type="button" class="right" value="Back" onclick="history.back()"></form>
		</div>
	</body>
</html>
