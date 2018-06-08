<?php
include "config.php";
include "function.php";
    
    if (!isset($_SESSION['username'])){
        exit();
    }

    if (!isset($_POST['consultation']))
        exit();
    
    $consult = $_POST['consultation'];
    
    //Infos consultation et patient + patho
    $SQL = "SELECT * FROM consultation JOIN patients ON consultation.patients_ID_patient=ID_patient JOIN pathologies ON pathologies.patients_ID_patient=ID_patient WHERE ID='".$consult."';";
    $req = $db->query($SQL);
    $aConsult = $req->fetch();
    
    //Récupération de tous les IDs correspondant à la patho et à l'âge qui ont des courbes
    $SQL = "SELECT ID,ID_patient FROM consultation JOIN patients ON consultation.patients_ID_patient=ID_patient JOIN pathologies ON pathologies.patients_ID_patient=ID_patient WHERE ID_patient<>'".$aConsult['ID_patient']."' AND ID<>'".$consult."' AND patho='".$aConsult['patho']."' AND age='".$aConsult['age']."' AND LCycleNumber<>0 AND RCycleNumber<>0 ORDER BY ID;";
    $req = $db->query($SQL);

    //array(ID_Consultation => array(attribut => distance))
    $distancesAttributsConsultations = array();
    //array(ID_Consultation => Moyennes des distances)
    $distanceMoyenneConsultation = array();
    
    $attributsList = array("PelvisAnglesX" => "Pelvis-X", "PelvisAnglesY" => "Pelvis-Y", "PelvisAnglesZ" => "Pelvis-Z", "HipAnglesX" => "Hip-X", "HipAnglesY" => "Hip-Y", "HipAnglesZ" => "Hip-Z", "KneeAnglesX" => "Knee-X", "KneeAnglesY" => "Knee-Y", "KneeAnglesZ" => "Knee-Z", "AnkleAnglesX" => "Ankle-X", "FootProgressAnglesZ" => "Foot-Z");
    $coteList = array("L", "R");
    
    //Calcul pour chaque ID
    while ($aID = $req->fetch()) {
        $ID = $aID['ID'];
        $SQL = "SELECT * FROM consultation WHERE ID='".$ID."';";
        $reqConsult = $db->query($SQL);
        $aListeConsult = $reqConsult->fetch();

        $regressionAttribut = array();
        $moyenne = 0;
        foreach (array_keys($attributsList) as $name) {
            foreach ($coteList as $cote) {
                //Attribut
                $attribut = $cote.$name;
                //Consultation de référence
                $tab = unserialize($aConsult[$attribut]);
                //Consultation pour comparer
                $tabCompare = unserialize($aListeConsult[$attribut]);
                //Calcul de la droite de régression optimale
                $x = array();
                $y = array();
                for ($i = 0; $i < 101 ; $i++) {
                    $x[] = array_sum($tab[$i])/$aConsult[$cote."CycleNumber"];
                    $y[] = array_sum($tabCompare[$i])/$aListeConsult[$cote."CycleNumber"];
                }
                $x_sum = array_sum($x)/101;
                $y_sum = array_sum($y)/101;
                $a1 = 0;
                $a1Denominateur = 0;
                for ($i = 0; $i < 101 ; $i++) {
                    $a1 += ($x[$i]-$x_sum)*($y[$i]-$y_sum);
                    $a1Denominateur += pow($x[$i]-$x_sum,2);
                }
                $a1 = $a1/$a1Denominateur;
                $a0 = $y_sum-$a1*$x_sum;
                $R = 0;
                $RDenominateur = 0;
                for ($i = 0; $i < 101 ; $i++) {
                    $R += pow($a0 + $a1*$x[$i]-$y_sum,2);
                    $RDenominateur += pow($y[$i]-$y_sum,2);
                }
                $R = $R/$RDenominateur;
                $regressionAttribut[$attribut] = $R;
                $moyenne += $R;
            }
        }
        $distancesAttributsConsultations[$ID] = $regressionAttribut;
        $distanceMoyenneConsultation[$ID] = $moyenne/22;
    }
    ?>
    
    <style>
        .compareSimilar:hover {
            background-color:rgba(0,0,0,0.7);
        }

        .bar {
            cursor:pointer;
            flex:1;
            margin-top:auto;
        }

        .bar .barLabel {
            opacity:0;
            transition: opacity 0.7s ease;
        }

        .bar:hover .barLabel {
            opacity:100;
        }
    </style>
    <?php
        
    $colors["L"] = "rgba(255,42,43,0.5)";
    $colors["R"] = "rgba(68,57,255,0.5)";
    //Tri du tableau de la distance moyenne pour un top 10
    arsort($distanceMoyenneConsultation);
    $i = 0;
    foreach ($distanceMoyenneConsultation as $ID => $distance) {
        if ($i<10) {
            //$pourcentage = round((1-$distance)*100,2);
            $pourcentage = round($distance*100,2);
            echo '<div class="centerDiv" style="border-radius:15px 15px 0px 0px;border-bottom:1px solid white;transition:box-shadow 0.7s ease;position:static;display:flex;padding-top:30px;padding-bottom:30px;">';
                $SQL = "SELECT nom,prenom,titre,patho,age,Date_consultation FROM patients JOIN consultation ON ID_patient=consultation.patients_ID_patient JOIN pathologies ON ID_patient=pathologies.patients_ID_patient WHERE ID='".$ID."';";
                $req = $db->query($SQL);
                $row = $req->fetch();
                $date = DateTime::createFromFormat('Y-m-d',substr($row['Date_consultation'], 0, 10));
                $new_date = $date->format('d/m/Y');
                echo '<div style="width:20%;margin-right:20px;">'.$row['titre'].'. <span style="color:#ff8c1a">'.$row['nom'].'</span> '.$row['prenom'].'<br/>'.$row['age'].' - '.$row['patho'].'<br/>'.$new_date.'<h3>'.$pourcentage.' %</h3></div>'
                .'<div style="width:80%;height:122px;padding-bottom:2px;flex:1;display:flex;border-left:1px solid white;border-bottom:1px solid white;">';
                    foreach ($attributsList as $name => $displayName) {
                        echo '<div style="flex:1;border-right:1px solid rgba(255,255,255,0.2);">'
                            .'<div style="height:20px;">'.$displayName.'</div>'
                            .'<div style="display:flex;height:100px;right:0px;left:0px;margin:auto;width:90%;">';
                            foreach($coteList as $cote) {
                                $d = $distancesAttributsConsultations[$ID][$cote.$name];
                                //$p = round((1-$d)*100);
                                $p = round($d*100);
                                if ($p != 0)
                                    echo '<div class="bar" style="background-color:'.$colors[$cote].';height:'.$p.'px;"><span class="barLabel">'.$p.'</span></div>';
                                else
                                    echo '<div class="bar" style="background-color:rgba(0,0,0,0);height:100px;"><span class="barLabel">0</span></div>';
                            }
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>'
            .'</div>';
            echo '<div class="centerDiv compareSimilar" style="cursor:pointer;transition:background-color 0.5s ease;position:relative;border-radius:0px 0px 15px 15px;padding-top:3px;padding-bottom:0px;margin-bottom:40px;border-top:none;" onclick="$.post(\'compare_c3d.php\', {consult:\''.$ID.','.$consult.'\', courbeRef:\''.$consult.'\'}, function (res) { document.getElementById(\'compareSimilar'.$ID.'\').innerHTML=res.substring(0, res.indexOf(\'<script>\')); eval(res.substring(res.indexOf(\'<script>\')+8, res.indexOf(\'</script>\'))); } );">'
                .'<h5>Afficher la comparaison</h5>'
            .'</div>'
            .'<div id="compareSimilar'.$ID.'"></div>';
            $i++;
        }
        else break;
    }

?>
