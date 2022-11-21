-- MySQL dump 10.13  Distrib 8.0.31, for macos12.6 (x86_64)
--
-- Host: localhost    Database: APPCOW
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `APPCOW`
DROP DATABASE `APPCOW`;
CREATE DATABASE IF NOT EXISTS `APPCOW` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `APPCOW`;

--
-- Table structure for table `Average`
--

DROP TABLE IF EXISTS `Average`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Average` (
  `Average_Id` int NOT NULL AUTO_INCREMENT,
  `Average_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Average_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Average`
--

LOCK TABLES `Average` WRITE;
/*!40000 ALTER TABLE `Average` DISABLE KEYS */;
INSERT INTO `Average` VALUES (1,'Horaire'),(2,'Journalier'),(3,'Mensuel');
/*!40000 ALTER TABLE `Average` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chip`
--

DROP TABLE IF EXISTS `Chip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Chip` (
  `Chip_Id` int NOT NULL AUTO_INCREMENT,
  `Chip_Code` char(10) NOT NULL,
  PRIMARY KEY (`Chip_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chip`
--

LOCK TABLES `Chip` WRITE;
/*!40000 ALTER TABLE `Chip` DISABLE KEYS */;
INSERT INTO `Chip` VALUES (1,'ABCDEF1234'),(2,'1234ABCDEF'),(3,'A1BCDEF234'),(4,'AB1CDEF234'),(5,'ABC1DEF234'),(6,'ABCD1EF234'),(7,'ABCDE1F234'),(8,'ABCDEF4321'),(9,'HUGOTUMETB');
/*!40000 ALTER TABLE `Chip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chip_Cow_User`
--

DROP TABLE IF EXISTS `Chip_Cow_User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Chip_Cow_User` (
  `Chip_Cow_User_Id` int NOT NULL AUTO_INCREMENT,
  `User_Id` int NOT NULL,
  `Cow_Id` int DEFAULT NULL,
  `Chip_Id` int DEFAULT NULL,
  PRIMARY KEY (`Chip_Cow_User_Id`),
  KEY `FK_User_Id_CCU_User` (`User_Id`),
  KEY `FK_Cow_Id_CCU_Cow` (`Cow_Id`),
  KEY `FK_Chip_Id_CCU_Chip` (`Chip_Id`),
  CONSTRAINT `FK_Chip_Id_CCU_Chip` FOREIGN KEY (`Chip_Id`) REFERENCES `Chip` (`Chip_Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_Cow_Id_CCU_Cow` FOREIGN KEY (`Cow_Id`) REFERENCES `Cow` (`Cow_Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_User_Id_CCU_User` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chip_Cow_User`
--

LOCK TABLES `Chip_Cow_User` WRITE;
/*!40000 ALTER TABLE `Chip_Cow_User` DISABLE KEYS */;
/*!40000 ALTER TABLE `Chip_Cow_User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cow`
--

DROP TABLE IF EXISTS `Cow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Cow` (
  `Cow_Id` int NOT NULL AUTO_INCREMENT,
  `Cow_Name` varchar(100) DEFAULT NULL,
  `Cow_Number` char(10) DEFAULT NULL,
  `Cow_Img_Url` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`Cow_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cow`
--

LOCK TABLES `Cow` WRITE;
/*!40000 ALTER TABLE `Cow` DISABLE KEYS */;
INSERT INTO `Cow` VALUES (1,'Guillemette','g2015',NULL),(2,'Marguerite','m2022',NULL),(3,'Josette','j2019',NULL),(4,'Mike',NULL,NULL),(5,'Paquerette',NULL,NULL),(6,'Capucine','c2011',NULL),(7,'Brigitte','b2010',NULL),(8,'Eglantine',NULL,NULL),(9,'Framboise',NULL,NULL);
/*!40000 ALTER TABLE `Cow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Data_Sensor`
--

DROP TABLE IF EXISTS `Data_Sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Data_Sensor` (
  `Data_Sensor_Id` int NOT NULL AUTO_INCREMENT,
  `Chip_Id` int NOT NULL,
  `Sensor_Id` int NOT NULL,
  `Average_Id` int NOT NULL,
  `Data_Sensor_Value` int NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Coef` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Data_Sensor_Id`),
  KEY `FK_Chip_Id_Data_Sensor_Chip` (`Chip_Id`),
  KEY `FK_Sensor_Id_Data_Sensor_Sensor` (`Sensor_Id`),
  KEY `FK_Average_Id_Data_Sensor_Average` (`Average_Id`),
  CONSTRAINT `FK_Average_Id_Data_Sensor_Average` FOREIGN KEY (`Average_Id`) REFERENCES `Average` (`Average_Id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Chip_Id_Data_Sensor_Chip` FOREIGN KEY (`Chip_Id`) REFERENCES `Chip` (`Chip_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Sensor_Id_Data_Sensor_Sensor` FOREIGN KEY (`Sensor_Id`) REFERENCES `Sensor` (`Sensor_Id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Data_Sensor`
--

LOCK TABLES `Data_Sensor` WRITE;
/*!40000 ALTER TABLE `Data_Sensor` DISABLE KEYS */;
/*!40000 ALTER TABLE `Data_Sensor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Faq`
--

DROP TABLE IF EXISTS `Faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Faq` (
  `FAQ_Id` int NOT NULL AUTO_INCREMENT,
  `FAQ_Title` varchar(256) NOT NULL,
  `FAQ_Answer` text NOT NULL,
  PRIMARY KEY (`FAQ_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Faq`
--

LOCK TABLES `Faq` WRITE;
/*!40000 ALTER TABLE `Faq` DISABLE KEYS */;
INSERT INTO `Faq` VALUES (1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.'),(2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.'),(3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.');
/*!40000 ALTER TABLE `Faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Page`
--

DROP TABLE IF EXISTS `Page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Page` (
  `Page_Id` int NOT NULL AUTO_INCREMENT,
  `Page_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Page_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Page`
--

LOCK TABLES `Page` WRITE;
/*!40000 ALTER TABLE `Page` DISABLE KEYS */;
INSERT INTO `Page` VALUES (5,'user'),(6,'admin/user'),(7,'admin/faq'),(8,'admin/permission'),(9,'admin');
/*!40000 ALTER TABLE `Page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Permission`
--

DROP TABLE IF EXISTS `Permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Permission` (
  `Permission_Id` int NOT NULL AUTO_INCREMENT,
  `Page_Id` int NOT NULL,
  `Role_Id` int NOT NULL,
  PRIMARY KEY (`Permission_Id`),
  KEY `FK_Page_Id_Permission_Page` (`Page_Id`),
  KEY `FK_Role_Id_Permission_Role` (`Role_Id`),
  CONSTRAINT `FK_Page_Id_Permission_Page` FOREIGN KEY (`Page_Id`) REFERENCES `Page` (`Page_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Role_Id_Permission_Role` FOREIGN KEY (`Role_Id`) REFERENCES `Role` (`Role_Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Permission`
--

LOCK TABLES `Permission` WRITE;
/*!40000 ALTER TABLE `Permission` DISABLE KEYS */;
INSERT INTO `Permission` VALUES (7,5,1),(8,6,2),(9,8,3),(10,7,2),(11,9,2);
/*!40000 ALTER TABLE `Permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Role`
--

DROP TABLE IF EXISTS `Role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Role` (
  `Role_Id` int NOT NULL AUTO_INCREMENT,
  `Role_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Role_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Role`
--

LOCK TABLES `Role` WRITE;
/*!40000 ALTER TABLE `Role` DISABLE KEYS */;
INSERT INTO `Role` VALUES (1,'Utilisateur'),(2,'Gestionnaire'),(3,'Administrateur');
/*!40000 ALTER TABLE `Role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sensor`
--

DROP TABLE IF EXISTS `Sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Sensor` (
  `Sensor_Id` int NOT NULL AUTO_INCREMENT,
  `Sensor_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Sensor_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sensor`
--

LOCK TABLES `Sensor` WRITE;
/*!40000 ALTER TABLE `Sensor` DISABLE KEYS */;
INSERT INTO `Sensor` VALUES (1,'Cardiaque'),(2,'Monoxyde de carbone'),(3,'Sonore');
/*!40000 ALTER TABLE `Sensor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Status`
--

DROP TABLE IF EXISTS `Status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Status` (
  `Status_Id` int NOT NULL AUTO_INCREMENT,
  `Status_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Status_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Status`
--

LOCK TABLES `Status` WRITE;
/*!40000 ALTER TABLE `Status` DISABLE KEYS */;
INSERT INTO `Status` VALUES (1,'ouvert'),(2,'fermé'),(3,'en cours');
/*!40000 ALTER TABLE `Status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tag`
--

DROP TABLE IF EXISTS `Tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Tag` (
  `Tag_Id` int NOT NULL AUTO_INCREMENT,
  `Tag_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Tag_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tag`
--

LOCK TABLES `Tag` WRITE;
/*!40000 ALTER TABLE `Tag` DISABLE KEYS */;
INSERT INTO `Tag` VALUES (1,'bug informatique'),(2,'problème materiel'),(3,'demande d\'informations');
/*!40000 ALTER TABLE `Tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ticket`
--

DROP TABLE IF EXISTS `Ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Ticket` (
  `Ticket_Id` int NOT NULL AUTO_INCREMENT,
  `User_Id` int DEFAULT NULL,
  `Tag_Id` int NOT NULL,
  `Status_Id` int NOT NULL,
  `Ticket_Content` text NOT NULL,
  `Ticket_Date` date NOT NULL,
  PRIMARY KEY (`Ticket_Id`),
  KEY `FK_User_Id_Ticket_User` (`User_Id`),
  KEY `FK_Tag_Id_Ticket_Tag` (`Tag_Id`),
  KEY `FK_Status_Id_Ticket_Status` (`Status_Id`),
  CONSTRAINT `FK_Status_Id_Ticket_Status` FOREIGN KEY (`Status_Id`) REFERENCES `Status` (`Status_Id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Tag_Id_Ticket_Tag` FOREIGN KEY (`Tag_Id`) REFERENCES `Tag` (`Tag_Id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_User_Id_Ticket_User` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ticket`
--

LOCK TABLES `Ticket` WRITE;
/*!40000 ALTER TABLE `Ticket` DISABLE KEYS */;
INSERT INTO `Ticket` VALUES (1,NULL,3,3,'kjlmkjlkj','2022-10-28'),(2,NULL,1,2,'khljl','2022-09-28'),(3,NULL,2,1,'mlk','2022-10-27'),(4,NULL,2,2,'mlkkmjlm','2022-10-27'),(5,NULL,3,2,'oijpoi','2022-09-26');
/*!40000 ALTER TABLE `Ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `User_Id` int NOT NULL AUTO_INCREMENT,
  `Role_Id` int NOT NULL DEFAULT '1',
  `User_Email` varchar(120) NOT NULL,
  `User_Password` varchar(256) NOT NULL,
  `User_Username` varchar(50) DEFAULT NULL,
  `User_Img_Url` varchar(256) DEFAULT NULL,
  `User_Ban` tinyint(1) NOT NULL DEFAULT '0',
  `User_FirstName` varchar(50) NOT NULL,
  `User_LastName` varchar(50) NOT NULL,
  PRIMARY KEY (`User_Id`),
  KEY `FK_Role_Id_User_Role` (`Role_Id`),
  CONSTRAINT `FK_Role_Id_User_Role` FOREIGN KEY (`Role_Id`) REFERENCES `Role` (`Role_Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (7,1,'paul@flammarion.eu','$2y$10$JM41Tvy9WN/A68M2gbRUVuO0HP0TojvYiW2IDm2BZHwBiEn7N8vIi','pipaul',NULL,0,'Paul','Flammarion'),(8,3,'admin@admin.fr','$2y$10$cit9RGgKP5aOf/lELH5uqeS3.1uyrE341Jb434r32xu7KUOhy6uPy','admin',NULL,0,'Admin','Admin'),(9,1,'user@user.fr','$2y$10$552s3Y.mEfhPRW2cH4ckC.Qoehlb.Hb1dTDYOqavY5hr7S3Lr9J82','user',NULL,0,'User','User');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-17  9:28:55
