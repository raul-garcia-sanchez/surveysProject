<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Enquestes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="page-poll">
    <div class="global-container">
        <?php

        include './resources/auxFunctions.php';
        createHeader("Enquestes Admin");
        echo $_SESSION['user']["role"];
        if ($_SESSION['user']["role"] == "admin") {
            echo "
        <div class='card' id='dashboard-professor'>
        <div class='card-content'>
                <button onclick='crearQuestionarioPregunta()'>
                    <h3>Crear pregunta</h3>
                </button>
                
                <button onclick='crearListadoPreguntas()'>
                    <h3>Llistat de preguntes</h3>
                </button>
                <button onclick='crearListadoEnquestas()'>
                    <h3>Llistat d'enquestes</h3>
                </button>
                
                <button onclick='crearQuestionarioEncuesta()'>
                    <h3>Crear enquesta</h3>
                </button>
        </div>
        <div id='contenidoPrincipal'>" . printSurveys() . "</div>
    </div>
        ";
        }

        if(isset($_POST['submitButtonSaveQuestion'])){
            addQuestion();
        }
        createFooter();

        ?>
    </div>
    <script src="./resources/functions.js"></script>
</body>

</html>