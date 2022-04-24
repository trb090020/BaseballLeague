<!DOCTYPE html>
<html>
	<body>

		<?php

			include_once("./Header.php");

			if(isset($_SESSION["Uname"])) 
			{
				unset($_SESSION["Uname"]);
			}

		?>

		<p>Logged out.</p>
		<p><a href="/index.php"> Click here to return to home page.</a></p>
	</body>
</html>