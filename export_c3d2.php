<?php
include "config.php";
include "function.php";
    
    if (!isset($_SESSION['username'])) {
        header('location:login.php');
        exit();
    }

    if (!isset($_POST['consult'])) {
        header('location:index.php');
        exit();
    }
    
    // 0 : exporter de tous les cycles ; 1 : moyenne de chaque session ; 2 : moyenne de tous les cycles
    $option = $_POST['option'];
    $tab_consult = $_POST['consult'];
    
    //Tri par Date_consultation
    $SQL = "SELECT ID FROM consultation WHERE ID IN (".$tab_consult.") ORDER BY Date_consultation;";
    $req = $db->query($SQL);
    $consults = array();
    while ($row = $req->fetch())
        $consults[] = $row["ID"];

	$nb_consult = count($consults);
	
	for ($i = 0; $i < $nb_consult; $i++)
	{
        $SQL = "SELECT * FROM consultation WHERE ID='".$consults[$i]."';";
        $REQ = $db->query($SQL);
        $aListeConsult = $REQ->fetch();
		$LCycleNumber[$i] = $aListeConsult["LCycleNumber"];
		$LPelvisAnglesX[$i] = unserialize($aListeConsult["LPelvisAnglesX"]);
		$LPelvisAnglesY[$i] = unserialize($aListeConsult["LPelvisAnglesY"]);
		$LPelvisAnglesZ[$i] = unserialize($aListeConsult["LPelvisAnglesZ"]);
		$LHipAnglesX[$i] = unserialize($aListeConsult["LHipAnglesX"]);
		$LHipAnglesY[$i] = unserialize($aListeConsult["LHipAnglesY"]);
		$LHipAnglesZ[$i] = unserialize($aListeConsult["LHipAnglesZ"]);
		ini_set('memory_limit','-1');
		$LKneeAnglesX[$i] = unserialize($aListeConsult["LKneeAnglesX"]);
		$LKneeAnglesY[$i] = unserialize($aListeConsult["LKneeAnglesY"]);
		$LKneeAnglesZ[$i] = unserialize($aListeConsult["LKneeAnglesZ"]);
		$LAnkleAnglesX[$i] = unserialize($aListeConsult["LAnkleAnglesX"]);
		$LAnkleAnglesY[$i] = unserialize($aListeConsult["LAnkleAnglesY"]);
		$LAnkleAnglesZ[$i] = unserialize($aListeConsult["LAnkleAnglesZ"]);
		$LFootProgressAnglesX[$i] = unserialize($aListeConsult["LFootProgressAnglesX"]);
		$LFootProgressAnglesY[$i] = unserialize($aListeConsult["LFootProgressAnglesY"]);
		$LFootProgressAnglesZ[$i] = unserialize($aListeConsult["LFootProgressAnglesZ"]);
		/*$LHipMomentX[$i] = unserialize($aListeConsult["LHipMomentX"]);
		$LHipMomentY[$i] = unserialize($aListeConsult["LHipMomentY"]);
		$LHipMomentZ[$i] = unserialize($aListeConsult["LHipMomentZ"]);
		$LKneeMomentX[$i] = unserialize($aListeConsult["LKneeMomentX"]);
		$LKneeMomentY[$i] = unserialize($aListeConsult["LKneeMomentY"]);
		$LKneeMomentZ[$i] = unserialize($aListeConsult["LKneeMomentZ"]);
		$LAnkleMomentX[$i] = unserialize($aListeConsult["LAnkleMomentX"]);
		$LAnkleMomentY[$i] = unserialize($aListeConsult["LAnkleMomentY"]);
		$LAnkleMomentZ[$i] = unserialize($aListeConsult["LAnkleMomentZ"]);
		$LGroundReactionForceX[$i] = unserialize($aListeConsult["LGroundReactionForceX"]);
		$LGroundReactionForceY[$i] = unserialize($aListeConsult["LGroundReactionForceY"]);
		$LGroundReactionForceZ[$i] = unserialize($aListeConsult["LGroundReactionForceZ"]);
		$LHipPowerX[$i] = unserialize($aListeConsult["LHipPowerX"]);
		$LHipPowerY[$i] = unserialize($aListeConsult["LHipPowerY"]);
		$LHipPowerZ[$i] = unserialize($aListeConsult["LHipPowerZ"]);
		$LKneePowerX[$i] = unserialize($aListeConsult["LKneePowerX"]);
		$LKneePowerY[$i] = unserialize($aListeConsult["LKneePowerY"]);
		$LKneePowerZ[$i] = unserialize($aListeConsult["LKneePowerZ"]);
		$LAnklePowerX[$i] = unserialize($aListeConsult["LAnklePowerX"]);
		$LAnklePowerY[$i] = unserialize($aListeConsult["LAnklePowerY"]);
		$LAnklePowerZ[$i] = unserialize($aListeConsult["LAnklePowerZ"]);*/
		
		$RCycleNumber[$i] = $aListeConsult["RCycleNumber"];
		$RPelvisAnglesX[$i] = unserialize($aListeConsult["RPelvisAnglesX"]);
		$RPelvisAnglesY[$i] = unserialize($aListeConsult["RPelvisAnglesY"]);
		$RPelvisAnglesZ[$i] = unserialize($aListeConsult["RPelvisAnglesZ"]);
		$RHipAnglesX[$i] = unserialize($aListeConsult["RHipAnglesX"]);
		$RHipAnglesY[$i] = unserialize($aListeConsult["RHipAnglesY"]);
		$RHipAnglesZ[$i] = unserialize($aListeConsult["RHipAnglesZ"]);
		$RKneeAnglesX[$i] = unserialize($aListeConsult["RKneeAnglesX"]);
		$RKneeAnglesY[$i] = unserialize($aListeConsult["RKneeAnglesY"]);
		$RKneeAnglesZ[$i] = unserialize($aListeConsult["RKneeAnglesZ"]);
		$RAnkleAnglesX[$i] = unserialize($aListeConsult["RAnkleAnglesX"]);
		$RAnkleAnglesY[$i] = unserialize($aListeConsult["RAnkleAnglesY"]);
		$RAnkleAnglesZ[$i] = unserialize($aListeConsult["RAnkleAnglesZ"]);
		$RFootProgressAnglesX[$i] = unserialize($aListeConsult["RFootProgressAnglesX"]);
		$RFootProgressAnglesY[$i] = unserialize($aListeConsult["RFootProgressAnglesY"]);
		$RFootProgressAnglesZ[$i] = unserialize($aListeConsult["RFootProgressAnglesZ"]);
		/*$RHipMomentX[$i] = unserialize($aListeConsult["RHipMomentX"]);
		$RHipMomentY[$i] = unserialize($aListeConsult["RHipMomentY"]);
		$RHipMomentZ[$i] = unserialize($aListeConsult["RHipMomentZ"]);
		$RKneeMomentX[$i] = unserialize($aListeConsult["RKneeMomentX"]);
		$RKneeMomentY[$i] = unserialize($aListeConsult["RKneeMomentY"]);
		$RKneeMomentZ[$i] = unserialize($aListeConsult["RKneeMomentZ"]);
		$RAnkleMomentX[$i] = unserialize($aListeConsult["RAnkleMomentX"]);
		$RAnkleMomentY[$i] = unserialize($aListeConsult["RAnkleMomentY"]);
		$RAnkleMomentZ[$i] = unserialize($aListeConsult["RAnkleMomentZ"]);
		$RGroundReactionForceX[$i] = unserialize($aListeConsult["RGroundReactionForceX"]);
		$RGroundReactionForceY[$i] = unserialize($aListeConsult["RGroundReactionForceY"]);
		$RGroundReactionForceZ[$i] = unserialize($aListeConsult["RGroundReactionForceZ"]);
		$RHipPowerX[$i] = unserialize($aListeConsult["RHipPowerX"]);
		$RHipPowerY[$i] = unserialize($aListeConsult["RHipPowerY"]);
		$RHipPowerZ[$i] = unserialize($aListeConsult["RHipPowerZ"]);
		$RKneePowerX[$i] = unserialize($aListeConsult["RKneePowerX"]);
		$RKneePowerY[$i] = unserialize($aListeConsult["RKneePowerY"]);
		$RKneePowerZ[$i] = unserialize($aListeConsult["RKneePowerZ"]);
		$RAnklePowerX[$i] = unserialize($aListeConsult["RAnklePowerX"]);
		$RAnklePowerY[$i] = unserialize($aListeConsult["RAnklePowerY"]);
		$RAnklePowerZ[$i] = unserialize($aListeConsult["RAnklePowerZ"]);*/
	}
	
	$filename = $local_path. 'temp_files2/fichier.json';
	$fichier = fopen($filename, 'rw+');
	ftruncate($fichier,0);
	
	if ($option == 2)
	{
		$LCycleNumberTotal = array_sum($LCycleNumber);
		$RCycleNumberTotal = array_sum($RCycleNumber);
		
		fwrite($fichier,"LPelvisAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLPelvisAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLPelvisAnglesX[$i] = $MeanLPelvisAnglesX[$i] + array_sum($LPelvisAnglesX[$k][$i]);
			}
			$MeanLPelvisAnglesX[$i] = round($MeanLPelvisAnglesX[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLPelvisAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LPelvisAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLPelvisAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLPelvisAnglesY[$i] = $MeanLPelvisAnglesY[$i] + array_sum($LPelvisAnglesY[$k][$i]);
			}
			$MeanLPelvisAnglesY[$i] = round($MeanLPelvisAnglesY[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLPelvisAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LPelvisAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLPelvisAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLPelvisAnglesZ[$i] = $MeanLPelvisAnglesZ[$i] + array_sum($LPelvisAnglesZ[$k][$i]);
			}
			$MeanLPelvisAnglesZ[$i] = round($MeanLPelvisAnglesZ[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLPelvisAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"LHipAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLHipAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLHipAnglesX[$i] = $MeanLHipAnglesX[$i] + array_sum($LHipAnglesX[$k][$i]);
			}
			$MeanLHipAnglesX[$i] = round($MeanLHipAnglesX[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLHipAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LHipAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLHipAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLHipAnglesY[$i] = $MeanLHipAnglesY[$i] + array_sum($LHipAnglesY[$k][$i]);
			}
			$MeanLHipAnglesY[$i] = round($MeanLHipAnglesY[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLHipAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LHipAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLHipAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLHipAnglesZ[$i] = $MeanLHipAnglesZ[$i] + array_sum($LHipAnglesZ[$k][$i]);
			}
			$MeanLHipAnglesZ[$i] = round($MeanLHipAnglesZ[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLHipAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"LKneeAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLKneeAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLKneeAnglesX[$i] = $MeanLKneeAnglesX[$i] + array_sum($LKneeAnglesX[$k][$i]);
			}
			$MeanLKneeAnglesX[$i] = round($MeanLKneeAnglesX[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLKneeAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LKneeAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLKneeAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLKneeAnglesY[$i] = $MeanLKneeAnglesY[$i] + array_sum($LKneeAnglesY[$k][$i]);
			}
			$MeanLKneeAnglesY[$i] = round($MeanLKneeAnglesY[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLKneeAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LKneeAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLKneeAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLKneeAnglesZ[$i] = $MeanLKneeAnglesZ[$i] + array_sum($LKneeAnglesZ[$k][$i]);
			}
			$MeanLKneeAnglesZ[$i] = round($MeanLKneeAnglesZ[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLKneeAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"LAnkleAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLAnkleAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLAnkleAnglesX[$i] = $MeanLAnkleAnglesX[$i] + array_sum($LAnkleAnglesX[$k][$i]);
			}
			$MeanLAnkleAnglesX[$i] = round($MeanLAnkleAnglesX[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLAnkleAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LAnkleAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLAnkleAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLAnkleAnglesY[$i] = $MeanLAnkleAnglesY[$i] + array_sum($LAnkleAnglesY[$k][$i]);
			}
			$MeanLAnkleAnglesY[$i] = round($MeanLAnkleAnglesY[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLAnkleAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LAnkleAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLAnkleAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLAnkleAnglesZ[$i] = $MeanLAnkleAnglesZ[$i] + array_sum($LAnkleAnglesZ[$k][$i]);
			}
			$MeanLAnkleAnglesZ[$i] = round($MeanLAnkleAnglesZ[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLAnkleAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"LFootProgressAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLFootProgressAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLFootProgressAnglesX[$i] = $MeanLFootProgressAnglesX[$i] + array_sum($LFootProgressAnglesX[$k][$i]);
			}
			$MeanLFootProgressAnglesX[$i] = round($MeanLFootProgressAnglesX[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLFootProgressAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LFootProgressAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLFootProgressAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLFootProgressAnglesY[$i] = $MeanLFootProgressAnglesY[$i] + array_sum($LFootProgressAnglesY[$k][$i]);
			}
			$MeanLFootProgressAnglesY[$i] = round($MeanLFootProgressAnglesY[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLFootProgressAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"LFootProgressAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanLFootProgressAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$LCycleNumber[$k] = 0;
				$MeanLFootProgressAnglesZ[$i] = $MeanLFootProgressAnglesZ[$i] + array_sum($LFootProgressAnglesZ[$k][$i]);
			}
			$MeanLFootProgressAnglesZ[$i] = round($MeanLFootProgressAnglesZ[$i] / $LCycleNumberTotal , 2);
			fwrite($fichier,$MeanLFootProgressAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"RPelvisAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRPelvisAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRPelvisAnglesX[$i] = $MeanRPelvisAnglesX[$i] + array_sum($RPelvisAnglesX[$k][$i]);
			}
			$MeanRPelvisAnglesX[$i] = round($MeanRPelvisAnglesX[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRPelvisAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RPelvisAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRPelvisAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRPelvisAnglesY[$i] = $MeanRPelvisAnglesY[$i] + array_sum($RPelvisAnglesY[$k][$i]);
			}
			$MeanRPelvisAnglesY[$i] = round($MeanRPelvisAnglesY[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRPelvisAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RPelvisAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRPelvisAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRPelvisAnglesZ[$i] = $MeanRPelvisAnglesZ[$i] + array_sum($RPelvisAnglesZ[$k][$i]);
			}
			$MeanRPelvisAnglesZ[$i] = round($MeanRPelvisAnglesZ[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRPelvisAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"RHipAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRHipAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRHipAnglesX[$i] = $MeanRHipAnglesX[$i] + array_sum($RHipAnglesX[$k][$i]);
			}
			$MeanRHipAnglesX[$i] = round($MeanRHipAnglesX[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRHipAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RHipAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRHipAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRHipAnglesY[$i] = $MeanRHipAnglesY[$i] + array_sum($RHipAnglesY[$k][$i]);
			}
			$MeanRHipAnglesY[$i] = round($MeanRHipAnglesY[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRHipAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RHipAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRHipAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRHipAnglesZ[$i] = $MeanRHipAnglesZ[$i] + array_sum($RHipAnglesZ[$k][$i]);
			}
			$MeanRHipAnglesZ[$i] = round($MeanRHipAnglesZ[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRHipAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"RKneeAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRKneeAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRKneeAnglesX[$i] = $MeanRKneeAnglesX[$i] + array_sum($RKneeAnglesX[$k][$i]);
			}
			$MeanRKneeAnglesX[$i] = round($MeanRKneeAnglesX[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRKneeAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RKneeAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRKneeAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRKneeAnglesY[$i] = $MeanRKneeAnglesY[$i] + array_sum($RKneeAnglesY[$k][$i]);
			}
			$MeanRKneeAnglesY[$i] = round($MeanRKneeAnglesY[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRKneeAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RKneeAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRKneeAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRKneeAnglesZ[$i] = $MeanRKneeAnglesZ[$i] + array_sum($RKneeAnglesZ[$k][$i]);
			}
			$MeanRKneeAnglesZ[$i] = round($MeanRKneeAnglesZ[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRKneeAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"RAnkleAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRAnkleAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRAnkleAnglesX[$i] = $MeanRAnkleAnglesX[$i] + array_sum($RAnkleAnglesX[$k][$i]);
			}
			$MeanRAnkleAnglesX[$i] = round($MeanRAnkleAnglesX[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRAnkleAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RAnkleAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRAnkleAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRAnkleAnglesY[$i] = $MeanRAnkleAnglesY[$i] + array_sum($RAnkleAnglesY[$k][$i]);
			}
			$MeanRAnkleAnglesY[$i] = round($MeanRAnkleAnglesY[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRAnkleAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RAnkleAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRAnkleAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRAnkleAnglesZ[$i] = $MeanRAnkleAnglesZ[$i] + array_sum($RAnkleAnglesZ[$k][$i]);
			}
			$MeanRAnkleAnglesZ[$i] = round($MeanRAnkleAnglesZ[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRAnkleAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		fwrite($fichier,"RFootProgressAnglesX=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRFootProgressAnglesX[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRFootProgressAnglesX[$i] = $MeanRFootProgressAnglesX[$i] + array_sum($RFootProgressAnglesX[$k][$i]);
			}
			$MeanRFootProgressAnglesX[$i] = round($MeanRFootProgressAnglesX[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRFootProgressAnglesX[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RFootProgressAnglesY=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRFootProgressAnglesY[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRFootProgressAnglesY[$i] = $MeanRFootProgressAnglesY[$i] + array_sum($RFootProgressAnglesY[$k][$i]);
			}
			$MeanRFootProgressAnglesY[$i] = round($MeanRFootProgressAnglesY[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRFootProgressAnglesY[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		fwrite($fichier,"RFootProgressAnglesZ=");
		for  ($i = 0; $i <= 100; $i++)
		{
			$MeanRFootProgressAnglesZ[$i] = 0;
			for ($k = 0 ; $k<$nb_consult ; $k++)
			{
				$RCycleNumber[$k] = 0;
				$MeanRFootProgressAnglesZ[$i] = $MeanRFootProgressAnglesZ[$i] + array_sum($RFootProgressAnglesZ[$k][$i]);
			}
			$MeanRFootProgressAnglesZ[$i] = round($MeanRFootProgressAnglesZ[$i] / $RCycleNumberTotal , 2);
			fwrite($fichier,$MeanRFootProgressAnglesZ[$i]);
			if ($i < 100)
			{
				fwrite($fichier,",");
			}
			else
			{
				fwrite($fichier,"\n");
			}
		}
		
		
		$LCycleNumber[0] = 1;
		$RCycleNumber[0] = 1;
	}
	
	
	if ($option == 1)
	{
		for ($k = 0 ; $k<$nb_consult ; $k++)
		{
			$LCycleNumber[$k] = 0;
			fwrite($fichier,"LPelvisAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LPelvisAnglesXMean[$k][$i] = round(array_sum($LPelvisAnglesX[$k][$i]) / count($LPelvisAnglesX[$k][$i]),2);
					fwrite($fichier,$LPelvisAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LPelvisAnglesXMean[$k][$i] = round(array_sum($LPelvisAnglesX[$k][$i]) / count($LPelvisAnglesX[$k][$i]),2);
			fwrite($fichier,$LPelvisAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LPelvisAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LPelvisAnglesYMean[$k][$i] = round(array_sum($LPelvisAnglesY[$k][$i]) / count($LPelvisAnglesY[$k][$i]),2);
					fwrite($fichier,$LPelvisAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LPelvisAnglesYMean[$k][$i] = round(array_sum($LPelvisAnglesY[$k][$i]) / count($LPelvisAnglesY[$k][$i]),2);
			fwrite($fichier,$LPelvisAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LPelvisAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LPelvisAnglesZMean[$k][$i] = round(array_sum($LPelvisAnglesZ[$k][$i]) / count($LPelvisAnglesZ[$k][$i]),2);
					fwrite($fichier,$LPelvisAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LPelvisAnglesZMean[$k][$i] = round(array_sum($LPelvisAnglesZ[$k][$i]) / count($LPelvisAnglesZ[$k][$i]),2);
			fwrite($fichier,$LPelvisAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
			
			
			fwrite($fichier,"LHipAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LHipAnglesXMean[$k][$i] = round(array_sum($LHipAnglesX[$k][$i]) / count($LHipAnglesX[$k][$i]),2);
					fwrite($fichier,$LHipAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LHipAnglesXMean[$k][$i] = round(array_sum($LHipAnglesX[$k][$i]) / count($LHipAnglesX[$k][$i]),2);
			fwrite($fichier,$LHipAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LHipAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LHipAnglesYMean[$k][$i] = round(array_sum($LHipAnglesY[$k][$i]) / count($LHipAnglesY[$k][$i]),2);
					fwrite($fichier,$LHipAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LHipAnglesYMean[$k][$i] = round(array_sum($LHipAnglesY[$k][$i]) / count($LHipAnglesY[$k][$i]),2);
			fwrite($fichier,$LHipAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LHipAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LHipAnglesZMean[$k][$i] = round(array_sum($LHipAnglesZ[$k][$i]) / count($LHipAnglesZ[$k][$i]),2);
					fwrite($fichier,$LHipAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LHipAnglesZMean[$k][$i] = round(array_sum($LHipAnglesZ[$k][$i]) / count($LHipAnglesZ[$k][$i]),2);
			fwrite($fichier,$LHipAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
			
			fwrite($fichier,"LKneeAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LKneeAnglesXMean[$k][$i] = round(array_sum($LKneeAnglesX[$k][$i]) / count($LKneeAnglesX[$k][$i]),2);
					fwrite($fichier,$LKneeAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LKneeAnglesXMean[$k][$i] = round(array_sum($LKneeAnglesX[$k][$i]) / count($LKneeAnglesX[$k][$i]),2);
			fwrite($fichier,$LKneeAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LKneeAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LKneeAnglesYMean[$k][$i] = round(array_sum($LKneeAnglesY[$k][$i]) / count($LKneeAnglesY[$k][$i]),2);
					fwrite($fichier,$LKneeAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LKneeAnglesYMean[$k][$i] = round(array_sum($LKneeAnglesY[$k][$i]) / count($LKneeAnglesY[$k][$i]),2);
			fwrite($fichier,$LKneeAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LKneeAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LKneeAnglesZMean[$k][$i] = round(array_sum($LKneeAnglesZ[$k][$i]) / count($LKneeAnglesZ[$k][$i]),2);
					fwrite($fichier,$LKneeAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LKneeAnglesZMean[$k][$i] = round(array_sum($LKneeAnglesZ[$k][$i]) / count($LKneeAnglesZ[$k][$i]),2);
			fwrite($fichier,$LKneeAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
			
			fwrite($fichier,"LAnkleAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LAnkleAnglesXMean[$k][$i] = round(array_sum($LAnkleAnglesX[$k][$i]) / count($LAnkleAnglesX[$k][$i]),2);
					fwrite($fichier,$LAnkleAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LAnkleAnglesXMean[$k][$i] = round(array_sum($LAnkleAnglesX[$k][$i]) / count($LAnkleAnglesX[$k][$i]),2);
			fwrite($fichier,$LAnkleAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LAnkleAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LAnkleAnglesYMean[$k][$i] = round(array_sum($LAnkleAnglesY[$k][$i]) / count($LAnkleAnglesY[$k][$i]),2);
					fwrite($fichier,$LAnkleAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LAnkleAnglesYMean[$k][$i] = round(array_sum($LAnkleAnglesY[$k][$i]) / count($LAnkleAnglesY[$k][$i]),2);
			fwrite($fichier,$LAnkleAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LAnkleAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LAnkleAnglesZMean[$k][$i] = round(array_sum($LAnkleAnglesZ[$k][$i]) / count($LAnkleAnglesZ[$k][$i]),2);
					fwrite($fichier,$LAnkleAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LAnkleAnglesZMean[$k][$i] = round(array_sum($LAnkleAnglesZ[$k][$i]) / count($LAnkleAnglesZ[$k][$i]),2);
			fwrite($fichier,$LAnkleAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
			
			fwrite($fichier,"LFootProgressAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LFootProgressAnglesXMean[$k][$i] = round(array_sum($LFootProgressAnglesX[$k][$i]) / count($LFootProgressAnglesX[$k][$i]),2);
					fwrite($fichier,$LFootProgressAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LFootProgressAnglesXMean[$k][$i] = round(array_sum($LFootProgressAnglesX[$k][$i]) / count($LFootProgressAnglesX[$k][$i]),2);
			fwrite($fichier,$LFootProgressAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LFootProgressAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LFootProgressAnglesYMean[$k][$i] = round(array_sum($LFootProgressAnglesY[$k][$i]) / count($LFootProgressAnglesY[$k][$i]),2);
					fwrite($fichier,$LFootProgressAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LFootProgressAnglesYMean[$k][$i] = round(array_sum($LFootProgressAnglesY[$k][$i]) / count($LFootProgressAnglesY[$k][$i]),2);
			fwrite($fichier,$LFootProgressAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"LFootProgressAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$LFootProgressAnglesZMean[$k][$i] = round(array_sum($LFootProgressAnglesZ[$k][$i]) / count($LFootProgressAnglesZ[$k][$i]),2);
					fwrite($fichier,$LFootProgressAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$LFootProgressAnglesZMean[$k][$i] = round(array_sum($LFootProgressAnglesZ[$k][$i]) / count($LFootProgressAnglesZ[$k][$i]),2);
			fwrite($fichier,$LFootProgressAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
		}
		for ($k = 0 ; $k<$nb_consult ; $k++)
		{
			$RCycleNumber[$k] = 0;
			fwrite($fichier,"RPelvisAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RPelvisAnglesXMean[$k][$i] = round(array_sum($RPelvisAnglesX[$k][$i]) / count($RPelvisAnglesX[$k][$i]),2);
					fwrite($fichier,$RPelvisAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RPelvisAnglesXMean[$k][$i] = round(array_sum($RPelvisAnglesX[$k][$i]) / count($RPelvisAnglesX[$k][$i]),2);
			fwrite($fichier,$RPelvisAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RPelvisAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RPelvisAnglesYMean[$k][$i] = round(array_sum($RPelvisAnglesY[$k][$i]) / count($RPelvisAnglesY[$k][$i]),2);
					fwrite($fichier,$RPelvisAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RPelvisAnglesYMean[$k][$i] = round(array_sum($RPelvisAnglesY[$k][$i]) / count($RPelvisAnglesY[$k][$i]),2);
			fwrite($fichier,$RPelvisAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RPelvisAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RPelvisAnglesZMean[$k][$i] = round(array_sum($RPelvisAnglesZ[$k][$i]) / count($RPelvisAnglesZ[$k][$i]),2);
					fwrite($fichier,$RPelvisAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RPelvisAnglesZMean[$k][$i] = round(array_sum($RPelvisAnglesZ[$k][$i]) / count($RPelvisAnglesZ[$k][$i]),2);
			fwrite($fichier,$RPelvisAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
						
			
			fwrite($fichier,"RHipAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RHipAnglesXMean[$k][$i] = round(array_sum($RHipAnglesX[$k][$i]) / count($RHipAnglesX[$k][$i]),2);
					fwrite($fichier,$RHipAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RHipAnglesXMean[$k][$i] = round(array_sum($RHipAnglesX[$k][$i]) / count($RHipAnglesX[$k][$i]),2);
			fwrite($fichier,$RHipAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RHipAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RHipAnglesYMean[$k][$i] = round(array_sum($RHipAnglesY[$k][$i]) / count($RHipAnglesY[$k][$i]),2);
					fwrite($fichier,$RHipAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RHipAnglesYMean[$k][$i] = round(array_sum($RHipAnglesY[$k][$i]) / count($RHipAnglesY[$k][$i]),2);
			fwrite($fichier,$RHipAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RHipAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RHipAnglesZMean[$k][$i] = round(array_sum($RHipAnglesZ[$k][$i]) / count($RHipAnglesZ[$k][$i]),2);
					fwrite($fichier,$RHipAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RHipAnglesZMean[$k][$i] = round(array_sum($RHipAnglesZ[$k][$i]) / count($RHipAnglesZ[$k][$i]),2);
			fwrite($fichier,$RHipAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
			
			fwrite($fichier,"RKneeAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RKneeAnglesXMean[$k][$i] = round(array_sum($RKneeAnglesX[$k][$i]) / count($RKneeAnglesX[$k][$i]),2);
					fwrite($fichier,$RKneeAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RKneeAnglesXMean[$k][$i] = round(array_sum($RKneeAnglesX[$k][$i]) / count($RKneeAnglesX[$k][$i]),2);
			fwrite($fichier,$RKneeAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RKneeAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RKneeAnglesYMean[$k][$i] = round(array_sum($RKneeAnglesY[$k][$i]) / count($RKneeAnglesY[$k][$i]),2);
					fwrite($fichier,$RKneeAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RKneeAnglesYMean[$k][$i] = round(array_sum($RKneeAnglesY[$k][$i]) / count($RKneeAnglesY[$k][$i]),2);
			fwrite($fichier,$RKneeAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RKneeAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RKneeAnglesZMean[$k][$i] = round(array_sum($RKneeAnglesZ[$k][$i]) / count($RKneeAnglesZ[$k][$i]),2);
					fwrite($fichier,$RKneeAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RKneeAnglesZMean[$k][$i] = round(array_sum($RKneeAnglesZ[$k][$i]) / count($RKneeAnglesZ[$k][$i]),2);
			fwrite($fichier,$RKneeAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
			
			fwrite($fichier,"RAnkleAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RAnkleAnglesXMean[$k][$i] = round(array_sum($RAnkleAnglesX[$k][$i]) / count($RAnkleAnglesX[$k][$i]),2);
					fwrite($fichier,$RAnkleAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RAnkleAnglesXMean[$k][$i] = round(array_sum($RAnkleAnglesX[$k][$i]) / count($RAnkleAnglesX[$k][$i]),2);
			fwrite($fichier,$RAnkleAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RAnkleAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RAnkleAnglesYMean[$k][$i] = round(array_sum($RAnkleAnglesY[$k][$i]) / count($RAnkleAnglesY[$k][$i]),2);
					fwrite($fichier,$RAnkleAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RAnkleAnglesYMean[$k][$i] = round(array_sum($RAnkleAnglesY[$k][$i]) / count($RAnkleAnglesY[$k][$i]),2);
			fwrite($fichier,$RAnkleAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RAnkleAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RAnkleAnglesZMean[$k][$i] = round(array_sum($RAnkleAnglesZ[$k][$i]) / count($RAnkleAnglesZ[$k][$i]),2);
					fwrite($fichier,$RAnkleAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RAnkleAnglesZMean[$k][$i] = round(array_sum($RAnkleAnglesZ[$k][$i]) / count($RAnkleAnglesZ[$k][$i]),2);
			fwrite($fichier,$RAnkleAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
			
			
			fwrite($fichier,"RFootProgressAnglesX=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RFootProgressAnglesXMean[$k][$i] = round(array_sum($RFootProgressAnglesX[$k][$i]) / count($RFootProgressAnglesX[$k][$i]),2);
					fwrite($fichier,$RFootProgressAnglesXMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RFootProgressAnglesXMean[$k][$i] = round(array_sum($RFootProgressAnglesX[$k][$i]) / count($RFootProgressAnglesX[$k][$i]),2);
			fwrite($fichier,$RFootProgressAnglesXMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RFootProgressAnglesY=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RFootProgressAnglesYMean[$k][$i] = round(array_sum($RFootProgressAnglesY[$k][$i]) / count($RFootProgressAnglesY[$k][$i]),2);
					fwrite($fichier,$RFootProgressAnglesYMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RFootProgressAnglesYMean[$k][$i] = round(array_sum($RFootProgressAnglesY[$k][$i]) / count($RFootProgressAnglesY[$k][$i]),2);
			fwrite($fichier,$RFootProgressAnglesYMean[$k][$i]);
			fwrite($fichier,"\n");
			
			fwrite($fichier,"RFootProgressAnglesZ=");
			for  ($i = 0; $i < 100; $i++)
				{
					$RFootProgressAnglesZMean[$k][$i] = round(array_sum($RFootProgressAnglesZ[$k][$i]) / count($RFootProgressAnglesZ[$k][$i]),2);
					fwrite($fichier,$RFootProgressAnglesZMean[$k][$i]);
					fwrite($fichier,",");
				}
			$RFootProgressAnglesZMean[$k][$i] = round(array_sum($RFootProgressAnglesZ[$k][$i]) / count($RFootProgressAnglesZ[$k][$i]),2);
			fwrite($fichier,$RFootProgressAnglesZMean[$k][$i]);
			fwrite($fichier,"\n");
		}
	$LCycleNumber[0] = $nb_consult;
	$RCycleNumber[0] = $nb_consult;
		
	}
	
	
	
	if ($option == 0)
	{
		for ($k = 0 ; $k<$nb_consult ; $k++)
		{
			for ($j = 0; $j < $LCycleNumber[$k]; $j++)
			{
				fwrite($fichier,"LPelvisAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LPelvisAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LPelvisAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LPelvisAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LPelvisAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LPelvisAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LPelvisAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LPelvisAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LPelvisAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LHipAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LHipAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LHipAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LHipAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LHipAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LHipAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LHipAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LHipAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LHipAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LKneeAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LKneeAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LKneeAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LKneeAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LKneeAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LKneeAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LKneeAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LKneeAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LKneeAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LAnkleAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LAnkleAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LAnkleAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LAnkleAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LAnkleAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LAnkleAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LAnkleAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LAnkleAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LAnkleAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LFootProgressAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LFootProgressAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LFootProgressAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LFootProgressAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LFootProgressAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LFootProgressAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LFootProgressAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LFootProgressAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LFootProgressAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
			}
		}
		
		for ($k = 0 ; $k<$nb_consult ; $k++)
		{
			for ($j = 0; $j < $RCycleNumber[$k]; $j++)
			{
				fwrite($fichier,"RPelvisAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RPelvisAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RPelvisAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RPelvisAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RPelvisAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RPelvisAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RPelvisAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RPelvisAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RPelvisAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RHipAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RHipAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RHipAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RHipAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RHipAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RHipAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RHipAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RHipAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RHipAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RKneeAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RKneeAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RKneeAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RKneeAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RKneeAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RKneeAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RKneeAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RKneeAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RKneeAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RAnkleAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RAnkleAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RAnkleAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RAnkleAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RAnkleAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RAnkleAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RAnkleAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RAnkleAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RAnkleAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RFootProgressAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RFootProgressAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RFootProgressAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RFootProgressAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RFootProgressAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RFootProgressAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RFootProgressAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RFootProgressAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RFootProgressAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
			}
		}
	}
	
	
	if ($option == 4)
	{
		$CycleNumber = 0;
		for ($k = 0 ; $k<$nb_consult ; $k++)
		{
			$CycleNumber = $CycleNumber + min($LCycleNumber[$k],$RCycleNumber[$k]);
			for ($j = 0; $j < min($LCycleNumber[$k],$RCycleNumber[$k]); $j++)
			{
				fwrite($fichier,"LPelvisAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LPelvisAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LPelvisAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LPelvisAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LPelvisAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LPelvisAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LPelvisAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LPelvisAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LPelvisAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LHipAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LHipAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LHipAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LHipAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LHipAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LHipAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LHipAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LHipAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LHipAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LKneeAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LKneeAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LKneeAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LKneeAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LKneeAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LKneeAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LKneeAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LKneeAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LKneeAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LAnkleAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LAnkleAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LAnkleAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LAnkleAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LAnkleAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LAnkleAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LAnkleAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LAnkleAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LAnkleAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"LFootProgressAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LFootProgressAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LFootProgressAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LFootProgressAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LFootProgressAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LFootProgressAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"LFootProgressAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$LFootProgressAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$LFootProgressAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RPelvisAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RPelvisAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RPelvisAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RPelvisAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RPelvisAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RPelvisAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RPelvisAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RPelvisAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RPelvisAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RHipAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RHipAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RHipAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RHipAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RHipAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RHipAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RHipAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RHipAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RHipAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RKneeAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RKneeAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RKneeAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RKneeAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RKneeAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RKneeAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RKneeAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RKneeAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RKneeAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RAnkleAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RAnkleAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RAnkleAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RAnkleAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RAnkleAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RAnkleAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RAnkleAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RAnkleAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RAnkleAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
				
				fwrite($fichier,"RFootProgressAnglesX=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RFootProgressAnglesX[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RFootProgressAnglesX[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RFootProgressAnglesY=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RFootProgressAnglesY[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RFootProgressAnglesY[$k][$i][$j]);
				fwrite($fichier,"\n");
				fwrite($fichier,"RFootProgressAnglesZ=");
				for  ($i = 0; $i < 100; $i++)
				{
					fwrite($fichier,$RFootProgressAnglesZ[$k][$i][$j]);
					fwrite($fichier,",");
				}
				fwrite($fichier,$RFootProgressAnglesZ[$k][$i][$j]);
				fwrite($fichier,"\n");
			}
		}		
	}
	
	
	
	
	if ($option < 4)
	{
		fwrite($fichier,array_sum($LCycleNumber));
		fwrite($fichier,"\n");
		fwrite($fichier,array_sum($RCycleNumber));
		fwrite($fichier,"\n");
	}
	elseif ($option==4)
	{
		fwrite($fichier,$CycleNumber);
		fwrite($fichier,"\n");
		fwrite($fichier,$CycleNumber);
		fwrite($fichier,"\n");
	}
	fclose($fichier);
	
	
	
	//exec("C:\Users\Utilisateur\Anaconda2/python.exe serializetoc3d.py " .escapeshellcmd(json_encode($LCycleNumber))." ".escapeshellcmd(json_encode($LPelvisAnglesX))." ". escapeshellcmd(json_encode($LPelvisAnglesY))." ". escapeshellcmd(json_encode($LPelvisAnglesZ)). " 2>&1" , escapeshellcmd($output));

    //Création fichier
	ini_set('memory_limit','-1');
	//if ($option < 4)
	//{	
	//	exec("C:\Users\Utilisateur\Anaconda2/python.exe serializetoc3d.py " . " " .escapeshellcmd(array_sum($LCycleNumber)). " " .escapeshellcmd(array_sum($RCycleNumber)). " 2>&1");
	//}
	//elseif ($option==4)
	//{
	//	exec("C:\Users\Utilisateur\Anaconda2/python.exe serializetoc3d.py " . " " .escapeshellcmd($CycleNumber). " " .escapeshellcmd($CycleNumber). " 2>&1");
	//}
    
    //Téléchargement
    //header("Location: temp_files2/output.c3d");
	
?>
