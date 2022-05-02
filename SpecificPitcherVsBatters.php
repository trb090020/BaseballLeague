<!DOCTYPE html>
<html>
<head>
    <title>Pitcher vs. Batter Statistics</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1><b>Pitcher vs. Batter Statistics</b></h1>
<?php
$id = $_GET['id'];
$bid = $_GET['bid'];
?>
<?php
require_once 'config.php';
try
{$dsn = "pgsql:host=$host;port=5432;dbname=$db";}
catch (PDOException $e)
{die($e->getMessage());}

$fname1 = pg_query($PGDB, "SELECT first_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");
$lname1 = pg_query($PGDB, "SELECT last_name FROM public.allpitchers WHERE public.allpitchers.id = '$id'");

$result1 = pg_query($PGDB, "SELECT
ROUND(avg(strikes),2) AS Strikes, ROUND(avg(balls),2) AS Balls,
COUNT(*) AS AtBatCount, COUNT(case when abresult='H' then 1 end) as Hits, ROUND((COUNT(case when abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS battingAverage
FROM public.atbatdetails
WHERE public.atbatdetails.pid = $id
AND public.atbatdetails.bid = $bid;
");

$result2 = pg_query($PGDB,  "SELECT
ROUND(avg(strikes),2) AS Strikes, ROUND(avg(balls),2) AS Balls,
COUNT(*) AS AtBatCount, COUNT(case when abresult='H' then 1 end) as Hits, 
ROUND((COUNT(case when public.atbatdetails.abresult='H' then 1 end)*100.0)/(COUNT(*)*1.0),2) AS battingAverage
FROM public.atbatdetails
WHERE public.atbatdetails.pid = $id  AND public.atbatdetails.bid = $bid AND public.atbatdetails.gdate <= 
(SELECT DISTINCT public.atbatdetails.gdate AS gdates 
FROM public.atbatdetails 
WHERE public.atbatdetails.pid = $id AND public.atbatdetails.bid = $bid
ORDER BY public.atbatdetails.gdate 
LIMIT 1 
OFFSET 2);
");

$result3 = pg_query($PGDB,  "SELECT
ROUND(((total_balls+total_strikes)::numeric(22,2)/ab_count::numeric(22,2)),2) as averagePitches
FROM public.abbypitcher
WHERE pid = $id;
");


?>
<h2> <?php
    while ($rowsf = pg_fetch_assoc($fname1)){echo $rowsf['first_name'];}
    echo str_repeat('&nbsp;', 1);
    while ($rowsl = pg_fetch_assoc($lname1)){echo $rowsl['last_name'];}
    echo str_repeat('&nbsp;', 1); echo "vs. "; echo $bid;
    ?>
</h2>
<hr size="1" width="100%" color="black">

<h2><b>Lifetime Statistics of Batter vs Pitcher</b></h2>
<section>
    <!-- TABLE CONSTRUCTION-->
    <table class="center">
        <tr>
            <th>Average Strikes/AB</th>
            <th>Average Balls/AB</th>
            <th>Total At Bats</th>
            <th>Total Hits</th>
            <th>Batting Average*100</th>
        </tr>

        <!-- PHP CODE TO FETCH DATA FROM ROWS-->
        <?php
        while ($rows1 = pg_fetch_assoc($result1))
        {
            ?>
            <tr>
                <td><?php echo $rows1['strikes']; ?></td>
                <td><?php echo $rows1['balls']; ?></td>
                <td><?php echo $rows1['atbatcount']; ?></td>
                <td><?php echo $rows1['hits']; ?></td>
                <td><?php echo $rows1['battingaverage']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

</section>

<hr size="1" width="100%" color="black">
<h2><b>Last 3 At-Bats</b></h2>
<section>
    <!-- TABLE CONSTRUCTION-->
    <table class="center">
        <tr>
            <th>Average Strikes/At Bat</th>
            <th>Average Balls/At Bat</th>
            <th>Total Hits</th>
            <th>Batting Average</th>
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
                <td><?php echo $rows2['hits']; ?></td>
                <td><?php echo $rows2['battingaverage']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>

</section>

<hr size="1" width="100%" color="black">
<h2><b>Average Pitches thrown At Bat</b></h2><br>
<section>
    <!-- TABLE CONSTRUCTION-->
    <table class="center">
        <tr>
            <th>Average Pitches/At Bat</th>
        </tr>
        <?php
        while ($rows3 = pg_fetch_assoc($result3))
        {
            ?>
            <tr>
                <td><?php echo $rows3['averagepitches']; ?></td>

            </tr>
            <?php
        }
        ?>
    </table>

</section>

</body>
</html>

