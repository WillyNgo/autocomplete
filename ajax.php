<?php
session_start();
session_regenerate_id();
header('Content-Type:application/json');
require('dbUtility.php');
$pdo = getDbConnection();

$keyword = $_GET['keyword'];
$keyword = $keyword.'%';
//Prepare history query
$historyQuery = "SELECT weight, cityname FROM history WHERE username = ? AND cityname LIKE ? LIMIT 5;";
$historyStmt = $pdo->prepare($historyQuery);
$historyStmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "City");    

$historyStmt->bindParam(1, $_SESSION['username']);
$historyStmt->bindParam(2, $keyword);
$counter = 0;

if($historyStmt->execute()){
    while($row = $historyStmt->fetch()){
        $results[] = $row;
        $counter++;
    }
}

$remainder = 5 - $counter;
if($remainder < 0){
    $remainder = 0;
}

//Preparing city Query
$cityQuery = "SELECT weight, cityname FROM cities WHERE cityname LIKE ? ORDER BY weight DESC LIMIT $remainder;";
/*foreach($results as $item){
    $cityQuery = $cityQuery." AND cityname != '".$item[1]."'";
}*/
$stmt = $pdo->prepare($cityQuery);
//set fetchmode to fetch_class to create a City obj
$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "City");    
//Append % so that it acts like a wild card in the select query

$stmt->bindParam(1, $keyword);
    
//Preparing history Query


if($stmt->execute()){
    //Results is an array containing city objects
    while($row = $stmt->fetch()){
        $results[] =$row;
    }
}

//Send array to ajax.php
echo json_encode($results);