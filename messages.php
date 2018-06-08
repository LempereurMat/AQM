<?php
    include "config.php";
    include "function.php";
    
    if (!isset($_SESSION['username'])){
        header('location: login.php');
        exit();
    }
    
    if ($_SESSION["type"] != "Administrator" && $_SESSION["type"]!="Manager") {
        header('location: index.php');
        exit();
    }

    if (isset($_POST["messageLu"])) {
        $SQL = "SELECT lu FROM messages WHERE ID_message='".$_POST["messageLu"]."';";
        $req = $db->query($SQL);
        if ($row = $req->fetch()) {
            if ($row['lu']==0) {
                $SQL = "UPDATE messages SET lu='1' WHERE ID_message='".$_POST["messageLu"]."';";
                $db->query($SQL);
                echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
            }
            else {
                $SQL = "UPDATE messages SET lu='0' WHERE ID_message='".$_POST["messageLu"]."';";
                $db->query($SQL);
                echo '<span style="color:#ff8c1a;" class="glyphicon glyphicon-envelope" aria-hidden="true"></span>';
            }
                
        }
        else {
            echo '<span style="color:#ff8c1a;" class="glyphicon glyphicon-envelope" aria-hidden="true"></span>';
        }
        exit();
    }
    
    else if (isset($_POST["messageSupp"])) {
        $SQL = "DELETE FROM messages WHERE ID_message='".$_POST["messageSupp"]."';";
        $db->query($SQL);
        echo 'true';
        exit();
    }
    
    else if (isset($_POST["update"])) { ?>
        <div class="buttonClassic" style="position:absolute;right:40px;top:35px;" onclick="autoUpdate=0;$.post('messages.php', {newMessage:0}, function (res) {document.getElementById('messagerieDiv').innerHTML=res;})"><h2 style="position:relative;margin:0px;bottom:3px;">+</h2><h5 style="position:relative;bottom:8px;right:8px;">Nouveau message</h5>
        </div>
        <h3 style="color:#ff8c1a;">Messages</h3><br/>
        <table>
            <tr>
            <th>Lu</th>
            <th>De</th>
            <th>Date</th>
            <th>Message</th>
            <th>-</th>
            <tr>
        <?php
            $SQL = "SELECT * FROM messages WHERE destinataire='".$_SESSION['id']."' ORDER BY lu DESC,date;";
            $req = $db->query($SQL);
            while($row = $req->fetch()) {
                echo '<tr id="message'.$row['ID_message'].'">';
            
                if ($row['lu']==1)
                    echo '<td id="lu'.$row['ID_message'].'" class="tdHover" onclick="$.post(\'messages.php\', {messageLu:'.$row['ID_message'].'}, function(res) {document.getElementById(\'lu'.$row['ID_message'].'\').innerHTML=res;});"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                else
                    echo '<td id="lu'.$row['ID_message'].'" class="tdHover" onclick="$.post(\'messages.php\', {messageLu:'.$row['ID_message'].'}, function(res) {document.getElementById(\'lu'.$row['ID_message'].'\').innerHTML=res;});"><span style="color:#ff8c1a;" class="glyphicon glyphicon-envelope" aria-hidden="true"></span></td>';
                if ($row['emetteur']==0)
                    echo '<td style="font-size:13px;">Inconnu</td>';
                else {
                    $SQLemetteur = "SELECT nom,prenom FROM utilisateur WHERE id='".$row["emetteur"]."';";
                    $reqemetteur = $db->query($SQLemetteur);
                    $emetteur=$reqemetteur->fetch();
                    echo '<td style="font-size:13px;">'.$emetteur['nom'].' '.$emetteur['prenom'].'</td>';
                }
            
                $date = new DateTime($row["date"]);
                $new_date = $date->format('d/m/Y');
                echo '<td style="font-size:13px;">'.$new_date.'</td>';
            
                echo '<td style="width:60%;font-size:13px;">'.$row["message"].'</td>';
            
                echo '<td class="tdHover" onclick="$.post(\'messages.php\', {messageSupp:'.$row['ID_message'].'}, function(res) { if (res==\'true\') document.getElementById(\'message'.$row['ID_message'].'\').remove();});"><span style="font-size:15px;"class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>';
            
                echo '</tr>';
            }
        echo '</table>';
        exit();
    }
    else if (isset($_POST["newMessage"])) {
        echo '<h4 style="color:#ff8c1a;">Nouveau message</h4><br/>';
        echo '<div style="width:100%;display:flex;justify-content:center;">'
            .'<div style="width:200px;height:200px;border:1px solid rgba(255,255,255,0.5);border-radius:10px;background-color:rgba(0,0,0,0.2);padding:5px;overflow-y:auto;">';
        $SQL = "SELECT id,nom,prenom FROM utilisateur WHERE id<>'".$_SESSION['id']."' AND (type='Administrator' OR type='Manager');";
        $req = $db->query($SQL);
        while ($row = $req->fetch()) {
            echo '<input type="checkbox" name="destinataire" id="destinataire'.$row['id'].'" value="'.$row['id'].'"/><label style="width:100%;" for="destinataire'.$row['id'].'">'.$row['nom'].' '.$row['prenom'].'</label>';
        }
        echo '</div>'
            .'<div style="flex:1;"><textarea id="textMessage" style="height:200px;"></textarea></div>'
        .'</div>'
        .'<div style="display:flex;width:100%;justify-content:center;margin-top:50px;">'
            .'<div class="buttonClassic" style="width:150px;border-radius:15px;height:40px;" onclick="autoUpdate=1;$.post(\'messages.php\', {update:\'0\'}, function (res) { document.getElementById(\'messagerieDiv\').innerHTML=res; });"><h5>Retour</h5></div>'
            .'<div class="buttonClassic" style="width:150px;border-radius:15px;height:40px;" onclick="var checks = document.getElementsByName(\'destinataire\'); for (var i=0 ; i<checks.length ; i++) { if (checks[i].checked) $.post(\'send_message.php\', {from:'.$_SESSION['id'].', to:checks[i].value, message:document.getElementById(\'textMessage\').value}); } autoUpdate=1; $.post(\'messages.php\', {update:\'0\'}, function (res) { document.getElementById(\'messagerieDiv\').innerHTML=res; });"><h5>Envoyer</h5></div>'
        .'</div>';
        exit();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
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
        .tdHover {
            cursor:pointer;
            transition:background-color 0.5s ease;
        }

        .tdHover:hover {
            background-color:rgba(0,0,0,0.7);
        }

        textarea {
            transition:background-color 0.5s ease;
            background-color:rgba(0,0,0,0.2);
            border:1px solid white;
            border-radius:10px;
            width:80%;
            height:60%;
            padding:10px;
        }

        textarea:focus {
            outline:none;
            background-color:rgba(0,0,0,0.4);
        }

        input[type="checkbox"] {
            display:none;
        }

        input[type="checkbox"] + label {
            cursor:pointer;
            transition:background-color 0.5s ease;
            border:1px solid white;
            padding:5px;
            border-radius:10px;
        }

        input[type="checkbox"] + label:hover {
            background-color:rgba(255,255,255,0.3);
        }

        input[type="checkbox"]:checked + label {
            background-color:rgba(255,255,255,0.3);
        }

    </style>

        <div class="background">

        <img class="bgImg" src="img/index.png" alt=""/>

		<div id="messagerieDiv" class="centerDiv" style="top:100px;width:80%;">
        </div>

        <?php
            nav("Messagerie");
        ?>
    </div>
  </body>
</html>

<script>
    var autoUpdate=1;
    $.post('messages.php', {update:'0'}, function (res) { document.getElementById('messagerieDiv').innerHTML=res; });
    setInterval(function () { if (autoUpdate==1) $.post('messages.php', {update:'0'}, function (res) { document.getElementById('messagerieDiv').innerHTML=res; }); }, 30000);
</script>
