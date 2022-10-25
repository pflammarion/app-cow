SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `APP-COW`;

USE `APP-COW`;

CREATE TABLE IF NOT EXISTS `Average` (
  `Average_Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Chip` (
  `Chip_Id` int(11) NOT NULL,
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Chip_Cow_User` (
  `Chip_Cow_User_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Cow_Id` int(11) DEFAULT NULL,
  `Chip_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Cow` (
  `Cow_Id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Number` int(11) DEFAULT NULL,
  `img_url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Data_Sensor` (
  `Data_Sensor_Id` int(11) NOT NULL,
  `Chip_Id` int(11) NOT NULL,
  `Sensor_Id` int(11) NOT NULL,
  `Average_Id` int(11) NOT NULL,
  `Value` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Coef` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `FAQ` (
  `FAQ_Id` int(11) NOT NULL,
  `Title` varchar(256) NOT NULL,
  `Answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Page` (
  `Page_Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Permission` (
  `Permission_Id` int(11) NOT NULL,
  `Page_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Role` (
  `Role_Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Sensor` (
  `Sensor_Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Status` (
  `Status_Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Tag` (
  `Tad_Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Ticket` (
  `Ticket_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Tag_Id` int(11) NOT NULL,
  `Status_Id` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `User` (
  `User_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `img_url` varchar(256) DEFAULT NULL,
  `Ban` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `Average`
  ADD PRIMARY KEY (`Average_Id`);

ALTER TABLE `Chip`
  ADD PRIMARY KEY (`Chip_Id`);

ALTER TABLE `Chip_Cow_User`
  ADD PRIMARY KEY (`Chip_Cow_User_Id`),
  ADD KEY `FK_User_Id_CCU_User` (`User_Id`),
  ADD KEY `FK_Cow_Id_CCU_Cow` (`Cow_Id`),
  ADD KEY `FK_Chip_Id_CCU_Chip` (`Chip_Id`);

ALTER TABLE `Cow`
  ADD PRIMARY KEY (`Cow_Id`);

ALTER TABLE `Data_Sensor`
  ADD PRIMARY KEY (`Data_Sensor_Id`),
  ADD KEY `FK_Chip_Id_Data_Sensor_Chip` (`Chip_Id`),
  ADD KEY `FK_Sensor_Id_Data_Sensor_Sensor` (`Sensor_Id`),
  ADD KEY `FK_Average_Id_Data_Sensor_Average` (`Average_Id`);

ALTER TABLE `FAQ`
  ADD PRIMARY KEY (`FAQ_Id`);

ALTER TABLE `Page`
  ADD PRIMARY KEY (`Page_Id`);

ALTER TABLE `Permission`
  ADD PRIMARY KEY (`Permission_Id`),
  ADD KEY `FK_Page_Id_Permission_Page` (`Page_Id`),
  ADD KEY `FK_Role_Id_Permission_Role` (`Role_Id`);

ALTER TABLE `Role`
  ADD PRIMARY KEY (`Role_Id`);

ALTER TABLE `Sensor`
  ADD PRIMARY KEY (`Sensor_Id`);

ALTER TABLE `Status`
  ADD PRIMARY KEY (`Status_Id`);

ALTER TABLE `Tag`
  ADD PRIMARY KEY (`Tad_Id`);

ALTER TABLE `Ticket`
  ADD PRIMARY KEY (`Ticket_Id`),
  ADD KEY `FK_User_Id_Ticket_User` (`User_Id`),
  ADD KEY `FK_Tag_Id_Ticket_Tag` (`Tag_Id`),
  ADD KEY `FK_Status_Id_Ticket_Status` (`Status_Id`);

ALTER TABLE `User`
  ADD PRIMARY KEY (`User_Id`),
  ADD KEY `FK_Role_Id_User_Role` (`Role_Id`);

ALTER TABLE `Average`
  MODIFY `Average_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Chip`
  MODIFY `Chip_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Chip_Cow_User`
  MODIFY `Chip_Cow_User_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Cow`
  MODIFY `Cow_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Data_Sensor`
  MODIFY `Data_Sensor_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `FAQ`
  MODIFY `FAQ_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Page`
  MODIFY `Page_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Permission`
  MODIFY `Permission_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Role`
  MODIFY `Role_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Sensor`
  MODIFY `Sensor_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Status`
  MODIFY `Status_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Tag`
  MODIFY `Tad_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Ticket`
  MODIFY `Ticket_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `User`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Chip_Cow_User`
  ADD CONSTRAINT `FK_Chip_Id_CCU_Chip` FOREIGN KEY (`Chip_Id`) REFERENCES `Chip` (`Chip_Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Cow_Id_CCU_Cow` FOREIGN KEY (`Cow_Id`) REFERENCES `Cow` (`Cow_Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_Id_CCU_User` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Data_Sensor`
  ADD CONSTRAINT `FK_Average_Id_Data_Sensor_Average` FOREIGN KEY (`Average_Id`) REFERENCES `Average` (`Average_Id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Chip_Id_Data_Sensor_Chip` FOREIGN KEY (`Chip_Id`) REFERENCES `Chip` (`Chip_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Sensor_Id_Data_Sensor_Sensor` FOREIGN KEY (`Sensor_Id`) REFERENCES `Sensor` (`Sensor_Id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `Permission`
  ADD CONSTRAINT `FK_Page_Id_Permission_Page` FOREIGN KEY (`Page_Id`) REFERENCES `Page` (`Page_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Role_Id_Permission_Role` FOREIGN KEY (`Role_Id`) REFERENCES `Role` (`Role_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Ticket`
  ADD CONSTRAINT `FK_Status_Id_Ticket_Status` FOREIGN KEY (`Status_Id`) REFERENCES `Status` (`Status_Id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Tag_Id_Ticket_Tag` FOREIGN KEY (`Tag_Id`) REFERENCES `Tag` (`Tad_Id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_Id_Ticket_User` FOREIGN KEY (`User_Id`) REFERENCES `User` (`User_Id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `User`
  ADD CONSTRAINT `FK_Role_Id_User_Role` FOREIGN KEY (`Role_Id`) REFERENCES `Role` (`Role_Id`) ON UPDATE CASCADE;
COMMIT;

