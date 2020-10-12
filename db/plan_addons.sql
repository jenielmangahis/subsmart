-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table admintom_nsmart_companies.plan_addons
CREATE TABLE IF NOT EXISTS `plan_addons` (
  `id` int(110) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0=disable,1=enable',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table admintom_nsmart_companies.plan_addons: ~2 rows (approximately)
DELETE FROM `plan_addons`;
/*!40000 ALTER TABLE `plan_addons` DISABLE KEYS */;
INSERT INTO `plan_addons` (`id`, `name`, `description`, `price`, `status`, `date_created`, `date_updated`) VALUES
	(4, 'Survey Builder', 'Survey Builder', 5, 1, '2020-10-09 18:17:06', '2020-10-09 18:17:06'),
	(5, 'Online Booking', 'Online Booking', 5, 1, '2020-10-09 19:19:43', '2020-10-09 06:19:43'),
	(7, 'Lead Contact Form', 'Lead Contact Form', 5, 1, '2020-10-09 06:46:10', NULL);
/*!40000 ALTER TABLE `plan_addons` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
