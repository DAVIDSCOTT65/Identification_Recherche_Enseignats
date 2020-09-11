-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 11 sep. 2020 à 20:55
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `minesures`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_enseignant` int(10) UNSIGNED NOT NULL,
  `domaine` varchar(255) NOT NULL,
  `niveau_de_maitrise` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_C_E` (`id_enseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id`, `id_enseignant`, `domaine`, `niveau_de_maitrise`) VALUES
(24, 12, 'Fluttuer (Dart)', 'Assez bien'),
(25, 12, 'Programmation Python', 'Assez bien'),
(26, 12, 'Algorithme', 'Très bien'),
(27, 13, 'Physique Quantique', 'Bien'),
(28, 13, 'Chimie de Particule', 'Assez bien'),
(29, 13, 'Électronique', 'Assez bien');

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
CREATE TABLE IF NOT EXISTS `enseignants` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `email` varchar(255) NOT NULL,
  `type_piece_id` varchar(255) NOT NULL,
  `num_piece_id` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`id`, `matricule`, `noms`, `sexe`, `dob`, `anneeFinEtudes`, `filiereEtudes`, `grade`, `type`, `phoneNum`, `institutionAffiliee`, `code_bar`, `valide`, `email`, `type_piece_id`, `num_piece_id`, `photo`) VALUES
(12, 'MAT005463', 'MIRINDI DAVID Scott', 'Homme', '1996-01-11', 2018, 'Informatique de Gestion', 'Assistant', 'Non payé', '+243971778161', 'Institut Supérieur de Commerce', '', 1, 'davidscottmirindi65@gmail.com', 'Carte d\'électeur', '22131516458', '5a261302b9dca4d4fef8d78e7faf2932.png'),
(13, '', 'ZIHINDULA KABERA ELIE', 'Homme', '1996-02-06', 2014, 'Douane', 'Master', 'Nouvelle unité', '0973145891', 'UNIGOM', '', 1, 'elie@gmail.com', 'Carte d\'électeur', '12345666', 'f8e4381da307ff2bd958933b46dd72e4.jpeg'),
(14, '', 'Sarah Bizimungu', 'Femme', '1995-07-21', 2015, 'Esthétique', 'Professeur ordinaire', 'Nouvelle unité', '+243977529142', 'ISTM Goma', '', 1, 'sarahbiz@gmail.com', 'Carte d\'électeur', '1234563221', '53a896e47dc86d015a9e234e9bce91db.jpeg'),
(15, '12411353', 'Josaphat Imani Nathan', 'Homme', '1997-03-12', 1950, 'Réseaux et Telecom', 'Professeur ordinaire', 'Non payé', '0973145891', 'Institut Supérieur de Commerce', '', 1, 'joeimani@gmail.com', 'Passeport', '8479-82891', 'e20e4e1f4ad1e77cc74b1f36af83ff41.jpeg'),
(16, '64348', 'MBUSA KIBUNI PRINCE', 'Homme', '1993-07-16', 2005, 'Finance', 'Assistant', 'Non payé', '0973145891', 'UNIGOM', '', 1, 'princetyga@gmail.com', 'Passeport', '636272724', '8e64b61051ad194c4a8c0eef8389923d.jpeg'),
(17, '', 'Rodolph Kahambo Gabriel', 'Homme', '1995-10-23', 2012, 'Photographie', 'Assistant', 'Nouvelle unité', '+243971778161', 'Academie des beaux arts', '', 1, 'kahambogab@gmail.com', 'Passeport', '348943', 'a079f75c1fe8e6a83b663ce080c7927d.jpeg'),
(18, '', 'Cishugi Saturneun', 'Homme', '1987-02-04', 2017, 'Aéronautique', 'Professeur emerite', 'Nouvelle unité', '+243971778161', 'Institut Aéronautique de Goma', '', 1, 'satecish65@gmail.com', 'Passeport', '35778855', '1e7286feb80ebab5ed21f34db2da9787.jpeg'),
(19, '', 'Eddy Mankusu Hekima', 'Homme', '1996-02-24', 1950, 'Réseaux et Telecom', 'Assistant', 'Nouvelle unité', '0973145891', 'Institut Supérieur de Commerce', '', 1, 'eddyhekima@gmail.com', 'Carte d\'électeur', '348943TT', '8b4d141cfcf9d24d44fffb80a53966a8.jpeg'),
(20, '', 'Mwangaza Nathalie', 'Femme', '1993-03-17', 2017, 'Développement', 'Assistant', 'Nouvelle unité', '+243971778161', 'ISDR Goma', '', 0, 'nathalie@gmail.com', 'Carte d\'électeur', '456889865', 'd6630d63629b2e9eebe5951392d09013.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

DROP TABLE IF EXISTS `publications`;
CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_enseignant` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `annee` date NOT NULL,
  `resume` varchar(255) NOT NULL,
  `domaine` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_P_E` (`id_enseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`id`, `id_enseignant`, `photo`, `titre`, `annee`, `resume`, `domaine`) VALUES
(5, 12, '35df953632ef643797cd40b2e2908e38.jpeg', 'Premier pas avec Android', '2017-02-15', 'Ce livre parle de la programmation androïde avec flutter. Un très bon livre pour ceux qui aiment apprendre en s\'amusant', 'Fluttuer (Dart)'),
(6, 12, '4ba38993e8459db4ce63e9662154e4a5.jpeg', 'VBA et Excel facile !', '2014-06-19', 'Facile et amusant à lire avec plusieurs animation', 'Programmation Python'),
(7, 12, 'f5c4b6b66a3ad4bb8714d32d819e2171.jpeg', 'Algorithme et Programmation Java', '2018-01-03', 'C\'est livre parle de l\'algorithme en faisant de pratique avec la programmation Java. Conseillé au débutant en Java', 'Algorithme'),
(8, 13, '0dcffc3f0ae0083897201cdc38e0b4d8.jpeg', 'Mariage physique-chimie', '2016-06-16', 'Cet ouvrage explique la chimie et la physique une fois utilisé en concomitance ', 'Chimie de Particule');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_enseignant` int(10) UNSIGNED DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_U_E` (`id_enseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `photo`, `id_enseignant`, `role`) VALUES
(13, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, NULL, 'ROLE_SUPER_ADMIN'),
(17, 'David65', '579fc044bf7df9ede2ae503ec5c0ef610b06b28d', '5a261302b9dca4d4fef8d78e7faf2932.png', 12, 'ROLE_TEACHER'),
(18, '0c8c3', '34ebf223930b05589d5ee14d9a9205f2fd69fd8d', 'a079f75c1fe8e6a83b663ce080c7927d.jpeg', 17, 'ROLE_TEACHER'),
(19, 'a924c', '814a2107b8e9e6828f4c897926649a4d9fef241d', 'f8e4381da307ff2bd958933b46dd72e4.jpeg', 13, 'ROLE_TEACHER'),
(20, '39283', '042bb2d1c2c0dff96a991cb19af0388d8df45914', '53a896e47dc86d015a9e234e9bce91db.jpeg', 14, 'ROLE_TEACHER'),
(21, '47db0', '08ca850899aae9142c841fcd99e268a648dbe766', 'e20e4e1f4ad1e77cc74b1f36af83ff41.jpeg', 15, 'ROLE_TEACHER'),
(22, '4d757', '4cf653fa45e08c8bfbf81f54e1ba92918ead9494', '8e64b61051ad194c4a8c0eef8389923d.jpeg', 16, 'ROLE_TEACHER'),
(23, '3a631', '0c148a21984522f149dadad3122fca3907c4b59e', '8b4d141cfcf9d24d44fffb80a53966a8.jpeg', 19, 'ROLE_TEACHER'),
(24, '1e0c6', '3668847836c2b85ea588932b901db19460590a7c', '1e7286feb80ebab5ed21f34db2da9787.jpeg', 18, 'ROLE_TEACHER');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants` ADD FULLTEXT KEY `noms` (`noms`,`matricule`,`institutionAffiliee`,`phoneNum`);

--
-- Contraintes pour les tables déchargées
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
