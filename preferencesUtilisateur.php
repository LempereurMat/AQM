<?php
    include "config.php";
    include "function.php";
    
    if (!isset($_SESSION['username'])){
        header('location: login.php');
        exit();
    }
    
    if (isset($_POST["oldpassword"])) {
        if (md5($_POST["oldpassword"])==$_SESSION["password"]) {
            $SQL = "UPDATE utilisateur SET ";
            
            $attributsSET = "";
            if (isset($_POST["nom"])) $attributsSET = $attributsSET."nom='".$_POST["nom"]."',";
            if (isset($_POST["prenom"])) $attributsSET = $attributsSET."prenom='".$_POST["prenom"]."',";
            if (isset($_POST["password"])) $attributsSET = $attributsSET."password='".md5($_POST["password"])."',";
            if (isset($_POST["email"])) $attributsSET = $attributsSET."email='".$_POST["email"]."',";
            
            if ($attributsSET!="") {
                //On supprime la dernière virgule
                $SQL = substr($SQL, 0, -1);
                $SQL = $SQL." WHERE id='".$_SESSION["id"]."';";
                $db->query($SQL);
            }
            message("Informations modifiées", "green");
        }
        else {
            message("Mot de passe incorrect","red");
        }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet"/>
    <!-- Style.css -->
    <link rel="stylesheet" href="style.css" type="text/css"/>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  </head>
  <body>
        <div class="background">

        <img class="bgImg" src="img/index.png" alt=""/>

        <style>

            .twoButtonsDiv {
                display:inline-block;
                width:200px;
            }

            .inputText {
                font-family: 'Raleway', sans-serif;
                font-weight:200;
                transition: background-color 0.5s ease;
                background-color:rgba(255,255,255,0);
                color:white;
                border-style:solid;
                border-color:white;
                border-radius:25px;
                padding:10px;
                width:40%;
                text-align:center;
            }

            .inputText:focus {
                outline:none;
                background-color:rgba(255,255,255,0.2);
            }

        </style>

        <script>
            function scrollButton(y) {
                $("html,body").animate({scrollTop:y}, 600, 'swing');
            }
        </script>

		<div class="centerDiv" style="top:100px;width:60%;">
        <h3 style="color:white;">Utilisateur : <span style="color:#ff8c1a;font-style:italic;"><?php echo $_SESSION['username'] ?></span></h3><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="document.location='index.php'"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(700)"><h4><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;right:20px;">Commencer</h5></div>
            </div>
        </div>

        <form id="formPreferencesUtilisateur" action="preferencesUtilisateur.php" method="POST">

        <div class="centerDiv" style="top:800px;width:60%;">
            <h3 style="color:white;">Nom</h3>
            <input type="text" class="inputText" id="nom" name="nom" value="<?php echo $_SESSION['nom'] ?>" onkeyup="if(event.keyCode==13)scrollButton(1400);"/><br/><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(1400)"><h4>
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:1500px;width:60%;">
            <h3 style="color:white;">Prénom</h3>
            <input type="text" class="inputText" id="prenom" name="prenom" value="<?php echo $_SESSION['prenom'] ?>" onkeyup="if(event.keyCode==13)scrollButton(2100);"/><br/><br/>
            <div class="twoButtonsDiv">
            <div style="float:left;" class="buttonClassic" onclick="scrollButton(700)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
            <div style="float:right;" class="buttonClassic" onclick="scrollButton(2100)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:2200px;width:60%;">
            <h3 style="color:white;">Mot de passe</h3>
            <input type="text" class="inputText" id="password" name="password" placeholder="Vide pour laisser inchangé" onkeyup="if(event.keyCode==13)scrollButton(2800);"/><br/><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(1400)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(2800)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:2900px;width:60%;">
            <h3 style="color:white;">E-mail</h3>
            <input type="text" class="inputText" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="... @ ..." onkeyup="if(event.keyCode==13)scrollButton(2100);"/><br/><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(2100)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(3500)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:3600px;width:60%;">
            <h3 style="color:white;">Confirmation</h3>
            <input type="text" class="inputText" id="oldpassword" name="oldpassword" placeholder="Ancien mot de passe" onkeyup="if(event.keyCode==13)scrollButton(2100);"/><br/><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(2800)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="document.getElementById('formPreferencesUtilisateur').submit();"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Ajouter</h5></div>
            </div>
        </div>

        </form>

        <div class="centerDiv" style="top:4000px;visibility:hidden;width:60%;"></div>

        <div class="goTopButton" onclick="scrollButton(0)"><h4 style="padding-right:2px;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></h4></div>

        <?php
            nav("Param&egravetres");
        ?>
    </div>
  </body>
</html>
