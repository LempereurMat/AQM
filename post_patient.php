<?php
include "config.php";
include "function.php";
    
if(!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}
else if ($_SESSION["type"] != 'Administrator' && $_SESSION["type"]!='Manager') {
    header('location: index.php');
    exit();
}


if(isset($_POST["id"])) {
	$sID = $_POST["id"];
}
else exit();
    
if(isset($_POST["p_EditBilanClinique"])) {
    $SQL = "DESCRIBE bilan_clinique;";
    $req = $db->query($SQL);
    //On récupére tous les attributs
    $SQL = "UPDATE bilan_clinique SET ";
    $attributsSET = "";
    while ($row = $req->fetch()) {
        if ($row["Field"]!="ID" && $row["Field"]!="Consultation_Utilisateur_ID" && $row["Field"]!="Consultation_ID") {
            if (isset($_POST["p_".$row["Field"]]) && $_POST["p_".$row["Field"]]!="") {
                $attributsSET = $attributsSET. $row["Field"]."='".$_POST["p_".$row["Field"]]."',";
            }
        }
    }
    
    if ($attributsSET != "") {
        $SQL = $SQL.$attributsSET;
        //On supprime la dernière virgule
        $SQL = substr($SQL, 0, -1);
        //On ajoute WHERE
        $SQL = $SQL." WHERE Consultation_ID ='".$_POST["p_EditBilanClinique"]."';";
        $db->query($SQL);
        message("Bilan clinique enregistré", "green");
    }
    else
        message("Aucune modification enregistrée", "green");
}
else if (isset($_POST["p_EditBilanFonctionnel"])) {
    $SQL = "UPDATE bilan_fonctionnel SET "
    ."Classe_FAC='".$_POST["p_Classe_FAC"]."',"
    ."Niveau_Palisano='".$_POST["p_Niveau_Palisano"]."',"
    ."Perimetre_marche='".$_POST["p_Perimetre_marche"]."',"
    ."Aides_Techniques='".$_POST["p_Aides_Techniques"]."',"
    ."Eval_fonc_gillette='".$_POST["p_Eval_fonc_gillette"]."',"
    ."Echelle_mobilite_fonc_5m='".$_POST["p_Echelle_mobilite_fonc_5m"]."',"
    ."Echelle_mobilite_fonc_50m='".$_POST["p_Echelle_mobilite_fonc_50m"]."',"
    ."Echelle_mobilite_fonc_500m='".$_POST["p_Echelle_mobilite_fonc_500m"]."'"
    ." WHERE Consultation_ID ='".$_POST["p_EditBilanFonctionnel"]."';";
    $db->query($SQL);
    message("Bilan fonctionnel enregistré", "green");
}

else if(isset($_POST["p_EditReport"])) {
	$SQL = "UPDATE consultation SET CompteRendu = \" ".$_POST["report"]." \" WHERE ID = '".$_POST["p_EditReport"]."';";
	$db->query($SQL);
    message("Compte-rendu enregistré", "green");
}

else if(isset($_POST["p_EditAQM"])) {
    $new_date = date('Y-m-d');
    if ($_POST["date"]!="") {
        $date = DateTime::createFromFormat('d/m/Y',$_POST["date"]);
        $new_date = $date->format('Y-m-d');
    }
	
    $hopital = $_POST["hopital"];
    if ($_SESSION['type']=="Manager")
        $hopital = $_SESSION['id_hopital'];
    
	$SQL = "UPDATE consultation SET Utilisateur_ID='".$_POST["medecin"]."'"
        .",Hopital_ID='".$hopital."'"
        .",Date_Consultation='".$new_date."'"
        .",Date_validation='".$new_date."'"
        .",consultation.Condition='".$_POST["condition"]."'"
        .",Appareillage='".$_POST["appareillage"]."'"
        ." WHERE ID='".$_POST["p_EditAQM"]."';";

	$db->query($SQL);
    message("AQM enregistrée", "green");
}

else if(isset($_POST["p_RemoveAQM"])) {
	
	$SQL = "DELETE FROM consultation WHERE ID='".$_POST["p_RemoveAQM"]."';";
	$db->query($SQL);
	
	$SQL = "DELETE FROM bilan_clinique WHERE Consultation_ID='".$_POST["p_RemoveAQM"]."';";
	$db->query($SQL);
	
	$SQL = "DELETE FROM bilan_fonctionnel WHERE Consultation_ID='".$_POST["p_RemoveAQM"]."';";
	$db->query($SQL);
    
    message("AQM supprimée", "green");
}

else if(isset($_POST["p_EditTraitement"])) {
    $new_date = date('Y-m-d');
    if ($_POST["date"]!="") {
        $date = DateTime::createFromFormat('d/m/Y',$_POST["date"]);
        $new_date = $date->format('Y-m-d');
    }
	
    $hopital = $_POST["hopital"];
    if ($_SESSION['type']=="Manager")
        $hopital = $_SESSION['id_hopital'];
    
	$SQL = "UPDATE traitement SET Operateur_ID='".$_POST["medecin"]."',"
    ."hopital_ID='".$hopital."',"
    ."Date='".$new_date."',"
    ."TypeTraitement_ID='".$_POST["traitement"]."',"
    ."SousTypeTraitement_ID='".$_POST["typetraitement"]."',"
    ."Localisation_ID='".$_POST["localisation"]."',"
    ."Cote_ID='".$_POST["cote"]."',"
    ."Quantite='".$_POST["quantite"]."',"
    ."Technique='".$_POST["technique"]."'"
    ." WHERE ID_Traitement='".$_POST["p_EditTraitement"]."';";
	
	$db->exec($SQL);
    message("Traitement enregistré", "green");
}

else if(isset($_POST["p_CopyTraitement"])) {
	$SQL = "SELECT * FROM Traitement WHERE ID_Traitement='".$_POST["p_CopyTraitement"]."';";
	$REQ = $db->query($SQL);
	while($DATA = $REQ->fetch()) $aTraitement[] = $DATA;
	
	$SQL = "INSERT INTO traitement (Patients_ID, TypeTraitement_ID, SousTypeTraitement_ID, Localisation_ID, Cote_ID, Quantite, Technique, Date, Operateur_ID, hopital_ID) VALUES ('".$aTraitement[0]["Patients_ID"]."','".$aTraitement[0]["TypeTraitement_ID"]."','".$aTraitement[0]["SousTypeTraitement_ID"]."','".$aTraitement[0]["Localisation_ID"]."','".$aTraitement[0]["Cote_ID"]."','".$aTraitement[0]["Quantite"]."','".$aTraitement[0]["Technique"]."','".$aTraitement[0]["Date"]."','".$aTraitement[0]["Operateur_ID"]."','".$aTraitement[0]["hopital_ID"]."');";
	$db->query($SQL);
    message("Traitement copié", "green");
}
else if(isset($_POST["p_RemoveTraitement"])) {
    $SQL = "DELETE FROM Traitement WHERE ID_Traitement='".$_POST["p_RemoveTraitement"]."';";
    $db->query($SQL);
    message("Traitement supprimé", "green");
}

else if(isset($_POST["p_EditEOS"])) {
    $new_date = date('Y-m-d');
    if ($_POST["date"]!="") {
        $date = DateTime::createFromFormat('d/m/Y',$_POST["date"]);
        $new_date = $date->format('Y-m-d');
    }
    
    $SQL = "DESCRIBE eos;";
    $req = $db->query($SQL);
    
    $hopital = $_POST["hopital"];
    if ($_SESSION['type']=="Manager")
        $hopital = $_SESSION['id_hopital'];
    
	$SQL = "UPDATE eos SET id_hopital='".$hopital.",Date='".$new_date."',";
    $attributsSET = "";
    while ($row = $req->fetch()) {
        if ($row["Field"]!="ID_EOS" && $row["Field"]!="Patient_ID" && $row["Field"]!="Date" && $row["Field"]!="id_hopital") {
            if (isset($_POST["p_".$row["Field"]]) && $_POST["p_".$row["Field"]]!="") {
                $attributsSET = $attributsSET. $row["Field"]."='".$_POST["p_".$row["Field"]]."',";
            }
        }
    }
    if ($attributsSET != "") {
        $SQL = $SQL.$attributsSET;
        //On supprime la dernière virgule
        $SQL = substr($SQL, 0, -1);
        //On ajoute WHERE
        $SQL = $SQL." WHERE ID_EOS ='".$_POST["p_EditEOS"]."';";
        $db->query($SQL);
        message("EOS enregistrée", "green");
    }
    else
        message("Aucune modification enregistrée", "green");
}
else if (isset($_POST["p_RemoveEOS"])) {
    $SQL = "DELETE FROM eos WHERE ID_EOS='".$_POST["p_RemoveEOS"]."';";
    $db->query($SQL);
    message("EOS supprimée", "green");
}

else if(isset($_POST["p_AddEOS"])) {
    $new_date = date('Y-m-d');
    if ($_POST["date"]!="") {
        $date = DateTime::createFromFormat('d/m/Y',$_POST["date"]);
        $new_date = $date->format('Y-m-d');
    }
	
    $hopital = $_POST["hopital"];
    if ($_SESSION['type']=="Manager")
        $hopital = $_SESSION['id_hopital'];
    
	$SQL = "INSERT INTO  `eos` (`Patient_ID`,`Date`,`Long_Femur_D`,`Long_Femur_G`,`Long_Tibia_D`,`Long_Tibia_G`,`Long_Fonct_D`,`Long_Fonct_G`,`Long_Anat_D`,`Long_Anat_G`,`Diam_TF_D`,`Diam_TF_G`,`Offset_Femur_D`,`Offset_Femur_G`,`Long_Col_Fem_D`,`Long_Col_Fem_G`,`Neck_Shaft_Angle_D`,`Neck_Shaft_Angle_G`,`Knee_Varus_D`,`Knee_Varus_G`,`Knee_Flessum_D`,`Knee_Flessum_G`,`Angle_Fem_Meca_D`,`Angle_Fem_Meca_G`,`Angle_Tib_Meca_D`,`Angle_Tib_Meca_G`,`HKS_D`,`HKS_G`,`Torsion_Fem_D`,`Torsion_Fem_G`,`Torsion_Tib_D`,`Torsion_Tib_G`,`Rot_Fem_Tib_D`,`Rot_Fem_Tib_G`,`id_hopital`)"
        ."VALUES ('".$sID."', '".$new_date."' ,'".$_POST["p_Long_Femur_D"]."', '".$_POST["p_Long_Femur_G"]."', '".$_POST["p_Long_Tibia_D"]."', '".$_POST["p_Long_Tibia_G"]."', '".$_POST["p_Long_Fonct_D"]."','".$_POST["p_Long_Fonct_G"]."', '".$_POST["p_Long_Anat_D"]."', '".$_POST["p_Long_Anat_G"]."', '".$_POST["p_Diam_TF_D"]."', '".$_POST["p_Diam_TF_G"]."', '".$_POST["p_Offset_Femur_D"]."','".$_POST["p_Offset_Femur_G"]."', '".$_POST["p_Long_Col_Fem_D"]."', '".$_POST["p_Long_Col_Fem_G"]."', '".$_POST["p_Neck_Shaft_Angle_D"]."', '".$_POST["p_Neck_Shaft_Angle_G"]."','".$_POST["p_Knee_Varus_D"]."', '".$_POST["p_Knee_Varus_G"]."', '".$_POST["p_Knee_Flessum_D"]."', '".$_POST["p_Knee_Flessum_G"]."', '".$_POST["p_Angle_Fem_Meca_D"]."','".$_POST["p_Angle_Fem_Meca_G"]."', '".$_POST["p_Angle_Tib_Meca_D"]."', '".$_POST["p_Angle_Tib_Meca_G"]."', '".$_POST["p_HKS_D"]."', '".$_POST["p_HKS_G"]."', '".$_POST["p_Torsion_Fem_D"]."','".$_POST["p_Torsion_Fem_G"]."', '".$_POST["p_Torsion_Tib_D"]."', '".$_POST["p_Torsion_Tib_G"]."', '".$_POST["p_Rot_Fem_Tib_D"]."', '".$_POST["p_Rot_Fem_Tib_G"]."', '".$hopital."');";
							
	$db->exec($SQL);
    message("EOS enregistrée", "green");
}

else if(isset($_POST["p_AddAQM"])) {
    $new_date = date('Y-m-d');
    if ($_POST["date"]!="") {
        $date = DateTime::createFromFormat('d/m/Y',$_POST["date"]);
        $new_date = $date->format('Y-m-d');
    }
	
    $hopital = $_POST["hopital"];
    if ($_SESSION['type']=="Manager")
        $hopital = $_SESSION['id_hopital'];
    
	$SQL = "INSERT INTO  `consultation` (
	`Utilisateur_ID` ,
	`Hopital_ID`,
	`patients_ID_patient` ,
	`Date_consultation` ,
	`Valide` ,
	`Date_validation`,
	`Condition`,
	`Appareillage`,
	`LCycleNumber`,`LPelvisAnglesX`,`LPelvisAnglesY`,`LPelvisAnglesZ`,
	  `LHipAnglesX`,`LHipAnglesY`,`LHipAnglesZ`,
	  `LKneeAnglesX`,`LKneeAnglesY`,`LKneeAnglesZ`,
	  `LAnkleAnglesX`,`LAnkleAnglesY`,`LAnkleAnglesZ`,
	  `LFootProgressAnglesX`,`LFootProgressAnglesY`,`LFootProgressAnglesZ`,
	  `LKineticCycleNumber`,
	  `LHipMomentX`,`LHipMomentY`,`LHipMomentZ`,
	  `LKneeMomentX`,`LKneeMomentY`,`LKneeMomentZ`,
	  `LAnkleMomentX`,`LAnkleMomentY`,`LAnkleMomentZ`,
	  `LGroundReactionForceX`,`LGroundReactionForceY`,`LGroundReactionForceZ`,
	  `LHipPowerX`,`LHipPowerY`,`LHipPowerZ`,
	  `LKneePowerX`,`LKneePowerY`,`LKneePowerZ`,
	  `LAnklePowerX`,`LAnklePowerY`,`LAnklePowerZ`,
	  `RCycleNumber`,`RPelvisAnglesX`,`RPelvisAnglesY`,`RPelvisAnglesZ`,
	  `RHipAnglesX`,`RHipAnglesY`,`RHipAnglesZ`,
	  `RKneeAnglesX`,`RKneeAnglesY`,`RKneeAnglesZ`,
	  `RAnkleAnglesX`,`RAnkleAnglesY`,`RAnkleAnglesZ`,
	  `RFootProgressAnglesX`,`RFootProgressAnglesY`,`RFootProgressAnglesZ`,
	  `RKineticCycleNumber`,
	  `RHipMomentX`,`RHipMomentY`,`RHipMomentZ`,
	  `RKneeMomentX`,`RKneeMomentY`,`RKneeMomentZ`,
	  `RAnkleMomentX`,`RAnkleMomentY`,`RAnkleMomentZ`,
	  `RGroundReactionForceX`,`RGroundReactionForceY`,`RGroundReactionForceZ`,
	  `RHipPowerX`,`RHipPowerY`,`RHipPowerZ`,
	  `RKneePowerX`,`RKneePowerY`,`RKneePowerZ`,
	  `RAnklePowerX`,`RAnklePowerY`,`RAnklePowerZ`,`CompteRendu`
	)
	VALUES (
	'".$_POST["medecin"]."', '".$hopital."',  '".$sID."', '".$new_date."' ,  '1', '".$new_date."', '".$_POST["condition"]."','".$_POST["appareillage"]."'
	,0,'','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  0,
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  0,'','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  0,
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  '','','',
	  ''
	);";
    $db->query($SQL);
    message("AQM enregistrée", "green");
}

else if(isset($_POST["p_AddTraitement"])) {
    $new_date = date('Y-m-d');
    if ($_POST["date"]!="") {
        $date = DateTime::createFromFormat('d/m/Y',$_POST["date"]);
        $new_date = $date->format('Y-m-d');
    }
	
    $hopital = $_POST["hopital"];
    if ($_SESSION['type']=="Manager")
        $hopital = $_SESSION['id_hopital'];
    
	$SQL = "INSERT INTO  `traitement` (
	`Patients_ID` ,
	`TypeTraitement_ID` ,
	`SousTypeTraitement_ID` ,
	`Localisation_ID` ,
	`Cote_ID`,
	`Quantite`,
	`Technique`,
	`Date`,
	`Operateur_ID`,
	`hopital_ID`
	)
	VALUES (
	'".$sID."', 
	'".$_POST["traitement"]."', 
	'".$_POST["typetraitement"]."', 
	'".$_POST["localisation"]."' ,
	'".$_POST["cote"]."' ,
	'".$_POST["quantite"]."' ,
	'".$_POST["technique"]."' ,
	'".$new_date."' , 
	'".$_POST["medecin"]."',
	'".$hopital."'
	);";
	
	$db->exec($SQL);
    message("Traitement enregistré", "green");
    
}
    echo '<form id="formEditAQM" method="post" action="patient.php">'
    .'<input type="hidden" name="id" value="'.$sID.'"/>'
    .'</form>'
    .'<script>'
    .'document.getElementById("formEditAQM").submit();'
    .'</script>';
?>
