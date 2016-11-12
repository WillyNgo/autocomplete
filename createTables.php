<?php
/*
 * This php file will create (and drop if already exists) the tables necessary 
 * for the project. There are 2 tables: cities and users.
 */
try {
    $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
    $dropQuery = "DROP TABLE IF EXISTS users;\n"
            . "DROP TABLE IF EXISTS cities;";
    $citiesQuery = "CREATE TABLE cities("
            . 'id INT PRIMARY KEY AUTO_INCREMENT,'
            . 'population INT,'
            . 'cityname VARCHAR(255)'
            . ');';
    $usersQuery = "CREATE TABLE users("
            . "id INT PRIMARY KEY AUTO_INCREMENT,"
            . "username VARCHAR(255),"
            . "hashedPassword VARCHAR(255),"
            . "loginAttempt INT"
            . ");";
    
    $pdo->exec($dropQuery);
    $pdo->exec($citiesQuery);
    $pdo->exec($usersQuery);
    
    
    checkIfTablesExists($pdo, "cities");
    checkIfTablesExists($pdo, "users");
} catch (PDOException $pdoe) {
    echo $pdoe->getMessage();
} finally {
    unset($pdo);
}

/**
 * Method checks if table has been created by selecting an item and checking if
 * it is empty. Prints a message informing whether the table exists or not.
 * 
 * @param PDO $pdo
 * @param String $tablename
 */
function checkIfTablesExists($pdo, $tablename) {
    $tableCheck = $pdo->query("SELECT * FROM $tablename");
    if (!empty($tableCheck)) {
        echo "Table: ".$tablename." exists\n";
    } else {
        echo "Table: ".$tablename." not created\n";
    }
}

?>
