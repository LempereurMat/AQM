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
        message("Fichier invalide", "red");
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
        $sheet = $excel->getSheet(3);
        //On commence à prendre toutes les infos
        //Si une case est associée à une chaîne -> nom de la propriété dans la base
        //Si une case est associée à un tableau de chaîne -> case séparée par | ou /
        $list = array('B9' => 'Flexion_Hanche_G',
                      'C9' => 'Flexion_Hanche_D',
                      'B10' => 'Extension_Genou_0_G',
                      'C10' => 'Extension_Genou_0_D',
                      'B11' => 'Extension_Genou_90_G',
                      'C11' => 'Extension_Genou_90_D',
                      'B12' => 'Abduction_FH_FG_G',
                      'C12' => 'Abduction_FH_FG_D',
                      'B13' => 'Abduction_EH_EG_G',
                      'C13' => 'Abduction_EH_EG_D',
                      'B14' => 'Adduction_Hanche_G',
                      'C14' => 'Adduction_Hanche_D',
                      'B15' => ['Rot_Int_Hanche_G', 'Rot_Ext_Hanche_G'],
                      'C15' => ['Rot_Int_Hanche_D', 'Rot_Ext_Hanche_D'],
                      'B17' => 'Flexion_Genou_G',
                      'C17' => 'Flexion_Genou_D',
                      'B18' => ['Angle_Poplite_G1','Angle_Poplite_G2'],
                      'C18' => ['Angle_Poplite_D1','Angle_Poplite_D2'],
                      'B19' => 'Extension_Genou_G',
                      'C19' => 'Extension_Genou_D',
					  'B20' => 'Angle_Mort_Genou_G',
					  'C20' => 'Angle_Mort_Genou_D',
                      'B22' => 'Flexion_Cheville_EG_G',
                      'C22' => 'Flexion_Cheville_EG_D',
                      'B23' => 'Flexion_Cheville_FG_G',
                      'C23' => 'Flexion_Cheville_FG_D',
                      'B24' => 'Adductus_Abductus_Avant_Pied_G',
                      'C24' => 'Adductus_Abductus_Avant_Pied_D',
                      'B25' => 'Valgus_Varus_Calcaneum_G',
                      'C25' => 'Valgus_Varus_Calcaneum_D',
					  'B26' => 'Valgus_Varus_Calcaneum_Charge_G',
                      'C26' => 'Valgus_Varus_Calcaneum_Charge_D',
                      'B29' => 'ILMI',
                      'B30' => 'Anteversion_G',
                      'C30' => 'Anteversion_D',
                      'B31' => 'Axe_Bimalleolaire_G',
                      'C31' => 'Axe_Bimalleolaire_D',
                      'B32' => 'Rotule_Haute_G',
                      'C32' => 'Rotule_Haute_D',
                      'B33' => 'Dislocation_Medio_Tarsienne_G',
                      'C33' => 'Dislocation_Medio_Tarsienne_D',
                      'B34' => 'Gibbosite',
                      'B35' => 'ElyTest_G',
                      'C35' => 'ElyTest_D',
                      'B36' => 'Axe_Cuisse_Pied_G',
                      'C36' => 'Axe_Cuisse_Pied_D',
                      'A40' => 'Deroulement_Examen',
                      'E9' => 'Force_Psoas_G',
                      'G9' => 'Force_Psoas_D',
                      'E10' => 'Force_Grand_Fessier_G',
                      'G10' => 'Force_Grand_Fessier_D',
                      'E12' => 'Force_Moyen_Fessier_G',
                      'G12' => 'Force_Moyen_Fessier_D',
                      'E14' => 'Force_Adducteur_G',
                      'G14' => 'Force_Adducteur_D',
                      'E17' => 'Force_Ischio_Jambier_G',
                      'G17' => 'Force_Ischio_Jambier_D',
                      'E19' => 'Force_Quadriceps_G',
                      'G19' => 'Force_Quadriceps_D',
                      'E21' => 'Force_Tibialis_Anterior_G',
                      'G21' => 'Force_Tibialis_Anterior_D',
                      'E22' => 'Force_Gastroc_G',
                      'G22' => 'Force_Gastroc_D',
                      'E23' => 'Force_Peroneus_G',
                      'G23' => 'Force_Peroneus_D',
                      'E24' => 'Force_Tibialis_Posterior_G',
                      'G24' => 'Force_Tibialis_Posterior_D',
                      'E25' => 'Boyd_G',
                      'G25' => 'Boyd_D',
                      'J14' => 'Ashworth_Adducteur_G',
                      'L14' => 'Ashworth_Adducteur_D',
                      'J17' => 'Ashworth_Ischio_Jambier_G',
                      'L17' => 'Ashworth_Ischio_Jambier_D',
                      'J19' => 'Ashworth_Quadriceps_G',
                      'L19' => 'Ashworth_Quadriceps_D',
                      'K19' => 'Tardieu_Quadriceps_G',
                      'M19' => 'Tardieu_Quadriceps_D',
                      'J21' => 'Ashworth_Tibialis_Anterior_G',
                      'L21' => 'Ashworth_Tibialis_Anterior_D',
                      'J22' => 'Ashworth_Gastroc_G',
                      'L22' => 'Ashworth_Gastroc_D',
                      'K22' => ['Tardieu_Gastroc_G1', 'Tardieu_Gastroc_G2'],
                      'M22' => ['Tardieu_Gastroc_D1', 'Tardieu_Gastroc_D2'],
                      'J23' => 'Ashworth_Peroneus_G',
                      'L23' => 'Ashworth_Peroneus_D',
                      'K23' => ['Tardieu_Peroneus_G1','Tardieu_Peroneus_G2'],
                      'M23' => ['Tardieu_Peroneus_D1','Tardieu_Peroneus_D2'],
                      'J24' => 'Ashworth_Tibialis_Posterior_G',
                      'L24' => 'Ashworth_Tibialis_Posterior_D',
                      'K24' => ['Tardieu_Tibialis_Posterior_G1','Tardieu_Tibialis_Posterior_G2'],
                      'M24' => ['Tardieu_Tibialis_Posterior_D1','Tardieu_Tibialis_Posterior_D2']
                      );
        
        $SQL = "UPDATE bilan_clinique SET ";
        foreach ($list as $cell => $attribut)
        {
            $val = $sheet->getCell($cell)->getValue();
            
			if (is_array($attribut))
            {
               	if (count($separeBarre = explode('|',$val))==2) {
					if (strlen($separeBarre[0])!=0)
                        $SQL = $SQL.$attribut[0]."='".$separeBarre[0]."',";
                    if (strlen($separeBarre[1])!=0)
                        $SQL = $SQL.$attribut[1]."='".$separeBarre[1]."',";
                }
                else if (count($separeSlash = explode('/',$val)) == 2){
                    if (strlen($separeSlash[0])!=0)
                        $SQL = $SQL.$attribut[0]."='".$separeSlash[0]."',";
                    if (strlen($separeSlash[1])!=0)
                        $SQL = $SQL.$attribut[1]."='".$separeSlash[1]."',";
                }
            }
            else
            {
                if (strlen($val) != 0)
                    $SQL = $SQL.$attribut."='".$val."',";
            }
        }
        //On enlève la dernière virgule
        $SQL = substr($SQL, 0, -1);
        //On ajoute le WHERE
        $SQL = $SQL." WHERE Consultation_ID=".$nConsultation.";";
        $db->query($SQL);
        unlink($dossier.$fichier);
        message("Fichier enregistré", "green");
    }
    else
    {
        message("Erreur lors du traitement du fichier","red");
    }
    }
    echo '<form id="formClinicalPatient" method="post" action="patient.php">'
    .'<input type="hidden" name="id" value="'.$nPatient.'"/>'
    .'</form>'
    .'<script>'
    .'document.getElementById("formClinicalPatient").submit();'
    .'</script>';
    exit();
}
    

$SQL = "SELECT * FROM bilan_clinique WHERE bilan_clinique.Consultation_ID=".$nConsultation.";";
$req = $db->query($SQL);
$aBilan_Clinique[0] = $req->fetch();
if (!$aBilan_Clinique[0]) {
    $SQL = "INSERT INTO bilan_clinique (Consultation_Utilisateur_ID,consultation_ID) VALUES ('".$nUser."','".$nConsultation."')";
    $db->exec($SQL);
    $SQL = "SELECT * FROM bilan_clinique WHERE bilan_clinique.Consultation_ID='".$nConsultation."'";
    $req = $db->query($SQL);
    $aBilan_Clinique[0] = $req->fetch();
}
	

?>
<style>
    .menuDiv {
        border:1px solid white;
        padding:10px;
        border-radius:14px;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        margin:8px;
        margin-bottom:20x;
        cursor:pointer;
    }

    .menuDiv:hover {
        background-color:rgba(255,255,255,0.2);
    }

    .clinicalText {
        height:30px;
        width:100%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border-color:rgba(0,0,0,0);
        border:none;
    }

    .clinicalText:focus {
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
        <h3 style="color:#ff8c1a;">Bilan Clinique</h3><br/>

        <?php
            if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)) {
                ?>
        <form id="formClinicalFile" method="post" action="clinical_data.php" enctype="multipart/form-data">
            <input type="hidden" name="envoyer" value="0"/>
            <input type="hidden" name="id" value="<?php echo $nPatient; ?>"/>
            <input type="hidden" name="consultation" value="<?php echo $nConsultation; ?>"/>
            <input type="hidden" name="utilisateur" value="<?php echo $nUser; ?>"/>
            <input type="file" id="inputFile" style="display:none;" name="file" onchange="document.getElementById('formClinicalFile').submit();"/>
            <label class="labelFile" for="inputFile">Importer directement le fichier</label>
        </form>

        <br/><br/><h5>ou entrer manuellement les données :</h5>

		<form id="formClinicalData" method="post" action="post_patient.php">
        <input type="hidden" name="id" value="<?php echo $nPatient; ?>">
		<input type="hidden" class="form-control" value="<?php echo $nConsultation; ?>" name="p_EditBilanClinique" />

        <?php } ?>

        <div style="width:100%;display:flex;justify-content:center;">
            <div class="menuDiv" onclick="document.getElementById('clinicalMenu1').style.display='inline';document.getElementById('clinicalMenu2').style.display='none';document.getElementById('clinicalMenu3').style.display='none';document.getElementById('clinicalMenu4').style.display='none';">Mobilit&eacute</div>
            <div class="menuDiv" onclick="document.getElementById('clinicalMenu1').style.display='none';document.getElementById('clinicalMenu2').style.display='inline';document.getElementById('clinicalMenu3').style.display='none';document.getElementById('clinicalMenu4').style.display='none';">Force</div>
            <div class="menuDiv" onclick="document.getElementById('clinicalMenu1').style.display='none';document.getElementById('clinicalMenu2').style.display='none';document.getElementById('clinicalMenu3').style.display='inline';document.getElementById('clinicalMenu4').style.display='none';">Spasticit&eacute</div>
            <div class="menuDiv" onclick="document.getElementById('clinicalMenu1').style.display='none';document.getElementById('clinicalMenu2').style.display='none';document.getElementById('clinicalMenu3').style.display='none';document.getElementById('clinicalMenu4').style.display='inline';">Anthropom&eacutetrie</div>
        </div>

		<div id="clinicalMenu1" style="display:inline;">
			<div style="width:100%;left:0px;right:0px;margin:auto;">
				<table style="width:95%;margin-top:20px;">
				<thead>
					<tr>
						<th>Hanche</th>
						<th colspan="2">Gauche</th>
						
						<th colspan="2">Droite</th>
						
					</tr>
				</thead>
				<tbody>
				<tr>
					<td>Flexion</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Flexion_Hanche_G"  value='<?php echo $aBilan_Clinique[0]["Flexion_Hanche_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Flexion_Hanche_D" value='<?php echo $aBilan_Clinique[0]["Flexion_Hanche_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
				</tr>
				<tr>
					<td >Ext. Genou &agrave 0&deg</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Extension_Genou_0_G" value='<?php echo $aBilan_Clinique[0]["Extension_Genou_0_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Extension_Genou_0_D" value='<?php echo $aBilan_Clinique[0]["Extension_Genou_0_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
				</tr>
				<tr>
					<td>Ext. Genou &agrave 90&deg</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Extension_Genou_90_G" value='<?php echo $aBilan_Clinique[0]["Extension_Genou_90_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Extension_Genou_90_D" value='<?php echo $aBilan_Clinique[0]["Extension_Genou_90_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
				</tr>
				<tr>
					<td>Abd. Flex-Hanche/Flex-Genou</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Abduction_FH_FG_G" value='<?php echo $aBilan_Clinique[0]["Abduction_FH_FG_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Abduction_FH_FG_D" value='<?php echo $aBilan_Clinique[0]["Abduction_FH_FG_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
				</tr>
				<tr>
					<td>Abd. Ext-Hanche/Ext-Genou</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Abduction_EH_EG_G" value='<?php echo $aBilan_Clinique[0]["Abduction_EH_EG_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Abduction_EH_EG_D" value='<?php echo $aBilan_Clinique[0]["Abduction_EH_EG_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
				</tr>
				<tr>
				<td>Add.</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Adduction_Hanche_G" value='<?php echo $aBilan_Clinique[0]["Adduction_Hanche_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					<td  colspan="2">
						
							<input class="clinicalText" type="text" name="p_Adduction_Hanche_D" value='<?php echo $aBilan_Clinique[0]["Adduction_Hanche_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					
				</tr>
				<tr>
					<td>Rot. Int-Ext</td>
					<td>
						
							<input class="clinicalText" type="text" name="p_Rot_Int_Hanche_G" value='<?php echo $aBilan_Clinique[0]["Rot_Int_Hanche_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					<td>
						
							<input class="clinicalText" type="text" name="p_Rot_Ext_Hanche_G" value='<?php echo $aBilan_Clinique[0]["Rot_Ext_Hanche_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					<td>
						
							<input class="clinicalText" type="text" name="p_Rot_Int_Hanche_D" value='<?php echo $aBilan_Clinique[0]["Rot_Int_Hanche_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
					<td>
						
							<input class="clinicalText" type="text" name="p_Rot_Ext_Hanche_D" value='<?php echo $aBilan_Clinique[0]["Rot_Ext_Hanche_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						
					</td>
				</tr>
				
				
			
					<tr>
						<th>Genou</th>
						<th colspan="2">Gauche</th>
						
						<th colspan="2">Droite</th>
						
					</tr>
				
				<tr>
					<td>Flexion</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Flexion_Genou_G" value='<?php echo $aBilan_Clinique[0]["Flexion_Genou_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Flexion_Genou_D" value='<?php echo $aBilan_Clinique[0]["Flexion_Genou_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Angle Poplit&eacute</td>
					<td>
						<input class="clinicalText" type="text" name="p_Angle_Poplite_G1" value='<?php echo $aBilan_Clinique[0]["Angle_Poplite_G1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Angle_Poplite_G2" value='<?php echo $aBilan_Clinique[0]["Angle_Poplite_G2"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Angle_Poplite_D1" value='<?php echo $aBilan_Clinique[0]["Angle_Poplite_D1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Angle_Poplite_D2" value='<?php echo $aBilan_Clinique[0]["Angle_Poplite_D2"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Ext.</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Extension_Genou_G" value='<?php echo $aBilan_Clinique[0]["Extension_Genou_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Extension_Genou_D" value='<?php echo $aBilan_Clinique[0]["Extension_Genou_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Angle mort</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Angle_Mort_G" value='<?php echo $aBilan_Clinique[0]["Angle_Mort_Genou_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Angle_Mort_D" value='<?php echo $aBilan_Clinique[0]["Angle_Mort_Genou_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<th>Cheville</th>
						<th colspan="2">Gauche</th>
						<th colspan="2">Droite</th>
				</tr>
				<tr>
					<td>Flex. Genou &agrave 0&deg </td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Flexion_Cheville_EG_G" value='<?php echo $aBilan_Clinique[0]["Flexion_Cheville_EG_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Flexion_Cheville_EG_D" value='<?php echo $aBilan_Clinique[0]["Flexion_Cheville_EG_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Flex. Genou &agrave 90&deg </td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Flexion_Cheville_FG_G" value='<?php echo $aBilan_Clinique[0]["Flexion_Cheville_FG_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Flexion_Cheville_FG_D" value='<?php echo $aBilan_Clinique[0]["Flexion_Cheville_FG_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					</tr>
					<tr>
						<td>Add.(+) / Abd. (-) Avant Pied </td>
						<td colspan="2">
							<input class="clinicalText" type="text" name="p_Adductus_Abductus_Avant_Pied_G" value='<?php echo $aBilan_Clinique[0]["Adductus_Abductus_Avant_Pied_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						</td>
						<td colspan="2">
							<input class="clinicalText" type="text" name="p_Adductus_Abductus_Avant_Pied_D" value='<?php echo $aBilan_Clinique[0]["Adductus_Abductus_Avant_Pied_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						</td>
					</tr>
					<tr>
						<td>Val.(-) / Var. (+) Calcan&eacuteum</td>
						<td colspan="2">
							<input class="clinicalText" type="text" name="p_Valgus_Varus_Calcaneum_G" value='<?php echo $aBilan_Clinique[0]["Valgus_Varus_Calcaneum_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						</td>
						<td colspan="2">
							<input class="clinicalText" type="text" name="p_Valgus_Varus_Calcaneum_D" value='<?php echo $aBilan_Clinique[0]["Valgus_Varus_Calcaneum_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						</td>
					</tr>
					<tr>
						<td>Val.(-) / Var. (+) Calcan&eacuteum Charge</td>
						<td colspan="2">
							<input class="clinicalText" type="text" name="p_Valgus_Varus_Calcaneum_Charge_G" value='<?php echo $aBilan_Clinique[0]["Valgus_Varus_Calcaneum_Charge_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						</td>
						<td colspan="2">
							<input class="clinicalText" type="text" name="p_Valgus_Varus_Calcaneum_Charge_D" value='<?php echo $aBilan_Clinique[0]["Valgus_Varus_Calcaneum_Charge_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
						</td>
					</tr>
		
				<tr>
					<th>Anomalies Osseuses</td>
					<th colspan="2">Gauche</th>
						
					<th colspan="2">Droite</th>
				</tr>
				<tr>
					<td>ILMI</td>
					<td colspan="4">
						<input class="clinicalText" type="text" name="p_ILMI" value='<?php echo $aBilan_Clinique[0]["ILMI"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Ant&eacutetorsion f&eacutemorale </td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Anteversion_G" value='<?php echo $aBilan_Clinique[0]["Anteversion_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Anteversion_D" value='<?php echo $aBilan_Clinique[0]["Anteversion_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Axe Bi-mall&eacuteolaire </td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Axe_Bimalleolaire_G" value='<?php echo $aBilan_Clinique[0]["Axe_Bimalleolaire_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Axe_Bimalleolaire_D" value='<?php echo $aBilan_Clinique[0]["Axe_Bimalleolaire_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Rotule haute</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Rotule_Haute_G" value='<?php echo $aBilan_Clinique[0]["Rotule_Haute_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Rotule_Haute_D" value='<?php echo $aBilan_Clinique[0]["Rotule_Haute_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Dislo. m&eacutedio-tars.</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Dislocation_Medio_Tarsienne_G" value='<?php echo $aBilan_Clinique[0]["Dislocation_Medio_Tarsienne_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Dislocation_Medio_Tarsienne_D" value='<?php echo $aBilan_Clinique[0]["Dislocation_Medio_Tarsienne_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Gibbosit&eacute </td>
					<td colspan="4">
						<input class="clinicalText" type="text" name="p_Gibbosite" value='<?php echo $aBilan_Clinique[0]["Gibbosite"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				<tr>
				<tr>
					<td>Ely test</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_ElyTest_G" value='<?php echo $aBilan_Clinique[0]["ElyTest_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_ElyTest_D" value='<?php echo $aBilan_Clinique[0]["ElyTest_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Axe Cuisse Pied (Add(+) / Abd(-))</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Axe_Cuisse_Pied_G" value='<?php echo $aBilan_Clinique[0]["Axe_Cuisse_Pied_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Axe_Cuisse_Pied_D" value='<?php echo $aBilan_Clinique[0]["Axe_Cuisse_Pied_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>D&eacuteroulement Examen</td>
					<td colspan="4">
						<input class="clinicalText" type="text" name="p_Deroulement_Examen" value='<?php echo $aBilan_Clinique[0]["Deroulement_Examen"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				</tbody>
				</table>
		
		
			</div>
		</div>
		<div id="clinicalMenu2" style="display:none;">
			<table style="width:95%;margin-top:20px;">
				<thead>
					<tr>
						<th>Hanche</th>
						<th>Gauche</th>
						
						<th>Droite</th>
						
					</tr>
				</thead>
				<tbody>

			<tr>
				<td>Ilio-psoas</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Psoas_G" value='<?php echo $aBilan_Clinique[0]["Force_Psoas_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>	
					<input class="clinicalText" type="text" name="p_Force_Psoas_D" value='<?php echo $aBilan_Clinique[0]["Force_Psoas_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Grand Fessier</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Grand_Fessier_G" value='<?php echo $aBilan_Clinique[0]["Force_Grand_Fessier_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Grand_Fessier_D" value='<?php echo $aBilan_Clinique[0]["Force_Grand_Fessier_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Moyen Fessier</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Moyen_Fessier_G" value='<?php echo $aBilan_Clinique[0]["Force_Moyen_Fessier_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Moyen_Fessier_D" value='<?php echo $aBilan_Clinique[0]["Force_Moyen_Fessier_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Add.</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Adducteur_G" value='<?php echo $aBilan_Clinique[0]["Force_Adducteur_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Adducteur_D" value='<?php echo $aBilan_Clinique[0]["Force_Adducteur_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<th>Genou</th>
				<th>Gauche</th>
						
				<th>Droite</th>
			</tr>
			<tr>
				<td>Ischio-jambier</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Ischio_Jambier_G" value='<?php echo $aBilan_Clinique[0]["Force_Ischio_Jambier_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Ischio_Jambier_D" value='<?php echo $aBilan_Clinique[0]["Force_Ischio_Jambier_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Quadriceps</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Quadriceps_G" value='<?php echo $aBilan_Clinique[0]["Force_Quadriceps_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Quadriceps_D" value='<?php echo $aBilan_Clinique[0]["Force_Quadriceps_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<th>Cheville</th>
				<th>Gauche</th>
						
				<th>Droite</th>
			</tr>
			<tr>
				<td>Tibialis Anterior</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Tibialis_Anterior_G" value='<?php echo $aBilan_Clinique[0]["Force_Tibialis_Anterior_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Tibialis_Anterior_D" value='<?php echo $aBilan_Clinique[0]["Force_Tibialis_Anterior_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Gastrocnemius</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Gastroc_G" value='<?php echo $aBilan_Clinique[0]["Force_Gastroc_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Gastroc_D" value='<?php echo $aBilan_Clinique[0]["Force_Gastroc_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Peroneus</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Peroneus_G" value='<?php echo $aBilan_Clinique[0]["Force_Peroneus_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Peroneus_D" value='<?php echo $aBilan_Clinique[0]["Force_Peroneus_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Tibialis Posterior</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Tibialis_Posterior_G" value='<?php echo $aBilan_Clinique[0]["Force_Tibialis_Posterior_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Force_Tibialis_Posterior_D" value='<?php echo $aBilan_Clinique[0]["Force_Tibialis_Posterior_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Boyd</td>
				<td>
					<input class="clinicalText" type="text" name="p_Boyd_G" value='<?php echo $aBilan_Clinique[0]["Boyd_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>
					<input class="clinicalText" type="text" name="p_Boyd_D" value='<?php echo $aBilan_Clinique[0]["Boyd_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>



				</tbody>
			</table>
		</div>
        <div id="clinicalMenu3" style="display:none;">
		  
		 
			<table style="width:95%;margin-top:20px;">
			<thead>
				<tr>
				<td></td>
				<th>Ashworth</th>
				<th>Tardieu</th>
				<th>Ashworth</th>
				<th>Tardieu</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Hanche</th>
					<th colspan="2">Gauche</th>
					
					<th colspan="2">Droite</th>
						
				</tr>
				
				<tr>
					<td>Add.</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Ashworth_Adducteur_G" value='<?php echo $aBilan_Clinique[0]["Ashworth_Adducteur_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Ashworth_Adducteur_D" value='<?php echo $aBilan_Clinique[0]["Ashworth_Adducteur_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<th>Genou</th>
					<th colspan="2">Gauche</th>
					<th colspan="2">Droite</th>
				</tr>
				<tr>
					<td>Ischio-Jambiers</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Ashworth_Ischio_Jambier_G" value='<?php echo $aBilan_Clinique[0]["Ashworth_Ischio_Jambier_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Ashworth_Ischio_Jambier_D" value='<?php echo $aBilan_Clinique[0]["Ashworth_Ischio_Jambier_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Ext.</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Quadriceps_G" value='<?php echo $aBilan_Clinique[0]["Ashworth_Quadriceps_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Tardieu_Quadriceps_G" value='<?php echo $aBilan_Clinique[0]["Tardieu_Quadriceps_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Quadriceps_D" value='<?php echo $aBilan_Clinique[0]["Ashworth_Quadriceps_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Tardieu_Quadriceps_D" value='<?php echo $aBilan_Clinique[0]["Tardieu_Quadriceps_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<th>Cheville</th>
					<th colspan="2">Gauche</th>
					<th colspan="2">Droite</th>
				</tr>
				<tr>
					<td>Tib. Ante.</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Ashworth_Tibialis_Anterior_G" value='<?php echo $aBilan_Clinique[0]["Ashworth_Tibialis_Anterior_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td colspan="2">
						<input class="clinicalText" type="text" name="p_Ashworth_Tibialis_Anterior_D" value='<?php echo $aBilan_Clinique[0]["Ashworth_Tibialis_Anterior_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				</tr>
				<tr>	
					<td>Gastroc.</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Gastroc_G" value='<?php echo $aBilan_Clinique[0]["Ashworth_Gastroc_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Tardieu_Gastroc_G1" value='<?php echo $aBilan_Clinique[0]["Tardieu_Gastroc_G1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Gastroc_D" value='<?php echo $aBilan_Clinique[0]["Ashworth_Gastroc_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Tardieu_Gastroc_D1" value='<?php echo $aBilan_Clinique[0]["Tardieu_Gastroc_D1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Peroneus</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Peroneus_G" value='<?php echo $aBilan_Clinique[0]["Ashworth_Peroneus_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Tardieu_Peroneus_G1" value='<?php echo $aBilan_Clinique[0]["Tardieu_Peroneus_G1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Peroneus_D" value='<?php echo $aBilan_Clinique[0]["Ashworth_Peroneus_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text"name="p_Tardieu_Peroneus_D1" value='<?php echo $aBilan_Clinique[0]["Tardieu_Peroneus_D1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
				<tr>
					<td>Tib. Post.</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Tibialis_Posterior_G" value='<?php echo $aBilan_Clinique[0]["Ashworth_Tibialis_Posterior_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Tardieu_Tibialis_Posterior_G1" value='<?php echo $aBilan_Clinique[0]["Tardieu_Tibialis_Posterior_G1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Ashworth_Tibialis_Posterior_D" value='<?php echo $aBilan_Clinique[0]["Ashworth_Tibialis_Posterior_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
					<td>
						<input class="clinicalText" type="text" name="p_Tardieu_Tibialis_Posterior_D1" value='<?php echo $aBilan_Clinique[0]["Tardieu_Tibialis_Posterior_D1"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
					</td>
				</tr>
			
			</tbody>
			</table>
        </div>
        <div id="clinicalMenu4" style="display:none;">
                <table style="width:40%;margin-top:20px;">
                    <tr><th>Taille</th><td><input class="clinicalText" type="text" name="p_Taille" value='<?php echo $aBilan_Clinique[0]["Taille"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/></td></tr>
                    <tr><th>Masse</th><td><input class="clinicalText" type="text" name="p_Masse" value='<?php echo $aBilan_Clinique[0]["Masse"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/></td></tr>
                </table>
			
			<table style="width:95%;margin-top:20px;">
				<thead>
					<tr>
						<th></th>
						<th>Gauche</th>
						
						<th>Droite</th>
						
					</tr>
				</thead>
				<tbody>

			<tr>
				<td>Longueur Jambe</td>
				<td>
					<input class="clinicalText" type="text" name="p_Long_Jambe_G" value='<?php echo $aBilan_Clinique[0]["Long_Jambe_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>	
					<input class="clinicalText" type="text" name="p_Long_Jambe_D" value='<?php echo $aBilan_Clinique[0]["Long_Jambe_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Largeur Genou</td>
				<td>
					<input class="clinicalText" type="text" name="p_Larg_Genou_G" value='<?php echo $aBilan_Clinique[0]["Larg_Genou_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>	
					<input class="clinicalText" type="text" name="p_Larg_Genou_D" value='<?php echo $aBilan_Clinique[0]["Larg_Genou_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			<tr>
				<td>Largeur Cheville</td>
				<td>
					<input class="clinicalText" type="text" name="p_Larg_Cheville_G" value='<?php echo $aBilan_Clinique[0]["Larg_Cheville_G"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
				<td>	
					<input class="clinicalText" type="text" name="p_Larg_Cheville_D" value='<?php echo $aBilan_Clinique[0]["Larg_Cheville_D"]; ?>' <?php if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital))) echo 'disabled' ?>/>
				</td>
			</tr>
			</table>
		</div>

        <br/><br/>

        <?php if ($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)) { ?>

        <div class="buttonClassic" style="border-radius:15px;width:150px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formClinicalData').submit();"><h4>Valider</h4></div>

        </form>

        <?php } ?>

        </div>

