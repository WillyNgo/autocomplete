<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <body>
        <h1 id="title">Auto Completion - Index</h1>
        <div id="formWrapper">
            <form id="searchForm" action="" method="get">
                <p>Search: <input type="text" name="search"> </p>
                <input type="submit" name="add" value="Submit"/>
                <input type="submit" name="logout" value="logout"/>
            </form>
        </div>
        <?php
        session_start();
        session_regenerate_id();
        
        if(!isset($_SESSION['username']))
        {
            header('location: loginPage.php');
            exit;
        }
        else{
            echo "Welcome ".$_SESSION['username']."!";
        }
        
        //Logout
        if(isset($_GET['logout']))
        {
            unset($_SESSION['username']);
            header('location: index.php');
            exit;
        }
        
        ?>
    </body>
</body>
</html>
