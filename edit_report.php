<?php
include "config.php";
include "function.php";

    if (!isset($_SESSION['username'])) {
        exit();
    }

if (isset($_POST["id"]) && isset($_POST["consultation"]))
{ 
	$nPatient = $_POST["id"];
	$nConsultation = $_POST["consultation"];
    $SQL = "SELECT hopital_ID FROM patients WHERE ID_Patient='".$nPatient."';";
    $req = $db->query($SQL);
    $row = $req->fetch();
    $nHopital = $row['hopital_ID'];
}


// Info Consultation
$SQL = "SELECT * FROM consultation WHERE consultation.ID = '".$nConsultation."'";

$REQ = $db->query($SQL);
$aConsult = array();
while($DATA = $REQ->fetch()) $aConsult[] = $DATA;

$date = new DateTime($aConsult[0]["Date_consultation"]);
$new_date = $date->format('d/m/Y');

?>

<style>

    textarea {
        font-family: 'Raleway', sans-serif;
        font-weight:200;
        font-size:16px;
        transition: background-color 0.5s ease;
        background-color:rgba(255,255,255,0);
        color:white;
        border-style:solid;
        border-color:white;
        border-radius:25px;
        padding:10px;
        padding-left:20px;
        width:95%;
        height:500px;
    }

    textarea:focus {
        outline:none;
        background-color:rgba(0,0,0,0.3);
    }

</style>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="color:white;">Compte-rendu du <span style="color:#ff8c1a"><?php echo $new_date; ?></span></h3>

<br/>

<?php if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)) { ?>
<form method="post" action="post_patient.php">
    <input type="hidden" value="<?php echo $nPatient; ?>" name="id" />
    <input type="hidden" value="<?php echo $nConsultation; ?>" name="p_EditReport" />

    <div style="width:90%;left:0px;right:0px;margin:auto;">
    <textarea id="mytextarea" name="report"><?php echo $aConsult[0]["CompteRendu"]; ?></textarea>
    </div>
    <br/>
    <button class="buttonClassic" style="width:100px;border-radius:10px;" type="submit" value="Submit"><h4>Valider</h4></button>
</form>
<?php } else { ?>
<div style="width:90%;left:0px;right:0px;margin:auto;">
<textarea id="mytextarea" name="report" disabled><?php echo $aConsult[0]["CompteRendu"]; ?></textarea>
</div>
<?php } ?>

