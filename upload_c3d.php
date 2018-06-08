<?php
include "config.php";
include "function.php";

    if (!isset($_SESSION['username'])){
        exit();
    }
    
if(isset($_POST["patient"]) && isset($_POST["consultation"])) {
	$nPatient = $_POST["patient"];
	$nConsultation = $_POST["consultation"];
    $SQL = "SELECT hopital_ID FROM patients WHERE ID_Patient='".$nPatient."';";
    $req = $db->query($SQL);
    $row = $req->fetch();
    $nHopital = $row['hopital_ID'];
    if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) {
        exit();
    }
}

if (isset($_POST['envoyer']))
{
		$nb_fichier = count($_FILES['files']['name']);
		for ($i=0;$i<$nb_fichier;$i++)
		{
			$dossier = 'temp_files/';
			$fichier[$i] = basename($_FILES['files']['name'][$i]);
			if(move_uploaded_file($_FILES['files']['tmp_name'][$i], $dossier.$fichier[$i] )) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			{
			}
            else {
                message("Erreur de transfert", "red");
                echo '<form id="formUploadc3dPatient" method="post" action="patient.php">'
                .'<input type="hidden" name="id" value="'.$nPatient.'"/>'
                .'</form>'
                .'<script>'
                .'document.getElementById("formUploadc3dPatient").submit();'
                .'</script>';
				exit();
            }
		}
		
		exec("C:\Users\Utilisateur\Anaconda2/python.exe -W error c3dtoserialize.py 2>&1", $output);
		//je récupère les éléments à afficher par le dernier de manière à ne pas prendre en compte les BTK WARNING avec certains anciens fichiers c3d
		$nb = count($output);
		for ($i=0;$i<=31;$i++)
		{
			$result[$i] = $output[$nb-32+$i];
		}
		
		$SQL = "UPDATE `consultation` SET 
		`LCycleNumber` = '".$result[0]."',
		`LPelvisAnglesX` = '".$result[1]."',
		`LPelvisAnglesY` = '".$result[2]."',
		`LPelvisAnglesZ` = '".$result[3]."',
        `LHipAnglesX` = '".$result[4]."',
		`LHipAnglesY` = '".$result[5]."',
		`LHipAnglesZ` = '".$result[6]."',
		`LKneeAnglesX` = '".$result[7]."',
		`LKneeAnglesY` = '".$result[8]."',
		`LKneeAnglesZ` = '".$result[9]."',
		`LAnkleAnglesX` = '".$result[10]."',
		`LAnkleAnglesY` = '".$result[11]."',
		`LAnkleAnglesZ` = '".$result[12]."',
		`LFootProgressAnglesX` = '".$result[13]."',
		`LFootProgressAnglesY` = '".$result[14]."',
		`LFootProgressAnglesZ` = '".$result[15]."',

		`RCycleNumber` = '".$result[16]."',
		`RPelvisAnglesX` = '".$result[17]."',
		`RPelvisAnglesY` = '".$result[18]."',
		`RPelvisAnglesZ` = '".$result[19]."',
        `RHipAnglesX` = '".$result[20]."',
		`RHipAnglesY` = '".$result[21]."',
		`RHipAnglesZ` = '".$result[22]."',
		`RKneeAnglesX` = '".$result[23]."',
		`RKneeAnglesY` = '".$result[24]."',
		`RKneeAnglesZ` = '".$result[25]."',
		`RAnkleAnglesX` = '".$result[26]."',
		`RAnkleAnglesY` = '".$result[27]."',
		`RAnkleAnglesZ` = '".$result[28]."',
		`RFootProgressAnglesX` = '".$result[29]."',
		`RFootProgressAnglesY` = '".$result[30]."',
		`RFootProgressAnglesZ` = '".$result[31]."'

		
		WHERE  `ID` = '".$nConsultation."';";
	//echo $SQL;
	$REQ = $db->exec($SQL);
    message("Courbes enregistrÈes", "green");
    echo '<form id="formUploadc3dPatient" method="post" action="patient.php">'
    .'<input type="hidden" name="id" value="'.$nPatient.'"/>'
    .'</form>'
    .'<script>'
    .'document.getElementById("formUploadc3dPatient").submit();'
    .'</script>';
}
?>

<style>

    .labelFile {
        transition:color 0.5s ease, border 0.5s ease;
        cursor:pointer;
        color:white;
        width:180px;
        background-color:rgba(0,0,0,0.3);
        border: 2px solid rgba(255,255,255,0);
        padding:10px;
        border-radius:10px;
    }

    .labelFile:hover {
        border: 2px solid rgba(255,255,255,0.6);
    }

</style>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="color:white,">Upload fichier <span style="color:#ff8c1a;">c3d</span></h3><br/>

<form id="formUploadc3d" method="POST" action="upload_c3d.php" enctype="multipart/form-data">
<input type="hidden" name="patient" value="<?php echo $nPatient;?>"/>
<input type="hidden" name="consultation" value="<?php echo $nConsultation?>"/>
<input type="hidden" name="envoyer" value=""/>

<label class="labelFile" for="inputFile"><h5>Ajouter des fichiers...</h5></label>
<input type="file" id="inputFile" style="display:none;" name="files[]" multiple="multiple" accept=".c3d" onchange="document.getElementById('nbFichiers').innerHTML='Nombre de fichiers : '+this.files.length;"/>
<h5 id="nbFichiers">Nombre de fichiers : 0</h5>
<br/>

<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formUploadc3d').submit()"><h4>Envoyer</h4></div>
</form>

