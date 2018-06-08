<?php
include "config.php";
include "function.php";

    if (!isset($_SESSION['username'])){
        exit();
    }
    
    if (isset($_POST['id'])) {
        $sID = $_POST['id'];
    }
    else exit();


$SQL = "SELECT * FROM traitement WHERE ID_Traitement='".$sID."'";
$req = $db->query($SQL);
$aTraitement = $req->fetch();

if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$aTraitement['hopital_ID'])))
    exit();
    
$date = new DateTime($aTraitement["Date"]);
$new_date = $date->format('d/m/Y');
?>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="color:#ff8c1a">Supprimer le traitement</h3><br/>

<h4 style="color:white">Voulez-vous supprimer ce traitement   (<span style="color:#ff8c1a"><?php echo $new_date;?></span>) ?</h4><br/>

<form id="formRemoveTraitement" method="post" action="post_patient.php">
    <input type="hidden" name="id" value="<?php echo $aTraitement['Patients_ID']; ?>"/>
    <input type="hidden" name="p_RemoveTraitement" value="<?php echo $aTraitement['ID_Traitement']; ?>"/>
		
    <div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formRemoveTraitement').submit();"><h4>Supprimer</h4></div>
</form>
