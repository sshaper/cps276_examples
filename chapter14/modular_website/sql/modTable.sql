-- Chapter 14: import this file once into your russet MySQL database.
-- Creates contactMod for the modular contact manager.
-- Controllers INSERT / SELECT / UPDATE / DELETE through PdoMethods.
--
-- JSON keys first_name, last_name, zip_code map to firstName, lastName, zip.
-- id is stored on each table row in JavaScript (tr.dataset.id) for update and delete.
--
-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: final_project
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contactMod`
--

DROP TABLE IF EXISTS `contactMod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactMod` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  -- stored on the <tr> as data-id for Update/Delete
  `firstName` varchar(250) NOT NULL DEFAULT 'no data entered',  -- JSON key: first_name
  `lastName` varchar(250) NOT NULL DEFAULT 'no data entered',   -- JSON key: last_name
  `address` varchar(250) NOT NULL DEFAULT 'no data entered',
  `state` varchar(250) NOT NULL DEFAULT 'no data entered',
  `zip` varchar(250) NOT NULL DEFAULT 'no data entered',        -- JSON key: zip_code
  `phone` varchar(250) NOT NULL DEFAULT 'no data entered',
  `email` varchar(250) NOT NULL DEFAULT 'no data entered',

   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

