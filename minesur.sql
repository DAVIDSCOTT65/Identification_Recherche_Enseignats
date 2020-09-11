-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Lun 07 Septembre 2020 à 11:25
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `minesur`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_enseignant` int(10) unsigned NOT NULL,
  `domaine` varchar(255) NOT NULL,
  `niveau_de_maitrise` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_C_E` (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE IF NOT EXISTS `enseignants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(25) NOT NULL,
  `noms` varchar(255) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `anneeFinEtudes` year(4) NOT NULL,
  `filiereEtudes` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `phoneNum` varchar(500) NOT NULL,
  `institutionAffiliee` varchar(255) NOT NULL,
  `code_bar` text NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(10) unsigned NOT NULL,
  `id_enseignant` int(10) unsigned NOT NULL,
  `photo` int(11) NOT NULL,
  `titre` int(11) NOT NULL,
  `annee` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_P_E` (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_enseignant` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_U_E` (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competences`
--
ALTER TABLE `competences`
  ADD CONSTRAINT `FK_C_E` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id`);

--
-- Contraintes pour la table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `FK_P_E` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_U_E` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
