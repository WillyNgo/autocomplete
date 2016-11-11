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
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
        $query=("INSERT INTO users(username, password) VALUES (?, ?);");
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        
        $stmt->execute();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

