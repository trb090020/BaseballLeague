<?php

	/*//////////////////////////////////////////////////////////////////////////
	/                                                                          /
	/   This document prints messages to the webpage depending upon whether    /
	/   or not there is a user logged in. If there is a user logged in, the    /
	/   webpage says hello and uses their username as their name. If no user   /
	/   is logged in, they are asked to login.                                 /
	/                                                                          /
	//////////////////////////////////////////////////////////////////////////*/


    include_once("./Header.php");


    // Determines if someone has logged in and prints messages
    if(isset($_SESSION["Uname"]))
    {
    	// HTML output for webpage with a successfully logged in account
    	?>
	    	<br/>
	    	<p><h1>
	    		Hello, <?php echo $_SESSION["Uname"] ?>
			</h1></p>
			<p><h2><a action="/Logout.php">Click here to logout</a></h2></p>
			<br/>

    	<?php
    }
    else
    {
    	// HTML output for webpage without a logged in account
    	?>
    		<p><b>Please login <a href="/LoginPage.php">here</a> or create an account <a href="/CreateAccount.php">here</a></b></p>
    	<?php
    }

?>



<!DOCTYPE html>
<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<p class="ex2"><b>Baseball League</b></p>
		<div class="links">
			<p><a href="/databaseSearchForm.php">Form: Search Database</a></p>
			<p><a href="/ActiveRoster.php">League Roster</a></p>
			<p><a href="/Tryit.php">Try it</a></p>
			<p><a href="/test.php">Test Connection</a></p>
			<p><a href="/databaseUpdateForm.php">Update Player Name</a></p>
		</div>
    </body>
</html>