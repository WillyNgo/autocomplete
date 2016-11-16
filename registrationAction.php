<?php
/**
 * This php file takes care of registrating a new user
 */
include('dbUtility.php'); //For access to database
include('loginAction.php'); //To login when user successfully registers.
session_start();
session_regenerate_id();

/**
 * Adds a new user to the Users table in the database.
 * 
 * @param String $user
 * @param String $password
 */
function registerUser($user, $password)
{
    //BEFORE THIS DO BEST PRACTICE
    //Hash the password
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
    try{
        $pdo = getDbConnection();
        $query = ("INSERT INTO users(username, hashedPassword) VALUES (?, ?);");
        $attempts = 0;
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $hashPassword);
        
        //If user has been successfully added to the database, automatically log in
        if($stmt->execute()){
            echo "<script type='text/javascript'>alert('USERNAME IS: $user');</script>";
            login($user);
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
    finally{
        unset($pdo);
    }
}

