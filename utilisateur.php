<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
	header('location: login.php');
    exit();
}
else if ($_SESSION['type'] != "Administrator" && $_SESSION['type'] != "Manager") {
    header('location: index.php');
    exit();
}

if(isset($_POST["editUtilisateur"]))
{
	$id = $_POST["editUtilisateur"];
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$type = $_POST["type"];
    if ($type != "Member" && $type!="Passive Member")
        $type="Member";
    if ($_SESSION['type']=="Administrator")
        $id_hopital = $_POST["hopital"];
    else
        $id_hopital = $_SESSION['id_hopital'];
	
	
	if ($password !="")
	{	
		$SQL = "UPDATE utilisateur SET nom='".$nom."', prenom='".$prenom."', email='".$email."', username='".$username."', type='".$type."' , password='".md5($password)."' , id_hopital='".$id_hopital."' WHERE id='".$id."';";
		$db->exec($SQL);
	}
	else
	{	$SQL = "UPDATE utilisateur SET nom='".$nom."', prenom='".$prenom."', email='".$email."', username='".$username."', type='".$type."', id_hopital='".$id_hopital."' WHERE id='".$id."';";
		$db->exec($SQL);
    }
    message("Utilisateur modifié", "green");
}
else if(isset($_POST["removeUtilisateur"]))
{
	$id = $_POST["removeUtilisateur"];
    if ($_SESSION['type']=="Manager")
        $SQL = "DELETE FROM utilisateur WHERE id='".$id."' AND id_hopital='".$_SESSION['id_hopital']."' AND type<>'Administrator' AND type<>'Manager';";
    else
        $SQL = "DELETE FROM utilisateur WHERE id='".$id."';";
	$db->exec($SQL);
    message("Utilisateur supprimé", "green");
}
else if(isset($_POST["addUtilisateur"]))
{	
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$type = $_POST["type"];
    //Sécurité
    if ($_SESSION['type']!="Administrator" && $type != "Member" && $type!="Passive Member")
        $type="Member";
    if ($_SESSION['type']=="Administrator" && isset($_POST['hopital']))
        $id_hopital = $_POST["hopital"];
    else
        $id_hopital = $_SESSION['id_hopital'];
	
	if (($password !="") && ($nom !="") && ($prenom !="") && ($username !=""))
	{	
		$SQL = "INSERT INTO utilisateur (nom, prenom,email, username, type, password, id_hopital) VALUES ('" .$nom. "','".$prenom."','".$email."','".$username."','".$type."' , '".md5($password)."' , '".$id_hopital."')";
		echo $SQL;
		$db->exec($SQL);
        message("Utilisateur ajouté", "green");
	}
    else {
        $message = "Champs manquants : ";
        if ($nom=="") $message = $message."Nom,";
        if ($prenom=="") $message = $message."Prénom,";
        if ($username=="") $message = $message."Username,";
        if ($password=="") $message = $message."Password,";
        $message = substr($message, 0, -1);
        message($message, "red");
    }
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
  </head>
  <body>

<style>

    td {
        cursor:pointer;
        transition: background-color 0.5s ease;
        padding-top:5px;
        padding-bottom:5px;
    }

    td:hover {
        background-color:rgba(0,0,0,0.3);
    }

</style>

<script>
    function scrollButton(y) {
        $("html,body").animate({scrollTop:y}, 600, 'swing');
    }
</script>

<div class="background">

    <img class="bgImg" src="img/index.png" alt=""/>

    <div style="position:absolute;width:100%;top:50px;">
        <div class="centerDiv" style="position:static;width:95%;padding-top:15px;padding-right:30px;padding-left:30px;margin-bottom:300px;">
            <h3 style="color:#ff8c1a;">Utilisateurs</h3><br/>
            <table style="font-size:14px;">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Pr&eacutenom</th>
                <th>CHU</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Profil</th>
                <th>Modification</th>
                <th>Suppression</th>
                </tr>
            </thead>
            <tbody>
				  
            <?php
                if ($_SESSION['type']=="Manager")
                    $SQL = "SELECT * FROM utilisateur JOIN hopital ON id_hopital=hopital.ID WHERE id_hopital='".$_SESSION['id_hopital']."' AND type<>'Administrator' ORDER BY utilisateur.id";
                else
                    $SQL = "SELECT * FROM utilisateur JOIN hopital ON id_hopital=hopital.ID ORDER BY utilisateur.id";
                $req = $db->query($SQL);
                while($row = $req->fetch())
                {
                    echo '<tr>'.
                    '<th>'.$row['id'].'</th>'
                    .'<th>'.$row['nom'].'</th>'
                    .'<th>'.$row['prenom'].'</th>'
                    .'<th>'.$row['Nom'].'</th>'
                    .'<th>'.$row['username'].'</th>'
                    .'<th>'.$row['email'].'</th>';
                    if ($row['type']=="Administrator")
                        echo '<th style="color:#ff8c1a">'.$row['type'].'</th>';
                    else
                        echo '<th>'.$row['type'].'</th>';
		    if ($_SESSION['type']=="Administrator" || $row['type']!="Manager")
                    	echo '<td onclick="$.post(\'edit_utilisateur.php\', {id:'.$row['id'].'}, function (res) {'
                                    .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                    .'scrollButton(0+document.getElementById(\'secondPanel\').offsetTop);'
                        .'});"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></td>';
                    else
			echo '<th></th>';
		    if ($row['type']!="Administrator" && ($_SESSION['type']=="Administrator" || $row['type']!="Manager"))
                        echo '<td onclick="$.post(\'remove_utilisateur.php\', {id:'.$row['id'].'}, function (res) {'
                                    .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                    .'scrollButton(0+document.getElementById(\'secondPanel\').offsetTop);'
                        .'});"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>';
                    else
                        echo  '<th></th>';
                    echo '</tr>';
                }
            ?>
            <tr><td colspan="9" onclick="$.post('add_utilisateur.php', {}, function (res) { document.getElementById('secondPanel').innerHTML=res; scrollButton(0+document.getElementById('secondPanel').offsetTop); });">+ Ajouter un utilisateur</td></tr>
            </tbody>
            </table>
        </div>
        <div id="secondPanel" class="centerDiv" style="position:static;width:95%;padding-right:30px;padding-left:30px;">
            <h4>Selectionner une information dans le tableau</h4>
        </div>
        <div class="centerDiv" style="position:static;width:95%;margin-top:200px;visibility:hidden;">
        </div>
    </div>

    <?php
        nav("Admin");
    ?>
  </body>
</html>
