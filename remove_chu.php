<?php
include "config.php";
include "function.php";
    
    if (!isset($_SESSION['username'])){
        exit();
    }
    
if (isset($_POST["id"]))
    $sID = $_POST["id"];
else exit();

$SQL = "SELECT * FROM hopital WHERE ID=".$sID.";";
$req = $db->query($SQL);
$row = $req->fetch();
    
if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$row['ID'])))
    exit();
    
?>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3>Supprimer un <span style="color:#ff8c1a">hôpital</span></h3><br/>
<h4>Supprimer l'hôpital <span style="color:#ff8c1a"><?php echo $row["Nom"]; ?></span> ?</h4><br/>

<form id="formRemoveCHU" method="post" action="chu.php">
<input type="hidden" name="removeCHU" value="<?php echo $row['ID']; ?>"/>
<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formRemoveCHU').submit();"><h4>Valider</h4></div>
</form>
