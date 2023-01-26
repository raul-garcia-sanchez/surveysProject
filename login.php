<?php session_start();
include './resources/auxFunctions.php';
    if(isset($_POST["logout"])){
        try{
            $user = $_SESSION["user"]["username"];
            session_destroy();
            unset($_POST["logout"]);
            appendLog("S", "User " . $user . " has successfully logout");
            printAlertJs("T'has desloguat correctament",'s');
        }catch (Exception $e){
            $user = $_SESSION["user"]["username"];
            printAlertJs("Ha passat un problema al logout",'e');
            appendLog("E", $e->getMessage());
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Iniciar sessió</title>
    <script src="resources/functions.js"></script>
</head>

<body class="page-login">

    <?php
    printHeaderBeforeLogin("Enquestes IETI");
    echo '<div id="divAlertas"></div>';
    try {
        $hostname = "20.107.55.123";
        $dbname = "surveys_database";
        $username = "database_survey_user";
        $pw = "surv3ys_d@t2b@s3 database";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
        appendLog("S", "Successful connection to the database");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        printAlertJs("Hi ha hagut un problema en connectar-te amb la base de dades",'e');
        appendLog("E", "Failed to get DB handle: " . $e->getMessage());
        exit;
    }

    if (isset($_POST["submit"])) {
        $password = hash('sha256', $_POST["password"]);
        $query = $pdo->prepare("select id, username, password, role from users where username = :username and password = :password");
        $query->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $userExist = $query->fetch(PDO::FETCH_ASSOC);
        $queryText = "select id, username, password, role from users where username = '".$_POST["username"]."' and password = '".$password."'";
        if ($userExist) {
            $_SESSION['user'] = $userExist;
            appendLog("S", "The user successfully connected with the username " . $_POST["username"] . " and the encrypted password ".$password." - ".$queryText);
            header("Location:  dashboard.php");
            die();
        } else {
            printAlertJs('Usuari o contrasenya invàlids','e');
            appendLog("W", "The user tried to connect with the username " . $_POST["username"] . " and the encrypted password ".$password. " - " .$queryText);
        }
    }

    ?>

    <div class="card">
        <h1>Iniciar sessió</h1>
        <form action="" method="POST">
            <div class="inputsLogin">
                <input type="text" name="username" required>
                <span></span>
                <label>Usuari</label>
            </div>
            <div class="inputsLogin">
                <input type="password" name="password" required>
                <span></span>
                <label>Contrasenya</label>
            </div>
            <div class="recoverPassword">Has oblidat la teva contrasenya?</div>
            <input class="buttonSubmit" type="submit" value="Inciar sessió" name="submit">
        </form>
        <p class="messageError">
        </p>
    </div>


    <?php

    printFooterBeforeLogin();

    ?>

</body>

</html>
<?php
    appendLog("S", "The page " . $_SERVER['PHP_SELF'] . " has loaded successfully");
?>