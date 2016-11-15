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
