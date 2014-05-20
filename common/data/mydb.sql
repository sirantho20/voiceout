-- MySQL dump 10.13  Distrib 5.6.16, for Win32 (x86)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `mup_company_users`
--
use voiceout;
DROP TABLE IF EXISTS `mup_company_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_company_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(12) NOT NULL,
  `username` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mup_company_users_company_idx` (`company_id`),
  CONSTRAINT `fk_mup_company_users_company` FOREIGN KEY (`company_id`) REFERENCES `voiceout`.`mup_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_company_users`
--

LOCK TABLES `mup_company_users` WRITE;
/*!40000 ALTER TABLE `mup_company_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_company_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_complaint_hashtags`
--

DROP TABLE IF EXISTS `mup_complaint_hashtags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_complaint_hashtags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` int(11) NOT NULL,
  `hashtab` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mup_complaint_hashtags_complaint_idx` (`complaint_id`),
  CONSTRAINT `fk_mup_complaint_hashtags_complaint` FOREIGN KEY (`complaint_id`) REFERENCES `voiceout`.`mup_complaint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_complaint_hashtags`
--

LOCK TABLES `mup_complaint_hashtags` WRITE;
/*!40000 ALTER TABLE `mup_complaint_hashtags` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_complaint_hashtags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_license_pacakges`
--

DROP TABLE IF EXISTS `mup_license_pacakges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_license_pacakges` (
  `id` int(11) NOT NULL,
  `package_name` varchar(45) NOT NULL,
  `number_of_users` int(11) DEFAULT NULL,
  `signup_date` datetime DEFAULT NULL,
  `renewal_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_license_pacakges`
--

LOCK TABLES `mup_license_pacakges` WRITE;
/*!40000 ALTER TABLE `mup_license_pacakges` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_license_pacakges` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-20 16:40:01
