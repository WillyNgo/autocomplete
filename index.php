<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search City!</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="autocomplete.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <?php
        session_start();
        session_regenerate_id();
        include('dbUtility.php');
        include('historyAction.php');
        
        //If there is no session set, redirect user to the login page.
        if(!isset($_SESSION['username'])) {
            header('location: loginPage.php');
            exit;
        }
        
        ?>
        <div class="myHeader">
            <h1 id="title">Auto Completion - Index <?php echo " : Welcome ".$_SESSION['username']; ?></h1>            
        </div>
        <div id="formWrapper">
        <form id="searchForm" action="" method="post">
            <input list="history" name="searchBar" placeholder="Search a city..." id="searchBar"/>
            <datalist id="history">
            </datalist>
            <input type="submit" name="add" id="addButton" value="Submit"/>
            <input type="submit" name="logout" value="Logout"/>
            <input type="submit" name="delete" value="Delete history"/>
        </form>
        </div>
        
        
        <?php        
//When user submits his entry
        if(isset($_POST['add'])){
            $searchTerm = $_POST['searchBar']; 
           
            //Check if it's a valid city
            if(isValidCity($searchTerm)){
                addToHistoryTable($_SESSION['username'], $_POST['searchBar']);
            }
            else{
                echo "<p class='response'>Not a valid city!</p>";
            }
        }
        //Logout
        if (isset($_POST['logout'])) {
            unset($_SESSION['username']);
            $_SESSION = [];
            header('location: index.php');
            exit;
        }
        
        //Set the user's recent search
        echo <<<history
        <div id="historyBox">
            <div id="historyBoxHeader"><p>Recent Searches</p</div>
            <div id="historyBoxItems">
                
            </div>
        </div>
history;
        
        
        //delete history
        if(isset($_POST['delete'])){
            if(deleteHistory($_SESSION['username'])){
                echo "<p class='response'>Your user history has been deleted!</p>";
            }
        }
        
        setHistory($_SESSION['username']);
        ?>
        
        <div id="backgroundImage"></div>
    </body>
</html>
