<?php
include "config.php";
include "function.php";
    
if(!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

if(isset($_POST["id"])) {
	$sID = $_POST["id"];
}
else {
    header('location: index.php');
    exit();
}

// Info Patient
$SQL = "SELECT * FROM patients LEFT JOIN pathologies ON patients.ID_patient = pathologies.patients_ID_patient WHERE patients.ID_patient = '".$sID."';";
$req = $db->query($SQL);
$aPatient = $req->fetch();

// Info Consultation
$SQL = "SELECT * FROM utilisateur, consultation WHERE patients_ID_patient = '".$sID."' AND Utilisateur_ID = utilisateur.id ORDER BY consultation.Date_consultation;";
$REQ = $db->query($SQL);
$aListeConsult = array();
while($DATA = $REQ->fetch()) $aListeConsult[] = $DATA;
$nListeConsult = count($aListeConsult);

// Info Traitement
$SQL = "SELECT * FROM utilisateur, traitement WHERE Patients_ID = '".$sID."' AND Operateur_ID = utilisateur.id;";
$REQ = $db->query($SQL);
$aListeTraitement = array();
while($DATA = $REQ->fetch()) $aListeTraitement[] = $DATA;
$nListeTraitement = count($aListeTraitement);


// Info EOS
$SQL = "SELECT * FROM eos WHERE Patient_ID='".$sID."';";
$REQ = $db->query($SQL);
$aListeEOS = array();
while($DATA = $REQ->fetch()) $aListeEOS[] = $DATA;
$nListeEOS = count($aListeEOS);

    
    function afficherTableaux() {
        global $sID, $aPatient, $aListeConsult, $nListeConsult, $aListeTraitement, $nListeTraitement, $aListeEOS, $nListeEOS, $db;
        
        echo '<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>';
        
        echo '<h3 style="color:#ff8c1a;">AQM</h3><br/>'
        
        .'<table>'
        .'<thead>'
        .'<tr>'
        .'<th></th>'
        .'<th><h5>ID</h5></th>'
        .'<th>M&eacutedecin</th>'
        .'<th>CHU</th>'
        .'<th>Date</th>'
        .'<th>Condition</th>'
        .'<th>Appareillage</th>'
        .'<th>Donn&eacutees <br/>Cliniques</th>'
        .'<th>Donn&eacutees <br/>Fonctionnelles</th>'
        .'<th colspan="2">Courbes</th>'
        .'<th>Compte-rendu</th>';
        if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID'])) {
            echo '<th>Modification</th>'
            .'<th>Suppression</th>';
        }
        
        echo '</tr>'
        .'</thead>'
        .'<tbody>';
        
        for($i=0; $i < $nListeConsult; $i++) {
            echo '<tr>'
            .'<th><input id="checkbox'.$aListeConsult[$i]["ID"].'" class="inputCheck" form="compare" type="checkbox" name="checkCompare" value="'.$aListeConsult[$i]["ID"].'"/><label id="checkLabel'.$aListeConsult[$i]["ID"].'" for="checkbox'.$aListeConsult[$i]["ID"].'"></label></th>'
            .'<th>'.$aListeConsult[$i]["ID"].'</th>';
            echo '<th>'.$aListeConsult[$i]["prenom"]." ".$aListeConsult[$i]["nom"].'</th>';
            
            $SQL = "SELECT Nom FROM hopital WHERE ID = '".$aListeConsult[$i]["Hopital_ID"]."'";
            $req = $db->query($SQL);
            $hopital = "";
            if ($row = $req->fetch()) $hopital = $row["Nom"];
            echo '<th>'.$hopital.'</th>';
            
            $date = new DateTime($aListeConsult[$i]["Date_consultation"]);
            $new_date = $date->format('d/m/Y');
            echo '<th>'.$new_date.'</th>';
            
            if ($aListeConsult[$i]["Condition"] == 0)
                echo '<th><img src="img/barefootwhite.png" width="23px" height="23px"/></th>';
            else
                echo '<th><img src="img/shoes.png" width="23px" height="23px"/></th>';
            
            $SQL = "SELECT type_appareillage FROM appareillage WHERE ID_appareillage = '".$aListeConsult[$i]["Appareillage"]."'";
            $req = $db->query($SQL);
            $appareillage = "";
            if ($row = $req->fetch()) $appareillage = $row["type_appareillage"];
            
            echo '<th>'.$appareillage.'</th>';
            
            echo '<td onclick="$.post(\'clinical_data.php\','
                                    .'{id:\''.$sID.'\', utilisateur:\''.$aListeConsult[$i]["Utilisateur_ID"].'\', consultation:\''.$aListeConsult[$i]["ID"].'\'},'
                                    .'function (res) {'
                                        .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                        //Scroll parentDiv + relative offsetTop
                                        .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                    .'})">'
            .'<span style="color:white;" class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>'
            .'</td>';
            echo '<td onclick="$.post(\'functionnal_data.php\','
                                    .'{id:\''.$sID.'\', utilisateur:\''.$aListeConsult[$i]["Utilisateur_ID"].'\', consultation:\''.$aListeConsult[$i]["ID"].'\'},'
                                    .'function (res) {'
                                        .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                        //Scroll parentDiv + relative offsetTop
                                        .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                    .'})">'
            .'<span style="color:white;" class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>'
            .'</td>';
            
            if ($aListeConsult[$i]["LCycleNumber"] != 0)
            {
                echo '<td onclick="$.post(\'view_c3d.php\','
                                    .'{patient:\''.$sID.'\', consultation:\''.$aListeConsult[$i]["ID"].'\'},'
                                    .'function (res) {'
                                        //On sépare la partie script pour l'exécuter.
                                        .'document.getElementById(\'secondPanel\').innerHTML=res.substring(0, res.indexOf(\'<script>\'));'
                                        .'eval(res.substring(res.indexOf(\'<script>\')+8, res.indexOf(\'</script>\')));'
                                        //Scroll parentDiv + relative offsetTop
                                        .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                    .'})">'
                .'<span style="color:white;" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'
                .'</td>';
                echo '<td onclick="loadingIcon();scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                .'$.post(\'similaires_c3d.php\','
                                    .'{consultation:\''.$aListeConsult[$i]["ID"].'\'},'
                                    .'function (res) {'
                                        .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                    .'})">'
                .'<span style="color:white;" class="glyphicon glyphicon-signal" aria-hidden="true"></span>'
                .'</td>';
            }
            else
            {
                if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
                    echo '<td colspan="2" onclick="$.post(\'upload_c3d.php\','
                                            .'{patient:\''.$sID.'\', consultation:\''.$aListeConsult[$i]["ID"].'\'},'
                                            .'function (res) {'
                                                .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                                //Scroll parentDiv + relative offsetTop
                                                .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                            .'})">'
                    .'<span style="color:white;" class="glyphicon glyphicon-open-file" aria-hidden="true"></span>'
                    .'</td>';
                else
                    echo '<td colspan="2"><span style="color:white;" class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>';
            }
            
            if ($aListeConsult[$i]["CompteRendu"] == "") {
                echo '<td onclick="$.post(\'edit_report.php\','
                                        .'{id:\''.$sID.'\', consultation:\''.$aListeConsult[$i]["ID"].'\'},'
                                        .'function (res) {'
                                            .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                            //Scroll parentDiv + relative offsetTop
                                            .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                        .'})">'
                .'<span style="color:white;" class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'
                .'</td>';
            }
            else {
                echo '<td onclick="$.post(\'edit_report.php\','
                                    .'{id:\''.$sID.'\', consultation:\''.$aListeConsult[$i]["ID"].'\'},'
                                    .'function (res) {'
                                    .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                    //Scroll parentDiv + relative offsetTop
                                    .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                .'})">'
                .'<span style="color:white;" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'
                .'</td>';
            }
            
            
            
            if ($_SESSION['type']=='Administrator' || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
            {
                echo '<td onclick="$.post(\'edit_AQM.php\','
                                        .'{id:\''.$aListeConsult[$i]["ID"].'\'},'
                                        .'function (res) {'
                                        .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                        //Scroll parentDiv + relative offsetTop
                                        .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                    .'})">'
                .'<span style="color:white;" class="glyphicon glyphicon-cog" aria-hidden="true"></span>'
                .'</td>';
                echo '<td onclick="$.post(\'remove_AQM.php\','
                                        .'{id:\''.$aListeConsult[$i]["ID"].'\'},'
                                        .'function (res) {'
                                            .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                            //Scroll parentDiv + relative offsetTop
                                            .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                        .'})">'
                .'<span style="color:white;" class="glyphicon glyphicon-trash" aria-hidden="true"></span>'
                .'</td>';
            }
            echo '</tr>';
        }
        
        if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
        {
            echo '<tr><td colspan="14" onclick="$.post(\'add_AQM.php\', {id:'.$sID.'}, function (res) {'
                .'document.getElementById(\'secondPanel\').innerHTML=res;'
                //Scroll parentDiv + relative offsetTop
                .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                .'})">+ Ajouter une AQM</td></tr>';
        }
        
        echo '</tbody>'
        .'</table><br/>';
        
    echo '<div style="position:relative;bottom:8px;float:left;">'
    .'<input type="checkbox" id="checkAllCompare" class="inputCheck" onclick="checkAll(this)"/><label for="checkAllCompare" style="margin-left:31px;"></label>'
    .'<span style="position:relative;bottom:4px;left:7px;">Tout cocher</span>'
    .'<span class="buttonCompare" style="position:relative;bottom:3px;right:5px;margin-left:31px;padding:4px;" onclick="compare()">Comparer</span>'
    .'</div><br/>'
    
    
    .'<h3 style="color:#ff8c1a;">Traitement</h3><br/>'
    
    
    .'<table>'
    .'<thead>'
    .'<tr>'
    .'<th>ID</th>'
    .'<th>M&eacutedecin</th>'
    .'<th>CHU</th>'
    .'<th>Date</th>'
    .'<th>Traitement</th>'
    .'<th>Type</th>'
    .'<th>Localisation</th>'
    .'<th>C&ocirct&eacute</th>'
    .'<th>Quantit&eacute</th>'
    .'<th>Technique</th>';
    if ($_SESSION['type'] == "Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID'])) {
        echo '<th>Duplication</th>'
        .'<th>Modification</th>'
        .'<th>Suppression</th>';
    }
    echo '</tr>'
    .'</thead>'
    .'<tbody>';
    
    for($i=0; $i < $nListeTraitement; $i++)
    {
        echo '<tr><th>'.$aListeTraitement[$i]["ID_Traitement"].'</th>';
        echo '<th>'.$aListeTraitement[$i]["prenom"]." ".$aListeTraitement[$i]["nom"].'</th>';
        
        $SQL = "SELECT Nom FROM hopital WHERE ID = '".$aListeTraitement[$i]["hopital_ID"] ."'";
        $req = $db->query($SQL);
        $hopital = '';
        if ($row = $req->fetch()) $hopital=$row["Nom"];
        echo '<th>'.$hopital.'</th>';
        
        
        $date = new DateTime($aListeTraitement[$i]["Date"]);
        $new_date = $date->format('d/m/Y');
        echo '<th>'.$new_date.'</th>';
        
        $SQL = "SELECT TypeTraitement FROM typetraitement WHERE ID_Type_Traitement =  '".$aListeTraitement[$i]["TypeTraitement_ID"]."' ";
        $req = $db->query($SQL);
        $typeTraitement = '';
        if ($row = $req->fetch()) $typeTraitement = $row["TypeTraitement"];
        echo '<th>'.$typeTraitement.'</th>';
        
        $SQL = "SELECT SousTypeTraitement FROM soustypetraitement WHERE ID_Sous_Type_Traitement =  '".$aListeTraitement[$i]["SousTypeTraitement_ID"]."' ";
        $req = $db->query($SQL);
        $sousTypeTraitement = '';
        if ($row = $req->fetch()) $sousTypeTraitement = $row["SousTypeTraitement"];
        echo '<th>'.$sousTypeTraitement.'</th>';
        
        $SQL = "SELECT Localisation FROM localisationtraitement WHERE ID_Localisation_Traitement =  '".$aListeTraitement[$i]["Localisation_ID"]."' ";
        $req = $db->query($SQL);
        $localisationTraitement = '';
        if ($row = $req->fetch()) $localisationTraitement = $row["Localisation"];
        echo '<th>'.$localisationTraitement.'</th>';
        
        $SQL = "SELECT Cote FROM cote WHERE ID_Cote =  '".$aListeTraitement[$i]["Cote_ID"]."' ";
        $req =$db->query($SQL);
        $cote = '';
        if ($row = $req->fetch()) $cote = $row["Cote"];
        echo '<th>'.$cote.'</th>';
        echo '<th>'.$aListeTraitement[$i]["Quantite"].'</th>';
        echo '<th>'.$aListeTraitement[$i]["Technique"].'</th>';
        
        
        if ($_SESSION['type']=='Administrator' || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
        {
            echo '<td onclick="$.post(\'copy_Traitement.php\','
                                .'{id:\''.$aListeTraitement[$i]["ID_Traitement"].'\'},'
                                .'function (res) {'
                                    .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                    //Scroll parentDiv + relative offsetTop
                                    .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                .'})">'
            .'<span style="color:white;" class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>'
            .'</td>';
            echo '<td onclick="$.post(\'edit_Traitement.php\','
                                    .'{id:\''.$aListeTraitement[$i]["ID_Traitement"].'\'},'
                                    .'function (res) {'
                                        .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                        //Scroll parentDiv + relative offsetTop
                                        .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                    .'})">'
            .'<span style="color:white;" class="glyphicon glyphicon-cog" aria-hidden="true"></span>'
            .'</td>';
            echo '<td onclick="$.post(\'remove_Traitement.php\','
                                    .'{id:\''.$aListeTraitement[$i]["ID_Traitement"].'\'},'
                                    .'function (res) {'
                                        .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                        //Scroll parentDiv + relative offsetTop
                                        .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                    .'})">'
            .'<span style="color:white;" class="glyphicon glyphicon-trash" aria-hidden="true"></span>'
            .'</td>';
        }
        echo '</tr>';
    }
    
    if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
        echo '<tr><td colspan="13" onclick="$.post(\'add_Traitement.php\', {id:'.$sID.'}, function (res) {'
            .'document.getElementById(\'secondPanel\').innerHTML=res;'
            //Scroll parentDiv + relative offsetTop
            .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
            .'})">+ Ajouter un traitement</td></tr>';
    
    echo '</tbody>'
    .'</table><br/>';
    
    
    echo '<h3 style="color:#ff8c1a;">EOS</h3><br/>'
    
    .'<table>'
    .'<thead>'
    .'<tr>'
    .'<th>ID</th>'
    .'<th>CHU</th>'
    .'<th>Date</th>'
    .'<th>Long. Femur</th>'
    .'<th>Long. Tibia</th>'
    .'<th>Long. Fonct.</th>'
    .'<th>Long. Anat.</th>'
    .'<th>Diam. TF</th>'
    .'<th>Offset Fémur</th>'
    .'<th>Long. Col Fémoral</th>'
    .'<th>Neck Shaft Angle</th>'
    .'<th>Genou Varus</th>'
    .'<th>Genou Flessum</th>'
    .'<th>Angle Fem. Méca.</th>'
    .'<th>Angle Tib. Méca.</th>'
    .'<th>HKS</th>'
    .'<th>Torsion Fem.</th>'
    .'<th>Torsion Tib.</th>'
    .'<th>Rot. Fem. Tib.</th>';
    if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID'])) {
        echo '<th>Modif.</th>'
        .'<th>Suppr.</th>';
    }
    
    echo '</tr>'
    .'</thead>'
    .'<tbody>';
    
    
    
    for($i=0; $i < $nListeEOS; $i++)
    {
        echo '<tr><th>'.$aListeEOS[$i]["ID_EOS"].' (D)</th>';
        
        
        $SQL = "SELECT Nom FROM hopital WHERE ID = '".$aListeEOS[$i]["id_hopital"] ."'";
        $req = $db->query($SQL);
        $hopital = '';
        if ($row = $req->fetch()) $hopital = $row["Nom"];
        echo '<th>'.$hopital.'</th>';
        
        
        $date = new DateTime($aListeEOS[$i]["Date"]);
        $new_date = $date->format('d/m/Y');
        echo '<th>'.$new_date.'</th>';
        
        echo '<th>'.$aListeEOS[$i]["Long_Femur_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Tibia_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Fonct_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Anat_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Diam_TF_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Offset_Femur_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Col_Fem_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Neck_Shaft_Angle_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Knee_Varus_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Knee_Flessum_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Angle_Fem_Meca_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Angle_Tib_Meca_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["HKS_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Torsion_Fem_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Torsion_Tib_D"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Rot_Fem_Tib_D"].'</th>';
        
        if ($_SESSION['type']=='Administrator' || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
        {
            echo '<td rowspan="2" onclick="$.post(\'edit_EOS.php\','
                                        .'{id:\''.$aListeEOS[$i]["ID_EOS"].'\'},'
                                        .'function (res) {'
                                            .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                            //Scroll parentDiv + relative offsetTop
                                            .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                        .'})">'
            .'<span style="color:white;" class="glyphicon glyphicon-cog" aria-hidden="true"></span>'
            .'</td>';
            echo '<td rowspan="2" onclick="$.post(\'remove_EOS.php\','
                                                .'{id:\''.$aListeEOS[$i]["ID_EOS"].'\'},'
                                                .'function (res) {'
                                                    .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                                    //Scroll parentDiv + relative offsetTop
                                                    .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
                                                .'})">'
            .'<span style="color:white;" class="glyphicon glyphicon-trash" aria-hidden="true"></span>'
            .'</td>';
            
        }
        echo '</tr>';
        
        
        echo '<tr><th>'.$aListeEOS[$i]["ID_EOS"].' (G)</th>';
        echo '<th>'.$hopital.'</th>';
        echo '<th>'.$new_date.'</th>';
        
        echo '<th>'.$aListeEOS[$i]["Long_Femur_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Tibia_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Fonct_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Anat_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Diam_TF_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Offset_Femur_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Long_Col_Fem_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Neck_Shaft_Angle_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Knee_Varus_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Knee_Flessum_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Angle_Fem_Meca_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Angle_Tib_Meca_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["HKS_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Torsion_Fem_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Torsion_Tib_G"].'</th>';
        echo '<th>'.$aListeEOS[$i]["Rot_Fem_Tib_G"].'</th>';
        
        echo '</tr>';
    }
        
    if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
        echo '<tr><td colspan="21" onclick="$.post(\'add_EOS.php\', {id:'.$sID.'}, function (res) {'
            .'document.getElementById(\'secondPanel\').innerHTML=res;'
            //Scroll parentDiv + relative offsetTop
            .'scrollButton(650+document.getElementById(\'secondPanel\').offsetTop);'
            .'})">+ Ajouter une EOS</td></tr>';
    
    echo '</tbody>';
    echo '</table>';
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
    <script src="http://code.highcharts.com/highcharts.js"></script>

  </head>
  <body>
    <style>

        @keyframes jumpDown {
            0% {top:0px;}
            50% {top:10px;}
            100% {top:0px;}
        }

        .downButton {
            position:relative;
            margin:auto;
            left:0px;
            right:0px;
            text-align:center;
            animation: jumpDown 1s ease infinite;
        }

        .inputCheck {
            display: none;
        }

        .inputCheck ~ label {
            cursor:pointer;
            width:15px;
            height:15px;
            background-color:rgba(0,0,0,0.2);
            transition: background-color 0.5s ease;
            border: 1px solid white;
            border-radius:50%;
            margin:3px;
        }

        .inputCheck:hover ~ label {
            background-color:rgba(255,255,255,0.2);
        }

        .inputCheck:checked ~ label {
            background-color:rgba(255,255,255,0.6);
        }

        .buttonCompare {
            cursor:pointer;
            border: 1px solid white;
            border-radius:4px;
            transition:background-color 0.5s ease;
            background-color:rgba(255,255,255,0.1);
        }

        .buttonCompare:hover {
            background-color:rgba(255,255,255,0.5);
        }

        table {
            width:96%;
            margin:auto;
            left:0px;
            right:0px;
        }

        tr {
            height:30px;
        }

        th {
            font-size:13px;
            padding-top:4px;
            padding-bottom:4px;
        }

        td {
            cursor:pointer;
            font-size:16px;
            transition: background-color 0.5s ease;
        }

        td:hover {
            background-color:rgba(0,0,0,0.5);
        }

        @keyframes rotation {
            0% {-ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); transform: rotate(0deg);}
            100% {-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);}
        }

    </style>

    <script>
        function scrollButton(y) {
            $("html,body").animate({scrollTop:y}, 600, 'swing');
        }

        function checkAll(source) {
            var checkboxes = document.getElementsByName('checkCompare');
            for (var i = 0 ; i < checkboxes.length ; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        function compare() {
            var checkboxes = document.getElementsByName('checkCompare');
            var checkIDs = [];
            var nb = 0;
            for (var i = 0 ; i < checkboxes.length ; i++) {
                if (checkboxes[i].checked) {
                    nb++;
                    checkIDs.push(checkboxes[i].value);
                }
            }
            if (nb >= 2) {
                var compareIDs="";
                for (var i = 0 ; i < checkIDs.length ; i++) {
                    compareIDs += checkIDs[i];
                    if (i!=checkIDs.length-1) compareIDs+=",";
                }
                $.post("compare_c3d.php", {consult:compareIDs}, function (res) {
                       //Les \<script\> sont la pour empecher le document html de comprendre les balises comme fin de script
                       //On sépare la partie script pour l'exécuter.
                       document.getElementById("secondPanel").innerHTML=res.substring(0, res.indexOf("\<script\>"));
                       eval(res.substring(res.indexOf("\<script\>")+8, res.indexOf("\</script\>")));
                       //Scroll parentDiv + relative offsetTop
                       scrollButton(650+document.getElementById('secondPanel').offsetTop);
                    });
            }
        }

        function loadingIcon() {
            document.getElementById('secondPanel').innerHTML='<span style="color:white;font-size:50px;animation:rotation 1s linear infinite;" class="glyphicon glyphicon-refresh" aria-hidden="true"></span><br/><br><h4>Recherche des courbes les plus proches...</h4>';
        }
    </script>

        <div class="background">
            <img class="bgImg" src="img/index.png" alt=""/>

            <!--<div class="goTopButton" onclick="scrollButton(0)"><h4 style="padding-right:2px;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></h4></div>-->

            <div class="centerDiv" style="top:100px;width:60%;padding-top:50px;padding-bottom:50px;">
                <h3 style="color:white"><?php echo $aPatient["titre"].'. <span style="color:#ff8c1a">'.strtoupper($aPatient["nom"]).'</span> '.$aPatient["prenom"];?></h3>
                <h4><?php $date = new DateTime($aPatient["date_naissance"]);
                    $new_date = $date->format('d/m/Y');
                    echo $new_date;
                    ?></h4>
                <h4 style="color:white;"><?php echo "IPP : ".$aPatient["IPP"] ?></h4><br/>
                <div style="display:flex;justify-content:center;">
                    <?php
                        if ($_SESSION['type']=='Administrator' || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aPatient['hopital_ID']))
                        {
                            if (isset($_POST['previousPage']) && $_POST['previousPage']=="find_patient.php")
                            {
                                if (strlen($_SESSION["recherche"])==1)
                                    echo '<form id="formFindPatient" action="find_patient.php" method="post"><input type="hidden" name="rechercheLettre" value="'.$_SESSION["recherche"].'"/></form>';
                                else
                                    echo '<form id="formFindPatient" action="find_patient.php" method="post"><input type="hidden" name="recherche" value="'.$_SESSION["recherche"].'"/></form>';
                                echo '<div class="buttonClassic" style="margin-right:130px;" onclick="document.getElementById(\'formFindPatient\').submit()"><h4><span class="glyphicon glyphicon-arrow-left"></span></h4><h5 style="position:relative;top:10px;">Retour</h5></div>';
                                echo '<form id="formEditPatient" action="find_patient_edit.php" method="post"><input type="hidden" name="id" value="'.$aPatient['ID_patient'].'"/></form>'
                                .'<div class="buttonClassic" style="margin-right:40px;" onclick="document.getElementById(\'formEditPatient\').submit()"><h5 style="position:relative;top:5px;"><span class="glyphicon glyphicon-pencil"></span></h5><h5 style="position:relative;top:20px;right:5px;">Modifier</h5></div>'
                                .'<form id="formRemovePatient" action="find_patient_remove.php" method="post"><input type="hidden" name="id" value="'.$aPatient['ID_patient'].'"/></form>'
                                .'<div class="buttonClassic" style="margin-right:180px;" onclick="document.getElementById(\'formRemovePatient\').submit()"><h5 style="position:relative;top:6px;"><span class="glyphicon glyphicon-trash"></span></h5><h5 style="position:relative;top:20px;right:12px;">Supprimer</h5></div>';
                            }
                            else
                            {
                                echo '<form id="formEditPatient" action="find_patient_edit.php" method="post"><input type="hidden" name="id" value="'.$aPatient['ID_patient'].'"/></form>'
                                .'<div class="buttonClassic" style="margin-right:20px;" onclick="document.getElementById(\'formEditPatient\').submit()"><h5 style="position:relative;top:5px;"><span class="glyphicon glyphicon-pencil"></span></h5><h5 style="position:relative;top:20px;right:5px;">Modifier</h5></div>'
                                .'<form id="formRemovePatient" action="find_patient_remove.php" method="post"><input type="hidden" name="id" value="'.$aPatient['ID_patient'].'"/></form>'
                                .'<div class="buttonClassic" style="margin-left:20px;" onclick="document.getElementById(\'formRemovePatient\').submit()"><h5 style="position:relative;top:6px;"><span class="glyphicon glyphicon-trash"></span></h5><h5 style="position:relative;top:20px;right:12px;">Supprimer</h5></div>';
                            }
                        }
                        else
                        {
                            if (isset($_POST['previousPage']) && $_POST['previousPage']=="find_patient.php")
                            {
                                if (strlen($_SESSION["recherche"])==1)
                                    echo '<form id="formFindPatient" action="find_patient.php" method="post"><input type="hidden" name="rechercheLettre" value="'.$_SESSION["recherche"].'"/></form>';
                                else
                                    echo '<form id="formFindPatient" action="find_patient.php" method="post"><input type="hidden" name="recherche" value="'.$_SESSION["recherche"].'"/></form>';
                                echo '<div class="buttonClassic" onclick="document.getElementById(\'formFindPatient\').submit()"><h4><span class="glyphicon glyphicon-arrow-left"></span></h4><h5 style="position:relative;top:10px;">Retour</h5></div>';
                            }
                            else
                            {
                                
                            }
                        }
                    ?>
                </div>
            </div>

            <div style="position:absolute;top:450px;width:100%;height:50px;"><div class="buttonClassic downButton" onclick="scrollButton(650)"><h4 style="padding-right:2px;padding-top:2px;"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></h4><h5 style="position:relative;top:4px;right:8px;">Consulter</h5></div></div>

            <div style="position:absolute;top:700px;width:100%;left:0px;right:0px;margin:auto;">

                <div class="centerDiv" id="mainPanel" style="position:static;padding-top:50px;padding-right:10px;padding-left:10px;width:97%;margin-bottom:350px;">
                        <?php afficherTableaux(); ?>
                </div>

                <div class="centerDiv" id="secondPanel" style="position:static;width:97%;">
                </div>

                <!-- Invisible, pour ne pas coller secondPanel en bas de la fenetre -->
                <div class="centerDiv" style="visibility:hidden;position:static;margin-top:200px;">

                </div>

            </div>



        </div>

    <?php
        nav("Patients");
    ?>

  </body>
</html>
