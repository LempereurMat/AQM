<?php
    include "config.php";
    include "function.php";
    
    if (!isset($_SESSION['username'])){
        exit();
    }
    
    if(isset($_POST["patient"]) && isset($_POST["consultation"])) {
        $nPatient = $_POST["patient"];
        $nConsultation = $_POST["consultation"];
        //rSqlConnect();
        $SQL = "SELECT * FROM `consultation` WHERE `ID` = '".$nConsultation."' ";
        $REQ = $db->query($SQL);
        //if (!$REQ) {
        //echo "Could not successfully run query ($SQL) from DB: " . mysql_error();
        //}
        $aListeConsult = array();
        while($DATA = $REQ->fetch(PDO::FETCH_ASSOC)) $aListeConsult[] = $DATA;
        $LCycleNumber = $aListeConsult[0]["LCycleNumber"];
        $LPelvisAnglesX = unserialize($aListeConsult[0]["LPelvisAnglesX"]);
        $LPelvisAnglesY = unserialize($aListeConsult[0]["LPelvisAnglesY"]);
        $LPelvisAnglesZ = unserialize($aListeConsult[0]["LPelvisAnglesZ"]);
        $LHipAnglesX = unserialize($aListeConsult[0]["LHipAnglesX"]);
        $LHipAnglesY = unserialize($aListeConsult[0]["LHipAnglesY"]);
        $LHipAnglesZ = unserialize($aListeConsult[0]["LHipAnglesZ"]);
        $LKneeAnglesX = unserialize($aListeConsult[0]["LKneeAnglesX"]);
        $LKneeAnglesY = unserialize($aListeConsult[0]["LKneeAnglesY"]);
        $LKneeAnglesZ = unserialize($aListeConsult[0]["LKneeAnglesZ"]);
        $LAnkleAnglesX = unserialize($aListeConsult[0]["LAnkleAnglesX"]);
        $LAnkleAnglesY = unserialize($aListeConsult[0]["LAnkleAnglesY"]);
        $LAnkleAnglesZ = unserialize($aListeConsult[0]["LAnkleAnglesZ"]);
        $LFootProgressAnglesX = unserialize($aListeConsult[0]["LFootProgressAnglesX"]);
        $LFootProgressAnglesY = unserialize($aListeConsult[0]["LFootProgressAnglesY"]);
        $LFootProgressAnglesZ = unserialize($aListeConsult[0]["LFootProgressAnglesZ"]);
		$LKineticCycleNumber = $aListeConsult[0]["LKineticCycleNumber"];
        $LHipMomentX = unserialize($aListeConsult[0]["LHipMomentX"]);
        $LHipMomentY = unserialize($aListeConsult[0]["LHipMomentY"]);
        $LHipMomentZ = unserialize($aListeConsult[0]["LHipMomentZ"]);
        $LKneeMomentX = unserialize($aListeConsult[0]["LKneeMomentX"]);
        $LKneeMomentY = unserialize($aListeConsult[0]["LKneeMomentY"]);
        $LKneeMomentZ = unserialize($aListeConsult[0]["LKneeMomentZ"]);
        $LAnkleMomentX = unserialize($aListeConsult[0]["LAnkleMomentX"]);
        $LAnkleMomentY = unserialize($aListeConsult[0]["LAnkleMomentY"]);
        $LAnkleMomentZ = unserialize($aListeConsult[0]["LAnkleMomentZ"]);
        $LGroundReactionForceX = unserialize($aListeConsult[0]["LGroundReactionForceX"]);
        $LGroundReactionForceY = unserialize($aListeConsult[0]["LGroundReactionForceY"]);
        $LGroundReactionForceZ = unserialize($aListeConsult[0]["LGroundReactionForceZ"]);
        $LHipPowerX = unserialize($aListeConsult[0]["LHipPowerX"]);
        $LHipPowerY = unserialize($aListeConsult[0]["LHipPowerY"]);
        $LHipPowerZ = unserialize($aListeConsult[0]["LHipPowerZ"]);
        $LKneePowerX = unserialize($aListeConsult[0]["LKneePowerX"]);
        $LKneePowerY = unserialize($aListeConsult[0]["LKneePowerY"]);
        $LKneePowerZ = unserialize($aListeConsult[0]["LKneePowerZ"]);
        $LAnklePowerX = unserialize($aListeConsult[0]["LAnklePowerX"]);
        $LAnklePowerY = unserialize($aListeConsult[0]["LAnklePowerY"]);
        $LAnklePowerZ = unserialize($aListeConsult[0]["LAnklePowerZ"]);
        
        $RCycleNumber = $aListeConsult[0]["RCycleNumber"];
        $RPelvisAnglesX = unserialize($aListeConsult[0]["RPelvisAnglesX"]);
        $RPelvisAnglesY = unserialize($aListeConsult[0]["RPelvisAnglesY"]);
        $RPelvisAnglesZ = unserialize($aListeConsult[0]["RPelvisAnglesZ"]);
        $RHipAnglesX = unserialize($aListeConsult[0]["RHipAnglesX"]);
        $RHipAnglesY = unserialize($aListeConsult[0]["RHipAnglesY"]);
        $RHipAnglesZ = unserialize($aListeConsult[0]["RHipAnglesZ"]);
        $RKneeAnglesX = unserialize($aListeConsult[0]["RKneeAnglesX"]);
        $RKneeAnglesY = unserialize($aListeConsult[0]["RKneeAnglesY"]);
        $RKneeAnglesZ = unserialize($aListeConsult[0]["RKneeAnglesZ"]);
        $RAnkleAnglesX = unserialize($aListeConsult[0]["RAnkleAnglesX"]);
        $RAnkleAnglesY = unserialize($aListeConsult[0]["RAnkleAnglesY"]);
        $RAnkleAnglesZ = unserialize($aListeConsult[0]["RAnkleAnglesZ"]);
        $RFootProgressAnglesX = unserialize($aListeConsult[0]["RFootProgressAnglesX"]);
        $RFootProgressAnglesY = unserialize($aListeConsult[0]["RFootProgressAnglesY"]);
        $RFootProgressAnglesZ = unserialize($aListeConsult[0]["RFootProgressAnglesZ"]);
		$RKineticCycleNumber = $aListeConsult[0]["RKineticCycleNumber"];
        $RHipMomentX = unserialize($aListeConsult[0]["RHipMomentX"]);
        $RHipMomentY = unserialize($aListeConsult[0]["RHipMomentY"]);
        $RHipMomentZ = unserialize($aListeConsult[0]["RHipMomentZ"]);
        $RKneeMomentX = unserialize($aListeConsult[0]["RKneeMomentX"]);
        $RKneeMomentY = unserialize($aListeConsult[0]["RKneeMomentY"]);
        $RKneeMomentZ = unserialize($aListeConsult[0]["RKneeMomentZ"]);
        $RAnkleMomentX = unserialize($aListeConsult[0]["RAnkleMomentX"]);
        $RAnkleMomentY = unserialize($aListeConsult[0]["RAnkleMomentY"]);
        $RAnkleMomentZ = unserialize($aListeConsult[0]["RAnkleMomentZ"]);
        $RGroundReactionForceX = unserialize($aListeConsult[0]["RGroundReactionForceX"]);
        $RGroundReactionForceY = unserialize($aListeConsult[0]["RGroundReactionForceY"]);
        $RGroundReactionForceZ = unserialize($aListeConsult[0]["RGroundReactionForceZ"]);
        $RHipPowerX = unserialize($aListeConsult[0]["RHipPowerX"]);
        $RHipPowerY = unserialize($aListeConsult[0]["RHipPowerY"]);
        $RHipPowerZ = unserialize($aListeConsult[0]["RHipPowerZ"]);
        $RKneePowerX = unserialize($aListeConsult[0]["RKneePowerX"]);
        $RKneePowerY = unserialize($aListeConsult[0]["RKneePowerY"]);
        $RKneePowerZ = unserialize($aListeConsult[0]["RKneePowerZ"]);
        $RAnklePowerX = unserialize($aListeConsult[0]["RAnklePowerX"]);
        $RAnklePowerY = unserialize($aListeConsult[0]["RAnklePowerY"]);
        $RAnklePowerZ = unserialize($aListeConsult[0]["RAnklePowerZ"]);
		
		
		$PST[0] = $aListeConsult[0]["LCadence"];
		$PST[1] = $aListeConsult[0]["RCadence"];
		$PST[2] = $aListeConsult[0]["LDuration"];
		$PST[3] = $aListeConsult[0]["RDuration"];
		$PST[4] = $aListeConsult[0]["LSpeed"];
		$PST[5] = $aListeConsult[0]["RSpeed"];
		$PST[6] = $aListeConsult[0]["LLengthStride"];
		$PST[7] = $aListeConsult[0]["RLengthStride"];
		$PST[8] = $aListeConsult[0]["LLengthStep"];
		$PST[9] = $aListeConsult[0]["RLengthStep"];
		$PST[10] = $aListeConsult[0]["LWidth"];
		$PST[11] = $aListeConsult[0]["RWidth"];
		$PST[12] = $aListeConsult[0]["LStancePhaseSec"];
		$PST[13] = $aListeConsult[0]["RStancePhaseSec"];
		$PST[14] = $aListeConsult[0]["LStancePhasePercent"];
		$PST[15] = $aListeConsult[0]["RStancePhasePercent"];
		$PST[16] = $aListeConsult[0]["LFirstDoubleStance"];
		$PST[17] = $aListeConsult[0]["RFirstDoubleStance"];
		$PST[18] = $aListeConsult[0]["LSimpleStance"];
		$PST[19] = $aListeConsult[0]["RSimpleStance"];
		$PST[20] = $aListeConsult[0]["LSecondDoubleStance"];
		$PST[21] = $aListeConsult[0]["RSecondDoubleStance"];
		$PST[22] = $aListeConsult[0]["LSwingPhasePercent"];
		$PST[23] = $aListeConsult[0]["RSwingPhasePercent"];
		$PST[24] = $aListeConsult[0]["LSwingPhaseSec"];
		$PST[25] = $aListeConsult[0]["RSwingPhaseSec"];
		$PST[26] = $aListeConsult[0]["LNormalcyIndex"];
		$PST[27] = $aListeConsult[0]["RNormalcyIndex"];
		$PST[28] = $aListeConsult[0]["LGDI"];
		$PST[29] = $aListeConsult[0]["RGDI"];
		$PST[30] = $aListeConsult[0]["LGPS"];
		$PST[31] = $aListeConsult[0]["RGPS"];

        $PSTNumber = count($PST) / 2;
		
        
        //mysql_close();
        
        
        for ($i = 0; $i <= 100; $i++)
        {
            $LPelvisAnglesXMean[$i] = 0;
            $LPelvisAnglesYMean[$i] = 0;
            $LPelvisAnglesZMean[$i] = 0;
            $LHipAnglesXMean[$i] = 0;
            $LHipAnglesYMean[$i] = 0;
            $LHipAnglesZMean[$i] = 0;
            $LKneeAnglesXMean[$i] = 0;
            $LKneeAnglesYMean[$i] = 0;
            $LKneeAnglesZMean[$i] = 0;
            $LAnkleAnglesXMean[$i] = 0;
            $LAnkleAnglesYMean[$i] = 0;
            $LAnkleAnglesZMean[$i] = 0;
            $LFootProgressAnglesXMean[$i] = 0;
            $LFootProgressAnglesYMean[$i] = 0;
            $LFootProgressAnglesZMean[$i] = 0;
            for ($j = 0; $j < $LCycleNumber; $j++)
            {
                $LPelvisAnglesXMean[$i] = $LPelvisAnglesXMean[$i] + $LPelvisAnglesX[$i][$j];
                $LPelvisAnglesYMean[$i] = $LPelvisAnglesYMean[$i] + $LPelvisAnglesY[$i][$j];
                $LPelvisAnglesZMean[$i] = $LPelvisAnglesZMean[$i] + $LPelvisAnglesZ[$i][$j];
                $LHipAnglesXMean[$i] = $LHipAnglesXMean[$i] + $LHipAnglesX[$i][$j];
                $LHipAnglesYMean[$i] = $LHipAnglesYMean[$i] + $LHipAnglesY[$i][$j];
                $LHipAnglesZMean[$i] = $LHipAnglesZMean[$i] + $LHipAnglesZ[$i][$j];
                $LKneeAnglesXMean[$i] = $LKneeAnglesXMean[$i] + $LKneeAnglesX[$i][$j];
                $LKneeAnglesYMean[$i] = $LKneeAnglesYMean[$i] + $LKneeAnglesY[$i][$j];
                $LKneeAnglesZMean[$i] = $LKneeAnglesZMean[$i] + $LKneeAnglesZ[$i][$j];
                $LAnkleAnglesXMean[$i] = $LAnkleAnglesXMean[$i] + $LAnkleAnglesX[$i][$j];
                $LAnkleAnglesYMean[$i] = $LAnkleAnglesYMean[$i] + $LAnkleAnglesY[$i][$j];
                $LAnkleAnglesZMean[$i] = $LAnkleAnglesZMean[$i] + $LAnkleAnglesZ[$i][$j];
                $LFootProgressAnglesXMean[$i] = $LFootProgressAnglesXMean[$i] + $LFootProgressAnglesX[$i][$j];
                $LFootProgressAnglesYMean[$i] = $LFootProgressAnglesYMean[$i] + $LFootProgressAnglesY[$i][$j];
                $LFootProgressAnglesZMean[$i] = $LFootProgressAnglesZMean[$i] + $LFootProgressAnglesZ[$i][$j];
            }
            $LPelvisAnglesXMean[$i] = $LPelvisAnglesXMean[$i] / $LCycleNumber;
            $LPelvisAnglesYMean[$i] = $LPelvisAnglesYMean[$i] / $LCycleNumber;
            $LPelvisAnglesZMean[$i] = $LPelvisAnglesZMean[$i] / $LCycleNumber;
            $LHipAnglesXMean[$i] = $LHipAnglesXMean[$i] / $LCycleNumber;
            $LHipAnglesYMean[$i] = $LHipAnglesYMean[$i] / $LCycleNumber;
            $LHipAnglesZMean[$i] = $LHipAnglesZMean[$i] / $LCycleNumber;
            $LKneeAnglesXMean[$i] = $LKneeAnglesXMean[$i] / $LCycleNumber;
            $LKneeAnglesYMean[$i] = $LKneeAnglesYMean[$i] / $LCycleNumber;
            $LKneeAnglesZMean[$i] = $LKneeAnglesZMean[$i] / $LCycleNumber;
            $LAnkleAnglesXMean[$i] = $LAnkleAnglesXMean[$i] / $LCycleNumber;
            $LAnkleAnglesYMean[$i] = $LAnkleAnglesYMean[$i] / $LCycleNumber;
            $LAnkleAnglesZMean[$i] = $LAnkleAnglesZMean[$i] / $LCycleNumber;
            $LFootProgressAnglesXMean[$i] = $LFootProgressAnglesXMean[$i] / $LCycleNumber;
            $LFootProgressAnglesYMean[$i] = $LFootProgressAnglesYMean[$i] / $LCycleNumber;
            $LFootProgressAnglesZMean[$i] = $LFootProgressAnglesZMean[$i] / $LCycleNumber;
        }
        
		for ($i = 0; $i <= 100; $i++)
        {
            $LGroundReactionForceXMean[$i] = 0;
            $LGroundReactionForceYMean[$i] = 0;
            $LGroundReactionForceZMean[$i] = 0;
			$LHipMomentXMean[$i] = 0;
			$LHipMomentYMean[$i] = 0;
			$LHipMomentZMean[$i] = 0;
			$LKneeMomentXMean[$i] = 0;
			$LKneeMomentYMean[$i] = 0;
			$LKneeMomentZMean[$i] = 0;
			$LAnkleMomentXMean[$i] = 0;
			$LAnkleMomentYMean[$i] = 0;
			$LAnkleMomentZMean[$i] = 0;
			$LHipPowerXMean[$i] = 0;
			$LHipPowerYMean[$i] = 0;
			$LHipPowerZMean[$i] = 0;
			$LKneePowerXMean[$i] = 0;
			$LKneePowerYMean[$i] = 0;
			$LKneePowerZMean[$i] = 0;
			$LAnklePowerXMean[$i] = 0;
			$LAnklePowerYMean[$i] = 0;
			$LAnklePowerZMean[$i] = 0;
            
            for ($j = 0; $j < $LKineticCycleNumber; $j++)
            {
                $LGroundReactionForceXMean[$i] = $LGroundReactionForceXMean[$i] + $LGroundReactionForceX[$i][$j];
				$LGroundReactionForceYMean[$i] = $LGroundReactionForceYMean[$i] + $LGroundReactionForceY[$i][$j];
				$LGroundReactionForceZMean[$i] = $LGroundReactionForceZMean[$i] + $LGroundReactionForceZ[$i][$j];
				$LHipMomentXMean[$i] = $LHipMomentXMean[$i] + $LHipMomentX[$i][$j];
				$LHipMomentYMean[$i] = $LHipMomentYMean[$i] + $LHipMomentY[$i][$j];
				$LHipMomentZMean[$i] = $LHipMomentZMean[$i] + $LHipMomentZ[$i][$j];
				$LKneeMomentXMean[$i] = $LKneeMomentXMean[$i] + $LKneeMomentX[$i][$j];
				$LKneeMomentYMean[$i] = $LKneeMomentYMean[$i] + $LKneeMomentY[$i][$j];
				$LKneeMomentZMean[$i] = $LKneeMomentZMean[$i] + $LKneeMomentZ[$i][$j];
				$LAnkleMomentXMean[$i] = $LAnkleMomentXMean[$i] + $LAnkleMomentX[$i][$j];
				$LAnkleMomentYMean[$i] = $LAnkleMomentYMean[$i] + $LAnkleMomentY[$i][$j];
				$LAnkleMomentZMean[$i] = $LAnkleMomentZMean[$i] + $LAnkleMomentZ[$i][$j];
				$LHipPowerXMean[$i] = $LHipPowerXMean[$i] + $LHipPowerX[$i][$j];
				$LHipPowerYMean[$i] = $LHipPowerYMean[$i] + $LHipPowerY[$i][$j];
				$LHipPowerZMean[$i] = $LHipPowerZMean[$i] + $LHipPowerZ[$i][$j];
				$LKneePowerXMean[$i] = $LKneePowerXMean[$i] + $LKneePowerX[$i][$j];
				$LKneePowerYMean[$i] = $LKneePowerYMean[$i] + $LKneePowerY[$i][$j];
				$LKneePowerZMean[$i] = $LKneePowerZMean[$i] + $LKneePowerZ[$i][$j];
				$LAnklePowerXMean[$i] = $LAnklePowerXMean[$i] + $LAnklePowerX[$i][$j];
				$LAnklePowerYMean[$i] = $LAnklePowerYMean[$i] + $LAnklePowerY[$i][$j];
				$LAnklePowerZMean[$i] = $LAnklePowerZMean[$i] + $LAnklePowerZ[$i][$j];
                
            }
			if ($LKineticCycleNumber != 0)
			{
				$LGroundReactionForceXMean[$i] = $LGroundReactionForceXMean[$i] / $LKineticCycleNumber;
				$LGroundReactionForceYMean[$i] = $LGroundReactionForceYMean[$i] / $LKineticCycleNumber;
				$LGroundReactionForceZMean[$i] = $LGroundReactionForceZMean[$i] / $LKineticCycleNumber;
				$LHipMomentXMean[$i] = $LHipMomentXMean[$i] / $LKineticCycleNumber;
				$LHipMomentYMean[$i] = $LHipMomentYMean[$i] / $LKineticCycleNumber;
				$LHipMomentZMean[$i] = $LHipMomentZMean[$i] / $LKineticCycleNumber;
				$LKneeMomentXMean[$i] = $LKneeMomentXMean[$i] / $LKineticCycleNumber;
				$LKneeMomentYMean[$i] = $LKneeMomentYMean[$i] / $LKineticCycleNumber;
				$LKneeMomentZMean[$i] = $LKneeMomentZMean[$i] / $LKineticCycleNumber;
				$LAnkleMomentXMean[$i] = $LAnkleMomentXMean[$i] / $LKineticCycleNumber;
				$LAnkleMomentYMean[$i] = $LAnkleMomentYMean[$i] / $LKineticCycleNumber;
				$LAnkleMomentZMean[$i] = $LAnkleMomentZMean[$i] / $LKineticCycleNumber;
				$LHipPowerXMean[$i] = $LHipPowerXMean[$i] / $LKineticCycleNumber;
				$LHipPowerYMean[$i] = $LHipPowerYMean[$i] / $LKineticCycleNumber;
				$LHipPowerZMean[$i] = $LHipPowerZMean[$i] / $LKineticCycleNumber;
				$LKneePowerXMean[$i] = $LKneePowerXMean[$i] / $LKineticCycleNumber;
				$LKneePowerYMean[$i] = $LKneePowerYMean[$i] / $LKineticCycleNumber;
				$LKneePowerZMean[$i] = $LKneePowerZMean[$i] / $LKineticCycleNumber;
				$LAnklePowerXMean[$i] = $LAnklePowerXMean[$i] / $LKineticCycleNumber;
				$LAnklePowerYMean[$i] = $LAnklePowerYMean[$i] / $LKineticCycleNumber;
				$LAnklePowerZMean[$i] = $LAnklePowerZMean[$i] / $LKineticCycleNumber;
            }
        }
		
		
		
        for ($i = 0; $i <= 100; $i++)
        {
            $RPelvisAnglesXMean[$i] = 0;
            $RPelvisAnglesYMean[$i] = 0;
            $RPelvisAnglesZMean[$i] = 0;
            $RHipAnglesXMean[$i] = 0;
            $RHipAnglesYMean[$i] = 0;
            $RHipAnglesZMean[$i] = 0;
            $RKneeAnglesXMean[$i] = 0;
            $RKneeAnglesYMean[$i] = 0;
            $RKneeAnglesZMean[$i] = 0;
            $RAnkleAnglesXMean[$i] = 0;
            $RAnkleAnglesYMean[$i] = 0;
            $RAnkleAnglesZMean[$i] = 0;
            $RFootProgressAnglesXMean[$i] = 0;
            $RFootProgressAnglesYMean[$i] = 0;
            $RFootProgressAnglesZMean[$i] = 0;
            for ($j = 0; $j < $RCycleNumber; $j++)
            {
                $RPelvisAnglesXMean[$i] = $RPelvisAnglesXMean[$i] + $RPelvisAnglesX[$i][$j];
                $RPelvisAnglesYMean[$i] = $RPelvisAnglesYMean[$i] + $RPelvisAnglesY[$i][$j];
                $RPelvisAnglesZMean[$i] = $RPelvisAnglesZMean[$i] + $RPelvisAnglesZ[$i][$j];
                $RHipAnglesXMean[$i] = $RHipAnglesXMean[$i] + $RHipAnglesX[$i][$j];
                $RHipAnglesYMean[$i] = $RHipAnglesYMean[$i] + $RHipAnglesY[$i][$j];
                $RHipAnglesZMean[$i] = $RHipAnglesZMean[$i] + $RHipAnglesZ[$i][$j];
                $RKneeAnglesXMean[$i] = $RKneeAnglesXMean[$i] + $RKneeAnglesX[$i][$j];
                $RKneeAnglesYMean[$i] = $RKneeAnglesYMean[$i] + $RKneeAnglesY[$i][$j];
                $RKneeAnglesZMean[$i] = $RKneeAnglesZMean[$i] + $RKneeAnglesZ[$i][$j];
                $RAnkleAnglesXMean[$i] = $RAnkleAnglesXMean[$i] + $RAnkleAnglesX[$i][$j];
                $RAnkleAnglesYMean[$i] = $RAnkleAnglesYMean[$i] + $RAnkleAnglesY[$i][$j];
                $RAnkleAnglesZMean[$i] = $RAnkleAnglesZMean[$i] + $RAnkleAnglesZ[$i][$j];
                $RFootProgressAnglesXMean[$i] = $RFootProgressAnglesXMean[$i] + $RFootProgressAnglesX[$i][$j];
                $RFootProgressAnglesYMean[$i] = $RFootProgressAnglesYMean[$i] + $RFootProgressAnglesY[$i][$j];
                $RFootProgressAnglesZMean[$i] = $RFootProgressAnglesZMean[$i] + $RFootProgressAnglesZ[$i][$j];
            }
            $RPelvisAnglesXMean[$i] = $RPelvisAnglesXMean[$i] / $RCycleNumber;
            $RPelvisAnglesYMean[$i] = $RPelvisAnglesYMean[$i] / $RCycleNumber;
            $RPelvisAnglesZMean[$i] = $RPelvisAnglesZMean[$i] / $RCycleNumber;
            $RHipAnglesXMean[$i] = $RHipAnglesXMean[$i] / $RCycleNumber;
            $RHipAnglesYMean[$i] = $RHipAnglesYMean[$i] / $RCycleNumber;
            $RHipAnglesZMean[$i] = $RHipAnglesZMean[$i] / $RCycleNumber;
            $RKneeAnglesXMean[$i] = $RKneeAnglesXMean[$i] / $RCycleNumber;
            $RKneeAnglesYMean[$i] = $RKneeAnglesYMean[$i] / $RCycleNumber;
            $RKneeAnglesZMean[$i] = $RKneeAnglesZMean[$i] / $RCycleNumber;
            $RAnkleAnglesXMean[$i] = $RAnkleAnglesXMean[$i] / $RCycleNumber;
            $RAnkleAnglesYMean[$i] = $RAnkleAnglesYMean[$i] / $RCycleNumber;
            $RAnkleAnglesZMean[$i] = $RAnkleAnglesZMean[$i] / $RCycleNumber;
            $RFootProgressAnglesXMean[$i] = $RFootProgressAnglesXMean[$i] / $RCycleNumber;
            $RFootProgressAnglesYMean[$i] = $RFootProgressAnglesYMean[$i] / $RCycleNumber;
            $RFootProgressAnglesZMean[$i] = $RFootProgressAnglesZMean[$i] / $RCycleNumber;
        }
		
		
		for ($i = 0; $i <= 100; $i++)
        {
            $RGroundReactionForceXMean[$i] = 0;
            $RGroundReactionForceYMean[$i] = 0;
            $RGroundReactionForceZMean[$i] = 0;
			$RHipMomentXMean[$i] = 0;
			$RHipMomentYMean[$i] = 0;
			$RHipMomentZMean[$i] = 0;
			$RKneeMomentXMean[$i] = 0;
			$RKneeMomentYMean[$i] = 0;
			$RKneeMomentZMean[$i] = 0;
			$RAnkleMomentXMean[$i] = 0;
			$RAnkleMomentYMean[$i] = 0;
			$RAnkleMomentZMean[$i] = 0;
			$RHipPowerXMean[$i] = 0;
			$RHipPowerYMean[$i] = 0;
			$RHipPowerZMean[$i] = 0;
			$RKneePowerXMean[$i] = 0;
			$RKneePowerYMean[$i] = 0;
			$RKneePowerZMean[$i] = 0;
			$RAnklePowerXMean[$i] = 0;
			$RAnklePowerYMean[$i] = 0;
			$RAnklePowerZMean[$i] = 0;
            
            for ($j = 0; $j < $RKineticCycleNumber; $j++)
            {
                $RGroundReactionForceXMean[$i] = $RGroundReactionForceXMean[$i] + $RGroundReactionForceX[$i][$j];
				$RGroundReactionForceYMean[$i] = $RGroundReactionForceYMean[$i] + $RGroundReactionForceY[$i][$j];
				$RGroundReactionForceZMean[$i] = $RGroundReactionForceZMean[$i] + $RGroundReactionForceZ[$i][$j];
				$RHipMomentXMean[$i] = $RHipMomentXMean[$i] + $RHipMomentX[$i][$j];
				$RHipMomentYMean[$i] = $RHipMomentYMean[$i] + $RHipMomentY[$i][$j];
				$RHipMomentZMean[$i] = $RHipMomentZMean[$i] + $RHipMomentZ[$i][$j];
				$RKneeMomentXMean[$i] = $RKneeMomentXMean[$i] + $RKneeMomentX[$i][$j];
				$RKneeMomentYMean[$i] = $RKneeMomentYMean[$i] + $RKneeMomentY[$i][$j];
				$RKneeMomentZMean[$i] = $RKneeMomentZMean[$i] + $RKneeMomentZ[$i][$j];
				$RAnkleMomentXMean[$i] = $RAnkleMomentXMean[$i] + $RAnkleMomentX[$i][$j];
				$RAnkleMomentYMean[$i] = $RAnkleMomentYMean[$i] + $RAnkleMomentY[$i][$j];
				$RAnkleMomentZMean[$i] = $RAnkleMomentZMean[$i] + $RAnkleMomentZ[$i][$j];
				$RHipPowerXMean[$i] = $RHipPowerXMean[$i] + $RHipPowerX[$i][$j];
				$RHipPowerYMean[$i] = $RHipPowerYMean[$i] + $RHipPowerY[$i][$j];
				$RHipPowerZMean[$i] = $RHipPowerZMean[$i] + $RHipPowerZ[$i][$j];
				$RKneePowerXMean[$i] = $RKneePowerXMean[$i] + $RKneePowerX[$i][$j];
				$RKneePowerYMean[$i] = $RKneePowerYMean[$i] + $RKneePowerY[$i][$j];
				$RKneePowerZMean[$i] = $RKneePowerZMean[$i] + $RKneePowerZ[$i][$j];
				$RAnklePowerXMean[$i] = $RAnklePowerXMean[$i] + $RAnklePowerX[$i][$j];
				$RAnklePowerYMean[$i] = $RAnklePowerYMean[$i] + $RAnklePowerY[$i][$j];
				$RAnklePowerZMean[$i] = $RAnklePowerZMean[$i] + $RAnklePowerZ[$i][$j];
                
            }
			if ($RKineticCycleNumber != 0)
            {
				$RGroundReactionForceXMean[$i] = $RGroundReactionForceXMean[$i] / $RKineticCycleNumber;
				$RGroundReactionForceYMean[$i] = $RGroundReactionForceYMean[$i] / $RKineticCycleNumber;
				$RGroundReactionForceZMean[$i] = $RGroundReactionForceZMean[$i] / $RKineticCycleNumber;
				$RHipMomentXMean[$i] = $RHipMomentXMean[$i] / $RKineticCycleNumber;
				$RHipMomentYMean[$i] = $RHipMomentYMean[$i] / $RKineticCycleNumber;
				$RHipMomentZMean[$i] = $RHipMomentZMean[$i] / $RKineticCycleNumber;
				$RKneeMomentXMean[$i] = $RKneeMomentXMean[$i] / $RKineticCycleNumber;
				$RKneeMomentYMean[$i] = $RKneeMomentYMean[$i] / $RKineticCycleNumber;
				$RKneeMomentZMean[$i] = $RKneeMomentZMean[$i] / $RKineticCycleNumber;
				$RAnkleMomentXMean[$i] = $RAnkleMomentXMean[$i] / $RKineticCycleNumber;
				$RAnkleMomentYMean[$i] = $RAnkleMomentYMean[$i] / $RKineticCycleNumber;
				$RAnkleMomentZMean[$i] = $RAnkleMomentZMean[$i] / $RKineticCycleNumber;
				$RHipPowerXMean[$i] = $RHipPowerXMean[$i] / $RKineticCycleNumber;
				$RHipPowerYMean[$i] = $RHipPowerYMean[$i] / $RKineticCycleNumber;
				$RHipPowerZMean[$i] = $RHipPowerZMean[$i] / $RKineticCycleNumber;
				$RKneePowerXMean[$i] = $RKneePowerXMean[$i] / $RKineticCycleNumber;
				$RKneePowerYMean[$i] = $RKneePowerYMean[$i] / $RKineticCycleNumber;
				$RKneePowerZMean[$i] = $RKneePowerZMean[$i] / $RKineticCycleNumber;
				$RAnklePowerXMean[$i] = $RAnklePowerXMean[$i] / $RKineticCycleNumber;
				$RAnklePowerYMean[$i] = $RAnklePowerYMean[$i] / $RKineticCycleNumber;
				$RAnklePowerZMean[$i] = $RAnklePowerZMean[$i] / $RKineticCycleNumber;
            }
        }
		
		
        $SQL = "SELECT * FROM patients, pathologies WHERE patients.ID_patient = pathologies.patients_ID_patient AND patients.ID_patient = '".$nPatient."' ";
        $REQ = $db->query($SQL);
        $aPatient = $REQ->fetch(PDO::FETCH_ASSOC);
    }
    ?>


<style>
    #leftPanel {

    }
	#leftPanelKinetic {
		display:none;
    }
	#rightPanelKinetic {
		display:none;
    }

    #rightPanel {
        display:none;
    }
	
	#PSTPanel{
		display:none;
	}
	
    .row {
        margin-bottom:20px;
        display:flex;
        justify-content:center;
    }

    .contains-chart {
        
    }
	

.inputSelect {
        transition: width 0.5s ease, height 0.5s ease;
        color:white;
        appearance: none;
        background-color:rgba(255,255,255,0);
        border: 1px solid white;
        border-radius:25px;
        padding:18px;
        width:200px;
        height:45px;
        margin:auto;
        overflow:hidden;
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
	
            
			
			

        </style>

<div style="position:absolute;margin-left:90px;left:0px;" class="buttonClassic" onclick="scrollButton(650)"><h4><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></h4></span><h5 style="position:relative;top:5px;left:2px;">Retour</h5></div>



<div class="inputSelect" id="inputSelectCurve" style="overflow:hidden">
    <h5 class="labelSelect" id="labelCurve" style="margin:3px;">Cinématique</h5>
    <div class="selectOptions" style="display:flex;justify-content:center;">
        <?php
            
                echo '<div><input type="radio" id="typeCinématique" name="Curve" value="Cinématique" class="inputRadioRectangle" checked/><label for="typeCinématique" onclick="document.getElementById(\'labelCurve\').innerHTML=\'Cinématique\';document.getElementById(\'rightPanel\').style.display=\'none\';document.getElementById(\'leftPanel\').style.display=\'inline\';document.getElementById(\'rightPanelKinetic\').style.display=\'none\';document.getElementById(\'leftPanelKinetic\').style.display=\'none\';document.getElementById(\'PanelPST\').style.display=\'none\';"><h5>Cinématique</h5></label></div>'
                .'<div><input type="radio" id="typeCinétique" name="Curve" value="Cinétique" class="inputRadioRectangle" /><label for="typeCinétique" onclick="document.getElementById(\'labelCurve\').innerHTML=\'Cinétique\';document.getElementById(\'leftPanelKinetic\').style.display=\'inline\';document.getElementById(\'rightPanelKinetic\').style.display=\'none\';document.getElementById(\'rightPanel\').style.display=\'none\';document.getElementById(\'leftPanel\').style.display=\'none\';document.getElementById(\'PanelPST\').style.display=\'none\';"><h5>Cinétique</h5></label></div>'
                .'<div><input type="radio" id="typeEMG" name="Curve" value="EMG" class="inputRadioRectangle"/><label for="typeEMG" onclick="document.getElementById(\'labelCurve\').innerHTML=\'EMG\'"><h5>EMG</h5></label></div>'
                .'<div><input type="radio" id="typePST" name="Curve" value="PST" class="inputRadioRectangle"/><label for="typePST" onclick="document.getElementById(\'labelCurve\').innerHTML=\'PST\';document.getElementById(\'PanelPST\').style.display=\'inline\';document.getElementById(\'rightPanel\').style.display=\'none\';document.getElementById(\'leftPanel\').style.display=\'none\';document.getElementById(\'rightPanelKinetic\').style.display=\'none\';document.getElementById(\'leftPanelKinetic\').style.display=\'none\'"><h5>PST</h5></label></div>'
                .'</div>'
                .'<style>'
                .'#inputSelectCurve:hover {'
                .'width:660px;'
                .'height:65px;'
                .'}'
                .'</style>';
            
            ?>
			
    </div>
<br/>

          
<div style="display:flex;justify-content:center;">
    <div class="buttonClassic active" style="width:150px;border-radius:10px;margin:10px;padding:10px;font-size:20px;" id="ButtonGauche">Gauche</div>
    <div class="buttonClassic" style="width:150px;border-radius:10px;margin:10px;padding:10px;font-size:20px;" id="ButtonDroit">Droite</div>
</div>
<div style="width:95%;overflow-x:hidden;left:0px;right:0px;margin:auto;margin-top:20px;">


<div id="leftPanel">
<div class="row">
<div class="col-lg-4">
<div id="container1" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container2" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container3" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div id="container4" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container5" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container6" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">

<div id="container7" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>
<div class="col-lg-4">

<div id="container8" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>
<div class="col-lg-4">

<div id="container9" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>
</div>
<div class="row">
<div class="col-lg-4">

<div id="container10" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>

<div class="col-lg-4">

<div id="container12" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>

</div>
</div>




<div id="rightPanel">
<div class="row">
<div class="col-lg-4">
<div id="container13" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container14" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container15" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div id="container16" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container17" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container18" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">

<div id="container19" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>
<div class="col-lg-4">

<div id="container20" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>
<div class="col-lg-4">

<div id="container21" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>
</div>
<div class="row">
<div class="col-lg-4">

<div id="container22" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>

<div class="col-lg-4">

<div id="container24" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>

</div>

</div>

</div>

<div id="leftPanelKinetic">
<div class="row">
<div class="col-lg-4">
<div id="container31" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container32" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container33" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div id="container34" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container35" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container36" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div id="container37" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container38" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container39" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>

</div>


<div id="rightPanelKinetic">
<div class="row">
<div class="col-lg-4">
<div id="container41" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container42" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container43" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div id="container44" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container45" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container46" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div id="container47" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container48" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container49" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>

</div>



<div id="PanelPST">
<div class="row">
<div class="col-lg-4">
<div id="container51" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container52" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
<div class="col-lg-4">
<div id="container53" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div id="container54" class="contains-chart" style="width: 100%; min-height: 250px; margin: 0 auto; position: relative;"></div>
</div>
</div>
</div>

</div>


<script>

//jQuery(document).ready(function () {
                       
                       // Build a chart
                       jQuery('#container1').highcharts({
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
                                                        text: 'Pelvis - Ante/Retro',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LPelvisAnglesX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LPelvisAnglesX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LPelvisAnglesXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LPelvisAnglesXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container2').highcharts({
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
                                                        text: 'Pelvis - Inclinaison',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'},
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LPelvisAnglesY[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LPelvisAnglesY[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LPelvisAnglesYMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LPelvisAnglesYMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container3').highcharts({
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
                                                        text: 'Pelvis - Rotation',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LPelvisAnglesZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LPelvisAnglesZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LPelvisAnglesZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LPelvisAnglesZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       
                       
                       
                       
                       jQuery('#container4').highcharts({
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
                                                        text: 'Hanche - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipAnglesX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipAnglesX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipAnglesXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipAnglesXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container5').highcharts({
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
                                                        text: 'Hanche - Abduction/Adduction',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipAnglesY[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipAnglesY[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipAnglesYMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipAnglesYMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container6').highcharts({
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
                                                        text: 'Hanche - Rotation Int/Ext',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipAnglesZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipAnglesZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipAnglesZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipAnglesZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       
                       
                       
                       
                       jQuery('#container7').highcharts({
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
                                                        text: 'Genou - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeAnglesX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeAnglesX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeAnglesXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeAnglesXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container8').highcharts({
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
                                                        text: 'Genou - Varus/Valgus',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeAnglesY[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeAnglesY[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeAnglesYMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeAnglesYMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container9').highcharts({
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
                                                        text: 'Genou - Rotation Int/Ext',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Angle (°)',
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
                                                        <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeAnglesZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeAnglesZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeAnglesZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeAnglesZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       
                       jQuery('#container10').highcharts({
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
                                                         text: 'Cheville - Flexion/Extension',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                         {
                                                         echo "'#FF2A2B'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($LAnkleAnglesX[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($LAnkleAnglesX[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($LAnkleAnglesXMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($LAnkleAnglesXMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       
                       jQuery('#container12').highcharts({
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
                                                         text: 'Angle de progression',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                         {
                                                         echo "'#FF2A2B'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $LCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($LFootProgressAnglesZ[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($LFootProgressAnglesZ[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($LFootProgressAnglesZMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($LFootProgressAnglesZMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       
                       
                       
                       
                       
                       
                       // Build a chart
                       jQuery('#container13').highcharts({
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
                                                         text: 'Pelvis - Ante/Retro',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RPelvisAnglesX[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RPelvisAnglesX[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RPelvisAnglesXMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RPelvisAnglesXMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       jQuery('#container14').highcharts({
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
                                                         text: 'Pelvis - Inclinaison',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RPelvisAnglesY[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RPelvisAnglesY[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RPelvisAnglesYMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RPelvisAnglesYMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       jQuery('#container15').highcharts({
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
                                                         text: 'Pelvis - Rotation',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RPelvisAnglesZ[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RPelvisAnglesZ[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RPelvisAnglesZMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RPelvisAnglesZMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       
                       
                       
                       
                       jQuery('#container16').highcharts({
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
                                                         text: 'Hanche - Flexion/Extension',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RHipAnglesX[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RHipAnglesX[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RHipAnglesXMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RHipAnglesXMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       jQuery('#container17').highcharts({
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
                                                         text: 'Hanche - Abduction/Adduction',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RHipAnglesY[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RHipAnglesY[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RHipAnglesYMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RHipAnglesYMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       jQuery('#container18').highcharts({
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
                                                         text: 'Hanche - Rotation Int/Ext',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RHipAnglesZ[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RHipAnglesZ[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RHipAnglesZMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RHipAnglesZMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       
                       
                       
                       
                       jQuery('#container19').highcharts({
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
                                                         text: 'Genou - Flexion/Extension',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RKneeAnglesX[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RKneeAnglesX[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RKneeAnglesXMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RKneeAnglesXMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       jQuery('#container20').highcharts({
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
                                                         text: 'Genou - Varus/Valgus',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RKneeAnglesY[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RKneeAnglesY[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RKneeAnglesYMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RKneeAnglesYMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       jQuery('#container21').highcharts({
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
                                                         text: 'Genou - Rotation Int/Ext',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RKneeAnglesZ[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RKneeAnglesZ[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RKneeAnglesZMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RKneeAnglesZMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       
                       jQuery('#container22').highcharts({
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
                                                         text: 'Cheville - Flexion/Extension',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RAnkleAnglesX[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RAnkleAnglesX[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RAnkleAnglesXMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RAnkleAnglesXMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
                       
                       jQuery('#container24').highcharts({
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
                                                         text: 'Angle de progression',
                                                         style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                         //x: -20 //center
                                                         },
                                                         colors: [
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo "'#4439FF'";
                                                         echo ',';
                                                         }
                                                         echo "'white'";
                                                         ?>
                                                         
                                                         ],
                                                         //subtitle: {
                                                         //	text: 'Source: WorldClimate.com',
                                                         //	x: -20
                                                         //},
                                                         //xAxis: {
                                                         //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                                                         //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                         //},
                                                         xAxis: {
                                                         tickColor: 'rgba(0,0,0,0)',
                                                         gridLineColor: 'rgba(0,0,0,0)'
                                                         },
                                                         yAxis: {
                                                         gridLineColor: 'rgba(0,0,0,0)',
                                                         title: {
                                                         text: 'Angle (°)',
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
                                                         <?php for ($j = 0; $j < $RCycleNumber; $j++)
                                                         {
                                                         echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RFootProgressAnglesZ[$i][$j],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RFootProgressAnglesZ[$i][$j],2);
                                                         echo ']},';
                                                         }
                                                         echo '{name: '; echo '"Moyenne",';
                                                         echo 'data:[';
                                                         
                                                         for ($i = 0; $i <= 99; $i++)
                                                         {
                                                         echo round($RFootProgressAnglesZMean[$i],2);
                                                         echo ",";
                                                         
                                                         }
                                                         echo round($RFootProgressAnglesZMean[$i],2);
                                                         echo ']}';
                                                         ?>
                                                         ]
                                                         
                                                         
                                                         
                                                         });
														 
							jQuery('#container31').highcharts({
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
                                                        text: 'Force latérale',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Force (N/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'N/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LGroundReactionForceY[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LGroundReactionForceY[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LGroundReactionForceYMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LGroundReactionForceYMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														 
							jQuery('#container32').highcharts({
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
                                                        text: 'Force antéro-postérieure',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Force (N/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'N/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LGroundReactionForceX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LGroundReactionForceX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LGroundReactionForceXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LGroundReactionForceXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
						
						jQuery('#container33').highcharts({
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
                                                        text: 'Force verticale',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Force (N/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'N/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LGroundReactionForceZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LGroundReactionForceZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LGroundReactionForceZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LGroundReactionForceZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container34').highcharts({
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
                                                        text: 'Moment - Hanche - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Moment (Nm/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'Nm/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipMomentX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipMomentX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipMomentXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipMomentXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
						
						jQuery('#container35').highcharts({
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
                                                        text: 'Moment - Genou - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Moment (Nm/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'Nm/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeMomentX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeMomentX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneeMomentXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneeMomentXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														
						jQuery('#container36').highcharts({
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
                                                        text: 'Moment - Cheville - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Moment (Nm/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'Nm/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LAnkleMomentX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LAnkleMomentX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LAnkleMomentXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LAnkleMomentXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														
														
														



					
                                                        
                                                        
                                                        
                   jQuery('#container37').highcharts({
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
                                                        text: 'Puissance - Hanche - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Puissance (W/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'W/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipPowerZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipPowerZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LHipPowerZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LHipPowerZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
						
						jQuery('#container38').highcharts({
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
                                                        text: 'Puissance - Genou - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Puissance (W/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'W/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneePowerZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneePowerZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LKneePowerZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LKneePowerZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														
						jQuery('#container39').highcharts({
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
                                                        text: 'Puissance - Cheville - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#FF2A2B'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Puissance (W/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'W/kg';
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
                                                        <?php for ($j = 0; $j < $LKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LAnklePowerZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LAnklePowerZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($LAnklePowerZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($LAnklePowerZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });														
                       
                       
					   
					   
					   
							jQuery('#container41').highcharts({
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
                                                        text: 'Force latérale',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Force (N/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'N/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RGroundReactionForceY[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RGroundReactionForceY[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RGroundReactionForceYMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RGroundReactionForceYMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														 
							jQuery('#container42').highcharts({
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
                                                        text: 'Force antéro-postérieure',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Force (N/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'N/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RGroundReactionForceX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RGroundReactionForceX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RGroundReactionForceXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RGroundReactionForceXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
						
						jQuery('#container43').highcharts({
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
                                                        text: 'Force verticale',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Force (N/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'N/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RGroundReactionForceZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RGroundReactionForceZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RGroundReactionForceZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RGroundReactionForceZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
                       jQuery('#container44').highcharts({
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
                                                        text: 'Moment - Hanche - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Moment (Nm/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'Nm/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RHipMomentX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RHipMomentX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RHipMomentXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RHipMomentXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
						
						jQuery('#container45').highcharts({
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
                                                        text: 'Moment - Genou - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Moment (Nm/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'Nm/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RKneeMomentX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RKneeMomentX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RKneeMomentXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RKneeMomentXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														
						jQuery('#container46').highcharts({
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
                                                        text: 'Moment - Cheville - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Moment (Nm/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'Nm/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RAnkleMomentX[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RAnkleMomentX[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RAnkleMomentXMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RAnkleMomentXMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														
														
														



					
                                                        
                                                        
                                                        
                   jQuery('#container47').highcharts({
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
                                                        text: 'Puissance - Hanche - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Puissance (W/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'W/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RHipPowerZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RHipPowerZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RHipPowerZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RHipPowerZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
						
						jQuery('#container48').highcharts({
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
                                                        text: 'Puissance - Genou - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Puissance (W/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'W/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RKneePowerZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RKneePowerZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RKneePowerZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RKneePowerZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });
														
						jQuery('#container49').highcharts({
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
                                                        text: 'Puissance - Cheville - Flexion/Extension',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        //x: -20 //center
                                                        },
                                                        colors: [
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo "'#4439FF'";
                                                        echo ',';
                                                        }
                                                        echo "'white'";
                                                        ?>
                                                        
                                                        ],
                                                        //subtitle: {
                                                        //	text: 'Source: WorldClimate.com',
                                                        //	x: -20
                                                        //},
                                                        //xAxis: {
                                                        //	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                        //		'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        //},
                                                        xAxis: {
                                                        tickColor: 'rgba(0,0,0,0)',
                                                        gridLineColor: 'rgba(0,0,0,0)'
                                                        },
                                                        yAxis: {
                                                        gridLineColor: 'rgba(0,0,0,0)',
                                                        title: {
                                                        text: 'Puissance (W/kg)',
                                                        style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
                                                        },
                                                        },
                                                        tooltip: {
                                                        formatter: function() {
                                                        return '<b>'+ this.series.name +'</b><br/>'+
                                                        this.y +'W/kg';
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
                                                        <?php for ($j = 0; $j < $RKineticCycleNumber; $j++)
                                                        {
                                                        echo '{name: '; echo '"Cycle ' ; echo $j+1; echo '",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RAnklePowerZ[$i][$j],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RAnklePowerZ[$i][$j],2);
                                                        echo ']},';
                                                        }
                                                        echo '{name: '; echo '"Moyenne",';
                                                        echo 'data:[';
                                                        
                                                        for ($i = 0; $i <= 99; $i++)
                                                        {
                                                        echo round($RAnklePowerZMean[$i],2);
                                                        echo ",";
                                                        
                                                        }
                                                        echo round($RAnklePowerZMean[$i],2);
                                                        echo ']}';
                                                        ?>
                                                        ]
                                                        
                                                        
                                                        
                                                        });							   
					   
					   
					  
													
					jQuery('#container51').highcharts({
														chart: {
															type: 'column',
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
															text: 'Paramètres Spatio-Temporels',
															style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
														},
														
														xAxis: {
															categories: [
																'Speed','Length Stride','Length Step','Width Step' 
																
															],
															labels: {
																style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif',"fontSize":'15px'}
															}
														},
														yAxis: [{
															min: 0,
															title:{text:'Longueur (m)'}
														},
														{title:{text:'Vitesse (m/s)'},opposite: true}],
														legend: {
															enabled: false
														},
														
														colors: [
                                                        <?php 
														for ($j = 0; $j < 4 -1; $j++)
														{
															echo "'#FF2A2B'";
															echo ',';
															echo "'#4439FF'";
															echo ',';
                                                        }
                                                        
														echo "'#FF2A2B'";
														echo ',';
														echo "'#4439FF'";
                                                        ?>
														],
														tooltip: {
                                                        formatter: function() {
	 
															if (this.x == 'Speed') 
																return this.y+'m/s';
															else
																return this.y+'m';
													
                                                        
                                                        
                                                        }
                                                        },
														plotOptions: {
															column: {
																pointPadding: 0.02,
																borderWidth: 0
															}
														},
														series: [{
															name: 'Gauche',
													
															data: [
															<?php
															for ($j = 4; $j < 9; $j=$j+2)
															{
																echo round($PST[$j],2);
																echo ',';
																
															}
															echo round($PST[$j],2);
															?>]
														}, {
															name: 'Droite',
															data: [
															<?php
															for ($j = 5; $j < 10; $j=$j+2)
															{
																echo round($PST[$j],2);
																echo ',';
															}
															echo round($PST[$j],2);
															?>]

														}]
													});


					
					
						jQuery('#container52').highcharts({
														chart: {
															type: 'column',
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
															text: 'Paramètres Spatio-Temporels',
															style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
														},
														
														xAxis: {
															categories: [
																'Stance','Swing' 
																
															],
															labels: {
																style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif',"fontSize":'15px'}
															}
														},
														yAxis: {
															min: 0,
															title:{text:'%'},
														},
														legend: {
															enabled: false
														},
														
														
														tooltip: {
                                                        formatter: function() {
                                                        return this.y+'%';
                                                        
                                                        }
                                                        },
														plotOptions: {
															column: {
																pointPadding: 0.02,
																borderWidth: 0,
																stacking: 'normal'
															}
														},
														colors: [
                                                        <?php 
														
														echo "'#FF2A2B'";
														echo ',';
														echo "'#FF5455'";
														echo ',';
                                                        echo "'#FF2A2B'";
														echo ',';
														echo "'#4439FF'";
														echo ',';
														echo "'#6960FF'";
														echo ',';
														echo "'#4439FF'";
														
														
														
														
                                                        ?>
														],
														series: [{
															index : 2,
															name: 'Left 1st double stance & swing',
															data: [
															<?php
																echo round($PST[16],2);
																echo ',';
																echo round($PST[22],2);
															?>],
															stack: 'Left' 
														}, {
															index : 1,
															name: 'Left simple stance',
															data: [
															<?php
																echo round($PST[18],2);
																echo ',';
																echo '0';
															?>],
															stack: 'Left' 

														},
														{
															index : 0,
															name: 'Left 2st double stance',
															data: [
															<?php
																echo round($PST[20],2);
																echo ',';
																echo '0';
															?>],
															stack: 'Left' 
														},
														{
															name: 'Right 1st double stance',
															data: [
															<?php
																echo round($PST[17],2);
																echo ',';
																echo round($PST[23],2);
															?>],
															stack: 'Right' 
														}, {
															name: 'Right simple stance',
															data: [
															<?php
																echo round($PST[19],2);
																echo ',';
																echo '0';
															?>],
															stack: 'Right' 

														},
														{
															name: 'Right 2st double stance',
															data: [
															<?php
																echo round($PST[21],2);
																echo ',';
																echo '0';
															?>],
															stack: 'Right' 
														}
														
														]
													});
					   
					   jQuery('#container53').highcharts({
														chart: {
															type: 'column',
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
															text: 'Paramètres Spatio-Temporels',
															style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif'}
														},
														
														xAxis: {
															categories: [
																'Normalcy Index','GDI','GPS' 
																
															],
															labels: {
																style: {"color": '#ff8c1a', "font-family": '"Raleway", sans-serif',"fontSize":'15px'}
															}
														},
														yAxis: {
															min: 0,
															title:{text:''},
														},
														legend: {
															enabled: false
														},
														
														colors: [
                                                        <?php 
														for ($j = 0; $j < 3 -1; $j++)
														{
															echo "'#FF2A2B'";
															echo ',';
															echo "'#4439FF'";
															echo ',';
                                                        }
                                                        
														echo "'#FF2A2B'";
														echo ',';
														echo "'#4439FF'";
                                                        ?>
														],
														tooltip: {
                                                        formatter: function() {
                                                        if (this.x == 'GDI') 
																return this.y+'%';
														if (this.x == 'GPS')
																return this.y+'°'
															else
																return this.y;
                                                        
                                                        }
                                                        },
														plotOptions: {
															column: {
																pointPadding: 0.02,
																borderWidth: 0
															}
														},
														series: [{
															name: 'Gauche',
															data: [
															<?php
															for ($j = 26; $j < 29; $j=$j+2)
															{
																echo round($PST[$j],2);
																echo ',';
																
															}
															echo round($PST[$j],2);
															?>]
														}, {
															name: 'Droite',
															data: [
															<?php
															for ($j = 27; $j < 30; $j=$j+2)
															{
																echo round($PST[$j],2);
																echo ',';
															}
															echo round($PST[$j],2);
															?>]

														}]
													});
					   
					   
                       // fix dimensions of chart that was in a hidden element
                       jQuery(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) { // on tab selection event
                                           jQuery( ".contains-chart" ).each(function() { // target each element with the .contains-chart class
                                                                            var chart = jQuery(this).highcharts(); // target the chart itself
                                                                            chart.reflow() // reflow that chart
                                                                            });
                                           });
						jQuery(document).on("click","#ButtonGauche",function() {
							if (document.getElementById('typeCinématique').checked)
							{
								document.getElementById('leftPanel').style.display='inline';document.getElementById('rightPanel').style.display='none';
							} 
							
							if (document.getElementById('typeCinétique').checked)
							{
								document.getElementById('leftPanelKinetic').style.display='inline';document.getElementById('rightPanelKinetic').style.display='none';
							}
							if (document.getElementById('typeEMG').checked)
							{
								alert("EMG");
							}
						});
						jQuery(document).on("click","#ButtonDroit",function() {
							if (document.getElementById('typeCinématique').checked)
							{
								document.getElementById('leftPanel').style.display='none';document.getElementById('rightPanel').style.display='inline';
							} 
							if (document.getElementById('typeCinétique').checked)
							{
								document.getElementById('leftPanelKinetic').style.display='none';document.getElementById('rightPanelKinetic').style.display='inline';
							}
							if (document.getElementById('typeEMG').checked)
							{
								alert("EMG");
							}
						});
						
						jQuery(document).on("click","#typePST",function() {
							document.getElementById('ButtonGauche').style.display='none';
							document.getElementById('ButtonDroit').style.display='none';
						});
						jQuery(document).on("click","#typeCinématique",function() {
							document.getElementById('ButtonGauche').style.display='inline';
							document.getElementById('ButtonDroit').style.display='inline';
						});
						jQuery(document).on("click","#typeCinétique",function() {
							document.getElementById('ButtonGauche').style.display='inline';
							document.getElementById('ButtonDroit').style.display='inline';
						});


                       
                       //});

</script>
