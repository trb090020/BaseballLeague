<?php

	$host = "";
	$db = "";
	$user = "";
	$password = "";
	
	$PGDB = pg_connect(" host=$host port=5432 dbname=$db user=$user password=$password ") or die();

?>