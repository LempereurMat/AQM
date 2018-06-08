<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
    exit();
}
else if ($_SESSION['type']!="Administrator" && $_SESSION['type']!="Manager") {
    exit();
}
    
$SQL = "SELECT * FROM hopital";
$REQ = $db->query($SQL);
$aHopital = array();
while($DATA = $REQ->fetch()) $aHopital[$DATA['ID']] = $DATA;
    
?>

<style>
    .addUtilisateurText {
        height:40px;
        width:20%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border: 1px solid white;
        border-radius:25px;
    }

    .addUtilisateurText:focus {
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
        overflow:hidden;
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


<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(0)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="color:white">Ajouter un <span style="color:#ff8c1a">utilisateur</span></h3><br/>

<form id="formAddUtilisateur" method="post" action="utilisateur.php">

<input type="hidden" name="addUtilisateur" value="0"/>

<h5 style="color:#ff8c1a">Nom</h5>
<input type="text" class="addUtilisateurText" name="nom" placeholder="Nom"/><br/>

<h5 style="color:#ff8c1a">Pr&eacutenom</h5>
<input type="text" class="addUtilisateurText" name="prenom" placeholder="Prénom"/><br/>

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
            echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\';"><h5>'.$nom.'</h5></label></div>';
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

<h5 style="color:#ff8c1a">E-mail</h5>
<input type="text" class="addUtilisateurText" style="width:30%" name="email" placeholder="... @ ..."/><br/>

<h5 style="color:#ff8c1a">Login</h5>
<input type="text" class="addUtilisateurText" name="username" placeholder="Username"/><br/>

<h5 style="color:#ff8c1a">Mot de passe</h5>
<input type="text" class="addUtilisateurText" name="password" placeholder="Mot de passe"/><br/>

<h5 style="color:#ff8c1a">Type</h5>
<div class="inputSelect" id="inputSelectType" style="overflow:hidden">
    <h5 class="labelSelect" id="labelType" style="margin:3px;">Membre</h5>
    <div class="selectOptions" style="display:flex;justify-content:center;">
        <?php
            if ($_SESSION['type']=="Manager") {
                echo '<div><input type="radio" id="typePassiveMember" name="type" value="Passive Member" class="inputRadioRectangle"/><label for="typePassiveMember" onclick="document.getElementById(\'labelType\').innerHTML=\'Passive Member\'"><h5>Passive Member</h5></label></div>'
                .'<div><input type="radio" id="typeMember" name="type" value="Member" class="inputRadioRectangle" checked/><label for="typeMember" onclick="document.getElementById(\'labelType\').innerHTML=\'Member\'"><h5>Member</h5></label></div>'
                .'</div>'
                .'<style>'
                .'#inputSelectType:hover {'
                .'width:330px;'
                .'height:68px;'
                .'}'
                .'</style>';
            }
            else {
                echo '<div><input type="radio" id="typePassiveMember" name="type" value="Passive Member" class="inputRadioRectangle"/><label for="typePassiveMember" onclick="document.getElementById(\'labelType\').innerHTML=\'Passive Member\'"><h5>Passive Member</h5></label></div>'
                .'<div><input type="radio" id="typeMember" name="type" value="Member" class="inputRadioRectangle" checked/><label for="typeMember" onclick="document.getElementById(\'labelType\').innerHTML=\'Member\'"><h5>Member</h5></label></div>'
                .'<div><input type="radio" id="typeManager" name="type" value="Manager" class="inputRadioRectangle"/><label for="typeManager" onclick="document.getElementById(\'labelType\').innerHTML=\'Manager\'"><h5>Manager</h5></label></div>'
                .'<div><input type="radio" id="typeAdministrator" name="type" value="Administrator" class="inputRadioRectangle"/><label for="typeAdministrator" onclick="document.getElementById(\'labelType\').innerHTML=\'Administrator\'"><h5>Administrator</h5></label></div>'
                .'</div>'
                .'<style>'
                .'#inputSelectType:hover {'
                .'width:660px;'
                .'height:68px;'
                .'}'
                .'</style>';
            }
            ?>
    </div>
</div><br/>

<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formAddUtilisateur').submit();"><h4>Ajouter</h4></div>
</form>

  </body>
</html>
