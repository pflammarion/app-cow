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

--
-- Table structure for table `alert`
--

CREATE DATABASE IF NOT EXISTS `APPCOW`;
DROP DATABASE `APPCOW`;
CREATE DATABASE IF NOT EXISTS `APPCOW` DEFAULT CHARACTER SET utf8mb4;
USE `APPCOW`;

DROP TABLE IF EXISTS `alert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alert` (
  `Alert_Id` int NOT NULL AUTO_INCREMENT,
  `Alert_Type_Id` int DEFAULT NULL,
  `Alert_Message` varchar(256) DEFAULT NULL,
  `Alert_Status` tinyint(1) DEFAULT NULL,
  `Chip_Level_Id` int DEFAULT NULL,
  `Alert_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Alert_Id`),
  KEY `Alert_alert_type_null_fk` (`Alert_Type_Id`),
  KEY `alert_sensor_null_fk` (`Chip_Level_Id`),
  CONSTRAINT `Alert_alert_type_null_fk` FOREIGN KEY (`Alert_Type_Id`) REFERENCES `alert_type` (`Alert_Type_Id`),
  CONSTRAINT `alert_sensor_null_fk` FOREIGN KEY (`Chip_Level_Id`) REFERENCES `chip_level` (`Chip_Level_Id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `alert_type`
--

DROP TABLE IF EXISTS `alert_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alert_type` (
  `Alert_Type_Id` int NOT NULL AUTO_INCREMENT,
  `Alert_Type_Name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`Alert_Type_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alert_type`
--

LOCK TABLES `alert_type` WRITE;
/*!40000 ALTER TABLE `alert_type` DISABLE KEYS */;
INSERT INTO `alert_type` VALUES (1,'nothing'),(2,'low'),(3,'moderate'),(4,'raised');
/*!40000 ALTER TABLE `alert_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `average`
--

DROP TABLE IF EXISTS `average`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `average` (
  `Average_Id` int NOT NULL AUTO_INCREMENT,
  `Average_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Average_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `average`
--

LOCK TABLES `average` WRITE;
/*!40000 ALTER TABLE `average` DISABLE KEYS */;
INSERT INTO `average` VALUES (1,'Horaire'),(2,'Journalier'),(3,'Mensuel'),(4,'Instantané');
/*!40000 ALTER TABLE `average` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chip`
--

DROP TABLE IF EXISTS `chip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chip` (
  `Chip_Id` int NOT NULL AUTO_INCREMENT,
  `Chip_Number` char(10) NOT NULL,
  PRIMARY KEY (`Chip_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `chip_cow_user`
--

DROP TABLE IF EXISTS `chip_cow_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chip_cow_user` (
  `Chip_Cow_User_Id` int NOT NULL AUTO_INCREMENT,
  `User_Id` int NOT NULL,
  `Cow_Id` int DEFAULT NULL,
  `Chip_Id` int DEFAULT NULL,
  PRIMARY KEY (`Chip_Cow_User_Id`),
  KEY `FK_User_Id_CCU_User` (`User_Id`),
  KEY `FK_Cow_Id_CCU_Cow` (`Cow_Id`),
  KEY `FK_Chip_Id_CCU_Chip` (`Chip_Id`),
  CONSTRAINT `FK_Chip_Id_CCU_Chip` FOREIGN KEY (`Chip_Id`) REFERENCES `chip` (`Chip_Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_Cow_Id_CCU_Cow` FOREIGN KEY (`Cow_Id`) REFERENCES `cow` (`Cow_Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_User_Id_CCU_User` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `chip_level`
--

DROP TABLE IF EXISTS `chip_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chip_level` (
  `Chip_Level_Id` int NOT NULL AUTO_INCREMENT,
  `Chip_Id` int NOT NULL,
  `Chip_Reference` int DEFAULT NULL,
  `Chip_First_Level` int DEFAULT NULL,
  `Chip_Second_Level` int DEFAULT NULL,
  `Sensor_Id` int DEFAULT NULL,
  PRIMARY KEY (`Chip_Level_Id`),
  KEY `FK_Sensor_ID_Chip_Sensor_Id` (`Sensor_Id`),
  KEY `chip_level_chip_Chip_Id_fk` (`Chip_Id`),
  CONSTRAINT `chip_level_chip_Chip_Id_fk` FOREIGN KEY (`Chip_Id`) REFERENCES `chip` (`Chip_Id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_Sensor_ID_Chip_Sensor_Id` FOREIGN KEY (`Sensor_Id`) REFERENCES `sensor` (`Sensor_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `cow`
--

DROP TABLE IF EXISTS `cow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cow` (
  `Cow_Id` int NOT NULL AUTO_INCREMENT,
  `Cow_Name` varchar(100) DEFAULT NULL,
  `Cow_Number` char(10) DEFAULT NULL,
  `Cow_Img_Url` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`Cow_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `data_sensor`
--

DROP TABLE IF EXISTS `data_sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_sensor` (
  `Data_Sensor_Id` int NOT NULL AUTO_INCREMENT,
  `Chip_Level_Id` int NOT NULL,
  `Average_Id` int NOT NULL DEFAULT '4',
  `Value` int NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Coef` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Data_Sensor_Id`),
  KEY `FK_Chip_Id_Data_Sensor_Chip` (`Chip_Level_Id`),
  KEY `FK_Average_Id_Data_Sensor_Average` (`Average_Id`),
  CONSTRAINT `data_sensor_chip_level_Chip_Level_Id_fk` FOREIGN KEY (`Chip_Level_Id`) REFERENCES `chip_level` (`Chip_Level_Id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_Average_Id_Data_Sensor_Average` FOREIGN KEY (`Average_Id`) REFERENCES `average` (`Average_Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq` (
  `FAQ_Id` int NOT NULL AUTO_INCREMENT,
  `FAQ_Title` varchar(256) NOT NULL,
  `FAQ_Answer` text NOT NULL,
  PRIMARY KEY (`FAQ_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page` (
  `Page_Id` int NOT NULL AUTO_INCREMENT,
  `Page_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Page_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'user'),(2,'admin'),(3,'admin/user'),(4,'admin/faq'),(5,'admin/permission'),(6,'admin/ticket');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission` (
  `Permission_Id` int NOT NULL AUTO_INCREMENT,
  `Page_Id` int NOT NULL,
  `Role_Id` int NOT NULL,
  PRIMARY KEY (`Permission_Id`),
  KEY `FK_Page_Id_Permission_Page` (`Page_Id`),
  KEY `FK_Role_Id_Permission_Role` (`Role_Id`),
  CONSTRAINT `FK_Page_Id_Permission_Page` FOREIGN KEY (`Page_Id`) REFERENCES `page` (`Page_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Role_Id_Permission_Role` FOREIGN KEY (`Role_Id`) REFERENCES `role` (`Role_Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,1,1),(2,2,2),(3,4,3),(4,3,2),(5,5,2);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `Role_Id` int NOT NULL AUTO_INCREMENT,
  `Role_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Role_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Utilisateur'),(2,'Gestionnaire'),(3,'Administrateur');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensor`
--

DROP TABLE IF EXISTS `sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensor` (
  `Sensor_Id` int NOT NULL AUTO_INCREMENT,
  `Sensor_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Sensor_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensor`
--

LOCK TABLES `sensor` WRITE;
/*!40000 ALTER TABLE `sensor` DISABLE KEYS */;
INSERT INTO `sensor` VALUES (1,'Cardiaque'),(2,'Monoxyde de carbone'),(3,'Sonore'),(4,'Batterie');
/*!40000 ALTER TABLE `sensor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `Status_Id` int NOT NULL AUTO_INCREMENT,
  `Status_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Status_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'ouvert'),(2,'en cours'),(3,'fermé');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `Tag_Id` int NOT NULL AUTO_INCREMENT,
  `Tag_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Tag_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'Bug informatique'),(2,'Problème matériel'),(3,'Demande d\'informations');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `Ticket_Id` int NOT NULL AUTO_INCREMENT,
  `User_Id` int DEFAULT NULL,
  `Tag_Id` int NOT NULL,
  `Status_Id` int NOT NULL,
  `Ticket_Content` text NOT NULL,
  `Ticket_Date_Creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ticket_Email` varchar(100) NOT NULL,
  `Ticket_Date_Modif` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Ticket_Id`),
  KEY `FK_User_Id_Ticket_User` (`User_Id`),
  KEY `FK_Tag_Id_Ticket_Tag` (`Tag_Id`),
  KEY `FK_Status_Id_Ticket_Status` (`Status_Id`),
  CONSTRAINT `FK_Status_Id_Ticket_Status` FOREIGN KEY (`Status_Id`) REFERENCES `status` (`Status_Id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Tag_Id_Ticket_Tag` FOREIGN KEY (`Tag_Id`) REFERENCES `tag` (`Tag_Id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_User_Id_Ticket_User` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `User_Id` int NOT NULL AUTO_INCREMENT,
  `Role_Id` int NOT NULL DEFAULT '1',
  `User_Email` varchar(120) NOT NULL,
  `User_Password` varchar(256) NOT NULL,
  `User_Username` varchar(50) DEFAULT NULL,
  `User_Img_Url` varchar(256) DEFAULT NULL,
  `User_Ban` tinyint(1) NOT NULL DEFAULT '0',
  `User_FirstName` varchar(50) NOT NULL,
  `User_LastName` varchar(50) NOT NULL,
  `User_Token` varchar(512) DEFAULT NULL,
  `User_Init` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_Id`),
  KEY `FK_Role_Id_User_Role` (`Role_Id`),
  CONSTRAINT `FK_Role_Id_User_Role` FOREIGN KEY (`Role_Id`) REFERENCES `role` (`Role_Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,3,'admin@admin.fr','$2y$10$cit9RGgKP5aOf/lELH5uqeS3.1uyrE341Jb434r32xu7KUOhy6uPy','admin',NULL,0,'Admin','Admin',NULL, 0);
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

-- Dump completed on 2022-12-21 14:37:36
