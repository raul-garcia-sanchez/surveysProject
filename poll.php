<?php session_start();
include './resources/auxFunctions.php';
if (isset($_POST['submitButtonSaveQuestion']) && isset($_POST['selectTypeQuestion']) && isset($_SESSION['user']['username'])) {
    addQuestion();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Enquestes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="resources/functions.js"></script>
</head>

<body class="page-poll">
    <div class="global-container">
        <?php

        createHeader("Enquestes IETI");
        echo '<div id="divAlertas"></div>';
        if ($_SESSION['user']["role"] == "admin") {
        echo '<div id="divAlertas"></div>';
        echo "
        <div class='card' id='dashboard-professor'>
        <div class='card-content'>
                <button class='buttonHover' onclick='formAddQuestion()'>
                    <h3>Crear pregunta</h3>
                </button>
                
                <button class='buttonHover' onclick='printListQuestions()'>
                    <h3>Llistat de preguntes</h3>
                </button>
                <button class='buttonHover' onclick='printListSurveys()'>
                    <h3>Llistat d'enquestes</h3>
                </button>
                
                <button class='buttonHover' onclick='formAddSurvey()'>
                    <h3>Crear enquesta</h3>
                </button>
        </div>
        <div id='principalContent'>" . printSurveys() . printQuestions() . "</div>";
            if (isset($_POST['submitButtonSaveQuestion'])) {
                printAlertJs("Pregunta afegida correctament",'s');
            }
            echo "</div>";
        }
        createFooter();
        ?>
    </div>
    <script src="./resources/functions.js"></script>
</body>

</html>
<?php
    appendLog("S", "The page " . $_SERVER['PHP_SELF'] . " has loaded successfully by user " . $_SESSION['user']["username"]);
?>