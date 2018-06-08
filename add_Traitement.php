<?php
include "config.php";
include "function.php";
    
    if (!isset($_SESSION['username'])){
        exit();
    }

    //AJAX pour changer le select des medecins en fonction de l'hopital (l'id de l'hopital est stocké dans changerMenuMedecin)
    //exit() important pour ne pas afficher toute la page
    if (isset($_POST["changerMenuMedecin"]))
    {
        $idHopital = $_POST["changerMenuMedecin"];
        
        $SQL = "SELECT * FROM utilisateur";
        $req = $db->query($SQL);
        $aUser = array();
        while($row = $req->fetch()) {
            if ($row['id_hopital'] == $idHopital && ($row['type']=="Member" || $row['type']=="Passive Member")) {
                $aUser[$row['id']] = $row;
            }
        }
        
        if (count($aUser) == 0) {
            echo '<h5 class="labelSelect" id="labelUtilisateur" style="margin:3px;">Aucun médecin</h5>';
            exit();
        }
        else
            echo '<h5 class="labelSelect" id="labelUtilisateur" style="margin:3px;">Selectionner</h5>';
        echo '<div class="selectOptions">';
        $nb = 0;
        foreach (array_keys($aUser) as $id) {
            $nom = $aUser[$id]['nom'];
            $prenom = $aUser[$id]['prenom'];
            echo '<div><input type="radio" id="utilisateur'.$id.'" name="medecin" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="utilisateur'.$id.'" onclick="document.getElementById(\'labelUtilisateur\').innerHTML=\''.$nom.' '.$prenom.'\'" ><h5>'.$nom.' '.$prenom.'</h5></label></div>';
            $nb++;
        }
        
        echo '</div>';
        //Taille automatique qui dépend du nombre d'hôpitaux
        //h = selectPadding + nb*(optionMargin+optionHeight)
        $h = 22+$nb*(6+40);
        echo '<style>'
        .'#inputSelectUtilisateur:hover {'
        .'height:'.$h.'px;'
        .'}'
        .'</style>';
        exit();
    }
    //AJAX pour modifier le sous-type en fonction du type
    else if (isset($_POST["changerMenuType"]))
    {
        $idType = $_POST["changerMenuType"];
        
        $SQL = "SELECT * FROM soustypetraitement";
        $req = $db->query($SQL);
        $aTypes = array();
        while($row = $req->fetch()) {
            if ($row['TypeTraitement'] == $idType) {
                $aTypes[$row['ID_Sous_Type_Traitement']] = $row;
            }
        }
        
        if (count($aTypes) == 0) {
            echo '<h5 class="labelSelect" id="labelType" style="margin:3px;">Aucun type</h5>';
            exit();
        }
        else
            echo '<h5 class="labelSelect" id="labelType" style="margin:3px;">Selectionner</h5>';
        echo '<div class="selectOptions">';
        $nb = 0;
        foreach (array_keys($aTypes) as $id) {
            $nom = $aTypes[$id]['SousTypeTraitement'];
            echo '<div><input type="radio" id="type'.$id.'" name="typetraitement" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="type'.$id.'" onclick="document.getElementById(\'labelType\').innerHTML=\''.$nom.'\'" ><h5>'.$nom.'</h5></label></div>';
            $nb++;
        }
        
        echo '</div>';
        //Taille automatique qui dépend du nombre d'hôpitaux
        //h = selectPadding + nb*(optionMargin+optionHeight)
        $h = 22+$nb*(6+40);
        echo '<style>'
        .'#inputSelectType:hover {'
        .'height:'.$h.'px;'
        .'}'
        .'</style>';
        exit();
    }

    
    
    
if(isset($_POST["id"])) {
	$sID = $_POST["id"];
}


$SQL = "SELECT * FROM utilisateur";
$REQ = $db->query($SQL);
$aUser = array();
while($DATA = $REQ->fetch()) $aUser[$DATA['id']] = $DATA;

$SQL = "SELECT * FROM hopital";
$REQ = $db->query($SQL);
$aHopital = array();
while($DATA = $REQ->fetch()) $aHopital[$DATA['ID']] = $DATA;


$SQL = "SELECT * FROM typetraitement";
$REQ = $db->query($SQL);
$aTypeTraitement = array();
while($DATA = $REQ->fetch()) $aTypeTraitement[$DATA['ID_Type_Traitement']] = $DATA;


$SQL = "SELECT * FROM soustypetraitement";
$REQ = $db->query($SQL);
$aSousTypeTraitement = array();
while($DATA = $REQ->fetch()) $aSousTypeTraitement[$DATA['ID_Sous_Type_Traitement']] = $DATA;

$SQL = "SELECT * FROM localisationtraitement";
$REQ = $db->query($SQL);
$aLocalisationTraitement = array();
while($DATA = $REQ->fetch()) $aLocalisationTraitement[$DATA['ID_Localisation_Traitement']] = $DATA;

$SQL = "SELECT * FROM cote";
$REQ = $db->query($SQL);
$aCote = array();
while($DATA = $REQ->fetch()) $aCote[$DATA['ID_Cote']] = $DATA;

?>

<style>
    .addTraitementText {
        height:40px;
        width:15%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border: 1px solid white;
        border-radius:25px;
    }

    .addTraitementText:focus {
        outline:none;
        box-shadow:none;
        background-color:rgba(0,0,0,0.4);
    }

    .selectOptions {
        visibility:hidden;
        filter:blur(10px);
    }

    .inputSelect {
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

    .inputSelect:hover .labelSelect  {
        display:none;
    }

    .inputSelect:hover .selectOptions {
        transition: filter 0.5s ease;
        visibility:visible;
        filter:blur(0px);
    }

</style>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="white">Ajouter un <span style="color:#ff8c1a">traitement</span></h3><br/>

<form id="formAddTraitement" method="post" action="post_patient.php">
<input type="hidden" name="id" value="<?php echo $sID; ?>"/>
<input type="hidden" name="p_AddTraitement" value="<?php echo $sID; ?>"/>

<h5 style="color:#ff8c1a">Date<h5>
<input type="text" class="addTraitementText" id="date" name="date" placeholder="JJ/MM/AAAA"><br/><br/>


<h5 style="color:#ff8c1a">CHU</h5>

<div id="inputSelectHopital" class="inputSelect" style="overflow:hidden;width:300px;">
<?php
    if ($_SESSION['type']=="Manager") {
        echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">Selectionner</h5>'
        .'<div class="selectOptions">'
        .'<div><input type="radio" id="hopitalManager" name="hopital" value="0" class="inputRadioRectangle"/><label style="width:250px" for="hopitalManager" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$aHopital[$_SESSION['id_hopital']]['Nom'].'\';$.post(\'add_AQM.php\', {changerMenuMedecin:'.$_SESSION['id_hopital'].'}, function(res) {document.getElementById(\'inputSelectUtilisateur\').innerHTML=res;});"><h5>'.$aHopital[$_SESSION['id_hopital']]['Nom'].'</h5></label></div>'
        .'</div>'
        .'<style>'
        .'#inputSelectHopital:hover {'
        .'height:68px;'
        .'}'
        .'</style>';
    }
    else {
        echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">Selectionner</h5>'
        .'<div class="selectOptions">';
        foreach (array_keys($aHopital) as $id) {
            $nom = $aHopital[$id]['Nom'];
            echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\';$.post(\'add_AQM.php\', {changerMenuMedecin:'.$id.'}, function(res) {document.getElementById(\'inputSelectUtilisateur\').innerHTML=res;});"><h5>'.$nom.'</h5></label></div>';
        }
        echo '</div>';
        //Taille automatique qui dépend du nombre d'hôpitaux
        //h = selectPadding + nb*(optionMargin+optionHeight)
        $h = 22+(count($aHopital))*(6+40);
        echo '<style>'
        .'#inputSelectHopital:hover {'
        .'height:'.$h.'px;'
        .'}'
        .'</style>';
    }
    ?>
</div><br/>

<h5 style="color:#ff8c1a">M&eacutedecin</h5>

<div class="inputSelect" id="inputSelectUtilisateur" style="overflow:hidden;width:300px;">
    <h5 class="labelSelect" id="labelUtilisateur" style="margin:3px;">----</h5>
</div><br/>

<h5 style="color:#ff8c1a">Traitement</h5>

<div class="inputSelect" id="inputSelectTraitement" style="overflow:hidden;width:300px;">
<?php
    echo '<h5 class="labelSelect" id="labelTraitement" style="margin:3px;">Selectionner</h5>'
    .'<div class="selectOptions">';
    $nb = 0;
    foreach (array_keys($aTypeTraitement) as $id) {
        $nom = $aTypeTraitement[$id]['TypeTraitement'];
        echo '<div><input type="radio" id="traitement'.$id.'" name="traitement" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="traitement'.$id.'" onclick="document.getElementById(\'labelTraitement\').innerHTML=\''.$nom.'\';$.post(\'edit_Traitement.php\', {changerMenuType:'.$id.'}, function(res) {document.getElementById(\'inputSelectType\').innerHTML=res;});"><h5>'.$nom.'</h5></label></div>';
        $nb++;
    }
    
    echo '</div>';
    //Taille automatique qui dépend du nombre de traitements
    //h = selectPadding + nb*(optionMargin+optionHeight)
    $h = 22+$nb*(6+40);
    echo '<style>'
    .'#inputSelectTraitement:hover {'
    .'height:'.$h.'px;'
    .'}'
    .'</style>';
    ?>
</div><br/>

<h5 style="color:#ff8c1a">Type</h5>

<div class="inputSelect" id="inputSelectType" style="overflow:hidden;width:300px;">
    <h5 class="labelSelect" id="labelType" style="margin:3px;">----</h5>
</div><br/>

<h5 style="color:#ff8c1a">Localistion</h5>

<div class="inputSelect" id="inputSelectLocalisation" style="overflow:hidden;width:500px;">
<?php
    echo '<h5 class="labelSelect" id="labelLocalisation" style="margin:3px;">Selectionner</h5>'
    .'<div class="selectOptions">';
    $nb = 0;
    foreach (array_keys($aLocalisationTraitement) as $id) {
        $nom = $aLocalisationTraitement[$id]['Localisation'];
        echo '<div><input type="radio" id="localisation'.$id.'" name="localisation" value="'.$id.'" class="inputRadioRectangle"/><label style="width:450px" for="localisation'.$id.'" onclick="document.getElementById(\'labelLocalisation\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
        $nb++;
    }
    
    echo '</div>';
    //Taille automatique qui dépend du nombre de localisations
    //h = selectPadding + nb*(optionMargin+optionHeight)
    $h = 22+$nb*(6+40);
    echo '<style>'
    .'#inputSelectLocalisation:hover {'
    .'height:'.$h.'px;'
    .'}'
    .'</style>';
    ?>
</div><br/>

<h5 style="color:#ff8c1a">C&ocirct&eacute</h5>

<div class="inputSelect" id="inputSelectCote" style="overflow:hidden;width:300px;">
<?php
    echo '<h5 class="labelSelect" id="labelCote" style="margin:3px;">Selectionner</h5>'
    .'<div class="selectOptions">';
    $nb = 0;
    foreach (array_keys($aCote) as $id) {
        $nom = $aCote[$id]['Cote'];
        echo '<div><input type="radio" id="cote'.$id.'" name="cote" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="cote'.$id.'" onclick="document.getElementById(\'labelCote\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
        $nb++;
    }
    
    echo '</div>';
    //Taille automatique qui dépend du nombre de côtés
    //h = selectPadding + nb*(optionMargin+optionHeight)
    $h = 22+$nb*(6+40);
    echo '<style>'
    .'#inputSelectCote:hover {'
    .'height:'.$h.'px;'
    .'}'
    .'</style>';
    ?>
</div><br/>

<h5 style="color:#ff8c1a">Quantit&eacute<h5>
<input type="text" class="addTraitementText" id="quantite" name="quantite"/><br/><br/>

<h5 style="color:#ff8c1a">Technique<h5>
<input type="text" class="addTraitementText" id="technique" name="technique"/><br/><br/>

<br/>

<div type="submit" class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formAddTraitement').submit()"><h4>Ajouter</h4></div>
</form>

