-- MySQL dump 10.13  Distrib 8.0.13, for macos10.14 (x86_64)
--
-- Host: localhost    Database: thinkspace_laravel_full
-- ------------------------------------------------------
-- Server version	5.7.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `video_tags`
--

LOCK TABLES `video_tags` WRITE;
/*!40000 ALTER TABLE `video_tags` DISABLE KEYS */;
INSERT INTO `video_tags` VALUES (1,'Composition','notes notes ',NULL,NULL,NULL),(2,'Video Games','notes notes ',NULL,NULL,NULL),(3,'Documentaries','notes notes on docs',NULL,NULL,NULL),(4,'Business','music business notes changed abcd',NULL,NULL,'2023-02-13 07:59:27'),(5,'Composition 3','notes notes ',NULL,NULL,NULL),(6,'Video Games 3','notes notes ',NULL,NULL,NULL),(8,'Business 2','music business notes',NULL,NULL,NULL),(10,'Video Games 21','notes notes  21',NULL,NULL,'2023-02-09 14:55:11'),(11,'Documentaries 2','notes notes on docs',NULL,NULL,NULL),(13,'Test','Test notes',NULL,'2023-02-09 14:46:42','2023-02-09 14:46:42'),(14,'Composing Music for Games','notes notes',NULL,'2023-02-09 14:52:23','2023-02-09 14:52:23');
/*!40000 ALTER TABLE `video_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `video_tags_videos`
--

LOCK TABLES `video_tags_videos` WRITE;
/*!40000 ALTER TABLE `video_tags_videos` DISABLE KEYS */;
INSERT INTO `video_tags_videos` VALUES (10,2,1,NULL,NULL),(11,3,3,NULL,NULL),(17,3,1,NULL,NULL),(18,1,3,NULL,NULL),(19,2,11,NULL,NULL);
/*!40000 ALTER TABLE `video_tags_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'Writing music for documentaries - Tara Cremer','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum','https://player.vimeo.com/video/504742845?app_id=122963','https://course-downloads.s3-eu-west-1.amazonaws.com/Webinar+Library/Chat+text/Chat+-+Writing+music+for+documentaries+-+Tara+Creme.txt.zip',NULL,'2023-01-31 10:48:51','2023-02-10 11:51:12','2023-01-31'),(2,'Music for video games - Jon Smith','Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum','https://player.vimeo.com/video/504742845?app_id=122963',NULL,NULL,NULL,'2023-02-10 11:51:27','2019-01-31'),(3,'Music for Documentaries','Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ','https://player.vimeo.com/video/504742845?app_id=122963',NULL,NULL,NULL,'2023-02-10 11:52:33','2009-10-12');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-14 15:17:18
