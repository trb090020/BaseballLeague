<?php

	$db = pg_connect("host=ls-99428edba7c928b0c62ad0e6cd11c0ece8660db3.ciw1f5witzxf.us-east-2.rds.amazonaws.com
    dbname=BaseballLeague user=dbmasteruser password=masterblaster");
	
	if(!$db)
	{
	echo "An error occurred.\n";
	exit;
	}

	
	if(isset($_POST['firstname']))
	{
	$firstname=$_POST['firstname'];
	die($firstname);
	$Player = pg_query($db, "SELECT * FROM Player WHERE  first_name='$firstname'");
		
		if($Player->rowcount())
	{
		echo $firstname;
		echo "<br>";
		die('No player matching that name was found.');
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
		<form action="Tryit.php" method="post" autocomplete="off">
			<label for="firstname">
			First Name:<input type="text" name="firstname" id="firstname">
			</label><br>
			<input type="submit" value="Submit">
		</form>
	</body>
</html> 
