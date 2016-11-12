<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <body>
        <h1 id="title">Auto Completion - New Registration</h1>
        <div id="formWrapper">
            <form id="searchForm" action="" method="get">
                <p>New Username: <input type="text" name="newusername"> </p>
                <p>New Password: <input type="password" name="newpassword"/></p>
                <p>Confirm Password: <input type="password" name="confirmpassword"/></p>
                <input type="submit" name="register" value="Register"/>
            </form>
        </div>
        <?php
        //This file will include validation methods;
        include('validation.php');
        include('registrationAction.php');
        
        if(isset($_GET['register'])){
            //Check if there's something in the username and passwords field
            if ($_GET['newusername'] == '' || $_GET['newpassword'] == '' || $_GET['confirmpassword'] == '') {
                
                echo "<p class='error'>Please do not leave any fields blank</p>";
            }
            else{
                //If confirmpassword is not the same as newpassword
                if($_GET['newpassword'] != $_GET['confirmpassword'])
                {
                    echo "<p class = 'error'>Passwords do not match</p>";
                }
                else if(usernameExists($_GET['newusername'])) //Username must be unique DOING THIS NOW
                {
                    echo "<p class = 'error'>Apologies, that username is already taken.";
                }
                else //If all information is ok, register user
                {
                    registerUser($_GET['newusername'], $_GET['confirmpassword']);
                }
            }
        }
        ?>
    </body>
    </body>
</html>