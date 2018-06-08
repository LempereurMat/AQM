<?php
    include "config.php";
    include "function.php";

    if (!isset($_SESSION['username'])){
        header('location: login.php');
    }

    $data = json_decode($_POST['data'], true);
    $select = $data['select'];
    $where = $data['where'];
    $selectString = "";
    $whereString = "";
    
    //Traitement du select
    foreach ($select as $selectItem) {
        
        $selectAttribut = $selectItem['attribut'];
        
        //Si l'attribut est dans bilanclinique, il faut ajouter _G et _D
        if (strpos($selectAttribut,"bilan_clinique.") !== false) {
            if ($selectAttribut == "bilan_clinique.Angle_poplite")
                $selectString = $selectString."bilan_clinique.Angle_poplite_G1,bilan_clinique.Angle_poplite_D1,bilan_clinique.Angle_poplite_G2,bilan_clinique.Angle_poplite_D2,";
            else
                $selectString = $selectString.$selectAttribut."_G,".$selectAttribut."_D,";
        }
        else if ($selectAttribut == "patients.ageNumeric") {
            $selectString = $selectString."patients.date_naissance,";
        }
        else if ($selectAttribut == "traitement.SousTypeTraitement_ID") {
            $selectString = $selectString."soustypetraitement.SousTypeTraitement,";
        }
        else {
            $selectString = $selectString.$selectAttribut.",";
        }
    }
    //On supprime la virgule finale
    $selectString = substr($selectString, 0, -1);
    //Traitement du where
    foreach ($where as $whereItem) {
        
        $whereAttribut = $whereItem['attribut'];
        $whereValue = $whereItem['value'];
        $whereType = $whereItem['type'];
        
        if ($whereType=="E")
            $whereCondition="='".$whereValue."'";
        else if ($whereType=="L")
            $whereCondition=" LIKE '%".$whereValue."%'";
        else if ($whereType=="B")
            $whereCondition=" BETWEEN ".$whereValue;
        
        //Si l'attribut est dans bilanclinique, il faut ajouter _G et _D
        if (strpos($whereAttribut,"bilan_clinique.") !== false) {
            if ($whereAttribut == "bilan_clinique.Angle_poplite")
                $whereString = $whereString."( bilan_clinique.Angle_poplite_G1".$whereCondition." OR bilan_clinique.Angle_poplite_D1".$whereCondition." OR bilan_clinique.Angle_poplite_G2".$whereCondition." OR bilan_clinique.Angle_poplite_D2".$whereCondition." ) AND ";
            else
                $whereString = $whereString."( ".$whereAttribut."_G".$whereCondition." OR ".$whereAttribut."_D".$whereCondition." ) AND ";
        }
        else if ($whereAttribut == "patients.ageNumeric") {
            //Today
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            if ($whereType == "E" || $whereType == "L")
                $whereString = $whereString."(patients.date_naissance BETWEEN '".($year-$whereValue-1)."-".$month."-".$day."' AND '".($year-$whereValue)."-".$month."-".$day."') AND ";
            else if ($whereType == "B") {
                //age1 < age2
                $age1 = substr($whereValue, 0, strpos($whereValue,"AND"));
                $age2 = substr($whereValue, strpos($whereValue,"AND")+4);
                $whereString = $whereString."(patients.date_naissance BETWEEN '".($year-$age2-1)."-".$month."-".$day."' AND '".($year-$age1)."-".$month."-".$day."') AND ";
            }
        }
        else {
            $whereString = $whereString.$whereAttribut.$whereCondition." AND ";
        }
    }
    //On supprime le AND final
    $whereString = substr($whereString, 0, -4);
    
    $joinString = "patients JOIN consultation ON ID_patient=patients_ID_patient JOIN pathologies ON patients.ID_patient=pathologies.patients_ID_patient JOIN conditionaqm ON consultation.condition=ID_condition JOIN appareillage ON consultation.appareillage=ID_appareillage JOIN cote ON pathologies.cote=ID_Cote";
    
        //On traite différement dans le cas de export.[...]
        if (strpos($selectString, "export.ConsultationsParPatient")!==false)
        {
            $selectString = "patients.ID_patient, patients.nom, patients.prenom, patients.Sexe, patients.age, consultation.ID, consultation.Date_consultation, consultation.RCycleNumber, consultation.LCycleNumber, conditionaqm.type_condition, appareillage.type_appareillage, pathologies.patho, cote.Cote";

            $SQL = "SELECT ".$selectString." FROM ".$joinString;
            
            if ($whereString!="")
                $SQL = $SQL." WHERE ".$whereString;
            
            $SQL = $SQL." ORDER BY ID_patient;";
            $req = $db->query($SQL);
            echo '<h5 style="color:#ff8c1a">'.$SQL.'</h5><br/><br/>';
            echo '<div id="listeConsultations">';
            $totalPatients["Adulte"] = 0;
            $totalPatients["Enfant"] = 0;
            $totalAQM = 0;
            $list = array();
            $previousPatient = 0;
            while ($row = $req->fetch())
            {
                if ($row["ID_patient"]!=$previousPatient) {
                    $totalPatients[$row["age"]] += 1;
                    $previousPatient = $row["ID_patient"];
                }
                //On ajoute l'AQM au patient correspondant
                $list[$row["ID_patient"]][] = $row;
                $totalAQM+=1;
            }
            //Affichage nombre AQM / nombre patients
            echo '<div style="border:1px solid white;border-radius:10px;height:auto;margin-bottom:50px;">';
            echo '<h4>'.$totalAQM.' AQM</h4>';
            $totalPatient = $totalPatients["Adulte"]+$totalPatients["Enfant"];
            echo '<h4>'.$totalPatient.' patients, dont '.$totalPatients["Adulte"].' adultes et '.$totalPatients["Enfant"].' enfants</h4>';
            echo '</div>';
            //Bouttons txt et c3d
            echo '<div style="display:flex;justify-content:center;width:90%;margin-bottom:20px;">';
            //Boutton export
            //On click : on regarde chaque checkbox et on forme une chaine d'ID_consult "1,15,106,40"
            ?>
            <div class="buttonClassic" style="width:400px;height:30px;border-radius:10px;padding-top:3px;margin-left:60px;" onclick="$('#exportMenu').animate({bottom:'0%'}, 700);">Exporter les consultations cochées au format c3d</div>
            <?php
            //target="_blank" permet d'ouvrir dans un autre onglet
            echo '<form id="formDownload1" method="POST" action="downloadXLSX.php" target="_blank">'
            .'<input type="hidden" id="sqlSelectConsultations" name="sqlSelectConsultations" value="0"/>'
            .'<input type="hidden" id="sqlWhereDownload" name="sqlWhereDownload" value="'.$whereString.'"/>'
            .'</form>'
            .'<div class="buttonClassic" style="width:300px;height:30px;border-radius:10px;padding-top:3px;margin-left:60px;" onclick="document.getElementById(\'formDownload1\').submit();">Télécharger le tableau au format xlsx</div>';
            echo '</div><br/>';
            //Select all checkboxes
            echo '<input style="margin-left:20px;" type="checkbox" id="checkSelectAll" class="inputRadio" onclick="var checkboxes = document.getElementsByName(\'checkbox\'); for(var i=0, n=checkboxes.length;i<n;i++) { checkboxes[i].checked = this.checked; }" checked/><label  for="checkSelectAll" style="height:20px;width:20px;white-space:nowrap;float:left;margin-left:70px;"><h5 style="position:relative;left:25px;bottom:9px;">Tout sélectionner</h5></label><br/>';
            //Liste
            foreach (array_keys($list) as $id)
            {
                echo '<form id="viewPatient'.$id.'" method="post" action="patient.php" target="_blank">'
                .'<input type="hidden" name="id" value="'.$id.'"/>'
                .'<input type="hidden" name="previousPage" value="reqInteractive.php"/>'
                .'</form>';
                echo '<br/><h4 onclick="document.getElementById(\'viewPatient'.$id.'\').submit()" style="cursor:pointer;color:#ff8c1a;text-align:left;margin-left:50px;">'.$id.'  '.$list[$id][0]["nom"].'  '.$list[$id][0]["prenom"].' ('.$list[$id][0]["Sexe"].', '.$list[$id][0]["age"].', '.$list[$id][0]["patho"].')</h4>';
                foreach ($list[$id] as $AQM)
                {
                    $date = (new DateTime($AQM["Date_consultation"]))->format('d/m/Y');
                    if ($AQM["RCycleNumber"] != 0 && $AQM["LCycleNumber"] != 0)
                        echo '<input type="checkbox" name="checkbox" id="checkbox-'.$AQM["ID_patient"].'-'.$AQM["ID"].'" class="inputRadio" checked/><label for="checkbox-'.$AQM["ID_patient"].'-'.$AQM["ID"].'" style="height:20px;width:20px;white-space:nowrap;float:left;clear:both;margin-left:70px;"><span style="position:relative;left:25px;bottom:1px;">'.$date.' ('.$AQM["type_condition"].', '.$AQM["type_appareillage"].')</span></label><br/>';
                    else
                        echo '<label style="height:20px;width:20px;white-space:nowrap;float:left;clear:both;margin-left:70px;"><span style="position:relative;left:25px;bottom:1px;">'.$date.' ('.$AQM["type_condition"].', '.$AQM["type_appareillage"].')</span></label><br/>';
                }
            }
            echo '</div>';
            exit();
        }
                
        //Affichage dans le tableau
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
        
        $SQL = "SELECT DISTINCT ".$selectString." FROM ".$joinString;
        if ($whereString != "")
            $SQL = $SQL." WHERE ".$whereString;
        
        $SQL = $SQL." LIMIT 200;";
        $req = $db->query($SQL);
        
        
        echo '<h5 style="color:#ff8c1a">'.$SQL.'</h5><br/><br/>'
        .'<form id="formDownload2" method="POST" action="downloadXLSX.php" target="_blank"><input type="hidden" id="sqlSelectTableau" name="sqlSelectTableau" value="'.$selectString.'"/><input type="hidden" id="sqlWhereDownload" name="sqlWhereDownload" value="'.$whereString.'"/><div class="buttonClassic" style="width:300px;height:30px;border-radius:10px;padding-top:3px;left:0px;right:0px;margin:auto;" onclick="document.getElementById(\'formDownload2\').submit();">Télécharger le résultat au format xlsx</div></form><br/>'
        .'<table><thead>'
        .'<tr>';
        //En tête avec les attributs
        foreach (explode(",", $selectString) as $attribut) {
            if (strpos($attribut,"_G"))
                echo '<th style="color:#ff8c1a;">'.$attributToTH[substr($attribut,0,-2)].' G</th>';
            else if (strpos($attribut,"_G1"))
                echo '<th style="color:#ff8c1a;">'.$attributToTH[substr($attribut,0,-3)].' G1</th>';
            else if (strpos($attribut,"_G2"))
                echo '<th style="color:#ff8c1a;">'.$attributToTH[substr($attribut,0,-3)].' G2</th>';
            else if (strpos($attribut,"_D"))
                echo '<th style="color:#ff8c1a;">'.$attributToTH[substr($attribut,0,-2)].' D</th>';
            else if (strpos($attribut,"_D1"))
                echo '<th style="color:#ff8c1a;">'.$attributToTH[substr($attribut,0,-3)].' D1</th>';
            else if (strpos($attribut,"_D2"))
                echo '<th style="color:#ff8c1a;">'.$attributToTH[substr($attribut,0,-3)].' D2</th>';
            else
                echo '<th style="color:#ff8c1a;">'.$attributToTH[$attribut].'</th>';
        }
        echo '</tr>'
        .'</thead>'
        .'<tbody>';
        while ($row = $req->fetch())
        {
            echo '<tr>';
            foreach (explode(",", $selectString) as $attribut)
            {
                //Lien vers le dossier si ID_patient
                if ($attribut=="patients.ID_patient")
                    echo '<td style="width:50px;" onclick="document.getElementById(\'formPatient'.$row['ID_patient'].'\').submit()">'
                    .'<form id="formPatient'.$row['ID_patient'].'" action="patient.php" method="post" target="_blank">'
                        .'<input type="hidden" name="id" value="'.$row['ID_patient'].'"/>'
                        .'<input type="hidden" name="previousPage" value="reqInteractive.php"/>'
                    .'</form>'
                    .'<span style="color:#ff8c1a;" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'
                    .'</td>';
                //Gérer le format des dates
                else if (strpos($attribut,"date") || strpos($attribut,"Date"))
                {
                    echo '<th>';
                    $date_naissance = $row[explode(".",$attribut)[1]];
                    $date = new DateTime($date_naissance);
                    $new_date = $date->format('d/m/Y');
                    echo $new_date;
                    if ($attribut=="patients.date_naissance") {
                        //Affichage de l'age
                        $birth = strtotime($date_naissance);
                        $today = time();
                        $age = date('Y',$today)-date('Y',$birth);
                        if(strcmp(date('md', $birth),date('md', $today))>0) $age--;
                        echo " (".$age." ans)";
                    }
                    echo '</th>';
                }
                else
                    echo '<th>'.$row[explode(".",$attribut)[1]].'</th>';
            }
            echo '</tr>';
        }

        echo '</tbody>'
        .'</table>';

?>
