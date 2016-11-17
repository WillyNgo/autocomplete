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

function isValidCity($city){
    $pdo = getDbConnection();
    $query = "SELECT cityname FROM cities WHERE cityname = ?;";
    $doesExists = false;
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(1, $city);
    if($stmt->execute()){
        $row = $stmt->fetchColumn();
        
        //If something was retrieved,, return true
        if($row != ''){
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
*/