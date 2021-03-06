-- MySQL dump 10.16  Distrib 10.1.19-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

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
-- Table structure for table `crawl_story`
--

DROP TABLE IF EXISTS `crawl_story`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crawl_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `url_source` varchar(512) CHARACTER SET utf16 NOT NULL,
  `title` char(255) NOT NULL,
  `title_code` varchar(512) NOT NULL COMMENT 'base64 of title',
  `author` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(512) NOT NULL,
  `detail` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `imported` tinyint(4) NOT NULL DEFAULT '0',
  `duplicate` tinyint(4) NOT NULL DEFAULT '0',
  `nid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crawl_story`
--

LOCK TABLES `crawl_story` WRITE;
/*!40000 ALTER TABLE `crawl_story` DISABLE KEYS */;
/*!40000 ALTER TABLE `crawl_story` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crawl_story_chapter`
--

DROP TABLE IF EXISTS `crawl_story_chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crawl_story_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) CHARACTER SET utf8 NOT NULL,
  `content` longtext CHARACTER SET utf8 NOT NULL,
  `story_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `url_source` varchar(512) CHARACTER SET utf8 NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `domain` varchar(64) CHARACTER SET utf8 NOT NULL,
  `story_nid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crawl_story_chapter`
--

LOCK TABLES `crawl_story_chapter` WRITE;
/*!40000 ALTER TABLE `crawl_story_chapter` DISABLE KEYS */;
/*!40000 ALTER TABLE `crawl_story_chapter` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-22  8:42:56
