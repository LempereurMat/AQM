<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
    exit();
}
else if ($_SESSION["type"] != 'Administrator') {
    exit();
}

?>

<style>
    .addCHUText {
        height:40px;
        width:20%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border: 1px solid white;
        border-radius:25px;
    }

    .addCHUText:focus {
        outline:none;
        box-shadow:none;
        background-color:rgba(0,0,0,0.4);
    }

</style>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="color:white">Ajouter un <span style="color:#ff8c1a">hôpital</span></h3><br/>

<form id="formAddCHU" method="post" action="chu.php">

<input type="hidden" name="addCHU" value="0"/>

<h5 style="color:#ff8c1a">Nom</h5>
<input type="text" class="addCHUText" name="Nom" placeholder="Nom"/><br/>

<h5 style="color:#ff8c1a">Adresse</h5>
<input type="text" class="addCHUText" name="Adresse" placeholder="Adresse"/><br/>

<h5 style="color:#ff8c1a">Code postal</h5>
<input type="text" class="addCHUText" name="CP" placeholder="Code postal"/><br/>

<h5 style="color:#ff8c1a">Ville</h5>
<input type="text" class="addCHUText" name="Ville" placeholder="Ville"/><br/>

<br/><br/>
<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formAddCHU').submit();"><h4>Valider</h4></div>

</form>
