<?php
include "config.php";
include "function.php";
include "PHPExcel.php";
    
if (!isset($_SESSION['username'])){
    header('location: login.php');
    exit();
}
else if ($_SESSION['type'] != "Administrator" && $_SESSION['type'] != "Manager") {
    header('location: index.php');
    exit();
}
    
$SQL = "SELECT * FROM hopital WHERE ID='".$_SESSION["id_hopital"]."';";
$req = $db->query($SQL);
$hopital = $req->fetch();
    
if (isset($_POST["envoyer"])) {
    if (explode('.', $_FILES['file']['name'])[1] != "xlsx") {
        message("Fichier invalide", "red");
    }
    else {
        $dossier = 'temp_files/';
        $fichier = basename($_FILES['file']['tmp_name']);
        if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier.$fichier))
        {
            //Patients ID_Excel => ID_MySql
            $patients = array();
            //Medecins ID_Excel => ID_MySql
            $medecins = array();
            
            $nbPatients = 0;
            $nbMedecins = 0;
            $nbConsults = 0;
            $nbPathologies = 0;

            $pathoToSQL = array(1 => array('patho' => "Hemiplegie", 'cote' => "1", 'type_patho' => ""),
                                2 => array('patho' => "Hemiplegie", 'cote' => "2", 'type_patho' => ""),
                                3 => array('patho' => "Diplegie", 'cote' => "", 'type_patho' => ""),
                                4 => array('patho' => "Triplegie", 'cote' => "", 'type_patho' => ""),
                                5 => array('patho' => "Tetraplegie", 'cote' => "", 'type_patho' => ""),
                                6 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "Tumorale"),
                                7 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "Congenitale"),
                                8 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "Vasculaire"),
                                9 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "SEP"),
                                10 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "Diplegie"),
                                11 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "Traumatique"),
                                12 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "Autre"),
                                13 => array('patho' => "Paraplegie", 'cote' => "", 'type_patho' => "Non renseigné"),
                                14 => array('patho' => "Myogenes", 'cote' => "", 'type_patho' => "Becker"),
                                15 => array('patho' => "Myogenes", 'cote' => "", 'type_patho' => "Steinert"),
                                16 => array('patho' => "Myogenes", 'cote' => "", 'type_patho' => "Charcot Marie Tooth"),
                                17 => array('patho' => "Myogenes", 'cote' => "", 'type_patho' => "Duchenne"),
                                18 => array('patho' => "Myogenes", 'cote' => "", 'type_patho' => "Autre"),
                                19 => array('patho' => "Myogenes", 'cote' => "", 'type_patho' => "Non renseigné"),
                                20 => array('patho' => "Ortho", 'cote' => "1", 'type_patho' => ""),
                                21 => array('patho' => "Ortho", 'cote' => "2", 'type_patho' => ""),
                                22 => array('patho' => "Ortho", 'cote' => "3", 'type_patho' => ""),
                                23 => array('patho' => "Atteinte", 'cote' => "1", 'type_patho' => "Acquise"),
                                24 => array('patho' => "Atteinte", 'cote' => "1", 'type_patho' => "Congenitale"),
                                25 => array('patho' => "Atteinte", 'cote' => "1", 'type_patho' => "Non renseigné"),
                                26 => array('patho' => "Atteinte", 'cote' => "2", 'type_patho' => "Acquise"),
                                27 => array('patho' => "Atteinte", 'cote' => "2", 'type_patho' => "Congenitale"),
                                28 => array('patho' => "Atteinte", 'cote' => "2", 'type_patho' => "Non renseigné"),
                                29 => array('patho' => "Ataxie", 'cote' => "1", 'type_patho' => "Mixte"),
                                30 => array('patho' => "Ataxie", 'cote' => "1", 'type_patho' => "Sensitive"),
                                31 => array('patho' => "Ataxie", 'cote' => "1", 'type_patho' => "Cerebelleuse"),
                                32 => array('patho' => "Ataxie", 'cote' => "1", 'type_patho' => "Non renseigné"),
                                33 => array('patho' => "Ataxie", 'cote' => "2", 'type_patho' => "Mixte"),
                                34 => array('patho' => "Ataxie", 'cote' => "2", 'type_patho' => "Sensitive"),
                                35 => array('patho' => "Ataxie", 'cote' => "2", 'type_patho' => "Cerebelleuse"),
                                36 => array('patho' => "Ataxie", 'cote' => "2", 'type_patho' => "Non renseigné"),
                                37 => array('patho' => "Autre", 'cote' => "", 'type_patho' => ""),
                                38 => array('patho' => "Non renseigné", 'cote' => "", 'type_patho' => ""),);
            
            //Initialisation PHPExcelReader
            $objet = PHPExcel_IOFactory::createReader('Excel2007');
            //On ouvre le fichier
            $excel = $objet->load($dossier.$fichier);
            
            //Feuille Patients
            $sheet = $excel->getSheet(0);
            $rows = $sheet->getHighestRow();
            for ($i = 3 ; $i < $rows-1 ; $i++)
            {
                //Ligne i
                $ID_Excel = $sheet->getCell("A".$i)->getValue();
                $nom = $sheet->getCell("B".$i)->getValue();
                $prenom = $sheet->getCell("C".$i)->getValue();
                $IPP = $sheet->getCell("D".$i)->getValue();
                $date_naissance = $sheet->getCell("E".$i);
                $civilite = $sheet->getCell("F".$i)->getValue();
                $age = $sheet->getCell("G".$i)->getValue();
                $historique = $sheet->getCell("H".$i)->getValue();
                $IDPatho = $sheet->getCell("I".$i)->getValue();
                if ($ID_Excel!="" && $nom!="" && $prenom!="" && $IPP !="" && $date_naissance!="" && $civilite!="" && ($civilite=="M" || $civilite=="Mme") && $age!="" && ($age=="Enfant" || $age=="Adulte"))
                {
                    if ($new_date = DateTime::createFromFormat('d/m/Y',$date_naissance->getValue())) {
                        $date_naissance = $new_date->format('Y-m-d');
                    }
                    else {
                        $date_naissance = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($date_naissance->getValue()));
                    }
                    //On vérifie que le patient n'existe pas :
                    $SQL = "SELECT * FROM patients WHERE nom='".$nom."' AND prenom='".$prenom."' AND IPP='".$IPP."' AND date_naissance='".$date_naissance."' AND titre='".$civilite."' AND age='".$age."' AND hopital_ID='".$_SESSION["id_hopital"]."';";
                    $req = $db->query($SQL);
                    //Si le patient existe déjà
                    if ($row = $req->fetch()) {
                        $patients[$ID_Excel] = $row["ID_patient"];
                    }
                    //Si le patient n'existe pas
                    else {
                        $SQL = "INSERT INTO patients (nom,prenom,IPP,date_naissance,Sexe,titre,Historique_Patient,age,hopital_ID) VALUES ('".$nom."','".$prenom."','".$IPP."','".$date_naissance."','".sexe_determination($civilite)."','".$civilite."','".$historique."','".$age."','".$_SESSION["id_hopital"]."');";
                        $db->exec($SQL);
                        //On récupère l'ID
                        $SQL = "SELECT ID_patient FROM patients ORDER BY ID_patient DESC;";
                        $req = $db->query($SQL);
                        $row = $req->fetch();
                        $ID = $row["ID_patient"];
                        $patients[$ID_Excel] = $ID;
                        if ($IDPatho!="" && ($IDPatho>=1 && $IDPatho<=38)) {
                            $SQL = "INSERT INTO pathologies (patients_ID_patient, patho, cote, type_patho, origine, commentaire) VALUES ('".$ID."', '".$pathoToSQL[$IDPatho]["patho"]."', '".$pathoToSQL[$IDPatho]["cote"]."', '".$pathoToSQL[$IDPatho]["type_patho"]."', '', '');";
                            $db->exec($SQL);
                            $nbPathologies++;
                        }
                        $nbPatients++;
                    }
                }
            }
            
            
            //Feuille medecins
            $sheet = $excel->getSheet(1);
            $rows = $sheet->getHighestRow();
            for ($i = 3 ; $i < $rows-1 ; $i++)
            {
                //Ligne i
                $ID_Excel = $sheet->getCell("A".$i)->getValue();
                $nom = $sheet->getCell("B".$i)->getValue();
                $prenom = $sheet->getCell("C".$i)->getValue();
                $email = $sheet->getCell("D".$i)->getValue();
                $creerCompte = $sheet->getCell("E".$i)->getValue();
                if ($ID_Excel!="" && $nom!="" && $prenom!="")
                {
                    //On vérifie que l'utilisateur n'existe pas déjà
                    $SQL = "SELECT * FROM utilisateur WHERE nom='".$nom."' AND prenom='".$prenom."' AND id_hopital='".$_SESSION["id_hopital"]."';";
                    $req = $db->query($SQL);
                    //Si il existe
                    if ($row = $req->fetch()) {
                        $medecins[$ID_Excel] = $row["id"];
                    }
                    else {
                        $login = strtolower($nom).strtolower(substr($prenom,0,1));
                        if ($creerCompte=="Oui") {
                            $SQL = "INSERT INTO utilisateur (nom,prenom,username,password,email,type,id_hopital) VALUES ('".$nom."','".$prenom."','".$login."','".$login."','".$email."','Member','".$_SESSION["id_hopital"]."');";
                            $db->exec($SQL);
                            //On récupère l'ID
                            $SQL = "SELECT id FROM utilisateur ORDER BY id DESC;";
                            $req = $db->query($SQL);
                            $row = $req->fetch();
                            $ID = $row["id"];
                            $medecins[$ID_Excel] = $ID;
                            $nbMedecins++;
                        }
                        else {
                            $SQL = "INSERT INTO utilisateur (nom,prenom,username,password,email,type,id_hopital) VALUES ('".$nom."','".$prenom."','".$login."','','".$email."','Passive Member','".$_SESSION["id_hopital"]."');";
                            $db->exec($SQL);
                            //On récupère l'ID
                            $SQL = "SELECT id FROM utilisateur ORDER BY id DESC;";
                            $req = $db->query($SQL);
                            $row = $req->fetch();
                            $ID = $row["id"];
                            $medecins[$ID_Excel] = $ID;
                            $nbMedecins++;
                        }
                    }
                }
            }
            
            //Feuille consultations
            $sheet = $excel->getSheet(2);
            $rows = $sheet->getHighestRow();
            for ($i = 3 ; $i < $rows-1 ; $i++)
            {
                //Ligne i
                $patient = $sheet->getCell("A".$i)->getValue();
                $medecin = $sheet->getCell("B".$i)->getValue();
                if (isset($patients[$patient]) && isset($medecins[$medecin])) {
                    $date = $sheet->getCell("C".$i);
                    $condition = $sheet->getCell("D".$i)->getValue();
                    $appareillage = $sheet->getCell("E".$i)->getValue();
                    $compteRendu = $sheet->getCell("F".$i)->getValue();
                    if ($patient!="" && $medecin!="" && $date!="" && $condition !="" && $appareillage!="")
                    {
                        if ($new_date = DateTime::createFromFormat('d/m/Y',$date->getValue())) {
                            $date = $new_date->format('Y-m-d');
                        }
                        else {
                            $date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($date->getValue()));
                        }
                        $SQL = "INSERT INTO consultation (
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
                        `RAnklePowerX`,`RAnklePowerY`,`RAnklePowerZ`
                        )
                        VALUES (
                                '".$medecins[$medecin]."', '".$_SESSION["id_hopital"]."',  '".$patients[$patient]."', '".$date."' ,  '1', '".$date."', '".$condition."','".$appareillage."'
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
                                '','',''
                                );";
                        $db->exec($SQL);
                        $nbConsults++;
                    }

                }
            }
            
            unlink($dossier.$fichier);
            message("Données importées (".$nbPatients." patients, ".$nbPathologies." pathologies, ".$nbMedecins." medecins, ".$nbConsults." consultations)", "green");
        }
        else {
            message("Erreur lors du transfert", "red");
        }
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

    .labelFile {
        transition:color 0.5s ease, border 0.5s ease;
        cursor:pointer;
        color:white;
        border-radius:15px;
        height:40px;
        width:100%;
        margin:4px;
        background-color:rgba(0,0,0,0.3);
        border: 2px solid rgba(255,255,255,0);
    }

    .labelFile:hover {
        border: 2px solid rgba(255,255,255,0.6);
    }

</style>

    <div class="background">
        <img class="bgImg" src="img/index.png" alt=""/>

        <div class="centerDiv" style="top:100px;width:60%;overflow:hidden;padding-right:0px;padding-left:0px;">
            <h3 style="color:#ff8c1a">Importer des données</h3><br/>
            <div id="importMenu" style="position:relative;display:flex;justify-content:center;">
                <div class="buttonClassic" style="width:40%;margin:4px;height:40px;border-radius:15px;" onclick="document.location='downloadFiles/Importation.xlsx';swipe(0);"><h5>Télécharger le fichier type</h5></div>
                <div style="width:40%;height:40px;">
                    <form id="formAdminForm" method="post" action="adminImport.php" enctype="multipart/form-data">
                    <input type="hidden" name="envoyer" value=""/>
                    <input type="file" id="inputFile" style="display:none;" name="file" onchange="document.getElementById('formAdminForm').submit();"/>
                    <label class="labelFile" for="inputFile"><h5>Importer le fichier rempli</h5></label>
                    </form>
                </div>
            </div>
            <br/><br/>
            <h5>Vous êtes actuellement responsable du site <span style="color:#ff8c1a"><?php echo $hopital["Nom"]; ?></span>.</h5>
            <h5>Les données importées concerneront cet hôpital.</h5>
        </div>

        <?php
            nav("Admin");
        ?>

    </div>

  </body>
</html>
