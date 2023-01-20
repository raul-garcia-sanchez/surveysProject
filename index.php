<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bienvenido</title>
</head>

<body class="page-landingPage">

    <?php
    include './resources/auxFunctions.php';
    printHeaderBeforeLogin("Enquestes IETI");
    ?>

    <div class="card">
        <h1>Benvingut</h1>
        <div class="card-content">
            <div id="contenido">
                <h1>Pàgina de creació d'enquestes sobre <br> el professorat</h1>
                <center><a href="login.php"><button class="buttonGoLogin">Iniciar sessió</button></a></center>
            </div>
        </div>
    </div>

    <?php

    printFooterBeforeLogin();

    ?>

</body>

</html>