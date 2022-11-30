-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 30 nov. 2022 à 11:53
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appcow`
--

-- --------------------------------------------------------

--
-- Structure de la table `alert`
--

CREATE TABLE `alert` (
  `Alert_id` int(11) NOT NULL,
  `Alert_type_id` int(11) DEFAULT NULL,
  `Alert_message` varchar(256) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `Sensor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `alert`
--

INSERT INTO `alert` (`Alert_id`, `Alert_type_id`, `Alert_message`, `Status`, `Sensor_id`) VALUES
(1, 2, 'heart frequency sensor', 0, NULL),
(2, 4, 'sound sensor', 1, NULL),
(3, 1, 'jklm', 0, NULL),
(4, 1, 'abcd', 0, NULL),
(5, 3, 'feur', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `alert_type`
--

CREATE TABLE `alert_type` (
  `Alert_type_id` int(11) NOT NULL,
  `Alert_type_name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `alert_type`
--

INSERT INTO `alert_type` (`Alert_type_id`, `Alert_type_name`) VALUES
(1, 'nothing'),
(2, 'low'),
(3, 'moderate'),
(4, 'raised');

-- --------------------------------------------------------

--
-- Structure de la table `average`
--

CREATE TABLE `average` (
  `Average_Id` int(11) NOT NULL,
  `Average_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `average`
--

INSERT INTO `average` (`Average_Id`, `Average_Name`) VALUES
(1, 'Horaire'),
(2, 'Journalier'),
(3, 'Mensuel');

-- --------------------------------------------------------

--
-- Structure de la table `chip`
--

CREATE TABLE `chip` (
  `Chip_id` int(11) NOT NULL,
  `Chip_Number` char(10) NOT NULL,
  `Low_Level` int(11) DEFAULT NULL,
  `Mid_Level` int(11) DEFAULT NULL,
  `High_Level` int(11) DEFAULT NULL,
  `Sensor_id` int(11) DEFAULT NULL,
  `battery` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chip`
--

INSERT INTO `chip` (`Chip_id`, `Chip_Number`, `Low_Level`, `Mid_Level`, `High_Level`, `Sensor_id`, `battery`) VALUES
(1, 'ABCDEF1234', NULL, NULL, NULL, NULL, NULL),
(2, '1234ABCDEF', NULL, NULL, NULL, NULL, NULL),
(3, 'A1BCDEF234', NULL, NULL, NULL, NULL, NULL),
(4, 'AB1CDEF234', NULL, NULL, NULL, NULL, NULL),
(5, 'ABC1DEF234', NULL, NULL, NULL, NULL, NULL),
(6, 'ABCD1EF234', NULL, NULL, NULL, NULL, NULL),
(7, 'ABCDE1F234', NULL, NULL, NULL, NULL, NULL),
(8, 'ABCDEF4321', NULL, NULL, NULL, NULL, NULL),
(9, 'HUGOTUMETB', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `chip_cow_user`
--

CREATE TABLE `chip_cow_user` (
  `Chip_Cow_User_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Cow_Id` int(11) DEFAULT NULL,
  `Chip_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cow`
--

CREATE TABLE `cow` (
  `Cow_Id` int(11) NOT NULL,
  `Cow_Name` varchar(100) DEFAULT NULL,
  `Cow_Number` char(10) DEFAULT NULL,
  `Cow_Img_Url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cow`
--

INSERT INTO `cow` (`Cow_Id`, `Cow_Name`, `Cow_Number`, `Cow_Img_Url`) VALUES
(1, 'Guillemette', 'g2015', NULL),
(2, 'Marguerite', 'm2022', NULL),
(3, 'Josette', 'j2019', NULL),
(4, 'Mike', NULL, NULL),
(5, 'Paquerette', NULL, NULL),
(6, 'Capucine', 'c2011', NULL),
(7, 'Brigitte', 'b2010', NULL),
(8, 'Eglantine', NULL, NULL),
(9, 'Framboise', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `data_sensor`
--

CREATE TABLE `data_sensor` (
  `Data_Sensor_Id` int(11) NOT NULL,
  `Chip_Id` int(11) NOT NULL,
  `Average_Id` int(11) NOT NULL,
  `Value` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Coef` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `FAQ_Id` int(11) NOT NULL,
  `FAQ_Title` varchar(256) NOT NULL,
  `FAQ_Answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`FAQ_Id`, `FAQ_Title`, `FAQ_Answer`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.'),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elementum ullamcorper ante, a maximus ipsum consequat vitae. Vestibulum libero velit, ultrices eget elementum eget, commodo ac tortor. Cras in pellentesque nunc. Aliquam erat volutpat.');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `Page_Id` int(11) NOT NULL,
  `Page_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`Page_Id`, `Page_Name`) VALUES
(5, 'user'),
(6, 'admin/user'),
(7, 'admin/faq'),
(8, 'admin/permission'),
(9, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `Permission_Id` int(11) NOT NULL,
  `Page_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `permission`
--

INSERT INTO `permission` (`Permission_Id`, `Page_Id`, `Role_Id`) VALUES
(7, 5, 1),
(8, 6, 2),
(9, 8, 3),
(10, 7, 2),
(11, 9, 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `Role_Id` int(11) NOT NULL,
  `Role_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`Role_Id`, `Role_Name`) VALUES
(1, 'Utilisateur'),
(2, 'Gestionnaire'),
(3, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `sensor`
--

CREATE TABLE `sensor` (
  `Sensor_Id` int(11) NOT NULL,
  `Sensor_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sensor`
--

INSERT INTO `sensor` (`Sensor_Id`, `Sensor_Name`) VALUES
(1, 'Cardiaque'),
(2, 'Monoxyde de carbone'),
(3, 'Sonore');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `Status_Id` int(11) NOT NULL,
  `Status_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`Status_Id`, `Status_Name`) VALUES
(1, 'ouvert'),
(2, 'fermé'),
(3, 'en cours');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `Tag_Id` int(11) NOT NULL,
  `Tag_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`Tag_Id`, `Tag_Name`) VALUES
(1, 'bug informatique'),
(2, 'problème materiel'),
(3, 'demande d\'informations');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `Ticket_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Tag_Id` int(11) NOT NULL,
  `Status_Id` int(11) NOT NULL,
  `Ticket_Content` text NOT NULL,
  `Ticket_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`Ticket_Id`, `User_Id`, `Tag_Id`, `Status_Id`, `Ticket_Content`, `Ticket_Date`) VALUES
(1, NULL, 3, 3, 'kjlmkjlkj', '2022-10-28'),
(2, NULL, 1, 2, 'khljl', '2022-09-28'),
(3, NULL, 2, 1, 'mlk', '2022-10-27'),
(4, NULL, 2, 2, 'mlkkmjlm', '2022-10-27'),
(5, NULL, 3, 2, 'oijpoi', '2022-09-26');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `User_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL DEFAULT 1,
  `User_Email` varchar(120) NOT NULL,
  `User_Password` varchar(256) NOT NULL,
  `User_Username` varchar(50) DEFAULT NULL,
  `User_Img_Url` varchar(256) DEFAULT NULL,
  `User_Ban` tinyint(1) NOT NULL DEFAULT 0,
  `User_FirstName` varchar(50) NOT NULL,
  `User_LastName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`User_Id`, `Role_Id`, `User_Email`, `User_Password`, `User_Username`, `User_Img_Url`, `User_Ban`, `User_FirstName`, `User_LastName`) VALUES
(7, 1, 'paul@flammarion.eu', '$2y$10$JM41Tvy9WN/A68M2gbRUVuO0HP0TojvYiW2IDm2BZHwBiEn7N8vIi', 'pipaul', NULL, 0, 'Paul', 'Flammarion'),
(8, 3, 'admin@admin.fr', '$2y$10$cit9RGgKP5aOf/lELH5uqeS3.1uyrE341Jb434r32xu7KUOhy6uPy', 'admin', NULL, 0, 'Admin', 'Admin'),
(9, 1, 'user@user.fr', '$2y$10$552s3Y.mEfhPRW2cH4ckC.Qoehlb.Hb1dTDYOqavY5hr7S3Lr9J82', 'user', NULL, 0, 'User', 'User');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`Alert_id`),
  ADD KEY `Alert_alert_type_null_fk` (`Alert_type_id`),
  ADD KEY `alert_sensor_null_fk` (`Sensor_id`);

--
-- Index pour la table `alert_type`
--
ALTER TABLE `alert_type`
  ADD PRIMARY KEY (`Alert_type_id`);

--
-- Index pour la table `average`
--
ALTER TABLE `average`
  ADD PRIMARY KEY (`Average_Id`);

--
-- Index pour la table `chip`
--
ALTER TABLE `chip`
  ADD PRIMARY KEY (`Chip_id`);

--
-- Index pour la table `chip_cow_user`
--
ALTER TABLE `chip_cow_user`
  ADD PRIMARY KEY (`Chip_Cow_User_Id`),
  ADD KEY `FK_User_Id_CCU_User` (`User_Id`),
  ADD KEY `FK_Cow_Id_CCU_Cow` (`Cow_Id`),
  ADD KEY `FK_Chip_Id_CCU_Chip` (`Chip_Id`);

--
-- Index pour la table `cow`
--
ALTER TABLE `cow`
  ADD PRIMARY KEY (`Cow_Id`);

--
-- Index pour la table `data_sensor`
--
ALTER TABLE `data_sensor`
  ADD PRIMARY KEY (`Data_Sensor_Id`),
  ADD KEY `FK_Chip_Id_Data_Sensor_Chip` (`Chip_Id`),
  ADD KEY `FK_Average_Id_Data_Sensor_Average` (`Average_Id`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`FAQ_Id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`Page_Id`);

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`Permission_Id`),
  ADD KEY `FK_Page_Id_Permission_Page` (`Page_Id`),
  ADD KEY `FK_Role_Id_Permission_Role` (`Role_Id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Role_Id`);

--
-- Index pour la table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`Sensor_Id`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Status_Id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`Tag_Id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`Ticket_Id`),
  ADD KEY `FK_User_Id_Ticket_User` (`User_Id`),
  ADD KEY `FK_Tag_Id_Ticket_Tag` (`Tag_Id`),
  ADD KEY `FK_Status_Id_Ticket_Status` (`Status_Id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_Id`),
  ADD KEY `FK_Role_Id_User_Role` (`Role_Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `average`
--
ALTER TABLE `average`
  MODIFY `Average_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `chip`
--
ALTER TABLE `chip`
  MODIFY `Chip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `chip_cow_user`
--
ALTER TABLE `chip_cow_user`
  MODIFY `Chip_Cow_User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `cow`
--
ALTER TABLE `cow`
  MODIFY `Cow_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `data_sensor`
--
ALTER TABLE `data_sensor`
  MODIFY `Data_Sensor_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `FAQ_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `Page_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `Permission_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `Role_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `Sensor_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `Status_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `Tag_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `Ticket_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alert`
--
ALTER TABLE `alert`
  ADD CONSTRAINT `Alert_alert_type_null_fk` FOREIGN KEY (`Alert_type_id`) REFERENCES `alert_type` (`Alert_type_id`),
  ADD CONSTRAINT `alert_sensor_null_fk` FOREIGN KEY (`Sensor_id`) REFERENCES `sensor` (`Sensor_Id`);

--
-- Contraintes pour la table `chip_cow_user`
--
ALTER TABLE `chip_cow_user`
  ADD CONSTRAINT `FK_Chip_Id_CCU_Chip` FOREIGN KEY (`Chip_Id`) REFERENCES `chip` (`Chip_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Cow_Id_CCU_Cow` FOREIGN KEY (`Cow_Id`) REFERENCES `cow` (`Cow_Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_Id_CCU_User` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `data_sensor`
--
ALTER TABLE `data_sensor`
  ADD CONSTRAINT `FK_Average_Id_Data_Sensor_Average` FOREIGN KEY (`Average_Id`) REFERENCES `average` (`Average_Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Chip_Id_Data_Sensor_Chip` FOREIGN KEY (`Chip_Id`) REFERENCES `chip` (`Chip_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `FK_Page_Id_Permission_Page` FOREIGN KEY (`Page_Id`) REFERENCES `page` (`Page_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Role_Id_Permission_Role` FOREIGN KEY (`Role_Id`) REFERENCES `role` (`Role_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_Status_Id_Ticket_Status` FOREIGN KEY (`Status_Id`) REFERENCES `status` (`Status_Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Tag_Id_Ticket_Tag` FOREIGN KEY (`Tag_Id`) REFERENCES `tag` (`Tag_Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_Id_Ticket_User` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_Role_Id_User_Role` FOREIGN KEY (`Role_Id`) REFERENCES `role` (`Role_Id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
