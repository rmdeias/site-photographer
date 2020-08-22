-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 26 mai 2020 à 12:45
-- Version du serveur :  5.7.30-0ubuntu0.18.04.1
-- Version de PHP : 7.3.15-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pa-153_rdeias_pc_photographe`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_Commissioned`
--

CREATE TABLE `categorie_Commissioned` (
  `id` int(11) NOT NULL,
  `categorie` varchar(250) DEFAULT NULL,
  `photoCouv` varchar(250) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_Fashion`
--

CREATE TABLE `categorie_Fashion` (
  `id` int(11) NOT NULL,
  `categorie` varchar(250) DEFAULT NULL,
  `photoCouv` varchar(250) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_Personal`
--

CREATE TABLE `categorie_Personal` (
  `id` int(11) NOT NULL,
  `categorie` varchar(250) DEFAULT NULL,
  `photoCouv` varchar(250) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_StillLife`
--

CREATE TABLE `categorie_StillLife` (
  `id` int(11) NOT NULL,
  `categorie` varchar(250) DEFAULT NULL,
  `photoCouv` varchar(250) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commissioned`
--

CREATE TABLE `commissioned` (
  `id` int(11) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `id_Categorie` int(11) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP,
  `classement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ConnectAdmin`
--

CREATE TABLE `ConnectAdmin` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `adminPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fashion`
--

CREATE TABLE `fashion` (
  `id` int(11) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `id_Categorie` int(11) DEFAULT NULL,
  `classement` int(11) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `id_Categorie` int(11) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP,
  `classement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `selectedWork`
--

CREATE TABLE `selectedWork` (
  `id` int(11) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP,
  `classement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stillLife`
--

CREATE TABLE `stillLife` (
  `id` int(11) NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `id_Categorie` int(11) DEFAULT NULL,
  `dateAjout` datetime DEFAULT CURRENT_TIMESTAMP,
  `classement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie_Commissioned`
--
ALTER TABLE `categorie_Commissioned`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_Fashion`
--
ALTER TABLE `categorie_Fashion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_Personal`
--
ALTER TABLE `categorie_Personal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_StillLife`
--
ALTER TABLE `categorie_StillLife`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commissioned`
--
ALTER TABLE `commissioned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_commsionnedCategorie` (`id_Categorie`);

--
-- Index pour la table `ConnectAdmin`
--
ALTER TABLE `ConnectAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fashion`
--
ALTER TABLE `fashion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_fashionCategorie` (`id_Categorie`);

--
-- Index pour la table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_personalCategorie` (`id_Categorie`);

--
-- Index pour la table `selectedWork`
--
ALTER TABLE `selectedWork`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stillLife`
--
ALTER TABLE `stillLife`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_stillLifeCategorie` (`id_Categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie_Commissioned`
--
ALTER TABLE `categorie_Commissioned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT pour la table `categorie_Fashion`
--
ALTER TABLE `categorie_Fashion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie_Personal`
--
ALTER TABLE `categorie_Personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie_StillLife`
--
ALTER TABLE `categorie_StillLife`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commissioned`
--
ALTER TABLE `commissioned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT pour la table `ConnectAdmin`
--
ALTER TABLE `ConnectAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `fashion`
--
ALTER TABLE `fashion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `selectedWork`
--
ALTER TABLE `selectedWork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `stillLife`
--
ALTER TABLE `stillLife`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commissioned`
--
ALTER TABLE `commissioned`
  ADD CONSTRAINT `FK_commsionnedCategorie` FOREIGN KEY (`id_Categorie`) REFERENCES `categorie_Commissioned` (`id`);

--
-- Contraintes pour la table `fashion`
--
ALTER TABLE `fashion`
  ADD CONSTRAINT `FK_fashionCategorie` FOREIGN KEY (`id_Categorie`) REFERENCES `categorie_Fashion` (`id`);

--
-- Contraintes pour la table `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `FK_personalCategorie` FOREIGN KEY (`id_Categorie`) REFERENCES `categorie_Personal` (`id`);

--
-- Contraintes pour la table `stillLife`
--
ALTER TABLE `stillLife`
  ADD CONSTRAINT `FK_stillLifeCategorie` FOREIGN KEY (`id_Categorie`) REFERENCES `categorie_StillLife` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
