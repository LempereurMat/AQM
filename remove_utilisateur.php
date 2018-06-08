<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
    exit();
}

$sID = $_POST["id"];

$SQL = "SELECT * FROM utilisateur WHERE id=".$sID.";";
$req = $db->query($SQL);
$row = $req->fetch();

if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$row['id_hopital']))) {
    exit();
}
    
?>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="color:white">Supprimer un <span style="color:#ff8c1a">utilisateur</span></h3><br/>
<h4>Supprimer <span style="color:#ff8c1a"><?php echo $row['nom'].' '.$row['prenom']; ?></span> ? (<?php echo $row['type']; ?>)</h4><br/>

<form id="formRemoveUtilisateur" method="post" action="utilisateur.php">
<input type="hidden" name="removeUtilisateur" value="<?php echo $row['id']; ?>"/>
<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formRemoveUtilisateur').submit()"><h4>Valider</h4></div>
</form>
