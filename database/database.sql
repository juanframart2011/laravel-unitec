-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laravel-unitec
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `career`
--

DROP TABLE IF EXISTS `career`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `career` (
  `career_id` int(11) NOT NULL AUTO_INCREMENT,
  `statu_id` int(11) NOT NULL DEFAULT '1',
  `studyGrade_id` int(11) NOT NULL,
  `career_name` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `career_encrypted` varchar(350) COLLATE utf8mb4_general_ci NOT NULL,
  `career_description` text COLLATE utf8mb4_general_ci,
  `career_creationDate` datetime DEFAULT NULL,
  `career_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`career_id`),
  UNIQUE KEY `career_id_UNIQUE` (`career_id`),
  UNIQUE KEY `career_name_UNIQUE` (`career_name`),
  UNIQUE KEY `career_encrypted_UNIQUE` (`career_encrypted`),
  KEY `career_statu_idx` (`statu_id`),
  KEY `career_studyGrade_idx` (`studyGrade_id`),
  CONSTRAINT `career_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `career_studyGrade` FOREIGN KEY (`studyGrade_id`) REFERENCES `study_grade` (`studyGrade_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `career`
--

LOCK TABLES `career` WRITE;
/*!40000 ALTER TABLE `career` DISABLE KEYS */;
INSERT INTO `career` VALUES (1,1,1,'Lic. En Derecho','fd54645',NULL,NULL,NULL),(2,1,1,'Lic. En Finanzas','56hgh',NULL,NULL,NULL),(3,1,2,'Mtria. Admon. De Negocios','ghgf5656',NULL,NULL,NULL),(4,1,2,'Mtria. Direccion de proyectos','tret65465',NULL,NULL,NULL);
/*!40000 ALTER TABLE `career` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `statu_id` int(11) NOT NULL DEFAULT '1',
  `gender_name` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `gender_encrypted` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `gender_description` text COLLATE utf8mb4_general_ci,
  `gender_creationDate` datetime DEFAULT NULL,
  `gender_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`gender_id`),
  UNIQUE KEY `gender_id_UNIQUE` (`gender_id`),
  UNIQUE KEY `gender_name_UNIQUE` (`gender_name`),
  UNIQUE KEY `gender_encrypted_UNIQUE` (`gender_encrypted`),
  KEY `gender_statu_idx` (`statu_id`),
  CONSTRAINT `gender_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (2,1,'masculino','fsdfs5345',NULL,NULL,NULL),(3,1,'femenino','hjgjg5657',NULL,NULL,NULL);
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statu`
--

DROP TABLE IF EXISTS `statu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statu` (
  `statu_id` int(11) NOT NULL AUTO_INCREMENT,
  `statu_name` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `statu_description` text COLLATE utf8mb4_general_ci,
  `statu_creationDate` datetime DEFAULT NULL,
  `statu_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`statu_id`),
  UNIQUE KEY `statu_id_UNIQUE` (`statu_id`),
  UNIQUE KEY `statu_name_UNIQUE` (`statu_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statu`
--

LOCK TABLES `statu` WRITE;
/*!40000 ALTER TABLE `statu` DISABLE KEYS */;
INSERT INTO `statu` VALUES (1,'activo',NULL,NULL,NULL);
/*!40000 ALTER TABLE `statu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statu_civil`
--

DROP TABLE IF EXISTS `statu_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statu_civil` (
  `statuCivil_id` int(11) NOT NULL AUTO_INCREMENT,
  `statu_id` int(11) NOT NULL DEFAULT '1',
  `statuCivil_name` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `statuCivil_encrypted` varchar(350) COLLATE utf8mb4_general_ci NOT NULL,
  `statuCivil_description` text COLLATE utf8mb4_general_ci,
  `statuCivil_creationDate` datetime DEFAULT NULL,
  `statuCivil_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`statuCivil_id`),
  UNIQUE KEY `statuCivil_id_UNIQUE` (`statuCivil_id`),
  UNIQUE KEY `statuCivil_name_UNIQUE` (`statuCivil_name`),
  UNIQUE KEY `statuCivil_encrypted_UNIQUE` (`statuCivil_encrypted`),
  KEY `statuCivil_statu_idx` (`statu_id`),
  CONSTRAINT `statuCivil_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statu_civil`
--

LOCK TABLES `statu_civil` WRITE;
/*!40000 ALTER TABLE `statu_civil` DISABLE KEYS */;
/*!40000 ALTER TABLE `statu_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_grade`
--

DROP TABLE IF EXISTS `study_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_grade` (
  `studyGrade_id` int(11) NOT NULL AUTO_INCREMENT,
  `statu_id` int(11) NOT NULL DEFAULT '1',
  `studyGrade_name` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `studyGrade_encrypted` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `studyGrade_description` text COLLATE utf8mb4_general_ci,
  `studyGrade_creationDate` datetime DEFAULT NULL,
  `studyGrade_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`studyGrade_id`),
  UNIQUE KEY `studyGrade__UNIQUE` (`studyGrade_id`),
  UNIQUE KEY `studyGrade_name_UNIQUE` (`studyGrade_name`),
  UNIQUE KEY `studyGrade_encrypted_UNIQUE` (`studyGrade_encrypted`),
  KEY `studyGrade_statu_idx` (`statu_id`),
  CONSTRAINT `studyGrade_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_grade`
--

LOCK TABLES `study_grade` WRITE;
/*!40000 ALTER TABLE `study_grade` DISABLE KEYS */;
INSERT INTO `study_grade` VALUES (1,1,'preparatoria','fd564gdf',NULL,NULL,NULL),(2,1,'licenciatura','fgd5464',NULL,NULL,NULL),(3,1,'posgrado','fg565',NULL,NULL,NULL);
/*!40000 ALTER TABLE `study_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `statu_id` int(11) NOT NULL DEFAULT '1',
  `career_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `statuCivil_id` int(11) NOT NULL,
  `user_name` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(350) COLLATE utf8mb4_general_ci NOT NULL,
  `user_lastName` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `user_lastNameSec` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `user_age` int(3) NOT NULL,
  `user_password` varchar(350) COLLATE utf8mb4_general_ci NOT NULL,
  `user_creationDate` datetime NOT NULL,
  `user_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  KEY `user_statu_idx` (`statu_id`),
  KEY `user_career_idx` (`career_id`),
  KEY `user_gender_idx` (`gender_id`),
  KEY `user_statuCivil_idx` (`statuCivil_id`),
  CONSTRAINT `user_career` FOREIGN KEY (`career_id`) REFERENCES `career` (`career_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`gender_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_statuCivil` FOREIGN KEY (`statuCivil_id`) REFERENCES `statu_civil` (`statuCivil_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-27  1:24:17
