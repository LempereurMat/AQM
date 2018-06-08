<?php
include "config.php";
include "function.php";
    
    if (!isset($_SESSION['username'])){
        exit();
    }
    
    //Courbe ref à afficher en blanc
    if (isset($_POST['courbeRef']))
        $ref = $_POST['courbeRef'];
    else
        $ref = 0;
	
    $tab_consult = $_POST['consult'];

    $id_compare = str_replace(",", "-", $tab_consult);
    
	$nb_consult = count(explode(",", $tab_consult));
	
	$step_consult = floor( 100 / ( $nb_consult ) );
	
	$SQL = 'SELECT ID FROM consultation WHERE ID in ('.$tab_consult.') ORDER BY Date_consultation ASC';
	$REQ = $db->query($SQL);
	$aListeID = array();
	while($DATA = $REQ->fetch(PDO::FETCH_BOTH)) $aListeID[] = $DATA;
	
	$SQL = 'SELECT * FROM consultation JOIN patients ON patients_ID_patient=ID_patient WHERE ID in ('.$tab_consult.') ORDER BY Date_consultation DESC';
	//echo $SQL;
	$REQ = $db->query($SQL);
	$aListeConsult = array();
	while($DATA = $REQ->fetch(PDO::FETCH_BOTH)) $aListeConsult[] = $DATA;
	
    
	for ($i = 0; $i < $nb_consult; $i++)
	{
		$LCycleNumber[$i] = $aListeConsult[$i]["LCycleNumber"];
		$LPelvisAnglesX = unserialize($aListeConsult[$i]["LPelvisAnglesX"]);
		$LPelvisAnglesY = unserialize($aListeConsult[$i]["LPelvisAnglesY"]);
		$LPelvisAnglesZ = unserialize($aListeConsult[$i]["LPelvisAnglesZ"]);
		$LHipAnglesX = unserialize($aListeConsult[$i]["LHipAnglesX"]);
		$LHipAnglesY = unserialize($aListeConsult[$i]["LHipAnglesY"]);
		$LHipAnglesZ = unserialize($aListeConsult[$i]["LHipAnglesZ"]);
		$LKneeAnglesX = unserialize($aListeConsult[$i]["LKneeAnglesX"]);
		$LKneeAnglesY = unserialize($aListeConsult[$i]["LKneeAnglesY"]);
		$LKneeAnglesZ = unserialize($aListeConsult[$i]["LKneeAnglesZ"]);
		$LAnkleAnglesX = unserialize($aListeConsult[$i]["LAnkleAnglesX"]);
		$LAnkleAnglesY = unserialize($aListeConsult[$i]["LAnkleAnglesY"]);
		$LAnkleAnglesZ = unserialize($aListeConsult[$i]["LAnkleAnglesZ"]);
		$LFootProgressAnglesX = unserialize($aListeConsult[$i]["LFootProgressAnglesX"]);
		$LFootProgressAnglesY = unserialize($aListeConsult[$i]["LFootProgressAnglesY"]);
		$LFootProgressAnglesZ = unserialize($aListeConsult[$i]["LFootProgressAnglesZ"]);
		$LHipMomentX = unserialize($aListeConsult[$i]["LHipMomentX"]);
		$LHipMomentY = unserialize($aListeConsult[$i]["LHipMomentY"]);
		$LHipMomentZ = unserialize($aListeConsult[$i]["LHipMomentZ"]);
		$LKneeMomentX = unserialize($aListeConsult[$i]["LKneeMomentX"]);
		$LKneeMomentY = unserialize($aListeConsult[$i]["LKneeMomentY"]);
		$LKneeMomentZ = unserialize($aListeConsult[$i]["LKneeMomentZ"]);
		$LAnkleMomentX = unserialize($aListeConsult[$i]["LAnkleMomentX"]);
		$LAnkleMomentY = unserialize($aListeConsult[$i]["LAnkleMomentY"]);
		$LAnkleMomentZ = unserialize($aListeConsult[$i]["LAnkleMomentZ"]);
		$LGroundReactionForceX = unserialize($aListeConsult[$i]["LGroundReactionForceX"]);
		$LGroundReactionForceY = unserialize($aListeConsult[$i]["LGroundReactionForceY"]);
		$LGroundReactionForceZ = unserialize($aListeConsult[$i]["LGroundReactionForceZ"]);
		$LHipPowerX = unserialize($aListeConsult[$i]["LHipPowerX"]);
		$LHipPowerY = unserialize($aListeConsult[$i]["LHipPowerY"]);
		$LHipPowerZ = unserialize($aListeConsult[$i]["LHipPowerZ"]);
		$LKneePowerX = unserialize($aListeConsult[$i]["LKneePowerX"]);
		$LKneePowerY = unserialize($aListeConsult[$i]["LKneePowerY"]);
		$LKneePowerZ = unserialize($aListeConsult[$i]["LKneePowerZ"]);
		$LAnklePowerX = unserialize($aListeConsult[$i]["LAnklePowerX"]);
		$LAnklePowerY = unserialize($aListeConsult[$i]["LAnklePowerY"]);
		$LAnklePowerZ = unserialize($aListeConsult[$i]["LAnklePowerZ"]);
		
		$RCycleNumber[$i] = $aListeConsult[$i]["RCycleNumber"];
		$RPelvisAnglesX = unserialize($aListeConsult[$i]["RPelvisAnglesX"]);
		$RPelvisAnglesY = unserialize($aListeConsult[$i]["RPelvisAnglesY"]);
		$RPelvisAnglesZ = unserialize($aListeConsult[$i]["RPelvisAnglesZ"]);
		$RHipAnglesX = unserialize($aListeConsult[$i]["RHipAnglesX"]);
		$RHipAnglesY = unserialize($aListeConsult[$i]["RHipAnglesY"]);
		$RHipAnglesZ = unserialize($aListeConsult[$i]["RHipAnglesZ"]);
		$RKneeAnglesX = unserialize($aListeConsult[$i]["RKneeAnglesX"]);
		$RKneeAnglesY = unserialize($aListeConsult[$i]["RKneeAnglesY"]);
		$RKneeAnglesZ = unserialize($aListeConsult[$i]["RKneeAnglesZ"]);
		$RAnkleAnglesX = unserialize($aListeConsult[$i]["RAnkleAnglesX"]);
		$RAnkleAnglesY = unserialize($aListeConsult[$i]["RAnkleAnglesY"]);
		$RAnkleAnglesZ = unserialize($aListeConsult[$i]["RAnkleAnglesZ"]);
		$RFootProgressAnglesX = unserialize($aListeConsult[$i]["RFootProgressAnglesX"]);
		$RFootProgressAnglesY = unserialize($aListeConsult[$i]["RFootProgressAnglesY"]);
		$RFootProgressAnglesZ = unserialize($aListeConsult[$i]["RFootProgressAnglesZ"]);
		$RHipMomentX = unserialize($aListeConsult[$i]["RHipMomentX"]);
		$RHipMomentY = unserialize($aListeConsult[$i]["RHipMomentY"]);
		$RHipMomentZ = unserialize($aListeConsult[$i]["RHipMomentZ"]);
		$RKneeMomentX = unserialize($aListeConsult[$i]["RKneeMomentX"]);
		$RKneeMomentY = unserialize($aListeConsult[$i]["RKneeMomentY"]);
		$RKneeMomentZ = unserialize($aListeConsult[$i]["RKneeMomentZ"]);
		$RAnkleMomentX = unserialize($aListeConsult[$i]["RAnkleMomentX"]);
		$RAnkleMomentY = unserialize($aListeConsult[$i]["RAnkleMomentY"]);
		$RAnkleMomentZ = unserialize($aListeConsult[$i]["RAnkleMomentZ"]);
		$RGroundReactionForceX = unserialize($aListeConsult[$i]["RGroundReactionForceX"]);
		$RGroundReactionForceY = unserialize($aListeConsult[$i]["RGroundReactionForceY"]);
		$RGroundReactionForceZ = unserialize($aListeConsult[$i]["RGroundReactionForceZ"]);
		$RHipPowerX = unserialize($aListeConsult[$i]["RHipPowerX"]);
		$RHipPowerY = unserialize($aListeConsult[$i]["RHipPowerY"]);
		$RHipPowerZ = unserialize($aListeConsult[$i]["RHipPowerZ"]);
		$RKneePowerX = unserialize($aListeConsult[$i]["RKneePowerX"]);
		$RKneePowerY = unserialize($aListeConsult[$i]["RKneePowerY"]);
		$RKneePowerZ = unserialize($aListeConsult[$i]["RKneePowerZ"]);
		$RAnklePowerX = unserialize($aListeConsult[$i]["RAnklePowerX"]);
		$RAnklePowerY = unserialize($aListeConsult[$i]["RAnklePowerY"]);
		$RAnklePowerZ = unserialize($aListeConsult[$i]["RAnklePowerZ"]);
		
		
		for ($j = 0; $j <= 100; $j++)
		{
			$LPelvisAnglesXMean[$i][$j] = 0;
			$LPelvisAnglesYMean[$i][$j] = 0;
			$LPelvisAnglesZMean[$i][$j] = 0;
			$LHipAnglesXMean[$i][$j] = 0;
			$LHipAnglesYMean[$i][$j] = 0;
			$LHipAnglesZMean[$i][$j] = 0;
			$LKneeAnglesXMean[$i][$j] = 0;
			$LKneeAnglesYMean[$i][$j] = 0;
			$LKneeAnglesZMean[$i][$j] = 0;
			$LAnkleAnglesXMean[$i][$j] = 0;
			$LAnkleAnglesYMean[$i][$j] = 0;
			$LAnkleAnglesZMean[$i][$j] = 0;
			$LFootProgressAnglesXMean[$i][$j] = 0;
			$LFootProgressAnglesYMean[$i][$j] = 0;
			$LFootProgressAnglesZMean[$i][$j] = 0;
			
			$LPelvisAnglesXStd[$i][$j] = 0;
			$LPelvisAnglesYStd[$i][$j] = 0;
			$LPelvisAnglesZStd[$i][$j] = 0;
			$LHipAnglesXStd[$i][$j] = 0;
			$LHipAnglesYStd[$i][$j] = 0;
			$LHipAnglesZStd[$i][$j] = 0;
			$LKneeAnglesXStd[$i][$j] = 0;
			$LKneeAnglesYStd[$i][$j] = 0;
			$LKneeAnglesZStd[$i][$j] = 0;
			$LAnkleAnglesXStd[$i][$j] = 0;
			$LAnkleAnglesYStd[$i][$j] = 0;
			$LAnkleAnglesZStd[$i][$j] = 0;
			$LFootProgressAnglesXStd[$i][$j] = 0;
			$LFootProgressAnglesYStd[$i][$j] = 0;
			$LFootProgressAnglesZStd[$i][$j] = 0;
			
			
			for ($k = 0; $k < $LCycleNumber[$i]; $k++)
			{
				$LPelvisAnglesXMean[$i][$j] = $LPelvisAnglesXMean[$i][$j] + $LPelvisAnglesX[$j][$k];
				$LPelvisAnglesYMean[$i][$j] = $LPelvisAnglesYMean[$i][$j] + $LPelvisAnglesY[$j][$k];
				$LPelvisAnglesZMean[$i][$j] = $LPelvisAnglesZMean[$i][$j] + $LPelvisAnglesZ[$j][$k];
				$LHipAnglesXMean[$i][$j] = $LHipAnglesXMean[$i][$j] + $LHipAnglesX[$j][$k];
				$LHipAnglesYMean[$i][$j] = $LHipAnglesYMean[$i][$j] + $LHipAnglesY[$j][$k];
				$LHipAnglesZMean[$i][$j] = $LHipAnglesZMean[$i][$j] + $LHipAnglesZ[$j][$k];
				$LKneeAnglesXMean[$i][$j] = $LKneeAnglesXMean[$i][$j] + $LKneeAnglesX[$j][$k];
				$LKneeAnglesYMean[$i][$j] = $LKneeAnglesYMean[$i][$j] + $LKneeAnglesY[$j][$k];
				$LKneeAnglesZMean[$i][$j] = $LKneeAnglesZMean[$i][$j] + $LKneeAnglesZ[$j][$k];
				$LAnkleAnglesXMean[$i][$j] = $LAnkleAnglesXMean[$i][$j] + $LAnkleAnglesX[$j][$k];
				$LAnkleAnglesYMean[$i][$j] = $LAnkleAnglesYMean[$i][$j] + $LAnkleAnglesY[$j][$k];
				$LAnkleAnglesZMean[$i][$j] = $LAnkleAnglesZMean[$i][$j] + $LAnkleAnglesZ[$j][$k];
				$LFootProgressAnglesXMean[$i][$j] = $LFootProgressAnglesXMean[$i][$j] + $LFootProgressAnglesX[$j][$k];
				$LFootProgressAnglesYMean[$i][$j] = $LFootProgressAnglesYMean[$i][$j] + $LFootProgressAnglesY[$j][$k];
				$LFootProgressAnglesZMean[$i][$j] = $LFootProgressAnglesZMean[$i][$j] + $LFootProgressAnglesZ[$j][$k];
			}
			$LPelvisAnglesXMean[$i][$j] = $LPelvisAnglesXMean[$i][$j] / $LCycleNumber[$i];
			$LPelvisAnglesYMean[$i][$j] = $LPelvisAnglesYMean[$i][$j] / $LCycleNumber[$i];
			$LPelvisAnglesZMean[$i][$j] = $LPelvisAnglesZMean[$i][$j] / $LCycleNumber[$i];
			$LHipAnglesXMean[$i][$j] = $LHipAnglesXMean[$i][$j] / $LCycleNumber[$i];
			$LHipAnglesYMean[$i][$j] = $LHipAnglesYMean[$i][$j] / $LCycleNumber[$i];
			$LHipAnglesZMean[$i][$j] = $LHipAnglesZMean[$i][$j] / $LCycleNumber[$i];
			$LKneeAnglesXMean[$i][$j] = $LKneeAnglesXMean[$i][$j] / $LCycleNumber[$i];
			$LKneeAnglesYMean[$i][$j] = $LKneeAnglesYMean[$i][$j] / $LCycleNumber[$i];
			$LKneeAnglesZMean[$i][$j] = $LKneeAnglesZMean[$i][$j] / $LCycleNumber[$i];
			$LAnkleAnglesXMean[$i][$j] = $LAnkleAnglesXMean[$i][$j] / $LCycleNumber[$i];
			$LAnkleAnglesYMean[$i][$j] = $LAnkleAnglesYMean[$i][$j] / $LCycleNumber[$i];
			$LAnkleAnglesZMean[$i][$j] = $LAnkleAnglesZMean[$i][$j] / $LCycleNumber[$i];
			$LFootProgressAnglesXMean[$i][$j] = $LFootProgressAnglesXMean[$i][$j] / $LCycleNumber[$i];
			$LFootProgressAnglesYMean[$i][$j] = $LFootProgressAnglesYMean[$i][$j] / $LCycleNumber[$i];
			$LFootProgressAnglesZMean[$i][$j] = $LFootProgressAnglesZMean[$i][$j] / $LCycleNumber[$i];
			
			for ($k = 0; $k < $LCycleNumber[$i]; $k++)
			{
				$LPelvisAnglesXStd[$i][$j] = $LPelvisAnglesXStd[$i][$j] + ($LPelvisAnglesX[$j][$k] - $LPelvisAnglesXMean[$i][$j])*($LPelvisAnglesX[$j][$k] - $LPelvisAnglesXMean[$i][$j]);
				$LPelvisAnglesYStd[$i][$j] = $LPelvisAnglesYStd[$i][$j] + ($LPelvisAnglesY[$j][$k] - $LPelvisAnglesYMean[$i][$j])*($LPelvisAnglesY[$j][$k] - $LPelvisAnglesYMean[$i][$j]);
				$LPelvisAnglesZStd[$i][$j] = $LPelvisAnglesZStd[$i][$j] + ($LPelvisAnglesZ[$j][$k] - $LPelvisAnglesZMean[$i][$j])*($LPelvisAnglesZ[$j][$k] - $LPelvisAnglesZMean[$i][$j]);
				$LHipAnglesXStd[$i][$j] = $LHipAnglesXStd[$i][$j] + ($LHipAnglesX[$j][$k] - $LHipAnglesXMean[$i][$j])*($LHipAnglesX[$j][$k] - $LHipAnglesXMean[$i][$j]);
				$LHipAnglesYStd[$i][$j] = $LHipAnglesYStd[$i][$j] + ($LHipAnglesY[$j][$k] - $LHipAnglesYMean[$i][$j])*($LHipAnglesY[$j][$k] - $LHipAnglesYMean[$i][$j]);
				$LHipAnglesZStd[$i][$j] = $LHipAnglesZStd[$i][$j] + ($LHipAnglesZ[$j][$k] - $LHipAnglesZMean[$i][$j])*($LHipAnglesZ[$j][$k] - $LHipAnglesZMean[$i][$j]);
				$LKneeAnglesXStd[$i][$j] = $LKneeAnglesXStd[$i][$j] + ($LKneeAnglesX[$j][$k] - $LKneeAnglesXMean[$i][$j])*($LKneeAnglesX[$j][$k] - $LKneeAnglesXMean[$i][$j]);
				$LKneeAnglesYStd[$i][$j] = $LKneeAnglesYStd[$i][$j] + ($LKneeAnglesY[$j][$k] - $LKneeAnglesYMean[$i][$j])*($LKneeAnglesY[$j][$k] - $LKneeAnglesYMean[$i][$j]);
				$LKneeAnglesZStd[$i][$j] = $LKneeAnglesZStd[$i][$j] + ($LKneeAnglesZ[$j][$k] - $LKneeAnglesZMean[$i][$j])*($LKneeAnglesZ[$j][$k] - $LKneeAnglesZMean[$i][$j]);
				$LAnkleAnglesXStd[$i][$j] = $LAnkleAnglesXStd[$i][$j] + ($LAnkleAnglesX[$j][$k] - $LAnkleAnglesXMean[$i][$j])*($LAnkleAnglesX[$j][$k] - $LAnkleAnglesXMean[$i][$j]);
				$LAnkleAnglesYStd[$i][$j] = $LAnkleAnglesYStd[$i][$j] + ($LAnkleAnglesY[$j][$k] - $LAnkleAnglesYMean[$i][$j])*($LAnkleAnglesY[$j][$k] - $LAnkleAnglesYMean[$i][$j]);
				$LAnkleAnglesZStd[$i][$j] = $LAnkleAnglesZStd[$i][$j] + ($LAnkleAnglesZ[$j][$k] - $LAnkleAnglesZMean[$i][$j])*($LAnkleAnglesZ[$j][$k] - $LAnkleAnglesZMean[$i][$j]);
				$LFootProgressAnglesXStd[$i][$j] = $LFootProgressAnglesXStd[$i][$j] + ($LFootProgressAnglesX[$j][$k] - $LFootProgressAnglesXMean[$i][$j])*($LFootProgressAnglesX[$j][$k] - $LFootProgressAnglesXMean[$i][$j]);
				$LFootProgressAnglesYStd[$i][$j] = $LFootProgressAnglesYStd[$i][$j] + ($LFootProgressAnglesY[$j][$k] - $LFootProgressAnglesYMean[$i][$j])*($LFootProgressAnglesY[$j][$k] - $LFootProgressAnglesYMean[$i][$j]);
				$LFootProgressAnglesZStd[$i][$j] = $LFootProgressAnglesZStd[$i][$j] + ($LFootProgressAnglesZ[$j][$k] - $LFootProgressAnglesZMean[$i][$j])*($LFootProgressAnglesZ[$j][$k] - $LFootProgressAnglesZMean[$i][$j]);
			}
			$LPelvisAnglesXStd[$i][$j] = sqrt($LPelvisAnglesXStd[$i][$j] / $LCycleNumber[$i]);
			$LPelvisAnglesYStd[$i][$j] = sqrt($LPelvisAnglesYStd[$i][$j] / $LCycleNumber[$i]);
			$LPelvisAnglesZStd[$i][$j] = sqrt($LPelvisAnglesZStd[$i][$j] / $LCycleNumber[$i]);
			$LHipAnglesXStd[$i][$j] = sqrt($LHipAnglesXStd[$i][$j] / $LCycleNumber[$i]);
			$LHipAnglesYStd[$i][$j] = sqrt($LHipAnglesYStd[$i][$j] / $LCycleNumber[$i]);
			$LHipAnglesZStd[$i][$j] = sqrt($LHipAnglesZStd[$i][$j] / $LCycleNumber[$i]);
			$LKneeAnglesXStd[$i][$j] = sqrt($LKneeAnglesXStd[$i][$j] / $LCycleNumber[$i]);
			$LKneeAnglesYStd[$i][$j] = sqrt($LKneeAnglesYStd[$i][$j] / $LCycleNumber[$i]);
			$LKneeAnglesZStd[$i][$j] = sqrt($LKneeAnglesZStd[$i][$j] / $LCycleNumber[$i]);
			$LAnkleAnglesXStd[$i][$j] = sqrt($LAnkleAnglesXStd[$i][$j] / $LCycleNumber[$i]);
			$LAnkleAnglesYStd[$i][$j] = sqrt($LAnkleAnglesYStd[$i][$j] / $LCycleNumber[$i]);
			$LAnkleAnglesZStd[$i][$j] = sqrt($LAnkleAnglesZStd[$i][$j] / $LCycleNumber[$i]);
			$LFootProgressAnglesXStd[$i][$j] = sqrt($LFootProgressAnglesXStd[$i][$j] / $LCycleNumber[$i]);
			$LFootProgressAnglesYStd[$i][$j] = sqrt($LFootProgressAnglesYStd[$i][$j] / $LCycleNumber[$i]);
			$LFootProgressAnglesZStd[$i][$j] = sqrt($LFootProgressAnglesZStd[$i][$j] / $LCycleNumber[$i]);
		}
		
		for ($j = 0; $j <= 100; $j++)
		{
			$RPelvisAnglesXMean[$i][$j] = 0;
			$RPelvisAnglesYMean[$i][$j] = 0;
			$RPelvisAnglesZMean[$i][$j] = 0;
			$RHipAnglesXMean[$i][$j] = 0;
			$RHipAnglesYMean[$i][$j] = 0;
			$RHipAnglesZMean[$i][$j] = 0;
			$RKneeAnglesXMean[$i][$j] = 0;
			$RKneeAnglesYMean[$i][$j] = 0;
			$RKneeAnglesZMean[$i][$j] = 0;
			$RAnkleAnglesXMean[$i][$j] = 0;
			$RAnkleAnglesYMean[$i][$j] = 0;
			$RAnkleAnglesZMean[$i][$j] = 0;
			$RFootProgressAnglesXMean[$i][$j] = 0;
			$RFootProgressAnglesYMean[$i][$j] = 0;
			$RFootProgressAnglesZMean[$i][$j] = 0;
			
			$RPelvisAnglesXStd[$i][$j] = 0;
			$RPelvisAnglesYStd[$i][$j] = 0;
			$RPelvisAnglesZStd[$i][$j] = 0;
			$RHipAnglesXStd[$i][$j] = 0;
			$RHipAnglesYStd[$i][$j] = 0;
			$RHipAnglesZStd[$i][$j] = 0;
			$RKneeAnglesXStd[$i][$j] = 0;
			$RKneeAnglesYStd[$i][$j] = 0;
			$RKneeAnglesZStd[$i][$j] = 0;
			$RAnkleAnglesXStd[$i][$j] = 0;
			$RAnkleAnglesYStd[$i][$j] = 0;
			$RAnkleAnglesZStd[$i][$j] = 0;
			$RFootProgressAnglesXStd[$i][$j] = 0;
			$RFootProgressAnglesYStd[$i][$j] = 0;
			$RFootProgressAnglesZStd[$i][$j] = 0;
			for ($k = 0; $k < $RCycleNumber[$i]; $k++)
			{
				$RPelvisAnglesXMean[$i][$j] = $RPelvisAnglesXMean[$i][$j] + $RPelvisAnglesX[$j][$k];
				$RPelvisAnglesYMean[$i][$j] = $RPelvisAnglesYMean[$i][$j] + $RPelvisAnglesY[$j][$k];
				$RPelvisAnglesZMean[$i][$j] = $RPelvisAnglesZMean[$i][$j] + $RPelvisAnglesZ[$j][$k];
				$RHipAnglesXMean[$i][$j] = $RHipAnglesXMean[$i][$j] + $RHipAnglesX[$j][$k];
				$RHipAnglesYMean[$i][$j] = $RHipAnglesYMean[$i][$j] + $RHipAnglesY[$j][$k];
				$RHipAnglesZMean[$i][$j] = $RHipAnglesZMean[$i][$j] + $RHipAnglesZ[$j][$k];
				$RKneeAnglesXMean[$i][$j] = $RKneeAnglesXMean[$i][$j] + $RKneeAnglesX[$j][$k];
				$RKneeAnglesYMean[$i][$j] = $RKneeAnglesYMean[$i][$j] + $RKneeAnglesY[$j][$k];
				$RKneeAnglesZMean[$i][$j] = $RKneeAnglesZMean[$i][$j] + $RKneeAnglesZ[$j][$k];
				$RAnkleAnglesXMean[$i][$j] = $RAnkleAnglesXMean[$i][$j] + $RAnkleAnglesX[$j][$k];
				$RAnkleAnglesYMean[$i][$j] = $RAnkleAnglesYMean[$i][$j] + $RAnkleAnglesY[$j][$k];
				$RAnkleAnglesZMean[$i][$j] = $RAnkleAnglesZMean[$i][$j] + $RAnkleAnglesZ[$j][$k];
				$RFootProgressAnglesXMean[$i][$j] = $RFootProgressAnglesXMean[$i][$j] + $RFootProgressAnglesX[$j][$k];
				$RFootProgressAnglesYMean[$i][$j] = $RFootProgressAnglesYMean[$i][$j] + $RFootProgressAnglesY[$j][$k];
				$RFootProgressAnglesZMean[$i][$j] = $RFootProgressAnglesZMean[$i][$j] + $RFootProgressAnglesZ[$j][$k];
			}
			$RPelvisAnglesXMean[$i][$j] = $RPelvisAnglesXMean[$i][$j] / $RCycleNumber[$i];
			$RPelvisAnglesYMean[$i][$j] = $RPelvisAnglesYMean[$i][$j] / $RCycleNumber[$i];
			$RPelvisAnglesZMean[$i][$j] = $RPelvisAnglesZMean[$i][$j] / $RCycleNumber[$i];
			$RHipAnglesXMean[$i][$j] = $RHipAnglesXMean[$i][$j] / $RCycleNumber[$i];
			$RHipAnglesYMean[$i][$j] = $RHipAnglesYMean[$i][$j] / $RCycleNumber[$i];
			$RHipAnglesZMean[$i][$j] = $RHipAnglesZMean[$i][$j] / $RCycleNumber[$i];
			$RKneeAnglesXMean[$i][$j] = $RKneeAnglesXMean[$i][$j] / $RCycleNumber[$i];
			$RKneeAnglesYMean[$i][$j] = $RKneeAnglesYMean[$i][$j] / $RCycleNumber[$i];
			$RKneeAnglesZMean[$i][$j] = $RKneeAnglesZMean[$i][$j] / $RCycleNumber[$i];
			$RAnkleAnglesXMean[$i][$j] = $RAnkleAnglesXMean[$i][$j] / $RCycleNumber[$i];
			$RAnkleAnglesYMean[$i][$j] = $RAnkleAnglesYMean[$i][$j] / $RCycleNumber[$i];
			$RAnkleAnglesZMean[$i][$j] = $RAnkleAnglesZMean[$i][$j] / $RCycleNumber[$i];
			$RFootProgressAnglesXMean[$i][$j] = $RFootProgressAnglesXMean[$i][$j] / $RCycleNumber[$i];
			$RFootProgressAnglesYMean[$i][$j] = $RFootProgressAnglesYMean[$i][$j] / $RCycleNumber[$i];
			$RFootProgressAnglesZMean[$i][$j] = $RFootProgressAnglesZMean[$i][$j] / $RCycleNumber[$i];
			
			
			for ($k = 0; $k < $RCycleNumber[$i]; $k++)
			{
				$RPelvisAnglesXStd[$i][$j] = $RPelvisAnglesXStd[$i][$j] + ($RPelvisAnglesX[$j][$k] - $RPelvisAnglesXMean[$i][$j])*($RPelvisAnglesX[$j][$k] - $RPelvisAnglesXMean[$i][$j]);
				$RPelvisAnglesYStd[$i][$j] = $RPelvisAnglesYStd[$i][$j] + ($RPelvisAnglesY[$j][$k] - $RPelvisAnglesYMean[$i][$j])*($RPelvisAnglesY[$j][$k] - $RPelvisAnglesYMean[$i][$j]);
				$RPelvisAnglesZStd[$i][$j] = $RPelvisAnglesZStd[$i][$j] + ($RPelvisAnglesZ[$j][$k] - $RPelvisAnglesZMean[$i][$j])*($RPelvisAnglesZ[$j][$k] - $RPelvisAnglesZMean[$i][$j]);
				$RHipAnglesXStd[$i][$j] = $RHipAnglesXStd[$i][$j] + ($RHipAnglesX[$j][$k] - $RHipAnglesXMean[$i][$j])*($RHipAnglesX[$j][$k] - $RHipAnglesXMean[$i][$j]);
				$RHipAnglesYStd[$i][$j] = $RHipAnglesYStd[$i][$j] + ($RHipAnglesY[$j][$k] - $RHipAnglesYMean[$i][$j])*($RHipAnglesY[$j][$k] - $RHipAnglesYMean[$i][$j]);
				$RHipAnglesZStd[$i][$j] = $RHipAnglesZStd[$i][$j] + ($RHipAnglesZ[$j][$k] - $RHipAnglesZMean[$i][$j])*($RHipAnglesZ[$j][$k] - $RHipAnglesZMean[$i][$j]);
				$RKneeAnglesXStd[$i][$j] = $RKneeAnglesXStd[$i][$j] + ($RKneeAnglesX[$j][$k] - $RKneeAnglesXMean[$i][$j])*($RKneeAnglesX[$j][$k] - $RKneeAnglesXMean[$i][$j]);
				$RKneeAnglesYStd[$i][$j] = $RKneeAnglesYStd[$i][$j] + ($RKneeAnglesY[$j][$k] - $RKneeAnglesYMean[$i][$j])*($RKneeAnglesY[$j][$k] - $RKneeAnglesYMean[$i][$j]);
				$RKneeAnglesZStd[$i][$j] = $RKneeAnglesZStd[$i][$j] + ($RKneeAnglesZ[$j][$k] - $RKneeAnglesZMean[$i][$j])*($RKneeAnglesZ[$j][$k] - $RKneeAnglesZMean[$i][$j]);
				$RAnkleAnglesXStd[$i][$j] = $RAnkleAnglesXStd[$i][$j] + ($RAnkleAnglesX[$j][$k] - $RAnkleAnglesXMean[$i][$j])*($RAnkleAnglesX[$j][$k] - $RAnkleAnglesXMean[$i][$j]);
				$RAnkleAnglesYStd[$i][$j] = $RAnkleAnglesYStd[$i][$j] + ($RAnkleAnglesY[$j][$k] - $RAnkleAnglesYMean[$i][$j])*($RAnkleAnglesY[$j][$k] - $RAnkleAnglesYMean[$i][$j]);
				$RAnkleAnglesZStd[$i][$j] = $RAnkleAnglesZStd[$i][$j] + ($RAnkleAnglesZ[$j][$k] - $RAnkleAnglesZMean[$i][$j])*($RAnkleAnglesZ[$j][$k] - $RAnkleAnglesZMean[$i][$j]);
				$RFootProgressAnglesXStd[$i][$j] = $RFootProgressAnglesXStd[$i][$j] + ($RFootProgressAnglesX[$j][$k] - $RFootProgressAnglesXMean[$i][$j])*($RFootProgressAnglesX[$j][$k] - $RFootProgressAnglesXMean[$i][$j]);
				$RFootProgressAnglesYStd[$i][$j] = $RFootProgressAnglesYStd[$i][$j] + ($RFootProgressAnglesY[$j][$k] - $RFootProgressAnglesYMean[$i][$j])*($RFootProgressAnglesY[$j][$k] - $RFootProgressAnglesYMean[$i][$j]);
				$RFootProgressAnglesZStd[$i][$j] = $RFootProgressAnglesZStd[$i][$j] + ($RFootProgressAnglesZ[$j][$k] - $RFootProgressAnglesZMean[$i][$j])*($RFootProgressAnglesZ[$j][$k] - $RFootProgressAnglesZMean[$i][$j]);
			}
			$RPelvisAnglesXStd[$i][$j] = sqrt($RPelvisAnglesXStd[$i][$j] / $RCycleNumber[$i]);
			$RPelvisAnglesYStd[$i][$j] = sqrt($RPelvisAnglesYStd[$i][$j] / $RCycleNumber[$i]);
			$RPelvisAnglesZStd[$i][$j] = sqrt($RPelvisAnglesZStd[$i][$j] / $RCycleNumber[$i]);
			$RHipAnglesXStd[$i][$j] = sqrt($RHipAnglesXStd[$i][$j] / $RCycleNumber[$i]);
			$RHipAnglesYStd[$i][$j] = sqrt($RHipAnglesYStd[$i][$j] / $RCycleNumber[$i]);
			$RHipAnglesZStd[$i][$j] = sqrt($RHipAnglesZStd[$i][$j] / $RCycleNumber[$i]);
			$RKneeAnglesXStd[$i][$j] = sqrt($RKneeAnglesXStd[$i][$j] / $RCycleNumber[$i]);
			$RKneeAnglesYStd[$i][$j] = sqrt($RKneeAnglesYStd[$i][$j] / $RCycleNumber[$i]);
			$RKneeAnglesZStd[$i][$j] = sqrt($RKneeAnglesZStd[$i][$j] / $RCycleNumber[$i]);
			$RAnkleAnglesXStd[$i][$j] = sqrt($RAnkleAnglesXStd[$i][$j] / $RCycleNumber[$i]);
			$RAnkleAnglesYStd[$i][$j] = sqrt($RAnkleAnglesYStd[$i][$j] / $RCycleNumber[$i]);
			$RAnkleAnglesZStd[$i][$j] = sqrt($RAnkleAnglesZStd[$i][$j] / $RCycleNumber[$i]);
			$RFootProgressAnglesXStd[$i][$j] = sqrt($RFootProgressAnglesXStd[$i][$j] / $RCycleNumber[$i]);
			$RFootProgressAnglesYStd[$i][$j] = sqrt($RFootProgressAnglesYStd[$i][$j] / $RCycleNumber[$i]);
			$RFootProgressAnglesZStd[$i][$j] = sqrt($RFootProgressAnglesZStd[$i][$j] / $RCycleNumber[$i]);
		}
	}
	
?>

<style>
#leftPanel<?php echo $id_compare; ?> {
    width:100%;
}

#rightPanel<?php echo $id_compare; ?> {
    width:100%;
    display:none;
}

.row {
    margin-bottom:20px;
    width:100%;
    padding:5px;
    display:flex;
    justify-content:center;
}

.contains-chart {
    width: 100%;
    min-height: 250px;
    margin: 5px;
    position: relative;
}

</style>

<?php
    
    if($ref==0)
        echo '<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>';
    else if (count(explode(",", $tab_consult))==2) {
        foreach(explode(",", $tab_consult) as $id)
            if ($id != $ref)
                $ID = $id;
        echo '<div style="position:absolute;margin-left:130px;left:0px;" class="buttonClassic" onclick="document.getElementById(\'compareSimilar'.$ID.'\').innerHTML=\'\';"><h4><span class="glyphicon glyphicon-remove" aria-hidden="true"></h4></span><h5 style="position:relative;top:6px;left:2px;">Cacher</h5></div>';
    }
    
?>

<div style="display:flex;justify-content:center;">
<div class="buttonClassic active" style="width:150px;border-radius:10px;margin:10px;padding:10px;font-size:20px;" onclick="document.getElementById('rightPanel<?php echo $id_compare; ?>').style.display='none';document.getElementById('leftPanel<?php echo $id_compare; ?>').style.display='inline';">Gauche</div>
<div class="buttonClassic" style="width:150px;border-radius:10px;margin:10px;padding:10px;font-size:20px;" onclick="document.getElementById('leftPanel<?php echo $id_compare; ?>').style.display='none';document.getElementById('rightPanel<?php echo $id_compare; ?>').style.display='inline';">Droite</div>
</div>
<div style="width:95%;left:0px;right:0px;margin:auto;margin-top:20px;">


<div id="leftPanel<?php echo $id_compare; ?>">

<div class="row">
<div id="container1-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container2-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container3-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

<div class="row">
<div id="container4-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container5-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container6-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

<div class="row">
<div id="container7-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container8-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container9-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

<div class="row">
<div id="container10-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container11-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

</div>

<div id="rightPanel<?php echo $id_compare; ?>">

<div class="row">
<div id="container13-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container14-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container15-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

<div class="row">
<div id="container16-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container17-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container18-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

<div class="row">
<div id="container19-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container20-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container21-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

<div class="row">
<div id="container22-<?php echo $id_compare; ?>" class="contains-chart" ></div>
<div id="container23-<?php echo $id_compare; ?>" class="contains-chart" ></div>
</div>

</div>

</div>

</div>
</div>
</div>

<?php
    function highcharts($containerID, $title, $yLabel, $cote, $mean, $std) {
        global $nb_consult, $ref, $aListeConsult, $step_consult;
    ?>

jQuery(<?php echo '"#'.$containerID.'"'; ?>).highcharts({
                                 chart: {
                                 zoomType: 'x',
                                 defaultSeriesType: 'line',
                                 marginRight: 25,
                                 marginBottom: 40,
                                 borderWidth: 1,
                                 backgroundColor: 'rgba(0,0,0,0.3)',
                                 borderRadius: 5,
                                 borderColor: 'white',
                                 plotBorderWidth: 1
                                 },
                                 title: {
                                 text: <?php echo '"'.$title.'"'; ?>,
                                 style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                 },
                                
                                 xAxis: {
                                 tickColor: 'rgba(0,0,0,0)',
                                 gridLineColor: 'rgba(0,0,0,0)'
                                 },
                                 yAxis: {
                                 gridLineColor: 'rgba(0,0,0,0)',
                                 title: {
                                 text: <?php echo '"'.$yLabel.'"'; ?>,
                                 style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                 },
                                 },
                                 tooltip: {
                                 formatter: function() {
                                 return '<b>'+ this.series.name +'</b><br/>'+
                                 this.y +'°';
                                 }
                                 },
                                 legend: {
                                 enabled: false,
                                 layout: 'vertical',
                                 align: 'right',
                                 verticalAlign: 'top',
                                 
                                 borderWidth: 0
                                 },
                                 series: [
                                 <?php
                                //mean
                                 $color_i = $nb_consult-1;
                                 for ($j = 0; $j < $nb_consult; $j++)
                                 {
                                if ($ref==0)
                                 echo '{name: "Session '.$aListeConsult[$j]["ID"].'",';
                                else
                                echo '{name: "'.$aListeConsult[$j]["nom"].' '.$aListeConsult[$j]["prenom"].'",';
                                 echo 'data:[';
                                 
                                 for ($i = 0; $i <= 99; $i++)
                                 {
                                 echo round($mean[$j][$i],2);
                                 echo ",";
                                 
                                 }
                                 echo round($mean[$j][$i],2);
                                 echo ']';
                                 if ($ref == $aListeConsult[$j]["ID"])
                                 echo ",color:'#FFFFFF'},";
                                 else {
                                    if ($cote=="L")
                                        echo ",color:'#FF".dechex(100 - $color_i*$step_consult)."2B'},";
                                    else if ($cote=="R")
                                        echo ",color:'#44".dechex(100 - $color_i*$step_consult)."FF'},";
                                 $color_i--;
                                 }
                                 }
                                //mean + std
                                 $color_i = $nb_consult-1;
                                 for ($j = 0; $j < $nb_consult; $j++)
                                 {
                                if ($ref==0)
                                    echo '{name: "Session '.$aListeConsult[$j]["ID"].'",';
                                else
                                    echo '{name: "'.$aListeConsult[$j]["nom"].' '.$aListeConsult[$j]["prenom"].'",';
                                 echo 'data:[';
                                 
                                 for ($i = 0; $i <= 99; $i++)
                                 {
                                 echo round($mean[$j][$i],2)+round($std[$j][$i],2);
                                 echo ",";
                                 
                                 }
                                 echo round($mean[$j][$i],2)+round($std[$j][$i],2);
                                 echo ']';
                                 if ($ref == $aListeConsult[$j]["ID"])
                                 echo ",color:'#FFFFFF'";
                                 else {
                                    if ($cote=="L")
                                        echo ",color:'#FF".dechex(100 - $color_i*$step_consult)."2B'";
                                    else if ($cote=="R")
                                        echo ",color:'#44".dechex(100 - $color_i*$step_consult)."FF'";
                                 $color_i--;
                                 }
                                 
                                 
                                 
                                 echo ',dashStyle: "Dot"},';
                                 }
                                //mean - std
                                 $color_i = $nb_consult-1;
                                 for ($j = 0; $j < $nb_consult; $j++)
                                 {
                                if ($ref==0)
                                    echo '{name: "Session '.$aListeConsult[$j]["ID"].'",';
                                else
                                    echo '{name: "'.$aListeConsult[$j]["nom"].' '.$aListeConsult[$j]["prenom"].'",';
                                 echo 'data:[';
                                 
                                 for ($i = 0; $i <= 99; $i++)
                                 {
                                 echo round($mean[$j][$i],2)-round($std[$j][$i],2);
                                 echo ",";
                                 
                                 }
                                 echo round($mean[$j][$i],2)-round($std[$j][$i],2);
                                 echo ']';
                                 if ($ref == $aListeConsult[$j]["ID"])
                                 echo ",color:'#FFFFFF'";
                                 else {
                                    if ($cote=="L")
                                        echo ",color:'#FF".dechex(100 - $color_i*$step_consult)."2B'";
                                    else if ($cote=="R")
                                        echo ",color:'#44".dechex(100 - $color_i*$step_consult)."FF'";
                                 $color_i--;
                                 }
                                 echo ',dashStyle: "Dot"},';
                                 }
                                ?>
                                 ]
                                 
                                 
                                 
                                 });

<?php } ?>
<script>


<?php
    //Gauche
    highcharts("container1-".$id_compare, "Pelvis - Ante/Retro", "Angle (°)", "L", $LPelvisAnglesXMean, $LPelvisAnglesXStd);
    highcharts("container2-".$id_compare, "Pelvis - Inclinaison", "Angle (°)", "L", $LPelvisAnglesYMean, $LPelvisAnglesYStd);
    highcharts("container3-".$id_compare, "Pelvis - Ante/Rotation", "Angle (°)", "L", $LPelvisAnglesZMean, $LPelvisAnglesZStd);
    highcharts("container4-".$id_compare, "Hanche - Flexion/Extension", "Angle (°)", "L", $LHipAnglesXMean, $LHipAnglesXStd);
    highcharts("container5-".$id_compare, "Hanche - Abduction/Adduction", "Angle (°)", "L", $LHipAnglesYMean, $LHipAnglesYStd);
    highcharts("container6-".$id_compare, "Hanche - Rotation Int/Ext", "Angle (°)", "L", $LHipAnglesZMean, $LHipAnglesZStd);
    highcharts("container7-".$id_compare, "Genou - Flexion/Extension", "Angle (°)", "L", $LKneeAnglesXMean, $LKneeAnglesXStd);
    highcharts("container8-".$id_compare, "Genou - Valgus/Varus", "Angle (°)", "L", $LKneeAnglesYMean, $LKneeAnglesYStd);
    highcharts("container9-".$id_compare, "Genou - Rotation Int/Ext", "Angle (°)", "L", $LKneeAnglesZMean, $LKneeAnglesZStd);
    highcharts("container10-".$id_compare, "Cheville - Flexion/Extension", "Angle (°)", "L", $LAnkleAnglesXMean, $LAnkleAnglesZStd);
    highcharts("container11-".$id_compare, "Angle de progression", "Angle (°)", "L", $LFootProgressAnglesZMean, $LFootProgressAnglesZStd);
    //Droite
    highcharts("container13-".$id_compare, "Pelvis - Ante/Retro", "Angle (°)", "R", $RPelvisAnglesXMean, $RPelvisAnglesXStd);
    highcharts("container14-".$id_compare, "Pelvis - Inclinaison", "Angle (°)", "R", $RPelvisAnglesYMean, $RPelvisAnglesYStd);
    highcharts("container15-".$id_compare, "Pelvis - Ante/Rotation", "Angle (°)", "R", $RPelvisAnglesZMean, $RPelvisAnglesZStd);
    highcharts("container16-".$id_compare, "Hanche - Flexion/Extension", "Angle (°)", "R", $RHipAnglesXMean, $RHipAnglesXStd);
    highcharts("container17-".$id_compare, "Hanche - Abduction/Adduction", "Angle (°)", "R", $RHipAnglesYMean, $RHipAnglesYStd);
    highcharts("container18-".$id_compare, "Hanche - Rotation Int/Ext", "Angle (°)", "R", $RHipAnglesZMean, $RHipAnglesZStd);
    highcharts("container19-".$id_compare, "Genou - Flexion/Extension", "Angle (°)", "R", $RKneeAnglesXMean, $RKneeAnglesXStd);
    highcharts("container20-".$id_compare, "Genou - Valgus/Varus", "Angle (°)", "R", $RKneeAnglesYMean, $RKneeAnglesYStd);
    highcharts("container21-".$id_compare, "Genou - Rotation Int/Ext", "Angle (°)", "R", $RKneeAnglesZMean, $RKneeAnglesZStd);
    highcharts("container22-".$id_compare, "Cheville - Flexion/Extension", "Angle (°)", "R", $RAnkleAnglesXMean, $RAnkleAnglesZStd);
    highcharts("container23-".$id_compare, "Angle de progression", "Angle (°)", "R", $RFootProgressAnglesZMean, $RFootProgressAnglesZStd);
    
    ?>
</script>
