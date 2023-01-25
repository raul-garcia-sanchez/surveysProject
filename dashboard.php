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
</head>

<body class="page-dashboard">
<div id="divAlertas"></div>
    <div class="global-container">
    <?php
    include './resources/auxFunctions.php';
    createHeader("Enquestes IETI");
    if ($_SESSION['user']["role"] == "admin") {
        echo '
            <div class="card" id="dashboard-admin">
                <div class="card-content">
                    <a href="teacher.php"><button><h1>Professors</h1></button></a>
                    <a href="poll.php"><button><h1>Enquestes</h1></button></a>
                    <a href="stats.php"><button><h1>Estadistiques</h1></button></a>
                </div>
            </div>
            ';
    } else if ($_SESSION['user']["role"] == "teacher") {
        echo '
                <div class="card" id="dashboard-professor">
                    <div class="card-content">
                        <a href="profile.php"><button><h1>Perfil</h1></button></a>
                        <a href="stats.php"><button><h1>Estadistiques</h1></button></a>
                    </div>
                </div>
            ';
    }

    createFooter();

    ?>

</div>

</body>

</html>
<?php
    appendLog("S", "The page " . $_SERVER['PHP_SELF'] . " has loaded successfully by user " . $_SESSION['user']["username"]);
?>