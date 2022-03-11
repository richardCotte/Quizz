<?php

require_once('app/init.php');

//Select all questions
$questionQuery = $db->prepare("
    SELECT id, question
    FROM questions
");

$completed = $questionQuery->execute();

if ($completed) {
    while ($row = $questionQuery->fetchObject()) {
        $questions[] = $row;
    }
}

//Select all choices
$choicesQuery = $db->prepare("
    SELECT id, question_id, choice, isDev
    FROM choix
");

$choicesCompleted = $choicesQuery->execute();

if ($choicesCompleted) {
    while ($row = $choicesQuery->fetchObject()) {
        $choices[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
</head>

<body>

    <form action="processing.php">

        <p>
            <label for="fname">Prénom</label>
            <input type="text" id="fname" name="fname" required>

            <label for="lname">Nom</label>
            <input type="text" id="lname" name="lname" required>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
        </p>


        <?php if (!empty($questions)) : ?>

            <!-- Display all questions -->
            <?php foreach ($questions as $index => $question) : ?>
                <div>
                    <?php echo "<h2>" . $question->question . "</h2>"; ?>

                    <?php if (!empty($choices)) : ?>

                        <!-- Display all choices for their correspounding questions -->
                        <?php foreach ($choices as $choice) : ?>

                            <?php if ($choice->question_id == $question->id) : ?>
                                <div>

                                    <input type="radio" id="c<?php echo $choice->id ?>" name="q<?php echo $index + 1 ?>" value=<?php echo $choice->isDev ?> required>
                                    <label for="c<?php echo $choice->id ?>"><?php echo $choice->choice; ?></label>

                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php else : ?>
                        <p>Désolé, pas de choix sur cette question disponibles pour le moment</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        <?php else : ?>
            <p>Désolé, pas de questions disponibles pour le moment</p>
        <?php endif; ?>

        <p>
            <input type="submit" value="Submit">
        </p>

    </form>

    <p>Réalisé par un étudiant de l'IPI : Richard Cotte</p>

</body>

</html>