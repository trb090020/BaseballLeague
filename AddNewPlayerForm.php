<!DOCTYPE html>
<html>
	<head>
        <title>Add New Player</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Add New Player</b></h1><br>
		<div class="login">
			<form action="AddNewPlayer.php" method="get">
				<label>
                    <b>First Name</b>
                </label>
                <input type="text" name="fname" id="Input" placeholder="Babe">
                <br><br>
                <label>
                    <b>Last Name</b>
                </label>
                <input type="text" name="lname" id="Input" placeholder="Ruth">
                <br><br>
                <label>
                    <b>Team Acronym</b>
                </label>
                <input type="text" name="team" id="Input" placeholder="BOS">
                <br><br>
                <label>
                    <b>Throwing Hand</b>
                </label>
                <input type="char" name="throwing" id="Input" placeholder="L">
                <br><br>
                <label>
                    <b>Batting Hand</b>
                </label>
                <input type="char" name="batting" id="Input" placeholder="L">
                <br><br>
                <label>
                    <b>Date of Birth</b>
                </label>
                <input type="date" name="dob" id="Input">
                <br><br>
                <button name="search" id="login">Add</button>
                <input type="button" class="right" value="Back" onclick="history.back()">
			</form>
		</div>
	</body>
</html>