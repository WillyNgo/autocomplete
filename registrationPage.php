<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <body>
            <div class="myHeader">
                <h1>Auto Completion - New Registration</h1>
            </div>
        <div id="formWrapper">
            <form id="searchForm" action="" method="post">
                <p>New Username: <input type="text" name="newusername"> </p>
                <p>New Password: <input type="password" name="newpassword"/></p>
                <p>Confirm Password: <input type="password" name="confirmpassword"/></p>
                <input type="submit" name="register" value="Register" method="get"/>
                <input type="submit" name="backToLogin" value="Back to Log In" method="get" />
            </form>
            
        </div>
        <?php
        //This file will include validation methods;
        include('validation.php');
        include('registrationAction.php');
        
        if(isset($_POST['register'])){
            $newusername = $_POST['newusername'];
            $newpassword = $_POST['newpassword'];
            $confirmpassword = $_POST['confirmpassword'];
            
            //make things safe
            strip_tags($newusername);
            strip_tags($newpassword);
            strip_tags($confirmpassword);
            
            //Check if there's something in the username and passwords field
            if (empty($newusername) || empty($newpassword) || empty($confirmpassword)) {
                echo "<p class='error'>Please do not leave any fields blank</p>";
            }
            else{
                //If confirmpassword is not the same as newpassword
                if($newpassword != $confirmpassword){
                    echo "<p class = 'error'>Passwords do not match</p>";
                }
                else if(usernameExists($newusername)) //Username must be unique
                {
                    echo "<script type='text/javascript'>alert('DOES NOT EXIST:');</script>";

                    echo "<p class = 'error'>Apologies, that username is already taken.";
                }
                else //If all information is ok, register user
                {
                    echo "<script type='text/javascript'>alert('REGISTERING:');</script>";
                    registerUser($newusername, $confirmpassword);
                }
            }
        }
        
        if(isset($_POST['backToLogin'])){
            header('location: loginPage.php');
            exit;
        }
        ?>
    </body>
    </body>
</html>