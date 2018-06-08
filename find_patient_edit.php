<?php
include "config.php";
include "function.php";

    if (!isset($_SESSION['username'])){
        header('location: login.php');
        exit();
    }

    if ($_SESSION['type']!="Administrator" && $_SESSION['type']!="Manager") {
        header('location: index.php');
        exit();
    }
    
if (isset($_POST["idForm"]))
{
    $sID = removeSpecialChars($_POST["idForm"]);
    $nom = removeSpecialChars($_POST["nom"]);
    $prenom = removeSpecialChars($_POST["prenom"]);
    $IPP = removeSpecialChars($_POST["IPP"]);
    $date_naissance = removeSpecialChars($_POST["date_naissance"]);
    $titre = removeSpecialChars($_POST["civilite"]);
    $sexe = sexe_determination($titre);
    $age = removeSpecialChars($_POST["age"]);
    if ($_SESSION['type']=="Manager") $hopital = $_SESSION['id_hopital'];
    else if ($_SESSION['type']=="Administrator") $hopital = removeSpecialChars($_POST["hopital"]);
    $historique = removeSpecialChars($_POST["historique"]);
    
    $pathologie = removeSpecialChars($_POST["pathologie"]);
    $pathologieCote = removeSpecialChars($_POST["pathologieCote"]);
    $pathologieDetails = removeSpecialChars($_POST["pathologieDetails"]);
    $pathologieCommentaire = removeSpecialChars($_POST["pathologieCommentaire"]);
	$etiologieDetails = removeSpecialChars($_POST["etiologieDetails"]);
    $causeetiologieDetails = removeSpecialChars($_POST["causeetiologieDetails"]);
	
    $date = new DateTime($date_naissance);
    $new_date = $date->format('Y-m-d');
        
    $SQL = "UPDATE patients SET "
    ."nom='".$nom."', "
    ."prenom='".$prenom."', "
    ."IPP='".$IPP."', "
    ."date_naissance='".$new_date."', "
    ."Sexe='".$sexe."', "
    ."titre='".$titre."', "
    ."age='".$age."', "
    ."Historique_Patient='".$historique."', "
    ."hopital_ID='".$hopital."' "
    ."WHERE ID_patient='".$sID."';";
    $req = $db->query($SQL);

	if ($etiologieDetails == "")  $etiologieDetails = 0;
	if ($causeetiologieDetails == "")  $causeetiologieDetails = 0;

    $SQL = "UPDATE pathologies SET "
    ."patho='".$pathologie."', "
    ."cote='".$pathologieCote."', "
    ."type_patho='".$pathologieDetails."', "
	."etiologie='".$etiologieDetails."', "
	."cause_etiologie='".$causeetiologieDetails."', "
    ."commentaire='".$pathologieCommentaire."' "
    ."WHERE patients_ID_patient='".$sID."';";
    $req = $db->query($SQL);
    
    message("Modifications apportées", "green");
}
else
    $sID = $_POST["id"];

$SQL = "SELECT * FROM patients JOIN hopital ON patients.hopital_ID=hopital.ID JOIN pathologies ON patients.ID_patient=pathologies.patients_ID_patient WHERE ID_patient=".$sID.";";
$req = $db->query($SQL);
$patient = $req->fetch();
if ($_SESSION['type']=="Manager" && $patient['hopital_ID']!=$_SESSION['id_hopital']) {
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
	<script src="https://use.fontawesome.com/def8867392.js"></script>
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
                padding-left:20px
            }

            .inputText:focus, textarea:focus {
                outline:none;
                background-color:rgba(0,0,0,0.2);
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

            .inputSelect:hover .labelSelect, .inputSelect3x3:hover .labelSelect, .inputSelect1x2:hover .labelSelect, .inputSelect1x3:hover .labelSelect, .inputSelect2x3:hover .labelSelect, .inputSelect2x2:hover .labelSelect {
                display:none;
            }

            .inputSelect:hover .selectOptions, .inputSelect3x3:hover .selectOptions, .inputSelect1x2:hover .selectOptions, .inputSelect1x3:hover .selectOptions, .inputSelect2x3:hover .selectOptions, .inputSelect2x2:hover .selectOptions {
                transition: filter 0.5s ease;
                visibility:visible;
                filter:blur(0px);
            }

            .selectOptions {
                visibility:hidden;
                filter:blur(10px);
            }

            .inputSelect, .inputSelect3x3, .inputSelect1x2, .inputSelect1x3, .inputSelect2x3, .inputSelect2x2 {
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

        </style>

        <script>
            function scrollButton(y) {
                $("html,body").animate({scrollTop:y}, 600, 'swing');
            }
        </script>

        <div class="background">

            <img class="bgImg" src="img/index.png" alt=""/>

            <div class="centerDiv" style="top:100px;width:75%;">
                <h3 style="color:white;">Modification : <span style="color:#ff8c1a;"><?php echo $patient["nom"].' '.$patient["prenom"]; ?></span></h3><br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="document.location='find_patient.php'"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(700)"><h4><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;right:20px;">Commencer</h5></div>
                </div>
            </div>

            <form id="formPatientEdit" action="find_patient_edit.php" method="POST">

            <input type="hidden" name="idForm" value="<?php echo $patient['ID_patient']; ?>"/>

            <div class="centerDiv" style="top:800px;width:60%;">
                <h3 style="color:white;">IPP</h3>
                <input type="text" class="inputText" id="IPP" name="IPP" value="<?php echo $patient['IPP']; ?>" onkeyup="if(event.keyCode==13)scrollButton(1400);"/><br/><br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(1400)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
                </div>
            </div>

            <div class="centerDiv" style="top:1500px;width:60%;">
                <h3 style="color:white;">Nom</h3>
                <input type="text" class="inputText" id="nom" name="nom" value="<?php echo $patient['nom']; ?>" onkeyup="if(event.keyCode==13)scrollButton(2100);"/><br/><br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(700)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(2100)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
                </div>
            </div>

            <div class="centerDiv" style="top:2200px;width:60%;">
                <h3 style="color:white;">Prénom</h3>
                <input type="text" class="inputText" id="prenom" name="prenom" value="<?php echo $patient['prenom']; ?>" onkeyup="if(event.keyCode==13) scrollButton(2800);"/><br/><br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(1400)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(2800)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
                </div>
            </div>

            <div class="centerDiv" style="top:2900px;width:60%;">
                <h3 style="color:white;">Civilité</h3><br/>
                <div style="display:inline-block;width:400px;">
                    <div style="float:left;margin-right:84px;" class="buttonClassic" onclick="scrollButton(2100)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:left;text-align:center;margin-right:15px;"><input type="radio" id="civiliteM" name="civilite" value="M" style="float:right;" class="inputRadio" onclick="scrollButton(3500)" <?php if ($patient['titre'] == 'M') echo 'checked';?>/><label for="civiliteM"><h5 style="padding-top:5px;">M</h5></label></div>
                    <div style="float:left;text-align:center;margin-left:15px;"><input type="radio" id="civiliteMme" name="civilite" value="Mme" style="float:right;" class="inputRadio" onclick="scrollButton(3500)" <?php if ($patient['titre'] == 'Mme' || $patient['titre'] == 'Mlle') echo 'checked';?>/><label for="civiliteMme"><h5 style="padding-top:5px;">Mme</h5></label></div>
                </div>
            </div>

            <div class="centerDiv" style="top:3600px;width:60%;">
                <h3 style="color:white;">Date de naissance</h3>
				
                <input type="date" class="inputText" id="date_naissance" name="date_naissance" value="<?php echo $patient['date_naissance']; ?>" placeholder="JJ/MM/AAAA" onkeyup="if(event.keyCode==13) scrollButton(4200);"/><br/><br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(2800)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(4200)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
                </div>
            </div>

            <script>
                function selectAge(age) {
                    var pathologie = document.getElementById('pathologieSelect');
                    var innerHTML = '<div class="inputSelect3x3" style="overflow:hidden;">'
                    +'<h5 class="labelSelect" id="labelPatho" style="margin:3px;">Non renseigné</h5>'
                    +'<div class="selectOptions" style="display:flex;justify-content:center;">';
                    if (age=="Adulte") {
                        innerHTML +=
                        '<div>'
                            +'<div><input type="radio" id="pathoNR" name="pathologie" value="Non renseigne" class="inputRadioRectangle" checked/><label for="pathoNR" onclick="selectPatho(\'Non renseigne\')"><h5>Non renseigné</h5></label></div>'
                            +'<div><input type="radio" id="pathoHEMI" name="pathologie" value="Hemiplegie" class="inputRadioRectangle"/><label for="pathoHEMI" onclick="selectPatho(\'Hemiplegie\')"><h5>Hémiplégie</h5></label></div>'
                            +'<div><input type="radio" id="pathoATT" name="pathologie" value="Atteinte" class="inputRadioRectangle"/><label for="pathoATT" onclick="selectPatho(\'Atteinte\')"><h5>Atteinte</h5></label></div>'
                        +'</div>'
                        +'<div>'
                            +'<div><input type="radio" id="pathoAUT" name="pathologie" value="Autre" class="inputRadioRectangle"/><label for="pathoAUT" onclick="selectPatho(\'Autre\')"><h5>Autre</h5></label></div>'
                            +'<div><input type="radio" id="pathoATA" name="pathologie" value="Ataxie" class="inputRadioRectangle"/><label for="pathoATA" onclick="selectPatho(\'Ataxie\')"><h5>Ataxie</h5></label></div>'
                            +'<div><input type="radio" id="pathoORTHO" name="pathologie" value="Ortho" class="inputRadioRectangle"/><label for="pathoORTHO" onclick="selectPatho(\'Ortho\')"><h5>Orthopédie</h5></label></div>'
                        +'</div>'
                        +'<div>'
                            +'<div><input type="radio" id="pathoPARA" name="pathologie" value="Paraplegie" class="inputRadioRectangle"/><label for="pathoPARA" onclick="selectPatho(\'Paraplegie\')"><h5>Paraplégie</h5></label></div>'
                            +'<div><input type="radio" id="pathoMYO" name="pathologie" value="Myogenes" class="inputRadioRectangle"/><label for="pathoMYO" onclick="selectPatho(\'Myogenes\')"><h5>Myogènes</h5></label></div>'
                        +'</div>';
                    }
                    else if (age=="Enfant"){
                        innerHTML +=
                        '<div>'
                            +'<div><input type="radio" id="pathoNR" name="pathologie" value="Non renseigne" class="inputRadioRectangle" checked/><label for="pathoNR" onclick="selectPatho(\'Non renseigne\')"><h5>Non renseigné</h5></label></div>'
                            +'<div><input type="radio" id="pathoDI" name="pathologie" value="Diplegie" class="inputRadioRectangle"/><label for="pathoDI" onclick="selectPatho(\'Diplegie\')"><h5>Diplégie</h5></label></div>'
                            +'<div><input type="radio" id="pathoHEMI" name="pathologie" value="Hemiplegie" class="inputRadioRectangle"/><label for="pathoHEMI" onclick="selectPatho(\'HemiplegieEnfant\')"><h5>Hémiplégie</h5></label></div>'
                        +'</div>'
                        +'<div>'
                            +'<div><input type="radio" id="pathoAUT" name="pathologie" value="Autre" class="inputRadioRectangle"/><label for="pathoAUT" onclick="selectPatho(\'Autre\')"><h5>Autre</h5></label></div>'
                            +'<div><input type="radio" id="pathoTETRA" name="pathologie" value="Tetraplegie" class="inputRadioRectangle"/><label for="pathoTETRA" onclick="selectPatho(\'Tetraplegie\')"><h5>Tétraplégie</h5></label></div>'
                            +'<div><input type="radio" id="pathoORTHO" name="pathologie" value="Ortho" class="inputRadioRectangle"/><label for="pathoORTHO" onclick="selectPatho(\'Ortho\')"><h5>Orthopédie</h5></label></div>'
                        +'</div>'
                        +'<div>'
                            +'<div><input type="radio" id="pathoTRI" name="pathologie" value="Triplegie" class="inputRadioRectangle"/><label for="pathoTRI" onclick="selectPatho(\'Triplegie\')"><h5>Triplégie</h5></label></div>'
                            +'<div><input type="radio" id="pathoMYO" name="pathologie" value="Myogenes" class="inputRadioRectangle"/><label for="pathoMYO" onclick="selectPatho(\'Myogenes\')"><h5>Myogènes</h5></label></div>'
                        +'</div>';
                    }
                    innerHTML += '</div>'
                    +'</div>'
                    +'<br/>'
                    +'<span id="detailsPatho"></span>';
                    pathologie.innerHTML = innerHTML;
                }

            </script>

            <div class="centerDiv" style="top:4300px;width:60%;">
                <h3 style="color:white;">Age</h3><br/>
                <div style="display:inline-block;width:400px;">
                    <div style="float:left;margin-right:84px;" class="buttonClassic" onclick="scrollButton(3500)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:left;text-align:center;margin-right:15px;"><input type="radio" id="ageEnfant" name="age" value="Enfant" style="float:right;" class="inputRadio" onchange="selectAge('Enfant')" onclick="scrollButton(4950)" <?php if ($patient['age'] == 'Enfant') echo 'checked';?>/><label for="ageEnfant"><h5 style="padding-top:5px;"><span class="glyphicon glyphicon-user"></span></h5><h5 style="padding-top:11px;">Enfant</h5></label></div>
                    <div style="float:left;text-align:center;margin-left:15px;"><input type="radio" id="ageAdulte" name="age" value="Adulte" style="float:right;" class="inputRadio" onchange="selectAge('Adulte')" onclick="scrollButton(4950)" <?php if ($patient['age'] == 'Adulte') echo 'checked';?>/><label for="ageAdulte"><h4><span class="glyphicon glyphicon-user"></span></h4><h5 style="padding-top:5px;">Adulte</h5></label></div>
                </div>
            </div>

            <script>
                function selectPatho(value) {
                    var labelPatho = document.getElementById('labelPatho');
                    var detailsPatho = document.getElementById('detailsPatho');
                    switch (value) {
                        case "Non renseigne":
                            labelPatho.innerHTML='Non renseigné';
                            detailsPatho.innerHTML='';
                            break;
                        case "Autre":
                            labelPatho.innerHTML='Autre';
                            detailsPatho.innerHTML='';
                            break;
                        case "Diplegie":
                            labelPatho.innerHTML='Diplégie';
                            <?php
                                if ($patient["etiologie"]=="1") $checked="Paralysie Cérébrale";
                                else if ($patient["etiologie"]=="2") $checked="Autres";
                                else $checked="Non renseigné";
                            ?>
							detailsPatho.innerHTML='<div class="inputSelect1x3" style="overflow:hidden">'
							+'<h5 class="labelSelect" id="labelEtiologiePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
							+'<div class="selectOptions" style="display:flex;justify-content:center;">'
								+'<div><input type="radio" id="pathoEtiologieNR" name="etiologieDetails" value="0" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoEtiologieNR" onclick="document.getElementById(\'labelEtiologiePatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoEtiologie1" name="etiologieDetails" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Paralysie Cérébrale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoEtiologie1" onclick="document.getElementById(\'labelEtiologiePatho\').innerHTML=\'Paralysie Cérébrale\'"><h5>Paralysie Cérébrale</h5></label></div>'
								+'<div><input type="radio" id="pathoEtiologie2" name="etiologieDetails" value="2" class="inputRadioRectangle" '+<?php if ($checked=="Autres") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoEtiologie2" onclick="document.getElementById(\'labelEtiologiePatho\').innerHTML=\'Autres\'"><h5>Autres</h5></label></div>'
							+'</div>'
							
							+'</div><br/>';
							<?php
                                if ($patient["cause_etiologie"]=="1") $checked="Prématurité";
								else if ($patient["cause_etiologie"]=="2") $checked="AVC";
								else if ($patient["cause_etiologie"]=="3") $checked="Tumeur";
								else if ($patient["cause_etiologie"]=="4") $checked="Traumatisme cranien";
                                else if ($patient["cause_etiologie"]=="5") $checked="Autres";
                                else $checked="Non renseigné";
                            ?>
							detailsPatho.innerHTML+='<div class="inputSelect2x3" style="overflow:hidden">'
							+'<h5 class="labelSelect" id="labelCauseEtiologiePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
							+'<div>'
							+'<div class="selectOptions" style="display:flex;justify-content:center;">'
								+'<div><input type="radio" id="pathoCauseEtiologieNR" name="causeetiologieDetails" value="0" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologieNR" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoCauseEtiologie1" name="causeetiologieDetails" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Prématurité") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie1" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Prématurité\'"><h5>Prématurité</h5></label></div>'
								+'<div><input type="radio" id="pathoCauseEtiologie2" name="causeetiologieDetails" value="2" class="inputRadioRectangle" '+<?php if ($checked=="AVC") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie2" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'AVC\'"><h5>AVC</h5></label></div>'
							+'</div>'
							+'</div>'
							+'<div>'
							+'<div class="selectOptions" style="display:flex;justify-content:center;">'
								+'<div><input type="radio" id="pathoCauseEtiologie3" name="causeetiologieDetails" value="3" class="inputRadioRectangle" '+<?php if ($checked=="Tumeur") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie3" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Tumeur\'"><h5>Tumeur</h5></label></div>'
                                +'<div><input type="radio" id="pathoCauseEtiologie4" name="causeetiologieDetails" value="4" class="inputRadioRectangle" '+<?php if ($checked=="Traumatisme cranien") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie4" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Traumatisme cranien\'"><h5>Traumatisme cranien</h5></label></div>'
								+'<div><input type="radio" id="pathoCauseEtiologie5" name="causeetiologieDetails" value="5" class="inputRadioRectangle" '+<?php if ($checked=="Autres") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie5" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Autres\'"><h5>Autres</h5></label></div>'
							+'</div>'
							+'</div>'
							+'</div>'
                            break;
                        case "Triplegie":
                            labelPatho.innerHTML='Triplégie';
                            detailsPatho.innerHTML='';
                            break;
                        case "Tetraplegie":
                            labelPatho.innerHTML='Tetraplégie';
                            detailsPatho.innerHTML='';
                            break;
                        case "Paraplegie":
                            labelPatho.innerHTML='Paraplégie';
                            //Type
                            <?php
                                if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="Traumatique") $checked="Traumatique";
                                else if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="Tumorale") $checked="Tumorale";
                                else if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="Autre") $checked="Autre";
                                else if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="Congenitale") $checked="Congenitale";
                                else if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="Vasculaire") $checked="Vasculaire";
                                else if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="SEP") $checked="SEP";
                                else if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="Diplegie") $checked="Diplegie";
                                else if ($patient["patho"]=="Paraplegie" && $patient["type_patho"]=="Traumatique") $checked="Traumatique";
                                else $checked="Non renseigné";
                            ?>
                            detailsPatho.innerHTML='<div class="inputSelect3x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                            +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsTRAUMA" name="pathologieDetails" value="Traumatique" class="inputRadioRectangle" '+<?php if ($checked=="Traumatique") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsTRAUMA" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Traumatique\'"><h5>Traumatique</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsTUM" name="pathologieDetails" value="Tumorale" class="inputRadioRectangle" '+<?php if ($checked=="Tumorale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsTUM" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Tumorale\'"><h5>Tumorale</h5></label></div>'
                            +'</div>'
                            +'<div>'
                            +'<div><input type="radio" id="pathoDetailsAUT" name="pathologieDetails" value="Autre" class="inputRadioRectangle" '+<?php if ($checked=="Autre") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsAUT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Autre\'"><h5>Autre</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsCON" name="pathologieDetails" value="Congenitale" class="inputRadioRectangle" '+<?php if ($checked=="Congenitale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsCON" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Congénitale\'"><h5>Congénitale</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsVAS" name="pathologieDetails" value="Vasculaire" class="inputRadioRectangle" '+<?php if ($checked=="Vasculaire") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsVAC" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Vasculaire\'"><h5>Vasculaire</h5></label></div>'
                            +'</div>'
                            +'<div>'
                            +'<div><input type="radio" id="pathoDetailsSEP" name="pathologieDetails" value="SEP" class="inputRadioRectangle" '+<?php if ($checked=="SEP") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsSEP" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'SEP\'"><h5>SEP</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsDI" name="pathologieDetails" value="Diplegie" class="inputRadioRectangle" '+<?php if ($checked=="Diplegie") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsDI" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Diplégie\'"><h5>Diplégie</h5></label></div>'
                            +'</div>'
                            +'</div>'
                            +'</div>';
                            break;
                        case "HemiplegieEnfant":
                            labelPatho.innerHTML='Hémiplégie';
                            //Droite ou gauche
                            <?php
                                if ($patient["patho"]=="Hemiplegie" && $patient["cote"]=="2") $checked="Droite";
                                else $checked="Gauche";
                            ?>
                            detailsPatho.innerHTML='<div class="inputSelect1x2" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                            +'<div><input type="radio" id="pathoHemiG" name="pathologieCote" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Gauche") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoHemiG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                            +'</div>'
                            +'<div>'
                            +'<div><input type="radio" id="pathoHemiD" name="pathologieCote" value="2" class="inputRadioRectangle" '+<?php if ($checked=="Droite") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoHemiD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                            +'</div>'
                            +'</div>'
                            +'</div><br/>';
                            //NR, 1, 2a, 2b, 3, 4
                            <?php
                                if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="1") $checked="1";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="2a") $checked="2a";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="2b") $checked="2b";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="3") $checked="3";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="4") $checked="4";
                                else $checked="Non renseigné";
                            ?>
                            detailsPatho.innerHTML+='<div class="inputSelect2x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetails2b" name="pathologieDetails" value="2b" class="inputRadioRectangle" '+<?php if ($checked=="2b") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetails2b" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'2b\'"><h5>2b</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetails1" name="pathologieDetails" value="1" class="inputRadioRectangle" '+<?php if ($checked=="1") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetails1" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'1\'"><h5>1</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetails3" name="pathologieDetails" value="3" class="inputRadioRectangle" '+<?php if ($checked=="3") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetails3" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'3\'"><h5>3</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetails2a" name="pathologieDetails" value="2a" class="inputRadioRectangle" '+<?php if ($checked=="2a") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetails2a" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'2a\'"><h5>2a</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetails4" name="pathologieDetails" value="4" class="inputRadioRectangle" '+<?php if ($checked=="4") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetails4" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'4\'"><h5>4</h5></label></div>'
                            +'</div>'
                            +'</div>'
                            +'</div><br/>';
							<?php
                                if ($patient["etiologie"]=="1") $checked="Paralysie Cérébrale";
                                else if ($patient["etiologie"]=="2") $checked="Autres";
                                else $checked="Non renseigné";
                            ?>
							detailsPatho.innerHTML+='<div class="inputSelect1x3" style="overflow:hidden">'
							+'<h5 class="labelSelect" id="labelEtiologiePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
							+'<div class="selectOptions" style="display:flex;justify-content:center;">'
								+'<div><input type="radio" id="pathoEtiologieNR" name="etiologieDetails" value="0" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoEtiologieNR" onclick="document.getElementById(\'labelEtiologiePatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoEtiologie1" name="etiologieDetails" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Paralysie Cérébrale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoEtiologie1" onclick="document.getElementById(\'labelEtiologiePatho\').innerHTML=\'Paralysie Cérébrale\'"><h5>Paralysie Cérébrale</h5></label></div>'
								+'<div><input type="radio" id="pathoEtiologie2" name="etiologieDetails" value="2" class="inputRadioRectangle" '+<?php if ($checked=="Autres") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoEtiologie2" onclick="document.getElementById(\'labelEtiologiePatho\').innerHTML=\'Autres\'"><h5>Autres</h5></label></div>'
							+'</div>'
							
							+'</div><br/>';
							<?php
                                if ($patient["cause_etiologie"]=="1") $checked="Prématurité";
								else if ($patient["cause_etiologie"]=="2") $checked="AVC";
								else if ($patient["cause_etiologie"]=="3") $checked="Tumeur";
								else if ($patient["cause_etiologie"]=="4") $checked="Traumatisme cranien";
                                else if ($patient["cause_etiologie"]=="5") $checked="Autres";
                                else $checked="Non renseigné";
                            ?>
							detailsPatho.innerHTML+='<div class="inputSelect2x3" style="overflow:hidden">'
							+'<h5 class="labelSelect" id="labelCauseEtiologiePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
							+'<div>'
							+'<div class="selectOptions" style="display:flex;justify-content:center;">'
								+'<div><input type="radio" id="pathoCauseEtiologieNR" name="causeetiologieDetails" value="0" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologieNR" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoCauseEtiologie1" name="causeetiologieDetails" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Prématurité") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie1" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Prématurité\'"><h5>Prématurité</h5></label></div>'
								+'<div><input type="radio" id="pathoCauseEtiologie2" name="causeetiologieDetails" value="2" class="inputRadioRectangle" '+<?php if ($checked=="AVC") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie2" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'AVC\'"><h5>AVC</h5></label></div>'
							+'</div>'
							+'</div>'
							+'<div>'
							+'<div class="selectOptions" style="display:flex;justify-content:center;">'
								+'<div><input type="radio" id="pathoCauseEtiologie3" name="causeetiologieDetails" value="3" class="inputRadioRectangle" '+<?php if ($checked=="Tumeur") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie3" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Tumeur\'"><h5>Tumeur</h5></label></div>'
                                +'<div><input type="radio" id="pathoCauseEtiologie4" name="causeetiologieDetails" value="4" class="inputRadioRectangle" '+<?php if ($checked=="Traumatisme cranien") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie4" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Traumatisme cranien\'"><h5>Traumatisme cranien</h5></label></div>'
								+'<div><input type="radio" id="pathoCauseEtiologie5" name="causeetiologieDetails" value="5" class="inputRadioRectangle" '+<?php if ($checked=="Autres") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoCauseEtiologie5" onclick="document.getElementById(\'labelCauseEtiologiePatho\').innerHTML=\'Autres\'"><h5>Autres</h5></label></div>'
							+'</div>'
							+'</div>'
							+'</div>'
                            break;
                        case "Hemiplegie":
                            labelPatho.innerHTML='Hémiplégie';
                            //Droite ou gauche
                            <?php
                                if ($patient["patho"]=="Hemiplegie" && $patient["cote"]=="2") $checked="Droite";
                                else $checked="Gauche";
                            ?>
                            detailsPatho.innerHTML='<div class="inputSelect1x2" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoHemiG" name="pathologieCote" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Gauche") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoHemiG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoHemiD" name="pathologieCote" value="2" class="inputRadioRectangle" '+<?php if ($checked=="Droite") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoHemiD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                            +'</div>'
                            +'</div>'
                            +'</div><br/>';
                            //Type
                            <?php
                                if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="IMC") $checked="IMC";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="Vasculaire") $checked="Vasculaire";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="Traumatique") $checked="Vasculaire";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="Congenitale") $checked="Congenitale";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="Autre") $checked="Autre";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="Tumorale") $checked="Tumorale";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="SEP") $checked="SEP";
                                else if ($patient["patho"]=="Hemiplegie" && $patient["type_patho"]=="Ischemique") $checked="Ischemique";
                                else $checked="Non renseigné";
                            ?>
                            detailsPatho.innerHTML+='<div class="inputSelect3x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsIMC" name="pathologieDetails" value="IMC" class="inputRadioRectangle" '+<?php if ($checked=="IMC") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsIMC" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'IMC\'"><h5>IMC</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsVAS" name="pathologieDetails" value="Vasculaire" class="inputRadioRectangle" '+<?php if ($checked=="Vasculaire") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsVAS" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Vasculaire\'"><h5>Vasculaire</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsTRAUMA" name="pathologieDetails" value="Traumatique" class="inputRadioRectangle" '+<?php if ($checked=="Traumatique") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsTRAUMA" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Traumatique\'"><h5>Traumatique</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsCON" name="pathologieDetails" value="Congenitale" class="inputRadioRectangle" '+<?php if ($checked=="Congenitale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsCON" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Congenitale\'"><h5>Congénitale</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsAUT" name="pathologieDetails" value="Autre" class="inputRadioRectangle" '+<?php if ($checked=="Autre") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsAUT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Autre\'"><h5>Autre</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsTUM" name="pathologieDetails" value="Tumorale" class="inputRadioRectangle" '+<?php if ($checked=="Tumorale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsTUM" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Tumorale\'"><h5>Tumorale</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsSEP" name="pathologieDetails" value="SEP" class="inputRadioRectangle" '+<?php if ($checked=="SEP") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsSEP" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'SEP\'"><h5>SEP</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsISC" name="pathologieDetails" value="Ischemique" class="inputRadioRectangle" '+<?php if ($checked=="Ischemique") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsISC" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Ischémique\'"><h5>Ischémique</h5></label></div>'
                            +'</div>'
                            +'</div>'
                            +'</div>';
                            break;
                        case "Myogenes":
                            <?php
                                if ($patient["patho"]=="Myogenes" && $patient["type_patho"]=="Becker") $checked="Becker";
                                else if ($patient["patho"]=="Myogenes" && $patient["type_patho"]=="Steinert") $checked="Steinert";
                                else if ($patient["patho"]=="Myogenes" && $patient["type_patho"]=="Autre") $checked="Autre";
                                else if ($patient["patho"]=="Myogenes" && $patient["type_patho"]=="Charcot Marie Tooth") $checked="Charcot Marie Tooth";
                                else if ($patient["patho"]=="Myogenes" && $patient["type_patho"]=="Duchenne") $checked="Duchenne";
                                else $checked="Non renseigné";
                            ?>
                            labelPatho.innerHTML='Myogènes';
                            detailsPatho.innerHTML='<div class="inputSelect2x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsBE" name="pathologieDetails" value="Becker" class="inputRadioRectangle" '+<?php if ($checked=="Becker") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsBE" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Becker\'"><h5>Becker</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsST" name="pathologieDetails" value="Steinert" class="inputRadioRectangle" '+<?php if ($checked=="Steinert") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsST" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Steinert\'"><h5>Steinert</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsAUT" name="pathologieDetails" value="Autre" class="inputRadioRectangle" '+<?php if ($checked=="Autre") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsAUT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Autre\'"><h5>Autre</h5></label></div>'
                            +'</div>'
                            +'<div>'
                                +'<div><input type="radio" id="pathoDetailsCMT" name="pathologieDetails" value="Charcot Marie Tooth" class="inputRadioRectangle" '+<?php if ($checked=="Charcot Marie Tooth") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsCMT" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Charcot Marie Tooth\'"><h5>C-M-T</h5></label></div>'
                                +'<div><input type="radio" id="pathoDetailsDU" name="pathologieDetails" value="Duchenne" class="inputRadioRectangle" '+<?php if ($checked=="Duchenne") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsDU" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Duchenne\'"><h5>Duchenne</h5></label></div>'
                            +'</div>'
                            +'</div>'
                            +'</div>';
                            break;
                        case "Ortho":
                            <?php
                                if ($patient["patho"]=="Ortho" && $patient["cote"]=="1") $checked="Gauche";
                                else if ($patient["patho"]=="Ortho" && $patient["cote"]=="2") $checked="Droite";
                                else $checked="Bilatérale";
                            ?>
                            labelPatho.innerHTML='Orthopédie';
                            detailsPatho.innerHTML='<div class="inputSelect1x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            //Gauche, droite, bilatérale
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                                +'<div><input type="radio" id="pathoOrthoBI" name="pathologieCote" value="3" class="inputRadioRectangle" '+<?php if ($checked=="Bilatérale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoOrthoBI" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Bilatérale\'"><h5>Bilatérale</h5></label></div>'
                                +'<div><input type="radio" id="pathoOrthoG" name="pathologieCote" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Gauche") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoOrthoG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                                +'<div><input type="radio" id="pathoOrthoD" name="pathologieCote" value="2" class="inputRadioRectangle" '+<?php if ($checked=="Droite") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoOrthoD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                            +'</div>'
                            +'</div>';
                            break;
                        case "Atteinte":
                            <?php
                                if ($patient["patho"]=="Atteinte" && $patient["cote"]=="1") $checked="Gauche";
                                else if ($patient["patho"]=="Atteinte" && $patient["cote"]=="2") $checked="Droite";
                                else $checked="Bilatérale";
                            ?>
                            labelPatho.innerHTML='Atteinte';
                            detailsPatho.innerHTML='<div class="inputSelect1x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            //Gauche, droite, bilatérale
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                                +'<div><input type="radio" id="pathoATTBI" name="pathologieCote" value="3" class="inputRadioRectangle" '+<?php if ($checked=="Bilatérale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoATTBI" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Bilatérale\'"><h5>Bilatérale</h5></label></div>'
                                +'<div><input type="radio" id="pathoATTG" name="pathologieCote" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Gauche") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoATTG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                                +'<div><input type="radio" id="pathoATTD" name="pathologieCote" value="2" class="inputRadioRectangle" '+<?php if ($checked=="Droite") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoATTD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                            +'</div>'
                            +'</div><br/>';
                            <?php
                                if ($patient["patho"]=="Atteinte" && $patient["type_patho"]=="Acquise") $checked="Acquise";
                                else if ($patient["patho"]=="Atteinte" && $patient["type_patho"]=="Congenitale") $checked="Congenitale";
                                else $checked="Non renseigné";
                            ?>
                            detailsPatho.innerHTML+='<div class="inputSelect1x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            //Type
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsACQ" name="pathologieDetails" value="Acquise" class="inputRadioRectangle" '+<?php if ($checked=="Acquise") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsACQ" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Acquise\'"><h5>Acquise</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsCON" name="pathologieDetails" value="Congenitale" class="inputRadioRectangle" '+<?php if ($checked=="Congenitale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsCON" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Congénitale\'"><h5>Congénitale</h5></label></div>'
                            +'</div>'
                            +'</div>';
                            break;
                        case "Ataxie":
                            <?php
                                if ($patient["patho"]=="Ataxie" && $patient["cote"]=="1") $checked="Gauche";
                                else if ($patient["patho"]=="Ataxie" && $patient["cote"]=="2") $checked="Droite";
                                else $checked="Bilatérale";
                            ?>
                            labelPatho.innerHTML='Ataxie';
                            detailsPatho.innerHTML='<div class="inputSelect1x3" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelCotePatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            //Gauche, droite, bilatérale
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div><input type="radio" id="pathoATABI" name="pathologieCote" value="3" class="inputRadioRectangle" '+<?php if ($checked=="Bilatérale") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoATABI" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Bilatérale\'"><h5>Bilatérale</h5></label></div>'
                            +'<div><input type="radio" id="pathoATAG" name="pathologieCote" value="1" class="inputRadioRectangle" '+<?php if ($checked=="Gauche") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoATAG" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Gauche\'"><h5>Gauche</h5></label></div>'
                            +'<div><input type="radio" id="pathoATAD" name="pathologieCote" value="2" class="inputRadioRectangle" '+<?php if ($checked=="Droite") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoATAD" onclick="document.getElementById(\'labelCotePatho\').innerHTML=\'Droite\'"><h5>Droite</h5></label></div>'
                            +'</div>'
                            +'</div><br/>';
                            <?php
                                if ($patient["patho"]=="Ataxie" && $patient["type_patho"]=="Mixte") $checked="Mixte";
                                else if ($patient["patho"]=="Ataxie" && $patient["type_patho"]=="Sensitive") $checked="Sensitive";
                                else if ($patient["patho"]=="Ataxie" && $patient["type_patho"]=="Cerebelleuse") $checked="Cerebelleuse";
                                else $checked="Non renseigné";
                            ?>
                            detailsPatho.innerHTML+='<div class="inputSelect2x2" style="overflow:hidden">'
                            +'<h5 class="labelSelect" id="labelDetailsPatho" style="margin:3px;">'+<?php echo '"'.$checked.'"'; ?>+'</h5>'
                            //Type
                            +'<div class="selectOptions" style="display:flex;justify-content:center;">'
                            +'<div>'
                            +'<div><input type="radio" id="pathoDetailsNR" name="pathologieDetails" value="Non renseigne" class="inputRadioRectangle" '+<?php if ($checked=="Non renseigné") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsNR" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Non renseigné\'"><h5>Non renseigné</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsMIX" name="pathologieDetails" value="Mixte" class="inputRadioRectangle" '+<?php if ($checked=="Mixte") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsMIX" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Mixte\'"><h5>Mixte</h5></label></div>'
                            +'</div>'
                            +'<div>'
                            +'<div><input type="radio" id="pathoDetailsSEN" name="pathologieDetails" value="Sensitive" class="inputRadioRectangle" '+<?php if ($checked=="Sensitive") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsSEN" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Sensitive\'"><h5>Sensitive</h5></label></div>'
                            +'<div><input type="radio" id="pathoDetailsCER" name="pathologieDetails" value="Cerebelleuse" class="inputRadioRectangle" '+<?php if ($checked=="Cerebelleuse") echo '"checked"'; else echo '""'; ?>+'/><label for="pathoDetailsCER" onclick="document.getElementById(\'labelDetailsPatho\').innerHTML=\'Cerebelleuse\'"><h5>Cerebelleuse</h5></label></div>'
                            +'</div>'
                            +'</div>'
                            +'</div>';
                            break;
                    }
                }
            </script>
    

            <div class="centerDiv" style="top:5000px;width:60%;">
                <h3 style="color:white;">Pathologie</h3>
                <span id="pathologieSelect">
                <div class="inputSelect3x3" style="overflow:hidden;">
                    <h5 class="labelSelect" id="labelPatho" style="margin:3px;"><?php echo $patient["patho"]; ?></h5>
                    <div class="selectOptions" style="display:flex;justify-content:center;">
                        <?php if($patient['age']=="Adulte") { ?>
                        <div>
                            <div><input type="radio" id="pathoNR" name="pathologie" value="Non renseigne" class="inputRadioRectangle" checked/><label for="pathoNR" onclick="selectPatho('Non renseigne')" <?php if($patient["patho"]=="Non renseigne") echo 'checked'; ?>><h5>Non renseigné</h5></label></div>
                            <div><input type="radio" id="pathoHEMI" name="pathologie" value="Hemiplegie" class="inputRadioRectangle" <?php if ($patient["patho"]=="Hemiplegie") echo 'checked'; ?>/><label for="pathoHEMI" onclick="selectPatho('Hemiplegie')"><h5>Hémiplégie</h5></label></div>
                            <div><input type="radio" id="pathoATT" name="pathologie" value="Atteinte" class="inputRadioRectangle" <?php if($patient["patho"]=="Atteinte") echo 'checked'; ?>/><label for="pathoATT" onclick="selectPatho('Atteinte')"><h5>Atteinte</h5></label></div>
                        </div>
                        <div>
                            <div><input type="radio" id="pathoAUT" name="pathologie" value="Autre" class="inputRadioRectangle" <?php if($patient["patho"]=="Autre") echo 'checked'; ?>/><label for="pathoAUT" onclick="selectPatho('Autre')"><h5>Autre</h5></label></div>
                            <div><input type="radio" id="pathoATA" name="pathologie" value="Ataxie" class="inputRadioRectangle" <?php if($patient["patho"]=="Ataxie") echo 'checked'; ?>/><label for="pathoATA" onclick="selectPatho('Ataxie')"><h5>Ataxie</h5></label></div>
                            <div><input type="radio" id="pathoORTHO" name="pathologie" value="Ortho" class="inputRadioRectangle" <?php if($patient["patho"]=="Ortho") echo 'checked'; ?>/><label for="pathoORTHO" onclick="selectPatho('Ortho')"><h5>Orthopédie</h5></label></div>
                        </div>
                        <div>
                            <div><input type="radio" id="pathoPARA" name="pathologie" value="Paraplegie" class="inputRadioRectangle" <?php if($patient["patho"]=="Paraplegie") echo 'checked'; ?>/><label for="pathoPARA" onclick="selectPatho('Paraplegie')"><h5>Paraplégie</h5></label></div>
                            <div><input type="radio" id="pathoMYO" name="pathologie" value="Myogenes" class="inputRadioRectangle" <?php if($patient["patho"]=="Myogenes") echo 'checked'; ?>/><label for="pathoMYO" onclick="selectPatho('Myogenes')"><h5>Myogènes</h5></label></div>
                        </div>
                        <?php } else if ($patient['age']=="Enfant") { ?>
                        <div>
                            <div><input type="radio" id="pathoNR" name="pathologie" value="Non renseigne" class="inputRadioRectangle" checked/><label for="pathoNR" onclick="selectPatho('Non renseigne')"><h5>Non renseigné</h5></label></div>
                            <div><input type="radio" id="pathoDI" name="pathologie" value="Diplegie" class="inputRadioRectangle" <?php if ($patient["patho"]=="Diplegie") echo 'checked'; ?>/><label for="pathoDI" onclick="selectPatho('Diplegie')"><h5>Diplégie</h5></label></div>
                            <div><input type="radio" id="pathoHEMI" name="pathologie" value="Hemiplegie" class="inputRadioRectangle" <?php if ($patient["patho"]=="Hemiplegie") echo 'checked'; ?>/><label for="pathoHEMI" onclick="selectPatho('HemiplegieEnfant')"><h5>Hémiplégie</h5></label></div>
                        </div>
                        <div>
                            <div><input type="radio" id="pathoAUT" name="pathologie" value="Autre" class="inputRadioRectangle" <?php if ($patient["patho"]=="Autre") echo 'checked'; ?>/><label for="pathoAUT" onclick="selectPatho('Autre')"><h5>Autre</h5></label></div>
                            <div><input type="radio" id="pathoTETRA" name="pathologie" value="Tetraplegie" class="inputRadioRectangle" <?php if ($patient["patho"]=="Tetraplegie") echo 'checked'; ?>/><label for="pathoTETRA" onclick="selectPatho('Tetraplegie')"><h5>Tétraplégie</h5></label></div>
                            <div><input type="radio" id="pathoORTHO" name="pathologie" value="Ortho" class="inputRadioRectangle" <?php if ($patient["patho"]=="Ortho") echo 'checked'; ?>/><label for="pathoORTHO" onclick="selectPatho('Ortho')"><h5>Orthopédie</h5></label></div>
                        </div>
                        <div>
                            <div><input type="radio" id="pathoTRI" name="pathologie" value="Triplegie" class="inputRadioRectangle" <?php if ($patient["patho"]=="Triplegie") echo 'checked'; ?>/><label for="pathoTRI" onclick="selectPatho('Triplegie')"><h5>Triplégie</h5></label></div>
                            <div><input type="radio" id="pathoMYO" name="pathologie" value="Myogenes" class="inputRadioRectangle" <?php if ($patient["patho"]=="Myogenes") echo 'checked'; ?>/><label for="pathoMYO" onclick="selectPatho('Myogenes')"><h5>Myogènes</h5></label></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <br/>
                <span id="detailsPatho">
                <?php
                    if ($patient["patho"]=="Paraplegie") echo '<script>selectPatho("Paraplegie");</script>';
                    else if ($patient["patho"]=="Hemiplegie" && $patient["age"]=="Enfant") echo '<script>selectPatho("HemiplegieEnfant");</script>';
                    else if ($patient["patho"]=="Hemiplegie" && $patient["age"]=="Adulte") echo '<script>selectPatho("Hemiplegie");</script>';
                    else if ($patient["patho"]=="Myogenes") echo '<script>selectPatho("Myogenes");</script>';
                    else if ($patient["patho"]=="Ortho") echo '<script>selectPatho("Ortho");</script>';
                    else if ($patient["patho"]=="Atteinte") echo '<script>selectPatho("Atteinte");</script>';
                    else if ($patient["patho"]=="Ataxie") echo '<script>selectPatho("Ataxie");</script>';
                ?>
                </span>
                </span>
                <br/>
                <textarea name="pathologieCommentaire" style="width:300px;height:100px;border-radius:5px;padding:10px;" placeholder="Commentaire" onkeyup=""><?php echo $patient["commentaire"]; ?></textarea>
                <br/>
                <br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(4200)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(5700)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
                </div>
            </div>

            <div class="centerDiv" style="top:5800px;width:60%;">
                <h3 style="color:white;">Hôpital</h3>
                <div class="inputSelect" id="inputSelectHopital" style="overflow:hidden;width:300px;">
                <?php
                    if ($_SESSION['type']=="Manager") {
                        $SQL = "SELECT Nom FROM hopital WHERE ID='".$_SESSION["id_hopital"]."';";
                        $req = $db->query($SQL);
                        $row = $req->fetch();
                        echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">'.$row['Nom'].'</h5>'
                        .'<div class="selectOptions">'
                        .'<div><input type="radio" id="hopitalManager" name="hopital" value="0" class="inputRadioRectangle" checked/><label style="width:250px" for="hopitalManager" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$row['Nom'].'\'"><h5>'.$row['Nom'].'</h5></label></div>';
                        echo '<style>'
                        .'#inputSelectHopital:hover {'
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
                            if ($patient['hopital_ID']==$id)
                                echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle" checked/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div><script>document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\'</script>';
                            else
                                echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
                        }
        
                        //Taille automatique qui dépend du nombre d'hôpitaux
                        $req = $db->query("SELECT count(ID) as count FROM hopital;");
                        $row = $req->fetch();
                        //h = selectPadding + nb*(optionMargin+optionHeight)
                        $h = 22+($row['count']+1)*(6+40);
                        echo '<style>'
                        .'#inputSelectHopital:hover {'
                        .'height:'.$h.'px;'
                        .'}'
                        .'</style>';
                    }
                ?>
                    </div>
                </div>
                <br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(4950)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(6550)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
                </div>
            </div>

            <div class="centerDiv" style="top:6600px;width:60%;">
                <h3 style="color:white;">Historique</h3>
                <br/>
                <textarea name="historique" style="width:500px;height:200px;border-radius:5px;padding:10px;"><?php echo $patient['Historique_Patient']; ?></textarea>
                <br/>
                <br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(5640)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="scrollButton(7400)"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Valider</h5></div>
                </div>
            </div>

            <div class="centerDiv" style="top:7500px;width:60%;">
                <h3 style="color:white;">Confirmation</h3>
                <br/>
                <div class="twoButtonsDiv">
                    <div style="float:left;" class="buttonClassic" onclick="scrollButton(6550)"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Retour</h5></div>
                    <div style="float:right;" class="buttonClassic" onclick="document.getElementById('formPatientEdit').submit();"><h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4><h5 style="position:relative;top:3px;">Modifier</h5></div>
                </div>
            </div>

            </form>


            <div class="centerDiv" style="top:8000px;visibility:hidden;width:60%;"></div>

            <div class="goTopButton" onclick="scrollButton(0)"><h4 style="padding-right:2px;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></h4></div>

        </div>
    <?php
        nav("Patients");
    ?>
  </body>
</html>
