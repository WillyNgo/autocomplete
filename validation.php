<?php


/**
 * This method checks the information submitted with the information in the database
 * to check if the credentials are matching.
 * Returns true if credentials are correct.
 * 
 * @param String $user
 * @param String $submittedPassword
 * @return boolean $isAuthenticated
 */
function validatePassword($user, $submittedPassword)
{
    $isAuthenticated = false;
    $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
    $query = "SELECT username, hashedPassword FROM users WHERE username = ?";
    
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(1, $user);
    
    //If a username was matched, check for password;
    if($stmt->execute())
    {
        while($row = $stmt->fetch()){
            $isAuthenticated = password_verify($submittedPassword, $row['hashedPassword']);
        }
    }
    
    return $isAuthenticated;
}

/**
 * When user registers, this method checks in the database if a username 
 * already exists.
 * 
 * returns true if there is an existing username.
 * @param String $submittedUsername
 * @return boolean $doesExists
 */
function usernameExists($submittedUsername)
{
    $doesExists = false;
    $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
    $query = "SELECT username FROM users WHERE username = ?";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(1, $submittedUsername);
    
    if($stmt->execute())
    {
        if($stmt->rowCount() == 1){
            $doesExists = true;
        }
    }
    
    return $doesExists;
}