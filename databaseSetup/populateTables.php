<?php
/**
 * This php file will populate the cities table by an array from the cities.txt and fills it with each line of the txt.
 * Adds each line, substringing the appropriate information, into the database 
 */

include('dbUtility.php');

try {
    $pdo = getDbConnection();
    
    $cityList = file('cities.txt');
    
    //Populate the table by going through each line of the cities.txt and inserting them to the table.
    for ($i = 0; $i < count($cityList); $i++) {
        $line = explode(";", $cityList[$i]);
        $population = trim($line[0]);
        $cityname = trim($line[1]);

        insertToDatabase($pdo, $population, $cityname);
    }
} catch (PDOException $pdoe) {
    $pdoe->getMessage();
} finally {
    unset($pdo);
}

/**
 * Inserts cities information into the database
 * @param type $pop
 * @param type $name
 */
function insertToDatabase($pdo, $pop, $name) {
    try {
        $query = "INSERT INTO cities (cityname, weight) VALUES (?, ?);";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $pop);

        $stmt->execute();
        echo "Inserted " . $name . " entry \n";
    } catch (PDOException $pdoe) {
        $pdoe->getMessage();
    } finally {
        unset($pdo);
    }
}
?>

