<?php

function createHeader($title){
    echo "<header>";
    echo "<h1>".$title."</h1>";
    echo "<p><i class='fa fa-user' aria-hidden='true'></i>" . $_SESSION["user"]["username"] . "</p>";
    echo "</header>";
}

function createFooter(){
    echo "<footer>";
    echo "<div class='textFooter'>";
    echo "<p>ENQUESTES IETI</p>";
    echo "</div>";
    echo "<div>";
    echo "<p class='polices'><a href=''>Politica de Privacitat</a> - <a href=''>Politica de Cookies</a></p>";
    echo "<p>Institut Esteve Terrades I Illa - Carrer Bonavista, 70, 08940 Cornellà de Llobregat, Barcelona</p>";
    echo "</div>";
    echo "<div>";
    echo "<p><i class='fa fa-facebook-official' aria-hidden='true'></i> <i class='fa fa-twitter' aria-hidden='true'></i> <i class='fa fa-instagram' aria-hidden='true'></i> <i class='fa fa-linkedin-square' aria-hidden='true'></i></p>";
    echo "</div>";
    echo "</footer>";
}

function printSurveys()
{
    try {
        $hostname = "127.0.0.1";
        $dbname = "surveys_database";
        $username = "root";
        $pw = "admin2020";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $query = $pdo->prepare('select title from surveys;');
    $query->execute();

    $row = $query->fetch();
    $texto = "<div id='divListSurveys' class='divLlistat'>";
    $texto .= "<table><tr><th>Titol Enquesta</th><th>Operacions</th></tr>";
    while ($row) {
        $texto .= "<tr><td>" . $row["title"] . "<td><i class='fa fa-pencil-square-o' aria-hidden='true'></i><i class='fa fa-trash' aria-hidden='true'></i></td></tr></td>";
        $row = $query->fetch();
    }
    $texto .= "</table></div>";
    unset($query);
    unset($pdo);
    return $texto;
}

function printQuestions()
{
    try {
        $hostname = "127.0.0.1";
        $dbname = "surveys_database";
        $username = "root";
        $pw = "admin2020";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $query = $pdo->prepare('select title from questions;');
    $query->execute();

    $row = $query->fetch();
    $texto = "<div id='divListQuestions' class='divLlistat'>";
    $texto .= "<table><tr><th>Titol Pregunta</th><th>Operacions</th></tr>";
    while ($row) {
        $texto .= "<tr><td>" . $row["title"] . "<td></tr>";
        $row = $query->fetch();
    }
    $texto .= "</table></div>";
    unset($query);
    unset($pdo);
    return $texto;
}

