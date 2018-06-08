<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
	header('location: login.php');
    exit();
}
else if ($_SESSION['type'] != "Administrator" && $_SESSION['type']!="Manager") {
    header('location: index.php');
    exit();
}


if(isset($_POST["editCHU"]) && ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$_POST["editCHU"])))
{
	$id = $_POST["editCHU"];
	$nom = $_POST["Nom"];
	$adresse = $_POST["Adresse"];
	$ville = $_POST["Ville"];
	$CP = $_POST["CP"];
    
	$SQL = "UPDATE hopital SET Nom='" .$nom. "', Adresse='".$adresse."', ville='".$ville."', CP='".$CP."' WHERE ID='".$id."';";
	$db->exec($SQL);
    message("Hôpital modifié","green");
}
else if(isset($_POST["addCHU"]) && $_SESSION['type']=="Administrator")
{
	$nom = $_POST["Nom"];
	$adresse = $_POST["Adresse"];
	$ville = $_POST["Ville"];
	$CP = $_POST["CP"];
    
    if ($nom!="" && $adresse!="" && $ville!="" && $CP != "") {
        $SQL = "INSERT INTO hopital (Nom,Adresse,Ville,CP) VALUES ('".$nom."','".$adresse."','".$ville."','".$CP."')";
        $db->exec($SQL);
        message("Hôpital ajouté","green");
    }
    else {
        $message = "Champs manquants : ";
        if ($nom=="") $message = $message."Nom,";
        if ($adresse=="") $message = $message."Adresse,";
        if ($ville=="") $message = $message."Ville,";
        if ($CP=="") $message = $message."Code postal,";
        $message = substr($message, 0, -1);
        message($message, "red");
    }
	
}
else if(isset($_POST["removeCHU"]) && $_SESSION['type']=="Administrator")
{
	$id = $_POST["removeCHU"];
	$SQL = "DELETE FROM hopital WHERE ID='".$id."';";
	$db->exec($SQL);
    message("Hôpital supprimé","green");
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

    <div style="position:absolute;width:100%;top:100px;">
        <div class="centerDiv" style="position:static;width:95%;padding-top:15px;padding-right:30px;padding-left:30px;margin-bottom:300px;">
        <?php
            if ($_SESSION['type']=="Administrator")
                echo '<h3 style="color:#ff8c1a;">Hôpitaux</h3><br/>';
            else
                echo '<h3 style="color:#ff8c1a;">Hôpital</h3><br/>';
            ?>
        <table style="font-size:14px;">
        <thead>
            <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>CP</th>
            <th>Ville</th>
            <th>Modification</th>
            <th>Suppression</th>
            </tr>
        </thead>
        <tbody>
				  
        <?php
            if ($_SESSION['type']=="Manager")
                $SQL = "SELECT * FROM hopital WHERE id='".$_SESSION['id_hopital']."';";
            else
                $SQL = "SELECT * FROM hopital";
            $req = $db->query($SQL);
            while($row = $req->fetch())
            {
                echo '<tr>'
                .'<th>'.$row['ID'].'</th>'
                .'<th>'.$row['Nom'].'</th>'
                .'<th>'.$row['Adresse'].'</th>'
                .'<th>'.$row['CP'].'</th>'
                .'<th>'.$row['Ville'].'</th>'
                .'<td onclick="$.post(\'edit_chu.php\', {id:'.$row['ID'].'}, function (res) {'
                            .'document.getElementById(\'secondPanel\').innerHTML=res;'
                            .'scrollButton(50+document.getElementById(\'secondPanel\').offsetTop);'
                    .'});"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></td>'
                .'<td onclick="$.post(\'remove_chu.php\', {id:'.$row['ID'].'}, function (res) {'
                                .'document.getElementById(\'secondPanel\').innerHTML=res;'
                                .'scrollButton(50+document.getElementById(\'secondPanel\').offsetTop);'
                        .'});"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>';
                echo '</tr>';
						
            }
            
            if ($_SESSION['type']=="Administrator")
                echo '<tr><td colspan="7" onclick="$.post(\'add_chu.php\', {}, function (res) { document.getElementById(\'secondPanel\').innerHTML=res; scrollButton(50+document.getElementById(\'secondPanel\').offsetTop); });">+ Ajouter un hôpital</td></tr>';
        ?>

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
