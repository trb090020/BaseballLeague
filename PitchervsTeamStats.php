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
				require_once 'config.php';

							try 
							{$dsn = "pgsql:host=$host;port=5432;dbname=$db;";} 
							catch (PDOException $e) 
							{die($e->getMessage());}
							
							$pitcherfname = pg_query($PGDB, "SELECT  first_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
							$pitcherlname = pg_query($PGDB, "SELECT  last_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
							
							$result = pg_query($PGDB, "SELECT 
											ROUND(AVG(strikes),2) AS Strikes,
											ROUND(AVG(balls),2) AS Balls,
											ROUND(AVG(bases),2) AS Bases,
											COUNT(*) AS AtBatCount,
											COUNT(case when abresult='H' then 1 end) as Hits,
											COUNT(case when abresult='O' then 1 end) as StrikeOuts,
											ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS percentHits,
											ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS PercentStrikeOuts
											FROM public.atbatdetails
											WHERE public.atbatdetails.pid = '$id'
											AND public.atbatdetails.batterteam = '$team' ");
											
							$result2 = pg_query($PGDB,  "SELECT 
													ROUND(AVG(strikes),2) AS Strikes,
													ROUND(AVG(balls),2) AS Balls,
													ROUND(AVG(bases),2) AS Bases,
													COUNT(*) AS AtBatCount,
													COUNT(case when abresult='H' then 1 end) as Hits,
													COUNT(case when abresult='O' then 1 end) as StrikeOuts,
													ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS percentHits,
													ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS PercentStrikeOuts
													FROM public.atbatdetails
													WHERE public.atbatdetails.pid = '$id' AND 
													public.atbatdetails.batterteam ='$team' AND 
													public.atbatdetails.gdate <= 
													(SELECT DISTINCT public.atbatdetails.gdate AS gdates 
													FROM public.atbatdetails 
													WHERE public.atbatdetails.pid = '$id' AND public.atbatdetails.batterteam ='$team' 
													ORDER BY public.atbatdetails.gdate 
													LIMIT 1 
													OFFSET 9");
													
							$result3 = pg_query($PGDB,  "SELECT 
													ROUND(AVG(strikes),2) AS Strikes,
													ROUND(AVG(balls),2) AS Balls,
													ROUND(AVG(bases),2) AS Bases,
													COUNT(*) AS AtBatCount,
													COUNT(case when abresult='H' then 1 end) as Hits,
													COUNT(case when abresult='O' then 1 end) as StrikeOuts,
													ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS percentHits,
													ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS PercentStrikeOuts
													FROM public.atbatdetails
													WHERE public.atbatdetails.pid = '$id' AND 
													public.atbatdetails.batterteam ='$team' AND 
													public.atbatdetails.gdate <= 
													(SELECT DISTINCT public.atbatdetails.gdate AS gdates 
													FROM public.atbatdetails 
													WHERE public.atbatdetails.pid = '$id' AND public.atbatdetails.batterteam ='$team' 
													ORDER BY public.atbatdetails.gdate 
													LIMIT 1 
													OFFSET 4");
													
						$result4 = pg_query($PGDB,  "SELECT 
													public.atbatdetails.gdate as d,
													public.atbatdetails.glocation as l,
													public.atbatdetails.bid as bid,
													public.atbatdetails.first_name as f,
													public.atbatdetails.last_name as lst,
													public.atbatdetails.batterteam as tm,
													public.atbatdetails.strikes as strikes,
													public.atbatdetails.balls as balls,
													public.atbatdetails.bases as bases,
													public.atbatdetails.abresult as abresult
													FROM public.atbatdetails
													WHERE public.atbatdetails.pid = '$id' AND 
													public.atbatdetails.batterteam ='$team'
													ORDER BY public.atbatdetails.gdate DESC");
					
			?>
			<hr size="1" width="100%" color="black">

			<p class="text"><b>All-Time Statistics: </b><?php echo $pitcherfname." ".$pitcherlname." ";?><b>vs. </b> <?php echo $team;?></p>
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
			<p class="text"><b>Statistics For Last 10 Games:</b><?php echo $pitcherfname." ".$pitcherlname." ";?><b>vs. </b> <?php echo $team;?></p>
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
				<p class="text"><b>Statistics For Last 5 Games:</b><?php echo $pitcherfname." ".$pitcherlname." ";?><b>vs. </b> <?php echo $team;?></p>
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
				<p class="text"><b>All At Bat Records:</b><?php echo $pitcherfname." ".$pitcherlname." ";?><b>vs. </b> <?php echo $team;?></p>
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
