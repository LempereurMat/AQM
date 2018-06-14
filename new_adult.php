<?php
    include "config.php";
    include "function.php";
    
    if (!isset($_SESSION['username'])){
        header('location: login.php');
        exit();
    }
    else if ($_SESSION['type']!="Administrator" && $_SESSION['type']!="Manager") {
        header('location: index.php');
        exit();
    }
    
    $IPP="";$civilite="";$nom="";$prenom="";$date_naissance="";$hopital="";$historique="";
    $pathologie="";$pathologieCote="";$pathologieDetails="";$pathologieCommentaire="";
    
    if (isset($_POST["IPP"])) $IPP = removeSpecialChars($_POST["IPP"]);
    if (isset($_POST["civilite"])) $civilite = removeSpecialChars($_POST["civilite"]);
    if (isset($_POST["nom"])) $nom = removeSpecialChars($_POST["nom"]);
    if (isset($_POST["prenom"])) $prenom = removeSpecialChars($_POST["prenom"]);
    if (isset($_POST["date_naissance"])) $date_naissance = removeSpecialChars($_POST["date_naissance"]);
    if ($_SESSION['type']=="Administrator" && isset($_POST["hopital"])) $hopital = removeSpecialChars($_POST["hopital"]);
    else if ($_SESSION['type']=="Manager") $hopital = $_SESSION["id_hopital"];
    if (isset($_POST["historique"])) $historique = removeSpecialChars($_POST["historique"]);
    
    if (isset($_POST["pathologie"])) $pathologie = removeSpecialChars($_POST["pathologie"]);
    if (isset($_POST["pathologieCote"])) $pathologieCote = removeSpecialChars($_POST["pathologieCote"]);
    if (isset($_POST["pathologieDetails"])) $pathologieDetails = removeSpecialChars($_POST["pathologieDetails"]);
    if (isset($_POST["pathologieCommentaire"])) $pathologieCommentaire = removeSpecialChars($_POST["pathologieCommentaire"]);
    
    if (isset($_POST["submitNewAdult"]) && $IPP!="" && $nom!="" && $prenom!="" && $date_naissance!="" && $hopital!="" && $civilite!="")
    {
        //Partie patient
		$new_date = date('Y-m-d');
        $date = DateTime::createFromFormat('d/m/Y',$date_naissance);
        $new_date = $date->format('Y-m-d');
        
        $sexe = sexe_determination($civilite);
        
        $req = $db->prepare("INSERT INTO patients(nom,prenom,IPP,date_naissance,Sexe,titre,Historique_Patient,age,hopital_ID) VALUES (?,?,?,?,?,?,?,?,?);");
        $req->execute(array($nom, $prenom, $IPP, $new_date, $sexe, $civilite, $historique, 'Adulte', $hopital));
        
        //récupération de l'ID du patient que l'on vient de créer
        $SQL = "SELECT ID_patient FROM patients ORDER BY ID_patient DESC;";
        $req = $db->prepare($SQL);
        $req->execute();
        $row = $req->fetch();
        $id = $row["ID_patient"];
        
        //Partie pathologie
        $req = $db->prepare("INSERT INTO pathologies(patients_ID_patient,patho,cote,type_patho,origine,commentaire) VALUES (?,?,?,?,?,?);");
        
        $req->execute(array($id,$pathologie,$pathologieCote,$pathologieDetails,'',$pathologieCommentaire));
        
        message("Patient créé", "green");
        echo '<form id="formNewAdultPatient" method="post" action="patient.php">'
        .'<input type="hidden" name="id" value="'.$nPatient.'"/>'
        .'</form>'
        .'<script>'
        .'document.getElementById("formNewAdultPatient").submit();'
        .'</script>';
        exit();
    }
    else if (isset($_POST["submitNewAdult"]))
    {
        $message = "Champs manquants : ";
        if ($IPP=="") $message=$message."IPP,";
        if ($nom=="") $message=$message."Nom,";
        if ($prenom=="") $message=$message."Prenom,";
        if ($date_naissance=="") $message=$message."Date de naissance,";
        if ($hopital=="") $message=$message."Hôpital,";
        if ($civilite=="") $message=$message."Civilité,";
        $message = substr($message,0,-1);
        message($message,"red");
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

            .inputText, textarea {
                font-family: 'Raleway', sans-serif;
                font-weight:200;
                transition: background-color 0.5s ease;
                background-color:rgba(255,255,255,0);
                color:white;
                border-style:solid;
                border-color:white;
                border-radius:25px;
                padding:10px;
            }

            textarea {
                padding-left:20px;
            }

            .inputText {
                width:30%;
                text-align:center;
            }

            .inputText:focus, textarea:focus {
                outline:none;
                background-color:rgba(255,255,255,0.2);
            }

            .inputSelect3x3, .inputSelect1x2, .inputSelect1x3, .inputSelect2x3, .inputSelect2x2, .inputSelectHopital {
                transition: width 0.5s ease, height 0.5s ease;
                color:white;
                appearance: none;
                background-color:rgba(255,255,255,0);
                border: 1px solid white;
                border-radius:25px;
                padding:10px;
                width:200px;
                height:45px;
                margin:auto;
                cursor:pointer;
            }

            .selectOptions {
                visibility:hidden;
                filter:blur(10px);
            }

            .inputSelect3x3:hover {
                width:510px;
                height:162px;
            }

            .inputSelect1x2:hover {
                width:350px;
                height:70px;
            }

            .inputSelect1x3:hover {
                width:510px;
                height:70px;
            }

            .inputSelect2x3:hover {
                width:510px;
                height:115px;
            }

            .inputSelect2x2:hover {
                width:350px;
                height:115px;
            }

            .inputSelect3x3:hover .labelSelect, .inputSelect1x2:hover .labelSelect, .inputSelect1x3:hover .labelSelect, .inputSelect2x3:hover .labelSelect, .inputSelectHopital:hover .labelSelect, .inputSelect2x2:hover .labelSelect  {
                display:none;
            }

            .inputSelect3x3:hover .selectOptions, .inputSelect1x2:hover .selectOptions, .inputSelect1x3:hover .selectOptions, .inputSelect2x3:hover .selectOptions, .inputSelectHopital:hover .selectOptions, .inputSelect2x2:hover .selectOptions {
                transition: filter 0.5s ease;
                visibility:visible;
                filter:blur(0px);
            }

        </style>

        <script>
            function scrollButton(y) {
                $("html,body").animate({scrollTop:y}, 600, 'swing');
            }
        </script>

		<div class="centerDiv" style="top:100px;width:60%;">
            <h3 style="color:white;">Ajouter un <span style="color:#ff8c1a;">adulte</span></h3><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="document.location='new_patient.php'"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(700)"><h4><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;right:20px;">Commencer</h5></div>
            </div>
        </div>

        <form id="formAdulte" action="new_adult.php" method="post">

        <input type="hidden" name="submitNewAdult" value="0"/>

        <div class="centerDiv" style="top:800px;width:60%;">
            <h3 style="color:white;">IPP</h3>
            <input type="text" class="inputText" id="IPP" name="IPP" value="<?php echo $IPP; ?>" onkeyup="if(event.keyCode==13)scrollButton(1400);"/><br/><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(1400)"><h4>
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:1500px;width:60%;">
            <h3 style="color:white;">Nom</h3>
            <input type="text" class="inputText" id="nom" name="nom" value="<?php echo $nom; ?>" onkeyup="if(event.keyCode==13)scrollButton(2100);"/><br/><br/>
            <div class="twoButtonsDiv">
            <div style="float:left;" class="buttonClassic" onclick="scrollButton(700)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
            <div style="float:right;" class="buttonClassic" onclick="scrollButton(2100)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:2200px;width:60%;">
            <h3 style="color:white;">Prénom</h3>
            <input type="text" class="inputText" id="prenom" name="prenom" value="<?php echo $prenom; ?>" onkeyup="if(event.keyCode==13)scrollButton(2800);"/><br/><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(1400)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(2800)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:2900px;width:60%;">
            <h3 style="color:white;">Civilité</h3>
            <div style="display:inline-block;width:400px;">
                <div style="float:left;margin-right:84px;" class="buttonClassic" onclick="scrollButton(2100)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:left;text-align:center;margin:8px;"><input type="radio" id="civiliteM" name="civilite" value="M" style="float:right;" class="inputRadio" onclick="scrollButton(3500)" <?php if($civilite=="M") echo 'checked'; ?>/><label for="civiliteM"><h5 style="padding-top:5px;">M</h5></label></div>
                <div style="float:left;text-align:center;margin:8px;"><input type="radio" id="civiliteMme" name="civilite" value="Mme" style="float:right;" class="inputRadio" onclick="scrollButton(3500)" <?php if($civilite=="Mme") echo 'checked'; ?>/><label for="civiliteMme"><h5 style="padding-top:5px;">Mme</h5></label></div>
            </div>
        </div>

        <div class="centerDiv" style="top:3600px;width:60%;">
            <h3 style="color:white;">Date de naissance</h3>
            <input type="text" class="inputText" id="date_naissance" name="date_naissance" value="<?php echo $date_naissance; ?>" placeholder="JJ/MM/AAAA" onkeyup="if(event.keyCode==13)scrollButton(4200);"/><br/><br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(2800)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(4250)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <script>
            //Choix du type, cote
            function selectPatho(value) {
                var labelPatho = document.getElementById('labelPatho');
                var detailsPatho = document.getElementById('detailsPatho');
                switch (value) {
                    case "Non renseigne":
                        labelPatho.innerHTML='Non renseigné';
                        detailsPatho.innerHTML='';
                        break;
                    case "Sain":
                        labelPatho.innerHTML='Sain';
                        detailsPatho.innerHTML='';
                        break;
                    case "Autre":
                        labelPatho.innerHTML='Autre';
                        detailsPatho.innerHTML='';
                        break;
                    case "Paraplegie":
                        labelPatho.innerHTML='Paraplégie';
                        //Type
                        detailsPatho.innerHTML='<div class="inputSelect3x3" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">Non renseigné</h5>'
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" checked="checked"/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsTRAUMA" name="pathologieDetails" value="Traumatique" class="inputRadioRectangle"/><label for="pathoDetailsTRAUMA" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Traumatique\'"><h5>Traumatique</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsTUM" name="pathologieDetails" value="Tumorale" class="inputRadioRectangle"/><label for="pathoDetailsTUM" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Tumorale\'"><h5>Tumorale</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsAUT" name="pathologieDetails" value="Autre" class="inputRadioRectangle"/><label for="pathoDetailsAUT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Autre\'"><h5>Autre</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsCON" name="pathologieDetails" value="Congenitale" class="inputRadioRectangle"/><label for="pathoDetailsCON" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Congénitale\'"><h5>Congénitale</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsVAS" name="pathologieDetails" value="Vasculaire" class="inputRadioRectangle"/><label for="pathoDetailsVAC" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Vasculaire\'"><h5>Vasculaire</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsSEP" name="pathologieDetails" value="SEP" class="inputRadioRectangle"/><label for="pathoDetailsSEP" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'SEP\'"><h5>SEP</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsDI" name="pathologieDetails" value="Diplegie" class="inputRadioRectangle"/><label for="pathoDetailsDI" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Diplégie\'"><h5>Diplégie</h5></label></div>'
                            +'</div>'
                        +'</div>'
                        +'</div>';
                        break;
                    case "Ataxie":
                        labelPatho.innerHTML='Ataxie';
                        detailsPatho.innerHTML='<div class="inputSelect1x3" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">Bilatérale</h5>'
                        //Gauche, droite, bilatérale
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div><input type="radio" id="pathoATAG" name="pathologieCote" value="1" class="inputRadioRectangle"/><label for="pathoATAG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                            +'<div><input type="radio" id="pathoATABI" name="pathologieCote" value="3" class="inputRadioRectangle" checked="checked"/><label for="pathoATABI" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Bilatérale\'"><h5>Bilatérale</h5></label></div>'
                            +'<div><input type="radio" id="pathoATAD" name="pathologieCote" value="2" class="inputRadioRectangle"/><label for="pathoATAD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                        +'</div>'
                        +'</div><br/>';
                        detailsPatho.innerHTML+='<div class="inputSelect2x2" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">Non renseigné</h5>'
                        //Type
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" checked="checked"/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsMIX" name="pathologieDetails" value="Mixte" class="inputRadioRectangle"/><label for="pathoDetailsMIX" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Mixte\'"><h5>Mixte</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsSEN" name="pathologieDetails" value="Sensitive" class="inputRadioRectangle"/><label for="pathoDetailsSEN" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Sensitive\'"><h5>Sensitive</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsCER" name="pathologieDetails" value="Cerebelleuse" class="inputRadioRectangle"/><label for="pathoDetailsCER" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Cerebelleuse\'"><h5>Cerebelleuse</h5></label></div>'
                            +'</div>'
                        +'</div>'
                        +'</div>';
                        break;
                    case "Atteinte":
                        labelPatho.innerHTML='Atteinte';
                        detailsPatho.innerHTML='<div class="inputSelect1x3" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">Bilatérale</h5>'
                        //Gauche, droite, bilatérale
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div><input type="radio" id="pathoATTG" name="pathologieCote" value="1" class="inputRadioRectangle"/><label for="pathoATTG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                            +'<div><input type="radio" id="pathoATTBI" name="pathologieCote" value="3" class="inputRadioRectangle" checked="checked"/><label for="pathoATTBI" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Bilatérale\'"><h5>Bilatérale</h5></label></div>'
                            +'<div><input type="radio" id="pathoATTD" name="pathologieCote" value="2" class="inputRadioRectangle"/><label for="pathoATTD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                        +'</div>'
                        +'</div><br/>';
                        detailsPatho.innerHTML+='<div class="inputSelect1x3" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">Non renseigné</h5>'
                        //Type
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" checked="checked"/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsACQ" name="pathologieDetails" value="Acquise" class="inputRadioRectangle"/><label for="pathoDetailsACQ" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Acquise\'"><h5>Acquise</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsCON" name="pathologieDetails" value="Congenitale" class="inputRadioRectangle"/><label for="pathoDetailsCON" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Congénitale\'"><h5>Congénitale</h5></label></div>'
                        +'</div>'
                        +'</div>';
                        break;
                    case "Hemiplegie":
                        labelPatho.innerHTML='Hémiplégie';
                        //Droite ou gauche
                        detailsPatho.innerHTML='<div class="inputSelect1x2" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">Gauche</h5>'
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoHemiG" name="pathologieCote" value="1" class="inputRadioRectangle" checked="checked"/><label for="pathoHemiG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoHemiD" name="pathologieCote" value="2" class="inputRadioRectangle"/><label for="pathoHemiD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                            +'</div>'
                        +'</div>'
                        +'</div><br/>';
                        //Type
                        detailsPatho.innerHTML+='<div class="inputSelect3x3" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">Non renseigné</h5>'
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsISC" name="pathologieDetails" value="Ischemique" class="inputRadioRectangle"/><label for="pathoDetailsISC" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Ischémique\'"><h5>Ischémique</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsIMC" name="pathologieDetails" value="IMC" class="inputRadioRectangle"/><label for="pathoDetailsIMC" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'IMC\'"><h5>IMC</h5></label></div>'
                                 +'<div><input type="radio" id="pathoDetailsVAS" name="pathologieDetails" value="Vasculaire" class="inputRadioRectangle"/><label for="pathoDetailsVAS" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Vasculaire\'"><h5>Vasculaire</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsTRAUMA" name="pathologieDetails" value="Traumatique" class="inputRadioRectangle"/><label for="pathoDetailsTRAUMA" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Traumatique\'"><h5>Traumatique</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsCON" name="pathologieDetails" value="Congenitale" class="inputRadioRectangle"/><label for="pathoDetailsCON" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Congenitale\'"><h5>Congénitale</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsAUT" name="pathologieDetails" value="Autre" class="inputRadioRectangle"/><label for="pathoDetailsAUT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Autre\'"><h5>Autre</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsTUM" name="pathologieDetails" value="Tumorale" class="inputRadioRectangle"/><label for="pathoDetailsTUM" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Tumorale\'"><h5>Tumorale</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsSEP" name="pathologieDetails" value="SEP" class="inputRadioRectangle"/><label for="pathoDetailsSEP" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'SEP\'"><h5>SEP</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" checked="checked"/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                            +'</div>'
                        +'</div>'
                        +'</div>';
                        break;
                    case "Myogenes":
                        labelPatho.innerHTML='Myogènes';
                        detailsPatho.innerHTML='<div class="inputSelect2x3" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">Non renseigné</h5>'
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsDU" name="pathologieDetails" value="Duchenne" class="inputRadioRectangle"/><label for="pathoDetailsDU" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Duchenne\'"><h5>Duchenne</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsBE" name="pathologieDetails" value="Becker" class="inputRadioRectangle"/><label for="pathoDetailsBE" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Becker\'"><h5>Becker</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsST" name="pathologieDetails" value="Steinert" class="inputRadioRectangle"/><label for="pathoDetailsST" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Steinert\'"><h5>Steinert</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsAUT" name="pathologieDetails" value="Autre" class="inputRadioRectangle"/><label for="pathoDetailsAUT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Autre\'"><h5>Autre</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsCMT" name="pathologieDetails" value="Charcot Marie Tooth" class="inputRadioRectangle"/><label for="pathoDetailsCMT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Charcot Marie Tooth\'"><h5>C-M-T</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" checked="checked"/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                            +'</div>'
                        +'</div>'
                        +'</div>';
                        break;
                    case "Ortho":
                        labelPatho.innerHTML='Orthopédie';
                        detailsPatho.innerHTML='<div class="inputSelect1x3" style="overflow:hidden">'
                        +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">Bilatérale</h5>'
                        //Gauche, droite, bilatérale
                        +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div><input type="radio" id="pathoOrthoG" name="pathologieCote" value="1" class="inputRadioRectangle"/><label for="pathoOrthoG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                            +'<div><input type="radio" id="pathoOrthoBI" name="pathologieCote" value="3" class="inputRadioRectangle" checked="checked"/><label for="pathoOrthoBI" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Bilatérale\'"><h5>Bilatérale</h5></label></div>'
                            +'<div><input type="radio" id="pathoOrthoD" name="pathologieCote" value="2" class="inputRadioRectangle"/><label for="pathoOrthoD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                        +'</div>'
                        +'</div>';
                        break;
                }
            }
        </script>

        <div class="centerDiv" style="top:4300px;width:60%;">
            <h3 style="color:white;">Pathologie</h3>
            <div class="inputSelect3x3" style="overflow:hidden;">
                <h5 class="labelSelect" id="labelPatho" style="margin:3px;">Non renseigné</h5>
                <div class="selectOptions" style="display:flex;justify-content:center;">
                    <div>
                        <div><input type="radio" id="pathoNR" name="pathologie" value="Non renseigne" class="inputRadioRectangle" checked="checked"/><label for="pathoNR" onclick="selectPatho('Non renseigne')" <?php if($pathologie=="Non renseigne") echo 'checked'; ?>><h5>Non renseigné</h5></label></div>
                        <div><input type="radio" id="pathoHEMI" name="pathologie" value="Hemiplegie" class="inputRadioRectangle" <?php if($pathologie=="Hemiplegie") echo 'checked'; ?>/><label for="pathoHEMI" onclick="selectPatho('Hemiplegie')"><h5>Hémiplégie</h5></label></div>
                        <div><input type="radio" id="pathoATT" name="pathologie" value="Atteinte" class="inputRadioRectangle" <?php if($pathologie=="Atteinte") echo 'checked'; ?>/><label for="pathoATT" onclick="selectPatho('Atteinte')"><h5>Atteinte</h5></label></div>
                    </div>
                    <div>
                        <div><input type="radio" id="pathoSAIN" name="pathologie" value="Sain" class="inputRadioRectangle" <?php if($pathologie=="Sain") echo 'checked'; ?>/><label for="pathoSAIN" onclick="selectPatho('Sain')"><h5>Sain</h5></label></div>
                        <div><input type="radio" id="pathoPARA" name="pathologie" value="Paraplegie" class="inputRadioRectangle" <?php if($pathologie=="Paraplegie") echo 'checked'; ?>/><label for="pathoPARA" onclick="selectPatho('Paraplegie')"><h5>Paraplégie</h5></label></div>
                        <div><input type="radio" id="pathoMYO" name="pathologie" value="Myogenes" class="inputRadioRectangle" <?php if($pathologie=="Myogenes") echo 'checked'; ?>/><label for="pathoMYO" onclick="selectPatho('Myogenes')"><h5>Myogènes</h5></label></div>
                    </div>
                    <div>
                        <div><input type="radio" id="pathoAUT" name="pathologie" value="Autre" class="inputRadioRectangle" <?php if($pathologie=="Autre") echo 'checked'; ?>/><label for="pathoAUT" onclick="selectPatho('Autre')"><h5>Autre</h5></label></div>
                        <div><input type="radio" id="pathoATA" name="pathologie" value="Ataxie" class="inputRadioRectangle" <?php if($pathologie=="Ataxie") echo 'checked'; ?>/><label for="pathoATA" onclick="selectPatho('Ataxie')"><h5>Ataxie</h5></label></div>
                        <div><input type="radio" id="pathoORTHO" name="pathologie" value="Ortho" class="inputRadioRectangle" <?php if($pathologie=="Ortho") echo 'checked'; ?>/><label for="pathoORTHO" onclick="selectPatho('Ortho')"><h5>Orthopédie</h5></label></div>
                    </div>
                </div>
            </div>
            <br/>
            <span id="detailsPatho"></span>
            <br/>
            <textarea name="pathologieCommentaire" style="width:300px;height:100px;border-radius:5px;padding:10px;" placeholder="Commentaire" onkeyup=""><?php if($pathologieCommentaire!="") echo $pathologieCommentaire; ?></textarea>
            <br/>
            <br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(3500)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(5200)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:5300px;width:60%;">
            <h3 style="color:white;">Hôpital</h3>
            <div class="inputSelectHopital" style="overflow:hidden;width:300px;">
                    <?php
                        if ($_SESSION['type']=="Manager") {
                            $SQL = "SELECT Nom FROM hopital WHERE ID='".$_SESSION["id_hopital"]."';";
                            $req = $db->query($SQL);
                            $row = $req->fetch();
                            echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">'.$row['Nom'].'</h5>'
                            .'<div class="selectOptions">'
                            .'<div><input type="radio" id="hopitalManager" name="hopital" value="0" class="inputRadioRectangle" checked/><label style="width:250px" for="hopitalManager" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$row['Nom'].'\'"><h5>'.$row['Nom'].'</h5></label></div>';
                            echo '<style>'
                            .'.inputSelectHopital:hover {'
                            .'height: 68px;'
                            .'}'
                            .'</style>';
                        }
                        else {
                            echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">Non renseigné</h5>';
                            echo '<div class="selectOptions">';
                            $req = $db->query("SELECT ID,Nom FROM hopital;");
                            echo '<div><input type="radio" id="hopitalNR" name="hopital" value="Non renseigne" class="inputRadioRectangle" checked/><label style="width:250px" for="hopitalNR" onclick="document.getElementById(\'labelHopital\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>';
                            while ($row = $req->fetch()) {
                                $id = $row['ID'];
                                $nom = $row['Nom'];
                                if ($hopital==$id)
                                    echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle" checked/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div><script>document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\'</script>';
                                else
                                    echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
                            }
                            
                            //Taille automatique qui dépend du nombre d'hôpitaux
                            $req = $db->prepare("SELECT count(ID) as count FROM hopital;");
                            $req->execute();
                            $row = $req->fetch();
                            //h = selectPadding + nb*(optionMargin+optionHeight)
                            $h = 22+($row['count']+1)*(6+40);
                            echo '<style>'
                            .'.inputSelectHopital:hover {'
                            .'height:'.$h.'px;'
                            .'}'
                            .'</style>';
                        }
                    ?>
                </div>
            </div>
            <br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(4250)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(5950)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:6000px;width:60%;">
            <h3 style="color:white;">Historique</h3>
            <br/>
            <textarea name="historique" style="width:500px;height:200px;border-radius:5px;padding:10px;"><?php if ($historique!="") echo $historique;?></textarea>
            <br/>
            <br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(5200)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="scrollButton(6800)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
            </div>
        </div>

        <div class="centerDiv" style="top:6900px;width:60%;">
            <h3 style="color:white;">Confirmation</h3>
            <br/>
            <div class="twoButtonsDiv">
                <div style="float:left;" class="buttonClassic" onclick="scrollButton(5950)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                <div style="float:right;" class="buttonClassic" onclick="document.getElementById('formAdulte').submit();"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Ajouter</h5></div>
            </div>
        </div>

        </form>


        <div class="centerDiv" style="top:7300px;visibility:hidden;width:60%;"></div>

        <div class="goTopButton" onclick="scrollButton(0)"><h4 style="padding-right:2px;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></h4></div>

        <?php
            nav("Patients");
        ?>
    </div>
  </body>
</html>
