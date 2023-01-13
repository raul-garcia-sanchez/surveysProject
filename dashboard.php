<?php 
session_start();
$_SESSION["rol"] = "Professor";
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Bienvenido</title>
</head>

<body class="dashboard">
    <header>
    </header>
    <?php 
    echo $_SESSION["rol"];
        if($_SESSION["rol"]=="Admin"){
            echo '
            <div class="card" id="dashboard-admin">
            <h1>Dashboard Admin</h1>
                <div class="card-content">
                    <a href=""><button><h1>Usuarios</h1></button></a>
                    <a href=""><button><h1>Encuestas</h1></button></a>
                    <a href=""><button><h1>Estadisticas</h1></button></a>
                </div>
            </div>
            ';
             }else if($_SESSION["rol"]=="Professor"){
                echo '
                <div class="card" id="dashboard-professor">
                <h1>Dashboard Professor</h1>
                    <div class="card-content">
                        <a href=""><button><h1>Estadisticas</h1></button></a>
                    </div>
                </div>
            ';
             } ?>

    <footer></footer>
</body>

</html>