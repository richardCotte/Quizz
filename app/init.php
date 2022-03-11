<?php

$host = "localhost";
$dbName = "quizz";
$dbUserName = "root";
$dbPassword = "";

try {

    $db = new PDO('mysql:host=' . $host . ';dbname=' . $dbName, $dbUserName, $dbPassword);
} catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";

    die();
}
