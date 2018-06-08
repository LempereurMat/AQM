<?php
include "config.php";
include "function.php";

if (!isset($_SESSION['username'])){
    header('location: login.php');
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

        .centerDiv {
            padding:0px;
            transition:box-shadow 0.5s ease;
            overflow:hidden;
        }

        #leftMenu {
            text-align:center;
            transition:left 0.8s ease;
            position:fixed;
            left:-20%;
            width:20%;
            background-color:rgba(0,0,0,0.5);
            height:100%;
            //border-right:1px solid #ff8c1a;
        }

        #leftMenu:hover {
            left:0%;
        }

        #leftMenu .hoverPart {
            z-index:-2;
            transition: background-color 0.8s ease, color 0.8s ease;
            position:absolute;
            right:-60px;
            height:100%;
            width:60px;
            background-color: rgba(255,255,255,0.2);
            font-size:45px;
            padding:10px;
        }

        #leftMenu:hover .hoverPart {
            background-color:rgba(255,255,255,0);
            color:rgba(255,255,255,0);
        }

        #leftMenu #leftMenu1 {
            position:relative;
            overflow-y:auto;
            direction:rtl;
            right:20%;
            width:120%;
            height:90%;
            padding-left:15px;
            padding-bottom:150px;
        }

        .attributDrag {
            direction:ltr;
            cursor:pointer;
            transition:background-color 0.5s ease;
            background-color:rgba(0,0,0,0);
            padding:5px;
            margin-top:2px;
            margin-bottom:2px;
        }

        .attributDrag:hover {
            background-color:rgba(0,0,0,0.5);
        }

        td {
            cursor:pointer;
            transition:background-color 0.5s ease;
            background-color:rgba(0,0,0,0);
        }

        td:hover {
            background-color:rgba(0,0,0,0.5);
        }

        td input[type="text"] {
            text-align:center;
            width:100%;
            height:100%;
            margin:0px;
            border: none;
            transition:background-color 0.5s ease;
            background-color:rgba(255,255,255,0);
        }

        td input[type="text"]:focus {
            outline:none;
            background-color:rgba(255,255,255,0.3);
        }

        input[type="radio"] {
            display:none;
        }

        input[type="radio"] + label {
            cursor:pointer;
            transition:color 0.5s ease;
            color:rgba(255,255,255,0.15);
            margin:5px;
        }

        input[type="radio"]:checked + label {
            color:rgba(255,255,255,1);
        }

        input[type="radio"]:hover + label {
            color:rgba(255,255,255,0.5);
        }

        @keyframes swipeDown {
            0% {top:-60%}
            100% {top:0px}
        }

        @keyframes swipeUp {
            0% {bottom:-60%}
            100% {bottom:0px}
        }

        @keyframes fadeIn {
            0% {opacity:0}
            100% {opacity:100}
        }

	@keyframes loadingIcon {
	    0% {transform:rotate(0deg)}
	    100% {transform:rotate(360deg)}
	}

        .option {
            cursor:pointer;
            transition:color 1s ease, background-color 1s ease;
            height:100%;
            flex:1;
            background-color:rgba(0,0,0,0.8);
            text-align:center;
            padding:30px;
        }

        .option:hover {
            background-color:rgba(255,255,255,0.3);
            color:rgba(255,255,255,1);
        }

    </style>

<script>

    function scrollButton(y) {
        $("html,body").animate({scrollTop:y}, 600, 'swing');
    }

    var listSelect = Array();
    var listWhere = Array();

    //Lorsqu'un attribut commence à être déplacé, on ajoute une donnée à ce transfert (son nom)
    function dragStart(e) {
        e.dataTransfer.setData("text", e.target.id);
    }

    //Lorsqu'un attribut est au dessus de la div, mais sans qu'il soit déposé
    function dragOver(e,id) {
        e.preventDefault();
        document.getElementById(id).style.boxShadow="0 0 15px rgba(255,255,255,1)";
    }

    //Lorsqu'un attribut quitte la div, mais qu'il n'a pas été déposé
    function dragLeave(e,id) {
        document.getElementById(id).style.boxShadow = "0 0 15px rgba(255,255,255,0)";
    }

    //Lorsqu'un attribut est déposé dans la div
    function drop(e,id) {
        e.preventDefault();
        document.getElementById(id).style.boxShadow = "0 0 15px rgba(255,255,255,0)";
        //data est l'id de l'attribut dropé
        var data = e.dataTransfer.getData("text");
        var attributText = document.getElementById(data).innerHTML;
        //listId est soit selectBox-[...] ou whereBox-[...]
        var listId = id + "-" + data;
        if (id=="selectBox" && !listSelect.includes(listId)) {
            var innerHTML = "<tr id='"+listId+"'>"
                +"<th>"+attributText+"</th>"
                +"<td style='width:15px' onclick='document.getElementById(\""+listId+"\").remove(); listSelect.splice(listSelect.indexOf(\""+listId+"\"),1)'><span style='margin:7px;' class='glyphicon glyphicon-trash' aria-hidden='true'></span></td></tr>";
            document.getElementById("selectBoxElements").innerHTML += innerHTML;
            listSelect.push(listId);
        } else if (id=="whereBox" && !listWhere.includes(listId)) {
            
            var row = document.getElementById("whereBoxElements").insertRow(-1);
            row.setAttribute('id', listId);
            
            var cellAttribut = row.insertCell(0);
            cellAttribut.innerHTML = attributText;
            
            if (data=="pathologies.cote") {
                var cellCote = row.insertCell(1);
                cellCote.setAttribute('colspan', 2);
                cellCote.innerHTML = "<input type='radio' id='radioGAUCHE-"+listId+"' name='radio-"+listId+"' value='1'/><label for='radioGAUCHE-"+listId+"'>GAUCHE</label>"
                +"<input type='radio' id='radioBI-"+listId+"' name='radio-"+listId+"' value='3' checked/><label for='radioBI-"+listId+"'>BILATERAL</label>"
                +"<input type='radio' id='radioDROIT-"+listId+"' name='radio-"+listId+"' value='2'/><label for='radioDROIT-"+listId+"'>DROIT</label>";
                var cellRemove = row.insertCell(2);
            }
            else if (data=="pathologies.patho") {
                var cellPatho = row.insertCell(1);
                cellPatho.innerHTML = "<input type='radio' id='radioHEMIPLEGIE-"+listId+"' name='radio-"+listId+"' value='Hemiplegie' checked/><label for='radioHEMIPLEGIE-"+listId+"'>Hemiplégie</label>"
                +"<input type='radio' id='radioDIPLEGIE-"+listId+"' name='radio-"+listId+"' value='Diplegie'/><label for='radioDIPLEGIE-"+listId+"'>Diplégie</label>"
                +"<input type='radio' id='radioTETRAPLEGIE-"+listId+"' name='radio-"+listId+"' value='Tetraplegie'/><label for='radioTETRAPLEGIE-"+listId+"'>Tétraplegie</label>"
                +"<input type='radio' id='radioTRIPLEGIE-"+listId+"' name='radio-"+listId+"' value='Triplegie'/><label for='radioTRIPLEGIE-"+listId+"'>Triplégie</label>"
                +"<input type='radio' id='radioMYOGENES-"+listId+"' name='radio-"+listId+"' value='Myogenes'/><label for='radioMYOGENES-"+listId+"'>Myogènes</label>"
                +"<input type='radio' id='radioORTHO-"+listId+"' name='radio-"+listId+"' value='Ortho'/><label for='radioORTHO-"+listId+"'>Ortho</label>"+"<br/>"
                +"<input type='radio' id='radioPARAPLEGIE-"+listId+"' name='radio-"+listId+"' value='Paraplegie'/><label for='radioPARAPLEGIE-"+listId+"'>Paraplégie</label>"
                +"<input type='radio' id='radioMUSCULAIRE-"+listId+"' name='radio-"+listId+"' value='Musculaire'/><label for='radioMUSCULAIRE-"+listId+"'>Musculaire</label>"
                +"<input type='radio' id='radioATAXIE-"+listId+"' name='radio-"+listId+"' value='Ataxie'/><label for='radioATAXIE-"+listId+"'>Ataxie</label>"
                +"<input type='radio' id='radioATTEINTE-"+listId+"' name='radio-"+listId+"' value='Atteinte'/><label for='radioATTEINTE-"+listId+"'>Atteinte</label>"
                +"<input type='radio' id='radioAUTRE-"+listId+"' name='radio-"+listId+"' value='Autre'/><label for='radioAUTRE-"+listId+"'>Autre</label>";
                cellPatho.setAttribute('colspan', 2);
                var cellRemove = row.insertCell(2);
            }
            else if (data=="patients.age") {
                var cellAge = row.insertCell(1);
                cellAge.innerHTML = "<input type='radio' id='radioEnfant-"+listId+"' name='radio-"+listId+"' value='Enfant' checked/><label for='radioEnfant-"+listId+"'>Enfant</label>"
                +"<input type='radio' id='radioAdulte-"+listId+"' name='radio-"+listId+"' value='Adulte'/><label for='radioAdulte-"+listId+"'>Adulte</label>";
                cellAge.setAttribute('colspan', 2);
                var cellRemove = row.insertCell(2);
            }
            else if (data=="conditionaqm.type_condition") {
                var cellCondition = row.insertCell(1);
                cellCondition.innerHTML = "<input type='radio' id='radioPieds-"+listId+"' name='radio-"+listId+"' value='Pieds Nus' checked/><label for='radioPieds-"+listId+"'>Pieds nus</label>"
                +"<input type='radio' id='radioChaussures-"+listId+"' name='radio-"+listId+"' value='Chaussures'/><label for='radioChaussures-"+listId+"'>Chaussures</label>";
                cellCondition.setAttribute('colspan', 2);
                var cellRemove = row.insertCell(2);
            }
			else if (data=="appareillage.type_appareillage") {
                var cellAppareillage = row.insertCell(1);
                cellAppareillage.innerHTML = "<input type='radio' id='radiosans-"+listId+"' name='radio-"+listId+"' value='Sans appareillage' checked/><label for='radiosans-"+listId+"'>Sans</label>"
                +"<input type='radio' id='radio1canne-"+listId+"' name='radio-"+listId+"' value='1 canne simple'/><label for='radio1canne-"+listId+"'>1 canne simple</label>"
                +"<input type='radio' id='radio2canne-"+listId+"' name='radio-"+listId+"' value='2 cannes simples'/><label for='radio2canne-"+listId+"'>2 cannes simples</label>"
                +"<input type='radio' id='radio1tripod-"+listId+"' name='radio-"+listId+"' value='1 canne tripod'/><label for='radio1tripod-"+listId+"'>1 canne tripod</label><br/>"
                +"<input type='radio' id='radio2tripod-"+listId+"' name='radio-"+listId+"' value='2 cannes tripod'/><label for='radio2tripod-"+listId+"'>2 cannes tripod</label>"
                +"<input type='radio' id='radiodeambulant-"+listId+"' name='radio-"+listId+"' value='Déambulateur antérieur'/><label for='radiodeambulant-"+listId+"'>Déambulateur antérieur</label>"
                +"<input type='radio' id='radiodeambulpost-"+listId+"' name='radio-"+listId+"' value='Déambulateur postérieur'/><label for='radiodeambulpost-"+listId+"'>Déambulateur postérieur</label>"
                +"<input type='radio' id='radioorthese-"+listId+"' name='radio-"+listId+"' value='Orthèse'/><label for='radioorthese-"+listId+"'>Orthèse</label>"
				+"<input type='radio' id='radiobande-"+listId+"' name='radio-"+listId+"' value='Bande de dérotation'/><label for='radiobande-"+listId+"'>Bande de dérotation</label>"
				+"<input type='radio' id='radioprothese-"+listId+"' name='radio-"+listId+"' value='Prothèse'/><label for='radioprothese-"+listId+"'>Prothèse</label>"
				+"<input type='radio' id='radioaide-"+listId+"' name='radio-"+listId+"' value='Aide'/><label for='radioaide-"+listId+"'>Aide</label>"
				+"<input type='radio' id='radiocorset-"+listId+"' name='radio-"+listId+"' value='Corset'/><label for='radiocorset-"+listId+"'>Corset</label>"
				+"<input type='radio' id='radiopompe-"+listId+"' name='radio-"+listId+"' value='Pompe'/><label for='radiopompe-"+listId+"'>Pompe</label>"
				+"<input type='radio' id='radiobloc-"+listId+"' name='radio-"+listId+"' value='Bloc'/><label for='radiobloc-"+listId+"'>Bloc</label>"
				+"<input type='radio' id='radioautre-"+listId+"' name='radio-"+listId+"' value='Autre'/><label for='radioautre-"+listId+"'>Autre</label>";
                cellAppareillage.setAttribute('colspan', 2);
                var cellRemove = row.insertCell(2);
            }
            else if (data=="traitement.SousTypeTraitement_ID") {
                var cellTraitement = row.insertCell(1);
                cellTraitement.innerHTML = "<input type='radio' id='radioBotox-"+listId+"' name='radio-"+listId+"' value='1' checked/><label for='radioBotox-"+listId+"'>Botox</label>"
                +"<input type='radio' id='radioDysport-"+listId+"' name='radio-"+listId+"' value='2'/><label for='radioDysport-"+listId+"'>Dysport</label>"
                +"<input type='radio' id='radioAponevrotomie-"+listId+"' name='radio-"+listId+"' value='3'/><label for='radioAponevrotomie-"+listId+"'>Aponévrotomie</label>"
                +"<input type='radio' id='radioAllongement-"+listId+"' name='radio-"+listId+"' value='4'/><label for='radioAllongement-"+listId+"'>Allongement</label><br/>"
                +"<input type='radio' id='radioDerotation-"+listId+"' name='radio-"+listId+"' value='5'/><label for='radioDerotation-"+listId+"'>Dérotation</label>"
                +"<input type='radio' id='radioAbaissement-"+listId+"' name='radio-"+listId+"' value='6'/><label for='radioAbaissement-"+listId+"'>Abaissement</label>"
                +"<input type='radio' id='radioEpiphysiodese-"+listId+"' name='radio-"+listId+"' value='7'/><label for='radioEpiphysiodese-"+listId+"'>Epiphysidèse</label>"
                +"<input type='radio' id='radioDesinsertion-"+listId+"' name='radio-"+listId+"' value='8'/><label for='radioDesinsertion-"+listId+"'>Désintertion</label>";
                cellTraitement.setAttribute('colspan', 2);
                var cellRemove = row.insertCell(2);
            }
            else {
                var cellType = row.insertCell(1);
                cellType.innerHTML = "<input type='radio' id='radioEQUALS-"+listId+"' name='radio-"+listId+"' value='EQUALS' checked/><label for='radioEQUALS-"+listId+"'>EQUALS</label>"
                +"<input type='radio' id='radioLIKE-"+listId+"' name='radio-"+listId+"' value='LIKE'/><label for='radioLIKE-"+listId+"'>LIKE</label>"
                +"<input type='radio' id='radioBETWEEN-"+listId+"' name='radio-"+listId+"' value='BETWEEN'/><label for='radioBETWEEN-"+listId+"'>BETWEEN</label>";
                var cellInput = row.insertCell(2);
                cellInput.innerHTML = "<input type='text' id='input-"+listId+"' spellcheck='false'/>";
                var cellRemove = row.insertCell(3);
            }
            
            cellRemove.setAttribute('style', 'width:15px');
            cellRemove.setAttribute('onclick', 'document.getElementById("'+listId+'").remove();listWhere.splice(listWhere.indexOf("'+listId+'"),1);');
            cellRemove.innerHTML = "<span style='margin:7px;' class='glyphicon glyphicon-trash' aria-hidden='true'></span>";
            listWhere.push(listId);
        }
        
    }

    function lancerRecherche() {
        var listSelectToSend = Array();
        var listWhereToSend = new Array();
        //Attributs à selectionner SELECT
        for (var i in listSelect) {
            //Recuperer la table et l'attribut
            listSelectToSend.push({attribut: listSelect[i].split("-")[1]});
        }
        //Conditions WHERE
        for (var i in listWhere) {
            //Recuperer la table et l'attribut
            var a = listWhere[i].split("-")[1];
			var v = 0;
            var t = "";
            if (a=="patients.age" || a=="pathologies.patho" || a=="pathologies.cote" || a=="conditionaqm.type_condition" || a=="traitement.SousTypeTraitement_ID" || a=="appareillage.type_appareillage")
            {
                t = "E";
                var radio = document.getElementsByName("radio-"+listWhere[i]);
                for (var i = 0 ; i<radio.length ; i++)
                    if (radio[i].checked)
                        v=radio[i].value;
            }
			
            else
            {
                v = document.getElementById("input-"+listWhere[i]).value;
                if (document.getElementById("radioEQUALS-"+listWhere[i]).checked)
                    t = "E";
                else if (document.getElementById("radioLIKE-"+listWhere[i]).checked)
                    t = "L";
                else if (document.getElementById("radioBETWEEN-"+listWhere[i]).checked)
                    t = "B";
            }
            listWhereToSend.push({attribut: a, value: v, type: t});
        }
        if (listSelectToSend.length != 0) {
	    document.getElementById("searchButton").innerHTML='<span class="glyphicon glyphicon-refresh" aria-hidden="true" style="animation: loadingIcon 1s linear infinite"></span>';
            $.post("reqInteractive.php",
                   {data: JSON.stringify({select: listSelectToSend, where: listWhereToSend})},
                   function(res) {
                   document.getElementById("searchResult").innerHTML = res;
		   scrollButton(document.getElementById("researchContainer").offsetTop + document.getElementById("searchResult").offsetTop-50);
		   document.getElementById("searchButton").innerHTML='Chercher';
                   }
            );
        }
    }

    function exportChecked(option) {
        var consults = "";
        var checkboxes = document.getElementsByName('checkbox');
        for (var i=0 ; i<checkboxes.length ; i=i+1) {
            if (checkboxes[i].checked)
                consults+=checkboxes[i].id.split('-')[2]+',';
        }
        consults = consults.substr(0,consults.lastIndexOf(','));
        if (consults != "") {
            document.getElementById('consult').value = consults;
            document.getElementById('options').value = option;
            document.getElementById('formExport').submit();
        }
        $('#exportMenu').animate({bottom:'0%'}, 700);
    }

</script>

    <div class="background">
        <img class="bgImg" src="img/index.png" alt=""/>

        <div id="dropZonesDiv" style="position:absolute;width:80%;height:80%;top:5%;left:0px;right:0px;margin:auto;">
            <div class="centerDiv" style="width:85%;top:0px;height:45%;animation:swipeDown 1.5s ease;" id="selectBox" ondragover="dragOver(event,'selectBox')" ondragleave="dragLeave(event,'selectBox')" ondrop="drop(event,'selectBox')">
                <div style="position:absolute;overflow-y:scroll;width:100%;height:100%;left:20px;padding-bottom:20px;">
                    <h3 style="color:#ff8c1a;">JE CHERCHE ...</h3>
                    <table id="selectBoxElements" style="width:50%;left:0px;right:0px;margin:auto;font-size:15px;">
                    </table>
                </div>
            </div>

            <div class="buttonClassic" style="position:absolute;width:150px;border-radius:15px;left:0px;right:0px;margin:auto;text-align:center;top:46%;height:8%;animation:fadeIn 3s ease;" onclick="lancerRecherche();"><h4 id="searchButton" style="margin:7px">Chercher</h4></div>

            <div class="centerDiv" style="width:85%;bottom:0px;height:45%;animation:swipeUp 1.5s ease;" id="whereBox" ondragover="dragOver(event,'whereBox')" ondragleave="dragLeave(event,'whereBox')" ondrop="drop(event,'whereBox')">
                <div style="position:absolute;overflow-y:scroll;width:100%;height:100%;left:20px;padding-bottom:20px;">
                    <h3 style="color:#ff8c1a;">AVEC ...</h3>
                    <table id="whereBoxElements" style="width:90%;left:0px;right:0px;margin:auto;font-size:15px;">
                    </table>
                </div>
            </div>

        </div>

        <div id="researchContainer" style="position:absolute;width:90%;top:800px;left:8%;margin:auto;">
            <div id="searchResult" class="centerDiv" style="position:static;width:100%;margin-bottom:350px;padding:20px;overflow-x:auto;">
                <h4>Résultat de la recherche</h4>
            </div>

            <!-- Pour ne pas coller au bottom -->
            <div class="centerDiv" style="position:static;width:100%;visibility:hidden;"></div>
        </div>

        <div id="leftMenu">
            <div class="hoverPart">R E C H E R C H E</div>
            <div id="leftMenu1">
            <h5 style="border-bottom:1px solid rgba(255,255,255,0.2);padding-bottom:10px;">Glisser-déposer</h5>
            <h4 style="color:#ff8c1a;">Exportation</h4>
                <h5 draggable="true" class="attributDrag" id="export.ConsultationsParPatient" ondragstart="dragStart(event);">Consultations par patient</h5>
            <h4 style="color:#ff8c1a;">Patient</h4>
                <h5 draggable="true" class="attributDrag" id="patients.ID_patient" ondragstart="dragStart(event);">Dossier Patient</h5>
                <h5 draggable="true" class="attributDrag" id="patients.nom" ondragstart="dragStart(event);">Nom</h5>
                <h5 draggable="true" class="attributDrag" id="patients.prenom" ondragstart="dragStart(event);">Prénom</h5>
                <h5 draggable="true" class="attributDrag" id="patients.IPP" ondragstart="dragStart(event);">IPP</h5>
                <h5 draggable="true" class="attributDrag" id="patients.date_naissance" ondragstart="dragStart(event);">Date de naissance</h5>
                <h5 draggable="true" class="attributDrag" id="patients.ageNumeric" ondragstart="dragStart(event);">Age</h5>
                <h5 draggable="true" class="attributDrag" id="patients.age" ondragstart="dragStart(event);">Enfant/Adulte</h5>
            <h4 style="color:#ff8c1a;">Pathologie</h4>
                <h5 draggable="true" class="attributDrag" id="pathologies.patho" ondragstart="dragStart(event);">Pathologie</h5>
                <h5 draggable="true" class="attributDrag" id="pathologies.cote" ondragstart="dragStart(event);">Côté</h5>
            <h4 style="color:#ff8c1a;">Traitement</h4>
                <h5 draggable="true" class="attributDrag" id="traitement.SousTypeTraitement_ID" ondragstart="dragStart(event);">Type</h5>
            <h4 style="color:#ff8c1a;">Consultation</h4>
                <h5 draggable="true" class="attributDrag" id="consultation.ID" ondragstart="dragStart(event);">ID Consultation</h5>
                <h5 draggable="true" class="attributDrag" id="consultation.Date_consultation" ondragstart="dragStart(event);">Date</h5>
                <h5 draggable="true" class="attributDrag" id="conditionaqm.type_condition" ondragstart="dragStart(event);">Condition</h5>
				<h5 draggable="true" class="attributDrag" id="appareillage.type_appareillage" ondragstart="dragStart(event);">Appareillage</h5>
				
            <h4 style="color:#ff8c1a;">Bilan clinique</h4>
                <h5 class="attributDrag attributSecondMenu">Hanche <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Hanche</h4>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Flexion_Hanche" ondragstart="dragStart(event);">Flexion hanche</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Extension_Genou_0" ondragstart="dragStart(event);">Extension Genou 0°</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Extension_Genou_90" ondragstart="dragStart(event);">Extension Genou 90°</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Abduction_FH_FG" ondragstart="dragStart(event);">Abduction FH/FG</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Abduction_EH_EG" ondragstart="dragStart(event);">Abduction EH/EG</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Adduction_Hanche" ondragstart="dragStart(event);">Adduction Hanche</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Rot_Int_Hanche" ondragstart="dragStart(event);">Rot. Int. Hanche</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Rot_Ext_Hanche" ondragstart="dragStart(event);">Rot. Ext. Hanche</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Psoas" ondragstart="dragStart(event);">Force Psoas</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Grand_Fessier" ondragstart="dragStart(event);">Force Grand Fessier</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Moyen_Fessier" ondragstart="dragStart(event);">Force Moyen Fessier</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Adducteur" ondragstart="dragStart(event);">Force Adducteur</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Ashworth_Adducteur" ondragstart="dragStart(event);">Ashworth Adducteur</h5>
                    </div>
                </h5>
                <h5 class="attributDrag attributSecondMenu">Genou <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Genou</h4>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Flexion_Genou" ondragstart="dragStart(event);">Flexion genou</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Extension_Genou" ondragstart="dragStart(event);">Extension Genou</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Angle_Poplite" ondragstart="dragStart(event);">Angle poplite</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Ischio_Jambier" ondragstart="dragStart(event);">Force Ischio Jambier</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Quadriceps" ondragstart="dragStart(event);">Force Quadriceps</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Ashworth_Ischio_Jambier" ondragstart="dragStart(event);">Ashworth Ischio Jambier</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Ashworth_Quadriceps" ondragstart="dragStart(event);">Ashworth Quadriceps</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Tardieu_Quadriceps" ondragstart="dragStart(event);">Tardieu Quadriceps</h5>
                    </div>
                </h5>
                <h5 class="attributDrag attributSecondMenu">Cheville <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Cheville</h4>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Flexion_Cheville_EG" ondragstart="dragStart(event);">Flexion_Genou_EG</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Flexion_Cheville_FG" ondragstart="dragStart(event);">Flexion_Genou_FG</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Adductus_Abductus_Avant_Pied" ondragstart="dragStart(event);">Adductus/Abductus Av. Pied</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Valgus_Varus_Calcaneum" ondragstart="dragStart(event);">Valgus Varus Calcaneum</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Axe_Cuisse_Pied" ondragstart="dragStart(event);">Axe Cuisse Pied</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Tibialis_Anterior" ondragstart="dragStart(event);">Force Tibialis Anterior</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Tibialis_Posterior" ondragstart="dragStart(event);">Force Tibialis Posterior</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Gastroc" ondragstart="dragStart(event);">Force Gastroc</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Force_Peroneus" ondragstart="dragStart(event);">Force Peroneus</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Ashworth_Tibialis_Anterior" ondragstart="dragStart(event);">Ashworth Tibialis Anterior</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Ashworth_Tibialis_Posterior" ondragstart="dragStart(event);">Ashworth Tibialis Posterior</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Ashworth_Gastroc" ondragstart="dragStart(event);">Ashworth Gastroc</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Ashworth_Peroneus" ondragstart="dragStart(event);">Ashworth Peroneus</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Tardieu_Tibialis_Posterior" ondragstart="dragStart(event);">Tardieu Tibialis Posterior</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Tardieu_Gastroc" ondragstart="dragStart(event);">Tardieu Gastroc</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Tardieu_Peroneus" ondragstart="dragStart(event);">Tardieu Peroneus</h5>
                    </div>
                </h5>
                <h5 class="attributDrag attributSecondMenu" id="bilancliniqueanomalies">Anomalies <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Anomalies</h4>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.ILMI" ondragstart="dragStart(event);">ILMI</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Anteversion" ondragstart="dragStart(event);">Anteversion</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Axe_Bimalleolaire" ondragstart="dragStart(event);">Axe Bimalleolaire</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Rotule_Haute" ondragstart="dragStart(event);">Rotule_Haute</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Dislocation_Medio_Tarsienne" ondragstart="dragStart(event);">Dislocation Medio-Tarsienne</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.Gibbosite" ondragstart="dragStart(event);">Gibbosite</h5>
                        <h5 draggable="true" class="attributDrag" id="bilan_clinique.ElyTest" ondragstart="dragStart(event);">ElyTest</h5>
                    </div>
                </h5>
            <h4 style="color:#ff8c1a;">Bilan fonctionnel</h4>
                <h5 draggable="true" class="attributDrag" id="bilanfonctionnel.Classe_FAC" ondragstart="dragStart(event);">Classe FAC</h5>
                <h5 draggable="true" class="attributDrag" id="bilan_fonctionnel.Niveau_Palisano" ondragstart="dragStart(event);">Niveau Palisano</h5>
                <h5 draggable="true" class="attributDrag" id="bilan_fonctionnel.Perimetre_marche" ondragstart="dragStart(event);">Perimetre Marche</h5>
                <h5 draggable="true" class="attributDrag" id="bilan_fonctionnel.Aides_Techniques" ondragstart="dragStart(event);">Aides Techniques</h5>
                <h5 draggable="true" class="attributDrag" id="bilan_fonctionnel.Eval_fonc_gillette" ondragstart="dragStart(event);">Eval Gillette</h5>
                <h5 draggable="true" class="attributDrag" id="bilan_fonctionnel.Echelle_mobilite_fonc_5m" ondragstart="dragStart(event);">Mobilité 5m</h5>
                <h5 draggable="true" class="attributDrag" id="bilan_fonctionnel.Echelle_mobilite_fonc_50m" ondragstart="dragStart(event);">Mobilité 50m</h5>
                <h5 draggable="true" class="attributDrag" id="bilan_fonctionnel.Echelle_mobilite_fonc_500m" ondragstart="dragStart(event);">Mobilité 500m</h5>
            <h4 style="color:#ff8c1a;">EOS</h4>
                <h5 class="attributDrag attributSecondMenu">Longueurs <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Longueurs</h4>
                        <h5 draggable="true" class="attributDrag" id="eos.Long_Femur" ondragstart="dragStart(event);">Fémur</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Long_Tibia" ondragstart="dragStart(event);">Tibia</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Long_Fonct" ondragstart="dragStart(event);">Fonctionnelle</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Long_Anat" ondragstart="dragStart(event);">Anatomique</h5>
                    </div>
                </h5>
                <h5 class="attributDrag attributSecondMenu">Fémur <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Fémur</h4>
                        <h5 draggable="true" class="attributDrag" id="eos.Diam_TF" ondragstart="dragStart(event);">Diamètre tête fémorale</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Offset_Femur" ondragstart="dragStart(event);">Offset Fémoral</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Long_Col_Fem" ondragstart="dragStart(event);">Longueur Col</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Neck_Shaft_Angle" ondragstart="dragStart(event);">Angle cervico-diaphysaire</h5>
                    </div>
                </h5>
                <h5 class="attributDrag attributSecondMenu">Genou <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Genou</h4>
                        <h5 draggable="true" class="attributDrag" id="eos.Knee_Varus" ondragstart="dragStart(event);">Varus/Valgus</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Knee_Flessum" ondragstart="dragStart(event);">Flessum/Recurvatum</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Angle_Fem_Meca" ondragstart="dragStart(event);">Angle fémoral</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Angle_Tib_Meca" ondragstart="dragStart(event);">Angle tibial</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.HKS" ondragstart="dragStart(event);">HKS</h5>
                    </div>
                </h5>
                <h5 class="attributDrag attributSecondMenu">Torsion <span style="float:right" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <div class="secondMenu">
                        <h4 style="color:#ff8c1a;">Torsion</h4>
                        <h5 draggable="true" class="attributDrag" id="eos.Torsion_Fem" ondragstart="dragStart(event);">Fémorale</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Torsion_Tib" ondragstart="dragStart(event);">Tibiale</h5>
                        <h5 draggable="true" class="attributDrag" id="eos.Rot_Fem_Tib" ondragstart="dragStart(event);">Rotation Fémoro-Tibiale</h5>
                    </div>
                </h5>
            </div>
        </div>

<style>

.attributSecondMenu .secondMenu {
    z-index:-1;
    position:fixed;
    background-color:rgba(0,0,0,0.5);
    text-align:center;
    top:60px;
    left:-20%;
    width:20%;
    height:100%;
    opacity:0;
    border-right:1px solid #ff8c1a;
    border-left:1px solid #ff8c1a;
    transition: opacity 1s ease, left 0.7s ease;
}

.attributSecondMenu:hover .secondMenu {
    opacity:1;
    left:20%;
}

</style>

        <div class="buttonClassic" style="position:fixed;right:20px;bottom:20px;" onclick="scrollButton(0);">
            <h4><span class="glyphicon glyphicon-arrow-up" style="position:relative;left:10px;"></span></h4>
        </div>

        <div id="exportMenu" style="position:fixed;width:100%;height:30%;bottom:-30%;display:flex;">
            <form id="formExport" action="export_c3d.php" method="post" target="_blank">
                <input type="hidden" id="consult" name="consult" value=""/>
                <input type="hidden" id="options" name="option" value="0"/>
            </form>
            <div class="option" onclick="exportChecked(0);"><h4>Tous les cycles</h4></div>
			<?php if ($_SESSION['type']=="Administrator") echo '<div class="option" onclick="exportChecked(4);"><h4>Tous les cycles (min(NbCycleGa,NbCycleDr))</h4></div>';?>
            <div class="option" onclick="exportChecked(1);"><h4>Moyenne de chaque session</h4></div>
            <div class="option" onclick="exportChecked(2);"><h4>Moyenne de tous les cycles</h4></div>
            <div class="option" onclick="$('#exportMenu').animate({bottom:'-30%'}, 700);"><h4>Annuler</h4></div>
        </div>

        <?php
            nav("Recherche");
        ?>

    </div>

  </body>
</html>
