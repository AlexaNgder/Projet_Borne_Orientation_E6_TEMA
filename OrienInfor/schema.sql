-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Hôte : db5017496272.hosting-data.io
-- Généré le : mar. 22 avr. 2025 à 09:45
-- Version du serveur : 10.11.7-MariaDB-log
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs14030942`
--

-- --------------------------------------------------------

--
-- Structure de la table `ATI`
--

CREATE TABLE `ATI` (
  `ID` int(2) NOT NULL,
  `Img` varchar(20) NOT NULL,
  `Nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ATI`
--

INSERT INTO `ATI` (`ID`, `Img`, `Nom`) VALUES
(1, 'ATI_1.png', 'Photo 1'),
(2, 'ATI_2.png', 'Photo 2'),
(3, 'ATI_3.png', 'Photo 3'),
(4, 'ATI_4.png', 'Photo 4'),
(5, 'ATI_5.png', 'Photo 5'),
(6, 'ATI_6.png', 'Photo 6'),
(7, 'ATI_7.png', 'Photo 7'),
(8, 'ATI_8.png', 'Photo 8'),
(9, 'ATI_9.png', 'Photo 9'),
(10, 'ATI_10.png', 'Photo 10'),
(11, 'ATI_11.png', 'Photo 11'),
(12, 'Fond_Blanc.jpg', 'Fond d\'écran Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `CCST`
--

CREATE TABLE `CCST` (
  `ID` int(2) NOT NULL,
  `Img` varchar(20) NOT NULL,
  `Nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CCST`
--

INSERT INTO `CCST` (`ID`, `Img`, `Nom`) VALUES
(1, 'CCST_1.png', 'Photo 1'),
(2, 'CCST_2.png', 'Photo 2'),
(3, 'CCST_3.png', 'Photo 3'),
(4, 'CCST_4.png', 'Photo 4'),
(5, 'CCST_5.png', 'Photo 5'),
(6, 'CCST_6.png', 'Photo 6'),
(7, 'CCST_7.png', 'Photo 7'),
(8, 'CCST_8.png', 'Photo 8'),
(9, 'Fond_Blanc.jpg', 'Fond d\'écran Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `CIEL`
--

CREATE TABLE `CIEL` (
  `ID` int(2) NOT NULL,
  `Img` varchar(20) NOT NULL,
  `Nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CIEL`
--

INSERT INTO `CIEL` (`ID`, `Img`, `Nom`) VALUES
(1, 'CIEL_1.png', 'Photo 1'),
(2, 'CIEL_2.png', 'Photo 2'),
(3, 'CIEL_3.png', 'Photo 3'),
(4, 'CIEL_4.png', 'Photo 4'),
(5, 'CIEL_5.png', 'Photo 5'),
(6, 'CIEL_6.png', 'Photo 6'),
(7, 'CIEL_7.png', 'Photo 7'),
(8, 'CIEL_8.png', 'Photo 8'),
(10, 'CIEL_10.png', 'Photo 10'),
(11, 'CIEL_11.png', 'Photo 11'),
(12, 'Fond_Blanc.jpg', 'Fond d\'écran Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `ID` int(3) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Filiere` varchar(50) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Departement` varchar(30) NOT NULL,
  `Code_Postal` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CRSA`
--

CREATE TABLE `CRSA` (
  `ID` int(2) NOT NULL,
  `Img` varchar(20) NOT NULL,
  `Nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CRSA`
--

INSERT INTO `CRSA` (`ID`, `Img`, `Nom`) VALUES
(1, 'CRSA_1.png', 'Photo 1'),
(2, 'CRSA_2.png', 'Photo 2'),
(3, 'CRSA_3.png', 'Photo 3'),
(4, 'CRSA_4.png', 'Photo 4'),
(5, 'CRSA_5.png', 'Photo 5'),
(6, 'CRSA_6.png', 'Photo 6'),
(7, 'CRSA_7.png', 'Photo 7'),
(8, 'CRSA_8.png', 'Photo 8'),
(9, 'Fond_Blanc.jpg', 'Fond d\'écran Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `ET`
--

CREATE TABLE `ET` (
  `ID` int(2) NOT NULL,
  `Img` varchar(20) NOT NULL,
  `Nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ET`
--

INSERT INTO `ET` (`ID`, `Img`, `Nom`) VALUES
(1, 'ET_1.png', 'Photo 1'),
(2, 'ET_2.png', 'Photo 2'),
(3, 'ET_3.png', 'Photo 3'),
(4, 'ET_4.png', 'Photo 4'),
(5, 'ET_5.png', 'Photo 5'),
(6, 'ET_6.png', 'Photo 6'),
(7, 'ET_7.png', 'Photo 7'),
(8, 'Fond_Blanc.jpg', 'Fond d\'écran Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `Identification`
--

CREATE TABLE `Identification` (
  `Id_ident` int(3) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `MDP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `visites`
--

CREATE TABLE `visites` (
  `heure_visite` time NOT NULL,
  `nombre_visites` int(11) NOT NULL DEFAULT 0,
  `date_visite` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ATI`
--
ALTER TABLE `ATI`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `CCST`
--
ALTER TABLE `CCST`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `CIEL`
--
ALTER TABLE `CIEL`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `CRSA`
--
ALTER TABLE `CRSA`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ET`
--
ALTER TABLE `ET`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `visites`
--
ALTER TABLE `visites`
  ADD PRIMARY KEY (`heure_visite`,`date_visite`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ATI`
--
ALTER TABLE `ATI`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CCST`
--
ALTER TABLE `CCST`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CIEL`
--
ALTER TABLE `CIEL`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CRSA`
--
ALTER TABLE `CRSA`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ET`
--
ALTER TABLE `ET`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
