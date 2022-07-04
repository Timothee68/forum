-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;

-- Listage de la structure de la table forum. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `creationMessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_message`),
  KEY `message_user` (`user_id`),
  KEY `message_topic` (`topic_id`),
  CONSTRAINT `message_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `message_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.message : ~18 rows (environ)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`id_message`, `topic_id`, `user_id`, `text`, `creationMessage`) VALUES
	(1, 1, 3, 'testBenoit', '2022-06-17 11:39:02'),
	(2, 4, 3, 'testBenoit2', '2022-06-17 11:39:18'),
	(3, 1, 2, 'testEfdal', '2022-06-17 11:39:35'),
	(4, 2, 1, 'testTim1', '2022-06-17 11:39:48'),
	(5, 3, 2, 'testEfdal2', '2022-06-17 11:40:00'),
	(6, 2, 1, 'testTim2', '2022-06-17 11:40:17'),
	(7, 1, 3, 'testBenoit3', '2022-06-20 13:28:13'),
	(8, 1, 1, 'testTim3', '2022-06-20 14:48:23'),
	(9, 1, 1, 'testTim4', '2022-06-20 15:07:22'),
	(10, 1, 1, 'je test', '2022-06-20 19:48:22'),
	(11, 1, 1, 'je test', '2022-06-20 19:49:45'),
	(12, 1, 1, 'je test', '2022-06-20 19:50:44'),
	(13, 1, 1, 'je suis partie \r\n', '2022-06-20 19:52:09'),
	(14, 2, 2, ' grou', '2022-06-20 20:03:56'),
	(15, 2, 2, 'coucou', '2022-06-20 20:04:54'),
	(16, 23, 2, 'croooopi', '2022-06-20 20:07:20'),
	(41, 23, 1, 'aller  maaaarche\r\n', '2022-06-21 16:53:03'),
	(42, 23, 1, 'je ', '2022-06-23 16:02:17'),
	(43, 23, 1, 'cc', '2022-06-23 19:54:22'),
	(44, 23, 1, 'cc', '2022-06-23 19:56:48');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- Listage de la structure de la table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `dateTopic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `topic_user` (`user_id`),
  CONSTRAINT `topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.topic : ~7 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `user_id`, `title`, `dateTopic`, `closed`) VALUES
	(1, 2, 'topic1', '2022-06-17 11:37:35', NULL),
	(2, 3, 'topic2', '2022-06-17 11:37:54', NULL),
	(3, 1, 'topic3', '2022-06-17 11:38:18', NULL),
	(4, 2, 'topic4', '2022-06-17 11:38:43', NULL),
	(23, 3, 'Comment Cancel Slide sur Warzone ?', '2022-06-20 19:45:39', NULL),
	(27, 3, 'coucou', '2022-06-21 10:13:52', NULL),
	(28, 3, 'couocuocuc', '2022-06-21 16:45:29', NULL);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0',
  `role` varchar(50) DEFAULT 'membre',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.user : ~6 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `pseudo`, `email`, `password`, `creationDate`, `status`, `role`) VALUES
	(1, 'timlacascade', 'test@test.test', 'test', '2022-06-17 11:34:34', 0, 'membre'),
	(2, 'sultanefdal', 'exemple@exemple.exemple', 'exemple', '2022-06-17 11:35:36', 0, 'membre'),
	(3, 'benoitproteste', 'proteste@proteste.proteste', 'proteste', '2022-06-17 11:36:40', 0, 'admin'),
	(4, 'quiqui', 'exemple@exemple.com', '$2y$10$n7GSQCWnDMJ2eSJWKLCZkeOuUf93HknaRwtiIZDl40pTys/Pr3rzy', '2022-06-23 11:55:39', 0, 'membre'),
	(5, '', '', '$2y$10$STsOAis/sDoahvN4XP3oiuc1RKTNiIML6.8vzUYhMH8Xncan96qvi', '2022-06-23 19:27:49', 0, 'membre');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
