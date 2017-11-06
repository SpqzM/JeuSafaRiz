-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 03 nov. 2017 à 15:38
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jeusafariz`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(50) NOT NULL,
  `MDP` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `LOGIN`, `MDP`) VALUES
(1, 'root', '63a9f0ea7bb98050796b649e85481845');

-- --------------------------------------------------------

--
-- Structure de la table `lots`
--

DROP TABLE IF EXISTS `lots`;
CREATE TABLE IF NOT EXISTS `lots` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(50) NOT NULL,
  `DATEIG` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IDPERIODE` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDPERIODE` (`IDPERIODE`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lots`
--

INSERT INTO `lots` (`ID`, `LIBELLE`, `DATEIG`, `IDPERIODE`) VALUES
(1, 'casquette', '2017-11-06 08:18:10', 1),
(2, 'porte-clé', '2017-11-06 09:35:54', 1),
(3, 'porte-clé', '2017-11-06 10:51:33', 1),
(4, 'casquette', '2017-11-06 12:08:29', 1),
(5, 'casquette', '2017-11-06 13:22:41', 1),
(6, 'porte-clé', '2017-11-06 14:37:50', 1),
(7, 'casquette', '2017-11-06 15:50:34', 1),
(8, 'casquette', '2017-11-06 17:03:49', 1),
(9, 'casquette', '2017-11-06 18:19:02', 1),
(10, 'casquette', '2017-11-06 19:30:51', 1),
(11, 'casquette', '2017-11-06 20:45:13', 1),
(12, 'casquette', '2017-11-06 22:02:26', 1),
(13, 'casquette', '2017-11-06 23:16:05', 1),
(14, 'casquette', '2017-11-07 00:31:34', 1),
(15, 'casquette', '2017-11-07 01:48:52', 1),
(16, 'casquette', '2017-11-07 02:59:22', 1),
(17, 'casquette', '2017-11-07 04:11:37', 1),
(18, 'casquette', '2017-11-07 05:25:29', 1),
(19, 'casquette', '2017-11-07 06:39:45', 1),
(20, 'casquette', '2017-11-07 07:50:40', 1),
(21, 'casquette', '2017-11-07 09:08:27', 1),
(22, 'casquette', '2017-11-07 10:23:12', 1),
(23, 'casquette', '2017-11-07 11:33:13', 1),
(24, 'casquette', '2017-11-07 12:49:25', 1),
(25, 'casquette', '2017-11-07 14:06:24', 1),
(26, 'casquette', '2017-11-07 15:20:15', 1),
(27, 'porte-clé', '2017-11-07 16:33:35', 1),
(28, 'casquette', '2017-11-07 17:45:39', 1),
(29, 'casquette', '2017-11-07 19:02:15', 1),
(30, 'casquette', '2017-11-07 20:13:11', 1),
(31, 'casquette', '2017-11-07 21:26:08', 1),
(32, 'casquette', '2017-11-07 22:38:27', 1),
(33, 'casquette', '2017-11-07 23:49:50', 1),
(34, 'casquette', '2017-11-08 01:07:37', 1),
(35, 'casquette', '2017-11-08 02:25:14', 1),
(36, 'casquette', '2017-11-08 03:35:53', 1),
(37, 'casquette', '2017-11-08 04:51:59', 1),
(38, 'casquette', '2017-11-08 06:02:04', 1),
(39, 'casquette', '2017-11-08 07:18:08', 1),
(40, 'casquette', '2017-11-08 08:31:00', 1),
(41, 'casquette', '2017-11-08 09:48:30', 1),
(42, 'casquette', '2017-11-08 11:04:08', 1),
(43, 'casquette', '2017-11-08 12:21:13', 1),
(44, 'casquette', '2017-11-08 13:33:54', 1),
(45, 'casquette', '2017-11-08 14:48:12', 1),
(46, 'porte-clé', '2017-11-08 15:58:21', 1),
(47, 'casquette', '2017-11-08 17:15:44', 1),
(48, 'casquette', '2017-11-08 18:31:37', 1),
(49, 'casquette', '2017-11-08 19:48:54', 1),
(50, 'porte-clé', '2017-11-08 21:02:19', 1),
(51, 'safari', '2017-11-08 22:20:03', 1),
(52, 'casquette', '2017-11-08 23:36:13', 1),
(53, 'porte-clé', '2017-11-09 00:53:24', 1),
(54, 'casquette', '2017-11-09 02:10:35', 1),
(55, 'casquette', '2017-11-09 03:25:27', 1),
(56, 'casquette', '2017-11-09 04:36:45', 1),
(57, 'casquette', '2017-11-09 05:53:30', 1),
(58, 'porte-clé', '2017-11-09 07:10:40', 1),
(59, 'casquette', '2017-11-09 08:28:14', 1),
(60, 'casquette', '2017-11-09 09:39:18', 1),
(61, 'casquette', '2017-11-09 10:54:03', 1),
(62, 'porte-clé', '2017-11-09 12:07:10', 1),
(63, 'casquette', '2017-11-09 13:21:42', 1),
(64, 'casquette', '2017-11-09 14:34:53', 1),
(65, 'casquette', '2017-11-09 15:48:48', 1),
(66, 'casquette', '2017-11-09 17:05:38', 1),
(67, 'safari', '2017-11-09 18:20:13', 1),
(68, 'casquette', '2017-11-09 19:31:37', 1),
(69, 'casquette', '2017-11-09 20:44:37', 1),
(70, 'casquette', '2017-11-09 21:56:38', 1),
(71, 'casquette', '2017-11-09 23:11:02', 1),
(72, 'casquette', '2017-11-10 00:22:31', 1),
(73, 'porte-clé', '2017-11-10 01:37:17', 1),
(74, 'casquette', '2017-11-10 02:47:43', 1),
(75, 'casquette', '2017-11-10 04:02:30', 1),
(76, 'casquette', '2017-11-10 05:17:41', 1),
(77, 'casquette', '2017-11-10 06:35:38', 1),
(78, 'casquette', '2017-11-10 07:47:28', 1),
(79, 'casquette', '2017-11-10 08:59:55', 1),
(80, 'casquette', '2017-11-10 10:12:09', 1),
(81, 'casquette', '2017-11-10 11:29:27', 1),
(82, 'casquette', '2017-11-10 12:41:26', 1),
(83, 'porte-clé', '2017-11-10 13:57:37', 1),
(84, 'casquette', '2017-11-10 15:10:01', 1),
(85, 'casquette', '2017-11-10 16:21:35', 1),
(86, 'casquette', '2017-11-10 17:32:11', 1),
(87, 'casquette', '2017-11-10 18:46:53', 1),
(88, 'casquette', '2017-11-10 20:00:18', 1),
(89, 'porte-clé', '2017-11-10 21:11:49', 1),
(90, 'casquette', '2017-11-10 22:23:16', 1),
(91, 'casquette', '2017-11-10 23:40:02', 1),
(92, 'casquette', '2017-11-11 00:57:06', 1),
(93, 'porte-clé', '2017-11-11 02:13:00', 1),
(94, 'casquette', '2017-11-11 03:27:18', 1),
(95, 'porte-clé', '2017-11-11 04:38:25', 1),
(96, 'porte-clé', '2017-11-11 05:51:28', 1),
(97, 'casquette', '2017-11-11 07:02:54', 1),
(99, 'casquette', '2017-11-11 09:32:19', 1),
(100, 'casquette', '2017-11-11 10:43:28', 1),
(101, 'casquette', '2017-11-11 11:56:22', 1),
(102, 'casquette', '2017-11-11 13:09:18', 1),
(103, 'porte-clé', '2017-11-11 14:25:03', 1),
(104, 'casquette', '2017-11-11 15:42:10', 1),
(105, 'casquette', '2017-11-11 16:57:12', 1),
(106, 'casquette', '2017-11-11 18:09:26', 1),
(107, 'casquette', '2017-11-11 19:24:56', 1),
(108, 'porte-clé', '2017-11-11 20:41:37', 1),
(109, 'safari', '2017-11-11 21:58:13', 1),
(110, 'casquette', '2017-11-11 23:10:44', 1),
(111, 'casquette', '2017-11-12 00:21:16', 1),
(112, 'casquette', '2017-11-12 01:36:53', 1),
(113, 'casquette', '2017-11-12 02:49:12', 1),
(114, 'porte-clé', '2017-11-12 04:06:45', 1),
(115, 'casquette', '2017-11-12 05:24:24', 1),
(116, 'porte-clé', '2017-11-12 06:40:03', 1),
(117, 'casquette', '2017-11-12 07:57:02', 1),
(118, 'casquette', '2017-11-12 09:08:04', 1),
(119, 'casquette', '2017-11-12 10:25:37', 1),
(120, 'porte-clé', '2017-11-12 11:40:10', 1),
(121, 'casquette', '2017-11-12 12:57:28', 1),
(122, 'casquette', '2017-11-12 14:10:14', 1),
(123, 'casquette', '2017-11-12 16:23:35', 1);

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

DROP TABLE IF EXISTS `participants`;
CREATE TABLE IF NOT EXISTS `participants` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) NOT NULL,
  `PRENOM` varchar(50) NOT NULL,
  `ADRESSE` varchar(255) NOT NULL,
  `CP` int(5) NOT NULL,
  `VILLE` varchar(100) NOT NULL,
  `TELEPHONE` int(10) DEFAULT NULL,
  `EMAIL` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participants`
--

INSERT INTO `participants` (`ID`, `NOM`, `PRENOM`, `ADRESSE`, `CP`, `VILLE`, `TELEPHONE`, `EMAIL`) VALUES
(1, 'ASSOUMANI', 'Amiria', '1 IMPASSE DELPECH MOULIN DU MAI', 13003, 'MARSEILLE', 624185233, 'amiria.assoumani@gmail.com'),
(2, 'test', 'test', 'test', 13010, 'test', NULL, 'test@test.fr');

-- --------------------------------------------------------

--
-- Structure de la table `participations`
--

DROP TABLE IF EXISTS `participations`;
CREATE TABLE IF NOT EXISTS `participations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATEPARTICIPATION` datetime NOT NULL,
  `DATEGAIN` datetime NOT NULL,
  `IDLOT` int(11) NOT NULL,
  `IDPARTICIPANT` int(11) NOT NULL,
  `RESULTAT` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDLOT` (`IDLOT`),
  KEY `IDPARTICIPANT` (`IDPARTICIPANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATEDEBUT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATEFIN` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`ID`, `DATEDEBUT`, `DATEFIN`) VALUES
(1, '2017-11-06 00:01:00', '2017-11-13 23:59:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lots`
--
ALTER TABLE `lots`
  ADD CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`IDPERIODE`) REFERENCES `periode` (`ID`);

--
-- Contraintes pour la table `participations`
--
ALTER TABLE `participations`
  ADD CONSTRAINT `participations_ibfk_1` FOREIGN KEY (`IDLOT`) REFERENCES `lots` (`ID`),
  ADD CONSTRAINT `participations_ibfk_2` FOREIGN KEY (`IDPARTICIPANT`) REFERENCES `participants` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
