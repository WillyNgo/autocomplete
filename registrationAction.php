<?php
/**
 * Adds a new user to the Users table in the database.
 * 
 * @param String $username
 * @param String $password
 */
function registerUser($username, $password)
{
    //BEFORE THIS DO BEST PRACTICE
    //Hash the password
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
        $query=("INSERT INTO users(username, hashedPassword, loginAttempt) VALUES (?, ?, ?);");
        $attempts = 0;
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $hashPassword);
        $stmt->bindParam(3, $attempts);
        
        if($stmt->execute())
        {
            echo "<p>Registered a new user! Welcome: ".$username."</p>";
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

