<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
    header('location: login.php');
    exit();
}
else if ($_SESSION['type'] != "Administrator" && $_SESSION['type'] != "Manager") {
    header('location: index.php');
    exit();
}
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BDD AQM</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet"/>
    <!-- Style.css -->
    <link rel="stylesheet" href="style.css" type="text/css"/>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  </head>
  <body>
    <style>
        .utilisateurDiv, .chuDiv, .importerDiv {
            transition: box-shadow 0.5s ease;
            border-radius:10px;
            background-color:rgba(0,0,0,0.5);
            position:fixed;
            border:2px solid white;
            text-align:center;
            width:38%;
            color:white;
            padding:45px;
            padding-top:70px;
            padding-bottom:70px;
        }

        @keyframes swipeLeft {
            0% {left:-40%}
            100% {left:8%}
        }

        @keyframes swipeRight {
            0% {right:-40%}
            100% {right:8%}
        }

        @keyframes swipeUp {
            0% {bottom:-40%}
            100% {bottom:12%}
        }

        .utilisateurDiv {
            left:8%;
            top:15%;
            animation:swipeLeft 1.5s ease;
        }

        .chuDiv {
            right:8%;
            top:15%;
            animation:swipeRight 1.5s ease;
        }

        .importerDiv {
            bottom:12%;
            left:31%;
            animation:swipeUp 1.5s ease;
        }

        .utilisateurDiv:hover, .chuDiv:hover, .importerDiv:hover {
            cursor:pointer;
            box-shadow: 0 0 15px white;
        }

    </style>

    <div class="background">
        <img class="bgImg" src="img/index.png" alt=""/>

        <div class="utilisateurDiv" onclick="document.location='utilisateur.php'"><h3>Utilisateurs</h3></div>

        <?php
            if ($_SESSION['type']=="Manager")
                echo '<div class="chuDiv" onclick="document.location=\'chu.php\'"><h3>Hôpital</h3></div>';
            else
                echo '<div class="chuDiv" onclick="document.location=\'chu.php\'"><h3>Hôpitaux</h3></div>'
            ?>

        <div class="importerDiv" onclick="document.location='adminImport.php'"><h3>Importer</h3></div>

        <?php
            nav("Admin");
        ?>

    </div>

  </body>
</html>
