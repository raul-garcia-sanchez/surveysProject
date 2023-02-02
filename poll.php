<?php session_start();
include './resources/auxFunctions.php';
if (isset($_POST['deleteId'])) {
    $array = explode(',',$_POST['deleteId']);
    deleteById($array[0],$array[1]);
}if (isset($_POST['updateId']) && isset($_POST['updateTitle'])){
        if(strlen($_POST['updateTitle'])>0){
            if($_POST['updateType'] == 'opcioSimple'){
                $keys = array_keys($_POST);
                foreach($keys as $key){
                    if(is_numeric($key)){
                        updateOptionById($key,$_POST[$key]);
                    }
                }
                if(!empty($_POST['deletedOptions'])){
                    $arrayIds = explode(',',$_POST['deletedOptions']);
                    foreach($arrayIds as $id){
                        deleteOptionById($id);
                    }
                }
            }
            updateQuestion($_POST['updateId'],$_POST['updateTitle'],$_POST['updateType']);
        }else{
            printAlertJs("La pregunta no s'hi ha actualitzat perquè el títol estava buit",'e');
        }
    
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
    <script src="./resources/functions.js"></script>

    <!--Imports para hacer un calendario bonito-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body class="page-poll">
    <div class="global-container">
        <?php

        createHeader("Enquestes IETI");
        echo '<div id="divAlertas"></div>';
        echo '<div id="divEliminar">
        <form action="poll.php" method="POST">
        <input type="text" style="visibility:hidden" name="deleteId" id="inpDeleteId">
        <div id="divOptionsBeforeDelete">
        <h1 id="textoAvisoBorrado">Estàs segur que ho vols esborrar?</h1>
        <input type="submit" value="Esborrar" class="buttonHover" id="buttonSubmitDelete">
        <button onclick="displayNoneForm()" id="buttonCancel" class="buttonHover" type="button">Cancelar</button>
        </div>
        </form>
        </div>';
        if ($_SESSION['user']["role"] == "admin") {
        echo '<div id="divAlertas"></div>';
        
        echo "
        <div class='card' id='dashboard-professor'>
        <div class='card-content'>
                <button class='buttonHover' id='butonCreateQuestionForm' onclick='formAddQuestion()'>
                    <h3>Crear pregunta</h3>
                </button>
                
                <button class='buttonHover' id='butonListQuestions' onclick='printListQuestions()'>
                    <h3>Llistat de preguntes</h3>
                </button>
                <button class='buttonHover' id='butonListSurveys' onclick='printListSurveys()'>
                    <h3>Llistat d'enquestes</h3>
                </button>
                
                <button class='buttonHover' id='butonCreateSurveys' onclick='formAddSurvey()'>
                    <h3>Crear enquesta</h3>
                </button>
        </div>";
        if (isset($_POST['submitButtonSaveQuestion']) && isset($_POST['selectTypeQuestion']) && isset($_SESSION['user']['username'])) {
            addQuestion();
            printAlertJs("Pregunta afegida correctament",'s');
        }
        if(isset($_POST["surveySubmit"])){
            $listOfSurvey = [];
            foreach ($_POST as $key => $value){
                $listOfSurvey[$key] = $value;
            }
            addSurvey($listOfSurvey);
            printAlertJs("Enquesta carregada correctament",'s');
        }
        echo "<div id='principalContent'>" . printSurveys() . printQuestions() . "</div>";
            echo "</div>";
        }
        createFooter();
        ?>
    </div>
    <script>
        var usersDic = <?php createUsersDic()?>;
        var questionsDic = <?php createQuestionsDic()?>;
        var studentsDic = <?php createStudentsDic()?>;
        var optionsDic = <?php createOptionsDic()?>;
    </script>
</body>
</html>
<?php
    appendLog("S", "The page " . $_SERVER['PHP_SELF'] . " has loaded successfully by user " . $_SESSION['user']["username"]);
?>