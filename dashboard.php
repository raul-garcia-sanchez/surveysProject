<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bienvenido</title>
    <script src="resources/functions.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="page-dashboard">
<div id="divAlertas"></div>
    <div class="global-container">
    <?php
    include './resources/auxFunctions.php';
    if(isset($_SESSION['user']["role"])){
        if ($_SESSION['user']["role"] == "admin") {
        createHeader("Enquestes IETI");
            echo '
                <div class="card" id="dashboard-admin">
                    <div class="card-content">
                        <a href="teacher.php"><button><h1>Professors</h1></button></a>
                        <a href="poll.php"><button><h1>Enquestes</h1></button></a>
                        <a href="stats.php"><button><h1>Estadistiques</h1></button></a>
                    </div>
                </div>
                ';
                createFooter();

        } else if ($_SESSION['user']["role"] == "teacher") {
            createHeader("Enquestes IETI");
            echo '
                    <div class="card" id="dashboard-professor">
                        <div class="card-content">
                            <a href="profile.php"><button><h1>Perfil</h1></button></a>
                            <a href="stats.php"><button><h1>Estadistiques</h1></button></a>
                        </div>
                    </div>
                ';
                createFooter();
        }
    }else{
        printAlertJs("No t'has loguejat correctament, torna al login per poder accedir!",'w');
    }


    ?>

</div>

</body>

</html>
<?php
    if(isset($_SESSION['user']["role"])){
    appendLog("S", "The page " . $_SERVER['PHP_SELF'] . " has loaded successfully by user " . $_SESSION['user']["username"]);
    }else{
    appendLog("E", "A not logged user was tried to see the page " . $_SERVER['PHP_SELF']);
    }
?>