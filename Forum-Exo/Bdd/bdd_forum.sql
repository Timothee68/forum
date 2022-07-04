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

-- Listage des données de la table forum.message : ~6 rows (environ)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`id_message`, `topic_id`, `user_id`, `creation_message`, `content`) VALUES
	(1, 1, 3, '2022-06-17 11:37:29', 'testdffhdfuhgfdugh'),
	(2, 2, 2, '2022-06-17 11:37:55', 'jihkjug'),
	(3, 1, 1, '2022-06-17 11:38:05', 'oikhgjuyfhdgtrefd'),
	(4, 1, 2, '2022-06-17 11:38:16', 'yiujysefq'),
	(5, 1, 4, '2022-06-17 11:38:32', '^poiutyr'),
	(6, 4, 1, '2022-06-17 11:38:53', 'i,puoyvftrhqz');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- Listage des données de la table forum.topic : ~4 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `user_id`, `title`, `creation_topic`) VALUES
	(1, 1, 'topic1', '2022-06-17 11:36:30'),
	(2, 2, 'topic2', '2022-06-17 11:36:40'),
	(3, 1, 'topic3', '2022-06-17 11:37:01'),
	(4, 3, 'topic4', '2022-06-17 11:37:11');
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage des données de la table forum.user : ~4 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `pseudo`, `email`, `password`, `creation_date`, `status`, `role`) VALUES
	(1, 'user1', 'user1@exemple.fr', 'test1', '2022-06-17 11:34:55', NULL, NULL),
	(2, 'user2', 'user2@exemple.fr', 'test2', '2022-06-17 11:35:30', NULL, NULL),
	(3, 'user3', 'user3@exemple.fr', 'test3', '2022-06-17 11:35:52', NULL, NULL),
	(4, 'user4', 'user4@exemple.fr', 'test4', '2022-06-17 11:36:12', NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
