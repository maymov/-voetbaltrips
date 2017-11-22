-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: kebucdqcfb
-- ------------------------------------------------------
-- Server version	5.5.55-0+deb8u1

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
-- Table structure for table `accomodations`
--

DROP TABLE IF EXISTS `accomodations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accomodations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `high_season_prices` decimal(15,2) NOT NULL,
  `low_season_prices` decimal(15,2) NOT NULL,
  `options` text COLLATE utf8_unicode_ci NOT NULL,
  `breakfast_price` decimal(15,2) NOT NULL,
  `images` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accomodations`
--

LOCK TABLES `accomodations` WRITE;
/*!40000 ALTER TABLE `accomodations` DISABLE KEYS */;
INSERT INTO `accomodations` VALUES (1,'New Hotel','Test Address',200,2,5,80.00,60.00,'test',5.00,'3kVlD57f5346445f38abc69dfdd268d1cad78efb95da2a8214c0560ecb52366hCMcoS55F2.jpg','test','2016-10-05 15:12:04','2017-04-03 13:19:05'),(2,'Cheap hotel','rue de cheap',200,2,4,40.00,20.00,'dogs allowed, nothing else,mooispul,pope,zwembad',10.00,'CgvUL57fe253470a8c6262caa69b3caf6bf4b411625eda77de8f5db4b5306997CDVnF8RHd.png','What a beautiful hotel!','2016-10-12 09:57:40','2017-05-09 09:41:29');
/*!40000 ALTER TABLE `accomodations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'PweEyhssfxBxBXsK1GQi2U9nnLc7onN1',1,'2016-06-20 06:57:02','2016-06-20 06:57:02','2016-06-20 06:57:02'),(2,2,'aV9soB58L4idsRbd5zYlmAjF1lAD8Rzc',1,'2016-06-20 07:15:45','2016-06-20 07:15:45','2016-06-20 07:15:45'),(3,3,'DjgjZTN8SL9XbfIfytEmDkVV3UR7wqr4',1,'2016-06-20 12:17:50','2016-06-20 12:17:50','2016-06-20 12:17:50'),(4,4,'Zb0BPEPFnmoVOYn3bFkfmlQ0LoTh2kKB',1,'2016-06-28 14:08:58','2016-06-28 14:08:58','2016-06-28 14:08:58'),(5,5,'Uy2goSAebhd52n9QSp4P5d7yAXF9Dxp4',1,'2016-10-06 02:36:44','2016-10-06 02:36:44','2016-10-06 02:36:44'),(6,6,'LV05HwlzfmQGVF2CMcfFZyA95KI4g8EV',1,'2017-01-29 21:14:56','2017-01-29 21:14:56','2017-01-29 21:14:56'),(7,7,'a1ikzGNeaE4UlgtH2l5A7bCKyK1DbVQH',1,'2017-02-17 09:14:12','2017-02-17 09:14:12','2017-02-17 09:14:12'),(8,8,'lZiv97owxDMPfvVWpkjDQAYB9SQDsHud',1,'2017-03-05 21:34:51','2017-03-05 21:34:51','2017-03-05 21:34:51'),(9,9,'skYkypR9GnB8Qj6prnkow2Gi5QJnugNu',1,'2017-03-06 10:20:12','2017-03-06 10:20:12','2017-03-06 10:20:12'),(10,10,'9qmrAQnlaY9xyNMc0c2vzWPaVLeH1O90',1,'2017-03-10 08:35:15','2017-03-10 08:35:15','2017-03-10 08:35:15'),(11,11,'eW50pgdWhnDTYtMHnumyxWY47YRn4g4A',1,'2017-03-10 12:05:05','2017-03-10 12:05:05','2017-03-10 12:05:05'),(12,12,'j4FViePlgzxPTD0qG4TU3Cdfz46DA7v5',1,'2017-03-29 09:54:08','2017-03-29 09:54:08','2017-03-29 09:54:08'),(13,13,'8fEFuZz36cVBd4GmMRTXYDhXlBuIpQfZ',1,'2017-03-31 15:19:33','2017-03-31 15:19:33','2017-03-31 15:19:33'),(14,14,'M7S0cMMdF1HKZbAGrxtGDXbYRyTtnH9v',1,'2017-04-02 15:17:53','2017-04-02 15:16:17','2017-04-02 15:17:53'),(15,15,'QjLes48mNLD5wySJCSBbAllJe6tSnWCb',1,'2017-04-20 20:53:57','2017-04-20 20:53:57','2017-04-20 20:53:57'),(16,16,'moL6mPhus0b2VRlwT4MwjeYEx1ZJnDc9',1,'2017-04-23 13:50:19','2017-04-23 13:50:19','2017-04-23 13:50:19'),(17,17,'N0A0nRh79RR2FuEIZSoQTz8p8xRykuqr',1,'2017-04-24 11:18:58','2017-04-24 11:18:58','2017-04-24 11:18:58'),(18,18,'ItEjA3knnvigLceei7NUdY5YJbjvbmOv',1,'2017-05-17 10:28:52','2017-05-17 10:28:52','2017-05-17 10:28:52');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airlines`
--

DROP TABLE IF EXISTS `airlines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airlines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airlines`
--

LOCK TABLES `airlines` WRITE;
/*!40000 ALTER TABLE `airlines` DISABLE KEYS */;
INSERT INTO `airlines` VALUES (1,'transavia','2016-10-05 10:15:30','2016-10-05 10:15:30'),(2,'easyJet','2016-10-05 10:15:31','2016-10-05 10:15:31'),(3,'Germanwings','2016-10-05 10:15:32','2016-10-05 10:15:32'),(4,'Pegasus','2016-10-05 10:15:32','2016-10-05 10:15:32'),(5,'Vueling','2016-10-05 10:15:37','2016-10-05 10:15:37'),(6,'Ryanair','2016-10-05 10:15:39','2016-10-05 10:15:39'),(7,'KLM','2017-04-02 17:56:24','2017-04-02 17:56:24');
/*!40000 ALTER TABLE `airlines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airport_cities`
--

DROP TABLE IF EXISTS `airport_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airport_cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `airport_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airport_cities`
--

LOCK TABLES `airport_cities` WRITE;
/*!40000 ALTER TABLE `airport_cities` DISABLE KEYS */;
INSERT INTO `airport_cities` VALUES (1,3,2,'2016-12-07 14:09:53','2017-02-22 21:47:51'),(2,12,10,'2017-02-22 22:30:26','2017-02-22 22:30:44'),(3,29,2,'2017-03-06 11:46:58','2017-03-06 11:46:58');
/*!40000 ALTER TABLE `airport_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airportlists`
--

DROP TABLE IF EXISTS `airportlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airportlists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iata_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `showinsearch` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'to set the flag from the admin panel that whether this airport is need to show in search dropdown or not',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airportlists`
--

LOCK TABLES `airportlists` WRITE;
/*!40000 ALTER TABLE `airportlists` DISABLE KEYS */;
INSERT INTO `airportlists` VALUES (1,153,1,'Amsterdam (AMS)','AMS','1','2016-10-05 10:15:30','2017-02-02 11:18:00'),(2,200,2,'Barcelona (BCN)','BCN','1','2016-10-05 10:15:31','2017-02-02 11:18:08'),(3,200,2,'Barcelona (Girona) (GRO)','GRO','1','2016-10-05 10:15:31','2017-04-30 17:28:56'),(4,83,4,'Hamburg (HAM)','HAM','0','2016-10-05 10:15:32','2016-10-05 10:15:32'),(5,220,5,'Istanbul (Sabiha) (SAW)','SAW','1','2016-10-05 10:15:33','2017-02-17 09:23:00'),(6,227,6,'Liverpool (LPL)','LPL','0','2016-10-05 10:15:33','2016-10-05 10:15:33'),(7,227,7,'London (Gatwick) (LGW)','LGW','0','2016-10-05 10:15:34','2016-10-05 10:15:34'),(8,227,7,'London (Luton) (LTN)','LTN','0','2016-10-05 10:15:34','2016-10-05 10:15:34'),(9,227,7,'London (Stansted) (STN)','STN','0','2016-10-05 10:15:35','2016-10-05 10:15:35'),(10,220,8,'Adana (ADA)','ADA','0','2016-10-05 10:15:36','2016-10-05 10:15:36'),(11,227,9,'Manchester (MAN)','MAN','0','2016-10-05 10:15:36','2016-10-05 10:15:36'),(12,107,10,'Milan (Linate) (LIN)','LIN','1','2016-10-05 10:15:37','2017-02-22 22:30:05'),(13,107,10,'Milan (Malpensa) (MXP)','MXP','1','2016-10-05 10:15:37','2017-02-22 20:29:07'),(14,174,11,'Porto (OPO)','OPO','0','2016-10-05 10:15:38','2016-10-05 10:15:38'),(15,107,12,'Rome (Fiumicino) (FCO)','FCO','0','2016-10-05 10:15:39','2016-10-05 10:15:39'),(16,107,13,'Turin (TRN)','TRN','0','2016-10-05 10:15:39','2016-10-05 10:15:39'),(17,24,14,'Brussels (BRU)','BRU','1','2016-10-05 10:15:40','2017-02-02 11:20:50'),(18,24,14,'Brussels (Charleroi) (CRL)','CRL','1','2016-10-05 10:15:40','2017-02-02 11:20:57'),(19,200,15,'Madrid (MAD)','MAD','0','2016-10-05 10:15:41','2016-10-05 10:15:41'),(20,107,10,'Milan (Bergamo) (BGY)','BGY','0','2016-10-05 10:15:41','2016-10-05 10:15:41'),(21,107,12,'Rome (Ciampino) (CIA)','CIA','0','2016-10-05 10:15:42','2016-10-05 10:15:42'),(22,83,16,'Cologne Bonn (CGN)','CGN','0','2016-10-05 10:15:43','2016-10-05 10:15:43'),(23,227,7,'London (Heathrow) (LHR)','LHR','0','2016-10-05 10:15:43','2016-10-05 10:15:43'),(24,83,17,'Dortmund (DTM)','DTM','1','2016-10-05 10:15:44','2017-02-02 11:20:09'),(25,83,18,'Dusseldorf (DUS)','DUS','1','2016-10-05 10:15:44','2017-02-02 11:19:42'),(26,2,19,'Dusseldorf (Weeze) (NRN)','NRN','1','2016-10-05 10:15:45','2017-02-02 11:19:26'),(27,153,20,'Eindhoven (EIN)','EIN','1','2016-10-05 10:15:46','2017-02-02 11:19:02'),(28,153,21,'Rotterdam (RTM)','RTM','1','2016-10-05 10:15:46','2017-02-02 11:18:42'),(29,200,2,'Reus (REU)','REU','1','2016-10-05 10:15:48','2017-03-06 11:40:01'),(30,153,23,'Maastricht (MST)','MST','0','2016-10-05 10:15:50','2016-10-05 10:15:50');
/*!40000 ALTER TABLE `airportlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `airport_code` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `cities_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airports`
--

LOCK TABLES `airports` WRITE;
/*!40000 ALTER TABLE `airports` DISABLE KEYS */;
/*!40000 ALTER TABLE `airports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comments`
--

LOCK TABLES `blog_comments` WRITE;
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Amsterdam',153,'2016-10-05 10:15:30','2016-10-05 10:15:30'),(2,'Barcelona',200,'2016-10-05 10:15:31','2016-10-05 10:15:31'),(3,'Girona',200,'2016-10-05 10:15:31','2016-10-05 10:15:31'),(4,'Hamburg',83,'2016-10-05 10:15:32','2016-10-05 10:15:32'),(5,'Istanbul',220,'2016-10-05 10:15:33','2016-10-05 10:15:33'),(6,'Liverpool',227,'2016-10-05 10:15:33','2016-10-05 10:15:33'),(7,'London',227,'2016-10-05 10:15:34','2016-10-05 10:15:34'),(8,'Adana',220,'2016-10-05 10:15:36','2016-10-05 10:15:36'),(9,'Manchester',227,'2016-10-05 10:15:36','2016-10-05 10:15:36'),(10,'Milan',107,'2016-10-05 10:15:37','2016-10-05 10:15:37'),(11,'Porto',174,'2016-10-05 10:15:38','2016-10-05 10:15:38'),(12,'Rome',107,'2016-10-05 10:15:39','2016-10-05 10:15:39'),(13,'Turin',107,'2016-10-05 10:15:39','2016-10-05 10:15:39'),(14,'Brussels',24,'2016-10-05 10:15:40','2016-10-05 10:15:40'),(15,'Madrid',200,'2016-10-05 10:15:41','2016-10-05 10:15:41'),(16,'Cologne/Bonn',83,'2016-10-05 10:15:43','2016-10-05 10:15:43'),(17,'Dortmund',83,'2016-10-05 10:15:44','2016-10-05 10:15:44'),(18,'Duesseldorf',83,'2016-10-05 10:15:44','2016-10-05 10:15:44'),(19,'Norton Muni',2,'2016-10-05 10:15:45','2016-10-05 10:15:45'),(20,'Eindhoven',153,'2016-10-05 10:15:46','2016-10-05 10:15:46'),(21,'Rotterdam',153,'2016-10-05 10:15:46','2016-10-05 10:15:46'),(22,'Reus',200,'2016-10-05 10:15:48','2017-03-09 19:51:13'),(23,'Maastricht',153,'2016-10-05 10:15:50','2016-10-05 10:15:50');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `client_nr` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clubs`
--

DROP TABLE IF EXISTS `clubs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clubs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `story` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubs`
--

LOCK TABLES `clubs` WRITE;
/*!40000 ALTER TABLE `clubs` DISABLE KEYS */;
INSERT INTO `clubs` VALUES (1,'Barcelona','200','2','Test the description','2016-10-05 11:01:07','2016-10-05 11:01:07'),(2,'Gent','2','19','test description','2016-10-05 11:02:51','2016-12-08 10:42:21'),(3,'AC Milan','107','10','hoisdjfpadofh','2017-02-22 18:10:30','2017-02-22 18:10:30'),(4,'Real Madrid','200','15','Madrid','2017-04-03 18:54:34','2017-04-03 18:54:34');
/*!40000 ALTER TABLE `clubs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competition_seatings`
--

DROP TABLE IF EXISTS `competition_seatings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competition_seatings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matches_id` int(11) NOT NULL,
  `seatingcategory_id` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity_available` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competition_seatings`
--

LOCK TABLES `competition_seatings` WRITE;
/*!40000 ALTER TABLE `competition_seatings` DISABLE KEYS */;
INSERT INTO `competition_seatings` VALUES (19,5,4,80.00,8,'2017-04-30 17:15:54','2017-04-30 17:15:54');
/*!40000 ALTER TABLE `competition_seatings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (2,'US','United States','2016-10-05 10:05:24','2016-10-05 10:05:24'),(3,'CA','Canada','2016-10-05 10:05:24','2016-10-05 10:05:24'),(4,'AF','Afghanistan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(5,'AL','Albania','2016-10-05 10:05:24','2016-10-05 10:05:24'),(6,'DZ','Algeria','2016-10-05 10:05:24','2016-10-05 10:05:24'),(7,'AS','American Samoa','2016-10-05 10:05:24','2016-10-05 10:05:24'),(8,'AD','Andorra','2016-10-05 10:05:24','2016-10-05 10:05:24'),(9,'AO','Angola','2016-10-05 10:05:24','2016-10-05 10:05:24'),(10,'AI','Anguilla','2016-10-05 10:05:24','2016-10-05 10:05:24'),(11,'AQ','Antarctica','2016-10-05 10:05:24','2016-10-05 10:05:24'),(12,'AG','Antigua and/or Barbuda','2016-10-05 10:05:24','2016-10-05 10:05:24'),(13,'AR','Argentina','2016-10-05 10:05:24','2016-10-05 10:05:24'),(14,'AM','Armenia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(15,'AW','Aruba','2016-10-05 10:05:24','2016-10-05 10:05:24'),(16,'AU','Australia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(17,'AT','Austria','2016-10-05 10:05:24','2016-10-05 10:05:24'),(18,'AZ','Azerbaijan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(19,'BS','Bahamas','2016-10-05 10:05:24','2016-10-05 10:05:24'),(20,'BH','Bahrain','2016-10-05 10:05:24','2016-10-05 10:05:24'),(21,'BD','Bangladesh','2016-10-05 10:05:24','2016-10-05 10:05:24'),(22,'BB','Barbados','2016-10-05 10:05:24','2016-10-05 10:05:24'),(23,'BY','Belarus','2016-10-05 10:05:24','2016-10-05 10:05:24'),(24,'BE','Belgium','2016-10-05 10:05:24','2016-10-05 10:05:24'),(25,'BZ','Belize','2016-10-05 10:05:24','2016-10-05 10:05:24'),(26,'BJ','Benin','2016-10-05 10:05:24','2016-10-05 10:05:24'),(27,'BM','Bermuda','2016-10-05 10:05:24','2016-10-05 10:05:24'),(28,'BT','Bhutan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(29,'BO','Bolivia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(30,'BA','Bosnia and Herzegovina','2016-10-05 10:05:24','2016-10-05 10:05:24'),(31,'BW','Botswana','2016-10-05 10:05:24','2016-10-05 10:05:24'),(32,'BV','Bouvet Island','2016-10-05 10:05:24','2016-10-05 10:05:24'),(33,'BR','Brazil','2016-10-05 10:05:24','2016-10-05 10:05:24'),(34,'IO','British lndian Ocean Territory','2016-10-05 10:05:24','2016-10-05 10:05:24'),(35,'BN','Brunei Darussalam','2016-10-05 10:05:24','2016-10-05 10:05:24'),(36,'BG','Bulgaria','2016-10-05 10:05:24','2016-10-05 10:05:24'),(37,'BF','Burkina Faso','2016-10-05 10:05:24','2016-10-05 10:05:24'),(38,'BI','Burundi','2016-10-05 10:05:24','2016-10-05 10:05:24'),(39,'KH','Cambodia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(40,'CM','Cameroon','2016-10-05 10:05:24','2016-10-05 10:05:24'),(41,'CV','Cape Verde','2016-10-05 10:05:24','2016-10-05 10:05:24'),(42,'KY','Cayman Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(43,'CF','Central African Republic','2016-10-05 10:05:24','2016-10-05 10:05:24'),(44,'TD','Chad','2016-10-05 10:05:24','2016-10-05 10:05:24'),(45,'CL','Chile','2016-10-05 10:05:24','2016-10-05 10:05:24'),(46,'CN','China','2016-10-05 10:05:24','2016-10-05 10:05:24'),(47,'CX','Christmas Island','2016-10-05 10:05:24','2016-10-05 10:05:24'),(48,'CC','Cocos (Keeling) Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(49,'CO','Colombia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(50,'KM','Comoros','2016-10-05 10:05:24','2016-10-05 10:05:24'),(51,'CG','Congo','2016-10-05 10:05:24','2016-10-05 10:05:24'),(52,'CK','Cook Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(53,'CR','Costa Rica','2016-10-05 10:05:24','2016-10-05 10:05:24'),(54,'HR','Croatia (Hrvatska)','2016-10-05 10:05:24','2016-10-05 10:05:24'),(55,'CU','Cuba','2016-10-05 10:05:24','2016-10-05 10:05:24'),(56,'CY','Cyprus','2016-10-05 10:05:24','2016-10-05 10:05:24'),(57,'CZ','Czech Republic','2016-10-05 10:05:24','2016-10-05 10:05:24'),(58,'CD','Democratic Republic of Congo','2016-10-05 10:05:24','2016-10-05 10:05:24'),(59,'DK','Denmark','2016-10-05 10:05:24','2016-10-05 10:05:24'),(60,'DJ','Djibouti','2016-10-05 10:05:24','2016-10-05 10:05:24'),(61,'DM','Dominica','2016-10-05 10:05:24','2016-10-05 10:05:24'),(62,'DO','Dominican Republic','2016-10-05 10:05:24','2016-10-05 10:05:24'),(63,'TP','East Timor','2016-10-05 10:05:24','2016-10-05 10:05:24'),(64,'EC','Ecudaor','2016-10-05 10:05:24','2016-10-05 10:05:24'),(65,'EG','Egypt','2016-10-05 10:05:24','2016-10-05 10:05:24'),(66,'SV','El Salvador','2016-10-05 10:05:24','2016-10-05 10:05:24'),(67,'GQ','Equatorial Guinea','2016-10-05 10:05:24','2016-10-05 10:05:24'),(68,'ER','Eritrea','2016-10-05 10:05:24','2016-10-05 10:05:24'),(69,'EE','Estonia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(70,'ET','Ethiopia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(71,'FK','Falkland Islands (Malvinas)','2016-10-05 10:05:24','2016-10-05 10:05:24'),(72,'FO','Faroe Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(73,'FJ','Fiji','2016-10-05 10:05:24','2016-10-05 10:05:24'),(74,'FI','Finland','2016-10-05 10:05:24','2016-10-05 10:05:24'),(75,'FR','France','2016-10-05 10:05:24','2016-10-05 10:05:24'),(76,'FX','France, Metropolitan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(77,'GF','French Guiana','2016-10-05 10:05:24','2016-10-05 10:05:24'),(78,'PF','French Polynesia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(79,'TF','French Southern Territories','2016-10-05 10:05:24','2016-10-05 10:05:24'),(80,'GA','Gabon','2016-10-05 10:05:24','2016-10-05 10:05:24'),(81,'GM','Gambia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(82,'GE','Georgia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(83,'DE','Germany','2016-10-05 10:05:24','2016-10-05 10:05:24'),(84,'GH','Ghana','2016-10-05 10:05:24','2016-10-05 10:05:24'),(85,'GI','Gibraltar','2016-10-05 10:05:24','2016-10-05 10:05:24'),(86,'GR','Greece','2016-10-05 10:05:24','2016-10-05 10:05:24'),(87,'GL','Greenland','2016-10-05 10:05:24','2016-10-05 10:05:24'),(88,'GD','Grenada','2016-10-05 10:05:24','2016-10-05 10:05:24'),(89,'GP','Guadeloupe','2016-10-05 10:05:24','2016-10-05 10:05:24'),(90,'GU','Guam','2016-10-05 10:05:24','2016-10-05 10:05:24'),(91,'GT','Guatemala','2016-10-05 10:05:24','2016-10-05 10:05:24'),(92,'GN','Guinea','2016-10-05 10:05:24','2016-10-05 10:05:24'),(93,'GW','Guinea-Bissau','2016-10-05 10:05:24','2016-10-05 10:05:24'),(94,'GY','Guyana','2016-10-05 10:05:24','2016-10-05 10:05:24'),(95,'HT','Haiti','2016-10-05 10:05:24','2016-10-05 10:05:24'),(96,'HM','Heard and Mc Donald Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(97,'HN','Honduras','2016-10-05 10:05:24','2016-10-05 10:05:24'),(98,'HK','Hong Kong','2016-10-05 10:05:24','2016-10-05 10:05:24'),(99,'HU','Hungary','2016-10-05 10:05:24','2016-10-05 10:05:24'),(100,'IS','Iceland','2016-10-05 10:05:24','2016-10-05 10:05:24'),(101,'IN','India','2016-10-05 10:05:24','2016-10-05 10:05:24'),(102,'ID','Indonesia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(103,'IR','Iran (Islamic Republic of)','2016-10-05 10:05:24','2016-10-05 10:05:24'),(104,'IQ','Iraq','2016-10-05 10:05:24','2016-10-05 10:05:24'),(105,'IE','Ireland','2016-10-05 10:05:24','2016-10-05 10:05:24'),(106,'IL','Israel','2016-10-05 10:05:24','2016-10-05 10:05:24'),(107,'IT','Italy','2016-10-05 10:05:24','2016-10-05 10:05:24'),(108,'CI','Ivory Coast','2016-10-05 10:05:24','2016-10-05 10:05:24'),(109,'JM','Jamaica','2016-10-05 10:05:24','2016-10-05 10:05:24'),(110,'JP','Japan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(111,'JO','Jordan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(112,'KZ','Kazakhstan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(113,'KE','Kenya','2016-10-05 10:05:24','2016-10-05 10:05:24'),(114,'KI','Kiribati','2016-10-05 10:05:24','2016-10-05 10:05:24'),(115,'KP','Korea, Democratic People\'s Republic of','2016-10-05 10:05:24','2016-10-05 10:05:24'),(116,'KR','Korea, Republic of','2016-10-05 10:05:24','2016-10-05 10:05:24'),(117,'KW','Kuwait','2016-10-05 10:05:24','2016-10-05 10:05:24'),(118,'KG','Kyrgyzstan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(119,'LA','Lao People\'s Democratic Republic','2016-10-05 10:05:24','2016-10-05 10:05:24'),(120,'LV','Latvia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(121,'LB','Lebanon','2016-10-05 10:05:24','2016-10-05 10:05:24'),(122,'LS','Lesotho','2016-10-05 10:05:24','2016-10-05 10:05:24'),(123,'LR','Liberia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(124,'LY','Libyan Arab Jamahiriya','2016-10-05 10:05:24','2016-10-05 10:05:24'),(125,'LI','Liechtenstein','2016-10-05 10:05:24','2016-10-05 10:05:24'),(126,'LT','Lithuania','2016-10-05 10:05:24','2016-10-05 10:05:24'),(127,'LU','Luxembourg','2016-10-05 10:05:24','2016-10-05 10:05:24'),(128,'MO','Macau','2016-10-05 10:05:24','2016-10-05 10:05:24'),(129,'MK','Macedonia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(130,'MG','Madagascar','2016-10-05 10:05:24','2016-10-05 10:05:24'),(131,'MW','Malawi','2016-10-05 10:05:24','2016-10-05 10:05:24'),(132,'MY','Malaysia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(133,'MV','Maldives','2016-10-05 10:05:24','2016-10-05 10:05:24'),(134,'ML','Mali','2016-10-05 10:05:24','2016-10-05 10:05:24'),(135,'MT','Malta','2016-10-05 10:05:24','2016-10-05 10:05:24'),(136,'MH','Marshall Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(137,'MQ','Martinique','2016-10-05 10:05:24','2016-10-05 10:05:24'),(138,'MR','Mauritania','2016-10-05 10:05:24','2016-10-05 10:05:24'),(139,'MU','Mauritius','2016-10-05 10:05:24','2016-10-05 10:05:24'),(140,'TY','Mayotte','2016-10-05 10:05:24','2016-10-05 10:05:24'),(141,'MX','Mexico','2016-10-05 10:05:24','2016-10-05 10:05:24'),(142,'FM','Micronesia, Federated States of','2016-10-05 10:05:24','2016-10-05 10:05:24'),(143,'MD','Moldova, Republic of','2016-10-05 10:05:24','2016-10-05 10:05:24'),(144,'MC','Monaco','2016-10-05 10:05:24','2016-10-05 10:05:24'),(145,'MN','Mongolia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(146,'MS','Montserrat','2016-10-05 10:05:24','2016-10-05 10:05:24'),(147,'MA','Morocco','2016-10-05 10:05:24','2016-10-05 10:05:24'),(148,'MZ','Mozambique','2016-10-05 10:05:24','2016-10-05 10:05:24'),(149,'MM','Myanmar','2016-10-05 10:05:24','2016-10-05 10:05:24'),(150,'NA','Namibia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(151,'NR','Nauru','2016-10-05 10:05:24','2016-10-05 10:05:24'),(152,'NP','Nepal','2016-10-05 10:05:24','2016-10-05 10:05:24'),(153,'NL','Netherlands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(154,'AN','Netherlands Antilles','2016-10-05 10:05:24','2016-10-05 10:05:24'),(155,'NC','New Caledonia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(156,'NZ','New Zealand','2016-10-05 10:05:24','2016-10-05 10:05:24'),(157,'NI','Nicaragua','2016-10-05 10:05:24','2016-10-05 10:05:24'),(158,'NE','Niger','2016-10-05 10:05:24','2016-10-05 10:05:24'),(159,'NG','Nigeria','2016-10-05 10:05:24','2016-10-05 10:05:24'),(160,'NU','Niue','2016-10-05 10:05:24','2016-10-05 10:05:24'),(161,'NF','Norfork Island','2016-10-05 10:05:24','2016-10-05 10:05:24'),(162,'MP','Northern Mariana Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(163,'NO','Norway','2016-10-05 10:05:24','2016-10-05 10:05:24'),(164,'OM','Oman','2016-10-05 10:05:24','2016-10-05 10:05:24'),(165,'PK','Pakistan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(166,'PW','Palau','2016-10-05 10:05:24','2016-10-05 10:05:24'),(167,'PA','Panama','2016-10-05 10:05:24','2016-10-05 10:05:24'),(168,'PG','Papua New Guinea','2016-10-05 10:05:24','2016-10-05 10:05:24'),(169,'PY','Paraguay','2016-10-05 10:05:24','2016-10-05 10:05:24'),(170,'PE','Peru','2016-10-05 10:05:24','2016-10-05 10:05:24'),(171,'PH','Philippines','2016-10-05 10:05:24','2016-10-05 10:05:24'),(172,'PN','Pitcairn','2016-10-05 10:05:24','2016-10-05 10:05:24'),(173,'PL','Poland','2016-10-05 10:05:24','2016-10-05 10:05:24'),(174,'PT','Portugal','2016-10-05 10:05:24','2016-10-05 10:05:24'),(175,'PR','Puerto Rico','2016-10-05 10:05:24','2016-10-05 10:05:24'),(176,'QA','Qatar','2016-10-05 10:05:24','2016-10-05 10:05:24'),(177,'SS','Republic of South Sudan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(178,'RE','Reunion','2016-10-05 10:05:24','2016-10-05 10:05:24'),(179,'RO','Romania','2016-10-05 10:05:24','2016-10-05 10:05:24'),(180,'RU','Russian Federation','2016-10-05 10:05:24','2016-10-05 10:05:24'),(181,'RW','Rwanda','2016-10-05 10:05:24','2016-10-05 10:05:24'),(182,'KN','Saint Kitts and Nevis','2016-10-05 10:05:24','2016-10-05 10:05:24'),(183,'LC','Saint Lucia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(184,'VC','Saint Vincent and the Grenadines','2016-10-05 10:05:24','2016-10-05 10:05:24'),(185,'WS','Samoa','2016-10-05 10:05:24','2016-10-05 10:05:24'),(186,'SM','San Marino','2016-10-05 10:05:24','2016-10-05 10:05:24'),(187,'ST','Sao Tome and Principe','2016-10-05 10:05:24','2016-10-05 10:05:24'),(188,'SA','Saudi Arabia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(189,'SN','Senegal','2016-10-05 10:05:24','2016-10-05 10:05:24'),(190,'RS','Serbia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(191,'SC','Seychelles','2016-10-05 10:05:24','2016-10-05 10:05:24'),(192,'SL','Sierra Leone','2016-10-05 10:05:24','2016-10-05 10:05:24'),(193,'SG','Singapore','2016-10-05 10:05:24','2016-10-05 10:05:24'),(194,'SK','Slovakia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(195,'SI','Slovenia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(196,'SB','Solomon Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(197,'SO','Somalia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(198,'ZA','South Africa','2016-10-05 10:05:24','2016-10-05 10:05:24'),(199,'GS','South Georgia South Sandwich Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(200,'ES','Spain','2016-10-05 10:05:24','2016-10-05 10:05:24'),(201,'LK','Sri Lanka','2016-10-05 10:05:24','2016-10-05 10:05:24'),(202,'SH','St. Helena','2016-10-05 10:05:24','2016-10-05 10:05:24'),(203,'PM','St. Pierre and Miquelon','2016-10-05 10:05:24','2016-10-05 10:05:24'),(204,'SD','Sudan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(205,'SR','Suriname','2016-10-05 10:05:24','2016-10-05 10:05:24'),(206,'SJ','Svalbarn and Jan Mayen Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(207,'SZ','Swaziland','2016-10-05 10:05:24','2016-10-05 10:05:24'),(208,'SE','Sweden','2016-10-05 10:05:24','2016-10-05 10:05:24'),(209,'CH','Switzerland','2016-10-05 10:05:24','2016-10-05 10:05:24'),(210,'SY','Syrian Arab Republic','2016-10-05 10:05:24','2016-10-05 10:05:24'),(211,'TW','Taiwan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(212,'TJ','Tajikistan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(213,'TZ','Tanzania, United Republic of','2016-10-05 10:05:24','2016-10-05 10:05:24'),(214,'TH','Thailand','2016-10-05 10:05:24','2016-10-05 10:05:24'),(215,'TG','Togo','2016-10-05 10:05:24','2016-10-05 10:05:24'),(216,'TK','Tokelau','2016-10-05 10:05:24','2016-10-05 10:05:24'),(217,'TO','Tonga','2016-10-05 10:05:24','2016-10-05 10:05:24'),(218,'TT','Trinidad and Tobago','2016-10-05 10:05:24','2016-10-05 10:05:24'),(219,'TN','Tunisia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(220,'TR','Turkey','2016-10-05 10:05:24','2016-10-05 10:05:24'),(221,'TM','Turkmenistan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(222,'TC','Turks and Caicos Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(223,'TV','Tuvalu','2016-10-05 10:05:24','2016-10-05 10:05:24'),(224,'UG','Uganda','2016-10-05 10:05:24','2016-10-05 10:05:24'),(225,'UA','Ukraine','2016-10-05 10:05:24','2016-10-05 10:05:24'),(226,'AE','United Arab Emirates','2016-10-05 10:05:24','2016-10-05 10:05:24'),(227,'GB','United Kingdom','2016-10-05 10:05:24','2016-10-05 10:05:24'),(228,'UM','United States minor outlying islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(229,'UY','Uruguay','2016-10-05 10:05:24','2016-10-05 10:05:24'),(230,'UZ','Uzbekistan','2016-10-05 10:05:24','2016-10-05 10:05:24'),(231,'VU','Vanuatu','2016-10-05 10:05:24','2016-10-05 10:05:24'),(232,'VA','Vatican City State','2016-10-05 10:05:24','2016-10-05 10:05:24'),(233,'VE','Venezuela','2016-10-05 10:05:24','2016-10-05 10:05:24'),(234,'VN','Vietnam','2016-10-05 10:05:24','2016-10-05 10:05:24'),(235,'VG','Virgin Islands (British)','2016-10-05 10:05:24','2016-10-05 10:05:24'),(236,'VI','Virgin Islands (U.S.)','2016-10-05 10:05:24','2016-10-05 10:05:24'),(237,'WF','Wallis and Futuna Islands','2016-10-05 10:05:24','2016-10-05 10:05:24'),(238,'EH','Western Sahara','2016-10-05 10:05:24','2016-10-05 10:05:24'),(239,'YE','Yemen','2016-10-05 10:05:24','2016-10-05 10:05:24'),(240,'YU','Yugoslavia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(241,'ZR','Zaire','2016-10-05 10:05:24','2016-10-05 10:05:24'),(242,'ZM','Zambia','2016-10-05 10:05:24','2016-10-05 10:05:24'),(243,'ZW','Zimbabwe','2016-10-05 10:05:24','2016-10-05 10:05:24'),(244,'ss','yoy\'s','2016-10-05 10:05:24','2016-10-05 10:05:24');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flightmode` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT 'to know the flight is inbound or outbound. 1 means outbound and 2 means return',
  `airlines_id` int(11) NOT NULL,
  `flight_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `via` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrive_date` date NOT NULL,
  `arrive_time` time NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `currency` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=864 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flights`
--

LOCK TABLES `flights` WRITE;
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
INSERT INTO `flights` VALUES (1,'1',6,'',26,2,'\"','2017-06-09','06:30:00','2017-06-10','00:00:00','17 h 30',40.00,'EUR','2017-04-12 20:06:58','2017-05-09 09:49:52'),(2,'2',6,'',2,26,'\"','2017-06-12','14:00:00','2017-04-29','00:00:00','14 h 00',50.00,'EUR','2017-04-12 20:06:58','2017-04-30 17:21:19'),(3,'1',6,'',26,3,'\"','2017-06-09','06:30:00','2017-05-29','00:00:00','6 h 30',10.00,'EUR','2017-04-12 20:06:58','2017-05-09 10:55:39'),(4,'2',6,'',3,26,'\"','2017-06-12','06:30:00','2017-05-09','00:00:00','6 h 30',15.00,'EUR','2017-04-12 20:06:58','2017-04-30 17:22:12'),(5,'1',6,'',27,3,'\"','2017-05-09','09:10:00','2017-05-09','00:00:00','2 h 00',20.39,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(6,'1',6,'',27,3,'\"','2017-05-29','09:10:00','2017-05-29','00:00:00','2 h 00',20.39,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(7,'1',6,'',27,3,'\"','2017-05-02','09:10:00','2017-05-02','00:00:00','2 h 00',25.69,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(8,'1',6,'',27,3,'\"','2017-05-07','09:10:00','2017-05-07','00:00:00','2 h 00',25.69,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(9,'1',6,'',27,3,'\"','2017-05-14','09:10:00','2017-05-14','00:00:00','2 h 00',25.69,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(10,'1',6,'',27,3,'\"','2017-05-10','09:10:00','2017-05-10','00:00:00','2 h 00',25.69,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(11,'1',6,'',27,3,'\"','2017-05-16','09:10:00','2017-05-16','00:00:00','2 h 00',25.69,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(12,'1',6,'',26,3,'\"','2017-05-16','06:30:00','2017-05-16','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(13,'1',6,'',26,3,'\"','2017-05-04','06:30:00','2017-05-04','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(14,'1',6,'',26,3,'\"','2017-05-17','06:30:00','2017-05-17','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(15,'1',6,'',26,3,'\"','2017-05-05','06:30:00','2017-05-05','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(16,'1',6,'',26,3,'\"','2017-05-06','06:30:00','2017-05-06','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(17,'1',6,'',26,3,'\"','2017-05-06','18:35:00','2017-05-06','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(18,'1',6,'',26,3,'\"','2017-05-22','06:30:00','2017-05-22','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(19,'1',6,'',26,3,'\"','2017-05-10','06:30:00','2017-05-10','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(20,'1',6,'',26,3,'\"','2017-05-13','18:35:00','2017-05-13','00:00:00','2 h 05',27.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(21,'1',6,'',27,3,'\"','2017-05-30','09:10:00','2017-05-30','00:00:00','2 h 00',28.55,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(22,'1',6,'',26,3,'\"','2017-05-30','06:30:00','2017-05-30','00:00:00','2 h 05',30.59,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(23,'1',6,'',26,3,'\"','2017-05-31','06:30:00','2017-05-31','00:00:00','2 h 05',30.59,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(24,'1',5,'',25,2,'\"','2017-05-03','15:50:00','2017-05-03','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(25,'1',5,'',25,2,'\"','2017-05-06','15:50:00','2017-05-06','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(26,'1',5,'',25,2,'\"','2017-05-08','15:50:00','2017-05-08','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(27,'1',5,'',25,2,'\"','2017-05-29','15:50:00','2017-05-29','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(28,'1',5,'',25,2,'\"','2017-05-30','15:50:00','2017-05-30','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(29,'1',5,'',28,2,'\"','2017-05-03','10:45:00','2017-05-03','00:00:00','2 h 10',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(30,'1',5,'',27,2,'\"','2017-05-03','14:45:00','2017-05-03','00:00:00','2 h 10',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(31,'1',5,'',25,2,'\"','2017-05-17','15:50:00','2017-05-17','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(32,'1',5,'',1,2,'\"','2017-05-09','21:50:00','2017-05-10','00:00:00','2 h 20',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(33,'1',5,'',25,2,'\"','2017-05-21','15:50:00','2017-05-21','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(34,'1',5,'',25,2,'\"','2017-05-22','15:50:00','2017-05-22','00:00:00','2 h 15',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(35,'1',5,'',27,2,'\"','2017-05-17','14:45:00','2017-05-17','00:00:00','2 h 10',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(36,'1',5,'',28,2,'\"','2017-05-29','10:45:00','2017-05-29','00:00:00','2 h 10',31.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(37,'1',6,'',27,3,'\"','2017-05-17','09:10:00','2017-05-17','00:00:00','2 h 00',31.20,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(38,'1',6,'',27,3,'\"','2017-05-22','09:10:00','2017-05-22','00:00:00','2 h 00',31.20,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(39,'1',6,'',26,3,'\"','2017-05-15','06:30:00','2017-05-15','00:00:00','2 h 05',33.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(40,'1',6,'',26,3,'\"','2017-05-03','06:30:00','2017-05-03','00:00:00','2 h 05',33.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(41,'1',6,'',26,3,'\"','2017-05-07','13:40:00','2017-05-07','00:00:00','2 h 05',33.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(42,'1',6,'',26,3,'\"','2017-05-20','18:35:00','2017-05-20','00:00:00','2 h 05',33.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(43,'1',6,'',26,3,'\"','2017-05-08','06:30:00','2017-05-08','00:00:00','2 h 05',33.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(44,'1',6,'',26,3,'\"','2017-05-23','06:30:00','2017-05-23','00:00:00','2 h 05',33.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(45,'1',6,'',26,3,'\"','2017-05-14','13:40:00','2017-05-14','00:00:00','2 h 05',33.04,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(46,'1',6,'',27,3,'\"','2017-05-28','09:10:00','2017-05-28','00:00:00','2 h 00',34.67,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(47,'1',5,'',25,2,'\"','2017-05-31','15:50:00','2017-05-31','00:00:00','2 h 15',36.19,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(48,'1',5,'',27,2,'\"','2017-05-29','14:45:00','2017-05-29','00:00:00','2 h 10',36.19,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(49,'1',5,'',27,2,'\"','2017-05-15','14:45:00','2017-05-15','00:00:00','2 h 10',36.19,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(50,'1',6,'',26,3,'\"','2017-05-27','18:35:00','2017-05-27','00:00:00','2 h 05',36.71,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(51,'1',6,'',26,3,'\"','2017-05-28','13:40:00','2017-05-28','00:00:00','2 h 05',36.71,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(52,'1',6,'',27,3,'\"','2017-05-01','09:10:00','2017-05-01','00:00:00','2 h 00',37.63,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(53,'1',6,'',27,3,'\"','2017-05-23','09:10:00','2017-05-23','00:00:00','2 h 00',37.63,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(54,'1',6,'',27,3,'\"','2017-05-03','09:10:00','2017-05-03','00:00:00','2 h 00',37.63,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(55,'1',6,'',27,3,'\"','2017-05-06','09:10:00','2017-05-06','00:00:00','2 h 00',37.63,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(56,'1',6,'',27,3,'\"','2017-05-21','09:10:00','2017-05-21','00:00:00','2 h 00',37.63,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(57,'1',1,'',27,2,'\"','2017-05-22','18:05:00','2017-05-22','00:00:00','2 h 15',40.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(58,'1',1,'',27,2,'\"','2017-05-09','18:05:00','2017-05-09','00:00:00','2 h 05',40.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(59,'1',1,'',27,2,'\"','2017-05-16','18:05:00','2017-05-16','00:00:00','2 h 05',40.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(60,'1',5,'',25,2,'\"','2017-05-02','15:50:00','2017-05-02','00:00:00','2 h 15',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(61,'1',5,'',25,2,'\"','2017-05-04','15:50:00','2017-05-04','00:00:00','2 h 15',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(62,'1',5,'',25,2,'\"','2017-05-09','15:50:00','2017-05-09','00:00:00','2 h 15',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(63,'1',5,'',25,2,'\"','2017-05-13','15:50:00','2017-05-13','00:00:00','2 h 15',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(64,'1',5,'',25,2,'\"','2017-05-14','15:50:00','2017-05-14','00:00:00','2 h 15',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(65,'1',5,'',25,2,'\"','2017-05-01','15:50:00','2017-05-01','00:00:00','2 h 15',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(66,'1',5,'',28,2,'\"','2017-05-17','10:45:00','2017-05-17','00:00:00','2 h 10',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(67,'1',5,'',1,2,'\"','2017-05-06','21:50:00','2017-05-07','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(68,'1',5,'',27,2,'\"','2017-05-22','14:45:00','2017-05-22','00:00:00','2 h 10',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(69,'1',5,'',1,2,'\"','2017-05-16','07:20:00','2017-05-16','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(70,'1',5,'',1,2,'\"','2017-05-09','18:40:00','2017-05-09','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(71,'1',5,'',1,2,'\"','2017-05-30','15:10:00','2017-05-30','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(72,'1',5,'',1,2,'\"','2017-05-30','21:50:00','2017-05-31','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(73,'1',5,'',1,2,'\"','2017-05-09','07:20:00','2017-05-09','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(74,'1',5,'',1,2,'\"','2017-05-07','07:20:00','2017-05-07','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(75,'1',5,'',1,2,'\"','2017-05-30','18:40:00','2017-05-30','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(76,'1',5,'',1,2,'\"','2017-05-03','18:40:00','2017-05-03','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(77,'1',5,'',1,2,'\"','2017-05-03','07:20:00','2017-05-03','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(78,'1',5,'',25,2,'\"','2017-05-27','15:50:00','2017-05-27','00:00:00','2 h 15',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(79,'1',5,'',1,2,'\"','2017-05-03','21:50:00','2017-05-04','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(80,'1',5,'',1,2,'\"','2017-05-16','18:40:00','2017-05-16','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(81,'1',5,'',1,2,'\"','2017-05-31','07:20:00','2017-05-31','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(82,'1',6,'',27,3,'\"','2017-05-27','09:10:00','2017-05-27','00:00:00','2 h 00',41.81,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(83,'1',1,'',27,2,'\"','2017-05-15','18:05:00','2017-05-15','00:00:00','2 h 15',43.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(84,'1',1,'',27,2,'\"','2017-05-08','18:05:00','2017-05-08','00:00:00','2 h 15',43.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(85,'1',1,'',27,2,'\"','2017-05-29','18:05:00','2017-05-29','00:00:00','2 h 15',43.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(86,'1',1,'',27,2,'\"','2017-05-30','18:05:00','2017-05-30','00:00:00','2 h 05',43.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(87,'1',1,'',27,2,'\"','2017-05-17','18:55:00','2017-05-17','00:00:00','2 h 05',43.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(88,'1',1,'',27,2,'\"','2017-05-03','18:55:00','2017-05-03','00:00:00','2 h 05',43.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(89,'1',1,'',28,2,'\"','2017-05-30','07:00:00','2017-05-30','00:00:00','2 h 00',43.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(90,'1',6,'',26,3,'\"','2017-05-27','06:30:00','2017-05-27','00:00:00','2 h 05',43.85,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(91,'1',1,'',1,2,'\"','2017-05-09','18:50:00','2017-05-09','00:00:00','2 h 10',45.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(92,'1',1,'',27,2,'\"','2017-05-16','12:45:00','2017-05-16','00:00:00','2 h 05',45.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(93,'1',1,'',28,3,'\"','2017-05-03','07:30:00','2017-05-03','00:00:00','1 h 50',45.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(94,'1',1,'',28,3,'\"','2017-05-09','18:35:00','2017-05-09','00:00:00','1 h 50',45.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(95,'1',1,'',28,2,'\"','2017-05-31','07:05:00','2017-05-31','00:00:00','2 h 00',48.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(96,'1',1,'',28,2,'\"','2017-05-31','12:50:00','2017-05-31','00:00:00','2 h 00',48.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(97,'1',1,'',28,2,'\"','2017-05-10','07:05:00','2017-05-10','00:00:00','2 h 00',48.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(98,'1',1,'',1,2,'\"','2017-05-30','18:50:00','2017-05-30','00:00:00','2 h 10',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(99,'1',1,'',1,2,'\"','2017-05-03','06:00:00','2017-05-03','00:00:00','2 h 10',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(100,'1',1,'',1,3,'\"','2017-05-04','06:20:00','2017-05-04','00:00:00','2 h 00',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(101,'1',1,'',1,3,'\"','2017-05-07','19:45:00','2017-05-07','00:00:00','2 h 00',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(102,'1',1,'',28,3,'\"','2017-05-22','07:30:00','2017-05-22','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(103,'1',1,'',28,3,'\"','2017-05-07','06:55:00','2017-05-07','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(104,'1',1,'',28,3,'\"','2017-05-05','18:40:00','2017-05-05','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(105,'1',1,'',28,3,'\"','2017-05-06','18:20:00','2017-05-06','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(106,'1',1,'',28,3,'\"','2017-05-30','18:35:00','2017-05-30','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(107,'1',1,'',28,3,'\"','2017-05-16','18:35:00','2017-05-16','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(108,'1',1,'',28,3,'\"','2017-05-04','13:20:00','2017-05-04','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(109,'1',1,'',28,3,'\"','2017-05-14','06:55:00','2017-05-14','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(110,'1',1,'',28,3,'\"','2017-05-15','07:30:00','2017-05-15','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(111,'1',1,'',28,3,'\"','2017-05-17','07:30:00','2017-05-17','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(112,'1',1,'',28,3,'\"','2017-05-10','07:30:00','2017-05-10','00:00:00','1 h 50',49.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(113,'1',5,'',1,2,'\"','2017-05-27','21:50:00','2017-05-28','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(114,'1',5,'',27,2,'\"','2017-05-10','14:45:00','2017-05-10','00:00:00','2 h 10',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(115,'1',5,'',1,2,'\"','2017-05-09','15:10:00','2017-05-09','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(116,'1',5,'',1,2,'\"','2017-05-09','10:10:00','2017-05-09','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(117,'1',5,'',1,2,'\"','2017-05-07','10:10:00','2017-05-07','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(118,'1',5,'',28,2,'\"','2017-05-22','10:45:00','2017-05-22','00:00:00','2 h 10',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(119,'1',5,'',1,2,'\"','2017-05-03','10:10:00','2017-05-03','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(120,'1',5,'',28,2,'\"','2017-05-31','10:45:00','2017-05-31','00:00:00','2 h 10',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(121,'1',5,'',1,2,'\"','2017-05-02','21:50:00','2017-05-03','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(122,'1',5,'',1,2,'\"','2017-05-15','21:50:00','2017-05-16','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(123,'1',5,'',1,2,'\"','2017-05-21','07:20:00','2017-05-21','00:00:00','2 h 20',51.64,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(124,'1',1,'',28,2,'\"','2017-05-07','18:15:00','2017-05-07','00:00:00','2 h 00',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(125,'1',1,'',27,2,'\"','2017-05-02','18:05:00','2017-05-02','00:00:00','2 h 05',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(126,'1',1,'',27,2,'\"','2017-05-03','11:05:00','2017-05-03','00:00:00','2 h 05',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(127,'1',1,'',28,2,'\"','2017-05-17','12:50:00','2017-05-17','00:00:00','2 h 00',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(128,'1',1,'',27,2,'\"','2017-05-14','07:05:00','2017-05-14','00:00:00','2 h 05',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(129,'1',1,'',27,2,'\"','2017-05-28','17:45:00','2017-05-28','00:00:00','2 h 05',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(130,'1',1,'',28,2,'\"','2017-05-17','07:05:00','2017-05-17','00:00:00','2 h 00',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(131,'1',1,'',28,2,'\"','2017-05-03','07:05:00','2017-05-03','00:00:00','2 h 00',52.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(132,'1',6,'',26,3,'\"','2017-05-21','13:40:00','2017-05-21','00:00:00','2 h 05',52.01,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(133,'1',1,'',1,2,'\"','2017-05-16','18:50:00','2017-05-16','00:00:00','2 h 10',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(134,'1',1,'',1,3,'\"','2017-05-16','06:30:00','2017-05-16','00:00:00','2 h 00',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(135,'1',1,'',1,2,'\"','2017-05-03','17:35:00','2017-05-03','00:00:00','2 h 10',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(136,'1',1,'',1,3,'\"','2017-05-05','07:10:00','2017-05-05','00:00:00','2 h 00',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(137,'1',1,'',1,3,'\"','2017-05-06','19:20:00','2017-05-06','00:00:00','2 h 00',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(138,'1',1,'',1,2,'\"','2017-05-07','06:00:00','2017-05-07','00:00:00','2 h 10',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(139,'1',1,'',28,3,'\"','2017-05-20','18:20:00','2017-05-20','00:00:00','1 h 50',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(140,'1',1,'',28,3,'\"','2017-05-21','06:55:00','2017-05-21','00:00:00','1 h 50',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(141,'1',1,'',28,3,'\"','2017-05-28','06:55:00','2017-05-28','00:00:00','1 h 50',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(142,'1',1,'',28,3,'\"','2017-05-29','07:30:00','2017-05-29','00:00:00','1 h 50',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(143,'1',1,'',28,3,'\"','2017-05-02','18:35:00','2017-05-02','00:00:00','1 h 50',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(144,'1',1,'',28,3,'\"','2017-05-31','07:30:00','2017-05-31','00:00:00','1 h 50',54.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(145,'1',5,'',25,2,'\"','2017-05-23','15:50:00','2017-05-23','00:00:00','2 h 15',56.79,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(146,'1',1,'',28,2,'\"','2017-05-22','07:05:00','2017-05-22','00:00:00','2 h 00',57.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(147,'1',1,'',28,2,'\"','2017-05-22','12:50:00','2017-05-22','00:00:00','2 h 00',57.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(148,'1',1,'',27,2,'\"','2017-05-09','12:45:00','2017-05-09','00:00:00','2 h 05',57.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(149,'1',1,'',27,2,'\"','2017-05-30','12:45:00','2017-05-30','00:00:00','2 h 05',57.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(150,'1',1,'',28,2,'\"','2017-05-09','07:00:00','2017-05-09','00:00:00','2 h 00',57.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(151,'1',6,'',27,3,'\"','2017-05-04','09:10:00','2017-05-04','00:00:00','2 h 00',59.15,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(152,'1',5,'',1,2,'\"','2017-05-05','07:20:00','2017-05-05','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(153,'1',5,'',1,2,'\"','2017-05-05','21:50:00','2017-05-06','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(154,'1',5,'',1,2,'\"','2017-05-22','18:40:00','2017-05-22','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(155,'1',5,'',1,2,'\"','2017-05-26','21:50:00','2017-05-27','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(156,'1',5,'',1,2,'\"','2017-05-16','15:10:00','2017-05-16','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(157,'1',5,'',1,2,'\"','2017-05-22','07:20:00','2017-05-22','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(158,'1',5,'',1,2,'\"','2017-05-17','10:10:00','2017-05-17','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(159,'1',5,'',1,2,'\"','2017-05-31','21:50:00','2017-06-01','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(160,'1',5,'',1,2,'\"','2017-05-16','10:10:00','2017-05-16','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(161,'1',5,'',1,2,'\"','2017-05-31','10:10:00','2017-05-31','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(162,'1',5,'',1,2,'\"','2017-05-07','15:10:00','2017-05-07','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(163,'1',5,'',1,2,'\"','2017-05-02','18:40:00','2017-05-02','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(164,'1',5,'',1,2,'\"','2017-05-15','18:40:00','2017-05-15','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(165,'1',5,'',1,2,'\"','2017-05-22','21:50:00','2017-05-23','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(166,'1',5,'',1,2,'\"','2017-05-17','21:50:00','2017-05-18','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(167,'1',5,'',1,2,'\"','2017-05-02','15:10:00','2017-05-02','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(168,'1',5,'',1,2,'\"','2017-05-02','07:20:00','2017-05-02','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(169,'1',5,'',1,2,'\"','2017-05-14','07:20:00','2017-05-14','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(170,'1',5,'',1,2,'\"','2017-05-29','15:10:00','2017-05-29','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(171,'1',5,'',1,2,'\"','2017-05-21','10:10:00','2017-05-21','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(172,'1',5,'',1,2,'\"','2017-05-21','21:50:00','2017-05-22','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(173,'1',5,'',1,2,'\"','2017-05-29','07:20:00','2017-05-29','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(174,'1',5,'',1,2,'\"','2017-05-29','18:40:00','2017-05-29','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(175,'1',5,'',1,2,'\"','2017-05-20','21:50:00','2017-05-21','00:00:00','2 h 20',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(176,'1',5,'',28,2,'\"','2017-05-15','10:45:00','2017-05-15','00:00:00','2 h 10',61.94,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(177,'1',1,'',1,2,'\"','2017-05-16','12:25:00','2017-05-16','00:00:00','2 h 10',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(178,'1',1,'',1,2,'\"','2017-05-17','06:00:00','2017-05-17','00:00:00','2 h 10',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(179,'1',1,'',1,3,'\"','2017-05-02','06:30:00','2017-05-02','00:00:00','2 h 00',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(180,'1',1,'',27,2,'\"','2017-05-02','12:45:00','2017-05-02','00:00:00','2 h 05',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(181,'1',1,'',27,2,'\"','2017-05-31','11:05:00','2017-05-31','00:00:00','2 h 05',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(182,'1',1,'',27,2,'\"','2017-05-31','18:55:00','2017-05-31','00:00:00','2 h 05',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(183,'1',1,'',27,2,'\"','2017-05-21','17:45:00','2017-05-21','00:00:00','2 h 05',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(184,'1',1,'',27,2,'\"','2017-05-10','18:55:00','2017-05-10','00:00:00','2 h 05',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(185,'1',1,'',28,2,'\"','2017-05-29','07:05:00','2017-05-29','00:00:00','2 h 00',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(186,'1',1,'',28,3,'\"','2017-05-13','18:20:00','2017-05-13','00:00:00','1 h 50',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(187,'1',1,'',28,3,'\"','2017-05-01','07:30:00','2017-05-01','00:00:00','1 h 50',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(188,'1',1,'',28,3,'\"','2017-05-08','07:30:00','2017-05-08','00:00:00','1 h 50',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(189,'1',1,'',28,2,'\"','2017-05-02','07:00:00','2017-05-02','00:00:00','2 h 00',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(190,'1',1,'',28,2,'\"','2017-05-03','12:50:00','2017-05-03','00:00:00','2 h 00',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(191,'1',1,'',28,2,'\"','2017-05-10','12:50:00','2017-05-10','00:00:00','2 h 00',62.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(192,'1',6,'',26,3,'\"','2017-05-11','06:30:00','2017-05-11','00:00:00','2 h 05',62.21,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(193,'1',6,'',26,3,'\"','2017-05-26','06:30:00','2017-05-26','00:00:00','2 h 05',62.21,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(194,'1',5,'',25,2,'\"','2017-05-19','15:50:00','2017-05-19','00:00:00','2 h 15',67.08,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(195,'1',5,'',25,2,'\"','2017-05-20','15:50:00','2017-05-20','00:00:00','2 h 15',67.08,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(196,'1',5,'',25,2,'\"','2017-05-07','15:50:00','2017-05-07','00:00:00','2 h 15',67.09,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(197,'1',1,'',27,2,'\"','2017-05-07','07:05:00','2017-05-07','00:00:00','2 h 05',69.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(198,'1',1,'',27,2,'\"','2017-05-07','17:45:00','2017-05-07','00:00:00','2 h 05',69.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(199,'1',1,'',27,2,'\"','2017-05-13','18:05:00','2017-05-13','00:00:00','2 h 05',69.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(200,'1',1,'',28,2,'\"','2017-05-16','07:00:00','2017-05-16','00:00:00','2 h 00',69.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(201,'1',1,'',28,2,'\"','2017-05-26','17:55:00','2017-05-26','00:00:00','2 h 00',69.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(202,'1',1,'',28,2,'\"','2017-05-15','12:50:00','2017-05-15','00:00:00','2 h 00',69.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(203,'1',1,'',28,2,'\"','2017-05-28','18:15:00','2017-05-28','00:00:00','2 h 00',69.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(204,'1',1,'',1,2,'\"','2017-05-29','06:00:00','2017-05-29','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(205,'1',1,'',1,2,'\"','2017-05-29','18:55:00','2017-05-29','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(206,'1',1,'',1,2,'\"','2017-05-02','18:50:00','2017-05-02','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(207,'1',1,'',1,2,'\"','2017-05-31','06:00:00','2017-05-31','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(208,'1',1,'',1,2,'\"','2017-05-31','13:00:00','2017-05-31','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(209,'1',1,'',1,2,'\"','2017-05-03','13:00:00','2017-05-03','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(210,'1',1,'',1,3,'\"','2017-05-18','06:20:00','2017-05-18','00:00:00','2 h 00',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(211,'1',1,'',1,2,'\"','2017-05-04','18:50:00','2017-05-04','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(212,'1',1,'',1,3,'\"','2017-05-21','19:45:00','2017-05-21','00:00:00','2 h 00',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(213,'1',1,'',1,3,'\"','2017-05-09','06:30:00','2017-05-09','00:00:00','2 h 00',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(214,'1',1,'',1,2,'\"','2017-05-22','06:00:00','2017-05-22','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(215,'1',1,'',1,2,'\"','2017-05-22','18:55:00','2017-05-22','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(216,'1',1,'',1,2,'\"','2017-05-07','12:25:00','2017-05-07','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(217,'1',1,'',1,2,'\"','2017-05-10','06:00:00','2017-05-10','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(218,'1',1,'',1,2,'\"','2017-05-14','06:00:00','2017-05-14','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(219,'1',6,'',27,3,'\"','2017-05-08','09:10:00','2017-05-08','00:00:00','2 h 00',71.39,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(220,'1',6,'',27,3,'\"','2017-05-20','09:10:00','2017-05-20','00:00:00','2 h 00',71.39,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(221,'1',6,'',27,3,'\"','2017-05-15','09:10:00','2017-05-15','00:00:00','2 h 00',71.39,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(222,'1',6,'',27,3,'\"','2017-05-18','09:10:00','2017-05-18','00:00:00','2 h 00',71.39,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(223,'1',5,'',1,2,'\"','2017-05-05','15:10:00','2017-05-05','00:00:00','2 h 20',72.23,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(224,'1',5,'',1,2,'\"','2017-05-05','10:10:00','2017-05-05','00:00:00','2 h 20',72.23,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(225,'1',5,'',1,2,'\"','2017-05-06','18:50:00','2017-05-06','00:00:00','2 h 20',72.23,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(226,'1',5,'',1,2,'\"','2017-05-27','18:50:00','2017-05-27','00:00:00','2 h 20',72.23,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(227,'1',5,'',1,2,'\"','2017-05-23','10:10:00','2017-05-23','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(228,'1',5,'',1,2,'\"','2017-05-02','10:10:00','2017-05-02','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(229,'1',5,'',1,2,'\"','2017-05-17','15:10:00','2017-05-17','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(230,'1',5,'',1,2,'\"','2017-05-22','15:10:00','2017-05-22','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(231,'1',5,'',1,2,'\"','2017-05-23','07:20:00','2017-05-23','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(232,'1',5,'',1,2,'\"','2017-05-22','10:10:00','2017-05-22','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(233,'1',5,'',1,2,'\"','2017-05-30','10:10:00','2017-05-30','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(234,'1',5,'',1,2,'\"','2017-05-30','07:20:00','2017-05-30','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(235,'1',5,'',1,2,'\"','2017-05-26','18:40:00','2017-05-26','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(236,'1',5,'',1,2,'\"','2017-05-14','21:50:00','2017-05-15','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(237,'1',5,'',27,2,'\"','2017-05-05','14:30:00','2017-05-05','00:00:00','2 h 10',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(238,'1',5,'',1,2,'\"','2017-05-08','07:20:00','2017-05-08','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(239,'1',5,'',1,2,'\"','2017-05-08','10:10:00','2017-05-08','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(240,'1',5,'',1,2,'\"','2017-05-15','15:10:00','2017-05-15','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(241,'1',5,'',1,2,'\"','2017-05-14','10:10:00','2017-05-14','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(242,'1',5,'',1,2,'\"','2017-05-01','07:20:00','2017-05-01','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(243,'1',5,'',1,2,'\"','2017-05-07','21:50:00','2017-05-08','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(244,'1',5,'',1,2,'\"','2017-05-20','18:50:00','2017-05-20','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(245,'1',6,'',26,3,'\"','2017-05-20','06:30:00','2017-05-20','00:00:00','2 h 05',74.45,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(246,'1',6,'',26,3,'\"','2017-05-24','06:30:00','2017-05-24','00:00:00','2 h 05',74.45,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(247,'1',6,'',26,3,'\"','2017-05-13','06:30:00','2017-05-13','00:00:00','2 h 05',74.45,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(248,'1',1,'',27,2,'\"','2017-05-04','13:30:00','2017-05-04','00:00:00','2 h 05',76.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(249,'1',1,'',28,2,'\"','2017-05-21','18:15:00','2017-05-21','00:00:00','2 h 00',76.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(250,'1',1,'',27,2,'\"','2017-05-28','07:05:00','2017-05-28','00:00:00','2 h 05',76.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(251,'1',1,'',28,2,'\"','2017-05-29','12:50:00','2017-05-29','00:00:00','2 h 00',76.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(252,'1',1,'',28,2,'\"','2017-05-23','07:00:00','2017-05-23','00:00:00','2 h 00',76.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(253,'1',5,'',25,2,'\"','2017-05-05','15:50:00','2017-05-05','00:00:00','2 h 15',77.39,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(254,'1',1,'',1,2,'\"','2017-05-15','18:55:00','2017-05-15','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(255,'1',1,'',1,2,'\"','2017-05-16','06:00:00','2017-05-16','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(256,'1',1,'',1,2,'\"','2017-05-17','13:00:00','2017-05-17','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(257,'1',1,'',1,2,'\"','2017-05-30','12:25:00','2017-05-30','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(258,'1',1,'',1,2,'\"','2017-05-02','06:00:00','2017-05-02','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(259,'1',1,'',1,2,'\"','2017-05-04','06:00:00','2017-05-04','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(260,'1',1,'',1,2,'\"','2017-05-21','06:00:00','2017-05-21','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(261,'1',1,'',1,2,'\"','2017-05-23','06:00:00','2017-05-23','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(262,'1',1,'',1,2,'\"','2017-05-08','18:55:00','2017-05-08','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(263,'1',1,'',1,2,'\"','2017-05-09','06:00:00','2017-05-09','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(264,'1',1,'',1,2,'\"','2017-05-26','18:50:00','2017-05-26','00:00:00','2 h 10',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(265,'1',1,'',28,3,'\"','2017-05-23','18:35:00','2017-05-23','00:00:00','1 h 50',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(266,'1',1,'',28,3,'\"','2017-05-27','18:20:00','2017-05-27','00:00:00','1 h 50',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(267,'1',1,'',28,3,'\"','2017-05-26','18:40:00','2017-05-26','00:00:00','1 h 50',80.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(268,'1',5,'',28,2,'\"','2017-05-05','10:45:00','2017-05-05','00:00:00','2 h 10',82.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(269,'1',5,'',1,2,'\"','2017-05-05','18:40:00','2017-05-05','00:00:00','2 h 20',82.53,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(270,'1',5,'',1,2,'\"','2017-05-23','18:40:00','2017-05-23','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(271,'1',5,'',1,2,'\"','2017-05-26','15:10:00','2017-05-26','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(272,'1',5,'',1,2,'\"','2017-05-31','18:40:00','2017-05-31','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(273,'1',5,'',1,2,'\"','2017-05-23','15:10:00','2017-05-23','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(274,'1',5,'',1,2,'\"','2017-05-31','15:10:00','2017-05-31','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(275,'1',5,'',1,2,'\"','2017-05-10','15:10:00','2017-05-10','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(276,'1',5,'',1,2,'\"','2017-05-21','18:40:00','2017-05-21','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(277,'1',5,'',1,2,'\"','2017-05-07','18:40:00','2017-05-07','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(278,'1',5,'',1,2,'\"','2017-05-01','21:50:00','2017-05-02','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(279,'1',5,'',28,2,'\"','2017-05-26','10:45:00','2017-05-26','00:00:00','2 h 10',82.54,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(280,'1',6,'',27,3,'\"','2017-05-24','09:10:00','2017-05-24','00:00:00','2 h 00',85.67,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(281,'1',6,'',27,3,'\"','2017-05-11','09:10:00','2017-05-11','00:00:00','2 h 00',85.67,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(282,'1',1,'',27,2,'\"','2017-05-15','11:00:00','2017-05-15','00:00:00','2 h 05',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(283,'1',1,'',27,2,'\"','2017-05-18','13:30:00','2017-05-18','00:00:00','2 h 05',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(284,'1',1,'',27,2,'\"','2017-05-01','11:00:00','2017-05-01','00:00:00','2 h 05',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(285,'1',1,'',27,2,'\"','2017-05-01','18:05:00','2017-05-01','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(286,'1',1,'',27,2,'\"','2017-05-20','18:05:00','2017-05-20','00:00:00','2 h 05',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(287,'1',1,'',27,2,'\"','2017-05-14','17:45:00','2017-05-14','00:00:00','2 h 05',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(288,'1',1,'',28,2,'\"','2017-05-28','12:00:00','2017-05-28','00:00:00','2 h 00',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(289,'1',1,'',28,2,'\"','2017-05-14','12:00:00','2017-05-14','00:00:00','2 h 00',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(290,'1',1,'',28,2,'\"','2017-05-21','12:00:00','2017-05-21','00:00:00','2 h 00',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(291,'1',1,'',28,2,'\"','2017-05-14','18:15:00','2017-05-14','00:00:00','2 h 00',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(292,'1',1,'',28,2,'\"','2017-05-01','07:05:00','2017-05-01','00:00:00','2 h 00',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(293,'1',1,'',28,2,'\"','2017-05-08','12:50:00','2017-05-08','00:00:00','2 h 00',86.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(294,'1',6,'',26,3,'\"','2017-05-19','06:30:00','2017-05-19','00:00:00','2 h 05',89.75,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(295,'1',6,'',26,3,'\"','2017-05-12','06:30:00','2017-05-12','00:00:00','2 h 05',89.75,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(296,'1',1,'',1,2,'\"','2017-05-15','06:00:00','2017-05-15','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(297,'1',1,'',1,3,'\"','2017-05-20','19:20:00','2017-05-20','00:00:00','2 h 00',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(298,'1',1,'',1,2,'\"','2017-05-21','12:25:00','2017-05-21','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(299,'1',1,'',1,2,'\"','2017-05-05','18:50:00','2017-05-05','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(300,'1',1,'',1,2,'\"','2017-05-23','12:25:00','2017-05-23','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(301,'1',1,'',1,2,'\"','2017-05-07','18:50:00','2017-05-07','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(302,'1',1,'',1,3,'\"','2017-05-13','19:20:00','2017-05-13','00:00:00','2 h 00',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(303,'1',1,'',1,2,'\"','2017-05-10','13:00:00','2017-05-10','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(304,'1',1,'',1,2,'\"','2017-05-27','06:00:00','2017-05-27','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(305,'1',1,'',1,2,'\"','2017-05-28','12:25:00','2017-05-28','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(306,'1',1,'',1,2,'\"','2017-05-14','12:25:00','2017-05-14','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(307,'1',1,'',28,3,'\"','2017-05-18','13:20:00','2017-05-18','00:00:00','1 h 50',90.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(308,'1',5,'',1,2,'\"','2017-05-06','10:10:00','2017-05-06','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(309,'1',5,'',1,2,'\"','2017-05-15','07:20:00','2017-05-15','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(310,'1',5,'',1,2,'\"','2017-05-21','15:10:00','2017-05-21','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(311,'1',5,'',1,2,'\"','2017-05-14','15:10:00','2017-05-14','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(312,'1',5,'',1,2,'\"','2017-05-29','10:10:00','2017-05-29','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(313,'1',5,'',1,2,'\"','2017-05-10','18:40:00','2017-05-10','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(314,'1',5,'',1,2,'\"','2017-05-01','10:10:00','2017-05-01','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(315,'1',5,'',1,2,'\"','2017-05-28','07:20:00','2017-05-28','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(316,'1',5,'',1,2,'\"','2017-05-01','15:10:00','2017-05-01','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(317,'1',5,'',28,2,'\"','2017-05-24','10:45:00','2017-05-24','00:00:00','2 h 10',92.84,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(318,'1',1,'',27,2,'\"','2017-05-22','11:00:00','2017-05-22','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(319,'1',1,'',28,2,'\"','2017-05-05','17:55:00','2017-05-05','00:00:00','2 h 00',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(320,'1',1,'',27,2,'\"','2017-05-06','18:05:00','2017-05-06','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(321,'1',1,'',27,2,'\"','2017-05-08','11:00:00','2017-05-08','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(322,'1',1,'',27,2,'\"','2017-05-29','11:00:00','2017-05-29','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(323,'1',1,'',27,2,'\"','2017-05-17','11:05:00','2017-05-17','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(324,'1',1,'',27,2,'\"','2017-05-21','07:05:00','2017-05-21','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(325,'1',1,'',27,2,'\"','2017-05-10','11:05:00','2017-05-10','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(326,'1',1,'',27,2,'\"','2017-05-23','12:45:00','2017-05-23','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(327,'1',1,'',27,2,'\"','2017-05-23','18:05:00','2017-05-23','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(328,'1',1,'',27,2,'\"','2017-05-27','18:05:00','2017-05-27','00:00:00','2 h 05',95.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(329,'1',5,'',25,2,'\"','2017-05-24','15:50:00','2017-05-24','00:00:00','2 h 15',97.99,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(330,'1',1,'',1,2,'\"','2017-05-01','06:00:00','2017-05-01','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(331,'1',1,'',1,2,'\"','2017-05-02','12:25:00','2017-05-02','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(332,'1',1,'',1,3,'\"','2017-05-30','06:30:00','2017-05-30','00:00:00','2 h 00',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(333,'1',1,'',1,2,'\"','2017-05-21','18:50:00','2017-05-21','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(334,'1',1,'',1,2,'\"','2017-05-05','06:00:00','2017-05-05','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(335,'1',1,'',1,2,'\"','2017-05-05','12:25:00','2017-05-05','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(336,'1',1,'',1,3,'\"','2017-05-23','06:30:00','2017-05-23','00:00:00','2 h 00',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(337,'1',1,'',1,2,'\"','2017-05-06','06:00:00','2017-05-06','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(338,'1',1,'',1,2,'\"','2017-05-06','12:25:00','2017-05-06','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(339,'1',1,'',1,2,'\"','2017-05-08','06:00:00','2017-05-08','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(340,'1',1,'',1,2,'\"','2017-05-09','12:25:00','2017-05-09','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(341,'1',1,'',1,2,'\"','2017-05-26','12:25:00','2017-05-26','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(342,'1',1,'',1,2,'\"','2017-05-27','12:25:00','2017-05-27','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(343,'1',1,'',1,2,'\"','2017-05-14','18:50:00','2017-05-14','00:00:00','2 h 10',103.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(344,'1',6,'',27,3,'\"','2017-05-25','09:10:00','2017-05-25','00:00:00','2 h 00',103.01,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(345,'1',5,'',1,2,'\"','2017-05-27','10:10:00','2017-05-27','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(346,'1',5,'',1,2,'\"','2017-05-06','07:20:00','2017-05-06','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(347,'1',5,'',1,2,'\"','2017-05-14','18:40:00','2017-05-14','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(348,'1',5,'',1,2,'\"','2017-05-15','10:10:00','2017-05-15','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(349,'1',5,'',1,2,'\"','2017-05-26','10:10:00','2017-05-26','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(350,'1',5,'',1,2,'\"','2017-05-28','21:50:00','2017-05-29','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(351,'1',5,'',1,2,'\"','2017-05-18','18:40:00','2017-05-18','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(352,'1',5,'',1,2,'\"','2017-05-01','18:40:00','2017-05-01','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(353,'1',5,'',1,2,'\"','2017-05-19','18:40:00','2017-05-19','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(354,'1',5,'',1,2,'\"','2017-05-19','15:10:00','2017-05-19','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(355,'1',5,'',28,2,'\"','2017-05-19','10:45:00','2017-05-19','00:00:00','2 h 10',103.14,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(356,'1',5,'',25,2,'\"','2017-05-12','15:50:00','2017-05-12','00:00:00','2 h 15',108.29,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(357,'1',1,'',28,2,'\"','2017-05-05','07:05:00','2017-05-05','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(358,'1',1,'',27,2,'\"','2017-05-05','11:00:00','2017-05-05','00:00:00','2 h 05',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(359,'1',1,'',27,2,'\"','2017-05-05','13:40:00','2017-05-05','00:00:00','2 h 05',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(360,'1',1,'',27,2,'\"','2017-05-26','13:40:00','2017-05-26','00:00:00','2 h 05',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(361,'1',1,'',28,2,'\"','2017-05-18','17:30:00','2017-05-18','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(362,'1',1,'',28,2,'\"','2017-05-26','07:05:00','2017-05-26','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(363,'1',1,'',28,2,'\"','2017-05-24','12:50:00','2017-05-24','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(364,'1',1,'',28,2,'\"','2017-05-24','07:05:00','2017-05-24','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(365,'1',1,'',28,2,'\"','2017-05-19','17:55:00','2017-05-19','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(366,'1',1,'',28,2,'\"','2017-05-01','12:50:00','2017-05-01','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(367,'1',1,'',28,2,'\"','2017-05-08','07:05:00','2017-05-08','00:00:00','2 h 00',110.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(368,'1',1,'',1,2,'\"','2017-05-18','12:25:00','2017-05-18','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(369,'1',1,'',1,2,'\"','2017-05-18','18:50:00','2017-05-18','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(370,'1',1,'',1,2,'\"','2017-05-19','06:00:00','2017-05-19','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(371,'1',1,'',1,2,'\"','2017-05-19','18:50:00','2017-05-19','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(372,'1',1,'',1,3,'\"','2017-05-19','07:10:00','2017-05-19','00:00:00','2 h 00',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(373,'1',1,'',1,2,'\"','2017-05-04','12:25:00','2017-05-04','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(374,'1',1,'',1,3,'\"','2017-05-11','06:20:00','2017-05-11','00:00:00','2 h 00',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(375,'1',1,'',1,2,'\"','2017-05-23','18:50:00','2017-05-23','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(376,'1',1,'',1,3,'\"','2017-05-27','19:20:00','2017-05-27','00:00:00','2 h 00',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(377,'1',1,'',1,2,'\"','2017-05-28','06:00:00','2017-05-28','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(378,'1',1,'',1,2,'\"','2017-05-28','18:50:00','2017-05-28','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(379,'1',1,'',28,3,'\"','2017-05-24','07:30:00','2017-05-24','00:00:00','1 h 50',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(380,'1',1,'',28,3,'\"','2017-05-12','18:40:00','2017-05-12','00:00:00','1 h 50',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(381,'1',1,'',28,3,'\"','2017-05-11','13:20:00','2017-05-11','00:00:00','1 h 50',115.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(382,'1',6,'',27,3,'\"','2017-05-13','09:10:00','2017-05-13','00:00:00','2 h 00',123.41,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(383,'1',5,'',1,2,'\"','2017-05-28','18:40:00','2017-05-28','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(384,'1',5,'',1,2,'\"','2017-05-18','07:20:00','2017-05-18','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(385,'1',5,'',1,2,'\"','2017-05-18','10:10:00','2017-05-18','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(386,'1',5,'',1,2,'\"','2017-05-26','07:20:00','2017-05-26','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(387,'1',5,'',1,2,'\"','2017-05-19','10:10:00','2017-05-19','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(388,'1',5,'',1,2,'\"','2017-05-20','07:20:00','2017-05-20','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(389,'1',5,'',1,2,'\"','2017-05-25','18:40:00','2017-05-25','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(390,'1',5,'',1,2,'\"','2017-05-11','07:20:00','2017-05-11','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(391,'1',5,'',1,2,'\"','2017-05-11','10:10:00','2017-05-11','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(392,'1',5,'',1,2,'\"','2017-05-12','21:50:00','2017-05-13','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(393,'1',1,'',27,2,'\"','2017-05-19','11:00:00','2017-05-19','00:00:00','2 h 05',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(394,'1',1,'',28,2,'\"','2017-05-07','12:00:00','2017-05-07','00:00:00','2 h 00',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(395,'1',1,'',28,2,'\"','2017-05-04','17:30:00','2017-05-04','00:00:00','2 h 00',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(396,'1',1,'',27,2,'\"','2017-05-19','13:40:00','2017-05-19','00:00:00','2 h 05',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(397,'1',1,'',27,2,'\"','2017-05-13','11:05:00','2017-05-13','00:00:00','2 h 05',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(398,'1',1,'',27,2,'\"','2017-05-24','11:05:00','2017-05-24','00:00:00','2 h 05',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(399,'1',1,'',27,2,'\"','2017-05-26','11:00:00','2017-05-26','00:00:00','2 h 05',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(400,'1',1,'',28,2,'\"','2017-05-15','07:05:00','2017-05-15','00:00:00','2 h 00',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(401,'1',1,'',28,2,'\"','2017-05-19','07:05:00','2017-05-19','00:00:00','2 h 00',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(402,'1',1,'',28,2,'\"','2017-05-27','07:05:00','2017-05-27','00:00:00','2 h 00',127.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(403,'1',6,'',26,3,'\"','2017-05-25','06:30:00','2017-05-25','00:00:00','2 h 05',128.51,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(404,'1',5,'',25,2,'\"','2017-05-11','15:50:00','2017-05-11','00:00:00','2 h 15',128.89,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(405,'1',1,'',1,2,'\"','2017-05-30','06:00:00','2017-05-30','00:00:00','2 h 10',130.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(406,'1',1,'',1,2,'\"','2017-05-20','06:00:00','2017-05-20','00:00:00','2 h 10',130.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(407,'1',1,'',1,3,'\"','2017-05-26','07:10:00','2017-05-26','00:00:00','2 h 00',130.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(408,'1',1,'',1,3,'\"','2017-05-14','19:45:00','2017-05-14','00:00:00','2 h 00',130.00,'EUR','2017-04-12 20:06:58','2017-04-12 20:06:58'),(409,'1',1,'',1,2,'\"','2017-05-25','18:50:00','2017-05-25','00:00:00','2 h 10',130.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(410,'1',1,'',1,2,'\"','2017-05-26','06:00:00','2017-05-26','00:00:00','2 h 10',130.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(411,'1',1,'',1,2,'\"','2017-05-11','18:50:00','2017-05-11','00:00:00','2 h 10',130.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(412,'1',5,'',1,2,'\"','2017-05-17','18:40:00','2017-05-17','00:00:00','2 h 20',144.34,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(413,'1',5,'',1,2,'\"','2017-05-25','15:10:00','2017-05-25','00:00:00','2 h 20',144.34,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(414,'1',5,'',1,2,'\"','2017-05-11','15:10:00','2017-05-11','00:00:00','2 h 20',144.34,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(415,'1',5,'',1,2,'\"','2017-05-24','10:10:00','2017-05-24','00:00:00','2 h 20',144.34,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(416,'1',5,'',1,2,'\"','2017-05-24','21:50:00','2017-05-25','00:00:00','2 h 20',144.34,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(417,'1',5,'',1,2,'\"','2017-05-19','07:20:00','2017-05-19','00:00:00','2 h 20',144.34,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(418,'1',1,'',1,2,'\"','2017-05-18','06:00:00','2017-05-18','00:00:00','2 h 10',145.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(419,'1',1,'',1,2,'\"','2017-05-19','12:25:00','2017-05-19','00:00:00','2 h 10',145.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(420,'1',1,'',1,2,'\"','2017-05-24','06:00:00','2017-05-24','00:00:00','2 h 10',145.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(421,'1',1,'',1,2,'\"','2017-05-24','13:00:00','2017-05-24','00:00:00','2 h 10',145.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(422,'1',1,'',1,2,'\"','2017-05-11','06:00:00','2017-05-11','00:00:00','2 h 10',145.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(423,'1',1,'',1,2,'\"','2017-05-11','12:25:00','2017-05-11','00:00:00','2 h 10',145.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(424,'1',1,'',28,3,'\"','2017-05-19','18:40:00','2017-05-19','00:00:00','1 h 50',145.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(425,'1',1,'',27,2,'\"','2017-05-06','11:05:00','2017-05-06','00:00:00','2 h 05',146.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(426,'1',1,'',28,2,'\"','2017-05-25','17:30:00','2017-05-25','00:00:00','2 h 00',146.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(427,'1',1,'',28,2,'\"','2017-05-11','17:30:00','2017-05-11','00:00:00','2 h 00',146.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(428,'1',1,'',28,2,'\"','2017-05-06','07:05:00','2017-05-06','00:00:00','2 h 00',146.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(429,'1',1,'',28,3,'\"','2017-05-25','13:20:00','2017-05-25','00:00:00','1 h 50',162.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(430,'1',1,'',1,3,'\"','2017-05-28','19:45:00','2017-05-28','00:00:00','2 h 00',163.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(431,'1',1,'',1,2,'\"','2017-05-13','12:25:00','2017-05-13','00:00:00','2 h 10',163.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(432,'1',5,'',1,2,'\"','2017-05-27','07:20:00','2017-05-27','00:00:00','2 h 20',164.94,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(433,'1',5,'',1,2,'\"','2017-05-24','07:20:00','2017-05-24','00:00:00','2 h 20',164.94,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(434,'1',5,'',1,2,'\"','2017-05-24','18:40:00','2017-05-24','00:00:00','2 h 20',164.94,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(435,'1',5,'',1,2,'\"','2017-05-12','18:40:00','2017-05-12','00:00:00','2 h 20',164.94,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(436,'1',5,'',1,2,'\"','2017-05-12','15:10:00','2017-05-12','00:00:00','2 h 20',164.94,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(437,'1',5,'',1,2,'\"','2017-05-20','10:10:00','2017-05-20','00:00:00','2 h 20',164.94,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(438,'1',1,'',28,2,'\"','2017-05-12','17:55:00','2017-05-12','00:00:00','2 h 00',167.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(439,'1',1,'',27,2,'\"','2017-05-24','18:55:00','2017-05-24','00:00:00','2 h 05',167.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(440,'1',1,'',27,2,'\"','2017-05-25','13:30:00','2017-05-25','00:00:00','2 h 05',167.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(441,'1',1,'',28,2,'\"','2017-05-13','07:05:00','2017-05-13','00:00:00','2 h 00',167.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(442,'1',1,'',28,2,'\"','2017-05-20','07:05:00','2017-05-20','00:00:00','2 h 00',167.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(443,'1',5,'',27,2,'\"','2017-05-12','14:30:00','2017-05-12','00:00:00','2 h 10',175.24,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(444,'1',1,'',1,3,'\"','2017-05-12','07:10:00','2017-05-12','00:00:00','2 h 00',180.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(445,'1',1,'',1,2,'\"','2017-05-13','06:00:00','2017-05-13','00:00:00','2 h 10',180.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(446,'1',5,'',1,2,'\"','2017-05-24','15:10:00','2017-05-24','00:00:00','2 h 20',195.84,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(447,'1',5,'',1,2,'\"','2017-05-12','10:10:00','2017-05-12','00:00:00','2 h 20',195.84,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(448,'1',1,'',27,2,'\"','2017-05-11','13:30:00','2017-05-11','00:00:00','2 h 05',196.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(449,'1',1,'',27,2,'\"','2017-05-12','13:40:00','2017-05-12','00:00:00','2 h 05',196.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(450,'1',1,'',27,2,'\"','2017-05-27','11:05:00','2017-05-27','00:00:00','2 h 05',196.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(451,'1',1,'',1,2,'\"','2017-05-01','18:55:00','2017-05-01','00:00:00','2 h 10',200.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(452,'1',1,'',1,3,'\"','2017-05-25','06:20:00','2017-05-25','00:00:00','2 h 00',200.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(453,'1',1,'',1,2,'\"','2017-05-12','12:25:00','2017-05-12','00:00:00','2 h 10',200.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(454,'1',1,'',1,2,'\"','2017-05-12','18:50:00','2017-05-12','00:00:00','2 h 10',200.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(455,'1',5,'',25,2,'\"','2017-05-10','15:50:00','2017-05-10','00:00:00','2 h 15',200.99,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(456,'1',1,'',1,2,'\"','2017-05-25','12:25:00','2017-05-25','00:00:00','2 h 10',220.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(457,'1',1,'',1,2,'\"','2017-05-12','06:00:00','2017-05-12','00:00:00','2 h 10',220.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(458,'1',5,'',1,2,'\"','2017-05-25','10:10:00','2017-05-25','00:00:00','2 h 20',226.74,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(459,'1',5,'',1,2,'\"','2017-05-12','07:20:00','2017-05-12','00:00:00','2 h 20',226.74,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(460,'1',5,'',1,2,'\"','2017-05-25','07:20:00','2017-05-25','00:00:00','2 h 20',226.74,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(461,'1',1,'',1,2,'\"','2017-05-20','12:25:00','2017-05-20','00:00:00','2 h 10',242.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(462,'1',5,'',28,2,'\"','2017-05-12','10:45:00','2017-05-12','00:00:00','2 h 10',257.64,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(463,'1',1,'',1,2,'\"','2017-05-25','06:00:00','2017-05-25','00:00:00','2 h 10',267.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(464,'1',1,'',28,2,'\"','2017-05-12','07:05:00','2017-05-12','00:00:00','2 h 00',279.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(465,'1',1,'',27,2,'\"','2017-05-20','11:05:00','2017-05-20','00:00:00','2 h 05',279.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(466,'1',1,'',27,2,'\"','2017-05-12','11:00:00','2017-05-12','00:00:00','2 h 05',279.00,'EUR','2017-04-12 20:06:59','2017-04-12 20:06:59'),(467,'2',6,'',3,26,'\"','2017-05-18','09:00:00','2017-05-18','00:00:00','2 h 10',10.19,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(468,'2',6,'',3,26,'\"','2017-05-20','21:05:00','2017-05-20','00:00:00','2 h 10',10.19,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(469,'2',6,'',3,26,'\"','2017-05-23','09:00:00','2017-05-23','00:00:00','2 h 10',10.19,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(470,'2',6,'',3,26,'\"','2017-05-31','09:00:00','2017-05-31','00:00:00','2 h 10',10.19,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(471,'2',6,'',3,26,'\"','2017-05-25','09:00:00','2017-05-25','00:00:00','2 h 10',10.19,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(472,'2',6,'',3,26,'\"','2017-05-11','09:00:00','2017-05-11','00:00:00','2 h 10',10.19,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(473,'2',6,'',3,27,'\"','2017-05-17','06:35:00','2017-05-17','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(474,'2',6,'',3,27,'\"','2017-05-18','06:35:00','2017-05-18','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(475,'2',6,'',3,27,'\"','2017-05-20','06:35:00','2017-05-20','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(476,'2',6,'',3,27,'\"','2017-05-24','06:35:00','2017-05-24','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(477,'2',6,'',3,27,'\"','2017-05-25','06:35:00','2017-05-25','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(478,'2',6,'',3,27,'\"','2017-05-30','06:35:00','2017-05-30','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(479,'2',6,'',3,27,'\"','2017-05-31','06:35:00','2017-05-31','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(480,'2',6,'',3,27,'\"','2017-05-14','06:35:00','2017-05-14','00:00:00','2 h 10',20.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(481,'2',6,'',3,27,'\"','2017-05-10','06:35:00','2017-05-10','00:00:00','2 h 10',25.69,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(482,'2',5,'',2,25,'\"','2017-05-17','12:50:00','2017-05-17','00:00:00','2 h 20',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(483,'2',5,'',2,25,'\"','2017-05-18','12:50:00','2017-05-18','00:00:00','2 h 20',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(484,'2',5,'',2,25,'\"','2017-05-10','12:50:00','2017-05-10','00:00:00','2 h 20',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(485,'2',5,'',2,25,'\"','2017-05-11','12:50:00','2017-05-11','00:00:00','2 h 20',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(486,'2',5,'',2,25,'\"','2017-05-24','12:50:00','2017-05-24','00:00:00','2 h 20',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(487,'2',5,'',2,25,'\"','2017-05-26','12:50:00','2017-05-26','00:00:00','2 h 20',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(488,'2',5,'',2,28,'\"','2017-05-31','07:55:00','2017-05-31','00:00:00','2 h 15',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(489,'2',5,'',2,28,'\"','2017-05-10','07:55:00','2017-05-10','00:00:00','2 h 15',25.89,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(490,'2',6,'',3,26,'\"','2017-05-17','09:00:00','2017-05-17','00:00:00','2 h 10',27.53,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(491,'2',6,'',3,26,'\"','2017-05-19','09:00:00','2017-05-19','00:00:00','2 h 10',27.53,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(492,'2',6,'',3,26,'\"','2017-05-20','09:00:00','2017-05-20','00:00:00','2 h 10',27.53,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(493,'2',6,'',3,26,'\"','2017-05-24','09:00:00','2017-05-24','00:00:00','2 h 10',27.53,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(494,'2',6,'',3,26,'\"','2017-05-10','09:00:00','2017-05-10','00:00:00','2 h 10',27.53,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(495,'2',6,'',3,26,'\"','2017-05-13','09:00:00','2017-05-13','00:00:00','2 h 10',27.53,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(496,'2',6,'',3,26,'\"','2017-05-14','11:05:00','2017-05-14','00:00:00','2 h 10',27.53,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(497,'2',6,'',3,27,'\"','2017-05-27','06:35:00','2017-05-27','00:00:00','2 h 10',28.55,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(498,'2',6,'',3,26,'\"','2017-05-30','09:00:00','2017-05-30','00:00:00','2 h 10',30.59,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(499,'2',5,'',2,25,'\"','2017-05-19','12:50:00','2017-05-19','00:00:00','2 h 20',31.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(500,'2',5,'',2,25,'\"','2017-05-09','12:50:00','2017-05-09','00:00:00','2 h 20',31.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(501,'2',5,'',2,27,'\"','2017-05-17','11:45:00','2017-05-17','00:00:00','2 h 25',31.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(502,'2',5,'',2,25,'\"','2017-05-23','12:50:00','2017-05-23','00:00:00','2 h 20',31.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(503,'2',5,'',2,25,'\"','2017-05-12','12:50:00','2017-05-12','00:00:00','2 h 20',31.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(504,'2',5,'',2,25,'\"','2017-05-25','12:50:00','2017-05-25','00:00:00','2 h 20',31.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(505,'2',6,'',3,27,'\"','2017-05-22','06:35:00','2017-05-22','00:00:00','2 h 10',31.20,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(506,'2',6,'',3,27,'\"','2017-05-09','06:35:00','2017-05-09','00:00:00','2 h 10',31.20,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(507,'2',6,'',3,26,'\"','2017-05-22','09:00:00','2017-05-22','00:00:00','2 h 10',33.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(508,'2',6,'',3,26,'\"','2017-05-09','09:00:00','2017-05-09','00:00:00','2 h 10',33.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(509,'2',6,'',3,26,'\"','2017-05-12','09:00:00','2017-05-12','00:00:00','2 h 10',33.04,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(510,'2',5,'',2,25,'\"','2017-05-20','12:50:00','2017-05-20','00:00:00','2 h 20',36.19,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(511,'2',6,'',3,26,'\"','2017-05-26','09:00:00','2017-05-26','00:00:00','2 h 10',36.71,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(512,'2',6,'',3,27,'\"','2017-05-16','06:35:00','2017-05-16','00:00:00','2 h 10',37.63,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(513,'2',6,'',3,27,'\"','2017-05-21','06:35:00','2017-05-21','00:00:00','2 h 10',37.63,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(514,'2',6,'',3,27,'\"','2017-05-23','06:35:00','2017-05-23','00:00:00','2 h 10',37.63,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(515,'2',6,'',3,27,'\"','2017-05-11','06:35:00','2017-05-11','00:00:00','2 h 10',37.63,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(516,'2',6,'',3,26,'\"','2017-05-13','21:05:00','2017-05-13','00:00:00','2 h 10',39.46,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(517,'2',1,'',2,28,'\"','2017-05-17','09:50:00','2017-05-17','00:00:00','2 h 15',40.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(518,'2',1,'',2,27,'\"','2017-05-24','13:50:00','2017-05-24','00:00:00','2 h 15',40.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(519,'2',1,'',2,28,'\"','2017-05-24','09:50:00','2017-05-24','00:00:00','2 h 15',40.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(520,'2',5,'',2,1,'\"','2017-05-17','07:00:00','2017-05-17','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(521,'2',5,'',2,1,'\"','2017-05-17','12:00:00','2017-05-17','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(522,'2',5,'',2,1,'\"','2017-05-17','15:30:00','2017-05-17','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(523,'2',5,'',2,1,'\"','2017-05-18','07:00:00','2017-05-18','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(524,'2',5,'',2,1,'\"','2017-05-18','12:00:00','2017-05-18','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(525,'2',5,'',2,1,'\"','2017-05-18','15:30:00','2017-05-18','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(526,'2',5,'',2,1,'\"','2017-05-24','07:00:00','2017-05-24','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(527,'2',5,'',2,1,'\"','2017-05-24','10:30:00','2017-05-24','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(528,'2',5,'',2,1,'\"','2017-05-24','12:00:00','2017-05-24','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(529,'2',5,'',2,1,'\"','2017-05-25','12:00:00','2017-05-25','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(530,'2',5,'',2,1,'\"','2017-05-25','15:30:00','2017-05-25','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(531,'2',5,'',2,1,'\"','2017-05-26','10:25:00','2017-05-26','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(532,'2',5,'',2,25,'\"','2017-05-16','12:50:00','2017-05-16','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(533,'2',5,'',2,25,'\"','2017-05-22','12:50:00','2017-05-22','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(534,'2',5,'',2,27,'\"','2017-05-19','11:20:00','2017-05-19','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(535,'2',5,'',2,25,'\"','2017-05-13','12:50:00','2017-05-13','00:00:00','2 h 20',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(536,'2',5,'',2,27,'\"','2017-05-24','11:45:00','2017-05-24','00:00:00','2 h 25',41.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(537,'2',6,'',3,27,'\"','2017-05-29','06:35:00','2017-05-29','00:00:00','2 h 10',41.81,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(538,'2',1,'',2,27,'\"','2017-05-10','13:50:00','2017-05-10','00:00:00','2 h 15',43.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(539,'2',1,'',2,28,'\"','2017-05-10','09:50:00','2017-05-10','00:00:00','2 h 15',43.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(540,'2',1,'',2,27,'\"','2017-05-23','09:45:00','2017-05-23','00:00:00','2 h 15',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(541,'2',1,'',3,1,'\"','2017-05-18','08:55:00','2017-05-18','00:00:00','2 h 10',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(542,'2',1,'',3,1,'\"','2017-05-25','08:55:00','2017-05-25','00:00:00','2 h 10',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(543,'2',1,'',2,28,'\"','2017-05-24','15:35:00','2017-05-24','00:00:00','2 h 15',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(544,'2',1,'',3,1,'\"','2017-05-26','09:45:00','2017-05-26','00:00:00','2 h 10',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(545,'2',1,'',3,28,'\"','2017-05-18','15:45:00','2017-05-18','00:00:00','1 h 55',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(546,'2',1,'',3,28,'\"','2017-05-31','09:50:00','2017-05-31','00:00:00','1 h 55',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(547,'2',1,'',3,28,'\"','2017-05-24','09:50:00','2017-05-24','00:00:00','1 h 55',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(548,'2',1,'',3,28,'\"','2017-05-10','09:50:00','2017-05-10','00:00:00','1 h 55',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(549,'2',1,'',3,28,'\"','2017-05-11','15:45:00','2017-05-11','00:00:00','1 h 55',45.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(550,'2',1,'',2,27,'\"','2017-05-10','15:55:00','2017-05-10','00:00:00','2 h 15',48.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(551,'2',1,'',2,1,'\"','2017-05-18','15:20:00','2017-05-18','00:00:00','2 h 25',49.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(552,'2',1,'',3,1,'\"','2017-05-19','09:45:00','2017-05-19','00:00:00','2 h 10',49.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(553,'2',1,'',3,1,'\"','2017-05-11','08:55:00','2017-05-11','00:00:00','2 h 10',49.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(554,'2',1,'',3,28,'\"','2017-05-19','21:00:00','2017-05-19','00:00:00','1 h 55',49.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(555,'2',1,'',3,28,'\"','2017-05-20','20:45:00','2017-05-20','00:00:00','1 h 55',49.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(556,'2',1,'',3,28,'\"','2017-05-25','15:45:00','2017-05-25','00:00:00','1 h 55',49.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(557,'2',1,'',3,28,'\"','2017-05-14','09:20:00','2017-05-14','00:00:00','1 h 55',49.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(558,'2',5,'',2,1,'\"','2017-05-17','18:40:00','2017-05-17','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(559,'2',5,'',2,1,'\"','2017-05-18','10:30:00','2017-05-18','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(560,'2',5,'',2,1,'\"','2017-05-18','18:40:00','2017-05-18','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(561,'2',5,'',2,1,'\"','2017-05-19','07:00:00','2017-05-19','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(562,'2',5,'',2,1,'\"','2017-05-20','07:00:00','2017-05-20','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(563,'2',5,'',2,1,'\"','2017-05-25','07:00:00','2017-05-25','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(564,'2',5,'',2,1,'\"','2017-05-25','18:40:00','2017-05-25','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(565,'2',5,'',2,27,'\"','2017-05-26','11:20:00','2017-05-26','00:00:00','2 h 25',51.64,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(566,'2',1,'',2,27,'\"','2017-05-31','13:50:00','2017-05-31','00:00:00','2 h 15',52.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(567,'2',1,'',2,28,'\"','2017-05-17','15:35:00','2017-05-17','00:00:00','2 h 15',52.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(568,'2',1,'',2,28,'\"','2017-05-31','09:50:00','2017-05-31','00:00:00','2 h 15',52.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(569,'2',6,'',3,26,'\"','2017-05-21','11:05:00','2017-05-21','00:00:00','2 h 10',52.01,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(570,'2',1,'',2,1,'\"','2017-05-18','21:45:00','2017-05-19','00:00:00','2 h 25',54.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(571,'2',1,'',2,1,'\"','2017-05-23','21:45:00','2017-05-24','00:00:00','2 h 25',54.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(572,'2',1,'',3,1,'\"','2017-05-12','09:45:00','2017-05-12','00:00:00','2 h 10',54.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(573,'2',1,'',3,28,'\"','2017-05-17','09:50:00','2017-05-17','00:00:00','1 h 55',54.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(574,'2',1,'',3,28,'\"','2017-05-23','21:00:00','2017-05-23','00:00:00','1 h 55',54.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(575,'2',1,'',3,28,'\"','2017-05-12','21:00:00','2017-05-12','00:00:00','1 h 55',54.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(576,'2',1,'',2,27,'\"','2017-05-30','09:45:00','2017-05-30','00:00:00','2 h 15',57.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(577,'2',1,'',2,27,'\"','2017-05-31','15:55:00','2017-05-31','00:00:00','2 h 15',57.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(578,'2',1,'',2,28,'\"','2017-05-20','09:50:00','2017-05-20','00:00:00','2 h 15',57.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(579,'2',1,'',2,27,'\"','2017-05-24','15:55:00','2017-05-24','00:00:00','2 h 15',57.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(580,'2',1,'',2,27,'\"','2017-05-26','13:45:00','2017-05-26','00:00:00','2 h 15',57.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(581,'2',1,'',2,28,'\"','2017-05-26','09:50:00','2017-05-26','00:00:00','2 h 15',57.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(582,'2',6,'',3,27,'\"','2017-05-13','06:35:00','2017-05-13','00:00:00','2 h 10',59.15,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(583,'2',5,'',2,1,'\"','2017-05-17','10:30:00','2017-05-17','00:00:00','2 h 25',61.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(584,'2',5,'',2,1,'\"','2017-05-19','10:25:00','2017-05-19','00:00:00','2 h 25',61.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(585,'2',5,'',2,1,'\"','2017-05-24','15:30:00','2017-05-24','00:00:00','2 h 25',61.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(586,'2',5,'',2,28,'\"','2017-05-03','07:55:00','2017-05-03','00:00:00','2 h 15',61.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(587,'2',5,'',2,28,'\"','2017-05-12','07:55:00','2017-05-12','00:00:00','2 h 15',61.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(588,'2',1,'',2,1,'\"','2017-05-17','08:55:00','2017-05-17','00:00:00','2 h 25',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(589,'2',1,'',2,1,'\"','2017-05-18','08:55:00','2017-05-18','00:00:00','2 h 25',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(590,'2',1,'',2,27,'\"','2017-05-30','20:55:00','2017-05-30','00:00:00','2 h 15',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(591,'2',1,'',2,27,'\"','2017-05-17','13:50:00','2017-05-17','00:00:00','2 h 15',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(592,'2',1,'',2,1,'\"','2017-05-24','08:55:00','2017-05-24','00:00:00','2 h 25',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(593,'2',1,'',2,1,'\"','2017-05-24','21:45:00','2017-05-25','00:00:00','2 h 25',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(594,'2',1,'',2,1,'\"','2017-05-25','21:45:00','2017-05-26','00:00:00','2 h 25',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(595,'2',1,'',3,1,'\"','2017-05-20','21:55:00','2017-05-21','00:00:00','2 h 10',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(596,'2',1,'',2,27,'\"','2017-05-11','16:20:00','2017-05-11','00:00:00','2 h 15',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(597,'2',1,'',2,27,'\"','2017-05-26','16:30:00','2017-05-26','00:00:00','2 h 15',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(598,'2',1,'',3,1,'\"','2017-05-23','09:05:00','2017-05-23','00:00:00','2 h 10',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(599,'2',1,'',2,28,'\"','2017-05-26','20:40:00','2017-05-26','00:00:00','2 h 15',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(600,'2',1,'',3,28,'\"','2017-05-30','21:00:00','2017-05-30','00:00:00','1 h 55',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(601,'2',1,'',3,28,'\"','2017-05-21','09:20:00','2017-05-21','00:00:00','1 h 55',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(602,'2',1,'',3,28,'\"','2017-05-13','20:45:00','2017-05-13','00:00:00','1 h 55',62.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(603,'2',6,'',3,26,'\"','2017-05-27','09:00:00','2017-05-27','00:00:00','2 h 10',62.21,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(604,'2',1,'',2,27,'\"','2017-05-17','15:55:00','2017-05-17','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(605,'2',1,'',2,27,'\"','2017-05-20','20:55:00','2017-05-20','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(606,'2',1,'',2,28,'\"','2017-05-19','20:40:00','2017-05-19','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(607,'2',1,'',2,27,'\"','2017-05-23','20:55:00','2017-05-23','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(608,'2',1,'',2,27,'\"','2017-05-25','16:20:00','2017-05-25','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(609,'2',1,'',2,28,'\"','2017-05-09','15:35:00','2017-05-09','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(610,'2',1,'',2,28,'\"','2017-05-10','15:35:00','2017-05-10','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(611,'2',1,'',2,28,'\"','2017-05-14','09:55:00','2017-05-14','00:00:00','2 h 15',69.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(612,'2',1,'',2,1,'\"','2017-05-19','08:55:00','2017-05-19','00:00:00','2 h 25',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(613,'2',1,'',2,1,'\"','2017-05-19','21:45:00','2017-05-20','00:00:00','2 h 25',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(614,'2',1,'',2,1,'\"','2017-05-23','08:55:00','2017-05-23','00:00:00','2 h 25',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(615,'2',1,'',2,1,'\"','2017-05-23','15:20:00','2017-05-23','00:00:00','2 h 25',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(616,'2',1,'',2,1,'\"','2017-05-25','15:20:00','2017-05-25','00:00:00','2 h 25',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(617,'2',1,'',3,1,'\"','2017-05-30','09:05:00','2017-05-30','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(618,'2',1,'',3,1,'\"','2017-05-13','21:55:00','2017-05-14','00:00:00','2 h 10',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(619,'2',1,'',3,28,'\"','2017-05-09','21:00:00','2017-05-09','00:00:00','1 h 55',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(620,'2',1,'',3,28,'\"','2017-05-26','21:00:00','2017-05-26','00:00:00','1 h 55',70.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(621,'2',6,'',3,27,'\"','2017-05-28','06:35:00','2017-05-28','00:00:00','2 h 10',71.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(622,'2',6,'',3,27,'\"','2017-05-02','06:35:00','2017-05-02','00:00:00','2 h 10',71.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(623,'2',6,'',3,27,'\"','2017-05-04','06:35:00','2017-05-04','00:00:00','2 h 10',71.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(624,'2',6,'',3,27,'\"','2017-05-08','06:35:00','2017-05-08','00:00:00','2 h 10',71.39,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(625,'2',5,'',2,1,'\"','2017-05-19','12:00:00','2017-05-19','00:00:00','2 h 25',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(626,'2',5,'',2,1,'\"','2017-05-20','10:30:00','2017-05-20','00:00:00','2 h 25',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(627,'2',5,'',2,1,'\"','2017-05-24','18:40:00','2017-05-24','00:00:00','2 h 25',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(628,'2',5,'',2,1,'\"','2017-05-25','10:30:00','2017-05-25','00:00:00','2 h 25',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(629,'2',5,'',2,1,'\"','2017-05-26','15:25:00','2017-05-26','00:00:00','2 h 25',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(630,'2',5,'',2,25,'\"','2017-05-03','12:50:00','2017-05-03','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(631,'2',5,'',2,25,'\"','2017-05-08','12:50:00','2017-05-08','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(632,'2',5,'',2,25,'\"','2017-05-21','12:50:00','2017-05-21','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(633,'2',5,'',2,25,'\"','2017-05-27','12:50:00','2017-05-27','00:00:00','2 h 20',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(634,'2',5,'',2,28,'\"','2017-05-29','07:50:00','2017-05-29','00:00:00','2 h 15',72.24,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(635,'2',6,'',3,26,'\"','2017-05-16','09:00:00','2017-05-16','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(636,'2',6,'',3,26,'\"','2017-05-29','09:00:00','2017-05-29','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(637,'2',6,'',3,26,'\"','2017-05-01','09:00:00','2017-05-01','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(638,'2',6,'',3,26,'\"','2017-05-27','21:05:00','2017-05-27','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(639,'2',6,'',3,26,'\"','2017-05-02','09:00:00','2017-05-02','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(640,'2',6,'',3,26,'\"','2017-05-03','09:00:00','2017-05-03','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(641,'2',6,'',3,26,'\"','2017-05-04','09:00:00','2017-05-04','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(642,'2',6,'',3,26,'\"','2017-05-06','09:00:00','2017-05-06','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(643,'2',6,'',3,26,'\"','2017-05-06','21:05:00','2017-05-06','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(644,'2',6,'',3,26,'\"','2017-05-08','09:00:00','2017-05-08','00:00:00','2 h 10',74.45,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(645,'2',1,'',2,27,'\"','2017-05-20','13:55:00','2017-05-20','00:00:00','2 h 15',76.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(646,'2',1,'',2,28,'\"','2017-05-30','15:35:00','2017-05-30','00:00:00','2 h 15',76.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(647,'2',1,'',2,28,'\"','2017-05-23','15:35:00','2017-05-23','00:00:00','2 h 15',76.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(648,'2',1,'',2,28,'\"','2017-05-13','09:50:00','2017-05-13','00:00:00','2 h 15',76.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(649,'2',1,'',2,1,'\"','2017-05-30','15:20:00','2017-05-30','00:00:00','2 h 25',80.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(650,'2',1,'',2,1,'\"','2017-05-30','21:45:00','2017-05-31','00:00:00','2 h 25',80.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(651,'2',1,'',2,1,'\"','2017-05-31','08:55:00','2017-05-31','00:00:00','2 h 25',80.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(652,'2',1,'',2,1,'\"','2017-05-31','21:45:00','2017-06-01','00:00:00','2 h 25',80.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(653,'2',1,'',2,1,'\"','2017-05-19','15:20:00','2017-05-19','00:00:00','2 h 25',80.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(654,'2',1,'',2,1,'\"','2017-05-26','15:20:00','2017-05-26','00:00:00','2 h 25',80.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(655,'2',5,'',2,1,'\"','2017-05-19','15:25:00','2017-05-19','00:00:00','2 h 25',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(656,'2',5,'',2,1,'\"','2017-05-21','07:00:00','2017-05-21','00:00:00','2 h 25',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(657,'2',5,'',2,1,'\"','2017-05-22','07:00:00','2017-05-22','00:00:00','2 h 25',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(658,'2',5,'',2,1,'\"','2017-05-26','07:00:00','2017-05-26','00:00:00','2 h 25',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(659,'2',5,'',2,1,'\"','2017-05-26','12:00:00','2017-05-26','00:00:00','2 h 25',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(660,'2',5,'',2,1,'\"','2017-05-27','07:00:00','2017-05-27','00:00:00','2 h 25',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(661,'2',5,'',2,25,'\"','2017-05-04','12:50:00','2017-05-04','00:00:00','2 h 20',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(662,'2',5,'',2,27,'\"','2017-05-22','11:30:00','2017-05-22','00:00:00','2 h 25',82.54,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(663,'2',6,'',3,27,'\"','2017-05-01','06:35:00','2017-05-01','00:00:00','2 h 10',85.67,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(664,'2',6,'',3,27,'\"','2017-05-03','06:35:00','2017-05-03','00:00:00','2 h 10',85.67,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(665,'2',1,'',2,27,'\"','2017-05-18','16:20:00','2017-05-18','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(666,'2',1,'',2,27,'\"','2017-05-19','13:45:00','2017-05-19','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(667,'2',1,'',2,27,'\"','2017-05-19','16:30:00','2017-05-19','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(668,'2',1,'',2,28,'\"','2017-05-16','15:35:00','2017-05-16','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(669,'2',1,'',2,27,'\"','2017-05-09','20:55:00','2017-05-09','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(670,'2',1,'',2,27,'\"','2017-05-12','13:45:00','2017-05-12','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(671,'2',1,'',2,27,'\"','2017-05-12','16:30:00','2017-05-12','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(672,'2',1,'',2,27,'\"','2017-05-13','13:55:00','2017-05-13','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(673,'2',1,'',2,28,'\"','2017-05-27','09:50:00','2017-05-27','00:00:00','2 h 15',86.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(674,'2',1,'',2,1,'\"','2017-05-16','21:45:00','2017-05-17','00:00:00','2 h 25',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(675,'2',1,'',2,1,'\"','2017-05-02','21:45:00','2017-05-03','00:00:00','2 h 25',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(676,'2',1,'',2,1,'\"','2017-05-03','21:45:00','2017-05-04','00:00:00','2 h 25',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(677,'2',1,'',2,1,'\"','2017-05-20','15:20:00','2017-05-20','00:00:00','2 h 25',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(678,'2',1,'',2,1,'\"','2017-05-22','08:55:00','2017-05-22','00:00:00','2 h 25',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(679,'2',1,'',2,1,'\"','2017-05-12','15:20:00','2017-05-12','00:00:00','2 h 25',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(680,'2',1,'',3,1,'\"','2017-05-21','22:20:00','2017-05-22','00:00:00','2 h 10',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(681,'2',1,'',3,28,'\"','2017-05-29','09:55:00','2017-05-29','00:00:00','1 h 55',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(682,'2',1,'',3,28,'\"','2017-05-22','09:55:00','2017-05-22','00:00:00','1 h 55',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(683,'2',1,'',3,28,'\"','2017-05-08','09:55:00','2017-05-08','00:00:00','1 h 55',90.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(684,'2',5,'',2,1,'\"','2017-05-16','18:40:00','2017-05-16','00:00:00','2 h 25',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(685,'2',5,'',2,1,'\"','2017-05-19','18:40:00','2017-05-19','00:00:00','2 h 25',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(686,'2',5,'',2,1,'\"','2017-05-20','18:40:00','2017-05-20','00:00:00','2 h 25',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(687,'2',5,'',2,1,'\"','2017-05-21','10:30:00','2017-05-21','00:00:00','2 h 25',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(688,'2',5,'',2,1,'\"','2017-05-22','10:30:00','2017-05-22','00:00:00','2 h 25',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(689,'2',5,'',2,25,'\"','2017-05-02','12:50:00','2017-05-02','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(690,'2',5,'',2,25,'\"','2017-05-06','12:50:00','2017-05-06','00:00:00','2 h 20',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(691,'2',5,'',2,28,'\"','2017-05-01','07:50:00','2017-05-01','00:00:00','2 h 15',92.84,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(692,'2',1,'',2,27,'\"','2017-05-02','09:45:00','2017-05-02','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(693,'2',1,'',2,27,'\"','2017-05-16','09:45:00','2017-05-16','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(694,'2',1,'',2,28,'\"','2017-05-29','09:50:00','2017-05-29','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(695,'2',1,'',2,28,'\"','2017-05-31','15:35:00','2017-05-31','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(696,'2',1,'',2,28,'\"','2017-05-19','09:50:00','2017-05-19','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(697,'2',1,'',2,27,'\"','2017-05-09','09:45:00','2017-05-09','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(698,'2',1,'',2,28,'\"','2017-05-21','09:55:00','2017-05-21','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(699,'2',1,'',2,28,'\"','2017-05-22','09:50:00','2017-05-22','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(700,'2',1,'',2,27,'\"','2017-05-13','20:55:00','2017-05-13','00:00:00','2 h 15',95.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(701,'2',1,'',2,1,'\"','2017-05-01','08:55:00','2017-05-01','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(702,'2',1,'',2,1,'\"','2017-05-29','08:55:00','2017-05-29','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(703,'2',1,'',2,1,'\"','2017-05-03','08:55:00','2017-05-03','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(704,'2',1,'',2,1,'\"','2017-05-03','20:50:00','2017-05-03','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(705,'2',1,'',2,1,'\"','2017-05-04','08:55:00','2017-05-04','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(706,'2',1,'',2,1,'\"','2017-05-04','15:20:00','2017-05-04','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(707,'2',1,'',2,1,'\"','2017-05-04','21:45:00','2017-05-05','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(708,'2',1,'',2,1,'\"','2017-05-10','21:45:00','2017-05-11','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(709,'2',1,'',2,1,'\"','2017-05-11','15:20:00','2017-05-11','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(710,'2',1,'',2,1,'\"','2017-05-11','21:45:00','2017-05-12','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(711,'2',1,'',2,1,'\"','2017-05-12','08:55:00','2017-05-12','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(712,'2',1,'',2,1,'\"','2017-05-12','21:45:00','2017-05-13','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(713,'2',1,'',2,1,'\"','2017-05-13','15:20:00','2017-05-13','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(714,'2',1,'',2,1,'\"','2017-05-26','21:45:00','2017-05-27','00:00:00','2 h 25',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(715,'2',1,'',3,28,'\"','2017-05-16','21:00:00','2017-05-16','00:00:00','1 h 55',103.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(716,'2',6,'',3,27,'\"','2017-05-07','06:35:00','2017-05-07','00:00:00','2 h 10',103.01,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(717,'2',5,'',2,1,'\"','2017-05-26','18:40:00','2017-05-26','00:00:00','2 h 25',103.14,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(718,'2',5,'',2,1,'\"','2017-05-27','10:30:00','2017-05-27','00:00:00','2 h 25',103.14,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(719,'2',5,'',2,25,'\"','2017-05-05','12:50:00','2017-05-05','00:00:00','2 h 20',103.14,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(720,'2',5,'',2,28,'\"','2017-05-08','07:50:00','2017-05-08','00:00:00','2 h 15',103.14,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(721,'2',6,'',3,26,'\"','2017-05-05','09:00:00','2017-05-05','00:00:00','2 h 10',108.11,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(722,'2',6,'',3,26,'\"','2017-05-07','11:05:00','2017-05-07','00:00:00','2 h 10',108.11,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(723,'2',1,'',2,27,'\"','2017-05-29','13:50:00','2017-05-29','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(724,'2',1,'',2,27,'\"','2017-05-16','20:55:00','2017-05-16','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(725,'2',1,'',2,27,'\"','2017-05-03','13:50:00','2017-05-03','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(726,'2',1,'',2,27,'\"','2017-05-03','15:55:00','2017-05-03','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(727,'2',1,'',2,27,'\"','2017-05-21','21:00:00','2017-05-21','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(728,'2',1,'',2,28,'\"','2017-05-18','20:15:00','2017-05-18','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(729,'2',1,'',2,28,'\"','2017-05-11','20:15:00','2017-05-11','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(730,'2',1,'',2,28,'\"','2017-05-25','20:15:00','2017-05-25','00:00:00','2 h 15',110.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(731,'2',1,'',2,28,'\"','2017-05-02','15:35:00','2017-05-02','00:00:00','2 h 15',113.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(732,'2',1,'',2,28,'\"','2017-05-03','09:50:00','2017-05-03','00:00:00','2 h 15',113.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(733,'2',1,'',2,28,'\"','2017-05-03','15:35:00','2017-05-03','00:00:00','2 h 15',113.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(734,'2',5,'',2,1,'\"','2017-05-16','07:00:00','2017-05-16','00:00:00','2 h 25',113.44,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(735,'2',5,'',2,1,'\"','2017-05-16','12:00:00','2017-05-16','00:00:00','2 h 25',113.44,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(736,'2',5,'',2,1,'\"','2017-05-16','15:30:00','2017-05-16','00:00:00','2 h 25',113.44,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(737,'2',5,'',2,28,'\"','2017-05-05','07:55:00','2017-05-05','00:00:00','2 h 15',113.44,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(738,'2',1,'',2,1,'\"','2017-05-02','15:20:00','2017-05-02','00:00:00','2 h 25',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(739,'2',1,'',2,1,'\"','2017-05-05','08:55:00','2017-05-05','00:00:00','2 h 25',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(740,'2',1,'',2,1,'\"','2017-05-05','21:45:00','2017-05-06','00:00:00','2 h 25',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(741,'2',1,'',2,1,'\"','2017-05-22','21:50:00','2017-05-23','00:00:00','2 h 25',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(742,'2',1,'',2,1,'\"','2017-05-13','08:55:00','2017-05-13','00:00:00','2 h 25',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(743,'2',1,'',3,1,'\"','2017-05-04','08:55:00','2017-05-04','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(744,'2',1,'',3,1,'\"','2017-05-28','22:20:00','2017-05-29','00:00:00','2 h 10',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(745,'2',1,'',3,28,'\"','2017-05-01','09:55:00','2017-05-01','00:00:00','1 h 55',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(746,'2',1,'',3,28,'\"','2017-05-02','21:00:00','2017-05-02','00:00:00','1 h 55',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(747,'2',1,'',3,28,'\"','2017-05-03','09:50:00','2017-05-03','00:00:00','1 h 55',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(748,'2',1,'',3,28,'\"','2017-05-27','20:45:00','2017-05-27','00:00:00','1 h 55',115.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(749,'2',5,'',2,1,'\"','2017-05-16','10:30:00','2017-05-16','00:00:00','2 h 25',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(750,'2',5,'',2,1,'\"','2017-05-20','15:35:00','2017-05-20','00:00:00','2 h 25',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(751,'2',5,'',2,1,'\"','2017-05-21','12:00:00','2017-05-21','00:00:00','2 h 25',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(752,'2',5,'',2,1,'\"','2017-05-22','12:00:00','2017-05-22','00:00:00','2 h 25',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(753,'2',5,'',2,1,'\"','2017-05-22','15:25:00','2017-05-22','00:00:00','2 h 25',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(754,'2',5,'',2,1,'\"','2017-05-22','18:40:00','2017-05-22','00:00:00','2 h 25',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(755,'2',5,'',2,25,'\"','2017-05-01','12:50:00','2017-05-01','00:00:00','2 h 20',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(756,'2',5,'',2,1,'\"','2017-05-27','18:40:00','2017-05-27','00:00:00','2 h 25',123.74,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(757,'2',1,'',2,27,'\"','2017-05-01','13:50:00','2017-05-01','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(758,'2',1,'',2,27,'\"','2017-05-01','21:00:00','2017-05-01','00:00:00','2 h 20',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(759,'2',1,'',2,27,'\"','2017-05-29','21:00:00','2017-05-29','00:00:00','2 h 20',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(760,'2',1,'',2,27,'\"','2017-05-02','20:55:00','2017-05-02','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(761,'2',1,'',2,27,'\"','2017-05-04','16:20:00','2017-05-04','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(762,'2',1,'',2,28,'\"','2017-05-29','15:35:00','2017-05-29','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(763,'2',1,'',2,27,'\"','2017-05-22','13:50:00','2017-05-22','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(764,'2',1,'',2,27,'\"','2017-05-22','21:00:00','2017-05-22','00:00:00','2 h 20',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(765,'2',1,'',2,28,'\"','2017-05-21','20:35:00','2017-05-21','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(766,'2',1,'',2,28,'\"','2017-05-08','09:50:00','2017-05-08','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(767,'2',1,'',2,28,'\"','2017-05-22','15:35:00','2017-05-22','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(768,'2',1,'',2,27,'\"','2017-05-27','13:55:00','2017-05-27','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(769,'2',1,'',2,28,'\"','2017-05-12','09:50:00','2017-05-12','00:00:00','2 h 15',127.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(770,'2',1,'',2,1,'\"','2017-05-29','21:50:00','2017-05-30','00:00:00','2 h 25',130.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(771,'2',1,'',2,1,'\"','2017-05-16','08:55:00','2017-05-16','00:00:00','2 h 25',130.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(772,'2',1,'',2,1,'\"','2017-05-16','15:20:00','2017-05-16','00:00:00','2 h 25',130.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(773,'2',1,'',2,1,'\"','2017-05-14','08:55:00','2017-05-14','00:00:00','2 h 25',130.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(774,'2',1,'',2,1,'\"','2017-05-27','08:55:00','2017-05-27','00:00:00','2 h 25',130.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(775,'2',1,'',3,1,'\"','2017-05-27','21:55:00','2017-05-28','00:00:00','2 h 10',130.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(776,'2',1,'',3,28,'\"','2017-05-28','09:20:00','2017-05-28','00:00:00','1 h 55',130.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(777,'2',1,'',2,1,'\"','2017-05-02','08:55:00','2017-05-02','00:00:00','2 h 25',131.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(778,'2',1,'',2,1,'\"','2017-05-05','15:20:00','2017-05-05','00:00:00','2 h 25',131.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(779,'2',1,'',3,1,'\"','2017-05-02','09:05:00','2017-05-02','00:00:00','2 h 10',131.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(780,'2',1,'',2,28,'\"','2017-05-05','20:40:00','2017-05-05','00:00:00','2 h 15',131.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(781,'2',5,'',2,1,'\"','2017-05-21','15:25:00','2017-05-21','00:00:00','2 h 25',144.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(782,'2',5,'',2,1,'\"','2017-05-28','07:00:00','2017-05-28','00:00:00','2 h 25',144.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(783,'2',5,'',2,25,'\"','2017-05-07','12:50:00','2017-05-07','00:00:00','2 h 20',144.34,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(784,'2',1,'',2,1,'\"','2017-05-30','08:55:00','2017-05-30','00:00:00','2 h 25',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(785,'2',1,'',2,1,'\"','2017-05-08','08:55:00','2017-05-08','00:00:00','2 h 25',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(786,'2',1,'',2,1,'\"','2017-05-20','08:55:00','2017-05-20','00:00:00','2 h 25',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(787,'2',1,'',2,1,'\"','2017-05-21','08:55:00','2017-05-21','00:00:00','2 h 25',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(788,'2',1,'',2,1,'\"','2017-05-21','21:45:00','2017-05-22','00:00:00','2 h 25',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(789,'2',1,'',2,1,'\"','2017-05-25','08:55:00','2017-05-25','00:00:00','2 h 25',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(790,'2',1,'',2,1,'\"','2017-05-26','08:55:00','2017-05-26','00:00:00','2 h 25',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(791,'2',1,'',3,1,'\"','2017-05-09','09:05:00','2017-05-09','00:00:00','2 h 10',145.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(792,'2',1,'',2,27,'\"','2017-05-05','13:45:00','2017-05-05','00:00:00','2 h 15',146.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(793,'2',1,'',2,27,'\"','2017-05-05','16:30:00','2017-05-05','00:00:00','2 h 15',146.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(794,'2',1,'',2,27,'\"','2017-05-06','20:55:00','2017-05-06','00:00:00','2 h 15',146.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(795,'2',1,'',2,27,'\"','2017-05-08','13:50:00','2017-05-08','00:00:00','2 h 15',146.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(796,'2',1,'',2,27,'\"','2017-05-08','21:00:00','2017-05-08','00:00:00','2 h 20',146.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(797,'2',1,'',2,28,'\"','2017-05-12','20:40:00','2017-05-12','00:00:00','2 h 15',146.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(798,'2',1,'',2,1,'\"','2017-05-01','21:50:00','2017-05-02','00:00:00','2 h 25',148.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(799,'2',6,'',3,26,'\"','2017-05-28','11:05:00','2017-05-28','00:00:00','2 h 10',151.97,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(800,'2',1,'',2,28,'\"','2017-05-01','09:50:00','2017-05-01','00:00:00','2 h 15',152.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(801,'2',1,'',2,28,'\"','2017-05-01','15:35:00','2017-05-01','00:00:00','2 h 15',152.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(802,'2',1,'',2,28,'\"','2017-05-05','09:50:00','2017-05-05','00:00:00','2 h 15',152.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(803,'2',1,'',2,28,'\"','2017-05-06','09:50:00','2017-05-06','00:00:00','2 h 15',152.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(804,'2',1,'',2,1,'\"','2017-05-08','21:50:00','2017-05-09','00:00:00','2 h 25',163.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(805,'2',1,'',2,1,'\"','2017-05-21','15:20:00','2017-05-21','00:00:00','2 h 25',163.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(806,'2',1,'',2,1,'\"','2017-05-11','08:55:00','2017-05-11','00:00:00','2 h 25',163.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(807,'2',1,'',2,1,'\"','2017-05-14','15:20:00','2017-05-14','00:00:00','2 h 25',163.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(808,'2',5,'',2,1,'\"','2017-05-27','15:35:00','2017-05-27','00:00:00','2 h 25',164.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(809,'2',5,'',2,1,'\"','2017-05-28','10:30:00','2017-05-28','00:00:00','2 h 25',164.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(810,'2',5,'',2,1,'\"','2017-05-28','12:00:00','2017-05-28','00:00:00','2 h 25',164.94,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(811,'2',1,'',2,1,'\"','2017-05-07','08:55:00','2017-05-07','00:00:00','2 h 25',166.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(812,'2',1,'',3,1,'\"','2017-05-05','09:45:00','2017-05-05','00:00:00','2 h 10',166.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(813,'2',1,'',3,1,'\"','2017-05-07','22:20:00','2017-05-08','00:00:00','2 h 10',166.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(814,'2',1,'',3,28,'\"','2017-05-04','15:45:00','2017-05-04','00:00:00','1 h 55',166.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(815,'2',1,'',3,28,'\"','2017-05-05','21:00:00','2017-05-05','00:00:00','1 h 55',166.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(816,'2',1,'',3,28,'\"','2017-05-06','20:45:00','2017-05-06','00:00:00','1 h 55',166.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(817,'2',1,'',2,27,'\"','2017-05-21','14:45:00','2017-05-21','00:00:00','2 h 15',167.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(818,'2',1,'',2,27,'\"','2017-05-06','13:55:00','2017-05-06','00:00:00','2 h 15',167.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(819,'2',1,'',2,27,'\"','2017-05-27','20:55:00','2017-05-27','00:00:00','2 h 15',167.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(820,'2',1,'',2,27,'\"','2017-05-14','14:45:00','2017-05-14','00:00:00','2 h 15',167.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(821,'2',1,'',2,28,'\"','2017-05-28','09:55:00','2017-05-28','00:00:00','2 h 15',167.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(822,'2',6,'',3,27,'\"','2017-05-15','06:35:00','2017-05-15','00:00:00','2 h 10',174.41,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(823,'2',1,'',2,28,'\"','2017-05-04','20:15:00','2017-05-04','00:00:00','2 h 15',176.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(824,'2',1,'',2,28,'\"','2017-05-07','09:55:00','2017-05-07','00:00:00','2 h 15',176.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(825,'2',1,'',2,1,'\"','2017-05-10','08:55:00','2017-05-10','00:00:00','2 h 25',180.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(826,'2',1,'',2,1,'\"','2017-05-28','08:55:00','2017-05-28','00:00:00','2 h 25',180.00,'EUR','2017-04-12 20:07:10','2017-04-12 20:07:10'),(827,'2',1,'',2,1,'\"','2017-05-28','21:45:00','2017-05-29','00:00:00','2 h 25',180.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(828,'2',1,'',3,28,'\"','2017-05-07','09:20:00','2017-05-07','00:00:00','1 h 55',184.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(829,'2',1,'',2,1,'\"','2017-05-06','08:55:00','2017-05-06','00:00:00','2 h 25',185.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(830,'2',1,'',2,1,'\"','2017-05-07','21:45:00','2017-05-08','00:00:00','2 h 25',185.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(831,'2',5,'',2,1,'\"','2017-05-21','18:40:00','2017-05-21','00:00:00','2 h 25',195.84,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(832,'2',5,'',2,1,'\"','2017-05-28','18:40:00','2017-05-28','00:00:00','2 h 25',195.84,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(833,'2',1,'',2,27,'\"','2017-05-15','21:00:00','2017-05-15','00:00:00','2 h 20',196.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(834,'2',1,'',2,27,'\"','2017-05-07','14:45:00','2017-05-07','00:00:00','2 h 15',196.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(835,'2',1,'',2,27,'\"','2017-05-07','21:00:00','2017-05-07','00:00:00','2 h 15',196.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(836,'2',1,'',2,28,'\"','2017-05-08','15:35:00','2017-05-08','00:00:00','2 h 15',196.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(837,'2',1,'',2,1,'\"','2017-05-27','15:20:00','2017-05-27','00:00:00','2 h 25',200.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(838,'2',6,'',3,27,'\"','2017-05-06','06:35:00','2017-05-06','00:00:00','2 h 10',205.01,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(839,'2',1,'',2,1,'\"','2017-05-07','15:20:00','2017-05-07','00:00:00','2 h 25',206.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(840,'2',1,'',3,1,'\"','2017-05-06','21:55:00','2017-05-07','00:00:00','2 h 10',206.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(841,'2',1,'',2,28,'\"','2017-05-07','20:35:00','2017-05-07','00:00:00','2 h 15',207.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(842,'2',1,'',2,1,'\"','2017-05-28','15:20:00','2017-05-28','00:00:00','2 h 25',220.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(843,'2',5,'',2,1,'\"','2017-05-15','18:40:00','2017-05-15','00:00:00','2 h 25',226.74,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(844,'2',5,'',2,1,'\"','2017-05-28','15:25:00','2017-05-28','00:00:00','2 h 25',226.74,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(845,'2',1,'',2,1,'\"','2017-05-06','15:20:00','2017-05-06','00:00:00','2 h 25',229.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(846,'2',1,'',2,27,'\"','2017-05-28','21:00:00','2017-05-28','00:00:00','2 h 15',232.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(847,'2',1,'',2,1,'\"','2017-05-15','21:50:00','2017-05-16','00:00:00','2 h 25',242.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(848,'2',5,'',2,1,'\"','2017-05-15','07:00:00','2017-05-15','00:00:00','2 h 25',247.34,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(849,'2',5,'',2,1,'\"','2017-05-15','10:30:00','2017-05-15','00:00:00','2 h 25',247.34,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(850,'2',5,'',2,1,'\"','2017-05-15','12:00:00','2017-05-15','00:00:00','2 h 25',247.34,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(851,'2',5,'',2,25,'\"','2017-05-15','12:50:00','2017-05-15','00:00:00','2 h 20',247.34,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(852,'2',5,'',2,27,'\"','2017-05-15','11:30:00','2017-05-15','00:00:00','2 h 25',257.64,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(853,'2',6,'',3,26,'\"','2017-05-15','09:00:00','2017-05-15','00:00:00','2 h 10',262.13,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(854,'2',1,'',2,1,'\"','2017-05-15','08:55:00','2017-05-15','00:00:00','2 h 25',267.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(855,'2',1,'',2,27,'\"','2017-05-15','13:50:00','2017-05-15','00:00:00','2 h 15',279.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(856,'2',1,'',2,27,'\"','2017-05-28','14:45:00','2017-05-28','00:00:00','2 h 15',279.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(857,'2',1,'',2,27,'\"','2017-05-14','21:00:00','2017-05-14','00:00:00','2 h 15',279.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(858,'2',1,'',2,28,'\"','2017-05-28','20:35:00','2017-05-28','00:00:00','2 h 15',279.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(859,'2',1,'',3,28,'\"','2017-05-15','09:55:00','2017-05-15','00:00:00','1 h 55',293.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(860,'2',1,'',2,1,'\"','2017-05-14','21:45:00','2017-05-15','00:00:00','2 h 25',294.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(861,'2',1,'',3,1,'\"','2017-05-14','22:20:00','2017-05-15','00:00:00','2 h 10',294.00,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(862,'2',5,'',2,1,'\"','2017-05-15','15:25:00','2017-05-15','00:00:00','2 h 25',298.84,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11'),(863,'2',5,'',2,25,'\"','2017-05-28','12:50:00','2017-05-28','00:00:00','2 h 20',298.84,'EUR','2017-04-12 20:07:11','2017-04-12 20:07:11');
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_lines`
--

DROP TABLE IF EXISTS `invoice_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_lines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_amount` int(11) NOT NULL,
  `product_vat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_lines`
--

LOCK TABLES `invoice_lines` WRITE;
/*!40000 ALTER TABLE `invoice_lines` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,1,0,'2017-02-28 23:03:00','2017-02-28 23:03:00');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_csvupload`
--

DROP TABLE IF EXISTS `log_csvupload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_csvupload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1 means flight upload, 2 means matches upload',
  `success_entry` bigint(20) NOT NULL COMMENT 'number of records inserted to the table',
  `fail_entry` bigint(20) NOT NULL COMMENT 'number of failed records',
  `message` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'about the csv upload result',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_csvupload`
--

LOCK TABLES `log_csvupload` WRITE;
/*!40000 ALTER TABLE `log_csvupload` DISABLE KEYS */;
INSERT INTO `log_csvupload` VALUES (1,1,0,82,'There is no new data to import.','2016-11-09 03:58:46','2016-11-09 03:58:46'),(2,1,1,5849,'Flight data uploaded Successfully.','2016-11-09 03:59:50','2016-11-09 03:59:50'),(3,1,0,5977,'There is no new data to import.','2016-11-09 04:03:37','2016-11-09 04:03:37'),(4,1,0,5850,'There is no new data to import.','2016-11-09 04:13:42','2016-11-09 04:13:42'),(5,1,0,5850,'There is no new data to import.','2016-11-09 04:19:02','2016-11-09 04:19:02'),(6,1,1092,4413,'Flight data uploaded Successfully.','2017-02-17 09:42:43','2017-02-17 09:42:43'),(7,1,3,5847,'Flight data uploaded Successfully.','2017-03-29 08:32:18','2017-03-29 08:32:18'),(8,1,116,0,'Flight data uploaded Successfully.','2017-04-02 17:56:24','2017-04-02 17:56:24'),(9,1,116,0,'Flight data uploaded Successfully.','2017-04-02 18:19:14','2017-04-02 18:19:14'),(10,1,397,0,'Flight data uploaded Successfully.','2017-04-02 18:22:59','2017-04-02 18:22:59'),(11,1,116,0,'Flight data uploaded Successfully.','2017-04-02 18:30:31','2017-04-02 18:30:31'),(12,1,5850,0,'Flight data uploaded Successfully.','2017-04-02 18:50:21','2017-04-02 18:50:21'),(13,1,466,0,'Flight data uploaded Successfully.','2017-04-03 12:56:25','2017-04-03 12:56:25'),(14,1,397,0,'Flight data uploaded Successfully.','2017-04-03 12:56:55','2017-04-03 12:56:55'),(15,1,466,0,'Flight data uploaded Successfully.','2017-04-03 13:21:53','2017-04-03 13:21:53'),(16,1,397,0,'Flight data uploaded Successfully.','2017-04-03 13:22:09','2017-04-03 13:22:09'),(17,2,1,0,'Matches CSV uploaded Successfully.','2017-04-03 18:51:11','2017-04-03 18:51:11'),(18,2,0,1,'There is no new data to import.','2017-04-03 18:58:34','2017-04-03 18:58:34'),(19,2,1,0,'Matches CSV uploaded Successfully.','2017-04-03 18:59:48','2017-04-03 18:59:48'),(20,2,1,0,'Matches CSV uploaded Successfully.','2017-04-03 19:09:51','2017-04-03 19:09:51'),(21,2,0,1,'There is no new data to import.','2017-04-03 19:13:37','2017-04-03 19:13:37'),(22,2,0,1,'There is no new data to import.','2017-04-03 19:18:30','2017-04-03 19:18:30'),(23,2,1,0,'Matches CSV uploaded Successfully.','2017-04-03 19:19:56','2017-04-03 19:19:56'),(24,2,2,0,'Matches CSV uploaded Successfully.','2017-04-03 19:20:38','2017-04-03 19:20:38'),(25,2,2,0,'Matches CSV uploaded Successfully.','2017-04-03 19:35:48','2017-04-03 19:35:48'),(26,2,0,1,'There is no new data to import.','2017-04-03 19:40:27','2017-04-03 19:40:27'),(27,2,1,0,'Matches CSV uploaded Successfully.','2017-04-03 19:40:51','2017-04-03 19:40:51'),(28,2,1,0,'Matches CSV uploaded Successfully.','2017-04-03 19:41:55','2017-04-03 19:41:55'),(29,2,1,0,'Matches CSV uploaded Successfully.','2017-04-03 19:47:54','2017-04-03 19:47:54'),(30,2,2,0,'Matches CSV uploaded Successfully.','2017-04-03 19:48:36','2017-04-03 19:48:36'),(31,2,2,0,'Matches CSV uploaded Successfully.','2017-04-03 19:58:24','2017-04-03 19:58:24'),(32,2,2,0,'Matches CSV uploaded Successfully.','2017-04-03 19:59:26','2017-04-03 19:59:26'),(33,2,1,0,'Matches CSV uploaded Successfully.','2017-04-08 13:14:35','2017-04-08 13:14:35'),(34,2,1,0,'Matches CSV uploaded Successfully.','2017-04-08 13:16:32','2017-04-08 13:16:32'),(35,2,0,1,'There is no new data to import.','2017-04-08 13:16:49','2017-04-08 13:16:49'),(36,2,4,1,'Matches CSV uploaded Successfully.','2017-04-08 13:19:47','2017-04-08 13:19:47'),(37,1,466,0,'Flight data uploaded Successfully.','2017-04-08 17:20:12','2017-04-08 17:20:12'),(38,1,466,0,'Flight data uploaded Successfully.','2017-04-08 22:21:48','2017-04-08 22:21:48'),(39,1,397,0,'Flight data uploaded Successfully.','2017-04-08 22:22:06','2017-04-08 22:22:06'),(40,1,466,0,'Flight data uploaded Successfully.','2017-04-08 22:22:30','2017-04-08 22:22:30'),(41,1,397,0,'Flight data uploaded Successfully.','2017-04-08 22:22:43','2017-04-08 22:22:43'),(42,1,466,0,'Flight data uploaded Successfully.','2017-04-09 11:48:06','2017-04-09 11:48:06'),(43,1,466,0,'Flight data uploaded Successfully.','2017-04-12 20:06:59','2017-04-12 20:06:59'),(44,1,397,0,'Flight data uploaded Successfully.','2017-04-12 20:07:11','2017-04-12 20:07:11');
/*!40000 ALTER TABLE `log_csvupload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tournament` int(11) NOT NULL,
  `stadium` int(11) NOT NULL,
  `home_club` int(11) NOT NULL,
  `away_club` int(11) NOT NULL,
  `match_date` datetime NOT NULL,
  `image_name` text COLLATE utf8_unicode_ci NOT NULL,
  `show_text` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matches`
--

LOCK TABLES `matches` WRITE;
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` VALUES (2,3,1,1,2,'2017-05-12 09:25:00','',1,'2017-04-08 13:19:47','2017-04-20 19:55:19'),(5,3,1,1,4,'2017-06-10 22:00:51','4eb4cdbc244e73197507aa64c8a9bd57tKY1RHbhLQARrigR1493571933.png',0,'2017-04-30 17:05:33','2017-04-30 17:06:13');
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_07_02_230147_migration_cartalyst_sentinel',1),('2014_10_04_174350_soft_delete_users',1),('2014_12_10_011106_add_fields_to_user_table',1),('2015_08_09_200015_create_blog_module_table',1),('2015_08_11_064636_add_slug_to_blogs_table',1),('2015_08_19_073929_create_taggable_table',1),('2015_11_10_140011_create_files_table',1),('2016_01_02_062647_create_tasks_table',1),('2016_03_15_162832_create_companies_table',1),('2016_03_15_163805_create_products_table',1),('2016_03_15_163812_create_expenses_table',1),('2016_03_15_163823_create_clients_table',1),('2016_03_15_163906_create_plans_table',1),('2016_03_29_115527_add_company_to_client_table',1),('2016_04_12_101547_create_payment_methods_table',1),('2016_04_12_101558_create_payments_table',1),('2016_06_16_130106_create_stadia_table',2),('2016_06_16_130150_create_accomodations_table',2),('2016_06_20_134509_create_clubs_table',3),('2016_06_21_144459_create_matches_table',4),('2016_06_21_145510_create_tournaments_table',4),('2016_06_26_051806_create_competition_seatings_table',5),('2016_06_27_131557_create_cities_table',6),('2016_07_04_095850_create_countries_table',7),('2016_07_11_120131_create_airlines_table',8),('2016_07_11_120356_create_airports_table',8),('2016_07_11_124704_create_flights_table',8),('2016_07_19_093043_alter_flights_table',9),('2016_07_20_062741_add_code_column_to_countries_table',10),('2016_07_26_070237_alter_matches_table',11),('2016_07_27_124702_add_fields_mime__filename_to_stadium_table',12),('2016_08_08_060507_remove_fields_from_competition_seatings_table',13),('2016_08_08_062718_create_seating_Category_table',13),('2016_08_08_131129_create_invoices_table',14),('2016_08_08_131154_create_invoice_lines_table',14),('2016_08_15_101657_add_fields_to_accomodation',15),('2016_08_17_060234_add_fields_airportcode_and_city_id_in_airports_table',16),('2016_08_22_152512_create_airportlists_table',17),('2016_08_22_152529_create_airport_cities_table',17),('2016_08_24_051032_create_user_cart_table',18),('2016_08_24_074539_alter_table_user_cart',18),('2016_08_24_181110_create_order_table',19),('2016_08_24_181201_crate_orders_flight_table',20),('2016_08_24_181327_create_orders_match_table',20),('2016_08_24_181419_create_orders_accomodation_table',20),('2016_08_26_061908_add_orderid_field_to_order_accomodation_table',21),('2016_08_26_074223_alter_orders_match_table_add_fields_match_id_price_quantity',21),('2016_08_26_104842_alter_able_orders_flight_via_as_nullable',21),('2016_08_29_055545_add_field_typeofticket_to_orders_match_table',22),('2016_08_31_064535_create_orders_status_table',23),('2016_09_01_034927_create_table_orders_additional_fields',24),('2016_09_01_043039_create_Table_orders_tickets',24),('2016_09_01_043657_create_table_tickets_type',24),('2016_09_20_055242_add_country_id_to_Stadium_table',25),('2016_09_20_114949_add_country_field_in_accomodations_table',25),('2016_09_27_132536_remove_country_city_from_matches_table',26),('2016_09_28_051101_create_seatingcategories_table',27),('2016_10_01_023818_create_traveller_information_table',28),('2016_10_04_060330_alter_ordertable_change_fields_to_nullable',29),('2016_10_25_104050_add_image_field_to_matches_table',30),('2016_11_02_195358_create_options_table',31),('2016_11_04_082502_add_flight_type_inbound_outbound_in_flights_table',31),('2016_11_07_085246_add_tournamentdate_in_tournaments_table',32),('2016_11_08_061655_create_jobs_table',33),('2016_11_08_075937_create_csvupload_log_table',33),('2016_11_19_091043_add_field_colors_to_seatingcategory',34),('2016_11_22_055706_add_seat_type_id_in_orders_match_table',35),('2016_12_06_093020_add_flightmode_field_to_ordersflight_table',36),('2016_12_09_060510_add_fields_to_travellerinformation_table',37),('2016_12_13_060850_create_payment_status_table',38),('2016_12_14_082945_add_orders_options_table',39),('2016_12_15_065656_alter_table_ordersoptions',40),('2016_12_16_062641_add_nearest_airport_in_stadium_table',41),('2016_12_28_112158_create_settings_table',42),('2017_01_05_111312_add_fields_to_orders_accomodation_table',43),('2017_01_09_062727_add_booked_romms_in_orders_accomodation_table',44),('2017_01_10_054518_altertable_accomodations',45),('2017_01_27_091025_add_flag_to_airportlists',46),('2017_03_05_220604_add_mollie_to_orders_table',47),('2017_03_05_221141_add_mollie_field_to_orders_table',48),('2017_03_05_221351_change_mollie_field_to_orders_table',49),('2017_03_05_222423_change_mollie_string_to_orders_table',50);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'Suitcase','extra suitcase',25.00,'2016-12-07 14:22:37','2016-12-07 14:22:37'),(2,'Stadium tour','Tour around the facility',20.00,'2016-12-07 14:23:15','2016-12-07 14:23:15'),(3,'Matchprotect','Extra garantie voor mensen die te veel willen betalen',15.00,'2017-03-29 09:37:18','2017-03-29 09:37:47');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `postal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_total` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mollie_payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mollie_payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,7,'Paul','paul',NULL,NULL,NULL,NULL,NULL,NULL,0,9,3,465.00,'2017-04-03 13:34:50','2017-04-04 19:47:57','tr_sQpJNrSUeA','paid'),(2,7,'Paul','paul',NULL,NULL,NULL,NULL,NULL,NULL,0,9,1,180.00,'2017-04-20 21:20:27','2017-04-20 21:20:49','tr_gnPutwvDee','paid');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_accomodation`
--

DROP TABLE IF EXISTS `orders_accomodation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_accomodation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_match_id` int(11) NOT NULL COMMENT 'to connect accomodation is related to which match order',
  `hotel_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `star` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `include_breakfast` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL,
  `breakfast_price` decimal(15,2) DEFAULT NULL,
  `rooms_days` int(11) NOT NULL COMMENT 'to know how many days user want to stay in the hotel',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_accomodation`
--

LOCK TABLES `orders_accomodation` WRITE;
/*!40000 ALTER TABLE `orders_accomodation` DISABLE KEYS */;
INSERT INTO `orders_accomodation` VALUES (1,1,1,'New Hotel','1','Test Address','Barcelona','Spain',20.00,1,'yes',NULL,0,'2016-10-06 02:36:53','2016-10-06 02:36:53'),(2,2,2,'New Hotel','1','Test Address','Barcelona','Spain',20.00,1,'yes',NULL,0,'2016-10-06 04:09:55','2016-10-06 04:09:55'),(3,3,3,'New Hotel','1','Test Address','Barcelona','Spain',20.00,2,'yes',NULL,0,'2016-10-07 13:34:57','2016-10-07 13:34:57'),(4,4,4,'New Hotel','1','Test Address','Barcelona','Spain',20.00,1,'yes',NULL,0,'2016-10-12 09:44:48','2016-10-12 09:44:48'),(5,5,0,'New Hotel','1','Test Address','Barcelona','Spain',10.00,3,'yes',NULL,0,'2016-12-08 10:53:46','2016-12-08 10:53:46'),(6,6,0,'New Hotel','1','Test Address','Barcelona','Spain',10.00,2,'yes',5.00,1,'2017-01-10 04:53:32','2017-01-10 04:53:32'),(7,7,0,'New Hotel','1','Test Address','Barcelona','Spain',10.00,1,'yes',5.00,1,'2017-01-10 04:55:39','2017-01-10 04:55:39'),(8,8,0,'New Hotel','1','Test Address','Barcelona','Spain',10.00,1,'yes',5.00,1,'2017-01-10 15:22:49','2017-01-10 15:22:49'),(9,9,0,'New Hotel','1','Test Address','Barcelona','Spain',10.00,1,'yes',5.00,15,'2017-01-10 15:30:00','2017-01-10 15:30:00'),(10,10,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,3,'yes',10.00,3,'2017-02-08 10:55:37','2017-02-08 10:55:37'),(11,11,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,9,'2017-02-17 09:38:35','2017-02-17 09:38:35'),(12,12,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 19:40:30','2017-03-05 19:40:30'),(13,13,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 20:27:47','2017-03-05 20:27:47'),(14,14,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 20:31:53','2017-03-05 20:31:53'),(15,15,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 20:40:43','2017-03-05 20:40:43'),(16,16,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 21:09:45','2017-03-05 21:09:45'),(17,17,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 21:22:52','2017-03-05 21:22:52'),(18,18,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 21:23:33','2017-03-05 21:23:33'),(19,19,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-05 21:28:08','2017-03-05 21:28:08'),(20,20,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-09 21:21:30','2017-03-09 21:21:30'),(21,21,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-09 21:23:16','2017-03-09 21:23:16'),(22,22,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,4,'2017-03-10 12:05:08','2017-03-10 12:05:08'),(23,23,0,'New Hotel','1','Test Address','Barcelona','Spain',10.00,1,'yes',NULL,3,'2017-03-21 19:11:03','2017-03-21 19:11:03'),(24,24,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',10.00,3,'2017-03-29 09:46:06','2017-03-29 09:46:06'),(25,27,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,1,'yes',NULL,3,'2017-03-29 09:54:15','2017-03-29 09:54:15'),(26,28,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',5.00,2,'yes',NULL,3,'2017-03-29 09:56:42','2017-03-29 09:56:42'),(27,1,0,'New Hotel','5','Test Address','Barcelona','Spain',60.00,1,'yes',NULL,5,'2017-04-03 13:34:50','2017-04-03 13:34:50'),(28,2,0,'Cheap hotel','4','rue de cheap','Barcelona','Spain',20.00,1,'yes',NULL,3,'2017-04-20 21:20:27','2017-04-20 21:20:27');
/*!40000 ALTER TABLE `orders_accomodation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_additional_data`
--

DROP TABLE IF EXISTS `orders_additional_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_additional_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passport_number` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_additional_data`
--

LOCK TABLES `orders_additional_data` WRITE;
/*!40000 ALTER TABLE `orders_additional_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_additional_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_flight`
--

DROP TABLE IF EXISTS `orders_flight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_flight` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `flightmode` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT 'to know the flight is inbound or outbound. 1 means outbound and 2 means return',
  `airlines_id` int(11) NOT NULL,
  `airlines_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flight_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departure_airport` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arrival_airport` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `via` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrive_date` date NOT NULL,
  `arrive_time` time NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_flight`
--

LOCK TABLES `orders_flight` WRITE;
/*!40000 ALTER TABLE `orders_flight` DISABLE KEYS */;
INSERT INTO `orders_flight` VALUES (1,1,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2016-10-11','13:25:40','2016-10-12','05:25:40','16 h 00',100.00,1,'2016-10-06 02:36:53','2016-10-06 02:36:53'),(2,2,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2016-10-11','13:25:40','2016-10-12','05:25:40','16 h 00',100.00,1,'2016-10-06 04:09:55','2016-10-06 04:09:55'),(3,3,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2016-10-11','13:25:40','2016-10-12','05:25:40','16 h 00',100.00,2,'2016-10-07 13:34:57','2016-10-07 13:34:57'),(4,4,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2016-10-26','01:05:00','2016-10-27','05:25:00','4 h 20',136.00,1,'2016-10-12 09:44:48','2016-10-12 09:44:48'),(5,5,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2016-12-10','01:05:00','2016-12-11','05:25:00','4 h 20',136.00,3,'2016-12-08 10:53:46','2016-12-08 10:53:46'),(6,5,'2',5,'Vueling','','Barcelona (BCN)','Amsterdam (AMS)','','2016-12-17','14:30:00','2016-12-18','14:30:00','0 h 00',150.00,3,'2016-12-08 10:53:46','2016-12-08 10:53:46'),(7,6,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-01-28','05:10:00','2017-01-29','04:15:00','23 h 05',140.00,2,'2017-01-10 04:53:32','2017-01-10 04:53:32'),(8,6,'2',5,'Vueling','','Barcelona (BCN)','Manchester (MAN)','','2017-01-30','05:25:47','2017-01-31','02:10:47','20 h 45',145.00,2,'2017-01-10 04:53:32','2017-01-10 04:53:32'),(9,7,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-01-28','05:10:00','2017-01-29','04:15:00','23 h 05',140.00,1,'2017-01-10 04:55:39','2017-01-10 04:55:39'),(10,7,'2',5,'Vueling','','Barcelona (BCN)','Manchester (MAN)','','2017-01-30','05:25:47','2017-01-31','02:10:47','20 h 45',145.00,1,'2017-01-10 04:55:39','2017-01-10 04:55:39'),(11,8,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-01-28','06:00:00','2017-01-29','04:05:00','22 h 05',140.00,1,'2017-01-10 15:22:49','2017-01-10 15:22:49'),(12,8,'2',5,'Vueling','','Barcelona (BCN)','Amsterdam (AMS)','','2017-01-30','05:10:00','2017-01-31','02:10:00','21 h 00',120.00,1,'2017-01-10 15:22:49','2017-01-10 15:22:49'),(13,9,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-01-28','06:00:00','2017-01-29','04:05:00','22 h 05',140.00,1,'2017-01-10 15:30:00','2017-01-10 15:30:00'),(14,9,'2',4,'Pegasus','','Barcelona (BCN)','Amsterdam (AMS)','','2017-02-13','09:25:31','2017-02-14','10:30:31','1 h 05',125.00,1,'2017-01-10 15:30:00','2017-01-10 15:30:00'),(15,10,'1',3,'Germanwings','','Amsterdam (AMS)','Barcelona (BCN)','','2017-02-18','14:25:34','2017-02-19','16:20:35','1 h 55',120.00,3,'2017-02-08 10:55:37','2017-02-08 10:55:37'),(16,10,'2',6,'Ryanair','','Barcelona (BCN)','Amsterdam (AMS)','','2017-02-21','14:25:09','2017-02-22','05:25:10','15 h 00',105.00,3,'2017-02-08 10:55:37','2017-02-08 10:55:37'),(17,11,'1',3,'Germanwings','','Amsterdam (AMS)','Barcelona (BCN)','','2017-02-18','14:25:34','2017-02-19','16:20:35','1 h 55',120.00,1,'2017-02-17 09:38:35','2017-02-17 09:38:35'),(18,11,'2',5,'Vueling','','Barcelona (BCN)','Amsterdam (AMS)','','2017-02-27','05:10:00','2017-02-28','02:10:00','21 h 00',150.00,1,'2017-02-17 09:38:35','2017-02-17 09:38:35'),(19,12,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 19:40:30','2017-03-05 19:40:30'),(20,12,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 19:40:30','2017-03-05 19:40:30'),(21,13,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 20:27:47','2017-03-05 20:27:47'),(22,13,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 20:27:47','2017-03-05 20:27:47'),(23,14,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 20:31:53','2017-03-05 20:31:53'),(24,14,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 20:31:53','2017-03-05 20:31:53'),(25,15,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 20:40:43','2017-03-05 20:40:43'),(26,15,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 20:40:43','2017-03-05 20:40:43'),(27,16,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 21:09:45','2017-03-05 21:09:45'),(28,16,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 21:09:45','2017-03-05 21:09:45'),(29,17,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 21:22:52','2017-03-05 21:22:52'),(30,17,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 21:22:52','2017-03-05 21:22:52'),(31,18,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 21:23:32','2017-03-05 21:23:32'),(32,18,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 21:23:32','2017-03-05 21:23:32'),(33,19,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-05 21:28:08','2017-03-05 21:28:08'),(34,19,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-20','14:35:22','2017-03-20','16:25:22','1 h 50',75.00,1,'2017-03-05 21:28:08','2017-03-05 21:28:08'),(35,20,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-09 21:21:30','2017-03-09 21:21:30'),(36,20,'2',3,'Germanwings','','Barcelona (BCN)','Dusseldorf (Weeze) (NRN)','','2017-03-20','18:30:23','2017-03-20','18:55:23','0 h 25',25.00,1,'2017-03-09 21:21:30','2017-03-09 21:21:30'),(37,21,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-09 21:23:16','2017-03-09 21:23:16'),(38,21,'2',3,'Germanwings','','Barcelona (BCN)','Dusseldorf (Weeze) (NRN)','','2017-03-20','18:30:23','2017-03-20','18:55:23','0 h 25',25.00,1,'2017-03-09 21:23:16','2017-03-09 21:23:16'),(39,22,'1',2,'easyJet','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','','2017-03-17','18:30:34','2017-03-17','15:55:34','2 h 35',50.00,1,'2017-03-10 12:05:08','2017-03-10 12:05:08'),(40,22,'2',3,'Germanwings','','Barcelona (BCN)','Dusseldorf (Weeze) (NRN)','','2017-03-20','18:30:23','2017-03-20','18:55:23','0 h 25',25.00,1,'2017-03-10 12:05:08','2017-03-10 12:05:08'),(41,23,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-03-24','18:05:18','2017-03-24','18:05:29','0 h 00',140.00,1,'2017-03-21 19:11:03','2017-03-21 19:11:03'),(42,23,'2',1,'transavia','','Barcelona (BCN)','Amsterdam (AMS)','','2017-03-26','14:35:22','2017-03-26','16:25:22','1 h 50',75.00,1,'2017-03-21 19:11:03','2017-03-21 19:11:03'),(43,24,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-05-06','12:00:57','2017-05-06','14:00:57','2 h 00',60.00,1,'2017-03-29 09:46:06','2017-03-29 09:46:06'),(44,24,'2',3,'Germanwings','','Barcelona (BCN)','Amsterdam (AMS)','','2017-05-08','14:00:23','2017-05-08','14:00:23','0 h 00',50.00,1,'2017-03-29 09:46:06','2017-03-29 09:46:06'),(45,27,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-05-06','12:00:57','2017-05-06','14:00:57','2 h 00',60.00,1,'2017-03-29 09:54:15','2017-03-29 09:54:15'),(46,27,'2',3,'Germanwings','','Barcelona (BCN)','Amsterdam (AMS)','','2017-05-08','14:00:23','2017-05-08','14:00:23','0 h 00',50.00,1,'2017-03-29 09:54:15','2017-03-29 09:54:15'),(47,28,'1',1,'transavia','','Amsterdam (AMS)','Barcelona (BCN)','','2017-05-06','12:00:57','2017-05-06','14:00:57','2 h 00',60.00,2,'2017-03-29 09:56:42','2017-03-29 09:56:42'),(48,28,'2',3,'Germanwings','','Barcelona (BCN)','Amsterdam (AMS)','','2017-05-08','14:00:23','2017-05-08','14:00:23','0 h 00',50.00,2,'2017-03-29 09:56:42','2017-03-29 09:56:42'),(49,1,'1',5,'Vueling','','Amsterdam (AMS)','Barcelona (BCN)','\"','2017-05-06','21:50:00','2017-05-07','00:00:00','2 h 20',45.00,1,'2017-04-03 13:34:50','2017-04-03 13:34:50'),(50,1,'2',1,'transavia','','Barcelona (Girona) (GRO)','Amsterdam (AMS)','\"','2017-05-11','08:55:00','2017-05-11','00:00:00','2 h 10',50.00,1,'2017-04-03 13:34:50','2017-04-03 13:34:50'),(51,2,'1',6,'Ryanair','','Dusseldorf (Weeze) (NRN)','Barcelona (BCN)','\"','2017-04-26','06:30:00','2017-04-26','00:00:00','6 h 30',10.00,1,'2017-04-20 21:20:27','2017-04-20 21:20:27'),(52,2,'2',6,'Ryanair','','Barcelona (BCN)','Dusseldorf (Weeze) (NRN)','\"','2017-04-29','14:00:00','2017-04-29','00:00:00','14 h 00',10.00,1,'2017-04-20 21:20:27','2017-04-20 21:20:27');
/*!40000 ALTER TABLE `orders_flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_match`
--

DROP TABLE IF EXISTS `orders_match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_match` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `matches_id` int(11) NOT NULL,
  `seat_type` int(11) NOT NULL COMMENT 'to know the seat type. Table reference is competition_seatings',
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tournament` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stadium` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_club` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `away_club` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `match_date` datetime NOT NULL,
  `seating_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_match`
--

LOCK TABLES `orders_match` WRITE;
/*!40000 ALTER TABLE `orders_match` DISABLE KEYS */;
INSERT INTO `orders_match` VALUES (1,1,1,0,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2016-10-13 09:30:29','Gold',100.00,1,'2016-10-06 02:36:53','2016-10-06 02:36:53'),(2,2,1,0,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2016-10-13 09:30:29','Gold',100.00,1,'2016-10-06 04:09:55','2016-10-06 04:09:55'),(3,3,1,0,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2016-10-13 09:30:29','Gold',100.00,2,'2016-10-07 13:34:57','2016-10-07 13:34:57'),(4,4,1,0,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2016-10-28 10:30:29','Gold',100.00,1,'2016-10-12 09:44:48','2016-10-12 09:44:48'),(5,5,2,5,'Spain','Barcelona','President Gold Cup','Camp Nou','Gent','Barcelona','2016-12-15 17:30:16','Gold',120.00,3,'2016-12-08 10:53:46','2016-12-08 10:53:46'),(6,6,1,2,'Spain','Barcelona','Copa América 2016 - Brazil (Brazil)','Camp Nou','Barcelona','Gent','2017-01-29 10:30:56','Gold',100.00,2,'2017-01-10 04:53:32','2017-01-10 04:53:32'),(7,7,1,2,'Spain','Barcelona','Copa América 2016 - Brazil (Brazil)','Camp Nou','Barcelona','Gent','2017-01-29 10:30:56','Gold',100.00,1,'2017-01-10 04:55:39','2017-01-10 04:55:39'),(8,8,1,3,'Spain','Barcelona','Copa América 2016 - Brazil (Brazil)','Camp Nou','Barcelona','Gent','2017-01-29 10:30:56','Silver',80.00,1,'2017-01-10 15:22:49','2017-01-10 15:22:49'),(9,9,2,4,'Spain','Barcelona','President Gold Cup','Camp Nou','Gent','Barcelona','2017-02-10 09:30:16','Platinum',100.00,1,'2017-01-10 15:30:00','2017-01-10 15:30:00'),(10,10,2,4,'Spain','Barcelona','President Gold Cup','Camp Nou','Gent','Barcelona','2017-02-20 09:30:16','Platinum',100.00,3,'2017-02-08 10:55:37','2017-02-08 10:55:37'),(11,11,3,7,'Spain','Barcelona','Copa América 2016 - Brazil (Brazil)','Camp Nou','Barcelona','Gent','2017-02-25 10:05:42','Gold',55.00,1,'2017-02-17 09:38:35','2017-02-17 09:38:35'),(12,12,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 19:40:30','2017-03-05 19:40:30'),(13,13,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 20:27:47','2017-03-05 20:27:47'),(14,14,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 20:31:53','2017-03-05 20:31:53'),(15,15,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 20:40:43','2017-03-05 20:40:43'),(16,16,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 21:09:45','2017-03-05 21:09:45'),(17,17,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 21:22:52','2017-03-05 21:22:52'),(18,18,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 21:23:32','2017-03-05 21:23:32'),(19,19,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-05 21:28:08','2017-03-05 21:28:08'),(20,20,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-09 21:21:30','2017-03-09 21:21:30'),(21,21,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-09 21:23:16','2017-03-09 21:23:16'),(22,22,4,3,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-19 21:30:48','Silver',80.00,1,'2017-03-10 12:05:08','2017-03-10 12:05:08'),(23,23,3,7,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','Gent','2017-03-25 21:00:12','Gold',55.00,1,'2017-03-21 19:11:03','2017-03-21 19:11:03'),(24,24,5,13,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','AC Milan','2017-05-07 20:30:06','Categorie 2',60.00,1,'2017-03-29 09:46:06','2017-03-29 09:46:06'),(25,27,5,13,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','AC Milan','2017-05-07 20:30:06','Categorie 2',60.00,1,'2017-03-29 09:54:15','2017-03-29 09:54:15'),(26,28,5,13,'Spain','Barcelona','President Gold Cup','Camp Nou','Barcelona','AC Milan','2017-05-07 20:30:06','Categorie 2',60.00,2,'2017-03-29 09:56:42','2017-03-29 09:56:42'),(27,1,1,15,'Spain','Barcelona','La Liga','Camp Nou','Barcelona','AC Milan','2017-05-10 16:10:46','Categorie 2',70.00,1,'2017-04-03 13:34:50','2017-04-03 13:34:50'),(28,2,3,18,'Spain','Barcelona','La Liga','Camp Nou','Barcelona','Gent','2017-04-28 21:10:00','Categorie 1',100.00,1,'2017-04-20 21:20:27','2017-04-20 21:20:27');
/*!40000 ALTER TABLE `orders_match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_options`
--

DROP TABLE IF EXISTS `orders_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_options`
--

LOCK TABLES `orders_options` WRITE;
/*!40000 ALTER TABLE `orders_options` DISABLE KEYS */;
INSERT INTO `orders_options` VALUES (1,6,1,'Suitcase','extra suitcase',25.00,2,'2017-01-10 04:53:32','2017-01-10 04:53:32'),(2,6,2,'Stadium tour','Tour around the facility',20.00,2,'2017-01-10 04:53:32','2017-01-10 04:53:32'),(3,7,1,'Suitcase','extra suitcase',25.00,2,'2017-01-10 04:55:39','2017-01-10 04:55:39'),(4,7,2,'Stadium tour','Tour around the facility',20.00,2,'2017-01-10 04:55:39','2017-01-10 04:55:39'),(5,8,1,'Suitcase','extra suitcase',25.00,1,'2017-01-10 15:22:49','2017-01-10 15:22:49'),(6,8,2,'Stadium tour','Tour around the facility',20.00,1,'2017-01-10 15:22:49','2017-01-10 15:22:49'),(7,10,1,'Suitcase','extra suitcase',25.00,4,'2017-02-08 10:55:37','2017-02-08 10:55:37'),(8,10,2,'Stadium tour','Tour around the facility',20.00,5,'2017-02-08 10:55:37','2017-02-08 10:55:37'),(9,24,1,'Suitcase','extra suitcase',25.00,1,'2017-03-29 09:46:06','2017-03-29 09:46:06');
/*!40000 ALTER TABLE `orders_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES (1,'Pending','2017-04-03 13:03:45','2017-04-03 13:03:45'),(2,'Processing','2017-04-03 13:03:45','2017-04-03 13:03:45'),(3,'Completed','2017-04-03 13:03:45','2017-04-03 13:03:45');
/*!40000 ALTER TABLE `orders_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_tickets`
--

DROP TABLE IF EXISTS `orders_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `ticket_type_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_tickets`
--

LOCK TABLES `orders_tickets` WRITE;
/*!40000 ALTER TABLE `orders_tickets` DISABLE KEYS */;
INSERT INTO `orders_tickets` VALUES (1,1,1,'1mPOnN58e24fffbef8eefa593b733930dc21e7c930af82f9898474258fc21475ryNOJQJVja.pdf','2017-04-03 13:37:03','2017-04-03 13:37:03');
/*!40000 ALTER TABLE `orders_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_status`
--

DROP TABLE IF EXISTS `payment_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_status`
--

LOCK TABLES `payment_status` WRITE;
/*!40000 ALTER TABLE `payment_status` DISABLE KEYS */;
INSERT INTO `payment_status` VALUES (1,'Paid','Someone requested money from you and you sent them a payment. ','2017-04-03 13:03:45','2017-04-03 13:03:45'),(2,'Failed','Your payment didn\'t go through. We recommend that you try your payment again.','2017-04-03 13:03:45','2017-04-03 13:03:45'),(3,'Cancelled','You canceled your payment, and the money was credited back to your account.','2017-04-03 13:03:45','2017-04-03 13:03:45'),(4,'Processing','We\'re processing your payment and the transaction should be completed shortly.','2017-04-03 13:03:45','2017-04-03 13:03:45'),(5,'Refunded','The recipient returned your payment. If you used a credit card to make your payment, the money will be returned to your credit card. It can take up to 30 days for the refund to appear on your statement.','2017-04-03 13:03:45','2017-04-03 13:03:45'),(6,'Refused','The recipient didn\'t receive your payment. If you still want to make your payment, we recommend that you try again.','2017-04-03 13:03:45','2017-04-03 13:03:45'),(7,'Pending','The payment is pending. See pending_reason for more information.','2017-04-03 13:03:45','2017-04-03 13:03:45'),(8,'Denied','You denied the payment. This happens only if the payment was previously pending because of possible reasons described for the pending_reason variable or the Fraud_Management_Filters_x variable.','2017-04-03 13:03:45','2017-04-03 13:03:45'),(9,'Did not Started','Just Placed the order. Did not start the payment.','2017-04-03 13:03:45','2017-04-03 13:03:45');
/*!40000 ALTER TABLE `payment_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `received_on` date NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persistences`
--

DROP TABLE IF EXISTS `persistences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persistences`
--

LOCK TABLES `persistences` WRITE;
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
INSERT INTO `persistences` VALUES (1,1,'vxi6ncdI9LBKJ5oOnRhTUBdr8fDFvJjB','2016-06-20 06:58:03','2016-06-20 06:58:03'),(2,2,'fjUdqLvJDAnSz6JNCy0ZjmyBrc6utBy5','2016-06-20 07:16:24','2016-06-20 07:16:24'),(5,2,'5EpHR5SEbfxc5SrEylLpvjHN96ZEUZ5u','2016-06-20 12:13:59','2016-06-20 12:13:59'),(6,3,'jlUWochgAySviGzeqBIqTJZTdtsiGNTA','2016-06-20 12:17:57','2016-06-20 12:17:57'),(7,3,'SP5RYvB48WQfDHVss6tQx51QYqcfKqiw','2016-06-20 13:50:47','2016-06-20 13:50:47'),(8,3,'DuTt8EC3kSh1yM8m6Movmd8QDr33oFzT','2016-06-21 10:36:11','2016-06-21 10:36:11'),(11,4,'KEAyrCVxbdxIigmmApQzZ8qmtc9O11QY','2016-06-28 14:09:11','2016-06-28 14:09:11'),(12,4,'ftGWfEhdV9hoSAIvHROJaoQXruKm6jtg','2016-06-29 04:46:02','2016-06-29 04:46:02'),(14,4,'I9FCXO4RlP1dTltyFcrRl24AJIpweWxI','2016-07-04 07:17:22','2016-07-04 07:17:22'),(15,4,'2dhTkhjE8TPtqJ5i1z4UBbEvudWiUaMY','2016-07-04 07:18:38','2016-07-04 07:18:38'),(16,4,'5bMjntspLnRTTvf8iMsB92F3tsPsENPg','2016-07-04 09:07:00','2016-07-04 09:07:00'),(17,4,'2RkakxYSogdPZNrFp7nDuMho25ULJKp3','2016-07-04 09:16:58','2016-07-04 09:16:58'),(18,4,'BJA8CLQGcmfV99kIwh4c3tPvkh8yUeVE','2016-07-13 04:40:27','2016-07-13 04:40:27'),(19,4,'t2xC5RJYZmnRl9lPtNsjWEBSYzDejTRT','2016-07-17 08:54:02','2016-07-17 08:54:02'),(20,4,'CwK37S9yC7xl0hnQOqrkUGsxPuSGGj9b','2016-07-19 10:03:44','2016-07-19 10:03:44'),(21,3,'tGs92plkgVQe7UWEuPsk7GA0ztoB1Ktk','2016-07-25 10:19:30','2016-07-25 10:19:30'),(22,3,'h6VAjmW8H2MiSRW3AliAt13Anoq9jLFc','2016-07-26 07:48:49','2016-07-26 07:48:49'),(23,4,'P4ATWW0LoKAy1e1RxTeZ6ztIGLbvDDk3','2016-07-26 11:31:47','2016-07-26 11:31:47'),(24,3,'TGjIsiTjpjSQdKQLu8HcOQ2gLqFoQ4jr','2016-08-01 06:54:06','2016-08-01 06:54:06'),(25,4,'CFVBvEyh6i95Xx81lVdMsJjoY4D2Ra5H','2016-08-01 18:08:38','2016-08-01 18:08:38'),(26,3,'KgvQ5gqQCzz6Su5wdUxNFSCUSYD9rtCZ','2016-08-02 07:31:47','2016-08-02 07:31:47'),(27,4,'alTaRLiHaMdCMEwb6SSnjoYydmQvVvbB','2016-08-06 09:36:42','2016-08-06 09:36:42'),(28,3,'sIdeJwWcxY6TCcIndaF385Maf8fgZ4Di','2016-08-08 07:44:14','2016-08-08 07:44:14'),(29,4,'yXIzQiQ2f6xP1cIoQyk0FCc9z3k5qP3z','2016-08-09 11:16:55','2016-08-09 11:16:55'),(30,3,'JMmR5Wi1EQffxVOeTUrZrcX3jxYu2P7X','2016-08-09 12:51:50','2016-08-09 12:51:50'),(31,4,'oXCUlmsfVkciz6JahQ5AGqN0FNP1MDJn','2016-08-09 13:23:51','2016-08-09 13:23:51'),(32,3,'ThQfqtbRFJuG8VXAFF3LmtSQ7lAkv6wo','2016-08-22 07:27:21','2016-08-22 07:27:21'),(33,4,'tZL36COekiLFsTfExZ4h4nXwjEHHOjkj','2016-08-22 08:21:30','2016-08-22 08:21:30'),(34,3,'3ydIBB9KcF4G0dw1WAKm3gKrWjoxb7lC','2016-08-26 05:59:52','2016-08-26 05:59:52'),(35,3,'YwXMTzxvWVHsVkBHZCJIUY2a4tsBJxuX','2016-08-26 06:01:19','2016-08-26 06:01:19'),(36,3,'B5yBGsg0AZgG6DEBW4uD8aNYcIVjFo0c','2016-08-29 07:51:49','2016-08-29 07:51:49'),(37,3,'JI3S7dfxrXG9pmChYLFdu4aCYJ62wmsn','2016-08-29 09:12:13','2016-08-29 09:12:13'),(38,3,'6Hq9CdxIbnsxdJaav8BE8kFVBvmoHMrj','2016-08-29 16:44:35','2016-08-29 16:44:35'),(39,3,'GwiWrLC1EIPsCzRF0yzvyLKafX3Yl13f','2016-08-30 08:01:04','2016-08-30 08:01:04'),(40,3,'xyWDWydkWvHowz8sFttH6Yz8rcxahfEf','2016-08-30 08:30:30','2016-08-30 08:30:30'),(41,4,'kqXKsrHYFKXFLF0FwxXG8j7nV53tBtW9','2016-09-05 08:05:09','2016-09-05 08:05:09'),(42,3,'r7M4KGkSSMwLreP56X0Onl2oGU4uxLbK','2016-09-05 12:55:26','2016-09-05 12:55:26'),(43,4,'vgr5s37xikojLPoZ9FAfnZDCL1oY5x5X','2016-09-05 14:10:40','2016-09-05 14:10:40'),(44,4,'gPkPKu4FtkzeeXj6H8zlsrnXty2xxsK6','2016-09-06 12:59:28','2016-09-06 12:59:28'),(45,4,'EvxLNuklwvmz9g4LoAM9J9ItphGoK1mU','2016-09-06 13:12:12','2016-09-06 13:12:12'),(46,4,'p3B3tZxxJsRPNWe5NFCqe5DMPGDyVBL3','2016-09-13 06:39:49','2016-09-13 06:39:49'),(47,4,'FgJ36sMOF8aSQu4x9EqWPk0alHZW73Nz','2016-09-26 14:08:53','2016-09-26 14:08:53'),(48,4,'gDb4GtVvs6HO1CAGHkXhOfeOaWWYFBuc','2016-09-26 14:59:40','2016-09-26 14:59:40'),(49,3,'0iSiLzfCAdHjiNCWfHMKImnD13j8W5yi','2016-09-27 05:40:52','2016-09-27 05:40:52'),(50,4,'z3oYB1a3Xtbgk5GATEGJf5DAaLStcrev','2016-09-27 06:03:43','2016-09-27 06:03:43'),(51,3,'dNnrjU0XVEdnXVHjsKpsPKHiIGK8xagO','2016-09-27 10:04:48','2016-09-27 10:04:48'),(52,4,'JF0bzIeZmrJzXGyIDRaHN9ozfVX0DrAD','2016-09-27 18:12:39','2016-09-27 18:12:39'),(54,3,'RXduxVk02GaTbJABbw5mU1twOICoEaQY','2016-09-28 03:01:56','2016-09-28 03:01:56'),(55,3,'14MFREg8h2M0en1viRYGSV4UHfKzi7x7','2016-09-29 11:32:08','2016-09-29 11:32:08'),(56,3,'Y42EzbUXtFJJUqWKPxMY82KGzsWgOnTj','2016-09-30 03:49:53','2016-09-30 03:49:53'),(58,3,'5Gejl1RIp6sRAe8DSz7SCOHnPvQ2AVEM','2016-10-03 04:57:18','2016-10-03 04:57:18'),(59,4,'lxEFsFGj6jdmlc92BTL25L1Bnukzh5Bj','2016-10-03 07:07:28','2016-10-03 07:07:28'),(60,3,'68l7dCCVINxVIoRMhMJZZmHGo7xXGkBs','2016-10-03 07:52:29','2016-10-03 07:52:29'),(61,3,'btGYvNMaSRn9ZFyoCQF1W6wicgDO2Fgi','2016-10-03 08:47:38','2016-10-03 08:47:38'),(62,3,'yuQHwo8Y1FohSPf9rtHJpdQVlbpOK41b','2016-10-03 12:12:15','2016-10-03 12:12:15'),(63,3,'RN3kJCEl6JvGDJKZixWeeobZERQXYHte','2016-10-04 06:05:53','2016-10-04 06:05:53'),(65,3,'XhZau8VxKnLKwJutVFiiZcUnhNWGw0oX','2016-10-04 10:16:36','2016-10-04 10:16:36'),(66,4,'IQKsq2SSapphfyXS2pCBbax4dnNkhX04','2016-10-04 13:59:28','2016-10-04 13:59:28'),(67,3,'tBl9KZT0DaBghEYhtI9dsGibl9T7SUjf','2016-10-04 14:11:18','2016-10-04 14:11:18'),(68,3,'iMTygr0cC9I85e4omvloD1XBqPt4RE8x','2016-10-05 04:56:09','2016-10-05 04:56:09'),(69,3,'ce9E8vPlp4qMhPln7IjAxQD7w6X7GKwF','2016-10-05 09:28:57','2016-10-05 09:28:57'),(70,3,'3OhFsRQwMIl2hxNuhRoxUXMVfSnVUgYZ','2016-10-05 15:07:10','2016-10-05 15:07:10'),(71,4,'iO3bnoF7tGMBf0qqRetVLSOmHQOtAtpm','2016-10-05 19:52:27','2016-10-05 19:52:27'),(72,5,'02Oi5laZA39uRPlxBd0eliaCLRCzvIMf','2016-10-06 02:36:44','2016-10-06 02:36:44'),(73,3,'aKC3Snt1z6YezOJq8GEM4jR0BA3yA1Fv','2016-10-06 04:10:37','2016-10-06 04:10:37'),(74,3,'yGaIo0Bf0lvgunnuETzp2wdNpPdCtz8W','2016-10-06 13:49:09','2016-10-06 13:49:09'),(75,4,'BBL6MeNhRnz5pfLOw8f3Xi6EYXG29kQc','2016-10-07 13:02:37','2016-10-07 13:02:37'),(76,4,'nJmUe3CyB2ycliLD05PRTUCg6CRd0D2J','2016-10-10 13:13:06','2016-10-10 13:13:06'),(77,3,'todQNspxZObv1ekuBdE82mF5D02YAJS8','2016-10-12 04:20:11','2016-10-12 04:20:11'),(78,5,'O6Jxgtf52BDTKzBw35bFtZ7S9fXoGdJM','2016-10-12 09:44:45','2016-10-12 09:44:45'),(79,4,'OqJM0ZTtEqPjbwPlzxlovObAS4l3uiJh','2016-10-12 09:48:22','2016-10-12 09:48:22'),(80,4,'gcaCdSijTJkiwHM5MCDvZg6VDaaDVktk','2016-10-12 12:36:15','2016-10-12 12:36:15'),(81,4,'gVOOn1b6UZ98xgiOQjYK2GfTGxCsW0Cz','2016-10-17 10:35:56','2016-10-17 10:35:56'),(82,4,'lPoCZTHfXzq4RwQL6QjAgUrb6uC8MbrK','2016-10-25 09:12:10','2016-10-25 09:12:10'),(83,3,'x9qnHDHuX5TyRbUHal9PzPBAkn9pcv27','2016-11-07 07:58:24','2016-11-07 07:58:24'),(84,3,'oxcIxRaI2DhFoGuipavojoOKaSBCZKmi','2016-11-07 08:01:06','2016-11-07 08:01:06'),(85,3,'EwC9pOG6APFnDraf6uAG0r1IhUHUBwDi','2016-11-09 03:58:22','2016-11-09 03:58:22'),(86,3,'536oGVaCYoEG6RpmWvskHux61l8bP7JB','2016-11-09 03:59:38','2016-11-09 03:59:38'),(87,4,'tK454NfqX9ZAtmc5YNMiQEPfU4TTV8Qd','2016-11-21 11:40:18','2016-11-21 11:40:18'),(88,4,'PzHN5ulOI9sPdX2eqH6WsNOJQ52ISLEJ','2016-11-21 15:23:37','2016-11-21 15:23:37'),(89,3,'ccDPPWgMIPlJZlv0XJ1dCzzeln9FXQJV','2016-11-22 10:17:37','2016-11-22 10:17:37'),(90,4,'L8sCT5Rb9aOk4z1WjcMqeqCf8P9XUc5v','2016-12-07 13:54:36','2016-12-07 13:54:36'),(91,4,'NsU0mkIzkWfEIlzdZX2xFnx8tWWvpRqw','2016-12-07 14:21:51','2016-12-07 14:21:51'),(93,3,'ZaSUW3sMip4aRzOuWTG5dd1dZDmPA02H','2016-12-08 10:41:35','2016-12-08 10:41:35'),(94,5,'Z9EPlGYTcuIoUcnTWoqts4Aq28VLGby5','2016-12-08 10:53:43','2016-12-08 10:53:43'),(95,4,'BkdYGWfcbnYeUaeriTM1XJN2NOw0mE33','2016-12-09 13:57:12','2016-12-09 13:57:12'),(96,4,'BqlaDVFX7yugLa1X34hDWzSjd0hoVAUG','2016-12-13 11:36:07','2016-12-13 11:36:07'),(97,3,'XVylAI5qNRwb8ZFU2MdtsJUl9wkxiLLK','2016-12-15 05:13:36','2016-12-15 05:13:36'),(98,4,'16QgnMSs1zqeubSDsVmHlONyiIAPxmuv','2016-12-19 14:25:37','2016-12-19 14:25:37'),(99,4,'kR8INhPLxshOL58YALCy2AMlCVAYcz98','2016-12-19 15:30:52','2016-12-19 15:30:52'),(100,4,'bLZd3nTJEl7iQ9fKrKZejkr0kUvTQCaE','2016-12-20 08:31:05','2016-12-20 08:31:05'),(101,3,'TTvChjVkHOiMY6A3mENE5U4JUbF2BgWB','2016-12-29 08:46:01','2016-12-29 08:46:01'),(102,3,'kGVcDdVh9KEumcSLUnZhcscMF1iXpEk1','2016-12-29 08:47:30','2016-12-29 08:47:30'),(103,4,'sPkvOjpuyCQ683jjsPnFeD6RaXu67o6s','2016-12-31 08:46:04','2016-12-31 08:46:04'),(104,4,'8tS6zKtUQ4sCPDfSw1yQ8IU06oxXh2vx','2017-01-03 12:23:55','2017-01-03 12:23:55'),(105,3,'BAP8yP5iHVLxNFOVK4rqbMk59MP0YfCg','2017-01-10 03:21:25','2017-01-10 03:21:25'),(106,5,'Objqbx4DEqpgjKEOulO4HjiWjaveYBhY','2017-01-10 04:53:25','2017-01-10 04:53:25'),(107,3,'ahQX8XBEmZb20qT6a1u76c9BtjXLMSgz','2017-01-10 06:48:05','2017-01-10 06:48:05'),(108,3,'D3G7f67D9hmkT9V7V1OwveMx8us28Rih','2017-01-10 15:12:41','2017-01-10 15:12:41'),(109,5,'sYLOw6t4yBY0pZmmqJR6dJkTSbQbK10v','2017-01-10 15:22:43','2017-01-10 15:22:43'),(110,3,'XgnxDCZhcLCP3ICH1MADlrPJ4GdVw29Z','2017-01-11 02:28:00','2017-01-11 02:28:00'),(112,1,'UosJdUXdMIbNw4GtOXedtzw26EiB9AFq','2017-01-29 21:16:09','2017-01-29 21:16:09'),(113,3,'V47KkGrwlcqrjbfVcXr96VFOkQt5E0Hn','2017-02-02 11:11:22','2017-02-02 11:11:22'),(114,3,'SqHMc101RItA2yiN4xjXxWsgi1v78NDD','2017-02-02 16:18:06','2017-02-02 16:18:06'),(115,3,'a92rvBFgtSdAWJznxuXUiXgrQDDwyPYt','2017-02-08 10:51:44','2017-02-08 10:51:44'),(116,5,'tRESLM0fC3VhSDdFEiWGAX99eHPQy6Wn','2017-02-08 10:55:33','2017-02-08 10:55:33'),(117,1,'naOD34XjjUUbSt93999BazU7zNZdx5TL','2017-02-13 15:41:45','2017-02-13 15:41:45'),(118,1,'M7OFOTyZmtW9qnp34lRaeA3vdNQTh7na','2017-02-17 09:11:17','2017-02-17 09:11:17'),(119,7,'bd27JXw2yKFiShJ28Wq1UDqldc9Cn0Sw','2017-02-17 09:14:47','2017-02-17 09:14:47'),(120,7,'pDj631cnWIowSYfDOiTYgMaBZUZq4AEm','2017-02-17 09:15:40','2017-02-17 09:15:40'),(121,7,'xi1kyLTCUQUmuIb0WaAZl0sUgByIAiVb','2017-02-22 17:54:25','2017-02-22 17:54:25'),(122,7,'MsRwFelCjdUbwBvD6r9unv91joGjuRhY','2017-02-22 20:21:40','2017-02-22 20:21:40'),(123,1,'T1fJTXmwfVS26wU07kQPPkuItCBJwVZN','2017-02-28 22:47:13','2017-02-28 22:47:13'),(124,7,'yBHxnyAeu0VUUY4cx2ExJrIFoq65Tor6','2017-02-28 22:52:08','2017-02-28 22:52:08'),(125,7,'9lCwGX1Lzxyo34prsdrkm0DN9fq8826L','2017-03-01 08:59:48','2017-03-01 08:59:48'),(126,5,'xzSohxWIcYNi2F2WwdPWZfa1Ic6CaW6X','2017-03-01 09:02:57','2017-03-01 09:02:57'),(127,7,'qUaYpHyz50L7If54FoveOm4lkKIHReXm','2017-03-01 09:35:06','2017-03-01 09:35:06'),(128,3,'OiNjPS9TTKDM1gGtdYhTFstZtxxYRCqK','2017-03-02 04:40:51','2017-03-02 04:40:51'),(129,3,'5nR0iopBVspdk2cYKbiqHdU16AGDTaFa','2017-03-02 13:13:37','2017-03-02 13:13:37'),(131,8,'iVLLtcAXBs4OIAsqCIIeU3R4ioHSZWGO','2017-03-05 21:34:51','2017-03-05 21:34:51'),(132,9,'4e0XVxc9jEy8BzdxuZ6dgphjUXR4a14T','2017-03-06 10:20:12','2017-03-06 10:20:12'),(136,3,'TZFY7hDkjKYgYnvvYPh5rKRu7ZNdOmUx','2017-03-08 15:37:28','2017-03-08 15:37:28'),(139,1,'qKtxAfFn6Z16JmbDLA9DnhkutVgboTgK','2017-03-09 19:41:03','2017-03-09 19:41:03'),(140,7,'Sq2zo1f3KGNs0zl4Q8RvG6Waq9uzXdbe','2017-03-09 21:23:07','2017-03-09 21:23:07'),(142,3,'aW30azQXIODvpizgbhOEHSPfCN7sBfrj','2017-03-10 11:01:19','2017-03-10 11:01:19'),(144,7,'yPJ4f1ddfpYM6vyatZskLslZ11N3IqCA','2017-03-10 12:09:08','2017-03-10 12:09:08'),(145,1,'R1qYFBusJ6i1A4lm9asdtvvjHNhhFoSx','2017-03-21 18:53:59','2017-03-21 18:53:59'),(150,7,'Of0VErtsTZhu60LxWMh23QlCBh0n9MUt','2017-03-29 12:00:42','2017-03-29 12:00:42'),(152,7,'7QFqc1XaXKDtBWgugKMM88itCrSH5P0F','2017-03-31 12:33:17','2017-03-31 12:33:17'),(153,7,'5KxNTlfaJ0JwV3WqVwJQaqv3z0n0f1yW','2017-03-31 14:58:53','2017-03-31 14:58:53'),(154,7,'azaoqadSy0Ie84b1Zp2jpse76SPF6SOW','2017-04-02 15:15:43','2017-04-02 15:15:43'),(155,14,'qpkJrYqTUDRe4aYZzpFJb4w0AAfDluof','2017-04-02 15:19:04','2017-04-02 15:19:04'),(156,13,'Bf3KoTbnf3lQgGzsZs76j4rH0zkMgbFa','2017-04-02 16:42:12','2017-04-02 16:42:12'),(157,14,'w0cnqUabaHRjiE9eOy3qsgARg1GmlfhY','2017-04-02 17:30:57','2017-04-02 17:30:57'),(158,7,'oJNlTr4tIkJ30xxDZdaNfgbnLcq1K7y4','2017-04-02 18:22:17','2017-04-02 18:22:17'),(159,13,'HdoQzk72mCVi392txg5i2bMYCef5g6lF','2017-04-03 03:23:30','2017-04-03 03:23:30'),(160,7,'PDnoeUOAGn6YD9EhhLFwmwT1OujbNCDG','2017-04-03 12:54:57','2017-04-03 12:54:57'),(161,14,'MTyH8r1wUnuv3eB6CVn9hCmaqBJlDVJT','2017-04-03 17:02:13','2017-04-03 17:02:13'),(162,7,'7qyWULTYBcShVQlh9OdvzFlyEjkq6xSs','2017-04-03 18:28:37','2017-04-03 18:28:37'),(164,14,'psYrZf6yninRtGv258RfbazD5CmHefZD','2017-04-04 03:37:04','2017-04-04 03:37:04'),(165,14,'n1JZgsN3qvpm2mgoo7kM9gwAVylTDbJq','2017-04-04 17:51:07','2017-04-04 17:51:07'),(166,7,'8QtVVXO83VFhDqqAmOhMCWBJlQi0vvQb','2017-04-04 19:46:19','2017-04-04 19:46:19'),(167,14,'3TG6mCZZV1jyDKMdRKGCkRlRoHiKvoq3','2017-04-08 12:34:24','2017-04-08 12:34:24'),(168,7,'TMDoibT9dH5DB6UREVMaWiOP9LEeGSz7','2017-04-08 14:43:44','2017-04-08 14:43:44'),(169,14,'rNEAwyNJAyNLHJwkGM2gaU62BOcMUgvA','2017-04-08 17:01:54','2017-04-08 17:01:54'),(170,14,'Uwag7zhK662KDPPifgRCPJLUbxdyOuNO','2017-04-08 17:08:20','2017-04-08 17:08:20'),(171,7,'Dkg2BCQ5i6EG4tIDaERKpHY1cdGTvxLL','2017-04-08 22:20:37','2017-04-08 22:20:37'),(172,14,'PDbYKsfGOU6KnGbjij3jaubE232UP9Hc','2017-04-09 11:25:12','2017-04-09 11:25:12'),(173,7,'J6Nsd2tHY8AdF8dKqe1vg2jCUXBXgFTE','2017-04-09 19:38:39','2017-04-09 19:38:39'),(174,7,'q6DkEsGARHPGFtI1O9ipVFjHElIR9aPv','2017-04-10 09:09:51','2017-04-10 09:09:51'),(176,7,'gdaSszDM7yocsp8TduSCuGxNVZXi4OeU','2017-04-12 20:06:15','2017-04-12 20:06:15'),(177,7,'UaAcY7cO6Db50xW0k3tXyyybGLwC1GYe','2017-04-20 16:21:41','2017-04-20 16:21:41'),(178,7,'sZytzh9acBBcNTIdad4oR1xf64ye9IYd','2017-04-20 19:53:18','2017-04-20 19:53:18'),(180,15,'7JDNBaAow4fJuhWRFumwXMEZgGlxbpQQ','2017-04-20 22:05:44','2017-04-20 22:05:44'),(181,15,'UqhVLz3daTdm2kKPzBie3ZVV8LGbO2Ue','2017-04-21 07:41:15','2017-04-21 07:41:15'),(182,7,'G69NhArwqop8KlaYIUTBtaP3G9dSuSGT','2017-04-21 14:31:11','2017-04-21 14:31:11'),(183,15,'mJvrzdAWMhRBbnp5BXcguTjsE4AirETb','2017-04-21 17:51:31','2017-04-21 17:51:31'),(184,15,'hAYTHJ5MjEnA6Y9i3sMtLC1UlfTsVd0y','2017-04-22 07:55:48','2017-04-22 07:55:48'),(185,7,'Teaz9E7cXwR2blsvldkhYrpVtlSOKzyd','2017-04-23 13:49:30','2017-04-23 13:49:30'),(186,7,'U8GjmhOYposOQFjLlsPh5Xwyz2zL9SIy','2017-04-24 11:17:52','2017-04-24 11:17:52'),(189,17,'Ynfn8BDZsY4KSfDf9wwZ0jqK2afwNZYM','2017-04-25 00:39:04','2017-04-25 00:39:04'),(191,17,'ZPNoQgCDTnBQRbGTpGrNqQeNp11blG9z','2017-04-28 04:09:43','2017-04-28 04:09:43'),(194,17,'rRMGKc4fdPpAt8I0UWBVzjctinimVfdR','2017-04-29 04:20:48','2017-04-29 04:20:48'),(195,7,'LqQ7BssgaIbHGOUvMJnpF5oK8E60XQLu','2017-04-30 15:14:56','2017-04-30 15:14:56'),(196,7,'Lby24rPF5XERQcc6Kr4jNAHmfGxbn6Y8','2017-05-02 13:03:18','2017-05-02 13:03:18'),(197,7,'Eh36JS1THDr3O1keiDsOP02g00vigq9P','2017-05-05 15:00:37','2017-05-05 15:00:37'),(198,7,'J0mi6fNryePljCHCIK6yMYzPxO6gtSJ7','2017-05-08 18:29:21','2017-05-08 18:29:21'),(199,7,'AazXBQdQGDGXc5BxNdHKarwJ4sRVTqgy','2017-05-09 09:39:02','2017-05-09 09:39:02'),(200,7,'Xdk7fixm0DNLValzLVWSZdrLVedZBezq','2017-05-17 10:28:01','2017-05-17 10:28:01'),(201,18,'WHR8keghOUz5DKru6mRx6bXteUSaT0Ss','2017-05-17 10:29:37','2017-05-17 10:29:37'),(202,18,'2ZSNPix1ZslaMaWWeO6umBuKZvLpjQWo','2017-05-17 12:39:36','2017-05-17 12:39:36');
/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `months` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (1,3,'2016-06-28 13:59:35','2016-06-28 13:59:35'),(2,1,'2016-06-20 07:15:45','2016-06-20 07:15:45'),(3,3,'2016-07-25 10:20:58','2016-07-25 10:20:58'),(4,1,'2017-02-13 15:46:38','2017-02-13 15:46:38'),(5,2,'2016-10-06 02:36:44','2016-10-06 02:36:44'),(6,2,'2017-01-29 21:14:56','2017-01-29 21:14:56'),(7,1,'2017-02-17 09:14:12','2017-02-17 09:14:12'),(8,2,'2017-03-05 21:34:51','2017-03-05 21:34:51'),(9,2,'2017-03-06 10:20:12','2017-03-06 10:20:12'),(10,2,'2017-03-10 08:35:15','2017-03-10 08:35:15'),(11,2,'2017-03-10 12:05:05','2017-03-10 12:05:05'),(12,2,'2017-03-29 09:54:08','2017-03-29 09:54:08'),(13,3,'2017-03-31 15:19:33','2017-03-31 15:19:33'),(14,3,'2017-04-02 15:16:17','2017-04-02 15:16:17'),(15,3,'2017-04-20 20:53:57','2017-04-20 20:53:57'),(16,3,'2017-04-23 13:50:19','2017-04-23 13:50:19'),(17,3,'2017-04-24 11:18:58','2017-04-24 11:18:58'),(18,3,'2017-05-17 10:28:52','2017-05-17 10:28:52');
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"admin\":1}','2016-06-20 06:57:02','2016-06-20 06:57:02'),(2,'user','User',NULL,'2016-06-20 06:57:02','2016-06-20 06:57:02'),(3,'superadmin','superadmin',NULL,'2016-06-28 13:59:10','2016-06-28 13:59:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seatingcategories`
--

DROP TABLE IF EXISTS `seatingcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seatingcategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seatingcategories`
--

LOCK TABLES `seatingcategories` WRITE;
/*!40000 ALTER TABLE `seatingcategories` DISABLE KEYS */;
/*!40000 ALTER TABLE `seatingcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seatingcategory`
--

DROP TABLE IF EXISTS `seatingcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seatingcategory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seatingcategory`
--

LOCK TABLES `seatingcategory` WRITE;
/*!40000 ALTER TABLE `seatingcategory` DISABLE KEYS */;
INSERT INTO `seatingcategory` VALUES (2,'Categorie 1','87FF9F','2016-10-05 11:17:08','2017-03-29 09:30:47'),(3,'Categorie 2','78A0FF','2016-10-05 11:17:17','2017-03-29 09:30:22'),(4,'Categorie 3','FAFF66','2016-10-05 11:17:25','2017-03-29 09:30:56');
/*!40000 ALTER TABLE `seatingcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'add_with_base_price','0','add amount with base price','2016-12-29 08:54:01','2017-01-10 04:17:58');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stadia`
--

DROP TABLE IF EXISTS `stadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stadia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stadium` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `nearest_airport` int(11) NOT NULL COMMENT 'to know which airport is nearest to the stadium',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `story` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stadia`
--

LOCK TABLES `stadia` WRITE;
/*!40000 ALTER TABLE `stadia` DISABLE KEYS */;
INSERT INTO `stadia` VALUES (1,'Camp Nou',200,2,2,'6aORB58342b999d64feb2b75a98af9188f231fffeb4381e607fdf30bd677390gLV2zolJzn.gif','image/gif','texans_seating_chart.gif','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\n','2016-10-05 11:15:40','2017-01-10 03:22:55'),(2,'San Siro',107,10,13,'p6WzY58ade263ce24b42e50d90481a92996138c824b508e9ce87e8025c94842Cn8frYf3RJ.jpg','image/jpeg','barcelonavalencia.jpg','dfsdfho','2017-02-22 18:11:31','2017-02-22 22:34:02'),(4,'testing',200,2,4,'3idhN58fb1afd0c6c281845fbaef6565769f47b267fdcc2ebb78c9acdc43500LOqKx6zKC1.jpg','image/jpeg','Wikipedia_us-military-07-02-15.jpg','testing','2017-04-22 08:57:33','2017-04-22 08:57:33');
/*!40000 ALTER TABLE `stadia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggable_taggables`
--

DROP TABLE IF EXISTS `taggable_taggables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taggable_taggables` (
  `tag_id` int(11) NOT NULL,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `taggable_taggables_taggable_id_index` (`taggable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggable_taggables`
--

LOCK TABLES `taggable_taggables` WRITE;
/*!40000 ALTER TABLE `taggable_taggables` DISABLE KEYS */;
/*!40000 ALTER TABLE `taggable_taggables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggable_tags`
--

DROP TABLE IF EXISTS `taggable_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taggable_tags` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `normalized` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggable_tags`
--

LOCK TABLES `taggable_tags` WRITE;
/*!40000 ALTER TABLE `taggable_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `taggable_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_description` text COLLATE utf8_unicode_ci NOT NULL,
  `task_deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `throttle`
--

DROP TABLE IF EXISTS `throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (215,NULL,'global',NULL,'2017-03-29 14:27:36','2017-03-29 14:27:36'),(216,NULL,'ip','127.0.0.1','2017-03-29 14:27:36','2017-03-29 14:27:36'),(217,12,'user',NULL,'2017-03-29 14:27:36','2017-03-29 14:27:36'),(218,NULL,'global',NULL,'2017-03-29 14:28:37','2017-03-29 14:28:37'),(219,NULL,'ip','127.0.0.1','2017-03-29 14:28:37','2017-03-29 14:28:37'),(220,12,'user',NULL,'2017-03-29 14:28:37','2017-03-29 14:28:37'),(221,NULL,'global',NULL,'2017-03-29 14:29:17','2017-03-29 14:29:17'),(222,NULL,'ip','127.0.0.1','2017-03-29 14:29:17','2017-03-29 14:29:17'),(223,12,'user',NULL,'2017-03-29 14:29:17','2017-03-29 14:29:17'),(224,NULL,'global',NULL,'2017-03-29 14:29:33','2017-03-29 14:29:33'),(225,NULL,'ip','127.0.0.1','2017-03-29 14:29:33','2017-03-29 14:29:33'),(226,12,'user',NULL,'2017-03-29 14:29:33','2017-03-29 14:29:33'),(227,NULL,'global',NULL,'2017-04-25 00:38:48','2017-04-25 00:38:48'),(228,NULL,'ip','127.0.0.1','2017-04-25 00:38:48','2017-04-25 00:38:48'),(229,17,'user',NULL,'2017-04-25 00:38:48','2017-04-25 00:38:48'),(230,NULL,'global',NULL,'2017-04-25 00:38:55','2017-04-25 00:38:55'),(231,NULL,'ip','127.0.0.1','2017-04-25 00:38:55','2017-04-25 00:38:55'),(232,17,'user',NULL,'2017-04-25 00:38:55','2017-04-25 00:38:55'),(233,NULL,'global',NULL,'2017-04-25 11:20:04','2017-04-25 11:20:04'),(234,NULL,'ip','127.0.0.1','2017-04-25 11:20:04','2017-04-25 11:20:04'),(235,17,'user',NULL,'2017-04-25 11:20:04','2017-04-25 11:20:04'),(236,NULL,'global',NULL,'2017-04-25 11:20:24','2017-04-25 11:20:24'),(237,NULL,'ip','127.0.0.1','2017-04-25 11:20:24','2017-04-25 11:20:24'),(238,17,'user',NULL,'2017-04-25 11:20:24','2017-04-25 11:20:24'),(239,NULL,'global',NULL,'2017-04-26 10:34:35','2017-04-26 10:34:35'),(240,NULL,'ip','127.0.0.1','2017-04-26 10:34:35','2017-04-26 10:34:35'),(241,17,'user',NULL,'2017-04-26 10:34:35','2017-04-26 10:34:35'),(242,NULL,'global',NULL,'2017-04-26 10:34:46','2017-04-26 10:34:46'),(243,NULL,'ip','127.0.0.1','2017-04-26 10:34:46','2017-04-26 10:34:46'),(244,17,'user',NULL,'2017-04-26 10:34:46','2017-04-26 10:34:46'),(245,NULL,'global',NULL,'2017-04-26 10:35:05','2017-04-26 10:35:05'),(246,NULL,'ip','127.0.0.1','2017-04-26 10:35:05','2017-04-26 10:35:05'),(247,17,'user',NULL,'2017-04-26 10:35:05','2017-04-26 10:35:05'),(248,NULL,'global',NULL,'2017-04-27 09:29:42','2017-04-27 09:29:42'),(249,NULL,'ip','127.0.0.1','2017-04-27 09:29:42','2017-04-27 09:29:42'),(250,17,'user',NULL,'2017-04-27 09:29:42','2017-04-27 09:29:42'),(251,NULL,'global',NULL,'2017-04-27 09:29:51','2017-04-27 09:29:51'),(252,NULL,'ip','127.0.0.1','2017-04-27 09:29:51','2017-04-27 09:29:51'),(253,17,'user',NULL,'2017-04-27 09:29:51','2017-04-27 09:29:51'),(254,NULL,'global',NULL,'2017-04-27 09:30:05','2017-04-27 09:30:05'),(255,NULL,'ip','127.0.0.1','2017-04-27 09:30:05','2017-04-27 09:30:05'),(256,17,'user',NULL,'2017-04-27 09:30:05','2017-04-27 09:30:05'),(257,NULL,'global',NULL,'2017-04-27 09:30:52','2017-04-27 09:30:52'),(258,NULL,'ip','127.0.0.1','2017-04-27 09:30:52','2017-04-27 09:30:52'),(259,17,'user',NULL,'2017-04-27 09:30:52','2017-04-27 09:30:52'),(260,NULL,'global',NULL,'2017-04-28 10:18:24','2017-04-28 10:18:24'),(261,NULL,'ip','127.0.0.1','2017-04-28 10:18:24','2017-04-28 10:18:24'),(262,17,'user',NULL,'2017-04-28 10:18:24','2017-04-28 10:18:24');
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets_type`
--

DROP TABLE IF EXISTS `tickets_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets_type`
--

LOCK TABLES `tickets_type` WRITE;
/*!40000 ALTER TABLE `tickets_type` DISABLE KEYS */;
INSERT INTO `tickets_type` VALUES (1,'Match','2017-04-03 13:03:45','2017-04-03 13:03:45'),(2,'Flight','2017-04-03 13:03:45','2017-04-03 13:03:45'),(3,'Room','2017-04-03 13:03:45','2017-04-03 13:03:45');
/*!40000 ALTER TABLE `tickets_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `story` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL COMMENT 'to know when the tournament will start',
  `end_date` date NOT NULL COMMENT 'to know when the tournament will end',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES (3,'La Liga','sjdfoidshfosdifjo','2017-04-03','2017-06-04','2017-04-03 13:11:33','2017-04-03 13:12:29');
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traveller_information`
--

DROP TABLE IF EXISTS `traveller_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `traveller_information` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `identity_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passport_number` text COLLATE utf8_unicode_ci NOT NULL,
  `passport_validity` date DEFAULT NULL,
  `passport_document` text COLLATE utf8_unicode_ci NOT NULL,
  `is_updated` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'to know whether the user updated the travel information or not. 0 means not updated, 1 means updated successfully',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traveller_information`
--

LOCK TABLES `traveller_information` WRITE;
/*!40000 ALTER TABLE `traveller_information` DISABLE KEYS */;
INSERT INTO `traveller_information` VALUES (29,1,'dfsdf','','','','','2017-04-13','male',0,0,'','',NULL,'','0','2017-04-03 13:34:50','2017-04-03 13:34:50'),(30,2,'paul hoi','','','','','2017-04-12','male',0,0,'','',NULL,'','0','2017-04-20 21:20:27','2017-04-20 21:20:27');
/*!40000 ALTER TABLE `traveller_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kevin@newsourcing.nl','$2y$10$PvoNB5mYwwkqwlisuPOH1eoqV50F5GctO32.XXErmhwcjGw5vglGS',NULL,'2017-03-21 18:53:59','Kevin','Schenkers','2016-06-20 06:57:02','2017-03-21 18:53:59',NULL,'','','1990-08-17',NULL,'','','','',''),(2,'rakesh@mennes.in','$2y$10$ZbFuHBbgP8tmZeq1N2IzguGzDgXUTIiP/jGWbwlOpTipHs1ibfjSy',NULL,'2016-06-20 12:13:59','Rakesh','Rakesh','2016-06-20 07:15:45','2016-06-20 12:13:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'kevinschenkers@gmail.com','$2y$10$we4xyQ.xsQwCQeBkzG3YnuiPyvfSsWz16q4FBMWbfpCbQYRMNhkNe',NULL,'2017-03-10 11:01:19','Kevin','Schenkers','2016-06-20 12:17:50','2017-03-10 11:01:19',NULL,'','','0000-00-00',NULL,'','','','',''),(4,'voetbaltrips@newsourcing.nl','$2y$10$6U6K066v1/004Q0DFS30.OJoPfZV5nCA2JJT25qaWo2fHyMbBsuyC',NULL,'2017-01-03 12:23:55','voetbaltrips','voetbaltrips','2016-06-28 14:08:58','2017-02-17 09:13:10',NULL,'','','1990-08-17','qbqI7os2VU.png','','','','',''),(5,'rajurare65@gmail.com','$2y$10$XoeFy9YeqTbFt1q0Zi0sHugmPZieJLqJLW0QNvwlT6jmljlxoAYju',NULL,'2017-03-08 14:43:07','rakesh','raju','2016-10-06 02:36:44','2017-03-08 14:43:07',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'kevin+1@newsourcing.nl','$2y$10$PvoNB5mYwwkqwlisuPOH1eoqV50F5GctO32.XXErmhwcjGw5vglGS',NULL,'2017-01-29 21:14:56','Kevin','Schenkers','2017-01-29 21:14:56','2017-01-29 21:14:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'paulemsbroek@hotmail.com','$2y$10$wee.axUFE1fTCrVn/Ht1NOWWHx.QQbYWZDzIwNOX5A77gTmMxw7.S',NULL,'2017-05-17 10:28:01','Paul','paul','2017-02-17 09:14:12','2017-05-17 10:28:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'kevin+2@newsourcing.nl','$2y$10$Fh9pMciIGjximbYc//Dh2u1VDlsrdq0cuhVIcJJnXbgRteNIdnIHq',NULL,'2017-03-05 21:34:51','kevin','schenkers','2017-03-05 21:34:51','2017-03-05 21:34:51',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'info@voetbaltrips.com','$2y$10$Lg1/MIR04KHLWqQi8SeVKOoqeD5rRr3H18zOvzkQZMxUvUWSjCF26',NULL,'2017-03-06 10:20:12','Test','Tester','2017-03-06 10:20:12','2017-03-06 10:20:28',NULL,NULL,NULL,'0000-00-00',NULL,'','','','',''),(10,'paulemsbroek@gmail.com','$2y$10$T1.A64aNKF2iYXZaS/MuIev.zIZQ1dgjUsUYzduEYLtuZGfbqyUe2',NULL,'2017-03-10 08:35:15','tester1','testmeneer','2017-03-10 08:35:15','2017-04-02 15:17:27',NULL,'','male','2017-03-15',NULL,'NL','gelderland','groningen','testlaan 12','9718HC'),(11,'dhsjs@hdks.nl','$2y$10$0X15goJHOJbxi.p/zyDr4.3d4oycWT693cP4MzzYh7E2qVAOiEpLK',NULL,'2017-03-10 12:05:05','Fhsksh','Dhsksb','2017-03-10 12:05:05','2017-03-10 12:05:05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'milanbartman@gmail.com','$2y$10$RScqSr2vV3w3/ABDM/80suyeyBUxsS77jn4dhzaUpnbjNsODefGqG',NULL,'2017-03-29 09:54:08','Milan','Bartman','2017-03-29 09:54:08','2017-03-29 09:54:08',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'sovon@voetbaltrips.com','$2y$10$xFsMeqr3xC9Tv5HsHjNz7OEPYqT.tFGyixN4nxopZ8LPo.wd2unMy',NULL,'2017-04-03 03:23:30','Sovon','Saha','2017-03-31 15:19:33','2017-04-03 03:23:30',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'nikpatel@voetbaltrips.com','$2y$10$ZxE0faLJbXRvVM8piRnhyOs3azP7TciBbdo.JmuXYSGtcKGPsSASS',NULL,'2017-04-09 11:25:12','Nik','Patel','2017-04-02 15:16:17','2017-04-09 11:25:12',NULL,'','','2000-01-01',NULL,'','','','',''),(15,'rk7559413@gmail.com','$2y$10$rYNcI2jgZjqoBouL7jEVE.EvY9XHkW9LjmxOM81xdWS6Xoz9Mb.7y',NULL,'2017-04-22 07:55:48','Rohit','Kumar','2017-04-20 20:53:57','2017-04-22 07:55:48',NULL,NULL,NULL,'0000-00-00',NULL,'','','india','',''),(16,'wds@barcaexperience.com','$2y$10$raWaQ0WanbVaefFDGbruJe2tKsPTdyFNpJdVwF/KzntvbQ8mxnjsq',NULL,NULL,'wds','technologies','2017-04-23 13:50:19','2017-04-23 13:50:19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'tekki@barcaexperience.com','$2y$10$TDIhFvMcFTTkkIZ59sbMYe1Evmg6ZgCf6t1uflJhFpSayDC3ndb0a',NULL,'2017-04-29 04:20:48','tekki','websolutions','2017-04-24 11:18:58','2017-04-29 04:20:48',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'oleksii@barcaexperience.com','$2y$10$DvwXXx7t9L0dq/m70t0mo.7ftrP5WRMB4oJQyumu/ifFtBfRYoMqu',NULL,'2017-05-17 12:39:36','oleksii','dovzhenko','2017-05-17 10:28:52','2017-05-17 12:39:36',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_cart`
--

DROP TABLE IF EXISTS `users_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `identifier` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_cart`
--

LOCK TABLES `users_cart` WRITE;
/*!40000 ALTER TABLE `users_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_cart` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-17 13:55:03
