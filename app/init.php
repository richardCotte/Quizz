<?php

try {

    $db = new PDO('mysql:host=localhost;dbname=quizz', 'root', '');
} catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";

    die();
}
