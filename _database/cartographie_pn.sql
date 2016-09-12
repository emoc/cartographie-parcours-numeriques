-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2016 at 01:07 PM
-- Server version: 5.5.20
-- PHP Version: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cartographie_pn`
--

-- --------------------------------------------------------

--
-- Table structure for table `activites`
--

CREATE TABLE IF NOT EXISTS `activites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(11) DEFAULT NULL,
  `activite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activites_idlieu_lieux_id` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=364 ;

-- --------------------------------------------------------

--
-- Table structure for table `actualites`
--

CREATE TABLE IF NOT EXISTS `actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(11) DEFAULT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` text COLLATE utf8mb4_unicode_ci,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actualites_idlieu_lieux_id` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=250 ;

-- --------------------------------------------------------

--
-- Table structure for table `centres_interet`
--

CREATE TABLE IF NOT EXISTS `centres_interet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(11) DEFAULT NULL,
  `centre_interet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_centresinteret_idlieu_lieux_id` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `espaces`
--

CREATE TABLE IF NOT EXISTS `espaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(11) DEFAULT NULL,
  `espace` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_espaces_idlieu_lieux_id` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=140 ;

-- --------------------------------------------------------

--
-- Table structure for table `lieux`
--

CREATE TABLE IF NOT EXISTS `lieux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_util` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('association','collectivité','entreprise','autre') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentation` text COLLATE utf8mb4_unicode_ci,
  `horaires` text COLLATE utf8mb4_unicode_ci,
  `activites` text COLLATE utf8mb4_unicode_ci,
  `acces_mobilite_reduite` int(11) DEFAULT NULL,
  `lien_article` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fil_rss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lieux_idutil_utilisateurs_id` (`id_util`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=220 ;

-- --------------------------------------------------------

--
-- Table structure for table `reseaux`
--

CREATE TABLE IF NOT EXISTS `reseaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(11) DEFAULT NULL,
  `reseau` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reseaux_idlieu_lieux_id` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=148 ;

-- --------------------------------------------------------

--
-- Table structure for table `reseaux_sociaux`
--

CREATE TABLE IF NOT EXISTS `reseaux_sociaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(11) DEFAULT NULL,
  `reseau` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resseauxsociaux_idlieu_lieux_id` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=125 ;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `valide` int(11) DEFAULT NULL,
  `derniere_connexion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utilisateurs_idlieu_lieux_id` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=221 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `fk_activites_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`),
  ADD CONSTRAINT `fk_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`);

--
-- Constraints for table `actualites`
--
ALTER TABLE `actualites`
  ADD CONSTRAINT `fk_actualites_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`);

--
-- Constraints for table `centres_interet`
--
ALTER TABLE `centres_interet`
  ADD CONSTRAINT `fk_centresinteret_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`);

--
-- Constraints for table `espaces`
--
ALTER TABLE `espaces`
  ADD CONSTRAINT `fk_espaces_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`);

--
-- Constraints for table `lieux`
--
ALTER TABLE `lieux`
  ADD CONSTRAINT `fk_lieux_idutil_utilisateurs_id` FOREIGN KEY (`id_util`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `reseaux`
--
ALTER TABLE `reseaux`
  ADD CONSTRAINT `fk_reseaux_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`);

--
-- Constraints for table `reseaux_sociaux`
--
ALTER TABLE `reseaux_sociaux`
  ADD CONSTRAINT `fk_resseauxsociaux_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`);

--
-- Constraints for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `fk_utilisateurs_idlieu_lieux_id` FOREIGN KEY (`id_lieu`) REFERENCES `lieux` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
