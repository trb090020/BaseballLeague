<!DOCTYPE html>
<html>
	<head>
        <title>Search DB for Player</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Search for Player</b></h1><br>
		<div class="login">
			<form action="databaseSearch.php" method="get">
				<label>
                    <b>Player's ID</b>
                </label>
                <input type="number" name="id" id="Pass" placeholder="0">
                <br><br>
                <label>
                    <b>Player's First Name</b>
                </label>
                <input type="text" name="first" id="Input" placeholder="John">
                <br><br>
                <button name="search" id="login">
                    Search
                </button>
                <form><input type="button" class="right" value="Back" onclick="history.back()"></form>

				<!-- ID: <input type="number" name="id"><br>
				First Name: <input type="text" name="first"><br>
				<input type="submit"> -->
			</form>
		</div>
	</body>
</html>