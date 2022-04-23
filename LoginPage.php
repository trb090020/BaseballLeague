<?php

    /*//////////////////////////////////////////////////////////////////////////
    /                                                                          /
    /   This document uses HTML to create a webpage into which a user can      /
    /   enter their login credentials, which is placed in a form. This form is /
    /   then sent to and used by the PHP code to check if the user's data      /
    /   matches with the data stored in the database. If it is found and       /
    /   matches, the user is logged in. If their data is not found or does not /
    /   match, the user is rejected.                                           /
    /                                                                          /
    //////////////////////////////////////////////////////////////////////////*/

    
    include_once("./Header.php");
    include_once("./Users.php");


    // Attempts to login into an account
    function login()
    {
        // required_values is an array with form inputs
        $required_values = array("Uname", "Pass");

        // Validate each variable in required_values
        foreach($required_values as $required_value)
        {
            // Check that all values are set
            if(!isset($_POST[$required_value]))
            {
                throw new Exception("Value $required_value is not set");
            }
            
            // Check that values are not empty
            if(!$_POST[$required_value])
            {
                throw new Exception("Value $required_value cannot be empty");
            }
        }

        // Set form username and password to PHP variables
        $username = $_POST["Uname"];
        $password = $_POST["Pass"];
		
		if($user = getUserInfoByUsername($username)) 
        {
            // Check if user info is correct
            if($password != $user["Pass"]) 
            {
                // TODO: logic for if password is incorrect
            }
        }
        else 
        {
            // TODO: no username found, maybe prompt to create an account?
        }

        // Stores username of user newly logged in 
        $_SESSION["Uname"] = $username;
        $_SESSION["Success"] = true;
        return true;
    }


    // If login button is clicked, determines success of login()
    if(isset($_POST["login"]))
    {
        if(login())
        {
            header("Location: ./index.php");
        }
        else
        {
            echo "Login failed";
        }
    }
    
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1><b>Login Page</b></h1><br>
        <div class="login">
            <form method="POST">
                <label>
                    <b>User Name</b>
                </label>
                <input type="text" name="Uname" id="Uname" placeholder="Username">
                <br><br>
                <label>
                    <b>Passwords</b>
                </label>
                <input type="Password" name="Pass" id="Pass" placeholder="Password">
                <br><br>
                <button name="login" id="login">
                    Submit
                </button>
                <form><input type="button" class="right" value="Back" onclick="history.back()"></form>
                <a class="rightLink" href="/CreateAccount.php">Create Account</a>
            </form>
        </div>
    </body>
</html>