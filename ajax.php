<?php
header('Content-Type:application/json');

require_once('dbUtility.php');
$pdo = getDbConnection();
$query = "SELECT weight, cityname FROM cities WHERE cityname LIKE ? ORDER BY weight DESC LIMIT 5;";

$stmt = $pdo->prepare($query);
//set fetchmode to fetch_class to create a City obj
$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "City");    
//Append % so that it acts like a wild card in the select query
$keyword = $_GET['keyword'];

$keyword = $keyword.'%';
$stmt->bindParam(1, $keyword);
    
if($stmt->execute()){
    //Results is an array containing city objects
    $results = $stmt->fetchAll();
}

//Send array to ajax.php
echo json_encode($results);