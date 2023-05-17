-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 mai 2023 à 09:27
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

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
(2, 1),
(3, 1),
(2, 2),
(4, 2),
(5, 2);

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
(1, 1, 2),
(1, 2, 50),
(1, 3, 50),
(1, 4, 250),
(1, 5, 50),
(1, 6, 10),
(1, 7, 10),
(1, 8, 10),
(1, 9, 10),
(1, 10, 10),
(1, 11, 10),
(2, 1, 5),
(2, 2, 50),
(2, 3, 50),
(2, 4, 50),
(2, 5, 50),
(2, 6, 10),
(2, 7, 10),
(2, 8, 10),
(2, 9, 10),
(2, 10, 10),
(2, 11, 10),
(3, 1, 5),
(3, 2, 60),
(3, 3, 60),
(3, 4, 60),
(3, 5, 60),
(3, 6, 10),
(3, 7, 10),
(3, 8, 10),
(3, 9, 10),
(3, 10, 10),
(3, 11, 10),
(4, 1, 9),
(4, 2, 50),
(4, 3, 50),
(4, 4, 50),
(4, 5, 50),
(4, 6, 10),
(4, 7, 10),
(4, 8, 10),
(4, 9, 10),
(4, 10, 10),
(4, 11, 10),
(5, 1, 8),
(5, 2, 90),
(5, 3, 90),
(5, 4, 90),
(5, 5, 90),
(5, 6, 20),
(5, 7, 10),
(5, 8, 10),
(5, 9, 10),
(5, 10, 10),
(5, 11, 10);

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
(3, 1),
(4, 1),
(5, 1),
(1, 2),
(2, 2),
(5, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `played_character`
--

INSERT INTO `played_character` (`character_id`, `character_name`, `character_creation_date`, `player_id`) VALUES
(1, 'Parya', '2023-05-11 11:03:41', 1),
(2, 'Hisha', '2023-05-11 11:04:12', 2),
(3, 'Eriole', '2023-05-11 11:04:43', 3),
(4, 'Snow', '2023-05-11 11:04:56', 4),
(5, 'Arthur', '2023-05-11 11:05:15', 3);

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
(1, 'Antoine', 'antoine@mail.com', '$2y$10$yGGJ/wSMV2IILHkXaHB4I.BqGz4ajT4VRfPSi4E7s5w92E9DWynv.'),
(2, 'Hichem', 'hichem@mail.com', '$2y$10$/24NwR91Xd7v6bTJvZ9NzOT3IvkeElpaeYJWSUdYfUWl9OxakAES.'),
(3, 'Joanna', 'joanna@mail.com', '$2y$10$k3zN3ZssWzgxqcu3HG382O8BSkiyEe69q8V2ivAXQYo5rrGQWjThC'),
(4, 'Winai', 'winai@mail.com', '$2y$10$iVHRpKTzdFLLmSZVEv7U/eskQcqpZO1bvt85hBnxH5RgmmCQFPCrC');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`skill_id`, `skill_name`, `skill_level`, `player_id`, `statistic_id`) VALUES
(1, 'Voleur à la sauvette', 0, NULL, 7),
(2, 'Charmeur de patate', 0, NULL, 9);

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
  PRIMARY KEY (`statistic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statistic`
--

INSERT INTO `statistic` (`statistic_id`, `statistic_name`, `statistic_shortname`, `statistic_quantity`) VALUES
(1, 'Initiative', 'INIT', 10),
(2, 'Points de vie max', 'PVmax', 250),
(3, 'Points de vie actuels', 'PVact', 250),
(4, 'Points de magie max', 'PMmax', 250),
(5, 'Points de magie actuels', 'PMact', 250),
(6, 'Force', 'FOR', 20),
(7, 'Dexterite', 'DEX', 20),
(8, 'Constitution', 'CONST', 20),
(9, 'Intelligence', 'INT', 20),
(10, 'Sagesse', 'SAG', 20),
(11, 'Chance', 'CHA', 20);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stuff`
--

INSERT INTO `stuff` (`stuff_id`, `stuff_name`, `stuff_dmg`, `stuff_range`, `player_id`) VALUES
(1, 'Hache à 2 mains', 1, 1, NULL),
(2, 'Epée rouillée', 5, 1, NULL);

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
