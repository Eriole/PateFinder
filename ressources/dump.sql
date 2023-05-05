-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 05 mai 2023 à 13:56
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
CREATE DATABASE IF NOT EXISTS `exo_patefinder` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `character_statistic`
--

DROP TABLE IF EXISTS `character_statistic`;
CREATE TABLE IF NOT EXISTS `character_statistic` (
  `character_id` int NOT NULL,
  `statistic_id` int NOT NULL,
  `current_statistic` tinyint NOT NULL,
  PRIMARY KEY (`character_id`,`statistic_id`),
  KEY `Character_Statistic_Statistic_FK` (`statistic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `game_master`
--

DROP TABLE IF EXISTS `game_master`;
CREATE TABLE IF NOT EXISTS `game_master` (
  `player_id` int NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `played_character`
--

DROP TABLE IF EXISTS `played_character`;
CREATE TABLE IF NOT EXISTS `played_character` (
  `character_id` int NOT NULL AUTO_INCREMENT,
  `character_name` varchar(50) NOT NULL,
  `character_creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `player_id` int NOT NULL,
  PRIMARY KEY (`character_id`),
  KEY `Played_Character_Player_FK` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `player_id` int NOT NULL AUTO_INCREMENT,
  `player_username` varchar(50) NOT NULL,
  `player_mail` varchar(255) NOT NULL,
  `player_password` varchar(255) NOT NULL,
  PRIMARY KEY (`player_id`),
  UNIQUE KEY `Player_AK` (`player_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regular_player`
--

DROP TABLE IF EXISTS `regular_player`;
CREATE TABLE IF NOT EXISTS `regular_player` (
  `player_id` int NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `skill_id` int NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(50) NOT NULL,
  `skill_level` tinyint NOT NULL,
  `player_id` int DEFAULT NULL,
  `statistic_id` int NOT NULL,
  PRIMARY KEY (`skill_id`),
  KEY `Skill_Game_Master_FK` (`player_id`),
  KEY `Skill_Statistic_FK` (`statistic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistic`
--

DROP TABLE IF EXISTS `statistic`;
CREATE TABLE IF NOT EXISTS `statistic` (
  `statistic_id` int NOT NULL AUTO_INCREMENT,
  `statistic_name` varchar(50) NOT NULL,
  `statistic_shortname` varchar(5) NOT NULL,
  `statistic_quantity` tinyint NOT NULL,
  PRIMARY KEY (`statistic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stuff`
--

DROP TABLE IF EXISTS `stuff`;
CREATE TABLE IF NOT EXISTS `stuff` (
  `stuff_id` int NOT NULL AUTO_INCREMENT,
  `stuff_name` varchar(50) NOT NULL,
  `stuff_dmg` tinyint NOT NULL,
  `stuff_range` tinyint NOT NULL,
  `player_id` int DEFAULT NULL,
  PRIMARY KEY (`stuff_id`),
  KEY `Stuff_Game_Master_FK` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
