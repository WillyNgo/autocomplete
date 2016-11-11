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
        <h1 id="title">Auto Completion</h1>
        <div id="formWrapper">
            <form id="searchForm" action="" method="get">
                <p>Username: <input type="text" name="username"> </p>
                <p>Password: <input type="password" name="password"/></p>
                <input type="submit" name="signup" value="Sign up"/>
                <input type="submit" name="submit" value="Log In"/>
            </form>
        </div>
        <?php
        //This file will include validation methods
        include('Validation.php');
        
        //Check if there's something in the username and password field
        if(isset($_GET['submit'])){
            if ($_GET['username'] != '' || $_GET['password'] != '') {
                //Validate username and password
                if(validateUser($_GET['username'], $_GET['password']))
                {
                    //send to form
                }
                else
                {
                    echo "<p class = 'error'>Invalid Username or Password</p>";
                    //TODO: Add counter attempt
                }
            }
            else{
                echo "<p class='error'>Please do not leave any fields blank</p>";
            }
        }
        
        //If user click on the sign up button
        if(isset($_GET['signup']))
        {
            header("location: RegistrationPage.php");
            exit;
        }
        ?>
    </body>
    </body>
</html>
