<?php
/**
 * This php file takes care of registrating a new user
 */
include('dbUtility.php'); //For access to database
include('loginAction.php'); //To login when user successfully registers.

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
            $_SESSION['username'] = $user;
            header('location: index.php');
            exit;
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

