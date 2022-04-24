<!DOCTYPE html>
<html>
	<head>
        <title>Update Player's Information</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Update Player's Information</b></h1><br>
		<div class="login">
			<form action="databaseUpdate.php" method="get">
				<label>
                    <b>Player's ID</b>
                </label>
                <input type="number" name="id" id="Pass" placeholder="0">
                <br><br>
                <label>
                    <b>Current First Name</b>
                </label>
                <input type="text" name="oldFirst" id="Input" placeholder="John">
                <br><br>
                <label>
                    <b>Updated First Name</b>
                </label>
                <input type="text" name="newFirst" id="Input" placeholder="James">
                <br><br>
                <label>
                    <b>Updated Last Name</b>
                </label>
                <input type="text" name="newLast" id="Input" placeholder="Smith">
                <br><br>
                <label>
                    <b>Updated Team</b>
                </label>
                <input type="text" name="newTeam" id="Input" placeholder="CHC">
                <br><br>
                <label>
                    <b>Updated Batting Hand</b>
                </label>
                <input type="text" name="newBat" id="Input" placeholder="R">
                <br><br>
                <label>
                    <b>Updated Throwing Hand</b>
                </label>
                <input type="text" name="newThrow" id="Input" placeholder="R">
                <br><br>
                <label>
                    <b>Updated Date of Birth</b>
                </label>
                <input type="date" name="newDOB" id="Input">
                <br><br>
                <button name="search" id="login">Submit</button>
                <input type="button" class="right" value="Back" onclick="history.back()">
            </form>
		</div>
	</body>
</html>
