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

-- Dumping structure for table admintom_nsmart_companies.marketing_campaign_blast
DROP TABLE IF EXISTS `marketing_campaign_blast`;
CREATE TABLE IF NOT EXISTS `marketing_campaign_blast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `campaign_name` varchar(200) NOT NULL,
  `postcard_return_address_name` varchar(250) NOT NULL DEFAULT '0',
  `postcard_return_address_address` varchar(250) NOT NULL DEFAULT '0',
  `postcard_return_address_address_secondary` varchar(80) NOT NULL DEFAULT '0',
  `postcard_return_address_city` varchar(100) NOT NULL DEFAULT '0',
  `postcard_return_address_zip` varchar(20) NOT NULL DEFAULT '0',
  `postcard_return_address_state` varchar(50) NOT NULL DEFAULT '0',
  `postcard_return_address_country` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '0' COMMENT 'draft,queue,sent,archived',
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table admintom_nsmart_companies.marketing_campaign_blast: ~2 rows (approximately)
DELETE FROM `marketing_campaign_blast`;
/*!40000 ALTER TABLE `marketing_campaign_blast` DISABLE KEYS */;
INSERT INTO `marketing_campaign_blast` (`id`, `user_id`, `campaign_name`, `postcard_return_address_name`, `postcard_return_address_address`, `postcard_return_address_address_secondary`, `postcard_return_address_city`, `postcard_return_address_zip`, `postcard_return_address_state`, `postcard_return_address_country`, `status`, `date_created`, `date_modified`) VALUES
	(1, 2, 'Sample 1111', '0', '0', '0', '0', '0', '0', '0', 'draft', '2020-09-26 03:28:20', '2020-10-02 03:49:35'),
	(3, 2, 'Sample Again', '0', '0', '0', '0', '0', '0', '0', 'queue', '2020-09-26 04:28:40', '2020-10-02 03:49:47'),
	(4, 2, 'Sample Campaign 2', 'nSmarTrac', 'Old Oak Drive', '123', 'Binan', '4026', 'PA', 'us', 'draft', '2020-10-10 04:52:37', NULL),
	(6, 2, 'Sample 03', 'nSmarTract2', '123 Old Oak Avenue', '1232', 'Santa Rosa', '4026', 'FL', 'us', 'draft', '2020-10-10 04:55:29', NULL);
/*!40000 ALTER TABLE `marketing_campaign_blast` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
