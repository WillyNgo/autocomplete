<?php
session_start();
header('Content-Type:application/json');
require('dbUtility.php');
$pdo = getDbConnection();
$cityQuery = "SELECT weight, cityname FROM cities WHERE cityname LIKE ? ORDER BY weight DESC LIMIT 5;";
/*
$historyQuery = "SELECT weight, cityname FROM history WHERE username = ?;";

$historyStmt = $pdo->prepare($historyQuery);

$historyStmt->bindParam(1, $SESSION['username']);

//TODO: Take history entries and put them in the array before
//Then do cities while checking if its already in the array.
if($historyStmt->execute()){
    $row = $historyStmt->fetch();
    $cityname = $row['cityname'];
    $weight = $row['weight'];
}
*/


//Preparing city Query
$stmt = $pdo->prepare($cityQuery);
//set fetchmode to fetch_class to create a City obj
$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "City");    
//Append % so that it acts like a wild card in the select query
$keyword = $_GET['keyword'];

$keyword = $keyword.'%';
$stmt->bindParam(1, $keyword);
    
//Preparing history Query


if($stmt->execute()){
    //Results is an array containing city objects
    $results = $stmt->fetchAll();
}

//Send array to ajax.php
echo json_encode($results);