-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 mai 2023 à 15:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exo_patefinder`
--
CREATE DATABASE IF NOT EXISTS `exo_patefinder` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `exo_patefinder`;

-- --------------------------------------------------------

--
-- Structure de la table `character_game`
--

DROP TABLE IF EXISTS `character_game`;
CREATE TABLE IF NOT EXISTS `character_game` (
  `character_id` int NOT NULL,
  `game_id` int NOT NULL,
  PRIMARY KEY (`character_id`,`game_id`),
  KEY `Character_Game_Game_FK` (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `character_skill`
--

DROP TABLE IF EXISTS `character_skill`;
CREATE TABLE IF NOT EXISTS `character_skill` (
  `character_id` int NOT NULL,
  `skill_id` int NOT NULL,
  PRIMARY KEY (`character_id`,`skill_id`),
  KEY `Character_Skill_Skill_FK` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `character_skill`
--

INSERT INTO `character_skill` (`character_id`, `skill_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `character_statistic`
--

DROP TABLE IF EXISTS `character_statistic`;
CREATE TABLE IF NOT EXISTS `character_statistic` (
  `character_id` int NOT NULL,
  `statistic_id` int NOT NULL,
  `current_statistic` tinyint UNSIGNED NOT NULL,
  PRIMARY KEY (`character_id`,`statistic_id`),
  KEY `Character_Statistic_Statistic_FK` (`statistic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `character_statistic`
--

INSERT INTO `character_statistic` (`character_id`, `statistic_id`, `current_statistic`) VALUES
(1, 1, 8),
(1, 2, 150),
(1, 3, 150),
(1, 4, 200),
(1, 5, 200),
(1, 6, 5),
(1, 7, 15),
(1, 8, 10),
(1, 9, 15),
(1, 10, 10),
(1, 11, 5),
(2, 1, 4),
(2, 2, 250),
(2, 3, 250),
(2, 4, 250),
(2, 5, 250),
(2, 6, 20),
(2, 7, 10),
(2, 8, 15),
(2, 9, 10),
(2, 10, 12),
(2, 11, 2),
(3, 1, 2),
(3, 2, 200),
(3, 3, 150),
(3, 4, 100),
(3, 5, 100),
(3, 6, 7),
(3, 7, 15),
(3, 8, 15),
(3, 9, 10),
(3, 10, 20),
(3, 11, 5),
(4, 1, 5),
(4, 2, 200),
(4, 3, 200),
(4, 4, 200),
(4, 5, 200),
(4, 6, 15),
(4, 7, 10),
(4, 8, 15),
(4, 9, 15),
(4, 10, 5),
(4, 11, 10);

-- --------------------------------------------------------

--
-- Structure de la table `character_stuff`
--

DROP TABLE IF EXISTS `character_stuff`;
CREATE TABLE IF NOT EXISTS `character_stuff` (
  `character_id` int NOT NULL,
  `stuff_id` int NOT NULL,
  PRIMARY KEY (`character_id`,`stuff_id`),
  KEY `Character_Stuff_Stuff_FK` (`stuff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `character_stuff`
--

INSERT INTO `character_stuff` (`character_id`, `stuff_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(3, 4),
(4, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `dice`
--

DROP TABLE IF EXISTS `dice`;
CREATE TABLE IF NOT EXISTS `dice` (
  `dice_id` int NOT NULL AUTO_INCREMENT,
  `dice_result` tinyint NOT NULL,
  `dice_time` datetime NOT NULL,
  `game_id` int NOT NULL,
  `player_id` int NOT NULL,
  PRIMARY KEY (`dice_id`),
  KEY `Dice_Game_FK` (`game_id`),
  KEY `Dice_Player_FK` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int NOT NULL AUTO_INCREMENT,
  `game_time_create` datetime NOT NULL,
  `game_time_played` datetime DEFAULT NULL,
  `player_id` int NOT NULL,
  PRIMARY KEY (`game_id`),
  KEY `Game_Game_Master_FK` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `game_master`
--

DROP TABLE IF EXISTS `game_master`;
CREATE TABLE IF NOT EXISTS `game_master` (
  `player_id` int NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `played_character`
--

DROP TABLE IF EXISTS `played_character`;
CREATE TABLE IF NOT EXISTS `played_character` (
  `character_id` int NOT NULL AUTO_INCREMENT,
  `character_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `character_creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `player_id` int NOT NULL,
  PRIMARY KEY (`character_id`),
  KEY `Played_Character_Player_FK` (`player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `played_character`
--

INSERT INTO `played_character` (`character_id`, `character_name`, `character_creation_date`, `player_id`) VALUES
(1, 'Eriole', '2023-05-23 15:07:01', 1),
(2, 'Parya', '2023-05-23 15:08:34', 2),
(3, 'Hisha', '2023-05-23 15:10:51', 3),
(4, 'Snow', '2023-05-23 15:13:18', 4);

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `player_id` int NOT NULL AUTO_INCREMENT,
  `player_username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `player_mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `player_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`player_id`),
  UNIQUE KEY `Player_AK` (`player_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `player`
--

INSERT INTO `player` (`player_id`, `player_username`, `player_mail`, `player_password`) VALUES
(1, 'Joanna', 'joanna@mail.com', '$2y$10$Em7u.GyMN/c.KEWLxmNOHuI6KRtaSsk.kZgtUoVTbNFxbDW1qx2WK'),
(2, 'Antoine', 'antoine@mail.com', '$2y$10$G8PtQRskT1yCKxI5fGRE1.95iauC4OmoOjAFALqO2CA7FbiycnFK6'),
(3, 'Hichem', 'hichem@mail.com', '$2y$10$/MeOl6lcQOmMkGsgpf.FuelkgKd0LfIBdHJkQbKE4STF0onQjcLiu'),
(4, 'Winai', 'winai@mail.com', '$2y$10$.rZTFprDCz8.qDpPVKUhMeK1w7xRVSYC3Ehuy8oaRVdh9zVZg6ogy');

-- --------------------------------------------------------

--
-- Structure de la table `regular_player`
--

DROP TABLE IF EXISTS `regular_player`;
CREATE TABLE IF NOT EXISTS `regular_player` (
  `player_id` int NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `skill_id` int NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `skill_level` tinyint NOT NULL,
  `player_id` int DEFAULT NULL,
  `statistic_id` int NOT NULL,
  PRIMARY KEY (`skill_id`),
  KEY `Skill_Game_Master_FK` (`player_id`),
  KEY `Skill_Statistic_FK` (`statistic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`skill_id`, `skill_name`, `skill_level`, `player_id`, `statistic_id`) VALUES
(1, 'Charmeur de patate', 1, NULL, 9),
(2, 'Panique', 2, NULL, 1),
(3, 'Voleur à la sauvette', 4, NULL, 7),
(4, 'Dealer de sucre', 2, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `statistic`
--

DROP TABLE IF EXISTS `statistic`;
CREATE TABLE IF NOT EXISTS `statistic` (
  `statistic_id` int NOT NULL AUTO_INCREMENT,
  `statistic_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statistic_shortname` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statistic_quantity` tinyint UNSIGNED NOT NULL,
  `inSum` tinyint(1) NOT NULL DEFAULT '0',
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`statistic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statistic`
--

INSERT INTO `statistic` (`statistic_id`, `statistic_name`, `statistic_shortname`, `statistic_quantity`, `inSum`, `editable`) VALUES
(1, 'Initiative', 'INIT', 10, 0, 0),
(2, 'Points de vie max', 'PVmax', 250, 0, 0),
(3, 'Points de vie actuels', 'PVact', 250, 0, 1),
(4, 'Points de magie max', 'PMmax', 250, 0, 0),
(5, 'Points de magie actuels', 'PMact', 250, 0, 1),
(6, 'Force', 'FOR', 20, 1, 0),
(7, 'Dexterite', 'DEX', 20, 1, 0),
(8, 'Constitution', 'CONST', 20, 1, 0),
(9, 'Intelligence', 'INT', 20, 1, 0),
(10, 'Sagesse', 'SAG', 20, 1, 0),
(11, 'Chance', 'CHA', 20, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stuff`
--

DROP TABLE IF EXISTS `stuff`;
CREATE TABLE IF NOT EXISTS `stuff` (
  `stuff_id` int NOT NULL AUTO_INCREMENT,
  `stuff_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stuff_dmg` tinyint NOT NULL,
  `stuff_range` tinyint NOT NULL,
  `player_id` int DEFAULT NULL,
  PRIMARY KEY (`stuff_id`),
  KEY `Stuff_Game_Master_FK` (`player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stuff`
--

INSERT INTO `stuff` (`stuff_id`, `stuff_name`, `stuff_dmg`, `stuff_range`, `player_id`) VALUES
(1, 'Scalpel rouillé', 1, 1, NULL),
(2, 'Hache à 2 mains', 4, 3, NULL),
(3, 'Bâton enchanté', 2, 4, NULL),
(4, 'Flèche d\'argent', 10, 5, NULL),
(5, 'Glacière sans fond', 0, 0, NULL),
(6, 'Couteaux de lancer', 5, 5, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `character_game`
--
ALTER TABLE `character_game`
  ADD CONSTRAINT `Character_Game_Game_FK` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`),
  ADD CONSTRAINT `Character_Game_Played_Character_FK` FOREIGN KEY (`character_id`) REFERENCES `played_character` (`character_id`);

--
-- Contraintes pour la table `character_skill`
--
ALTER TABLE `character_skill`
  ADD CONSTRAINT `Character_Skill_Played_Character_FK` FOREIGN KEY (`character_id`) REFERENCES `played_character` (`character_id`),
  ADD CONSTRAINT `Character_Skill_Skill_FK` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`skill_id`);

--
-- Contraintes pour la table `character_statistic`
--
ALTER TABLE `character_statistic`
  ADD CONSTRAINT `Character_Statistic_Played_Character_FK` FOREIGN KEY (`character_id`) REFERENCES `played_character` (`character_id`),
  ADD CONSTRAINT `Character_Statistic_Statistic_FK` FOREIGN KEY (`statistic_id`) REFERENCES `statistic` (`statistic_id`);

--
-- Contraintes pour la table `character_stuff`
--
ALTER TABLE `character_stuff`
  ADD CONSTRAINT `Character_Stuff_Played_Character_FK` FOREIGN KEY (`character_id`) REFERENCES `played_character` (`character_id`),
  ADD CONSTRAINT `Character_Stuff_Stuff_FK` FOREIGN KEY (`stuff_id`) REFERENCES `stuff` (`stuff_id`);

--
-- Contraintes pour la table `dice`
--
ALTER TABLE `dice`
  ADD CONSTRAINT `Dice_Game_FK` FOREIGN KEY (`game_id`) REFERENCES `game` (`game_id`),
  ADD CONSTRAINT `Dice_Player_FK` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`);

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `Game_Game_Master_FK` FOREIGN KEY (`player_id`) REFERENCES `game_master` (`player_id`);

--
-- Contraintes pour la table `game_master`
--
ALTER TABLE `game_master`
  ADD CONSTRAINT `Game_Master_Player_FK` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`);

--
-- Contraintes pour la table `played_character`
--
ALTER TABLE `played_character`
  ADD CONSTRAINT `Played_Character_Player_FK` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`);

--
-- Contraintes pour la table `regular_player`
--
ALTER TABLE `regular_player`
  ADD CONSTRAINT `Regular_player_Player_FK` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`);

--
-- Contraintes pour la table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `Skill_Game_Master_FK` FOREIGN KEY (`player_id`) REFERENCES `game_master` (`player_id`),
  ADD CONSTRAINT `Skill_Statistic_FK` FOREIGN KEY (`statistic_id`) REFERENCES `statistic` (`statistic_id`);

--
-- Contraintes pour la table `stuff`
--
ALTER TABLE `stuff`
  ADD CONSTRAINT `Stuff_Game_Master_FK` FOREIGN KEY (`player_id`) REFERENCES `game_master` (`player_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
