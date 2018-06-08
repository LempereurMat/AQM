-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2018 at 03:02 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqm_chru`
--

-- --------------------------------------------------------

--
-- Table structure for table `anthropometrie`
--

CREATE TABLE `anthropometrie` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Consultation_Utilisateur_ID` int(10) UNSIGNED NOT NULL,
  `Consultation_ID` int(10) UNSIGNED NOT NULL,
  `Taille` int(10) UNSIGNED DEFAULT NULL,
  `Masse` int(10) UNSIGNED DEFAULT NULL,
  `Longueur_jambe_G` int(10) UNSIGNED DEFAULT NULL,
  `Longueur_jambe_D` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_genou_G` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_genou_D` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_cheville_G` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_cheville_D` int(10) UNSIGNED DEFAULT NULL,
  `OCA_epaule_G` int(10) UNSIGNED DEFAULT NULL,
  `OCA_epaule_D` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_coude_G` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_coude_D` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_poignet_G` int(10) UNSIGNED DEFAULT NULL,
  `Largeur_poignet_D` int(10) UNSIGNED DEFAULT NULL,
  `Epaisseur_main_G` int(10) UNSIGNED DEFAULT NULL,
  `Epaisseur_main_D` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V1` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V2` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V3` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V4` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V5` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V6` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V7` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V8` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V9` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V10` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V11` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V12` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V13` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V14` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V15` int(10) UNSIGNED DEFAULT NULL,
  `Electromyographie_V16` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appareillage`
--

CREATE TABLE `appareillage` (
  `ID_appareillage` int(11) NOT NULL,
  `type_appareillage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appareillage`
--

INSERT INTO `appareillage` (`ID_appareillage`, `type_appareillage`) VALUES
(0, 'Sans appareillage'),
(1, '1 canne simple'),
(2, '2 cannes simples'),
(3, '1 canne tripod'),
(4, '2 cannes tripod'),
(5, 'Déambulateur antérieur'),
(6, 'Déambulateur postérieur'),
(7, 'Orthèse'),
(8, 'Bande de dérotation'),
(9, 'Prothèse'),
(10, 'Aide'),
(11, 'Corset'),
(12, 'Pompe'),
(13, 'Bloc'),
(20, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `bilan_clinique`
--

CREATE TABLE `bilan_clinique` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Consultation_Utilisateur_ID` int(10) UNSIGNED NOT NULL,
  `Consultation_ID` int(10) UNSIGNED NOT NULL,
  `Flexion_Hanche_G` varchar(10) DEFAULT NULL,
  `Flexion_Hanche_D` varchar(10) DEFAULT NULL,
  `Extension_Genou_0_G` varchar(10) DEFAULT NULL,
  `Extension_Genou_0_D` varchar(10) DEFAULT NULL,
  `Extension_Genou_90_G` varchar(10) DEFAULT NULL,
  `Extension_Genou_90_D` varchar(10) DEFAULT NULL,
  `Abduction_FH_FG_G` varchar(10) DEFAULT NULL,
  `Abduction_FH_FG_D` varchar(10) DEFAULT NULL,
  `Abduction_EH_EG_G` varchar(10) DEFAULT NULL,
  `Abduction_EH_EG_D` varchar(10) DEFAULT NULL,
  `Adduction_Hanche_G` varchar(10) DEFAULT NULL,
  `Adduction_Hanche_D` varchar(10) DEFAULT NULL,
  `Rot_Int_Hanche_G` varchar(10) DEFAULT NULL,
  `Rot_Ext_Hanche_G` varchar(10) DEFAULT NULL,
  `Rot_Int_Hanche_D` varchar(10) DEFAULT NULL,
  `Rot_Ext_Hanche_D` varchar(10) DEFAULT NULL,
  `Flexion_Genou_G` varchar(10) DEFAULT NULL,
  `Flexion_Genou_D` varchar(10) DEFAULT NULL,
  `Angle_Poplite_G1` varchar(10) DEFAULT NULL,
  `Angle_Poplite_G2` varchar(10) DEFAULT NULL,
  `Angle_Poplite_D1` varchar(10) DEFAULT NULL,
  `Angle_Poplite_D2` varchar(10) DEFAULT NULL,
  `Extension_Genou_G` varchar(10) DEFAULT NULL,
  `Extension_Genou_D` varchar(10) DEFAULT NULL,
  `Flexion_Cheville_EG_G` varchar(10) DEFAULT NULL,
  `Flexion_Cheville_EG_D` varchar(10) DEFAULT NULL,
  `Flexion_Cheville_FG_G` varchar(10) DEFAULT NULL,
  `Flexion_Cheville_FG_D` varchar(10) DEFAULT NULL,
  `Adductus_Abductus_Avant_Pied_G` varchar(10) DEFAULT NULL,
  `Adductus_Abductus_Avant_Pied_D` varchar(10) DEFAULT NULL,
  `Valgus_Varus_Calcaneum_G` varchar(10) DEFAULT NULL,
  `Valgus_Varus_Calcaneum_D` varchar(10) DEFAULT NULL,
  `Axe_Cuisse_Pied_G` varchar(10) DEFAULT NULL,
  `Axe_Cuisse_Pied_D` varchar(10) DEFAULT NULL,
  `ILMI` text,
  `Anteversion_G` varchar(10) DEFAULT NULL,
  `Anteversion_D` varchar(10) DEFAULT NULL,
  `Axe_Bimalleolaire_G` varchar(10) DEFAULT NULL,
  `Axe_Bimalleolaire_D` varchar(10) DEFAULT NULL,
  `Rotule_Haute_G` text,
  `Rotule_Haute_D` text,
  `Dislocation_Medio_Tarsienne_G` text,
  `Dislocation_Medio_Tarsienne_D` text,
  `Deroulement_Examen` text,
  `Gibbosite` text,
  `ElyTest_G` text,
  `ElyTest_D` text,
  `Force_Psoas_G` varchar(3) DEFAULT NULL,
  `Force_Psoas_D` varchar(3) DEFAULT NULL,
  `Force_Grand_Fessier_G` varchar(3) DEFAULT NULL,
  `Force_Grand_Fessier_D` varchar(3) DEFAULT NULL,
  `Force_Moyen_Fessier_G` varchar(3) DEFAULT NULL,
  `Force_Moyen_Fessier_D` varchar(3) DEFAULT NULL,
  `Force_Adducteur_G` varchar(3) DEFAULT NULL,
  `Force_Adducteur_D` varchar(3) DEFAULT NULL,
  `Force_Ischio_Jambier_G` varchar(3) DEFAULT NULL,
  `Force_Ischio_Jambier_D` varchar(3) DEFAULT NULL,
  `Force_Quadriceps_G` varchar(3) DEFAULT NULL,
  `Force_Quadriceps_D` varchar(3) DEFAULT NULL,
  `Force_Tibialis_Anterior_G` varchar(3) DEFAULT NULL,
  `Force_Tibialis_Anterior_D` varchar(3) DEFAULT NULL,
  `Force_Gastroc_G` varchar(3) DEFAULT NULL,
  `Force_Gastroc_D` varchar(3) DEFAULT NULL,
  `Force_Peroneus_G` varchar(3) DEFAULT NULL,
  `Force_Peroneus_D` varchar(3) DEFAULT NULL,
  `Force_Tibialis_Posterior_G` varchar(3) DEFAULT NULL,
  `Force_Tibialis_Posterior_D` varchar(3) DEFAULT NULL,
  `Boyd_G` varchar(3) DEFAULT NULL,
  `Boyd_D` varchar(3) DEFAULT NULL,
  `Ashworth_Adducteur_G` varchar(3) DEFAULT NULL,
  `Ashworth_Adducteur_D` varchar(3) DEFAULT NULL,
  `Ashworth_Ischio_Jambier_G` varchar(3) DEFAULT NULL,
  `Ashworth_Ischio_Jambier_D` varchar(3) DEFAULT NULL,
  `Ashworth_Quadriceps_G` varchar(3) DEFAULT NULL,
  `Ashworth_Quadriceps_D` varchar(3) DEFAULT NULL,
  `Tardieu_Quadriceps_G` varchar(3) DEFAULT NULL,
  `Tardieu_Quadriceps_D` varchar(3) DEFAULT NULL,
  `Ashworth_Tibialis_Anterior_G` varchar(3) DEFAULT NULL,
  `Ashworth_Tibialis_Anterior_D` varchar(3) DEFAULT NULL,
  `Ashworth_Gastroc_G` varchar(3) DEFAULT NULL,
  `Ashworth_Gastroc_D` varchar(3) DEFAULT NULL,
  `Tardieu_Gastroc_G1` varchar(3) DEFAULT NULL,
  `Tardieu_Gastroc_G2` varchar(3) DEFAULT NULL,
  `Tardieu_Gastroc_D1` varchar(3) DEFAULT NULL,
  `Tardieu_Gastroc_D2` varchar(3) DEFAULT NULL,
  `Ashworth_Peroneus_G` varchar(3) DEFAULT NULL,
  `Ashworth_Peroneus_D` varchar(3) DEFAULT NULL,
  `Tardieu_Peroneus_G1` varchar(3) DEFAULT NULL,
  `Tardieu_Peroneus_G2` varchar(3) DEFAULT NULL,
  `Tardieu_Peroneus_D1` varchar(3) DEFAULT NULL,
  `Tardieu_Peroneus_D2` varchar(3) DEFAULT NULL,
  `Ashworth_Tibialis_Posterior_G` varchar(3) DEFAULT NULL,
  `Ashworth_Tibialis_Posterior_D` varchar(3) DEFAULT NULL,
  `Tardieu_Tibialis_Posterior_G1` varchar(3) DEFAULT NULL,
  `Tardieu_Tibialis_Posterior_G2` varchar(3) DEFAULT NULL,
  `Tardieu_Tibialis_Posterior_D1` varchar(3) DEFAULT NULL,
  `Tardieu_Tibialis_Posterior_D2` varchar(3) DEFAULT NULL,
  `Taille` int(11) NOT NULL DEFAULT '0',
  `Masse` float NOT NULL DEFAULT '0',
  `Long_Jambe_G` int(11) NOT NULL DEFAULT '0',
  `Long_Jambe_D` int(11) NOT NULL DEFAULT '0',
  `Larg_Genou_G` int(11) NOT NULL DEFAULT '0',
  `Larg_Genou_D` int(11) NOT NULL DEFAULT '0',
  `Larg_Cheville_G` int(11) NOT NULL DEFAULT '0',
  `Larg_Cheville_D` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bilan_fonctionnel`
--

CREATE TABLE `bilan_fonctionnel` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Consultation_Utilisateur_ID` int(10) UNSIGNED NOT NULL,
  `Consultation_ID` int(10) UNSIGNED NOT NULL,
  `Classe_FAC` varchar(10) DEFAULT NULL,
  `Niveau_Palisano` varchar(10) DEFAULT NULL,
  `Perimetre_marche` varchar(100) DEFAULT NULL,
  `Aides_Techniques` varchar(10) DEFAULT NULL,
  `Eval_fonc_gillette` varchar(10) DEFAULT NULL,
  `Echelle_mobilite_fonc_5m` varchar(10) DEFAULT NULL,
  `Echelle_mobilite_fonc_50m` varchar(10) DEFAULT NULL,
  `Echelle_mobilite_fonc_500m` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cause_etiologie`
--

CREATE TABLE `cause_etiologie` (
  `ID` int(10) NOT NULL,
  `cause` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cause_etiologie`
--

INSERT INTO `cause_etiologie` (`ID`, `cause`) VALUES
(0, 'Non renseigné'),
(1, 'Prématurité'),
(2, 'AVC'),
(3, 'Tumeur'),
(4, 'Traumatisme cranien'),
(5, 'Autres');

-- --------------------------------------------------------

--
-- Table structure for table `conditionaqm`
--

CREATE TABLE `conditionaqm` (
  `ID_condition` int(11) NOT NULL,
  `type_condition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditionaqm`
--

INSERT INTO `conditionaqm` (`ID_condition`, `type_condition`) VALUES
(0, 'Pieds Nus'),
(1, 'Chaussures');

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Utilisateur_ID` int(10) UNSIGNED NOT NULL,
  `Hopital_ID` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `patients_ID_patient` int(10) NOT NULL,
  `Date_consultation` datetime NOT NULL,
  `Valide` tinyint(1) NOT NULL DEFAULT '0',
  `Date_validation` datetime DEFAULT NULL,
  `Condition` int(11) NOT NULL,
  `Appareillage` int(11) NOT NULL,
  `LCycleNumber` int(11) NOT NULL,
  `LPelvisAnglesX` longtext NOT NULL,
  `LPelvisAnglesY` longtext NOT NULL,
  `LPelvisAnglesZ` longtext NOT NULL,
  `LHipAnglesX` longtext NOT NULL,
  `LHipAnglesY` longtext NOT NULL,
  `LHipAnglesZ` longtext NOT NULL,
  `LKneeAnglesX` longtext NOT NULL,
  `LKneeAnglesY` longtext NOT NULL,
  `LKneeAnglesZ` longtext NOT NULL,
  `LAnkleAnglesX` longtext NOT NULL,
  `LAnkleAnglesY` longtext NOT NULL,
  `LAnkleAnglesZ` longtext NOT NULL,
  `LFootProgressAnglesX` longtext NOT NULL,
  `LFootProgressAnglesY` longtext NOT NULL,
  `LFootProgressAnglesZ` longtext NOT NULL,
  `LKineticCycleNumber` int(11) NOT NULL,
  `LHipMomentX` longtext NOT NULL,
  `LHipMomentY` longtext NOT NULL,
  `LHipMomentZ` longtext NOT NULL,
  `LKneeMomentX` longtext NOT NULL,
  `LKneeMomentY` longtext NOT NULL,
  `LKneeMomentZ` longtext NOT NULL,
  `LAnkleMomentX` longtext NOT NULL,
  `LAnkleMomentY` longtext NOT NULL,
  `LAnkleMomentZ` longtext NOT NULL,
  `LGroundReactionForceX` longtext NOT NULL,
  `LGroundReactionForceY` longtext NOT NULL,
  `LGroundReactionForceZ` longtext NOT NULL,
  `LHipPowerX` longtext NOT NULL,
  `LHipPowerY` longtext NOT NULL,
  `LHipPowerZ` longtext NOT NULL,
  `LKneePowerX` longtext NOT NULL,
  `LKneePowerY` longtext NOT NULL,
  `LKneePowerZ` longtext NOT NULL,
  `LAnklePowerX` longtext NOT NULL,
  `LAnklePowerY` longtext NOT NULL,
  `LAnklePowerZ` longtext NOT NULL,
  `RCycleNumber` int(11) NOT NULL,
  `RPelvisAnglesX` longtext NOT NULL,
  `RPelvisAnglesY` longtext NOT NULL,
  `RPelvisAnglesZ` longtext NOT NULL,
  `RHipAnglesX` longtext NOT NULL,
  `RHipAnglesY` longtext NOT NULL,
  `RHipAnglesZ` longtext NOT NULL,
  `RKneeAnglesX` longtext NOT NULL,
  `RKneeAnglesY` longtext NOT NULL,
  `RKneeAnglesZ` longtext NOT NULL,
  `RAnkleAnglesX` longtext NOT NULL,
  `RAnkleAnglesY` longtext NOT NULL,
  `RAnkleAnglesZ` longtext NOT NULL,
  `RFootProgressAnglesX` longtext NOT NULL,
  `RFootProgressAnglesY` longtext NOT NULL,
  `RFootProgressAnglesZ` longtext NOT NULL,
  `RKineticCycleNumber` int(11) NOT NULL,
  `RHipMomentX` longtext NOT NULL,
  `RHipMomentY` longtext NOT NULL,
  `RHipMomentZ` longtext NOT NULL,
  `RKneeMomentX` longtext NOT NULL,
  `RKneeMomentY` longtext NOT NULL,
  `RKneeMomentZ` longtext NOT NULL,
  `RAnkleMomentX` longtext NOT NULL,
  `RAnkleMomentY` longtext NOT NULL,
  `RAnkleMomentZ` longtext NOT NULL,
  `RGroundReactionForceX` longtext NOT NULL,
  `RGroundReactionForceY` longtext NOT NULL,
  `RGroundReactionForceZ` longtext NOT NULL,
  `RHipPowerX` longtext NOT NULL,
  `RHipPowerY` longtext NOT NULL,
  `RHipPowerZ` longtext NOT NULL,
  `RKneePowerX` longtext NOT NULL,
  `RKneePowerY` longtext NOT NULL,
  `RKneePowerZ` longtext NOT NULL,
  `RAnklePowerX` longtext NOT NULL,
  `RAnklePowerY` longtext NOT NULL,
  `RAnklePowerZ` longtext NOT NULL,
  `CompteRendu` text NOT NULL,
  `LSpeed` float NOT NULL DEFAULT '0',
  `RSpeed` float NOT NULL DEFAULT '0',
  `LCadence` float NOT NULL DEFAULT '0',
  `RCadence` float NOT NULL DEFAULT '0',
  `LDuration` float NOT NULL DEFAULT '0',
  `RDuration` float NOT NULL DEFAULT '0',
  `LLengthStride` float NOT NULL DEFAULT '0',
  `RLengthStride` float NOT NULL DEFAULT '0',
  `LLengthStep` float NOT NULL DEFAULT '0',
  `RLengthStep` float NOT NULL DEFAULT '0',
  `LWidth` float NOT NULL DEFAULT '0',
  `RWidth` float NOT NULL DEFAULT '0',
  `LStancePhaseSec` float NOT NULL DEFAULT '0',
  `RStancePhaseSec` float NOT NULL DEFAULT '0',
  `LStancePhasePercent` float NOT NULL DEFAULT '0',
  `RStancePhasePercent` float NOT NULL DEFAULT '0',
  `LFirstDoubleStance` float NOT NULL DEFAULT '0',
  `RFirstDoubleStance` float NOT NULL DEFAULT '0',
  `LSimpleStance` float NOT NULL DEFAULT '0',
  `RSimpleStance` float NOT NULL DEFAULT '0',
  `LSecondDoubleStance` float NOT NULL DEFAULT '0',
  `RSecondDoubleStance` float NOT NULL DEFAULT '0',
  `LSwingPhaseSec` float NOT NULL DEFAULT '0',
  `RSwingPhaseSec` float NOT NULL DEFAULT '0',
  `LSwingPhasePercent` float NOT NULL DEFAULT '0',
  `RSwingPhasePercent` float NOT NULL DEFAULT '0',
  `LNormalcyIndex` float NOT NULL DEFAULT '0',
  `RNormalcyIndex` float NOT NULL DEFAULT '0',
  `LGDI` float NOT NULL DEFAULT '0',
  `RGDI` float NOT NULL DEFAULT '0',
  `LGPS` float NOT NULL DEFAULT '0',
  `RGPS` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cote`
--

CREATE TABLE `cote` (
  `ID_Cote` int(11) NOT NULL,
  `Cote` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cote`
--

INSERT INTO `cote` (`ID_Cote`, `Cote`) VALUES
(0, ''),
(1, 'Gauche'),
(2, 'Droit'),
(3, 'Bilateral');

-- --------------------------------------------------------

--
-- Table structure for table `eos`
--

CREATE TABLE `eos` (
  `ID_EOS` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Long_Femur_D` int(11) NOT NULL,
  `Long_Femur_G` int(11) NOT NULL,
  `Long_Tibia_D` int(11) NOT NULL,
  `Long_Tibia_G` int(11) NOT NULL,
  `Long_Fonct_D` int(11) NOT NULL,
  `Long_Fonct_G` int(11) NOT NULL,
  `Long_Anat_D` int(11) NOT NULL,
  `Long_Anat_G` int(11) NOT NULL,
  `Diam_TF_D` int(11) NOT NULL,
  `Diam_TF_G` int(11) NOT NULL,
  `Offset_Femur_D` int(11) NOT NULL,
  `Offset_Femur_G` int(11) NOT NULL,
  `Long_Col_Fem_D` int(11) NOT NULL,
  `Long_Col_Fem_G` int(11) NOT NULL,
  `Neck_Shaft_Angle_D` int(11) NOT NULL,
  `Neck_Shaft_Angle_G` int(11) NOT NULL,
  `Knee_Varus_D` int(11) NOT NULL,
  `Knee_Varus_G` int(11) NOT NULL,
  `Knee_Flessum_D` int(11) NOT NULL,
  `Knee_Flessum_G` int(11) NOT NULL,
  `Angle_Fem_Meca_D` int(11) NOT NULL,
  `Angle_Fem_Meca_G` int(11) NOT NULL,
  `Angle_Tib_Meca_D` int(11) NOT NULL,
  `Angle_Tib_Meca_G` int(11) NOT NULL,
  `HKS_D` int(11) NOT NULL,
  `HKS_G` int(11) NOT NULL,
  `Torsion_Fem_D` int(11) NOT NULL,
  `Torsion_Fem_G` int(11) NOT NULL,
  `Torsion_Tib_D` int(11) NOT NULL,
  `Torsion_Tib_G` int(11) NOT NULL,
  `Rot_Fem_Tib_D` int(11) NOT NULL,
  `Rot_Fem_Tib_G` int(11) NOT NULL,
  `id_hopital` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `etiologie`
--

CREATE TABLE `etiologie` (
  `ID` int(11) NOT NULL,
  `origine` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etiologie`
--

INSERT INTO `etiologie` (`ID`, `origine`) VALUES
(1, 'Paralysie Cérébrale'),
(0, 'Non Renseigné'),
(2, 'Autres');

-- --------------------------------------------------------

--
-- Table structure for table `historique_modifications`
--

CREATE TABLE `historique_modifications` (
  `ID` int(10) UNSIGNED NOT NULL,
  `patients_ID_patient` int(10) NOT NULL,
  `Utilisateur_ID` int(10) UNSIGNED NOT NULL,
  `ID_consultation` int(10) UNSIGNED DEFAULT NULL,
  `Date_modification` datetime NOT NULL,
  `Element_modifie` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hopital`
--

CREATE TABLE `hopital` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Adresse` varchar(200) DEFAULT NULL,
  `Ville` varchar(100) DEFAULT NULL,
  `CP` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `localisationtraitement`
--

CREATE TABLE `localisationtraitement` (
  `ID_Localisation_Traitement` int(11) NOT NULL,
  `Localisation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `localisationtraitement`
--

INSERT INTO `localisationtraitement` (`ID_Localisation_Traitement`, `Localisation`) VALUES
(1, 'Adductor Magnus / Grand Adducteur'),
(2, 'Biceps Femoris / Biceps Femoral'),
(3, 'Extensor Hallucis Longus / Extenseur Propre du Grand Orteil'),
(4, 'Flexor Digitorum Longus / Flechisseur des Orteils'),
(5, 'Flexor Hallucis Longus / Flechisseur propre du Gros Orteil'),
(6, 'Gastroc-Soleus / Triceps Sural'),
(7, 'Gastrocnemius Medialis / Jumeau Interne'),
(8, 'Gastrocnemius Lateralis / Jumeau Externe'),
(9, 'Gluteus Maximus / Grand Fessier'),
(10, 'Gluteus Medius / Moyen Fessier'),
(11, 'Gracilis / Droit Interne'),
(12, 'Hamstring / Ischio-Jambiers'),
(13, 'Iliopsoas / Psoas Iliaque'),
(14, 'Peroneus Brevis / Peronier Court'),
(15, 'Peroneus Longus / Peronier Long'),
(16, 'Rectus Femoris / Droit Anterieur'),
(17, 'Sartorius / Couturier'),
(18, 'Semitendinosus / Semi-Tendineux'),
(19, 'Soleus / Soleaire'),
(20, 'Tibialis Anterior / Jambier Anterieur'),
(21, 'Tibialis Posterior / Jambier Posterieur'),
(22, 'Vastus Intermedius / Vaste Intermediaire'),
(23, 'Vastus Lateralis / Vaste Externe'),
(24, 'Vastus Medialis / Vaste interne'),
(25, 'Gastrocnemius / Jumeau'),
(26, 'Tendo Achillis / Tendon d\'Achille'),
(27, 'Fémur'),
(28, 'Rotule'),
(29, 'Tibia'),
(31, 'Trochanter');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID_message` int(11) NOT NULL,
  `emetteur` int(10) NOT NULL,
  `destinataire` int(10) NOT NULL,
  `message` longtext NOT NULL,
  `lu` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pathologies`
--

CREATE TABLE `pathologies` (
  `ID_patho` int(11) NOT NULL,
  `patients_ID_patient` int(10) NOT NULL,
  `patho` varchar(100) NOT NULL,
  `cote` varchar(100) NOT NULL,
  `type_patho` varchar(100) NOT NULL,
  `origine` varchar(100) NOT NULL,
  `etiologie` int(11) NOT NULL,
  `cause_etiologie` int(11) NOT NULL,
  `commentaire` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID_patient` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `IPP` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL,
  `Sexe` char(1) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `Historique_Patient` text,
  `age` varchar(20) NOT NULL,
  `hopital_ID` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plugin`
--

CREATE TABLE `plugin` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Version` varchar(45) NOT NULL,
  `Creator` varchar(45) NOT NULL,
  `State` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soustypetraitement`
--

CREATE TABLE `soustypetraitement` (
  `ID_Sous_Type_Traitement` int(11) NOT NULL,
  `SousTypeTraitement` varchar(100) NOT NULL,
  `TypeTraitement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soustypetraitement`
--

INSERT INTO `soustypetraitement` (`ID_Sous_Type_Traitement`, `SousTypeTraitement`, `TypeTraitement`) VALUES
(1, 'Botox', 2),
(2, 'Dysport', 2),
(3, 'Aponévrotomie', 1),
(4, 'Allongement', 1),
(5, 'Dérotation', 1),
(6, 'Abaissement', 1),
(7, 'Epiphysiodèse', 1),
(8, 'Désinsertion', 1),
(9, 'Transfert', 1),
(10, 'Ténotomie', 1);

-- --------------------------------------------------------

--
-- Table structure for table `traitement`
--

CREATE TABLE `traitement` (
  `ID_Traitement` int(11) NOT NULL,
  `Patients_ID` int(11) NOT NULL,
  `TypeTraitement_ID` int(11) NOT NULL,
  `SousTypeTraitement_ID` int(11) NOT NULL,
  `Localisation_ID` int(11) NOT NULL,
  `Cote_ID` int(100) NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Technique` varchar(256) NOT NULL,
  `Date` date NOT NULL,
  `Operateur_ID` int(11) NOT NULL,
  `hopital_ID` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `typetraitement`
--

CREATE TABLE `typetraitement` (
  `ID_Type_Traitement` int(11) NOT NULL,
  `TypeTraitement` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typetraitement`
--

INSERT INTO `typetraitement` (`ID_Type_Traitement`, `TypeTraitement`) VALUES
(1, 'Chirurgie'),
(2, 'Toxine');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `type` enum('Member','Administrator','Passive Member','Manager') NOT NULL DEFAULT 'Member',
  `id_hopital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `username`, `password`, `email`, `type`, `id_hopital`) VALUES
(1, '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'xxx@xxx.com', 'Administrator', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anthropometrie`
--
ALTER TABLE `anthropometrie`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Anthropometrie_FKIndex1` (`Consultation_ID`,`Consultation_Utilisateur_ID`);

--
-- Indexes for table `appareillage`
--
ALTER TABLE `appareillage`
  ADD PRIMARY KEY (`ID_appareillage`);

--
-- Indexes for table `bilan_clinique`
--
ALTER TABLE `bilan_clinique`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Bilan_FKIndex1` (`Consultation_ID`,`Consultation_Utilisateur_ID`);

--
-- Indexes for table `bilan_fonctionnel`
--
ALTER TABLE `bilan_fonctionnel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Bilan_fonctionnel_FKIndex1` (`Consultation_ID`,`Consultation_Utilisateur_ID`);

--
-- Indexes for table `cause_etiologie`
--
ALTER TABLE `cause_etiologie`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `conditionaqm`
--
ALTER TABLE `conditionaqm`
  ADD PRIMARY KEY (`ID_condition`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`ID`,`Utilisateur_ID`),
  ADD KEY `Consultation_FKIndex1` (`Utilisateur_ID`),
  ADD KEY `Consultation_FKIndex2` (`patients_ID_patient`),
  ADD KEY `Consultation_FKIndex3` (`Hopital_ID`);

--
-- Indexes for table `cote`
--
ALTER TABLE `cote`
  ADD PRIMARY KEY (`ID_Cote`);

--
-- Indexes for table `eos`
--
ALTER TABLE `eos`
  ADD PRIMARY KEY (`ID_EOS`);

--
-- Indexes for table `etiologie`
--
ALTER TABLE `etiologie`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `historique_modifications`
--
ALTER TABLE `historique_modifications`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Historique_modifications_FKIndex1` (`Utilisateur_ID`),
  ADD KEY `Historique_modifications_FKIndex2` (`patients_ID_patient`);

--
-- Indexes for table `hopital`
--
ALTER TABLE `hopital`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `localisationtraitement`
--
ALTER TABLE `localisationtraitement`
  ADD PRIMARY KEY (`ID_Localisation_Traitement`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID_message`);

--
-- Indexes for table `pathologies`
--
ALTER TABLE `pathologies`
  ADD PRIMARY KEY (`ID_patho`),
  ADD KEY `pathologies_FKIndex1` (`patients_ID_patient`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID_patient`);

--
-- Indexes for table `plugin`
--
ALTER TABLE `plugin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `soustypetraitement`
--
ALTER TABLE `soustypetraitement`
  ADD PRIMARY KEY (`ID_Sous_Type_Traitement`);

--
-- Indexes for table `traitement`
--
ALTER TABLE `traitement`
  ADD PRIMARY KEY (`ID_Traitement`);

--
-- Indexes for table `typetraitement`
--
ALTER TABLE `typetraitement`
  ADD PRIMARY KEY (`ID_Type_Traitement`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anthropometrie`
--
ALTER TABLE `anthropometrie`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `appareillage`
--
ALTER TABLE `appareillage`
  MODIFY `ID_appareillage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `bilan_clinique`
--
ALTER TABLE `bilan_clinique`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bilan_fonctionnel`
--
ALTER TABLE `bilan_fonctionnel`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cause_etiologie`
--
ALTER TABLE `cause_etiologie`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cote`
--
ALTER TABLE `cote`
  MODIFY `ID_Cote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `eos`
--
ALTER TABLE `eos`
  MODIFY `ID_EOS` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `etiologie`
--
ALTER TABLE `etiologie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `historique_modifications`
--
ALTER TABLE `historique_modifications`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hopital`
--
ALTER TABLE `hopital`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `localisationtraitement`
--
ALTER TABLE `localisationtraitement`
  MODIFY `ID_Localisation_Traitement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pathologies`
--
ALTER TABLE `pathologies`
  MODIFY `ID_patho` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID_patient` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plugin`
--
ALTER TABLE `plugin`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `soustypetraitement`
--
ALTER TABLE `soustypetraitement`
  MODIFY `ID_Sous_Type_Traitement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `traitement`
--
ALTER TABLE `traitement`
  MODIFY `ID_Traitement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `typetraitement`
--
ALTER TABLE `typetraitement`
  MODIFY `ID_Type_Traitement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
