<!DOCTYPE html>
<html>
	<head>
        <title>Change Player's Name</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	<body>
		<h1><b>Change Player's Name</b></h1><br>
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
                    <b>New First Name</b>
                </label>
                <input type="text" name="newFirst" id="Input" placeholder="James">
                <br><br>
                <button name="search" id="login">Submit</button>
                <form><input type="button" class="right" value="Back" onclick="history.back()"></form>
			<!-- </form>
				Player ID: <input type="number" name="id"><br>
				Current First Name: 
				New First Name: <input type="text" name="first"><br>
				<input type="submit">
			</form> -->
		</div>
	</body>
</html>
