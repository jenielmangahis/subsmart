-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2020 at 10:41 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admintom_nsmart_b`
--

-- --------------------------------------------------------

--
-- Table structure for table `nsmart_features`
--

DROP TABLE IF EXISTS `nsmart_features`;
CREATE TABLE `nsmart_features` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `feature_description` text COLLATE utf8_unicode_ci NOT NULL,
  `plan_heading_id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nsmart_features`
--

INSERT INTO `nsmart_features` (`id`, `feature_name`, `feature_description`, `plan_heading_id`, `date_created`, `date_updated`) VALUES
(1, 'FEATURE AAA', 'TEST AAA', 2, '2020-08-10 05:20:39', NULL),
(2, 'FEATURE AAA', 'TEST AAA', 2, '2020-08-10 05:21:49', NULL),
(3, 'FEATURE BBBB', 'BBBB', 2, '2020-08-10 05:45:33', NULL),
(4, 'FEATURE CCC', 'CC', 1, '2020-08-10 06:11:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nsmart_plans_has_modules`
--

DROP TABLE IF EXISTS `nsmart_plans_has_modules`;
CREATE TABLE `nsmart_plans_has_modules` (
  `nsmart_plans_id` int(11) NOT NULL,
  `nsmart_feature_id` int(11) NOT NULL,
  `plan_heading_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nsmart_plans_has_modules`
--

INSERT INTO `nsmart_plans_has_modules` (`nsmart_plans_id`, `nsmart_feature_id`, `plan_heading_id`) VALUES
(1, 2, 1),
(1, 3, 2),
(1, 4, 1),
(2, 2, 1),
(2, 3, 2),
(2, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nsmart_features`
--
ALTER TABLE `nsmart_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nsmart_plans_has_modules`
--
ALTER TABLE `nsmart_plans_has_modules`
  ADD PRIMARY KEY (`nsmart_plans_id`,`nsmart_feature_id`,`plan_heading_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nsmart_features`
--
ALTER TABLE `nsmart_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
