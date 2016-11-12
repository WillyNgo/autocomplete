<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <body>
        <h1 id="title">Auto Completion - Login</h1>
        <div id="formWrapper">
            <form id="searchForm" action="" method="get">
                <p>Username: <input type="text" name="username"> </p>
                <p>Password: <input type="password" name="password"/></p>
                <input type="submit" name="signup" value="Sign up"/>
                <input type="submit" name="login" value="Log In"/>
            </form>
        </div>
        <?php
        session_start();
        session_regenerate_id();
                
        //This file will include validation methods
        include('validation.php');
        include('loginAction.php');
        
        //Login when user clicks
        if (isset($_GET['login'])) {
            //Check if there's something in the username and password field
            if ($_GET['username'] == '' || $_GET['password'] == '') {
                echo "<p class='error'>Please do not leave any fields blank</p>";
            } else {
                //Check if user exists
                if (!usernameExists($_GET['username'])) {
                   echo "<p>Invalid Username or Password</p>"; //Keep error message ambiguous to avoid too much info for potential hackers
                } else {
                    //Validate password
                    if (validatePassword($_GET['username'], $_GET['password'])) {
                        $_SESSION['username'] = $_GET['username'];
                        header("location: index.php");
                        exit;
                    } else {
                        echo "<p class = 'error'>Invalid Username or Password</p>"; //Keep error message ambiguous to avoid too much info for potential hackers
                        incrementAttempt($_GET['username']);
                    }
                }
            }
        }

        //If user click on the sign up button
        if (isset($_GET['signup'])) {
            header("location: registrationPage.php");
            exit;
        }
        ?>
    </body>
</body>
</html>


