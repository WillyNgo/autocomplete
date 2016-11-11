<?php

/**
 * Creates an array from the cities.txt and fills it with each line of the txt.
 * Adds each line, substringing the appropriate information, into the database 
 */
try {
    $pdo = new PDO('mysql:host=localhost;dbname=homestead', "homestead", "secret");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $cityList = file('cities.txt');
    for ($i = 0; $i < count($cityList); $i++) {
        //$line is an array that contains
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
        $query = "INSERT INTO cities (population, cityname) VALUES (?, ?);";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(1, $pop);
        $stmt->bindParam(2, $name);

        $stmt->execute();
        echo "Inserted " . $name . " entry \n";
    } catch (PDOException $pdoe) {
        $pdoe->getMessage();
    } finally {
        unset($pdo);
    }
}
?>

