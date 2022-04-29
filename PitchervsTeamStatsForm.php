<!DOCTYPE html>
<html>
		<head>
        <title>Search DB for Player</title>
        <link rel="stylesheet" type="text/css" href="style.css">
		</head>
			<body>
				<h1><b>Pitcher vs. Team Statistics</b></h1><br>
					<div class="login">
					
						<form action="PitchervsTeamStats.php" method="get">
								<label>
								<b>Pitcher's ID</b>
								</label>
							<input type="number" name="id" id="Pass" placeholder="6">
							<br><br>
								<label>
								<b>vs. Team</b>
								</label>
							<input type="text" name="team" id="Input" placeholder="HOU">
							<br><br>
							<button name="search" id="login"> Search </button>
							<input type="button" class="right" value="Back" onclick="history.back()">
						</form>
					</div>	<br>
			
			<hr size="1" width="100%" color="black">
			
				<section>
					<h2>Pitcher Roster</h2>
					<!-- TABLE CONSTRUCTION-->
					<table class="center">
						<tr>
							<th>Last Name</th>
							<th>First Name</th>
							<th>ID</th>
							<th>Throwing Hand</th>
							<th>Batting Hand</th>
							<th>Team</th>
							<th>DOB</th>
						</tr>
						
					<?php
							require_once 'config.php';

							try 
							{$dsn = "pgsql:host=$host;port=5432;dbname=$db;";} 
							catch (PDOException $e) 
							{die($e->getMessage());}

							$result = pg_query($PGDB, "SELECT  last_name,first_name,id, throwing_hand, batting_hand, team, dob FROM public.allpitchers ORDER BY last_name");
					?>

							<!-- PHP CODE TO FETCH DATA FROM ROWS-->
					<?php 
							while ($rows = pg_fetch_assoc($result))
							{
					?>
						
						<tr>
							<!--FETCHING DATA FROM EACH 
								ROW OF EVERY COLUMN-->
							<td><?php echo $rows['last_name']; ?></td>
							<td><?php echo $rows['first_name']; ?></td>
							<td><?php echo $rows['id']; ?></td>
							<td><?php echo $rows['throwing_hand']; ?></td>
							<td><?php echo $rows['batting_hand']; ?></td>
							<td><?php echo $rows['team']; ?></td>
							<td><?php echo $rows['dob']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
				</section>
				
			</body>
  
</html>
