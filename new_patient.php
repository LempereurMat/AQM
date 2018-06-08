<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}
else if ($_SESSION['type']!="Administrator" && $_SESSION['type']!="Manager") {
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
        @keyframes swipeLeft {
            0% {left:-40%}
            100% {left:8%}
        }

        @keyframes swipeRight {
            0% {right:-40%}
            100% {right:8%}
        }

        .enfantDiv {
            animation:swipeLeft 1.5s ease;
            transition: box-shadow 0.5s ease;
            border-radius:10px;
            background-color:rgba(0,0,0,0.5);
            position:fixed;
            border-width:2px;
            border-color:white;
            border-style:solid;
            text-align:center;
            width:38%;
            left:8%;
            top:35%;
            color:white;
            padding:45px;
            padding-top:70px;
            padding-bottom:70px;
        }

        .adulteDiv {
            animation:swipeRight 1.5s ease;
            transition: box-shadow 0.5s ease;
            border-radius:10px;
            background-color:rgba(0,0,0,0.5);
            position:fixed;
            border-width:2px;
            border-color:white;
            border-style:solid;
            text-align:center;
            width:38%;
            right:8%;
            top:35%;
            color:white;
            padding:45px;
            padding-top:70px;
            padding-bottom:70px;
        }

        .enfantDiv:hover, .adulteDiv:hover {
            cursor:pointer;
            box-shadow: 0 0 15px white;
        }

    </style>

    <div class="background">
        <img class="bgImg" src="img/index.png" alt=""/>

        <div class="enfantDiv" onclick="document.location='new_child.php'"><h3>Enfant</h3></div>

        <div class="adulteDiv" onclick="document.location='new_adult.php'"><h3>Adulte</h3></div>

        <?php
            nav("Patients");
        ?>

    </div>
  </body>
</html>
