<!DOCTYPE html>
<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1><b>Database Status</b></h1><br>
		<div class="login">
			<p class="text"><i>Is this thing on?</i></p>

			<?php
				require_once 'config.php';

				try {
					$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
					
					// Make a database connection
					$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

					if ($pdo) 
					{
						// HTML output
						?>
							<p class="text">Connected to the database successfully!</p>
						<?php
					}
				} 
				catch (PDOException $e) 
				{
					die($e->getMessage());
				}

				$DBName = pg_dbname();

				// HTML output with PHP variable
				?>
					<p class="text">Database name: <?php echo $DBName; ?></p>
				<?php
			?>

		</div>
    </body>
</html>
