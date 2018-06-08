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


$SQL = "SELECT * FROM consultation WHERE consultation.ID =  '".$sID."'";
$REQ = $db->query($SQL);
$aConsult = $REQ->fetch();
    
$nHopital = $aConsult['Hopital_ID'];
if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)))
    exit();


$SQL = "SELECT * FROM utilisateur";
$REQ = $db->query($SQL);
$aUser = array();
while($DATA = $REQ->fetch()) $aUser[$DATA['id']] = $DATA;

$SQL = "SELECT * FROM hopital";
$REQ = $db->query($SQL);
$aHopital = array();
while($DATA = $REQ->fetch()) $aHopital[$DATA['ID']] = $DATA;


$SQL = "SELECT * FROM conditionaqm";
$REQ = $db->query($SQL);
$aCondition = array();
while($DATA = $REQ->fetch()) $aCondition[$DATA['ID_condition']] = $DATA;


$SQL = "SELECT * FROM appareillage";
$REQ = $db->query($SQL);
$aAppareillage = array();
while($DATA = $REQ->fetch()) $aAppareillage[$DATA['ID_appareillage']] = $DATA;



$date = new DateTime($aConsult["Date_consultation"]);
$new_date = $date->format('d/m/Y');
?>
<style>
    .editAQMText {
        height:40px;
        width:40%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border: 1px solid white;
        border-radius:25px;
    }

    .editAQMText:focus {
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

        <h3 style="color:#ff8c1a">Modifier AQM</h3><br/>

		<form id="formEditAQM" method="post" action="post_patient.php">
        <input type="hidden" value="<?php echo $aConsult['patients_ID_patient']; ?>" name="id" />
		<input type="hidden" value="<?php echo $aConsult['ID']; ?>" name="p_EditAQM" />
        <div style="width:40%;left:0px;right:0px;margin:auto;">
            <h5 style="color:#ff8c1a">Date<h5>
            <input type="text" class="editAQMText" id="date" name="date" value="<?php echo $new_date;?>" placeholder="JJ/MM/AAAA"><br/><br/>

			<h5 style="color:#ff8c1a">CHU</h5>

            <div id="inputSelectHopital" class="inputSelect" style="overflow:hidden;width:300px;">
                <?php
                    //Hopital selectionné
                    $hopitalSelected = $aConsult['Hopital_ID'];
                    echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">'.$aHopital[$hopitalSelected]['Nom'].'</h5>'
                    .'<div class="selectOptions">';
                    //Le reste
                    if ($_SESSION['type']=="Manager") {
                        echo '<div><input type="radio" id="hopitalManager" name="hopital" value="0" class="inputRadioRectangle" checked="checked"/><label style="width:250px" for="hopitalManager" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$aHopital[$hopitalSelected]['Nom'].'\';$.post(\'edit_AQM.php\', {changerMenuMedecin:'.$hopitalSelected.'}, function(res) {document.getElementById(\'inputSelectUtilisateur\').innerHTML=res;});"><h5>'.$aHopital[$hopitalSelected]['Nom'].'</h5></label></div>';
                        echo '</div>';
                        echo '<style>'
                        .'#inputSelectHopital:hover {'
                        .'height: 68px;'
                        .'}'
                        .'</style>';
                    }
                    else {
                        foreach (array_keys($aHopital) as $id) {
                            $nom = $aHopital[$id]['Nom'];
                            if ($id == $hopitalSelected)
                                echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle" checked="checked"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\';$.post(\'edit_AQM.php\', {changerMenuMedecin:'.$id.'}, function(res) {document.getElementById(\'inputSelectUtilisateur\').innerHTML=res;});"><h5>'.$nom.'</h5></label></div>';
                            else
                                echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\';$.post(\'edit_AQM.php\', {changerMenuMedecin:'.$id.'}, function(res) {document.getElementById(\'inputSelectUtilisateur\').innerHTML=res;});"><h5>'.$nom.'</h5></label></div>';
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
            <?php
                //Utilisateur selectionné
                $userSelected = $aConsult['Utilisateur_ID'];
                echo '<h5 class="labelSelect" id="labelUtilisateur" style="margin:3px;">'.$aUser[$userSelected]['nom'].' '.$aUser[$userSelected]['prenom'].'</h5>'
                .'<div class="selectOptions">';
                $nb = 0;
                foreach (array_keys($aUser) as $id) {
                    if ($aUser[$id]['id_hopital'] == $aConsult['Hopital_ID'] && ($aUser[$id]['type']=="Member" || $aUser[$id]['type']=="Passive Member")) {
                        $nom = $aUser[$id]['nom'];
                        $prenom = $aUser[$id]['prenom'];
                        if ($id == $userSelected)
                            echo '<div><input type="radio" id="utilisateur'.$id.'" name="medecin" value="'.$id.'" class="inputRadioRectangle" checked="checked"/><label style="width:250px" for="utilisateur'.$id.'" onclick="document.getElementById(\'labelUtilisateur\').innerHTML=\''.$nom.' '.$prenom.'\'"><h5>'.$nom.' '.$prenom.'</h5></label></div>';
                        else
                            echo '<div><input type="radio" id="utilisateur'.$id.'" name="medecin" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="utilisateur'.$id.'" onclick="document.getElementById(\'labelUtilisateur\').innerHTML=\''.$nom.' '.$prenom.'\'"><h5>'.$nom.' '.$prenom.'</h5></label></div>';
                        $nb++;
                    }
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
                ?>
            </div><br/>

            <h5 style="color:#ff8c1a">Condition</h5>

            <div class="inputSelect" id="inputSelectCondition" style="overflow:hidden;width:300px;">
            <?php
                //Condition
                $conditionSelected = $aConsult['Condition'];
                echo '<h5 class="labelSelect" id="labelCondition" style="margin:3px;">'.$aCondition[$conditionSelected]['type_condition'].'</h5>'
                .'<div class="selectOptions">';
                $nb = 0;
                foreach (array_keys($aCondition) as $id) {
                        $nom = $aCondition[$id]['type_condition'];
                        if ($id == $conditionSelected)
                            echo '<div><input type="radio" id="condition'.$id.'" name="condition" value="'.$id.'" class="inputRadioRectangle" checked="checked"/><label style="width:250px" for="condition'.$id.'" onclick="document.getElementById(\'labelCondition\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
                        else
                            echo '<div><input type="radio" id="condition'.$id.'" name="condition" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="condition'.$id.'" onclick="document.getElementById(\'labelCondition\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
                        $nb++;
                }
    
                echo '</div>';
                //Taille automatique qui dépend du nombre d'hôpitaux
                //h = selectPadding + nb*(optionMargin+optionHeight)
                $h = 22+$nb*(6+40);
                echo '<style>'
                .'#inputSelectCondition:hover {'
                .'height:'.$h.'px;'
                .'}'
                .'</style>';
            ?>
            </div><br/>

            <h5 style="color:#ff8c1a">Appareillage</h5>

            <div class="inputSelect" id="inputSelectAppareillage" style="overflow:hidden;width:300px;">
            <?php
                //Condition
                $appareillageSelected = $aConsult['Appareillage'];
                echo '<h5 class="labelSelect" id="labelAppareillage" style="margin:3px;">'.$aAppareillage[$appareillageSelected]['type_appareillage'].'</h5>'
                .'<div class="selectOptions">';
                $nb = 0;
                foreach (array_keys($aAppareillage) as $id) {
                    $nom = $aAppareillage[$id]['type_appareillage'];
                    if ($id == $appareillageSelected)
                        echo '<div><input type="radio" id="appareillage'.$id.'" name="appareillage" value="'.$id.'" class="inputRadioRectangle" checked="checked"/><label style="width:250px" for="appareillage'.$id.'" onclick="document.getElementById(\'labelAppareillage\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
                    else
                        echo '<div><input type="radio" id="appareillage'.$id.'" name="appareillage" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="appareillage'.$id.'" onclick="document.getElementById(\'labelAppareillage\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
                    $nb++;
                }
    
                echo '</div>';
                //Taille automatique qui dépend du nombre d'hôpitaux
                //h = selectPadding + nb*(optionMargin+optionHeight)
                $h = 22+$nb*(6+40);
                echo '<style>'
                .'#inputSelectAppareillage:hover {'
                .'height:'.$h.'px;'
                .'}'
                .'</style>';
            ?>
            </div><br/><br/>

            <div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="var select = document.getElementsByName('medecin'); var medecin = 0; for (var i = 0 ; i<select.length ; i++) { if (select[i].checked) medecin=select[i].value;} if (medecin != 0) document.getElementById('formEditAQM').submit(); else alert('Veuillez choisir un médecin');"><h4>Valider</h4></div>

        </div>

        </form>
    </div>

