<?php
session_start();
    
function sexe_determination($titre){
	if($titre == "Mme" || $titre == "Mlle"){
		return "F";
	}
	return "M";
}

function removeSpecialChars($str)
{
    return preg_replace(array("/</","/>/"), array("",""), $str);
}
    
function existxml($dir_nom)
{
	$result = false;
	if (is_dir($dir_nom))
	{
		$dir = opendir($dir_nom); // on ouvre le contenu du dossier courant
		$fichier= array(); // on déclare le tableau contenant le nom des fichiers
		$dossier= array(); // on déclare le tableau contenant le nom des dossiers

		while($element = readdir($dir))
		{
			if($element != '.' && $element != '..')
			{
				if (!is_dir($dir_nom.'/'.$element)) 
				{
					$fichier[] = $element;
				}
			}
		}
		closedir($dir);
		if(!empty($fichier))
		{
			sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
			foreach($fichier as $lien)
			{
				$type = str_replace('.','',strrchr($lien, '.'));
				$type = strtolower($type);
				if ($type == "xml")
				{
					$result = true;
				}
			}
		}
	}
	return $result;
}
    
function message($str, $color) {
    $_SESSION["message"] = $str;
    $_SESSION["messageColor"] = $color;
}
    
//$activeMenu reprŽsente l'onglet actif, ˆ mettre en Žvidence. Ex : "Admin" ou "Patients"
function nav($activeMenu) {
    global $db;
    ?>
<style>

.nav-title {
    color:#ff8c1a;
    float:left;
    margin-right:3px;
    margin-left:10px;
    padding:6px;
    padding-right:18px;
    height:100%;
    text-align:center;
    border-right:1px solid rgba(255,140,26,0.3);
}

.nav-elt-active {
    color:#ff8c1a;
    float:left;
    padding:10px;
    height:100%;
    padding-top:17px;
    text-align:center;
    font-size:17px;
    cursor:pointer;
}

.nav-elt {
    transition: border-color 0.5s ease, color 0.5s ease;
    color:white;
    float:left;
    padding:10px;
    height:100%;
    padding-top:17px;
    font-size:17px;
    text-align:center;
    cursor:pointer;
}

.nav-logout {
    display:inline-block;
    white-space:nowrap;
    transition: color 0.5s ease, width 0.5s ease;
    width:35px;
    float:right;
    color:white;
    height:100%;
    cursor:pointer;
    padding-top:20px;
}

.nav-logout:hover {
    color:#ff8c1a;
    width:150px;
}

.nav-elt:hover,.nav-elt-active:hover {
    color:#ff8c1a;
    cursor:pointer;
}

.searchBar {
    font-size:15px;
    color:white;
    transition: background-color 0.5s ease, border-color 0.5s ease;
    background-color:rgba(0,0,0,0);
    border:1px solid rgba(255,255,255,0.4);
    border-radius:13px;
    padding:5px;
    padding-left:15px;
}

.searchBar:focus {
    background-color:rgba(0,0,0,0.4);
    border-color:rgba(255,255,255,0.8);
    outline:none;
}
.footer {
    position:fixed;
    width:100%;
    height:30px;
    bottom:0%;
    background-color:rgba(0,0,0,0.5);
    text-align:center;
    border-top:1px solid #ff8c1a;
    padding-top:4px;
    fondt-height:12px;
}

</style>
<?php
    if ($_SESSION["message"]!="" && $_SESSION["messageColor"]!="") {
        if ($_SESSION["messageColor"]=="red") $color="rgba(220,0,0,0.3)";
        else if ($_SESSION["messageColor"]=="green") $color="rgba(0,230,0,0.3)";
        else if ($_SESSION["messageColor"]=="orange") $color="rgba(255,178,0,0.3)";
        echo '<div id="errorDiv" class="errorDiv" style="background-color:'.$color.';">'.$_SESSION["message"].'</div>';
        echo '<script>'
        .'var errorDiv = $("#errorDiv");'
        .'function dismissErrorDiv() {'
            .'errorDiv.animate({top:\'-50px\'}, 500, function() {'
                                                        .'errorDiv.remove();'
                                                    .'});'
        .'}'
        .'errorDiv.click(dismissErrorDiv);'
        .'setTimeout(dismissErrorDiv, 7000);'
        .'</script>';
        $_SESSION["message"]="";
        $_SESSION["color"]="";
    }
    
    echo '<nav style="position:fixed;width:100%;height:60px;top:0px;">'
    .'<div class="navBar" style="background-color:rgba(0,0,0,0.5);width:100%;height:60px;border-bottom:2px solid #ff8c1a;">'
    .'<div class="nav-title"><h4>BDD AQM</h4></div>';
    
    //On utilise un array associatif "onglet" => "lien"
    $menuList = array("Accueil" => "index.php", "Patients" => "find_patient.php", "Recherche" => "advanced_research.php", "Param&egravetres" => "preferencesUtilisateur.php");
    if ($_SESSION['type']=="Administrator" || $_SESSION['type']=="Manager") {
        $menuList["Messagerie"] = "messages.php";
        $menuList["Admin"] = "admin.php";
    }
    
    foreach (array_keys($menuList) as $menu) {
        $menuLabel = $menu;
        if ($menu == "Messagerie") {
            $SQL = "SELECT COUNT(ID_message) as nonlus FROM messages WHERE lu='0' AND destinataire='".$_SESSION['id']."';";
            $req = $db->query($SQL);
            $row = $req->fetch();
            if ($row["nonlus"] != 0)
                $menuLabel = $menuLabel.' ('.$row["nonlus"].')';
        }
        if ($menu == $activeMenu)
            echo '<div class="nav-elt-active" onclick="document.location=\''.$menuList[$menu].'\'">'.$menuLabel.'</div>';
        else
            echo '<div class="nav-elt" onclick="document.location=\''.$menuList[$menu].'\'">'.$menuLabel.'</div>';
    }

    
    //Logout
    echo '<div class="nav-logout" onclick="document.location=\'logout.php\'"><span class="glyphicon glyphicon-log-in" style="margin-right:18px;font-size:16px;"></span> <span style="font-size:16px;">D&eacuteconnexion</span> </div>';
    
    //Recherche
    echo '<form id="formResearchNav" style="float:right;padding:15px;margin-right:20px;height:60px;" method="post" action="find_patient.php">'
    .'<input class="searchBar" type="text" name="recherche" id="recherche" placeholder="Recherche..." value="'.$_SESSION["recherche"].'"/>'
    .'<div style="float:right;padding:7px;font-size:16px;" onclick="document.getElementById(\'formResearchNav\').submit();"><span class="glyphicon glyphicon-search"></span></div>'
    .'</form>';
    
    echo '</div>'
    .'</nav>';
    
    echo '<div class="footer">Developpement : Duhamel Thibault</div>';

}
?>
