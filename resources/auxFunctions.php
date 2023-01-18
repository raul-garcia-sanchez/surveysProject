<?php

function createHeader($title)
{
    echo "<header class='afterLogin'>";
    echo "<h1>" . $title . "</h1>";
    echo "<p><i class='fa fa-user' aria-hidden='true'></i>" . $_SESSION["user"]["username"] . "</p>";
    echo "</header>";
}

function printHeaderBeforeLogin($title)
{
    echo "<header class='beforeLogin'>";
    echo "<h1 class='h1-center'>" . $title . "</h1>";
    echo "</header>";
}

function createFooter()
{
    echo "<footer class='footerAfterLogin'>";
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

function printFooterBeforeLogin()
{
    echo "<footer class='footerBeforeLogin'>";
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
        $pw = "";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $query = $pdo->prepare('select title from surveys;');
    $query->execute();

    $row = $query->fetch();
    $texto = "<div id='divListSurveys' class='divLlistat'>";
    $texto .= "<table><tr><th class='thTittle'>Titol Enquesta</th><th class='thOperations'>Operacions</th></tr>";
    while ($row) {
        $texto .= "<tr><td>" . $row["title"] . "<td class='tdOperations'><i class='fa fa-pencil-square-o' aria-hidden='true'></i><i class='fa fa-trash-o' aria-hidden='true'></i></td></tr></td>";
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
        $pw = "";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $query = $pdo->prepare('select title from questions;');
    $query->execute();

    $row = $query->fetch();
    $texto = "<div id='divListQuestions' class='divLlistat'>";
    $texto .= "<table><tr><th class='thTittle'>Titol Pregunta</th><th class='thOperations'>Operacions</th></tr>";
    while ($row) {
        $texto .= "<tr><td>" . $row["title"] . "<td class='tdOperations'><i class='fa fa-pencil-square-o' aria-hidden='true'></i><i class='fa fa-trash-o' aria-hidden='true'></i></td></tr></td>";
        $row = $query->fetch();
    }
    $texto .= "</table></div>";
    unset($query);
    unset($pdo);
    return $texto;
}

function addQuestion()
{
    try {
        $hostname = "127.0.0.1";
        $dbname = "surveys_database";
        $username = "root";
        $pw = "";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    try {
        $query = $pdo->prepare('INSERT INTO questions (id_survey, title, active, type) VALUES(?,?,?,?)');
        $idSurvey = 1;
        $titleQuestion = "Aprovaràn aquests nois el projecte?";
        $questionActive = 1;
        $typeQuestion = 'text';
        $query->bindParam(1, $idSurvey);
        $query->bindParam(2, $titleQuestion);
        $query->bindParam(3, $questionActive);
        $query->bindParam(4, $typeQuestion);
        $query->execute();
    } catch (Exception $e) {
        echo $e;
    }

    unset($query);
    unset($pdo);
}