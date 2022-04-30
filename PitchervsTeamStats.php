<!DOCTYPE html>
<html>
	<head>
        <title>Pitcher vs. Team Statistics</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Pitcher vs. Team Statistics</b></h1>
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
							
							$pitcherfname = pg_query($PGDB, "SELECT first_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
							$pitcherlname = pg_query($PGDB, "SELECT last_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
							
							$result1 = pg_query($PGDB, "SELECT 
													ROUND(AVG(strikes),2) AS Strikes,
													ROUND(AVG(balls),2) AS Balls,
													ROUND(AVG(bases),2) AS Bases,
													COUNT(*) AS AtBatCount,
													COUNT(case when abresult='H' then 1 end) as Hits,
													COUNT(case when abresult='O' then 1 end) as StrikeOuts,
													ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS phits,
													ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS pso
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
													ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS phits,
													ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS pso
													FROM public.atbatdetails
													WHERE public.atbatdetails.pid = '$id' AND 
													public.atbatdetails.batterteam ='$team' AND 
													public.atbatdetails.gdate <= 
													(SELECT DISTINCT public.atbatdetails.gdate AS gdates 
													FROM public.atbatdetails 
													WHERE public.atbatdetails.pid = '$id' AND public.atbatdetails.batterteam ='$team' 
													ORDER BY public.atbatdetails.gdate 
													LIMIT 1 
													OFFSET 9)");
													
							$result3 = pg_query($PGDB,  "SELECT 
													ROUND(AVG(strikes),2) AS Strikes,
													ROUND(AVG(balls),2) AS Balls,
													ROUND(AVG(bases),2) AS Bases,
													COUNT(*) AS AtBatCount,
													COUNT(case when abresult='H' then 1 end) as Hits,
													COUNT(case when abresult='O' then 1 end) as StrikeOuts,
													ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS phits,
													ROUND((COUNT(case when abresult='O' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS pso
													FROM public.atbatdetails
													WHERE public.atbatdetails.pid = '$id' AND 
													public.atbatdetails.batterteam ='$team' AND 
													public.atbatdetails.gdate <= 
													(SELECT DISTINCT public.atbatdetails.gdate AS gdates 
													FROM public.atbatdetails 
													WHERE public.atbatdetails.pid = '$id' AND public.atbatdetails.batterteam ='$team' 
													ORDER BY public.atbatdetails.gdate 
													LIMIT 1 
													OFFSET 4)");
													
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
			<h2> <?php echo $pitcherfname;?> <?php echo $pitcherlname;?> vs. <?php echo $team;?> </h2>
			<hr size="1" width="100%" color="black">
			
			<h2><b>All-Time</b></h2>		
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
							while ($rows1 = pg_fetch_assoc($result1))
							{
					?>
						<tr>
							<!--FETCHING DATA FROM EACH 
								ROW OF EVERY COLUMN-->
							<td><?php echo $rows1['strikes']; ?></td>
							<td><?php echo $rows1['balls']; ?></td>
							<td><?php echo $rows1['bases']; ?></td>
							<td><?php echo $rows1['atbatcount']; ?></td>
							<td><?php echo $rows1['phits']; ?></td>
							<td><?php echo $rows1['pso']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
			</section>
				
			<hr size="1" width="100%" color="black">
			<h2><b>Last 10 Games</b></h2>
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
							<td><?php echo $rows2['strikes']; ?></td>
							<td><?php echo $rows2['balls']; ?></td>
							<td><?php echo $rows2['bases']; ?></td>
							<td><?php echo $rows2['atbatcount']; ?></td>
							<td><?php echo $rows2['phits']; ?></td>
							<td><?php echo $rows2['pso']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
				</section>
				
				<hr size="1" width="100%" color="black">
				<h2><b>Last 5 Games</b></h2><br>
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
							<td><?php echo $rows3['strikes']; ?></td>
							<td><?php echo $rows3['balls']; ?></td>
							<td><?php echo $rows3['bases']; ?></td>
							<td><?php echo $rows3['atbatcount']; ?></td>
							<td><?php echo $rows3['percentHits']; ?></td>
							<td><?php echo $rows3['PercentStrikeOuts']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
				</section>
				
				<hr size="1" width="100%" color="black">
				<h2><b>All At Bat Records</b></h2>
				
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
							<td><?php echo $rows4['d']; ?></td>
							<td><?php echo $rows4['l']; ?></td>
							<td><?php echo $rows4['bid']; ?></td>
							<td><?php echo $rows4['f']; ?></td>
							<td><?php echo $rows4['lst']; ?></td>
							<td><?php echo $rows4['tm']; ?></td>
							<td><?php echo $rows4['strikes']; ?></td>
							<td><?php echo $rows4['balls']; ?></td>
							<td><?php echo $rows4['bases']; ?></td>
							<td><?php echo $rows4['abresult']; ?></td>
						</tr>
					<?php
							}
					?>
					</table>
					
				</section>	
	</body>
</html>
