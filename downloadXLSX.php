<?php
    include "config.php";
    include "function.php";
    include "PHPExcel.php";
    
    if (!isset($_SESSION['username'])){
        header('location: login.php');
    }
    
    $joinString = "patients JOIN consultation ON ID_patient=patients_ID_patient JOIN pathologies ON patients.ID_patient=pathologies.patients_ID_patient JOIN conditionaqm ON consultation.condition=ID_condition JOIN appareillage ON consultation.appareillage=ID_appareillage LEFT OUTER JOIN bilan_clinique ON bilan_clinique.Consultation_ID=consultation.ID LEFT OUTER JOIN bilan_fonctionnel ON bilan_fonctionnel.Consultation_ID=consultation.ID LEFT OUTER JOIN eos ON eos.Patient_ID=patients.ID_patient LEFT OUTER JOIN traitement ON traitement.Patients_ID=patients.ID_patient LEFT OUTER JOIN soustypetraitement ON traitement.SousTypeTraitement_ID=soustypetraitement.ID_Sous_Type_Traitement";

    if (isset($_POST["sqlSelectConsultations"]))
    {
        $whereString = $_POST["sqlWhereDownload"];
        //Pour télécharger le fichier au lieu de le lire
        
        $SQL = "SELECT DISTINCT patients.ID_patient, patients.nom, patients.prenom, patients.Sexe, patients.age, consultation.ID, consultation.Date_consultation, conditionaqm.type_condition, appareillage.type_appareillage, pathologies.patho FROM ".$joinString;

        if ($whereString!="")
            $SQL = $SQL." WHERE ".$whereString;
        $SQL = $SQL." ORDER BY ID_patient;";
        $req = $db->prepare($SQL);
        $req->execute();
        $previousID = 0;
        
        $excel = new PHPExcel;
        $excel->setActiveSheetIndex(0);
        $sheet=$excel->getActiveSheet();
        $sheet->setTitle('Recherche');
        
        //Write
        //Les colonnes débutent à 0 et les lignes débutent à 1
        $sheetRow = 0;
        $sheetCol = 0;
        
        while ($row = $req->fetch())
        {
            if ($previousID != $row["ID_patient"])
            {
                $sheetRow+=1;
                $sheetCol = 0;
                $cellText = $row["ID_patient"].'  '.$row["nom"].'  '.$row["prenom"].' ('.$row["Sexe"].', '.$row["age"].')';
                $sheet->setCellValueByColumnAndRow($sheetCol, $sheetRow, $cellText);
                $sheetCol+=1;
                $previousID = $row["ID_patient"];
            }
            $date = (new DateTime($row["Date_consultation"]))->format('d-m-Y');
            $cellText = $date.' ('.$row["type_condition"].', '.$row["type_appareillage"].')';
            $sheet->setCellValueByColumnAndRow($sheetCol, $sheetRow, $cellText);
            $sheetCol+=1;
        }
        
        $writer = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
	$writer->save('temp_files2/recherche.xlsx');
        header('location: temp_files2/recherche.xlsx');
    }
    else if (isset($_POST["sqlSelectTableau"])) {
        $attributToTH = array("patients.ID_patient" => "Voir",
                              "patients.nom" => "Nom",
                              "patients.prenom" => "Prénom",
                              "patients.IPP" => "IPP",
                              "patients.date_naissance" => "Naissance",
                              "patients.age" => "Enfant/Adulte",
                              "pathologies.patho" => "Pathologie",
                              "pathologies.cote" => "Côté",
                              "consultation.ID" => "ID Consultation",
                              "consultation.Date_consultation" => "Date Consultation",
                              "consultation.Condition" => "Condition",
			      "soustypetraitement.SousTypeTraitement" => "Traitement",
                              "bilan_clinique.Flexion_Hanche" => "Flexion Hanche",
                              "bilan_clinique.Extension_Genou_0" => "Extension Genou 0°",
                              "bilan_clinique.Extension_Genou_90" => "Extension Genou 90°",
                              "bilan_clinique.Abduction_FH_FG" => "Abduction FH FG",
                              "bilan_clinique.Abduction_EH_EG" => "Abduction EH EG",
                              "bilan_clinique.Adduction_Hanche" => "Adduction Hanche",
                              "bilan_clinique.Rot_Int_Hanche" => "Rot Int Hanche",
                              "bilan_clinique.Rot_Ext_Hanche" => "Rot Ext Hanche",
                              "bilan_clinique.Force_Psoas" => "Force Psoas",
                              "bilan_clinique.Force_Grand_Fessier" => "Force Grand Fessier",
                              "bilan_clinique.Force_Moyen_Fessier" => "Force Moyen Fessier",
                              "bilan_clinique.Force_Adducteur" => "Force Adducteur",
                              "bilan_clinique.Ashworth_Adducteur" => "Ashworth Adducteur",
                              "bilan_clinique.Flexion_Genou" => "Flexion Genou",
                              "bilan_clinique.Extension_Genou" => "Extension Genou",
                              "bilan_clinique.Angle_Poplite" => "Angle Poplite",
                              "bilan_clinique.Force_Ischio_Jambier" => "Force Ischio",
                              "bilan_clinique.Force_Quadriceps" => "Force Quadriceps",
                              "bilan_clinique.Ashworth_Ischio_Jambier" => "Ashworth Ischio",
                              "bilan_clinique.Ashworth_Quadriceps" => "Ashworth Quadriceps",
                              "bilan_clinique.Tardieu_Quadriceps" => "Tardieu Quadriceps",
                              "bilan_clinique.Flexion_Cheville_EG" => "Flexion Cheville EG",
                              "bilan_clinique.Flexion_Cheville_FG" => "Flexion Cheville FG",
                              "bilan_clinique.Adductus_Abductus_Avant_Pied" => "Add/Abd Avant Pied",
                              "bilan_clinique.Valgus_Varus_Calcaneum" => "Valgus/Varus",
                              "bilan_clinique.Axe_Cuisse_Pied" => "Axe Cuisse Pied",
                              "bilan_clinique.Force_Tibialis_Anterior" => "Force Tibialis Anterior",
                              "bilan_clinique.Force_Tibialis_Posterior" => "Force Tibialis Posterior",
                              "bilan_clinique.Force_Gastroc" => "Force Gastroc",
                              "bilan_clinique.Force_Peroneus" => "Force Peroneus",
                              "bilan_clinique.Ashworth_Tibialis_Anterior" => "Ashworth Tibialis Anterior",
                              "bilan_clinique.Ashworth_Tibialis_Posterior" => "Ashworth Tibialis Posterior",
                              "bilan_clinique.Ashworth_Gastroc" => "Ashworth Gastroc",
                              "bilan_clinique.Ashworth_Peroneus" => "Ashworth Peroneus",
                              "bilan_clinique.Tardieu_Tibialis_Posterior" => "Tardieu Tibialis Posterior",
                              "bilan_clinique.Tardieu_Gastroc" => "Tardieu Gastroc",
                              "bilan_clinique.Tardieu_Peroneus" => "Tardieu Peroneus",
                              "bilan_clinique.Anteversion" => "Anteversion",
                              "bilan_clinique.Axe_Bimalleolaire" => "Axe Bimalleolaire",
                              "bilan_clinique.Rotule_Haute" => "Rotule Haute",
                              "bilan_clinique.Dislocation_Medio_Tarsienne" => "Dis. Medio-Tarsienne",
                              "bilan_clinique.Gibbosite" => "Gibbosité",
                              "bilan_clinique.ElyTest" => "ElyTest",
                              "bilan_fonctionnel.Niveau_Palisano" => "Niveau Palisano",
                              "bilan_fonctionnel.Perimetre_marche" => "Perimetre Marche",
                              "bilan_fonctionnel.Aides_Techniques" => "Aides Techniques",
                              "bilan_fonctionnel.Eval_fonc_gillette" => "Eval Gillette",
                              "bilan_fonctionnel.Echelle_mobilite_fonc_5m" => "Mobilité 5m",
                              "bilan_fonctionnel.Echelle_mobilite_fonc_50m" => "Mobilité 50m",
                              "bilan_fonctionnel.Echelle_mobilite_fonc_500m" => "Mobilité 500m",
                              "eos.Long_Femur" => "Longueur Fémur",
                              "eos.Long_Tibia" => "Longueur Tibia",
                              "eos.Long_Fonct" => "Longueur Fonctionnelle",
                              "eos.Long_Anat" => "Longueur Anatomique",
                              "eos.Diam_TF" => "Diam. tête fémorale",
                              "eos.Offset_Femur" => "Offset Fémur",
                              "eos.Long_Col_Fem" => "Longueur Col Fémur",
                              "eos.Neck_Shaft_Angle" => "Angle Cervico-Dia.",
                              "eos.Knee_Varus" => "Valgus/Varus",
                              "eos.Knee_Flessum" => "Flessum/Recurvatum",
                              "eos.Angle_Fem_Meca" => "Angle Fémur",
                              "eos.Angle_Tib_Meca" => "Angle Tibia",
                              "eos.HKS" => "HKS",
                              "eos.Torsion_Fem" => "Torsion Fémur",
                              "eos.Torsion_Tibia" => "Torsion Tibia",
                              "eos.Rotation Fémur/Tibia" => "Rotation Fémur/Tibia");
        
        $selectString = $_POST["sqlSelectTableau"];
        $whereString = $_POST["sqlWhereDownload"];
        
        $SQL = "SELECT DISTINCT ".$selectString." FROM ".$joinString;
        if ($whereString != "")
            $SQL = $SQL." WHERE ".$whereString;
        
        $req = $db->prepare($SQL);
        $req->execute();
        
        $excel = new PHPExcel;
        $excel->setActiveSheetIndex(0);
        $sheet=$excel->getActiveSheet();
        $sheet->setTitle('Recherche');
        
        //Write
        //Les colonnes débutent à 0 et les lignes débutent à 1
        $sheetRow = 1;
        $sheetCol = 0;
        //Titre de chaque colonne
        foreach (explode(",",$selectString) as $attribut) {
            if (strpos($attribut,"_G"))
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow,$attributToTH[substr($attribut,0,-2)]." G");
            else if (strpos($attribut,"_G1"))
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow,$attributToTH[substr($attribut,0,-3)]." G1");
            else if (strpos($attribut,"_G2"))
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow,$attributToTH[substr($attribut,0,-3)]." G2");
            else if (strpos($attribut,"_D"))
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow,$attributToTH[substr($attribut,0,-2)]." D");
            else if (strpos($attribut,"_D1"))
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow,$attributToTH[substr($attribut,0,-3)]." D1");
            else if (strpos($attribut,"_D2"))
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow,$attributToTH[substr($attribut,0,-3)]." D2");
            else
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow,$attributToTH[$attribut]);
            $sheetCol+=1;
        }
        //Ligne par ligne
        while ($row = $req->fetch()) {
            $sheetRow+=1;
            $sheetCol=0;
            foreach (explode(",",$selectString) as $attribut) {
                $sheet->setCellValueByColumnAndRow($sheetCol,$sheetRow, $row[explode(".",$attribut)[1]]);
                $sheetCol+=1;
            }
        }
        
        $writer = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
	$writer->save('temp_files2/recherche.xlsx');
        header('location: temp_files2/recherche.xlsx');
    }
?>
