<!DOCTYPE html>
<html>
	<head>
		<title>Active Roster</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1><b>Active Roster</b></h1><br>
		<div class="login">
			<?php
				require_once 'config.php';

				try {
					$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
					
					// Make a database connection using info from config.php
					if ($PGDB) 
					{
						?>
							<p class="text"><b>Roster:</b></p>
							<p class="text"><b>Team <?php echo str_repeat('&nbsp;', 3); ?> First Name <?php echo str_repeat('&nbsp;', 3); ?> Last Name</b></p>
						<?php
					}
				} 
				catch (PDOException $e) 
				{
					die($e->getMessage());
				}

				// Perform SQL query
				$result = pg_query($PGDB, "SELECT * FROM Player");

				// Printing results
				if($result)
				{
					while($row = pg_fetch_assoc($result))
					{
						$team = $row["team"];
						$fname = $row["first_name"];
						$lname = $row["last_name"];

						?>
							<p class="text"><?php echo $team; echo str_repeat('&nbsp;', 8); echo $fname; echo str_repeat('&nbsp;', 18); echo $lname; ?></p>
						<?php
					}
				}

			?>
			<input type="button" class="right" value="Back" onclick="history.back()">
		</div>
    </body>
</html>