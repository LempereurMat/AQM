<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
    header('location: login.php');
    exit();
}

if(isset($_POST["recherche"]) && $_POST["recherche"]!="") {
    $_SESSION['recherche'] = $_POST["recherche"];
	//$SQL = "SELECT * FROM patients JOIN hopital ON patients.hopital_ID = hopital.ID LEFT JOIN pathologies ON patients.ID_patient = pathologies.patients_ID_patient WHERE ( patients.prenom LIKE '%".$_POST["recherche"]."%' OR patients.nom LIKE '%".$_POST["recherche"]."%' OR patients.IPP LIKE '%".$_POST["recherche"]."%'  OR patho LIKE '%".$_POST["recherche"]."%' ) ORDER BY patients.nom ASC";
    $SQL = "SELECT * FROM patients JOIN hopital ON patients.hopital_ID = hopital.ID LEFT JOIN pathologies ON patients.ID_patient = pathologies.patients_ID_patient LEFT JOIN cote ON cote.ID_cote=pathologies.cote LEFT JOIN etiologie ON etiologie.ID = pathologies.etiologie LEFT JOIN cause_etiologie ON cause_etiologie.ID = pathologies.cause_etiologie WHERE patients.nom LIKE '%".$_POST["recherche"]."%' OR patients.IPP LIKE '%".$_POST["recherche"]."%' OR patients.prenom LIKE '%".$_POST["recherche"]."%'  ORDER BY patients.nom ASC";
    $req = $db->query($SQL);
    $listePatients = array();
    while($row = $req->fetch())
        array_push($listePatients,$row);
}
else if (isset($_POST["rechercheLettre"])) {
    $_SESSION['recherche'] = $_POST["rechercheLettre"];
    $SQL = "SELECT * FROM patients JOIN hopital ON patients.hopital_ID = hopital.ID LEFT JOIN pathologies ON patients.ID_patient = pathologies.patients_ID_patient LEFT JOIN cote ON cote.ID_cote=pathologies.cote LEFT JOIN etiologie ON etiologie.ID = pathologies.etiologie LEFT JOIN cause_etiologie ON cause_etiologie.ID = pathologies.cause_etiologie WHERE ( patients.nom LIKE '".$_POST["rechercheLettre"]."%' ) ORDER BY patients.nom ASC";
    $req = $db->query($SQL);
    $listePatients = array();
    while($row = $req->fetch())
        array_push($listePatients,$row);
}
else {
    $_SESSION['recherche'] = "";
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

        .inputRecherche {
            text-align:center;
            transition: background-color 0.5s ease;
            background-color:rgba(255,255,255,0);
            color:white;
            border-style:solid;
            border-color:white;
            border-radius:25px;
            padding:10px;
            width:30%;
        }

        .inputRecherche:focus {
            outline:none;
            background-color:rgba(0,0,0,0.5);
        }

        .letterUp {
            position:relative;
            transition:bottom 0.5s ease;
            bottom:0px;
        }

        .letterUp:hover {
            bottom:10px;
        }

        .letterDown {
            position:relative;
            transition:top 0.5s ease;
            top:0px;
        }

        .letterDown:hover {
            top:10px;
        }

        .patientDiv {
            color:white;
            background-color:rgba(0,0,0,0.4);
            border:1px solid white;
            border-radius:10px;
            padding:3px;
            margin-bottom:15px;
            display:flex;
            justify-content:center;
            flex-flow: row wrap;
            padding-bottom:20px;
            overflow:hidden;
        }

        .viewEditSuppButtons {
            position:relative;
            bottom:100px;
            transition:bottom 0.5s ease;
            display:flex;
            justify-content:center;
            padding-top:10px;
            width:170px;
        }

        .patientDiv:hover .viewEditSuppButtons {
            bottom:0px;
        }

    </style>

    <script>
    function scrollButton(y) {
        $("html,body").animate({scrollTop:y}, 600, 'swing');
    }
    </script>

    <div class="background">
        <img class="bgImg" src="img/index.png" alt=""/>

        <div class="centerDiv" style="top:80px;width:80%;">

            <?php
                if ($_SESSION['type']=="Administrator" || $_SESSION['type']=="Manager")
                    echo '<div class="buttonClassic" style="position:absolute;right:40px;top:35px;" onclick="document.location=\'new_patient.php\'"><h2 style="position:relative;margin:0px;bottom:3px;">+</h2><h5 style="position:relative;bottom:8px;right:8px;">Nouveau</h5></div>';
            ?>


            <?php
                //Affichage du résultat
                if((isset($_POST["recherche"]) && $_POST["recherche"] != "") || isset($_POST["rechercheLettre"]))
                {
                    echo '<div class="goTopButton" onclick="scrollButton(0)"><h4 style="padding-right:2px;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></h4></div>';
                    echo '<div class="buttonClassic" style="position:absolute;top:35px;left:40px;" onclick="document.location=\'find_patient.php\'"><h4><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:7px;left:3px;">Retour</h5></div>';
                    if (isset($_POST["recherche"]) && $_POST["recherche"] != "")
                        echo '<h2 style="color:white">Recherche : <span style="color:#ff8c1a">'.$_POST["recherche"].'</span></h2><br/>';
                    else if (isset($_POST["rechercheLettre"]))
                        echo '<h2 style="color:white">Recherche : <span style="color:#ff8c1a">'.$_POST["rechercheLettre"].'</span></h2><br/>';
                    //Liste des patients
                    if (count($listePatients)==0) echo '<h3 style="color:white">Aucun patient</h3>';
                    else
                    {
                        foreach ($listePatients as $patient)
                        {
                            //Ne pas confondre, "nom" -> patients , "Nom" -> hopital
                            echo '<div class="patientDiv">'
                            .'<div style="float:left;width:35%;">'
                            .'<h4 style="text-align:left;margin-top:20px;">'.$patient["titre"].'. '.$patient["nom"].' '.$patient["prenom"].'</h4>';
                            if (($patient["type_patho"] == "") || ($patient["type_patho"] == "Non Renseigne") || ($patient["type_patho"] == "Non renseigne"))
							{
                                echo '<h5 style="text-align:left;">'.$patient["patho"].' '.$patient["Cote"].'<br/>';
                            }
							else
                                echo '<h5 style="text-align:left;">'.$patient["patho"].' '.$patient["Cote"].' ('.$patient["type_patho"].')'.'<br/>';
							if ($patient["etiologie"] != "0")
							{
								echo $patient["origine"];
							}
							if ($patient["cause_etiologie"] != "0")
							{
								echo ' ('.$patient["cause"].')';
							}
                            echo '</h5></div>';
                            //Buttons
                            echo '<div class="viewEditSuppButtons">';
                            //Bouton patient
                            echo '<span style="float:left;margin:3px;"><form action="patient.php" method="post">'
                            .'<input type="hidden" name="id" value="'.$patient["ID_patient"].'"/>'
			    .'<input type="hidden" name="previousPage" value="find_patient.php"/>'
                            .'<button type="submit" class="buttonClassic"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></button><h5 style="margin:1px;">Voir</h5>'
                            .'</form></span>';
                            if ($_SESSION['type']=='Administrator' || ($_SESSION['type']=='Manager' && $_SESSION['id_hopital']==$patient['hopital_ID']))
                            {
                                //Bouton editer
                                echo '<span style="float:left;margin:3px;"><form action="find_patient_edit.php" method="post">'
                                .'<input type="hidden" name="id" value="'.$patient["ID_patient"].'"/>'
                                .'<button type="submit" class="buttonClassic"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><h5 style="margin:1px;">Edit</h5>'
                                .'</form></span>';
                                //Bouton supprimer
                                echo '<span style="float:left;margin:3px;"><form action="find_patient_remove.php" method="post">'
                                .'<input type="hidden" name="id" value="'.$patient["ID_patient"].'"/>'
                                .'<button type="submit" class="buttonClassic"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button><h5 style="margin:1px;">Supp</h5>'.
                                '</form></span>';
                            }
                            
                            echo '</div>'
                            .'<div style="float:right;margin-left:12%;">'
                            .'<h5 style="text-align:right;margin-top:20px;">'.$patient["Nom"].'<br/>'
                            .'IPP : '.$patient["IPP"].'<br/>'
                            .'Naissance : '.(new DateTime($patient['date_naissance']))->format("d/m/Y").'</h5>'
                            .'</div>'
                            .'<div style="width:100%">';
                            if ($patient["Historique_Patient"] != "")
                                echo '<h5 style="text-align:justify;width:75%;margin:auto;left:0px;right:0px;padding:20px;border:1px solid rgba(255,255,255,0.2);border-radius:10px;background-color:rgba(0,0,0,0.2);margin-top:20px;">'.nl2br($patient["Historique_Patient"]).'</h5>';
							if ($patient["commentaire"] != "")
                                echo '<h5 style="text-align:justify;width:75%;margin:auto;left:0px;right:0px;padding:20px;border:1px solid rgba(255,255,255,0.2);border-radius:10px;background-color:rgba(0,0,0,0.2);margin-top:20px;">'.nl2br($patient["commentaire"]).'</h5>';
                            echo '</div>';
							
                            
                            echo '</div>';
                        }
                    }
                        
                }
                //Interface recherche
                else
                {
                    echo '<h2 style="color:#ff8c1a">Patients</h2><br/>'
                    .'<form action="find_patient.php" method="post">'
                    .'<input class="inputRecherche" type="text" name="recherche" placeholder="Recherche"/><br/><br/><br/>'
                    .'<div>';
                    $i = 0;
                    foreach (array("A","B","C","D","E","F","G","H","I","J","K","L","M") as $letter) {
                        echo '<span class="letterUp"><button class="buttonClassic" name="rechercheLettre" value="'.$letter.'"><h4 style="position:relative;bottom:1px;">'.$letter.'</h4></button></span>';
                        $i+=0.05;
                    }
                    echo '</div><div>';
                    $i = 0;
                    foreach (array("N","O","P","Q","R","S","T","U","V","W","X","Y","Z") as $letter) {
                        echo '<span class="letterDown"><button class="buttonClassic" name="rechercheLettre" value="'.$letter.'"><h4 style="position:relative;bottom:1px;">'.$letter.'</h4></button></span>';
                        $i+=0.05;
                    }
                    echo '</div>';
                    echo '</form>';
                    
                }
                ?>

        </div>

        <?php
            nav("Patients");
        ?>

    </div>
  </body>
</html>
