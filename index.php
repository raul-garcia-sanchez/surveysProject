<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Bienvenido</title>
</head>

<body class="page-landingPage">
    <div id="divAlertas"></div>
    <?php
    include './resources/auxFunctions.php';
    printHeaderBeforeLogin("Enquestes IETI");
    ?>
    <div id="divAlertas"></div>
    <div class="card">
        <h1>Benvingut</h1>
        <div class="card-content">
            <div id="contenido">
                <h1>Pàgina de creació d'enquestes sobre <br> el professorat</h1>
                <center><a href="login.php"><button class="buttonGoLogin">Iniciar sessió</button></a></center>
            </div>
        </div>
        
    </div>
    <i class="fa-solid fa-message displayNone animation1" id="icon1"></i>
    <i id="icon2" class="fa-solid fa-message displayNone animation2" data-fa-transform="flip-v"></i>
    <i class="fa-solid fa-message displayNone animation1" id="icon3"></i>
    <i class="fa-solid fa-message displayNone animation1" id="icon4"></i>
    <i id="icon5" class="fa-solid fa-message displayNone animation2" data-fa-transform="flip-v"></i>

    <?php

    printFooterBeforeLogin();
    
    ?>

</body>

</html>
<?php
    appendLog("S", "The page " . $_SERVER['PHP_SELF'] . " has loaded successfully");
?>