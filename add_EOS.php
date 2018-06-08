<?php
include "config.php";
include "function.php";

    if (!isset($_SESSION['username'])){
        exit();
    }
    
if(isset($_POST["id"])) {
	$sID = $_POST["id"];
    $SQL = "SELECT hopital_ID FROM patients WHERE ID_patient='".$sID."';";
    $req = $db->query($SQL);
    $row = $req->fetch();
    $nHopital = $row['hopital_ID'];
    if (!($_SESSION['type']=="Administrator" || ($_SESSION['type']=="Manager" && $_SESSION['id_hopital']==$nHopital)))
        exit();
}
else exit();

    
$SQL = "SELECT * FROM hopital";
$req = $db->query($SQL);
$aHopital = array();
while($row = $req->fetch()) $aHopital[$row['ID']] = $row;
    
?>

<style>

    .dateText {
        height:40px;
        width:15%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border: 1px solid white;
        border-radius:25px;
    }

    .dateText:focus {
        outline:none;
        box-shadow:none;
        background-color:rgba(0,0,0,0.4);
    }

    .selectOptions {
        visibility:hidden;
        filter:blur(10px);
    }

    .inputSelect {
        transition: width 0.5s ease, height 0.5s ease;
        color:white;
        appearance: none;
        background-color:rgba(255,255,255,0);
        border: 1px solid white;
        border-radius:25px;
        padding:10px;
        width:200px;
        height:45px;
        margin:auto;
        cursor:pointer;
    }

    .inputSelect:hover .labelSelect  {
        display:none;
    }

    .inputSelect:hover .selectOptions {
        transition: filter 0.5s ease;
        visibility:visible;
        filter:blur(0px);
    }

    .EOSText {
        height:30px;
        width:100%;
        text-align:center;
        color:white;
        background-color:rgba(255,255,255,0);
        transition:background-color 0.5s ease;
        border-color:rgba(0,0,0,0);
        border:none;
    }

    .EOSText:focus {
        outline:none;
        box-shadow:none;
        border:none;
        background-color:rgba(255,255,255,0.3);
    }

</style>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>

<h3 style="white">Ajouter une <span style="color:#ff8c1a;">EOS</span></h3><br/>

<form id="formAddEOS" method="post" action="post_patient.php">
<input type="hidden" name="id" value="<?php echo $sID; ?>"/>
<input type="hidden" name="p_AddEOS" value="<?php echo $sID; ?>"/>

<h5 style="color:#ff8c1a">Date<h5>
<input type="text" class="dateText" id="date" name="date" placeholder="JJ/MM/AAAA"><br/><br/>

<h5 style="color:#ff8c1a">CHU</h5>

<div id="inputSelectHopital" class="inputSelect" style="overflow:hidden;width:300px;">
<?php
    echo '<h5 class="labelSelect" id="labelHopital" style="margin:3px;">Selectionner</h5>'
    .'<div class="selectOptions">';
    if ($_SESSION['type']=="Manager") {
        echo '<div><input type="radio" id="hopitalManager" name="hopital" value="0" class="inputRadioRectangle"/><label style="width:250px" for="hopitalManager" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$aHopital[$_SESSION['id_hopital']]['Nom'].'\'"><h5>'.$aHopital[$_SESSION['id_hopital']]['Nom'].'</h5></label></div>'
        .'</div>'
        .'<style>'
        .'#inputSelectHopital:hover {'
        .'height: 68px;'
        .'}'
        .'</style>';
    }
    else {
        foreach (array_keys($aHopital) as $id) {
            $nom = $aHopital[$id]['Nom'];
            echo '<div><input type="radio" id="hopital'.$id.'" name="hopital" value="'.$id.'" class="inputRadioRectangle"/><label style="width:250px" for="hopital'.$id.'" onclick="document.getElementById(\'labelHopital\').innerHTML=\''.$nom.'\'"><h5>'.$nom.'</h5></label></div>';
        }
        echo '</div>';
        //Taille automatique qui dépend du nombre d'hôpitaux
        //h = selectPadding + nb*(optionMargin+optionHeight)
        $h = 22+(count($aHopital))*(6+40);
        echo '<style>'
        .'#inputSelectHopital:hover {'
        .'height:'.$h.'px;'
        .'}'
        .'</style>';
    }
    ?>
</div><br/><br/>


			<table style="width:80%;left:0px;right:0px;margin:auto;">
			<thead>
				<tr>
					<th></th>
					<th>Droite</th>
					<th>Gauche</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th>Long. Femur</th>
				<td><input class="EOSText" type="text" name="p_Long_Femur_D"></td>
				<td><input class="EOSText" type="text" name="p_Long_Femur_G"></td>
			</tr>
			<tr>
				<th>Long. Tibia</th>
				<td><input class="EOSText" type="text" name="p_Long_Tibia_D"></td>
				<td><input class="EOSText" type="text" name="p_Long_Tibia_G"></td>
			</tr>
			<tr>	
				<th>Long. Fonct.</th>
				<td><input class="EOSText" type="text" name="p_Long_Fonct_D"></td>
				<td><input class="EOSText" type="text" name="p_Long_Fonct_G"></td>
			</tr>
			<tr>	
				<th>Long. Anat.</th>
				<td><input class="EOSText" type="text" name="p_Long_Anat_D"></td>
				<td><input class="EOSText" type="text" name="p_Long_Anat_G"></td>
			</tr>
			<tr>	
				<th>Diam. TF</th>
				<td><input class="EOSText" type="text" name="p_Diam_TF_D"></td>
				<td><input class="EOSText" type="text" name="p_Diam_TF_G"></td>
			</tr>
			<tr>	
				<th>Offset Fémur</th>
				<td><input class="EOSText" type="text" name="p_Offset_Femur_D"></td>
				<td><input class="EOSText" type="text" name="p_Offset_Femur_G"></td>
			</tr>
			<tr>	
				<th>Long. Col Fémoral</th>
				<td><input class="EOSText" type="text" name="p_Long_Col_Fem_D"></td>
				<td><input class="EOSText" type="text" name="p_Long_Col_Fem_G"></td>
			</tr>
			<tr>	
				<th>Neck Shaft Angle</th>
				<td><input class="EOSText" type="text" name="p_Neck_Shaft_Angle_D"></td>
				<td><input class="EOSText" type="text" name="p_Neck_Shaft_Angle_G"></td>
			</tr>
			<tr>	
				<th>Genou Varus</th>
				<td><input class="EOSText" type="text" name="p_Knee_Varus_D"></td>
				<td><input class="EOSText" type="text" name="p_Knee_Varus_G"></td>
			</tr>
			<tr>	
				<th>Genou Flessum</th>
				<td><input class="EOSText" type="text" name="p_Knee_Flessum_D"></td>
				<td><input class="EOSText" type="text" name="p_Knee_Flessum_G"></td>
			</tr>
			<tr>	
				<th>Angle Fem. Méca.</th>
				<td><input class="EOSText" type="text" name="p_Angle_Fem_Meca_D"></td>
				<td><input class="EOSText" type="text" name="p_Angle_Fem_Meca_G"></td>
			</tr>
			<tr>	
				<th>Angle Tib. Méca.</th>
				<td><input class="EOSText" type="text" name="p_Angle_Tib_Meca_D"></td>
				<td><input class="EOSText" type="text" name="p_Angle_Tib_Meca_G"></td>
			</tr>
			<tr>	
				<th>HKS</th>
				<td><input class="EOSText" type="text" name="p_HKS_D"></td>
				<td><input class="EOSText" type="text" name="p_HKS_G"></td>
			</tr>
			<tr>	
				<th>Torsion Fem.</th>
				<td><input class="EOSText" type="text" name="p_Torsion_Fem_D"></td>
				<td><input class="EOSText" type="text" name="p_Torsion_Fem_G"></td>
			</tr>
			<tr>	
				<th>Torsion Tib.</th>
				<td><input class="EOSText" type="text" name="p_Torsion_Tib_D"></td>
				<td><input class="EOSText" type="text" name="p_Torsion_Tib_G"></td>
			</tr>
			<tr>	
				<th>Rot. Fem. Tib.</th>
				<td><input class="EOSText" type="text" name="p_Rot_Fem_Tib_D"></td>
				<td><input class="EOSText" type="text" name="p_Rot_Fem_Tib_G"></td>
			</tr>
			
			
		</tbody>
		</table>

        <br/><br/>

		<div class="buttonClassic" style="width:150px;border-radius:15px;left:0px;right:0px;margin:auto;" onclick="document.getElementById('formAddEOS').submit()"><h4>Ajouter</h4></div>
			</form>
