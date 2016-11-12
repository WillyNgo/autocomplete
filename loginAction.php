<?php

function incrementAttempt($user) {
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
            }
        }
        
        //Update attempt number and set to users table
        $attempts++;
        $queryUpdate = ("UPDATE users SET loginAttempt = ? WHERE username = ?;");

        $updateStmt = $pdo->prepare($queryUpdate);
        $updateStmt->bindParam(1, $attempts);
        $updateStmt->bindParam(2, $user);

        $stmt->execute();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
