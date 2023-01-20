<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Iniciar sessió</title>
</head>

<body class="page-login">

    <?php

    include './resources/auxFunctions.php';
    printHeaderBeforeLogin("Enquestes IETI");

    try {
        $hostname = "20.107.55.123";
        $dbname = "surveys_database";
        $username = "database_survey_user";
        $pw = "surv3ys_d@t2b@s3 database";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    if (isset($_POST["submit"])) {
        $errorMSG = "";
        $password = hash('sha256', $_POST["password"]);
        $query = $pdo->prepare("select id, username, password, role from users where username = :username and password = :password");
        $query->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $userExist = $query->fetch(PDO::FETCH_ASSOC);

        if ($userExist) {
            $_SESSION['user'] = $userExist;
            header("Location:  dashboard.php");
        } else {
            $errorMSG = "Usuari o contrasenya invàlids";
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
            <?php
            if (isset($errorMSG))
                echo $errorMSG;
            ?>
        </p>
    </div>


    <?php

    printFooterBeforeLogin();

    ?>

</body>

</html>