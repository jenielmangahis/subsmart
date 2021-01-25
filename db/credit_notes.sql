-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 03:29 PM
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
-- Database: `admintom_nsmart_e`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit_notes`
--

DROP TABLE IF EXISTS `credit_notes`;
CREATE TABLE `credit_notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refer to acs_profile table',
  `job_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_note_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_issued` date NOT NULL DEFAULT '0000-00-00',
  `expiry_date` date DEFAULT NULL,
  `adjustment_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adjustment_amount` float(11,2) NOT NULL,
  `total_discount` float(11,2) NOT NULL,
  `grand_total` float(11,2) NOT NULL,
  `note_customer` text COLLATE utf8_unicode_ci,
  `terms_condition` text COLLATE utf8_unicode_ci,
  `status` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit_notes`
--
ALTER TABLE `credit_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
