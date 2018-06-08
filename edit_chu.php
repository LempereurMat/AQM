<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
	header('location: login.php');
    exit();
}

if (isset($_POST["id"]))
    $sID = $_POST["id"];
else exit();
$SQL = "SELECT * FROM hopital WHERE id='".$sID."';";
$req = $db->query($SQL);
$row = $req->fetch();

if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$row['ID'])))
    exit();
    
?>

<style>
    .editCHUText {
        height:40px;
        width:20%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border: 1px solid white;
        border-radius:25px;
    }

    .editCHUText:focus {
        outline:none;
        box-shadow:none;
        background-color:rgba(0,0,0,0.4);
    }

</style>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="color:white">Modifier un <span style="color:#ff8c1a">hôpital</span></h3><br/>

<form id="formEditCHU" method="post" action="chu.php">

<input type="hidden" name="editCHU" value="<?php echo $row['ID']; ?>"/>

<h5 style="color:#ff8c1a">Nom</h5>
<input type="text" class="editCHUText" name="Nom" value="<?php echo $row['Nom']; ?>"/><br/>

<h5 style="color:#ff8c1a">Adresse</h5>
<input type="text" class="editCHUText" name="Adresse" value="<?php echo $row['Adresse']; ?>"/><br/>

<h5 style="color:#ff8c1a">Code postal</h5>
<input type="text" class="editCHUText" name="CP" value="<?php echo $row['CP']; ?>"/><br/>

<h5 style="color:#ff8c1a">Ville</h5>
<input type="text" class="editCHUText" name="Ville" value="<?php echo $row['Ville']; ?>"/><br/>

<br/><br/>
<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formEditCHU').submit();"><h4>Valider</h4></div>

</form>
