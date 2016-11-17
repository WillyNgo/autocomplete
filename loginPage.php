<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>City Search</title>
    </head>
    <body>
    <body>
        <?php
            session_start();
            session_regenerate_id();
            
        //These files will include validation methods
        include('validation.php');
        include('loginAction.php');
        
        //Check current session if too many attemptss
        if(!isset($_SESSION['attempts'])){
            $_SESSION['attempts'] = 0;
        }else if($_SESSION['attempts'] >= 2){
            lockUser();
        }
        ?>
        <div id="loginPageContainer">
        <div class="myHeader">
            <h1 id="loginTitle">Auto Completion - Login</h1>
        </div>
        <div id="formWrapper">
            <form id="searchForm" action="" method="get">
                <!-- Disables the text fields and buttons if user is locked out -->
                <p>Username: <input type="text" name="username" <?php if($_SESSION['attempts'] >= 2){ echo "disabled"; }?>/> </p>
                <p>Password: <input type="password" name="password" <?php if($_SESSION['attempts'] >= 2){ echo "disabled"; }?>/></p>
                <input type="submit" name="login" value="Log In" <?php if($_SESSION['attempts'] >= 2){ echo "disabled"; }?>/>
                <input type="submit" name="signup" value="Sign up" <?php if($_SESSION['attempts'] >= 2){ echo "disabled"; }?>/>
            </form>
        </div>
        </div>
        <?php
        
        //Login when user clicks
        if (isset($_GET['login'])) {
            $myUsername = $_GET['username'];
            $myPassword = $_GET['password'];
            
            strip_tags($myUsername);
            strip_tags($myPassword);
            
            //Check if there's something in the username and password field
            if (empty($myUsername) || empty($myPassword)) {
                echo "<p class='error'>Please do not leave any fields blank</p>";
            } 
            //Check if user exists - from validation.php
            else if (!usernameExists($myUsername)) { 
                echo "<p>Invalid Username or Password</p>"; //Keep error message ambiguous to avoid too much info for potential hackers
            } 
            //Validate password - from validation.php
            else if (!validatePassword($myUsername, $myPassword)) {
                echo "<p class = 'error'>Invalid Username or Password</p>"; //Keep error message ambiguous to avoid too much info for potential hackers
                incrementAttempt();
            }
            //Successful authentication - reset attempts.
            else {
                resetAttempts();
                login($myUsername);
            }
        }
        
        //Direct user to registration page
        if (isset($_GET['signup'])) {
            header("location: registrationPage.php");
            exit;
        }
        ?>
        
        <div id="backgroundImage"></div>
        
    </body>
</body>
</html>


