<?php 
session_start();
$_SESSION["rol"] = "Admin";
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bienvenido</title>
</head>

<body class="dashboard">
    <?php 
    include './resources/auxFunctions.php';
    createHeader("Enquestes IETI");
    echo $_SESSION["rol"];
        if($_SESSION["rol"]=="Admin"){
            echo '
            <div class="card" id="dashboard-admin">
            <h1>Dashboard Admin</h1>
                <div class="card-content">
                    <a href=""><button><h1>Usuaris</h1></button></a>
                    <a href=""><button><h1>Enquestes</h1></button></a>
                    <a href=""><button><h1>Estadistiques</h1></button></a>
                </div>
            </div>
            ';
             }else if($_SESSION["rol"]=="Professor"){
                echo '
                <div class="card" id="dashboard-professor">
                <h1>Dashboard Professor</h1>
                    <div class="card-content">
                        <a href=""><button><h1>Estadistiques</h1></button></a>
                    </div>
                </div>
            ';
             } 
             
             createFooter();
             ?>

    
</body>

</html>