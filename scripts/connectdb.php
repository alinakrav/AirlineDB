<?php
// Dev connection 
// $host = "localhost";
// $db = "airlineDB";
// $user = "root";
// $pass = "";

// Remote database connection
$host = "remotemysql.com";
$db = "gmDziCtoRj";
$user = "gmDziCtoRj";
$pass = "4pIEuEWfJD";

$dsn = "mysql:host=$host;dbname=$db";

try {
    $connection = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    print "Error!: ". $e->getMessage(). "<br/>";
    die();
}
