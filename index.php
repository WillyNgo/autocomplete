<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Autocomplete</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="autocomplete.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <?php
        session_start();
        session_regenerate_id();
        include('dbUtility.php');
        
        if(!isset($_SESSION['username'])) {
            header('location: loginPage.php');
            exit;
        }
        
        ?>
        <h1 id="title">Auto Completion - Index <?php echo " : Welcome ".$_SESSION['username']; ?></h1>            
        <form id="searchForm" action="" method="get">
            <input type="text" name="search" placeholder="Search" id="search"/>
            <div id="results">
                <div class="item">abc</div>
                <div class="item">def</div>
                <div class="item">hij</div>
            </div>

            <input type="submit" name="add" value="Submit"/>
            <input type="submit" name="logout" value="Logout"/>
        </form>
        <?php
        //Logout
        if (isset($_GET['logout'])) {
            unset($_SESSION['username']);
            header('location: index.php');
            exit;
        }
        ?>
    </body>
</html>
