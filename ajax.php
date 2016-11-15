<?php
header('Content-Type:application/json');

require_once('dbUtility.php');
$pdo = getDbConnection();
$query = "SELECT weight, cityname FROM cities WHERE cityname LIKE ? ORDER BY weight ASC LIMIT 5;";

$stmt = $pdo->prepare($query);
$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "City");    
    //Append % so that it acts like a wild card in the select query
$keyword = $_GET['keyword'];
$keyword = $keyword.'%';
$stmt->bindParam(1, $keyword);
    
$results = array();
if($stmt->execute()){
    //Results is an array containing city objects
    $results = $stmt->fetchAll();
}

echo json_encode($results);