<?php 

    include_once("./config.php");

    // Retreives the user's info from their username
	function getUserInfoByUsername($username)
	{
		global $PGDB;

		// Get user info from DB
        $result = pg_prepare($PGDB, "user_info", "SELECT * FROM Users WHERE Uname = $1");
        $result = pg_execute($PGDB, "user_info", array("$username"));

        return pg_fetch_assoc($result);
	}

	// Creates a user from given username and password
	function createNewUser($username, $password)
	{
		// Create the user in the database
	}

?>