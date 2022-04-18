<html>
<body>

<p> You searched for: <?php echo $_GET['id']; echo " "; echo $_GET['first']; ?> </p>

<?php
	ini_set('display_errors', 'on');
	error_reporting(E_ALL);
	require_once 'config.php';
	$playerName = $_GET['first'];
	$id = $_GET['id'];
	
	printf("test \n" );
		
	
		
	if($PGDB) echo nl2br("Successfully connected to remote database... \n");
	//connection info comes from config.php
	// Perform SQL query
	
	$result = pg_query($PGDB, "UPDATE Player SET first_name='$playerName'  WHERE ID='$id'");
	if ($result) {
	
		while($row = pg_fetch_assoc($result)) {
			printf("ID: %d First name %s, Last Name %s \n", $row["id"], $row["first_name"], $row["last_name"]);
		}
	}
	


    


   

?>


</body>
</html>
