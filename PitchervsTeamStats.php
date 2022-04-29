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
				$idno = $_GET['id'];
				$team = $_GET['team'];
			?>
			
			<?php
				$pitchername = pg_query($PGDB, "SELECT  first_name, last_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
			?>

			<p class="text"><b>All-Time Statistics:</b><?php &nbsp; echo $pitchername;&nbsp;?><b>vs.</b> <?php &nbsp;echo $team;?></p>
			
			<section>
					<h2>All-Time At Bat Statistics</h2>
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
						
					<?php	$result = pg_query($PGDB, "SELECT 
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
		</div>
	</body>
</html>