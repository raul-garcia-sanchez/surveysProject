<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Perfil</title>
    <script src="resources/functions.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="page-perfil">
    <div class="global-container">
        <div id="divAlertas"></div>
        <h1>Perfil</h1>
        <a href="dashboard.php"><button>Tornar enrere</button></a>
    </div>
    <script src="./resources/functions.js"></script>
</body>

</html>
<?php
    appendLog("S", "The page " . $_SERVER['PHP_SELF'] . " has loaded successfully by user " . $_SESSION['user']["username"]);
?>