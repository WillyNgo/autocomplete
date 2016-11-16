<?php
/*
 * This php file will create (and drop if already exists) the tables necessary 
 * for the project. There are 2 tables: cities and users.
 */
require('dbUtility.php');
try {
    $pdo = getDbConnection();
    
    createCities($pdo);
    createUsers($pdo);
    createHistory($pdo);
    
} catch (PDOException $pdoe) {
    echo $pdoe->getMessage();
} finally {
    unset($pdo);
}

function createCities($pdo){
    dropTable($pdo, "cities");
    $citiesQuery = "CREATE TABLE cities("
            . 'cityname VARCHAR(255) PRIMARY KEY,'
            . 'weight INT'
            . ');';
    
    $pdo->exec($citiesQuery);
    
    
    checkIfTablesExists($pdo, "cities");
}

function createHistory($pdo){
    dropTable($pdo, "history");
    $historyQuery = "CREATE TABLE history("
            . 'id INT PRIMARY KEY AUTO_INCREMENT,'
            . 'username VARCHAR(255),'
            . 'cityname VARCHAR(255),'
            . 'weight INT'
            . ');';
    
    $pdo->exec($historyQuery);
    
    checkIfTablesExists($pdo, "history");
}

/**
 * Creates a user table
 * @param type $pdo
 */
function createUsers($pdo){
    dropTable($pdo, "users");
    $usersQuery = "CREATE TABLE users("
            . "id INT PRIMARY KEY AUTO_INCREMENT,"
            . "username VARCHAR(255),"
            . "hashedPassword VARCHAR(255)"
            . ");";
    
    $pdo->exec($usersQuery);
    
    checkIfTablesExists($pdo, "users");
}

/**
 * Method checks if table has been created by selecting an item and checking if
 * it is empty. Prints a message informing whether the table exists or not.
 * 
 * @param PDO $pdo
 * @param String $tablename
 */
function checkIfTablesExists($pdo, $tablename) {
    //No prepared statement because only for pgrammers side
    $tableCheck = $pdo->query("SELECT * FROM $tablename");
    if (!empty($tableCheck)) {
        echo "Table: ".$tablename." exists\n";
    } else {
        echo "Table: ".$tablename." not created\n";
    }
}

function dropTable($pdo, $tablename){
    $dropQuery = "DROP TABLE IF EXISTS $tablename;";
    $pdo->exec($dropQuery);
}

?>
