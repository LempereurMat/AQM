<?php
include "config.php";
include "function.php";
include "PHPExcel.php";

    if (!isset($_SESSION['username'])){
        exit();
    }

if (isset($_POST["id"]) && isset($_POST["consultation"]) && isset($_POST["utilisateur"]))
{ 
	$nPatient = $_POST["id"];
	$nConsultation = $_POST["consultation"];
    $nUser = $_POST["utilisateur"];
    $SQL = "SELECT hopital_ID FROM patients WHERE ID_Patient='".$nPatient."';";
    $req = $db->query($SQL);
    $row = $req->fetch();
    $nHopital = $row['hopital_ID'];
}
else exit();

if (isset($_POST["envoyer"]) && ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)))
{
    if (end(explode('.', $_FILES['file']['name'])) != "xlsx") {
        message("Fichier invalide","red");
    }
    else {
    $dossier = 'temp_files/';
    $fichier = basename($_FILES['file']['name']);
    if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier.$fichier))
    {
        //Initialisation PHPExcelReader
        $objet = PHPExcel_IOFactory::createReader('Excel2007');
        //On ouvre le fichier
        $excel = $objet->load($dossier.$fichier);
        //On prend la feuille 3
        $sheet = $excel->getSheet(4);
        //On commence à prendre toutes les infos
        //Si une case est associée à une chaîne -> nom de la propriété dans la base
        $list = array('F3' => 'Classe_FAC',
                      'F13' => 'Niveau_Palisano',
                      'F22' => 'Perimetre_marche',
                      'F23' => 'Aides_Techniques',
                      'L3' => 'Eval_fonc_gillette',
                      'L15' => 'Echelle_mobilite_fonc_5m',
                      'L16' => 'Echelle_mobilite_fonc_50m',
                      'L17' => 'Echelle_mobilite_fonc_500m'
                      );
        
        $SQL = "UPDATE bilan_fonctionnel SET ";
        foreach ($list as $cell => $attribut)
        {
            $val = $sheet->getCell($cell)->getValue();
            if ($val != "")
                $SQL = $SQL.$attribut."='".$val."',";
        }
        //On enlève la dernière virgule
        $SQL = substr($SQL, 0, -1);
        //On ajoute le WHERE
        $SQL = $SQL." WHERE Consultation_ID=".$nConsultation.";";
        $db->query($SQL);
        unlink($dossier.$fichier);
    }
    else
    {
        message("Erreur lors du traitement du fichier","red");
    }
        message("Fichier importé","green");
    }
    echo '<form id="formFunctionnalPatient" method="post" action="patient.php">'
    .'<input type="hidden" name="id" value="'.$nPatient.'"/>'
    .'</form>'
    .'<script>'
    .'document.getElementById("formFunctionnalPatient").submit();'
    .'</script>';
    exit();
}
    

$SQL = "SELECT * FROM bilan_fonctionnel WHERE bilan_fonctionnel.Consultation_ID=".$nConsultation.";";
$req = $db->query($SQL);
$aBilan_Functionnal[0] = $req->fetch();
if (!$aBilan_Functionnal[0]) {
    $SQL = "INSERT INTO bilan_fonctionnel (Consultation_Utilisateur_ID,Consultation_ID) VALUES ('".$nUser."','".$nConsultation."')";
    $db->exec($SQL);
    $SQL = "SELECT * FROM bilan_fonctionnel WHERE bilan_fonctionnel.Consultation_ID='".$nConsultation."'";
    $req = $db->query($SQL);
    $aBilan_Functionnal[0] = $req->fetch();
}
	

?>
<style>

    .functionnalText {
        height:30px;
        width:100%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border-color:rgba(0,0,0,0);
        border:none;
    }

    .functionnalText:focus {
        outline:none;
        box-shadow:none;
        border:none;
        background-color:rgba(255,255,255,0.3);
    }

    .labelFile {
        transition:color 0.5s ease, border 0.5s ease;
        cursor:pointer;
        color:white;
        width:300px;
        border-radius:10px;
        height:30px;
        padding-top:3px;
        left:0px;
        right:0px;
        margin:auto;
        background-color:rgba(0,0,0,0.3);
        border: 2px solid rgba(255,255,255,0);
    }

    .labelFile:hover {
        border: 2px solid rgba(255,255,255,0.6);
    }

</style>


        <div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

        <div id="modifierBilanClinique">
        <h3 style="color:#ff8c1a;">Bilan Fonctionnel</h3><br/>

        <?php
            if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)) {
            ?>

        <form id="formFunctionnalFile" method="post" action="functionnal_data.php" enctype="multipart/form-data">
            <input type="hidden" name="envoyer" value=""/>
            <input type="hidden" name="id" value="<?php echo $nPatient; ?>"/>
            <input type="hidden" name="consultation" value="<?php echo $nConsultation; ?>"/>
            <input type="hidden" name="utilisateur" value="<?php echo $nUser; ?>">
            <label class="labelFile" for="inputFile">Importer directement le fichier</label>
            <input type="file" id="inputFile" style="display:none;" name="file" onchange="document.getElementById('formFunctionnalFile').submit();"/>
        </form>

        <br/><br/><h5>ou entrer manuellement les données :</h5>

		<form id="formFunctionnalData" method="post" action="post_patient.php">
        <input type="hidden" name="id" value="<?php echo $nPatient; ?>">
		<input type="hidden" class="form-control" value="<?php echo $nConsultation; ?>" name="p_EditBilanFonctionnel" />

        <?php } ?>

        <div id="functionnalMenu">
                <table style="width:40%;margin-top:20px;">
                    <tr><th>Classe FAC</th><td><input class="functionnalText" type="text" name="p_Classe_FAC" value='<?php echo $aBilan_Functionnal[0]["Classe_FAC"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>

                    <tr><th>Palisano</th><td><input class="functionnalText" type="text" name="p_Niveau_Palisano" value='<?php echo $aBilan_Functionnal[0]["Niveau_Palisano"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>

                    <tr><th>Périmètre de marche</th><td><input class="functionnalText" type="text" name="p_Perimetre_marche" value='<?php echo $aBilan_Functionnal[0]["Perimetre_marche"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>

                    <tr><th>Aides techniques</th><td><input class="functionnalText" type="text" name="p_Aides_Techniques" value='<?php echo $aBilan_Functionnal[0]["Aides_Techniques"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>

                    <tr><th>Evaluation de Gillette</th><td><input class="functionnalText" type="text" name="p_Eval_fonc_gillette" value='<?php echo $aBilan_Functionnal[0]["Eval_fonc_gillette"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>

                    <tr><th>Echelle de mobilité sur 5m</th><td><input class="functionnalText" type="text" name="p_Echelle_mobilite_fonc_5m" value='<?php echo $aBilan_Functionnal[0]["Echelle_mobilite_fonc_5m"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>

                    <tr><th>Echelle de mobilité sur 50m</th><td><input class="functionnalText" type="text" name="p_Echelle_mobilite_fonc_50m" value='<?php echo $aBilan_Functionnal[0]["Echelle_mobilite_fonc_50m"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>

                    <tr><th>Echelle de mobilité sur 500m</th><td><input class="functionnalText" type="text" name="p_Echelle_mobilite_fonc_500m" value='<?php echo $aBilan_Functionnal[0]["Echelle_mobilite_fonc_500m"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>></td></tr>
                </table>
			
        <br/><br/>

        <?php if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)) {
            ?>

        <div class="buttonClassic" style="border-radius:15px;width:150px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formFunctionnalData').submit();"><h4>Valider</h4></div>

        </form>

        <?php } ?>

    </div>

