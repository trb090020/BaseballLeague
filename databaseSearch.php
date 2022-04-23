<html>
	<head>
        <title>Search DB for Player</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Search for Player</b></h1><br>
		<div class="login">
			<?php
				$number = $_GET['id'];
				$fname = $_GET['first'];
			?>

			<p class="text"><b>You searched for: </b><?php echo str_repeat('&nbsp;', 2); echo $number; echo str_repeat('&nbsp;', 2); echo $fname; ?></p>

			<?php
				ini_set('display_errors', 'on');
				error_reporting(E_ALL);
				require_once 'config.php';
				$playerName = $_GET['first'];
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

			<form><input type="button" class="right" value="Back" onclick="history.back()"></form>
		</div>
	</body>
</html>
