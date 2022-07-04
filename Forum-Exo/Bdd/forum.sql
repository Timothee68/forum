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


-- Listage de la structure de la base pour topic_dwwm
CREATE DATABASE IF NOT EXISTS `topic_dwwm` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `topic_dwwm`;

-- Listage de la structure de la table topic_dwwm. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `dateMessage` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `message_user` (`user_id`),
  KEY `message_topic` (`topic_id`),
  CONSTRAINT `message_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `message_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table topic_dwwm.message : ~0 rows (environ)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`id_message`, `text`, `dateMessage`, `user_id`, `topic_id`) VALUES
	(1, 'qscdbn,', '2022-06-17 11:39:02', 3, 1),
	(2, 'q/L§', '2022-06-17 11:39:18', 3, 4),
	(3, 'BQVFCHZERCVUZED', '2022-06-17 11:39:35', 2, 1),
	(4, '??VN UBFRVYZERIO', '2022-06-17 11:39:48', 1, 2),
	(5, 'N HFDVBREBVFNK', '2022-06-17 11:40:00', 2, 3),
	(6, 'HJUCNEZJBUFHCUZE', '2022-06-17 11:40:17', 1, 2);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- Listage de la structure de la table topic_dwwm. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `dateTopic` datetime NOT NULL,
  `lock` tinyint(4) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `topic_user` (`user_id`),
  CONSTRAINT `topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table topic_dwwm.topic : ~0 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `title`, `dateTopic`, `lock`, `user_id`) VALUES
	(1, 'topic1', '2022-06-17 11:37:35', NULL, 2),
	(2, 'topic2', '2022-06-17 11:37:54', NULL, 3),
	(3, 'topic3', '2022-06-17 11:38:18', NULL, 1),
	(4, 'topic4', '2022-06-17 11:38:43', NULL, 2);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table topic_dwwm. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table topic_dwwm.user : ~3 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `nickname`, `email`, `password`, `creationDate`, `role`, `status`) VALUES
	(1, 'timlacascade', 'test@test.test', 'test', '2022-06-17 11:34:34', NULL, NULL),
	(2, 'sultanefdal', 'exemple@exemple.exemple', 'exemple', '2022-06-17 11:35:36', NULL, NULL),
	(3, 'benoitproteste', 'proteste@proteste.proteste', 'proteste', '2022-06-17 11:36:40', NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
