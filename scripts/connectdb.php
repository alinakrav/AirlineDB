<?php
// Dev connection 
// $host = "localhost";
// $db = "airlineDB";
// $user = "root";
// $pass = "";

// Remote database connection
$host = "remotemysql.com";
$db = "bCsbNvwfY7";
$user = "bCsbNvwfY7";
$pass = "E7Pqc3rxFs";

$dsn = "mysql:host=$host;dbname=$db";

try {
    $connection = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    print "Error!: ". $e->getMessage(). "<br/>";
    die();
}
