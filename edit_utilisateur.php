<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
	header('location: login.php');
    exit();
}
    
$sID = $_POST["id"];
    
$SQL = "SELECT * FROM utilisateur WHERE id=".$sID.";";
$req = $db->query($SQL);
$row = $req->fetch();

if ($row['type']=="Administrator")
    exit();
    
if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$row['id_hopital']))) {
    header('location: index.php');
    exit();
}
    
$SQL = "SELECT * FROM hopital";
$REQ = $db->query($SQL);
$aHopital = array();
while($DATA = $REQ->fetch()) $aHopital[$DATA['ID']] = $DATA;
    
?>

<style>
    .editUtilisateurText {
        height:40px;
        width:20%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border: 1px solid white;
        border-radius:25px;
    }

    .editUtilisateurText:focus {
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

    .inputSelect1x4:hover {
        width:660px;
        height:70px;
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

<h3 style="color:white">Modifier un <span style="color:#ff8c1a">utilisateur</span></h3><br/>

<form id="formEditUtilisateur" method="post" action="utilisateur.php">

<input type="hidden" name="editUtilisateur" value="<?php echo $row['id']; ?>"/>

<h5 style="color:#ff8c1a">Nom</h5>
<input type="text" class="editUtilisateurText" name="nom" value="<?php echo $row['nom']; ?>"/><br/>

<h5 style="color:#ff8c1a">Pr&eacutenom</h5>
<input type="text" class="editUtilisateurText" name="prenom" value="<?php echo $row['prenom']; ?>"/><br/>

<h5 style="color:#ff8c1a">CHU</h5>
<div id="inputSelectHopital" class="inputSelect" style="overflow:hidden;width:300px;">
<?php
    if ($_SESSION['type']=="Manager") {
        echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">'.$aHopital[$_SESSION['id_hopital']]['Nom'].'</h5>'
        .'<div class="selectOptions">'
        .'<div><input type="radio" id="hopitalManager" name="hopital" value="0" class="inputRadioRectangle" checked="checked"/><label style="width:250px" for="hopitalManager" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$aHopital[$_SESSION['id_hopital']]['Nom'].'\';"><h5>'.$aHopital[$_SESSION['id_hopital']]['Nom'].'</h5></label></div>'
        .'</div>'
        .'<style>'
        .'#inputSelectHopital:hover {'
        .'height:68px;'
        .'}'
        .'</style>';
    }
    else {
        echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">'.$aHopital[$row['id_hopital']]['Nom'].'</h5>'
        .'<div class="selectOptions">';
        foreach (array_keys($aHopital) as $id) {
            $nom = $aHopital[$id]['Nom'];
            if ($id == $row['id_hopital'])
                echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle" checked="checked"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\';"><h5>'.$nom.'</h5></label></div>';
            else
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
<input type="text" class="editUtilisateurText" style="width:30%" name="email" value="<?php echo $row['email']; ?>"/><br/>

<h5 style="color:#ff8c1a">Login</h5>
<input type="text" class="editUtilisateurText" name="username" value="<?php echo $row['username']; ?>"/><br/>

<h5 style="color:#ff8c1a">Mot de passe</h5>
<input type="text" class="editUtilisateurText" name="password" placeholder="Laisser vide pour inchanger"/><br/>

<?php if ($row['type']!="Manager")  {?>
<h5 style="color:#ff8c1a">Type</h5>
<div class="inputSelect" id="inputSelectType" style="overflow:hidden">
    <h5 class="labelSelect" id="labelType" style="margin:3px;"><?php echo $row['type']; ?></h5>
    <div class="selectOptions" style="display:flex;justify-content:center;">
        <?php if ($_SESSION['type']=="Manager") { ?>
        <div><input type="radio" id="typePassiveMember" name="type" value="Passive Member" class="inputRadioRectangle" <?php if ($row['type']=="Passive Member") echo 'checked="checked"'; ?>/><label for="typePassiveMember" onclick="document.getElementById('labelType').innerHTML='Passive Member'"><h5>Passive Member</h5></label></div>
        <div><input type="radio" id="typeMember" name="type" value="Member" class="inputRadioRectangle" <?php if ($row['type']=="Member") echo 'checked="checked"'; ?>/><label for="typeMember" onclick="document.getElementById('labelType').innerHTML='Member'"><h5>Member</h5></label></div>
        <style>
            #inputSelectType:hover
            {
                width:330px;
                height:68px;
            }
        </style>

        <?php } else {?>
            <div><input type="radio" id="typePassiveMember" name="type" value="Passive Member" class="inputRadioRectangle" <?php if ($row['type']=="Passive Member") echo 'checked="checked"'; ?>/><label for="typePassiveMember" onclick="document.getElementById('labelType').innerHTML='Passive Member'"><h5>Passive Member</h5></label></div>
            <div><input type="radio" id="typeMember" name="type" value="Member" class="inputRadioRectangle" <?php if ($row['type']=="Member") echo 'checked="checked"'; ?>/><label for="typeMember" onclick="document.getElementById('labelType').innerHTML='Member'"><h5>Member</h5></label></div>
            <div><input type="radio" id="typeManager" name="type" value="Manager" class="inputRadioRectangle" <?php if ($row['type']=="Manager") echo 'checked="checked"'; ?>/><label for="typeManager" onclick="document.getElementById('labelType').innerHTML='Manager'"><h5>Manager</h5></label></div>
            <div><input type="radio" id="typeAdministrator" name="type" value="Administrator" class="inputRadioRectangle" <?php if ($row['type']=="Administrator") echo 'checked="checked"'; ?>/><label for="typeAdministrator" onclick="document.getElementById('labelType').innerHTML='Administrator'"><h5>Administrator</h5></label></div>
            <style>
                #inputSelectType:hover
                {
                    width:660px;
                    height:68px;
                }
            </style>
        <?php } ?>
    </div>
</div>
<?php } ?>
<br/>

<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formEditUtilisateur').submit();"><h4>Valider</h4></div>
</form>

  </body>
</html>
