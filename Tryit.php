<?php

	$db = pg_connect("host=ls-99428edba7c928b0c62ad0e6cd11c0ece8660db3.ciw1f5witzxf.us-east-2.rds.amazonaws.com
    dbname=BaseballLeague user=dbmasteruser password=masterblaster");
	
	if(!$db)
	{
	echo "An error occurred.\n";
	exit;
	}

	if(isset($_POST['idNo']))
	{
	$idNo = $_POST['idNo'];
	die($idNo);
	$Player = pg_query($db, "SELECT * FROM Player WHERE  ID='$idNo'");
	}
	
	else if(isset($_POST['firstname'])
	{
	$firstname=$_POST['firstname'];
	die($firstname);
	$Player = pg_query($db, "SELECT * FROM Player WHERE  first_name='$firstname'");
	}
	
	if($Player)
	{
		while($row = pg_fetch_assoc($Player))
		{
			printf("%s    %s    %s", $row["team"], $row["first_name"], $row["last_name"]);
			echo nl2br("\n");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Player Search</title>
	</head>
	<body>
		<form action="databaseSearch.php" method="post" autocomplete="off">
			<label for="idNo">
			ID Number:<input type="text" name="idNo" id ="idNo">
			</label><br>
			OR<br>
			<label for="firstname">
			First Name:<input type="text" name="firstname" id="firstname">
			</label><br>
			<input type="submit" value="Recover">
		</form>
	</body>
</html> 
