<?php
/**
 * Contains utility methods for database managing
 * @return \PDO
 */
function getDbConnection(){
    $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function getFromHistory($user){
    $pdo = getDbConnection();
    $query = "SELECT cityname FROM history WHERE username = ?;";
    
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(1, $user);
    
    if($stmt->execute()){
        
    }
}

function addToHistory($user, $city){
    try{
        $pdo = getDbConnection();
    $query = "INSERT INTO history(username, cityname, weight) VALUES (?, ?, ?);";
    $weight = 0;
    
    //Check if user input is a valid city
    //If it's not valid city, weight will be 0. Still insert into database
    if(isValidCity($city)){
        $weight = getWeightFromCity($city);
    }
    
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(1, $user);
    $stmt->bindParam(2, $city);
    $stmt->bindParam(3, $weight);
    
    if($stmt->execute()){
        echo "SUCCESS!";
    }
    }
    catch(PDOException $pdoe){
        echo $pdoe->getMessage();
    }
}

/**
 * This method looks inside the cities table to check if there is an existing table
 * @param type $city
 * @return type
 */
function isValidCity($city){
    $pdo = getDbConnection();
    $query = "SELECT cityname FROM cities WHERE cityname = ?;";
    $doesExists = false;
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(1, $city);
    
    if($stmt->execute()){
        $row = $stmt->fetchColumn();
        if($row != 0){
            $doesExists = true;
        }
    }
    
    return $doesExists;
}

function getWeightFromCity($city){
    $pdo = getDbConnection();
    $query = "SELECT weight FROM cities WHERE cityname = ?";
    $weight = 0;
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(1, $city);
    
    if($stmt->execute()){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $weight = $row['weight'];
    }
    
    return $weight;
}

/**
 * 
 * @param string $keyword
 * @return type
 */
function searchCity($keyword){
    $pdo = getDbConnection();
    $query = "SELECT cityname FROM cities WHERE cityname LIKE ? ORDER BY cityname ASC;";
    $stmt = $pdo->prepare($query);
    
    //Append % so that it acts like a wild card in the select query
    $keyword = $keyword.'%';
    $stmt->bindParam(1, $keyword);
    
    $results = array();
    if($stmt->execute()){
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    return $results;
}
