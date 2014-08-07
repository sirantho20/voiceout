-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: voiceout
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.13.10.1

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
-- Table structure for table `mup_audio`
--

DROP TABLE IF EXISTS `mup_audio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_audio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` varchar(12) NOT NULL,
  `link` varchar(100) DEFAULT NULL COMMENT 'combine complaint_id,user_id,datetime',
  PRIMARY KEY (`id`),
  KEY `fk_complaint_audio_idx` (`complaint_id`),
  CONSTRAINT `fk_complaint_audio` FOREIGN KEY (`complaint_id`) REFERENCES `mup_complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_audio`
--

LOCK TABLES `mup_audio` WRITE;
/*!40000 ALTER TABLE `mup_audio` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_audio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_category`
--

DROP TABLE IF EXISTS `mup_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_category`
--

LOCK TABLES `mup_category` WRITE;
/*!40000 ALTER TABLE `mup_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_comment`
--

DROP TABLE IF EXISTS `mup_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` varchar(12) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_type` char(1) NOT NULL COMMENT 'Comment for escalation (E) or ',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_complaint_comment_idx` (`complaint_id`),
  KEY `fk_user_comment_idx` (`user_id`),
  CONSTRAINT `fk_complaint_comment` FOREIGN KEY (`complaint_id`) REFERENCES `mup_complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_comment` FOREIGN KEY (`user_id`) REFERENCES `mup_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_comment`
--

LOCK TABLES `mup_comment` WRITE;
/*!40000 ALTER TABLE `mup_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_company`
--

DROP TABLE IF EXISTS `mup_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(12) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `description` VARCHAR(140) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `confirmed` char(1) NOT NULL DEFAULT 'N' COMMENT 'Status of the company. User added companies must be confirmed before they are made public.',
  `industry_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `is_registered` char(1) NOT NULL DEFAULT 'N' COMMENT 'Is the company registered with us',
  `license_package` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_id_UNIQUE` (`company_id`),
  UNIQUE KEY `company_name_UNIQUE` (`company_name`),
  KEY `fk_company_industry_idx` (`industry_id`),
  KEY `fk_company_category_idx` (`category_id`),
  KEY `fk_mup_company_1_idx` (`license_package`),
  CONSTRAINT `fk_company_category` FOREIGN KEY (`category_id`) REFERENCES `mup_category` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_company_industry` FOREIGN KEY (`industry_id`) REFERENCES `mup_industry` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_mup_company_1` FOREIGN KEY (`license_package`) REFERENCES `mup_license_pacakges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_company`
--

LOCK TABLES `mup_company` WRITE;
/*!40000 ALTER TABLE `mup_company` DISABLE KEYS */;
INSERT INTO `mup_company` VALUES (1,'123123456456','Softcube Limited','Web applications development experts','2014-05-27 19:52:44','2014-05-27 19:52:44','y',NULL,NULL,'softcube','y',NULL);
INSERT INTO `mup_company` VALUES (2,'456456789789','Airtel Ghana','Telecommunication & mobile money services','2014-05-27 19:52:44','2014-05-27 19:52:44','y',NULL,NULL,'airtel-ghana','y',NULL);
INSERT INTO `mup_company` VALUES (3,'789789123123','Vodafone','Telecommunication giant','2014-05-27 19:52:44','2014-05-27 19:52:44','y',NULL,NULL,'vodafone','y',NULL);
INSERT INTO `mup_company` VALUES (4,'987987654654','Electricity Company of Ghana','Utility service provider','2014-05-27 19:52:44','2014-05-27 19:52:44','y',NULL,NULL,'electricity-company-of-ghana','y',NULL);
/*!40000 ALTER TABLE `mup_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_company_details`
--

DROP TABLE IF EXISTS `mup_company_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_company_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(12) NOT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `logo_pic` varchar(45) DEFAULT NULL,
  `wallpaper_pic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_id_UNIQUE` (`company_id`),
  KEY `fk_company_country_idx` (`country_id`),
  CONSTRAINT `fk_company_country` FOREIGN KEY (`country_id`) REFERENCES `mup_country` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_company_details` FOREIGN KEY (`company_id`) REFERENCES `mup_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_company_details`
--

LOCK TABLES `mup_company_details` WRITE;
/*!40000 ALTER TABLE `mup_company_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_company_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_company_users`
--

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
  `password_reset_token` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mup_company_users_company_idx` (`company_id`),
  CONSTRAINT `fk_mup_company_users_company` FOREIGN KEY (`company_id`) REFERENCES `mup_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_company_users`
--

LOCK TABLES `mup_company_users` WRITE;
/*!40000 ALTER TABLE `mup_company_users` DISABLE KEYS */;
INSERT INTO `mup_company_users` VALUES (1,'1','softcube','softcube','limited','aafetsrom@softcube.co','superadmin',NULL,'2014-05-27 19:52:44',NULL,1,NULL,NULL,'active');
/*!40000 ALTER TABLE `mup_company_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_complaint`
--

DROP TABLE IF EXISTS `mup_complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `mup_complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` varchar(12) NOT NULL,
  `company_id` varchar(12) NOT NULL,
  `user_id` varchar(12) NOT NULL COMMENT 'cookie id for guest users\n',
  `cookie_id` varchar(45) DEFAULT NULL COMMENT 'For anonymous users. Cookie id used to track recurring visitors',
  `complaint` varchar(255) NOT NULL,
  `hashtag` varchar(255) DEFAULT NULL,
  `is_private` char(1) NOT NULL DEFAULT 'N',
  `rating` int(1) NOT NULL DEFAULT '1' COMMENT 'Ratings are ranked as follows\n1 - bad\n2 - terrible\n3 - unacceptable',
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `published` char(1) NOT NULL DEFAULT 'Y',
  `has_picture` char(1) NOT NULL DEFAULT 'N',
  `has_audio` char(1) NOT NULL DEFAULT 'N',
  `location` varchar(100) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comp_id_UNIQUE` (`complaint_id`),
  KEY `fk_complaints_user_idx` (`user_id`),
  KEY `fk_complaints_company_idx` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_complaint`
--

LOCK TABLES `mup_complaint` WRITE;
/*!40000 ALTER TABLE `mup_complaint` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_complaint` ENABLE KEYS */;
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
  CONSTRAINT `fk_mup_complaint_hashtags_complaint` FOREIGN KEY (`complaint_id`) REFERENCES `mup_complaint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
-- Table structure for table `mup_country`
--

DROP TABLE IF EXISTS `mup_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(5) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code2` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_country`
--

LOCK TABLES `mup_country` WRITE;
/*!40000 ALTER TABLE `mup_country` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_industry`
--

DROP TABLE IF EXISTS `mup_industry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `industry_name` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_industry`
--

LOCK TABLES `mup_industry` WRITE;
/*!40000 ALTER TABLE `mup_industry` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_industry` ENABLE KEYS */;
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

--
-- Table structure for table `mup_pictures`
--

DROP TABLE IF EXISTS `mup_pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` varchar(12) NOT NULL,
  `link` varchar(100) NOT NULL COMMENT 'complaint id, user id, datetime',
  PRIMARY KEY (`id`),
  KEY `fk_complaint_pictures_idx` (`complaint_id`),
  CONSTRAINT `fk_complaint_pictures` FOREIGN KEY (`complaint_id`) REFERENCES `mup_complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_pictures`
--

LOCK TABLES `mup_pictures` WRITE;
/*!40000 ALTER TABLE `mup_pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_reply`
--

DROP TABLE IF EXISTS `mup_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` varchar(12) NOT NULL,
  `reply` text NOT NULL,
  `date_addded` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `company_id` varchar(12) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `type` CHAR(1) NOT NULL DEFAULT 'R',
  `level` VARCHAR(5) NULL,
  PRIMARY KEY (`id`),
  KEY `fk_company_reply_idx` (`company_id`),
  KEY `fk_complaint_reply_idx` (`complaint_id`),
  KEY `fk_user_reply_idx` (`user_id`),
  CONSTRAINT `fk_company_reply` FOREIGN KEY (`company_id`) REFERENCES `mup_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_complaint_reply` FOREIGN KEY (`complaint_id`) REFERENCES `mup_complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT `fk_user_reply` FOREIGN KEY (`user_id`) REFERENCES `mup_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table `mup_reply`
--

LOCK TABLES `mup_reply` WRITE;
/*!40000 ALTER TABLE `mup_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mup_user`
--

DROP TABLE IF EXISTS `mup_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `username` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_user`
--

LOCK TABLES `mup_user` WRITE;
/*!40000 ALTER TABLE `mup_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `mup_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

--
-- Table structure for table `mup_reply_best`
--
DROP TABLE IF EXISTS `mup_reply_best`;
CREATE TABLE IF NOT EXISTS `mup_reply_best` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` varchar(12) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `complaint_id` (`complaint_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `mup_timeline`;
CREATE TABLE `mup_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(12) NOT NULL,
  `action_type` char(1) NOT NULL COMMENT 'F-Following,R-Reply,A-Answer,E-Escalate,U-Unfollow,B-Best Answer',
  `action_id` varchar(12) NOT NULL,
  `date_added` datetime NOT NULL,
  `complaint_id` VARCHAR(12) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `mup_complaint_following`;
CREATE TABLE `mup_complaint_following` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `complaint_id` VARCHAR(45) NOT NULL,
  `user_id` VARCHAR(45) NOT NULL,
  `date_added` DATETIME NOT NULL,
  PRIMARY KEY (`id`));

DROP TABLE IF EXISTS `mup_company_following`;
CREATE TABLE `mup_company_following` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-29 17:07:31
