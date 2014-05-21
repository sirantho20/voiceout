-- MySQL dump 10.13  Distrib 5.6.16, for Win32 (x86)
--
-- Host: localhost    Database: voiceout
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
  CONSTRAINT `fk_mup_company_1` FOREIGN KEY (`license_package`) REFERENCES `mup_license_pacakges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_company_category` FOREIGN KEY (`category_id`) REFERENCES `mup_category` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_company_industry` FOREIGN KEY (`industry_id`) REFERENCES `mup_industry` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_company`
--

LOCK TABLES `mup_company` WRITE;
/*!40000 ALTER TABLE `mup_company` DISABLE KEYS */;
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
-- Table structure for table `mup_complaint`
--

DROP TABLE IF EXISTS `mup_complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mup_complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_id` varchar(12) NOT NULL,
  `company_id` varchar(12) NOT NULL,
  `user_id` varchar(12) NOT NULL COMMENT 'cookie id for guest users',
  `cookie_id` varchar(45) DEFAULT NULL COMMENT 'For anonymous users. Cookie id used to track recurring visitors',
  `complaint` varchar(255) NOT NULL,
  `hashtag` varchar(255) DEFAULT NULL,
  `is_private` char(1) NOT NULL DEFAULT 'N',
  `rating` int(1) NOT NULL DEFAULT '1' COMMENT 'Ratings are ranked as follows\n1 - bad\n2 - terrible',
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `published` char(1) NOT NULL DEFAULT 'Y',
  `has_picture` char(1) NOT NULL DEFAULT 'N',
  `has_audio` char(1) NOT NULL DEFAULT 'N',
  `read_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comp_id_UNIQUE` (`complaint_id`),
  KEY `fk_complaints_user_idx` (`user_id`),
  KEY `fk_complaints_company_idx` (`company_id`),
  CONSTRAINT `fk_complaints_company` FOREIGN KEY (`company_id`) REFERENCES `mup_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_complaints_user` FOREIGN KEY (`user_id`) REFERENCES `mup_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mup_country`
--

LOCK TABLES `mup_country` WRITE;
/*!40000 ALTER TABLE `mup_country` DISABLE KEYS */;
INSERT INTO `mup_country` VALUES (1,'af','Afghanistan','afg'),(2,'ax','Aland Islands','ala'),(3,'al','Albania','alb'),(4,'dz','Algeria','dza'),(5,'as','American Samoa','asm'),(6,'ad','Andorra','and'),(7,'ao','Angola','ago'),(8,'ai','Anguilla','aia'),(9,'aq','Antarctica',''),(10,'ag','Antigua and Barbuda','atg'),(11,'ar','Argentina','arg'),(12,'am','Armenia','arm'),(13,'aw','Aruba','abw'),(14,'au','Australia','aus'),(15,'at','Austria','aut'),(16,'az','Azerbaijan','aze'),(17,'bs','Bahamas','bhs'),(18,'bh','Bahrain','bhr'),(19,'bd','Bangladesh','bgd'),(20,'bb','Barbados','brb'),(21,'by','Belarus','blr'),(22,'be','Belgium','bel'),(23,'bz','Belize','blz'),(24,'bj','Benin','ben'),(25,'bm','Bermuda','bmu'),(26,'bt','Bhutan','btn'),(27,'bo','Bolivia, Plurinational State of','bol'),(28,'bq','Bonaire, Sint Eustatius and Saba','bes'),(29,'ba','Bosnia and Herzegovina','bih'),(30,'bw','Botswana','bwa'),(31,'bv','Bouvet Island',''),(32,'br','Brazil','bra'),(33,'io','British Indian Ocean Territory',''),(34,'bn','Brunei Darussalam','brn'),(35,'bg','Bulgaria','bgr'),(36,'bf','Burkina Faso','bfa'),(37,'bi','Burundi','bdi'),(38,'kh','Cambodia','khm'),(39,'cm','Cameroon','cmr'),(40,'ca','Canada','can'),(41,'cv','Cape Verde','cpv'),(42,'ky','Cayman Islands','cym'),(43,'cf','Central African Republic','caf'),(44,'td','Chad','tcd'),(45,'cl','Chile','chl'),(46,'cn','China','chn'),(47,'cx','Christmas Island',''),(48,'cc','Cocos (Keeling) Islands',''),(49,'co','Colombia','col'),(50,'km','Comoros','com'),(51,'cg','Congo','cog'),(52,'cd','Congo, The Democratic Republic of the','cod'),(53,'ck','Cook Islands','cok'),(54,'cr','Costa Rica','cri'),(55,'ci','Cote d\'Ivoire','civ'),(56,'hr','Croatia','hrv'),(57,'cu','Cuba','cub'),(58,'cw','Curacao','cuw'),(59,'cy','Cyprus','cyp'),(60,'cz','Czech Republic','cze'),(61,'dk','Denmark','dnk'),(62,'dj','Djibouti','dji'),(63,'dm','Dominica','dma'),(64,'do','Dominican Republic','dom'),(65,'ec','Ecuador','ecu'),(66,'eg','Egypt','egy'),(67,'sv','El Salvador','slv'),(68,'gq','Equatorial Guinea','gnq'),(69,'er','Eritrea','eri'),(70,'ee','Estonia','est'),(71,'et','Ethiopia','eth'),(72,'fk','Falkland Islands (Malvinas)','flk'),(73,'fo','Faroe Islands','fro'),(74,'fj','Fiji','fji'),(75,'fi','Finland','fin'),(76,'fr','France','fra'),(77,'gf','French Guiana','guf'),(78,'pf','French Polynesia','pyf'),(79,'tf','French Southern Territories',''),(80,'ga','Gabon','gab'),(81,'gm','Gambia','gmb'),(82,'ge','Georgia','geo'),(83,'de','Germany','deu'),(84,'gh','Ghana','gha'),(85,'gi','Gibraltar','gib'),(86,'gr','Greece','grc'),(87,'gl','Greenland','grl'),(88,'gd','Grenada','grd'),(89,'gp','Guadeloupe','glp'),(90,'gu','Guam','gum'),(91,'gt','Guatemala','gtm'),(92,'gg','Guernsey','ggy'),(93,'gn','Guinea','gin'),(94,'gw','Guinea-Bissau','gnb'),(95,'gy','Guyana','guy'),(96,'ht','Haiti','hti'),(97,'hm','Heard Island and McDonald Islands',''),(98,'va','Holy See (Vatican City State)','vat'),(99,'hn','Honduras','hnd'),(100,'hk','Hong Kong','hkg'),(101,'hu','Hungary','hun'),(102,'is','Iceland','isl'),(103,'in','India','ind'),(104,'id','Indonesia','idn'),(105,'ir','Iran, Islamic Republic of','irn'),(106,'iq','Iraq','irq'),(107,'ie','Ireland','irl'),(108,'im','Isle of Man','imn'),(109,'il','Israel','isr'),(110,'it','Italy','ita'),(111,'jm','Jamaica','jam'),(112,'jp','Japan','jpn'),(113,'je','Jersey','jey'),(114,'jo','Jordan','jor'),(115,'kz','Kazakhstan','kaz'),(116,'ke','Kenya','ken'),(117,'ki','Kiribati','kir'),(118,'kp','Korea, Democratic People\'s Republic of','prk'),(119,'kr','Korea, Republic of','kor'),(120,'kw','Kuwait','kwt'),(121,'kg','Kyrgyzstan','kgz'),(122,'la','Lao People\'s Democratic Republic','lao'),(123,'lv','Latvia','lva'),(124,'lb','Lebanon','lbn'),(125,'ls','Lesotho','lso'),(126,'lr','Liberia','lbr'),(127,'ly','Libyan Arab Jamahiriya','lby'),(128,'li','Liechtenstein','lie'),(129,'lt','Lithuania','ltu'),(130,'lu','Luxembourg','lux'),(131,'mo','Macao','mac'),(132,'mk','Macedonia, The former Yugoslav Republic of','mkd'),(133,'mg','Madagascar','mdg'),(134,'mw','Malawi','mwi'),(135,'my','Malaysia','mys'),(136,'mv','Maldives','mdv'),(137,'ml','Mali','mli'),(138,'mt','Malta','mlt'),(139,'mh','Marshall Islands','mhl'),(140,'mq','Martinique','mtq'),(141,'mr','Mauritania','mrt'),(142,'mu','Mauritius','mus'),(143,'yt','Mayotte','myt'),(144,'mx','Mexico','mex'),(145,'fm','Micronesia, Federated States of','fsm'),(146,'md','Moldova, Republic of','mda'),(147,'mc','Monaco','mco'),(148,'mn','Mongolia','mng'),(149,'me','Montenegro','mne'),(150,'ms','Montserrat','msr'),(151,'ma','Morocco','mar'),(152,'mz','Mozambique','moz'),(153,'mm','Myanmar','mmr'),(154,'na','Namibia','nam'),(155,'nr','Nauru','nru'),(156,'np','Nepal','npl'),(157,'nl','Netherlands','nld'),(158,'nc','New Caledonia','ncl'),(159,'nz','New Zealand','nzl'),(160,'ni','Nicaragua','nic'),(161,'ne','Niger','ner'),(162,'ng','Nigeria','nga'),(163,'nu','Niue','niu'),(164,'nf','Norfolk Island','nfk'),(165,'mp','Northern Mariana Islands','mnp'),(166,'no','Norway','nor'),(167,'om','Oman','omn'),(168,'pk','Pakistan','pak'),(169,'pw','Palau','plw'),(170,'ps','Palestinian Territory, Occupied','pse'),(171,'pa','Panama','pan'),(172,'pg','Papua New Guinea','png'),(173,'py','Paraguay','pry'),(174,'pe','Peru','per'),(175,'ph','Philippines','phl'),(176,'pn','Pitcairn','pcn'),(177,'pl','Poland','pol'),(178,'pt','Portugal','prt'),(179,'pr','Puerto Rico','pri'),(180,'qa','Qatar','qat'),(181,'re','Reunion','reu'),(182,'ro','Romania','rou'),(183,'ru','Russian Federation','rus'),(184,'rw','Rwanda','rwa'),(185,'bl','Saint Barthelemy','blm'),(186,'sh','Saint Helena, Ascension and Tristan Da Cunha','shn'),(187,'kn','Saint Kitts and Nevis','kna'),(188,'lc','Saint Lucia','lca'),(189,'mf','Saint Martin (French Part)','maf'),(190,'pm','Saint Pierre and Miquelon','spm'),(191,'vc','Saint Vincent and The Grenadines','vct'),(192,'ws','Samoa','wsm'),(193,'sm','San Marino','smr'),(194,'st','Sao Tome and Principe','stp'),(195,'sa','Saudi Arabia','sau'),(196,'sn','Senegal','sen'),(197,'rs','Serbia','srb'),(198,'sc','Seychelles','syc'),(199,'sl','Sierra Leone','sle'),(200,'sg','Singapore','sgp'),(201,'sx','Sint Maarten (Dutch Part)','sxm'),(202,'sk','Slovakia','svk'),(203,'si','Slovenia','svn'),(204,'sb','Solomon Islands','slb'),(205,'so','Somalia','som'),(206,'za','South Africa','zaf'),(207,'gs','South Georgia and The South Sandwich Islands',''),(208,'ss','South Sudan','ssd'),(209,'es','Spain','esp'),(210,'lk','Sri Lanka','lka'),(211,'sd','Sudan','sdn'),(212,'sr','Suriname','sur'),(213,'sj','Svalbard and Jan Mayen','sjm'),(214,'sz','Swaziland','swz'),(215,'se','Sweden','swe'),(216,'ch','Switzerland','che'),(217,'sy','Syrian Arab Republic','syr'),(218,'tw','Taiwan, Province of China',''),(219,'tj','Tajikistan','tjk'),(220,'tz','Tanzania, United Republic of','tza'),(221,'th','Thailand','tha'),(222,'tl','Timor-Leste','tls'),(223,'tg','Togo','tgo'),(224,'tk','Tokelau','tkl'),(225,'to','Tonga','ton'),(226,'tt','Trinidad and Tobago','tto'),(227,'tn','Tunisia','tun'),(228,'tr','Turkey','tur'),(229,'tm','Turkmenistan','tkm'),(230,'tc','Turks and Caicos Islands','tca'),(231,'tv','Tuvalu','tuv'),(232,'ug','Uganda','uga'),(233,'ua','Ukraine','ukr'),(234,'ae','United Arab Emirates','are'),(235,'gb','United Kingdom','gbr'),(236,'us','United States','usa'),(237,'um','United States Minor Outlying Islands',''),(238,'uy','Uruguay','ury'),(239,'uz','Uzbekistan','uzb'),(240,'vu','Vanuatu','vut'),(241,'ve','Venezuela, Bolivarian Republic of','ven'),(242,'vn','Viet Nam','vnm'),(243,'vg','Virgin Islands, British','vgb'),(244,'vi','Virgin Islands, U.S.','vir'),(245,'wf','Wallis and Futuna','wlf'),(246,'eh','Western Sahara','esh'),(247,'ye','Yemen','yem'),(248,'zm','Zambia','zmb'),(249,'zw','Zimbabwe','zwe');
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
  PRIMARY KEY (`id`),
  KEY `fk_company_reply_idx` (`company_id`),
  KEY `fk_complaint_reply_idx` (`complaint_id`),
  CONSTRAINT `fk_company_reply` FOREIGN KEY (`company_id`) REFERENCES `mup_company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_complaint_reply` FOREIGN KEY (`complaint_id`) REFERENCES `mup_complaint` (`complaint_id`) ON DELETE CASCADE ON UPDATE CASCADE
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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-21 18:04:24
