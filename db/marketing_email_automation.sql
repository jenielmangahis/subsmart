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

-- Dumping structure for table admintom_nsmart_companies.marketing_email_automation
DROP TABLE IF EXISTS `marketing_email_automation`;
CREATE TABLE IF NOT EXISTS `marketing_email_automation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rule_event` varchar(255) NOT NULL,
  `rule_notify_at` varchar(255) NOT NULL,
  `rule_notify_op` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=after event, 1=before event',
  `name` varchar(255) NOT NULL,
  `customer_type_service` tinyint(4) NOT NULL DEFAULT '0',
  `email_automation_template_id` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table admintom_nsmart_companies.marketing_email_automation: ~0 rows (approximately)
DELETE FROM `marketing_email_automation`;
/*!40000 ALTER TABLE `marketing_email_automation` DISABLE KEYS */;
/*!40000 ALTER TABLE `marketing_email_automation` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
