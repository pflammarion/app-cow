-- MySQL dump 10.13  Distrib 8.0.31, for macos12.6 (x86_64)
--
-- Host: localhost    Database: APP-COW
-- ------------------------------------------------------
-- Server version	8.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
-- Table structure for table `Average`
--

DROP TABLE IF EXISTS `Average`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Average` (
  `Average_Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
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
  `Code` char(10) NOT NULL,
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
INSERT INTO `Chip_Cow_User` VALUES (1,6,1,1),(2,6,3,5),(3,1,2,4),(4,2,4,3),(5,2,5,2),(6,3,9,9),(7,4,6,6),(8,4,8,7),(9,5,7,8);
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
  `Name` varchar(100) DEFAULT NULL,
  `Number` char(10) DEFAULT NULL,
  `img_url` varchar(256) DEFAULT NULL,
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
  `Value` int NOT NULL,
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
  `Title` varchar(256) NOT NULL,
  `Answer` text NOT NULL,
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
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Page_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Page`
--

LOCK TABLES `Page` WRITE;
/*!40000 ALTER TABLE `Page` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Permission`
--

LOCK TABLES `Permission` WRITE;
/*!40000 ALTER TABLE `Permission` DISABLE KEYS */;
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
  `Name` varchar(50) NOT NULL,
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
  `Name` varchar(50) NOT NULL,
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
  `Name` varchar(50) NOT NULL,
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
  `Tad_Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Tad_Id`)
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
  `User_Id` int NOT NULL,
  `Tag_Id` int NOT NULL,
  `Status_Id` int NOT NULL,
  `Content` text NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Ticket_Id`),
  KEY `FK_User_Id_Ticket_User` (`User_Id`),
  KEY `FK_Tag_Id_Ticket_Tag` (`Tag_Id`),
  KEY `FK_Status_Id_Ticket_Status` (`Status_Id`),
  CONSTRAINT `FK_Status_Id_Ticket_Status` FOREIGN KEY (`Status_Id`) REFERENCES `Status` (`Status_Id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Tag_Id_Ticket_Tag` FOREIGN KEY (`Tag_Id`) REFERENCES `Tag` (`Tad_Id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_User_Id_Ticket_User` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ticket`
--

LOCK TABLES `Ticket` WRITE;
/*!40000 ALTER TABLE `Ticket` DISABLE KEYS */;
INSERT INTO `Ticket` VALUES (1,6,3,3,'kjlmkjlkj','2022-10-28'),(2,6,1,2,'khljl','2022-09-28'),(3,4,2,1,'mlk','2022-10-27'),(4,3,2,2,'mlkkmjlm','2022-10-27'),(5,3,3,2,'oijpoi','2022-09-26');
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
  `Role_Id` int NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `img_url` varchar(256) DEFAULT NULL,
  `Ban` tinyint(1) NOT NULL,
  PRIMARY KEY (`User_Id`),
  KEY `FK_Role_Id_User_Role` (`Role_Id`),
  CONSTRAINT `FK_Role_Id_User_Role` FOREIGN KEY (`Role_Id`) REFERENCES `Role` (`Role_Id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,1,'johndoe@gmail.com','','jd',NULL,0),(2,1,'jgjk@gmail.com','','lkjlhl',NULL,1),(3,2,'klj@gmail.com','',NULL,NULL,0),(4,3,'lkjm@gmail.com','',NULL,NULL,0),(5,2,'lkjl@gmail.com','',NULL,NULL,0),(6,2,'paul.flammarion@gmail.com','','flamminfou',NULL,1);
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

-- Dump completed on 2022-10-28 15:03:48
