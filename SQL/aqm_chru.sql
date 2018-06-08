-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2018 at 11:15 AM
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

--
-- Dumping data for table `traitement`
--

INSERT INTO `traitement` (`ID_Traitement`, `Patients_ID`, `TypeTraitement_ID`, `SousTypeTraitement_ID`, `Localisation_ID`, `Cote_ID`, `Quantite`, `Technique`, `Date`, `Operateur_ID`, `hopital_ID`) VALUES
(1, 435, 2, 2, 7, 2, 0, '', '2012-12-07', 5, 1),
(2, 435, 2, 2, 8, 2, 0, '', '2012-12-07', 5, 1),
(3, 435, 2, 2, 21, 2, 0, '', '2012-12-07', 5, 1),
(4, 334, 2, 2, 12, 2, 100, '', '2012-09-05', 5, 1),
(5, 334, 2, 2, 6, 2, 200, '', '2012-09-05', 5, 1),
(6, 334, 2, 2, 19, 2, 100, '', '2013-09-05', 5, 1),
(7, 334, 2, 2, 12, 2, 120, '', '2013-03-26', 5, 1),
(8, 334, 2, 2, 6, 2, 240, '', '2013-03-26', 5, 1),
(9, 334, 2, 2, 19, 2, 120, '', '2013-03-26', 5, 1),
(10, 547, 1, 3, 25, 1, 0, '', '2010-12-06', 6, 1),
(11, 547, 1, 3, 25, 2, 0, '', '2010-12-06', 6, 1),
(12, 350, 2, 1, 25, 1, 100, '', '2013-02-21', 7, 1),
(13, 350, 2, 1, 25, 2, 100, '', '2013-02-21', 7, 1),
(14, 350, 2, 1, 19, 1, 50, '', '2013-02-21', 7, 1),
(15, 350, 2, 1, 19, 2, 50, '', '2013-02-21', 7, 1),
(16, 493, 2, 2, 25, 1, 300, '', '2012-10-15', 5, 1),
(17, 493, 2, 2, 19, 1, 200, '', '2012-10-15', 5, 1),
(18, 493, 1, 3, 26, 1, 0, '', '2013-02-08', 6, 1),
(19, 152, 2, 1, 8, 2, 50, '', '2011-02-01', 5, 1),
(20, 152, 2, 1, 7, 2, 50, '', '2011-02-01', 5, 1),
(21, 558, 2, 2, 25, 1, 160, '', '2012-06-05', 5, 1),
(22, 558, 2, 2, 19, 1, 80, '', '2012-06-05', 5, 1),
(23, 558, 2, 2, 25, 1, 200, '', '2012-10-09', 5, 1),
(24, 558, 2, 2, 19, 1, 100, '', '2012-10-09', 5, 1),
(25, 558, 2, 1, 25, 1, 120, '', '2013-04-30', 5, 1),
(26, 558, 2, 1, 19, 1, 80, '', '2013-04-30', 5, 1),
(27, 108, 2, 2, 25, 1, 200, '', '2013-04-19', 5, 1),
(28, 108, 2, 2, 19, 1, 80, '', '2013-04-19', 5, 1),
(30, 460, 2, 1, 25, 1, 80, '', '2013-10-01', 5, 1),
(31, 460, 2, 1, 19, 1, 20, '', '2013-10-01', 5, 1),
(32, 173, 2, 2, 21, 2, 200, '', '2011-01-18', 5, 1),
(33, 442, 2, 2, 25, 2, 300, '', '2012-04-18', 5, 1),
(34, 442, 2, 2, 19, 2, 100, '', '2012-04-18', 5, 1),
(35, 442, 2, 2, 12, 2, 100, '', '2012-04-18', 5, 1),
(36, 442, 2, 2, 25, 2, 300, '', '2013-10-17', 5, 1),
(37, 442, 2, 2, 19, 2, 200, '', '2013-10-17', 5, 1),
(38, 442, 2, 2, 12, 2, 150, '', '2013-10-17', 5, 1),
(39, 442, 2, 2, 12, 1, 150, '', '2013-10-17', 5, 1),
(40, 399, 2, 2, 25, 1, 120, '', '2013-03-19', 5, 1),
(41, 399, 2, 2, 19, 1, 80, '', '2013-03-19', 5, 1),
(42, 399, 2, 2, 25, 1, 180, '', '2013-09-17', 5, 1),
(43, 399, 2, 2, 19, 1, 100, '', '2013-09-17', 5, 1),
(44, 456, 2, 1, 12, 1, 20, '', '2012-04-17', 5, 1),
(45, 456, 2, 1, 12, 2, 40, '', '2012-04-17', 5, 1),
(46, 456, 2, 1, 25, 2, 40, '', '2012-04-17', 5, 1),
(47, 456, 2, 1, 12, 2, 80, '', '2012-11-20', 5, 1),
(48, 456, 2, 1, 25, 2, 120, '', '2012-11-20', 5, 1),
(49, 456, 2, 1, 19, 2, 100, '', '2012-11-20', 5, 1),
(50, 456, 2, 1, 21, 2, 50, '', '2013-05-28', 5, 1),
(51, 456, 2, 1, 25, 2, 140, '', '2013-05-28', 5, 1),
(52, 456, 2, 1, 19, 2, 100, '', '2013-05-28', 5, 1),
(53, 386, 2, 2, 25, 2, 300, '', '2012-12-18', 5, 1),
(55, 386, 2, 2, 19, 2, 100, '', '2012-12-18', 5, 1),
(56, 386, 2, 2, 21, 2, 100, '', '2012-12-18', 5, 1),
(57, 250, 2, 2, 16, 2, 400, '', '2012-12-04', 5, 1),
(58, 250, 2, 2, 25, 2, 300, '', '2012-12-04', 5, 1),
(59, 250, 2, 2, 19, 2, 200, '', '2012-12-04', 5, 1),
(60, 250, 2, 2, 21, 2, 100, '', '2012-12-04', 5, 1),
(61, 250, 2, 2, 4, 2, 150, '', '2012-12-04', 5, 1),
(62, 250, 2, 2, 16, 2, 400, '', '2013-11-05', 5, 1),
(63, 250, 2, 2, 25, 2, 400, '', '2013-11-05', 5, 1),
(64, 250, 2, 2, 19, 2, 200, '', '2013-11-05', 5, 1),
(65, 250, 2, 2, 21, 2, 100, '', '2013-11-05', 5, 1),
(66, 144, 2, 2, 12, 1, 200, '', '2013-03-19', 5, 1),
(67, 144, 2, 2, 12, 2, 200, '', '2013-03-19', 5, 1),
(68, 144, 2, 2, 25, 1, 200, '', '2013-03-19', 5, 1),
(69, 144, 2, 2, 25, 2, 200, '', '2013-03-19', 5, 1),
(70, 144, 2, 2, 19, 1, 100, '', '2013-03-19', 5, 1),
(71, 144, 2, 2, 19, 2, 100, '', '2013-03-19', 5, 1),
(72, 144, 2, 2, 12, 1, 300, '', '2013-09-17', 5, 1),
(73, 144, 2, 2, 12, 2, 300, '', '2013-09-17', 5, 1),
(74, 144, 2, 2, 21, 1, 100, '', '2013-09-17', 5, 1),
(75, 144, 2, 2, 20, 2, 100, '', '2013-09-17', 5, 1),
(76, 144, 2, 2, 12, 1, 300, '', '2014-03-23', 5, 1),
(77, 144, 2, 2, 12, 2, 300, '', '2014-03-23', 5, 1),
(78, 144, 2, 2, 25, 1, 200, '', '2014-03-23', 5, 1),
(79, 144, 2, 2, 25, 2, 200, '', '2014-03-23', 5, 1),
(80, 135, 2, 2, 25, 1, 160, '', '2010-10-04', 5, 1),
(81, 135, 2, 2, 25, 2, 160, '', '2010-10-04', 5, 1),
(82, 135, 2, 2, 21, 2, 40, '', '2010-10-04', 5, 1),
(83, 135, 2, 2, 21, 1, 80, '', '2010-10-04', 5, 1),
(84, 135, 2, 2, 25, 1, 200, '', '2013-10-22', 5, 1),
(85, 135, 2, 2, 25, 2, 200, '', '2013-10-22', 5, 1),
(86, 135, 2, 2, 21, 1, 100, '', '2013-10-22', 5, 1),
(87, 135, 2, 2, 21, 2, 100, '', '2013-10-22', 5, 1),
(88, 135, 2, 2, 19, 1, 100, '', '2013-10-22', 5, 1),
(89, 135, 2, 2, 19, 2, 100, '', '2013-10-22', 5, 1),
(90, 536, 2, 2, 1, 1, 50, '', '2010-03-16', 5, 1),
(91, 536, 2, 2, 1, 2, 50, '', '2010-03-16', 5, 1),
(92, 536, 2, 2, 12, 1, 50, '', '2010-03-16', 5, 1),
(93, 536, 2, 2, 12, 2, 50, '', '2010-03-16', 5, 1),
(94, 536, 2, 2, 25, 1, 50, '', '2010-03-16', 5, 1),
(95, 536, 2, 2, 25, 2, 50, '', '2010-03-16', 5, 1),
(96, 536, 2, 2, 25, 1, 20, '', '0210-08-18', 5, 1),
(97, 536, 2, 2, 25, 2, 20, '', '2010-08-18', 5, 1),
(98, 536, 2, 2, 19, 1, 20, '', '2010-08-18', 5, 1),
(99, 536, 2, 2, 19, 2, 20, '', '2010-08-18', 5, 1),
(100, 536, 2, 2, 16, 1, 100, '', '2010-08-18', 5, 1),
(101, 536, 2, 2, 16, 2, 50, '', '2010-08-18', 5, 1),
(102, 536, 2, 2, 13, 1, 100, '', '2010-08-18', 5, 1),
(103, 536, 2, 2, 13, 2, 100, '', '2010-08-18', 5, 1),
(104, 536, 2, 2, 12, 1, 80, '', '2011-08-16', 5, 1),
(105, 536, 2, 2, 12, 2, 100, '', '2011-08-16', 5, 1),
(106, 536, 2, 2, 1, 1, 90, '', '2011-08-16', 5, 1),
(107, 536, 2, 2, 1, 2, 100, '', '2011-08-16', 5, 1),
(108, 536, 2, 2, 16, 1, 40, '', '2011-08-16', 5, 1),
(109, 536, 2, 2, 16, 2, 30, '', '2011-08-16', 5, 1),
(110, 536, 2, 2, 16, 2, 30, '', '2011-08-16', 5, 1),
(111, 536, 2, 2, 25, 1, 100, '', '2012-10-23', 5, 1),
(112, 536, 2, 2, 25, 2, 120, '', '2012-10-23', 5, 1),
(113, 536, 2, 2, 12, 1, 80, '', '2012-10-23', 5, 1),
(114, 536, 2, 2, 12, 2, 100, '', '2012-10-23', 5, 1),
(115, 536, 2, 2, 16, 1, 50, '', '2012-10-23', 5, 1),
(116, 536, 2, 2, 16, 2, 50, '', '2012-10-23', 5, 1),
(117, 536, 2, 2, 25, 1, 160, '', '2013-10-29', 5, 1),
(118, 536, 2, 2, 12, 1, 100, '', '2013-10-29', 5, 1),
(119, 536, 2, 2, 25, 2, 150, '', '2013-10-29', 5, 1),
(120, 536, 2, 2, 1, 1, 100, '', '2013-10-29', 5, 1),
(121, 536, 2, 2, 1, 2, 100, '', '2013-10-29', 5, 1),
(122, 536, 2, 2, 25, 1, 160, '', '2014-05-06', 5, 1),
(123, 536, 2, 2, 12, 1, 150, '', '2014-05-06', 5, 1),
(124, 536, 2, 2, 12, 2, 150, '', '2014-05-06', 5, 1),
(125, 536, 2, 2, 1, 1, 100, '', '2014-05-06', 5, 1),
(126, 536, 2, 2, 1, 2, 100, '', '2014-05-06', 5, 1),
(127, 141, 2, 2, 8, 1, 100, '', '2010-01-01', 5, 1),
(128, 141, 2, 2, 7, 1, 100, '', '2010-01-01', 5, 1),
(129, 141, 2, 2, 19, 1, 200, '', '2010-01-01', 5, 1),
(130, 141, 2, 2, 8, 1, 150, '', '2010-11-23', 5, 1),
(131, 141, 2, 2, 7, 1, 150, '', '2010-11-23', 5, 1),
(132, 141, 2, 2, 19, 1, 50, '', '2010-11-23', 5, 1),
(133, 141, 2, 2, 8, 1, 300, '', '2011-09-14', 5, 1),
(134, 141, 2, 2, 7, 1, 150, '', '2011-09-14', 5, 1),
(135, 141, 2, 2, 19, 1, 100, '', '2011-09-14', 5, 1),
(136, 141, 1, 4, 26, 1, 0, '', '2013-09-01', 6, 1),
(137, 343, 2, 2, 25, 2, 300, '', '2013-11-05', 5, 1),
(138, 343, 2, 2, 19, 2, 200, '', '2013-11-05', 5, 1),
(139, 343, 2, 2, 25, 2, 300, '', '2014-10-21', 5, 1),
(140, 343, 2, 2, 19, 2, 200, '', '2014-10-21', 5, 1),
(141, 343, 2, 2, 12, 2, 200, '', '2014-10-21', 5, 1),
(142, 400, 2, 2, 19, 1, 100, '', '2011-04-05', 5, 1),
(143, 400, 2, 2, 25, 1, 300, '', '2011-04-05', 5, 1),
(144, 400, 2, 2, 19, 1, 100, '', '2011-10-18', 5, 1),
(145, 400, 2, 2, 6, 1, 300, '', '2011-10-18', 5, 1),
(146, 400, 2, 2, 19, 1, 200, '', '2012-04-03', 5, 1),
(147, 400, 2, 2, 25, 1, 300, '', '2012-04-03', 5, 1),
(148, 400, 2, 2, 19, 1, 300, '', '2012-10-09', 5, 1),
(149, 400, 2, 2, 25, 1, 200, '', '2012-10-09', 5, 1),
(150, 400, 2, 2, 25, 1, 300, '', '2013-05-21', 5, 1),
(151, 400, 2, 2, 19, 1, 300, '', '2014-04-22', 5, 1),
(152, 400, 2, 2, 25, 1, 400, '', '2014-04-22', 5, 1),
(153, 634, 2, 2, 25, 1, 160, '', '2014-06-23', 5, 1),
(154, 634, 2, 2, 19, 1, 60, '', '2014-06-23', 5, 1),
(155, 634, 2, 2, 21, 1, 50, '', '2014-06-23', 5, 1),
(156, 295, 2, 2, 1, 1, 150, '', '2011-06-14', 5, 1),
(157, 295, 2, 2, 1, 2, 150, '', '2011-06-14', 5, 1),
(158, 295, 2, 2, 11, 1, 100, '', '2011-06-14', 5, 1),
(159, 295, 2, 2, 11, 2, 100, '', '2011-06-14', 5, 1),
(160, 295, 2, 2, 1, 1, 150, '', '2011-11-22', 5, 1),
(161, 295, 2, 2, 1, 2, 150, '', '2011-11-22', 5, 1),
(162, 295, 2, 2, 11, 1, 100, '', '2011-11-22', 5, 1),
(163, 295, 2, 2, 11, 2, 100, '', '2011-11-22', 5, 1),
(164, 295, 2, 2, 1, 1, 150, '', '2012-05-22', 5, 1),
(165, 295, 2, 2, 1, 2, 150, '', '2012-05-22', 5, 1),
(166, 295, 2, 2, 11, 1, 100, '', '2012-05-22', 5, 1),
(167, 295, 2, 2, 11, 2, 100, '', '2012-05-22', 5, 1),
(168, 295, 2, 2, 16, 1, 100, '', '2012-05-22', 5, 1),
(169, 295, 2, 2, 16, 2, 100, '', '2012-05-22', 5, 1),
(170, 295, 2, 2, 1, 1, 150, '', '2012-10-02', 5, 1),
(171, 295, 2, 2, 1, 2, 150, '', '2012-10-02', 5, 1),
(172, 295, 2, 2, 11, 1, 100, '', '2012-10-02', 5, 1),
(173, 295, 2, 2, 11, 2, 100, '', '2012-10-02', 5, 1),
(174, 295, 2, 2, 1, 1, 200, '', '2013-03-05', 5, 1),
(175, 295, 2, 2, 1, 2, 200, '', '2013-03-05', 5, 1),
(176, 295, 2, 2, 11, 1, 100, '', '2013-03-05', 5, 1),
(177, 295, 2, 2, 11, 2, 100, '', '2013-03-05', 5, 1),
(178, 295, 2, 2, 1, 1, 200, '', '2013-08-13', 5, 1),
(179, 295, 2, 2, 1, 2, 200, '', '2013-08-13', 5, 1),
(180, 295, 2, 2, 11, 1, 100, '', '2013-08-13', 5, 1),
(181, 295, 2, 2, 11, 2, 100, '', '2013-08-13', 5, 1),
(182, 295, 2, 2, 1, 1, 250, '', '2014-02-11', 5, 1),
(183, 295, 2, 2, 1, 2, 200, '', '2014-02-11', 5, 1),
(184, 295, 2, 2, 11, 2, 50, '', '2014-02-11', 5, 1),
(185, 456, 2, 2, 8, 2, 150, '', '2014-04-15', 5, 1),
(186, 456, 2, 2, 7, 2, 150, '', '2014-04-15', 5, 1),
(187, 456, 2, 2, 19, 2, 200, '', '2014-04-15', 5, 1),
(188, 456, 2, 2, 8, 2, 150, '', '2014-10-21', 5, 1),
(189, 456, 2, 2, 7, 2, 150, '', '2014-10-21', 5, 1),
(190, 456, 2, 2, 19, 2, 200, '', '2014-10-21', 5, 1),
(191, 574, 1, 3, 6, 1, 0, '', '2014-04-14', 6, 1),
(192, 574, 1, 3, 6, 2, 0, '', '2014-04-14', 6, 1),
(193, 138, 2, 1, 21, 1, 15, '', '2012-02-16', 5, 1),
(194, 138, 2, 1, 12, 1, 20, '', '2012-02-16', 5, 1),
(195, 138, 2, 1, 11, 1, 20, '', '2012-02-16', 5, 1),
(196, 138, 2, 1, 21, 1, 30, '', '2012-09-20', 5, 1),
(197, 138, 2, 1, 12, 1, 30, '', '2012-09-20', 5, 1),
(198, 138, 2, 1, 11, 1, 10, '', '2012-09-20', 5, 1),
(199, 138, 2, 1, 21, 1, 25, '', '2013-03-21', 5, 1),
(200, 138, 2, 1, 12, 1, 30, '', '2013-03-21', 5, 1),
(201, 138, 2, 1, 11, 1, 10, '', '2013-03-21', 5, 1),
(202, 138, 2, 1, 25, 1, 20, '', '2013-03-21', 5, 1),
(203, 138, 2, 1, 19, 1, 10, '', '2013-03-21', 5, 1),
(204, 138, 2, 1, 21, 1, 25, '', '2013-09-19', 5, 1),
(205, 138, 2, 1, 19, 1, 10, '', '2013-09-19', 5, 1),
(206, 138, 2, 1, 25, 1, 60, '', '2013-09-19', 5, 1),
(207, 138, 2, 1, 1, 1, 10, '', '2013-09-19', 5, 1),
(208, 138, 2, 1, 11, 1, 10, '', '2013-09-19', 5, 1),
(209, 138, 2, 1, 21, 1, 25, '', '2014-04-17', 5, 1),
(210, 138, 2, 1, 19, 1, 15, '', '2014-04-17', 5, 1),
(211, 138, 2, 1, 25, 1, 50, '', '2014-04-17', 5, 1),
(212, 138, 2, 1, 12, 1, 20, '', '2014-04-17', 5, 1),
(213, 138, 2, 1, 21, 1, 25, '', '2014-09-18', 5, 1),
(214, 138, 2, 1, 19, 1, 20, '', '2014-09-18', 5, 1),
(215, 138, 2, 1, 25, 1, 50, '', '2014-09-18', 5, 1),
(216, 138, 2, 1, 12, 1, 20, '', '2014-09-18', 5, 1),
(217, 558, 2, 1, 25, 1, 120, '', '2013-10-29', 5, 1),
(218, 558, 2, 1, 19, 1, 80, '', '2013-10-29', 5, 1),
(219, 596, 2, 1, 25, 1, 150, '', '2014-11-25', 7, 1),
(220, 596, 2, 1, 25, 2, 150, '', '2014-11-25', 7, 1),
(221, 596, 2, 1, 19, 1, 100, '', '2014-11-25', 7, 1),
(222, 596, 2, 1, 19, 2, 100, '', '2014-11-25', 7, 1),
(223, 584, 2, 2, 7, 2, 100, '', '2014-09-24', 5, 1),
(224, 584, 2, 2, 8, 2, 100, '', '2014-09-24', 5, 1),
(225, 584, 2, 1, 19, 2, 100, '', '2014-09-24', 5, 1),
(226, 584, 2, 2, 7, 2, 150, '', '2015-03-31', 5, 1),
(227, 584, 2, 2, 8, 2, 150, '', '2015-03-31', 5, 1),
(228, 584, 2, 1, 19, 2, 200, '', '2015-03-31', 5, 1),
(229, 534, 2, 2, 25, 1, 140, '', '2013-08-20', 5, 1),
(230, 534, 2, 2, 25, 2, 140, '', '2013-08-20', 5, 1),
(231, 534, 2, 2, 19, 1, 100, '', '2013-08-20', 5, 1),
(232, 534, 2, 2, 19, 2, 100, '', '2013-08-20', 5, 1),
(233, 534, 2, 2, 25, 1, 120, '', '2013-01-29', 5, 1),
(234, 534, 2, 2, 25, 2, 120, '', '2013-01-29', 5, 1),
(235, 534, 2, 2, 19, 1, 40, '', '2013-01-29', 5, 1),
(236, 534, 2, 2, 19, 2, 40, '', '2013-01-29', 5, 1),
(237, 731, 2, 1, 7, 1, 50, '', '2015-10-13', 5, 1),
(238, 731, 2, 1, 8, 1, 50, '', '2015-10-13', 5, 1),
(239, 731, 2, 1, 12, 1, 50, '', '2015-10-13', 5, 1),
(240, 759, 2, 2, 8, 1, 150, '', '2016-02-16', 5, 1),
(241, 759, 2, 2, 7, 1, 150, '', '2016-02-16', 5, 1),
(242, 531, 2, 2, 12, 1, 150, '', '2015-03-10', 5, 1),
(243, 531, 2, 2, 12, 2, 150, '', '2015-03-10', 5, 1),
(244, 531, 2, 2, 1, 1, 150, '', '2015-03-10', 5, 1),
(245, 531, 2, 2, 1, 2, 150, '', '2015-03-10', 5, 1),
(246, 531, 2, 2, 16, 1, 80, '', '2015-03-10', 5, 1),
(247, 531, 2, 2, 21, 1, 80, '', '2015-03-10', 5, 1),
(248, 818, 1, 4, 26, 1, 0, '', '2016-11-23', 9, 1),
(249, 818, 1, 4, 26, 2, 0, '', '2016-11-23', 9, 1),
(250, 822, 2, 2, 7, 2, 80, '', '2016-08-16', 8, 1),
(251, 822, 2, 2, 8, 1, 80, '', '2016-08-16', 8, 1),
(252, 822, 2, 2, 19, 2, 80, '', '2016-08-16', 8, 1),
(253, 822, 2, 2, 7, 2, 60, '', '2015-07-07', 8, 1),
(254, 822, 2, 2, 8, 2, 60, '', '2015-07-07', 8, 1),
(255, 822, 2, 2, 19, 2, 60, '', '2015-07-07', 8, 1),
(256, 626, 2, 2, 7, 2, 50, '', '2014-12-16', 5, 1),
(257, 626, 2, 2, 8, 2, 50, '', '2014-12-16', 5, 1),
(258, 626, 2, 2, 19, 2, 100, '', '2014-12-16', 5, 1),
(259, 626, 2, 2, 12, 2, 100, '', '2014-12-16', 5, 1),
(260, 549, 1, 5, 27, 1, 0, '', '2016-03-14', 10, 4),
(261, 549, 1, 5, 27, 2, 0, '', '2016-03-14', 10, 4),
(262, 549, 1, 6, 28, 1, 0, '', '2016-03-14', 10, 4),
(263, 549, 1, 6, 28, 2, 0, '', '2016-03-14', 10, 4),
(264, 549, 1, 4, 21, 1, 0, '', '2016-03-14', 10, 4),
(265, 549, 1, 4, 21, 2, 0, '', '2016-03-14', 10, 4),
(266, 549, 1, 4, 26, 1, 0, '', '2016-03-14', 10, 4),
(267, 549, 1, 4, 26, 2, 0, '', '2016-03-14', 10, 4),
(268, 836, 2, 2, 8, 2, 100, '', '2016-06-07', 5, 1),
(269, 836, 2, 2, 7, 2, 100, '', '2016-06-07', 5, 1),
(270, 836, 2, 2, 19, 2, 100, '', '2016-06-07', 5, 1),
(271, 295, 2, 2, 1, 1, 250, '', '2014-08-26', 5, 1),
(272, 295, 2, 2, 1, 2, 200, '', '2014-08-26', 5, 1),
(273, 295, 2, 2, 11, 1, 75, '', '2014-08-26', 5, 1),
(274, 295, 2, 2, 11, 2, 75, '', '2014-08-26', 5, 1),
(275, 722, 1, 6, 31, 2, 0, '', '2016-07-18', 9, 1),
(276, 722, 1, 5, 29, 2, 0, '', '2016-07-18', 9, 1),
(277, 722, 1, 7, 27, 1, 0, '', '2016-07-18', 9, 1),
(278, 544, 1, 8, 16, 2, 0, '', '2015-06-17', 9, 1),
(279, 83, 2, 2, 6, 1, 200, '', '2012-10-02', 5, 1),
(280, 83, 2, 2, 6, 2, 200, '', '2012-10-02', 5, 1),
(281, 83, 2, 2, 19, 1, 100, '', '2012-10-02', 5, 1),
(282, 83, 2, 2, 19, 2, 100, '', '2012-10-02', 5, 1),
(283, 83, 2, 2, 12, 1, 150, '', '2012-10-02', 5, 1),
(284, 83, 2, 2, 12, 2, 150, '', '2012-10-02', 5, 1),
(285, 83, 2, 2, 6, 1, 200, '', '2013-03-05', 5, 1),
(286, 83, 2, 2, 6, 2, 200, '', '2013-03-05', 5, 1),
(287, 83, 2, 2, 19, 1, 100, '', '2013-03-05', 5, 1),
(288, 83, 2, 2, 19, 2, 100, '', '2013-03-05', 5, 1),
(289, 83, 2, 2, 12, 1, 200, '', '2013-03-05', 5, 1),
(290, 83, 2, 2, 12, 2, 200, '', '2013-03-05', 5, 1),
(291, 83, 2, 2, 6, 1, 300, '', '2013-09-27', 5, 1),
(292, 83, 2, 2, 6, 2, 300, '', '2013-09-27', 5, 1),
(293, 83, 2, 2, 19, 1, 150, '', '2013-09-27', 5, 1),
(294, 83, 2, 2, 19, 2, 150, '', '2013-09-27', 5, 1),
(297, 83, 2, 2, 6, 1, 320, '', '2014-08-12', 5, 1),
(298, 83, 2, 2, 6, 2, 320, '', '2014-08-12', 5, 1),
(299, 83, 2, 2, 19, 1, 180, '', '2014-08-12', 5, 1),
(300, 83, 2, 2, 19, 2, 180, '', '2014-08-12', 5, 1),
(301, 846, 2, 2, 7, 1, 100, '', '2014-12-02', 5, 1),
(302, 846, 2, 2, 8, 1, 100, '', '2014-12-02', 5, 1),
(303, 846, 2, 2, 19, 1, 100, '', '2014-12-02', 5, 1),
(304, 846, 2, 2, 7, 1, 80, '', '2015-06-09', 5, 1),
(305, 846, 2, 2, 8, 1, 80, '', '2015-06-09', 5, 1),
(306, 846, 2, 2, 19, 1, 100, '', '2015-06-09', 5, 1),
(307, 846, 2, 2, 7, 1, 80, '', '2015-12-08', 5, 1),
(308, 846, 2, 2, 8, 1, 80, '', '2015-12-08', 5, 1),
(309, 846, 2, 2, 19, 1, 140, '', '2015-12-08', 5, 1),
(310, 846, 2, 2, 7, 1, 80, '', '2016-05-26', 5, 1),
(311, 846, 2, 2, 8, 1, 80, '', '2016-05-26', 5, 1),
(312, 846, 2, 2, 19, 1, 140, '', '2016-05-26', 5, 1),
(313, 846, 2, 2, 7, 1, 100, '', '2017-01-13', 5, 1),
(314, 846, 2, 2, 8, 1, 100, '', '2017-01-13', 5, 1),
(315, 846, 2, 2, 19, 1, 140, '', '2017-01-13', 5, 1),
(316, 862, 2, 2, 12, 1, 80, '-', '2017-03-28', 8, 1),
(317, 862, 2, 2, 12, 2, 120, '-', '2017-03-28', 8, 1),
(318, 862, 2, 2, 1, 1, 80, '-', '2017-03-28', 8, 1),
(319, 862, 2, 2, 1, 2, 120, '-', '2017-03-28', 8, 1),
(320, 862, 2, 2, 11, 1, 50, '-', '2017-03-28', 8, 1),
(321, 862, 2, 2, 11, 2, 50, '-', '2017-03-28', 8, 1),
(322, 860, 2, 1, 16, 1, 80, '', '2017-08-09', 4, 1),
(323, 881, 2, 2, 8, 2, 100, '', '2017-04-13', 5, 1),
(324, 881, 2, 2, 7, 2, 100, '', '2017-04-13', 5, 1),
(325, 881, 2, 2, 8, 1, 80, '', '2017-04-13', 5, 1),
(326, 881, 2, 2, 7, 1, 80, '', '2017-04-13', 5, 1),
(327, 881, 2, 2, 8, 2, 80, '', '2017-11-21', 5, 1),
(328, 881, 2, 2, 7, 2, 80, '', '2017-11-21', 5, 1),
(329, 881, 2, 2, 8, 1, 60, '', '2017-11-21', 5, 1),
(330, 881, 2, 2, 7, 1, 60, '', '2017-11-21', 5, 1),
(331, 873, 2, 1, 7, 2, 60, '', '2017-10-24', 4, 1),
(332, 873, 2, 1, 8, 2, 60, '', '2017-10-24', 4, 1),
(333, 873, 2, 1, 19, 2, 80, '', '2017-10-24', 4, 1),
(334, 584, 2, 2, 7, 2, 200, '', '2015-09-29', 5, 1),
(335, 584, 2, 2, 8, 2, 200, '', '2015-09-29', 5, 1),
(336, 584, 2, 2, 19, 2, 200, '', '2015-09-29', 5, 1),
(337, 584, 2, 2, 21, 2, 100, '', '2015-09-29', 5, 1),
(338, 584, 1, 4, 26, 2, 0, '', '2016-04-25', 9, 1),
(339, 584, 1, 9, 21, 2, 0, '', '2016-04-25', 9, 1),
(340, 376, 2, 2, 8, 2, 150, '', '2013-05-21', 5, 1),
(341, 376, 2, 2, 7, 2, 150, '', '2013-05-21', 5, 1),
(342, 376, 2, 2, 8, 1, 150, '', '2013-05-21', 5, 1),
(343, 376, 2, 2, 7, 1, 150, '', '2013-05-21', 5, 1),
(344, 376, 2, 2, 19, 2, 200, '', '2013-05-21', 5, 1),
(345, 376, 2, 2, 19, 1, 200, '', '2013-05-21', 5, 1),
(346, 376, 2, 2, 8, 2, 200, '', '2013-11-12', 5, 1),
(347, 376, 2, 2, 7, 2, 200, '', '2013-11-12', 5, 1),
(348, 376, 2, 2, 8, 1, 150, '', '2013-11-12', 5, 1),
(349, 376, 2, 2, 7, 1, 150, '', '2013-11-12', 5, 1),
(350, 376, 2, 2, 19, 2, 300, '', '2013-11-12', 5, 1),
(351, 376, 2, 2, 19, 1, 200, '', '2013-11-12', 5, 1),
(352, 376, 2, 2, 21, 1, 150, '', '2013-11-12', 5, 1),
(353, 376, 1, 3, 6, 1, 0, '', '2014-03-25', 9, 1),
(354, 376, 1, 3, 6, 2, 0, '', '2014-03-25', 9, 1),
(355, 376, 2, 2, 8, 2, 175, '', '2016-09-13', 5, 1),
(356, 376, 2, 2, 7, 2, 175, '', '2016-09-13', 5, 1),
(357, 376, 2, 2, 8, 1, 175, '', '2016-09-13', 5, 1),
(358, 376, 2, 2, 7, 1, 175, '', '2016-09-13', 5, 1),
(360, 376, 2, 2, 19, 1, 400, '', '2016-09-13', 5, 1),
(361, 376, 2, 2, 12, 2, 350, '', '2016-09-13', 5, 1),
(362, 376, 2, 2, 12, 1, 350, '', '2016-09-13', 5, 1),
(363, 376, 2, 2, 8, 2, 175, '', '2017-06-20', 5, 1),
(364, 376, 2, 2, 7, 2, 175, '', '2017-06-20', 5, 1),
(365, 376, 2, 2, 8, 1, 175, '', '2017-06-20', 5, 1),
(366, 376, 2, 2, 19, 1, 400, '', '2017-06-20', 5, 1),
(367, 376, 2, 2, 7, 1, 175, '', '2017-06-20', 5, 1),
(368, 376, 2, 2, 19, 2, 400, '', '2017-06-20', 5, 1),
(369, 163, 2, 2, 10, 2, 200, '', '2015-07-16', 5, 1),
(370, 163, 2, 2, 11, 2, 100, '', '2015-07-16', 5, 1),
(371, 655, 2, 2, 7, 1, 50, '', '2013-03-24', 11, 5),
(372, 655, 2, 2, 8, 1, 50, '', '2013-03-24', 11, 5),
(373, 655, 2, 2, 19, 1, 75, '', '2013-03-24', 11, 5),
(374, 655, 2, 2, 7, 1, 75, '', '2014-06-23', 11, 5),
(376, 655, 2, 2, 8, 1, 75, '', '2014-06-23', 11, 5),
(377, 655, 2, 2, 19, 1, 100, '', '2014-06-23', 11, 5),
(378, 655, 2, 2, 7, 1, 120, '', '2017-10-24', 11, 5),
(379, 655, 2, 2, 7, 1, 120, '', '2017-10-24', 11, 5),
(380, 655, 2, 2, 19, 1, 200, '', '2017-10-24', 11, 5),
(381, 893, 2, 2, 7, 1, 70, '', '2016-10-04', 5, 1),
(382, 893, 2, 2, 8, 1, 70, '', '2016-10-04', 5, 1),
(383, 893, 2, 2, 7, 2, 70, '', '2016-10-04', 5, 1),
(384, 893, 2, 2, 8, 2, 70, '', '2016-10-04', 5, 1),
(385, 893, 2, 2, 12, 1, 80, '', '2016-10-04', 5, 1),
(386, 893, 2, 2, 12, 2, 80, '', '2016-10-04', 5, 1),
(387, 893, 2, 2, 7, 1, 80, '', '2017-05-16', 5, 1),
(388, 893, 2, 2, 8, 1, 80, '', '2017-05-16', 5, 1),
(389, 893, 2, 2, 7, 2, 80, '', '2017-05-16', 5, 1),
(390, 893, 2, 2, 8, 2, 80, '', '2017-05-16', 5, 1),
(391, 893, 2, 2, 19, 1, 60, '', '2017-05-16', 5, 1),
(392, 893, 2, 2, 19, 2, 60, '', '2017-05-16', 5, 1),
(393, 893, 2, 2, 11, 1, 20, '', '2017-05-16', 5, 1),
(394, 893, 2, 2, 11, 2, 20, '', '2017-05-16', 5, 1),
(395, 893, 2, 2, 7, 1, 100, '', '2017-10-24', 5, 1),
(396, 893, 2, 2, 8, 1, 100, '', '2017-10-24', 5, 1),
(397, 893, 2, 2, 7, 2, 100, '', '2017-10-24', 5, 1),
(398, 893, 2, 2, 8, 2, 100, '', '2017-10-24', 5, 1),
(399, 893, 2, 2, 19, 1, 60, '', '2017-10-24', 5, 1),
(400, 893, 2, 2, 19, 2, 60, '', '2017-10-24', 5, 1),
(401, 893, 2, 2, 11, 1, 40, '', '2017-10-24', 5, 1),
(402, 893, 2, 2, 11, 2, 40, '', '2017-10-24', 5, 1),
(403, 713, 1, 10, 6, 1, 0, '', '2017-01-09', 9, 1),
(404, 713, 1, 10, 6, 2, 0, '', '2017-01-09', 9, 1),
(405, 393, 2, 2, 12, 1, 200, '', '2012-06-05', 5, 1),
(406, 393, 2, 2, 12, 2, 200, '', '2012-06-05', 5, 1),
(407, 828, 2, 2, 12, 1, 200, '', '2017-03-21', 5, 1),
(408, 828, 2, 2, 12, 2, 200, '', '2017-03-21', 5, 1),
(409, 828, 2, 2, 6, 2, 100, '', '2017-03-21', 5, 1),
(410, 828, 1, 4, 26, 1, 0, '', '2017-03-21', 9, 1),
(411, 558, 2, 1, 25, 1, 150, '', '2016-04-05', 2, 1),
(412, 558, 2, 1, 19, 1, 100, '', '2016-04-05', 2, 1),
(413, 334, 2, 2, 12, 2, 300, '', '2017-11-14', 5, 1),
(414, 334, 2, 2, 8, 2, 150, '', '2017-11-14', 5, 1),
(415, 334, 2, 2, 7, 2, 150, '', '2017-11-14', 5, 1),
(416, 334, 2, 2, 19, 2, 200, '', '2017-11-14', 5, 1),
(417, 785, 2, 2, 7, 1, 150, '', '2017-04-20', 8, 1),
(418, 785, 2, 2, 8, 1, 150, '', '2017-04-20', 8, 1),
(419, 785, 2, 2, 7, 2, 120, '', '2017-04-20', 8, 1),
(420, 785, 2, 2, 8, 2, 120, '', '2017-04-20', 8, 1),
(421, 785, 2, 2, 19, 1, 250, '', '2017-04-20', 8, 1),
(422, 785, 2, 2, 19, 2, 150, '', '2017-04-20', 8, 1),
(423, 785, 2, 2, 7, 1, 150, '', '2017-10-19', 8, 1),
(424, 785, 2, 2, 7, 2, 150, '', '2017-10-19', 8, 1),
(425, 785, 2, 2, 8, 1, 150, '', '2017-10-19', 8, 1),
(426, 785, 2, 2, 8, 2, 150, '', '2017-10-19', 8, 1),
(427, 785, 2, 2, 19, 1, 250, '', '2017-10-19', 8, 1),
(428, 785, 2, 2, 19, 2, 250, '', '2017-10-19', 8, 1),
(429, 836, 2, 2, 8, 2, 140, '', '2017-11-14', 5, 1),
(430, 836, 2, 2, 7, 2, 140, '', '2017-11-14', 5, 1),
(431, 836, 2, 2, 19, 2, 160, '', '2017-11-14', 5, 1);

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
  MODIFY `ID_Traitement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;
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
