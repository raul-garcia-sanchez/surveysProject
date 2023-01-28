<?php

function createHeader($title)
{
    echo "<header class='afterLogin'>";
    echo "<h1>" . $title . "</h1>";
    echo "<div class='userDiv'><p><i class='fa fa-user' aria-hidden='true'></i>" . $_SESSION["user"]["username"] . "</p>";
    echo "<form action='login.php' method='post'>";
    echo "<input type='submit' value='Logout' name='logout' class='logoutSubmit'>";
    echo "</form>";
    echo "</div>";
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
        $hostname = "20.107.55.123";
        $dbname = "surveys_database";
        $username = "database_survey_user";
        $pw = "surv3ys_d@t2b@s3 database";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
        appendLog("S", "Successful connection to the database");
    } catch (PDOException $e) {
        printAlertJs("Hi ha hagut un problema en connectar-te amb la base de dades",'e');
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        appendLog("E", "Failed to get DB handle: " . $e->getMessage());
        exit;
    }

    try {
        $queryText = 'select title from surveys;';
        $query = $pdo->prepare($queryText);
        $query->execute();
        appendLog("S", "Query executed successfully - '" . $queryText . "'");
    } catch (PDOException $e) {
        appendLog("E", $e->getMessage() . " - Failed to execute the query - ".$queryText);
        printAlertJs("Hi ha hagut un problema en connectar-te amb la base de dades",'e');
    }
    

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
    printAlertJs("S'ha carregat correctament el llistat d'enquestes",'i');
    return $texto;
}

function printQuestions()
{
    try {
        $hostname = "20.107.55.123";
        $dbname = "surveys_database";
        $username = "database_survey_user";
        $pw = "surv3ys_d@t2b@s3 database";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        appendLog("E", "Failed to get DB handle: " . $e->getMessage());
        exit;
    }

    try {
        $queryText = 'select title from questions;';
        $query = $pdo->prepare($queryText);
        $query->execute();
        appendLog("S", "Query executed successfully - '" . $queryText . "'");
    } catch (PDOException $e) {
        appendLog("E", $e->getMessage() . " - Failed to execute the query - '".$queryText);
    }
    
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
        $hostname = "20.107.55.123";
        $dbname = "surveys_database";
        $username = "database_survey_user";
        $pw = "surv3ys_d@t2b@s3 database";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
        appendLog("S", "Successful connection to the database");
    } catch (PDOException $e) {
        printAlertJs("Hi ha hagut un problema en connectar-te amb la base de dades",'e');
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        appendLog("E", "Failed to get DB handle: " . $e->getMessage());
        exit;
    }   

    $questionType = $_POST['selectTypeQuestion'];
    if($questionType == "text" || $questionType == "number" || $questionType == "opcioSimple"){
        try {
            $questionText = $_POST['questionInput'];
            $query = $pdo->prepare('INSERT INTO questions (id_survey, title, active, type) VALUES(1,?,1,?)');
            $query->bindParam(1, $questionText); 
            $query->bindParam(2, $questionType);
            $query->execute();

            $queryText = 'INSERT INTO questions (id_survey, title, active, type) VALUES(1,'.$questionText.',1,'.$questionType.')';
            appendLog("S", "Successful insertion of the question: ".$questionText." - ".$queryText);
        } catch (PDOException $e) {
            $queryText = 'INSERT INTO questions (id_survey, title, active, type) VALUES(1,'.$questionText.',1,'.$questionType.')';
            printAlertJs("No s'ha pogut afegir la questio a la base de dades",'e');
            appendLog("E", "Failed to add question ".$questionText." in the database: " . $e->getMessage() . " - ". $queryText);
            return;
        }
    }
    if($questionType == "opcioSimple"){
        $i = 0;
        while(isset($_POST[strval($i)])){
            try {
                $questionText = $_POST['questionInput'];
                $subQuery = 'select id from questions where title = "'.$questionText.'" and type = "'.$questionType.'" limit 1';
                $queryText = 'INSERT INTO options (option_text, id_question) VALUES('.$_POST[strval($i)].',('.$subQuery.'))';

                $query = $pdo->prepare("INSERT INTO options (option_text,id_question) VALUES(?,(select id from questions where title = ? and type = ? limit 1))");
                $query->bindParam(1, $_POST[strval($i)]);
                $query->bindParam(2, $questionText);
                $query->bindParam(3, $questionType);
                $query->execute();

                appendLog("S", "Successful insertion of the option: ".$_POST[strval($i)]." - ".$queryText);
            } catch (PDOException $e) {
                printAlertJs("No s'ha pogut afegir la opcio Nº $i a la base de dades, eliminant tota la pregunta",'e');
                $subQuery = 'select id from questions where title = "'.$questionText.'" and type = "'.$questionType.'" limit 1';
                $queryText = 'INSERT INTO options (option, id_question) VALUES('.$questionText.',('.$subQuery.'))';
                appendLog("E", "Failed to add option ".$_POST[strval($i)]." in the database: " . $e->getMessage() . " - ". $queryText);

                for ($i; $i >= 0;$i--){
                    try{
                        $queryText = "delete from questions where option_text = ".$_POST[strval($i)]." and id_question = (".$subQuery.")";
                        $query = $pdo->prepare("delete from questions where option_text = ? and id_question = (select id from questions where title = ? and type = ? limit 1)");
                        $query->bindParam(1, $_POST[strval($i)]);
                        $query->bindParam(2, $questionText);
                        $query->bindParam(3, $questionType);
                        $query->execute();

                        appendLog("S", "Successful drop of the option: ".$_POST[strval($i)]." - ".$queryText);
                    } catch (PDOException $e) {
                        appendLog("E", "Failed to drop option ".$_POST[strval($i)]." to the database: " . $e->getMessage() . " - ". $queryText);
                    }
                }
                
                try{
                    $queryText = "delete from question where title = '".$questionText."' and type = '" . $questionType . "'";
                    $query = $pdo->prepare("delete from question where title = ? and type = '".$questionType."'");
                    $query->bindParam(1, $questionText); 
                    $query->execute();
                    appendLog("S", "Successful drop of the question: ".$questionText." - ".$queryText);
                    return;
                } catch (PDOException $e) {
                    appendLog("S", "Failed drop of the question ".$questionText."to de database:".$e->getMessage()." - ".$queryText);
                }
            }
            $i += 1;
        }
        
    }
    

    unset($query);
    unset($pdo);
    printAlertJs("S'ha creat correctament la questio",'s');
}

function appendLog($messageTypeInitial,$message){
    $today = date("Y-m-d");
    $log = $messageTypeInitial . " - " . date("G:i:s") . " - " . getClientIP() . " - ". $message . "\n";
    file_put_contents("logs/" . $today . ".txt", $log, FILE_APPEND);
}

function getClientIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function printAlertJs($message,$type){
    echo '<script>alertCss("'.$message.'","'.$type.'")</script>';
}

function printDataBase(){
    try {
        $hostname = "20.107.55.123";
        $dbname = "surveys_database";
        $username = "database_survey_user";
        $pw = "surv3ys_d@t2b@s3 database";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        appendLog("E", "Failed to get DB handle: " . $e->getMessage());
        exit;
    }

    //Hay que printar los usuarios, todas las preguntas con su type, todos los alumnos

    //Print de la parte de usuarios
    try {
        $queryText = 'select id,username,name,role from users';
        $query = $pdo->prepare($queryText);
        $query->execute();

        echo "<div class='users'> \n";
        while($row = $query->fetch()){
            echo "<div>\n";
            echo "<p id='id'>". $row['id'] ."</p>\n";
            echo "<p id='name'>". $row['name'] ."</p>\n";
            echo "<p id='role'>". $row['role'] ."</p>\n";
            echo "</div>\n";
        }
        echo "</div>\n\n";
    } catch (PDOException $e) {
        appendLog("E", "Error trying to load database in document: " . $e->getMessage() . " - " . $queryText);
        printAlertJs("Hi ha hagut un error en carregar la pàgina",'e');
        return;
    }

    //Print de la parte de preguntas
    try {
        $queryText = 'select id,title,active,type from questions';
        $query = $pdo->prepare($queryText);
        $query->execute();

        echo "<div class='questions'>\n";
        while($row = $query->fetch()){
            echo "<div>\n";
            echo "<p id='id'>". $row['id'] ."</p>\n";
            echo "<p id='title'>". $row['title'] ."</p>\n";
            echo "<p id='active'>". $row['active'] ."</p>\n";
            echo "<p id='type'>". $row['type'] ."</p>\n";
            echo "</div>\n";
        }
        echo "</div>\n\n";
    } catch (PDOException $e) {
        appendLog("E", "Error trying to load database in document: " . $e->getMessage() . " - " . $queryText);
        printAlertJs("Hi ha hagut un error en carregar la pàgina",'e');
        return;
    }

    //Print parte alumnos
    try {
        $queryText = 'select id,username,name from students';
        $query = $pdo->prepare($queryText);
        $query->execute();

        echo "<div class='students'>\n";
        while($row = $query->fetch()){
            echo "<div>\n";
            echo "<p id='id'>". $row['id'] ."</p>\n";
            echo "<p id='name'>". $row['name'] ."</p>\n";
            echo "</div>\n";
        }
        echo "</div>\n\n";
    } catch (PDOException $e) {
        appendLog("E", "Error trying to load database in document: " . $e->getMessage() . " - " . $queryText);
        printAlertJs("Hi ha hagut un error en carregar la pàgina",'e');
        return;
    }
}