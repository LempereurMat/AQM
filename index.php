<?php
    include "config.php";
    include "function.php";
    
    if (!isset($_SESSION['username'])){
        header('location: login.php');
        exit();
    }
    
    $SQL = "SELECT username,password FROM utilisateur WHERE id='".$_SESSION['id']."'";
    $req = $db->query($SQL);
    $row = $req->fetch();
    //Si le mot de passe n'a pas été changé
    if (md5($row["username"])==$row["password"]) {
        message("Votre mot de passe n'a pas encore été modifié. Pensez à le changer dans les paramètres",'orange');
    }
    
    //id = 0 -> tous les sites
    function chiffres($idhopital,$db) {
        //Nb patients
        if ($idhopital == 0)
            $req = $db->prepare("SELECT age,COUNT(ID_patient) AS count FROM patients GROUP BY age;");
        else
            $req = $db->prepare("SELECT age,COUNT(ID_patient) AS count FROM patients WHERE hopital_ID='".$idhopital."' GROUP BY age;");
        $req->execute();
        $count['Adulte']=0;
        $count['Enfant']=0;
        while ($row = $req->fetch()) {
            $count[$row['age']] = $row['count'];
        }
        if ($count['Adulte']!=0 && $count['Enfant']!=0)
            echo '<h3><span style="color:#ff8c1a;">'.($count['Adulte'] + $count['Enfant']).'</span> patients</h3>'
            .'<h4>dont <span style="color:#ff8c1a;">'.($count['Adulte']).'</span> adultes '
            .'et <span style="color:#ff8c1a;">'.($count['Enfant']).'</span> enfants</h4>';
        else
            echo '<h4><span style="color:#ff8c1a;">'.($count['Adulte'] + $count['Enfant']).'</span> patients</h4>';
        
        //Nb utilisateurs
        if ($idhopital == 0)
            $req = $db->prepare("SELECT type,COUNT(id) AS count FROM utilisateur GROUP BY type;");
        else
            $req = $db->prepare("SELECT type,COUNT(id) AS count FROM utilisateur WHERE id_hopital=".$idhopital." GROUP BY type;");
        $req->execute();
        $count['Administrator']=0;
        $count['Member']=0;
        $count['Passive Member']=0;
        while ($row = $req->fetch()) {
            $count[$row['type']] = $row['count'];
        }
        if ($count['Administrator']!=0 && $count['Member']!=0 && $count['Passive Member']!=0)
            echo '<h3><span style="color:#ff8c1a;">'.($count['Administrator'] + $count['Member'] + $count['Passive Member']).'</span> utilisateurs</h3> '
            .'<h4>dont <span style="color:#ff8c1a;">'.($count['Administrator']).'</span> administrateurs '
            .', <span style="color:#ff8c1a;">'.($count['Member']).'</span> membres '
            .'et <span style="color:#ff8c1a;">'.($count['Passive Member']).'</span> membres passifs</h4><br/>';
        else
            echo '<h4 style="color:white;"><span style="color:#ff8c1a;">'.($count['Administrator'] + $count['Member'] + $count['Passive Member']).'</span> utilisateurs </h4></br>';
        
        //Nb AQMs
        if ($idhopital == 0)
            $req = $db->prepare("SELECT age,YEAR(Date_consultation) AS date,COUNT(consultation.ID) AS count FROM consultation JOIN patients ON consultation.patients_ID_patient = patients.ID_patient GROUP BY age,YEAR(Date_consultation);");
        else
            $req = $db->prepare("SELECT age,YEAR(Date_consultation) AS date,COUNT(consultation.ID) AS count FROM consultation JOIN patients ON consultation.patients_ID_patient = patients.ID_patient WHERE consultation.Hopital_ID='".$idhopital."' GROUP BY age,YEAR(Date_consultation);");
        $req->execute();
        while ($row = $req->fetch())
            $count['AQM'][$row['age']][$row['date']] = $row['count'];
        
        //Nb AQMs
        echo '<table>';
        echo '<tr><th style="padding: 5px;">AQM</th>'
        .'<th style="padding: 5px;">Adulte</th>'
        .'<th style="padding: 5px;">Enfant</th>'
        .'<th style="padding: 5px;">Total</th></tr>';
        $count['AQM']['AdulteTotal']=0;
        $count['AQM']['EnfantTotal']=0;
        $count['AQM']['Total']=0;
        for ($i = 2006 ; $i<=2018 ; $i++)
        {
            if(isset($count['AQM']['Adulte'][$i])) $adulte = $count['AQM']['Adulte'][$i];
            else $adulte = 0;
            if(isset($count['AQM']['Enfant'][$i])) $enfant = $count['AQM']['Enfant'][$i];
            else $enfant = 0;
            $count['AQM']['AdulteTotal']+=$adulte;
            $count['AQM']['EnfantTotal']+=$enfant;
            $count['AQM']['Total']+=($adulte+$enfant);
            echo '<tr><th>'.$i.'</th>'
            .'<td>'.$adulte.'</td>'
            .'<td>'.$enfant.'</td>'
            .'<td>'.($adulte+$enfant).'</td>'
            .'</tr>';
        }
        echo '<tr style="color:#ff8c1a;background-color:rgba(0,0,0,0.2);"><th>Total</th>'
        .'<td>'.$count['AQM']['AdulteTotal'].'</td>'
        .'<td>'.$count['AQM']['EnfantTotal'].'</td>'
        .'<td>'.$count['AQM']['Total'].'</td></tr>';
        echo '</table>';
    }
    
    //AJAX, lors de la selection de l'hopital
    if (isset($_POST["idhopital"])) {
        chiffres($_POST["idhopital"],$db);
        exit();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet"/>
    <!-- Style.css -->
    <link rel="stylesheet" href="style.css" type="text/css"/>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  </head>
  <body>
        <div class="background">

        <img class="bgImg" src="img/index.png" alt=""/>

        <style>

            @keyframes jumpDown {
                0% {top:0px;}
                50% {top:10px;}
                100% {top:0px;}
            }

            .scrollButton {
                animation: jumpDown 1s infinite;
                margin:0 auto;
                position:relative;
            }

            .inputRadioRectangle ~ label {
                width:250px;
            }

            .inputSelect {
                overflow:hidden;
                transition: height 0.5s ease;
                color:white;
                appearance: none;
                background-color:rgba(255,255,255,0);
                border: 1px solid white;
                border-radius:25px;
                padding:10px;
                width:290px;
                height:45px;
                margin:auto;
                cursor:pointer;
            }

            .selectOptions {
                visibility:hidden;
                filter:blur(10px);
            }

            .inputSelect:hover .labelSelect {
                display:none;
            }

            .inputSelect:hover .selectOptions {
                transition: filter 0.5s ease;
                visibility:visible;
                filter:blur(0px);
            }

            @keyframes bounceMessage {
                0% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,0)}
                10% {left:-65px;box-shadow:0px 0px 8px rgba(255,255,255,1)}
                20% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,0)}
                30% {left:-65px;box-shadow:0px 0px 8px rgba(255,255,255,1)}
                40% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,0)}
                50% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,1)}
                60% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,0)}
                70% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,1)}
                80% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,0)}
                90% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,1)}
                100% {left:-85px;box-shadow:0px 0px 8px rgba(255,255,255,0)}
            }

            #messagesPopUp {
                transition:background 0.5s ease;
                position:fixed;
                cursor:pointer;
                left:-85px;
                top:80px;
                padding-right:20px;
                padding-left:100px;
                border:1px solid white;
                border-radius:10px;
                background-color:rgba(0,0,0,0.3);
                animation:bounceMessage 6s infinite;
            }

            #messagesPopUp:hover {
                background-color:rgba(0,0,0,0.7);
            }

        </style>

        <script>
            function scrollButton(y) {
                $("html,body").animate({scrollTop:y}, 600, 'swing');
            }
        </script>

        <?php
            $SQL = "SELECT COUNT(ID_message) as nonlus FROM messages WHERE lu='0' AND destinataire='".$_SESSION['id']."';";
            $req = $db->query($SQL);
            $row = $req->fetch();
            if ($row['nonlus'] != 0) {
                echo '<div id="messagesPopUp" onclick="document.location=\'messages.php\';">'
                    .'<h4 style="color:#ff8c1a"><span style="font-size:40px;">'.$row['nonlus'].'</span> <span style="margin-left:3px;"class="glyphicon glyphicon-envelope" aria-hidden="true"></span></h4>'
                .'</div>';
            }
        ?>

        <!-- Bienvenue -->
		<div class="centerDiv" style="top:120px;width:70%;">

                    <?php
					  echo '<h3 style="font-style:italic;">Bienvenue, <span style="color:#ff8c1a;">'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</span></h3>'
                        .'<h4>Login : <span style="color:#ff8c1a;">'.$_SESSION['username'].'</span></h4>'
                        .'<h4>Session : <span style="color:#ff8c1a;">'.$_SESSION['type'].'</span></h4>';
                    ?>
        </div>
        <div style="position:absolute;top:455px;width:100%;height:50px;display:inline-block;text-align:center;" ><div class="buttonClassic scrollButton" onclick="scrollButton(720)"><h4 style="padding-right:2px;padding-top:2px;"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></h4><h5 style="position:relative;top:4px;right:3px">Chiffres</h5></div></div>

        <!-- Chiffres -->
        <div class="centerDiv" style="top:800px;width:70%;">
                    <?php
                        echo '<h2 style="color:#ff8c1a;">Quelques chiffres</h2><br/>';
                        //Selection hopital
                        $req = $db->prepare("SELECT ID,Nom FROM hopital;");
                        $req->execute();
                        echo '<div class="inputSelect">'
                        .'<h5 class="labelSelect" id="labelHopital" style="margin:3px;">Tous les sites</h5>'
                        .'<div class="selectOptions">'
                        .'<div><input type="radio" id="hopital0" name="hopital" value="0" class="inputRadioRectangle" checked="checked"/><label for="hopital0" onclick="onSelectChange(0, \'Tous les sites\')"><h5>Tous les sites</h5></label></div>';
                        while ($row = $req->fetch())
                            echo '<div><input type="radio" id="hopital'.$row['ID'].'" name="hopital" value="'.$row['ID'].'" class="inputRadioRectangle"/><label for="hopital'.$row['ID'].'" onclick="onSelectChange('.$row['ID'].',\''.$row['Nom'].'\')"><h5>'.$row['Nom'].'</h5></label></div>';
                        echo '</div>'
                        .'</div>';
                        //Taille automatique qui dépend du nombre d'hôpitaux
                        $req = $db->prepare("SELECT count(ID) as count FROM hopital;");
                        $req->execute();
                        $row = $req->fetch();
                        //h = selectPadding + nb*(optionMargin+optionHeight)
                        $h = 20+($row['count']+1)*(6+40);
                        echo '<style>'
                        .'.inputSelect:hover {'
                            .'height:'.$h.'px;'
                        .'}'
                        .'</style>';
                    ?>
                        <script>
                            function onSelectChange(id,nom) {
                                document.getElementById('labelHopital').innerHTML=nom;
                                $.post("index.php", {idhopital:id}, function (res){ document.getElementById("chiffres").innerHTML=res;});
                            }
                        </script>
                        <div id="chiffres" style="margin-top:40px;">
                            <?php chiffres(0,$db); ?>
                        </div>

		</div>

        <div class="goTopButton" onclick="scrollButton(0)"><h4 style="padding-right:2px;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></h4></div>

        <!-- Uniquement pour que la dernière div ne soit pas collée en bas -->
        <div class="centerDiv" style="top:1800px;visibility:hidden;"></div>

        <?php
            nav("Accueil");
        ?>
    </div>
  </body>
</html>
