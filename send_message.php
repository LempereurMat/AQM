<?php
include "config.php";
include "function.php";

if (!isset($_POST["message"]))
    exit();
    
if(isset($_POST["from"]))
	$emetteur = $_POST["from"];
else
    $emetteur = 0;
    
if (isset($_POST["to"]))
    $destinataire = $_POST["to"];
else
    $destinataire = 1;

$message = removeSpecialChars($_POST["message"]);
if ($message=="") {
    if ($emetteur==0) {
        echo '<h4 style="color:#ff8c1a">Votre message est vide</h4>'
        .'<textarea id="textMessage"></textarea>'
        .'<h5>Merci de bien vouloir laisser votre e-mail pour vous recontacter</h5>'
        .'<div style="display:flex;justify-content:center;width:100%;">'
        .'<div class="buttonClassic" style="width:250px;border-radius:15px;margin-right:3px;" onclick="backContact();"><h4>Annuler</h4></div>'
        .'<div class="buttonClassic" style="width:250px;border-radius:15px;margin-left:3px;" onclick="$.post(\'send_message.php\', {message:document.getElementById(\'textMessage\').value}, function (res) { document.getElementById(\'contactMessageDiv\').innerHTML=res; } );"><h4>Envoyer</h4></div>'
        .'</div>';
    }
    exit();
}

//Today
$date = date("Y-m-d");

$SQL = "INSERT INTO messages(emetteur,destinataire,message,date) VALUES (?,?,?,?);";
$req = $db->prepare($SQL);
$req->execute(array($emetteur,$destinataire,$message,$date));

if ($emetteur==0) {
    echo '<h4 style="color:#ff8c1a">Votre message a été envoyé</h4>'
    .'<div class="centerDiv" style="position:static;width:80%;height:60%;padding:10px;border:1px solid white;overflow-y:auto;">'.$message.'</div><br/>'
    .'<div class="buttonClassic" style="width:250px;border-radius:15px;margin-right:3px;left:0px;right:0px;margin:auto;" onclick="backContact();"><h4>Retour</h4></div>'
    .'</div>';
}
    
?>
