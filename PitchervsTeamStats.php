<!DOCTYPE html>
<html>
	<head>
        <title>Update Player's Information</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Pitcher vs. Team Statistics</b></h1><br>
		<div class="login">
			<?php
				$id = $_GET['id'];
				$team = $_GET['team'];
			?>
			
			<?php
				$pitcherfname = pg_query($PGDB, "SELECT  first_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
				$pitcherlname = pg_query($PGDB, "SELECT  last_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
			?>
			<hr size="1" width="100%" color="black">

			<p class="text"><b>All-Time Statistics:</b><?php &nbsp; echo $pitcherfname;&nbsp;echo $pitcherlname;&nbsp;?><b>vs.</b> <?php &nbsp;echo $team;?></p>
			<section>
					<!-- TABLE CONSTRUCTION-->
					<table class="center">
						<tr>
							<th>Average Strikes/AB</th>
							<th>Average Balls/AB</th>
							<th>Average Bases/AB</th>
							<th>At Bats</th>
							<th>Hit %</th>
							<th>Strikeout %</th>
						</tr>
						<?php
							require_once 'config.php';

							try 
							{$dsn = "pgsql:host=$host;port=5432;dbname=$db;";} 
							catch (PDOException $e) 
							{die($e->getMessage());}

				
						$result = pg_query($PGDB, "SELECT 
											ROUND(AVG(strikes),2) AS Strikes,
											ROUND(AVG(balls),2) AS Balls,
											ROUND(AVG(bases),2) AS Bases,
											COUNT(*) AS AtBatCount,
											COUNT(case when abresult='H' then 1 end) as Hits,
											COUNT(case when abresult='O' then 1 end) as StrikeOuts,
											ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS percentHits,
											ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS PercentStrikeOuts
											FROM atbatdetails
											WHERE atbatdetails.pid = '$id'
											AND atbatdetails.batterteam = '$team';");
					?>
							<!-- PHP CODE TO FETCH DATA FROM ROWS-->
					<?php 
							while ($rows = pg_fetch_assoc($result))
							{
					?>
						<tr>
							<!--FETCHING DATA FROM EACH 
								ROW OF EVERY COLUMN-->
							<td><?php echo $rows['strikes']; ?></td>
							<td><?php echo $rows['balls']; ?></td>
							<td><?php echo $rows['bases']; ?></td>
							<td><?php echo $rows['atbatcount']; ?></td>
							<td><?php echo $rows['percentHits']; ?></td>
							<td><?php echo $rows['PercentStrikeOuts']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
			</section>
				
			<hr size="1" width="100%" color="black">
			<h2><b>Pitcher vs. Team Statistics (Last 10 Games)</b></h2><br>	
			<p class="text"><b>Statistics For Last 10 Games:</b><?php &nbsp; echo $pitcherfname;&nbsp;echo $pitcherlname;&nbsp;?><b>vs.</b> <?php &nbsp;echo $team;?></p>
			<section>
					<!-- TABLE CONSTRUCTION-->
					<table class="center">
						<tr>
							<th>Average Strikes/AB</th>
							<th>Average Balls/AB</th>
							<th>Average Bases/AB</th>
							<th>At Bats</th>
							<th>Hit %</th>
							<th>Strikeout %</th>
						</tr>
						
					<?php	
						$result2 = pg_query($PGDB,  "SELECT 
													ROUND(AVG(strikes),2) AS Strikes,
													ROUND(AVG(balls),2) AS Balls,
													ROUND(AVG(bases),2) AS Bases,
													COUNT(*) AS AtBatCount,
													COUNT(case when abresult='H' then 1 end) as Hits,
													COUNT(case when abresult='O' then 1 end) as StrikeOuts,
													ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS percentHits,
													ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS PercentStrikeOuts
													FROM atbatdetails
													WHERE atbatdetails.pid = '$id' AND 
													atbatdetails.batterteam ='$team' AND 
													atbatdetails.gdate <= 
													(SELECT DISTINCT atbatdetails.gdate AS gdates 
													FROM atbatdetails 
													WHERE atbatdetails.pid = '$id' AND atbatdetails.batterteam ='$team' 
													ORDER BY atbatdetails.gdate 
													LIMIT 1 
													OFFSET 9");
					?>
							<!-- PHP CODE TO FETCH DATA FROM ROWS-->
					<?php 
							while ($rows2 = pg_fetch_assoc($result2))
							{
					?>
						<tr>
							<!--FETCHING DATA FROM EACH 
								ROW OF EVERY COLUMN-->
							<td><?php echo $rows['strikes']; ?></td>
							<td><?php echo $rows['balls']; ?></td>
							<td><?php echo $rows['bases']; ?></td>
							<td><?php echo $rows['atbatcount']; ?></td>
							<td><?php echo $rows['percentHits']; ?></td>
							<td><?php echo $rows['PercentStrikeOuts']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
				</section>
				
				<hr size="1" width="100%" color="black">
				<h2><b>Pitcher vs. Team Statistics (Last 5 Games)</b></h2><br>
				<p class="text"><b>Statistics For Last 5 Games:</b><?php &nbsp; echo $pitcherfname;&nbsp;echo $pitcherlname;&nbsp;?><b>vs.</b> <?php &nbsp;echo $team;?></p>
				<section>
					<!-- TABLE CONSTRUCTION-->
					<table class="center">
						<tr>
							<th>Average Strikes/AB</th>
							<th>Average Balls/AB</th>
							<th>Average Bases/AB</th>
							<th>At Bats</th>
							<th>Hit %</th>
							<th>Strikeout %</th>
						</tr>
						
					<?php	
						$result3 = pg_query($PGDB,  "SELECT 
													ROUND(AVG(strikes),2) AS Strikes,
													ROUND(AVG(balls),2) AS Balls,
													ROUND(AVG(bases),2) AS Bases,
													COUNT(*) AS AtBatCount,
													COUNT(case when abresult='H' then 1 end) as Hits,
													COUNT(case when abresult='O' then 1 end) as StrikeOuts,
													ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS percentHits,
													ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS PercentStrikeOuts
													FROM atbatdetails
													WHERE atbatdetails.pid = '$id' AND 
													atbatdetails.batterteam ='$team' AND 
													atbatdetails.gdate <= 
													(SELECT DISTINCT atbatdetails.gdate AS gdates 
													FROM atbatdetails 
													WHERE atbatdetails.pid = '$id' AND atbatdetails.batterteam ='$team' 
													ORDER BY atbatdetails.gdate 
													LIMIT 1 
													OFFSET 4 ");
					?>
							<!-- PHP CODE TO FETCH DATA FROM ROWS-->
					<?php 
							while ($rows3 = pg_fetch_assoc($result3))
							{
					?>
						<tr>
							<!--FETCHING DATA FROM EACH 
								ROW OF EVERY COLUMN-->
							<td><?php echo $rows['strikes']; ?></td>
							<td><?php echo $rows['balls']; ?></td>
							<td><?php echo $rows['bases']; ?></td>
							<td><?php echo $rows['atbatcount']; ?></td>
							<td><?php echo $rows['percentHits']; ?></td>
							<td><?php echo $rows['PercentStrikeOuts']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
				</section>
				
				<hr size="1" width="100%" color="black">
				<h2><b>Pitcher vs. Team Statistics (All At Bat Records)</b></h2><br>
				<p class="text"><b>All At Bat Records:</b><?php &nbsp; echo $pitcherfname;&nbsp;echo $pitcherlname;&nbsp;?><b>vs.</b> <?php &nbsp;echo $team;?></p>
				<section>
					<!-- TABLE CONSTRUCTION-->
					<table class="center">
						<tr>
							<th>Game Date</th>
							<th>Location</th>
							<th>Batter ID</th>
							<th>Batter First Name</th>
							<th>Batter Last Name</th>
							<th>Batter Team</th>
							<th>Strikes</th>
							<th>Balls</th>
							<th>Bases</th>
							<th>Result</th>
						</tr>
						
					<?php	
						$result4 = pg_query($PGDB,  "SELECT 
													atbatdetails.gdate as d,
													atbatdetails.glocation as l,
													atbatdetails.bid as bid,
													atbatdetails.first_name as f,
													atbatdetails.last_name as lst,
													atbatdetails.batterteam as tm,
													atbatdetails.strikes as strikes,
													atbatdetails.balls as balls,
													atbatdetails.bases as bases,
													atbatdetails.abresult as abresult
													FROM atbatdetails
													WHERE atbatdetails.pid = '$id' AND 
													atbatdetails.batterteam ='$team'
													ORDER BY atbatdetails.gdate DESC");
					?>
							<!-- PHP CODE TO FETCH DATA FROM ROWS-->
					<?php 
							while ($rows4 = pg_fetch_assoc($result4))
							{
					?>
						<tr>
							<!--FETCHING DATA FROM EACH 
								ROW OF EVERY COLUMN-->
							<td><?php echo $rows['d']; ?></td>
							<td><?php echo $rows['l']; ?></td>
							<td><?php echo $rows['bid']; ?></td>
							<td><?php echo $rows['f']; ?></td>
							<td><?php echo $rows['lst']; ?></td>
							<td><?php echo $rows['tm']; ?></td>
							<td><?php echo $rows['strikes']; ?></td>
							<td><?php echo $rows['balls']; ?></td>
							<td><?php echo $rows['bases']; ?></td>
							<td><?php echo $rows['abresult']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
				</section>	

		</div>
	</body>
</html>
