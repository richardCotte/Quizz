<?php

require('class/UserClass.php');

require_once('app/init.php');

//Getting the quesitons number
$questionNumberQuery = $db->prepare("
    SELECT COUNT(*) 
    FROM questions
");

$completed = $questionNumberQuery->execute();

if ($completed) {
    $questionNbr = $questionNumberQuery->fetchColumn();
}

if (isset($_GET['fname'], $_GET['lname'], $_GET['email'])) {

    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $email = $_GET['email'];
    $devScore = 0;
    $infraScore = 0;

    //Counting the score
    for ($i = 1; $i <= $questionNbr; $i++) {

        $get = 'q' . $i;

        $isDev = $_GET[$get];

        if ($isDev == 1) {
            $devScore++;
        } elseif ($isDev == 0) {
            $infraScore++;
        }
    }

    //Getting if the user is more a dev or an infra
    if ($devScore >= $infraScore) {
        $sendIsDev = 1;
    } else {
        $sendIsDev = 0;
    }

    $user = new User($fname, $lname, $email, $sendIsDev);

    $isQueryFinished = $user->insertUserDb($db);

    if ($isQueryFinished) {
        if ($sendIsDev == 1) {
            header("Location: isDev.php");
        } elseif ($sendIsDev == 0) {
            header("Location: isInfra.php");
        }
    }
} else {
    header("Location: index.php");
}
