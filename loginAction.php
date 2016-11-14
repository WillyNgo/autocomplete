<?php

function incrementDatabaseAttempt($user) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
        $attempts = 0;
        //Grab number of attempt
        $queryAttempt = "SELECT loginAttempt FROM users WHERE username = ?;";
        $stmt = $pdo->prepare($queryAttempt);
        $stmt->bindParam(1, $user);
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                $attempts = $row['loginAttempt'];
                var_dump($attempts);
            }
        }

        //Update attempt number and set to users table
        $attempts++;
        var_dump($attempts);
        $queryUpdate = ("UPDATE users SET loginAttempt = ? WHERE username = ?;");

        $updateStmt = $pdo->prepare($queryUpdate);
        $updateStmt->bindParam(1, $attempts);
        $updateStmt->bindParam(2, $user);

        $updateStmt->execute();
        echo "incremented attempt";
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

function incrementAttempt(){
    $_SESSION['attempts']++;
}

function resetAttempts(){
    $_SESSION['attempts'] = 0;
    unset($_SESSION['unlockTime']);
}

function resetDatabaseAttempts($user)
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
        
        $queryUpdate = ("UPDATE users SET loginAttempt = 0 WHERE username = ?;");

        $updateStmt = $pdo->prepare($queryUpdate);
        $updateStmt->bindParam(1, $user);

        $updateStmt->execute();
        echo "incremented attempt";
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

function getLoginAttempt($user){
    
}

function lockUser()
{
    //Lock user for 1 min
    if(!isset($_SESSION['unlockTime'])){
        $_SESSION['unlockTime'] = time() + 60;
        echo "You've been locked out for 60 sec!";
        //echo "unlock time is: ".($_SESSION['unlockTime'] - time());
    }
    else if(time() < $_SESSION['unlockTime']){
        echo "You're still locked! Please try again in ".($_SESSION['unlockTime'] - time());
        //echo "unlock time is: ".($_SESSION['unlockTime'] - time());
    }
    else{ //if(time() >= $_SESSION['unlockTime']){
        resetAttempts();
    }
}

function login($username) {
    $_SESSION['username'] = $username;
    header("location: index.php");
    exit;
}
