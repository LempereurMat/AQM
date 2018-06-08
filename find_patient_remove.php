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
    
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $SQL = "SELECT id FROM patients JOIN hopital ON hopital_ID=id WHERE ID_patient='".$id."';";
        $req = $db->query($SQL);
        $row = $req->fetch();
        if ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']!=$row["id"]) {
            header('location: find_patient.php');
            exit();
        }
    }
    else {
        header('location: find_patient.php');
        exit();
    }
    
    if (isset($_POST["supp"]))
    {
        $SQL = array("DELETE FROM patients WHERE ID_patient=".$id.";");
        if ($_POST["suppConsultation"]=="on")
            array_push($SQL,"DELETE FROM consultation WHERE patients_ID_patient=".$id.";");
        if ($_POST["suppEOS"]=="on")
            array_push($SQL, "DELETE FROM eos WHERE Patient_ID=".$id.";");
        if ($_POST["suppPathologies"]=="on")
            array_push($SQL, "DELETE FROM pathologies WHERE patients_ID_patient=".$id.";");
        if ($_POST["suppTraitement"]=="on")
            array_push($SQL, "DELETE FROM traitement WHERE Patients_ID=".$id.";");
        foreach ($SQL as $deleteSQL) {
            $db->query($deleteSQL);
        }
        
        header('Location: find_patient.php');
        message("Patient supprimé", "green");
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

    <div class="background">
        <img class="bgImg" src="img/index.png" alt=""/>

        <div class="centerDiv" style="top:70px;width:60%;">
            <h3 style="color:#ff8c1a">Supprimer un patient</h3><br/>

            <?php
                $SQL = "SELECT nom,prenom FROM patients WHERE ID_patient='".$id."';";
                $req = $db->query($SQL);
                $row = $req->fetch();
                echo '<h4>Voulez vous supprimer le patient <span style="color:#ff8c1a">'.$row["nom"].' '.$row["prenom"].'</span>?</h4><br/>';
                echo '<form id="formRemovePatient" method="POST" action="find_patient_remove.php">'
                .'<input type="hidden" name="supp" value="0"/>'
                .'<input type="hidden" name="id" value="'.$id.'"/>'
                .'<div style="display:flex;justify-content:center;">'
                .'<div><input type="checkbox" class="inputRadio" name="suppConsultation" id="suppConsultation" checked="checked"/><label for="suppConsultation" style="width:30px;height:30px;margin-right:40px;margin-left:40px;"></label><h5 style="position:relative;bottom:10px;">Consultations</h5></div>'
                .'<div><input type="checkbox" class="inputRadio" name="suppEOS" id="suppEOS" checked="checked"/><label for="suppEOS" style="width:30px;height:30px;margin-right:40px;margin-left:40px;"></label><h5 style="position:relative;bottom:10px;">EOS</h5></div>'
                .'<div><input type="checkbox" class="inputRadio" name="suppPathologies" id="suppPathologies" checked="checked"/><label for="suppPathologies" style="width:30px;height:30px;margin-right:40px;margin-left:40px;"></label><h5 style="position:relative;bottom:10px;">Pathologies</h5></div>'
                .'<div><input type="checkbox" class="inputRadio" name="suppTraitement" id="suppTraitement" checked="checked"/><label for="suppTraitement" style="width:30px;height:30px;margin-right:40px;margin-left:40px;"></label><h5 style="position:relative;bottom:10px;">Traitements</h5></div>'
                .'</div>'
                .'</form><br/>'
                .'<div style="display:flex;justify-content:center;">'
                .'<div class="buttonClassic" style="margin-right:30px;" onclick="document.location=\'find_patient.php\'"><h4><span style="color:white;" class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></h4><h5 style="position:relative;top:4px;right:4px;">Annuler</h5></div>'
                .'<div class="buttonClassic" style="margin-left:30px;" onclick="document.getElementById(\'formRemovePatient\').submit()"><h5 style="position:relative;top:5px;"><span style="color:white;" class="glyphicon glyphicon-trash" aria-hidden="true"></span></h5><h5 style="position:relative;top:15px;right:11px;">Supprimer</h5></div>'
                .'</div>';
            ?>

        </div>


    </div>


    <?php
        nav("Patients");
    ?>
  </body>
</html>
