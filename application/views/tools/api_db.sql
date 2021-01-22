-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2021 at 08:17 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsmartrac`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_menu`
--

DROP TABLE IF EXISTS `api_menu`;
CREATE TABLE `api_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_title` char(55) NOT NULL,
  `menu_link` char(100) NOT NULL,
  `menu_icon` char(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This is for api connectors menu';

--
-- Dumping data for table `api_menu`
--

INSERT INTO `api_menu` (`menu_id`, `menu_title`, `menu_link`, `menu_icon`) VALUES
(1, 'Connectors', 'tools/api_connectors', 'fa-user'),
(2, 'Google Contacts', 'tools/google_contacts', 'fa-user'),
(3, 'Quickbooks Payroll', 'tools/quickbooks', 'fa-user'),
(4, 'NiceJob', 'tools/nicejob', 'fa-user'),
(5, 'Zapier', 'tools/zapier', ''),
(6, 'Mailchimp', 'tools/mailchimp', ''),
(7, 'Active Campaign', 'tools/active_campaign', ''),
(8, 'API Integration', 'tools/api_integration', ''),
(9, 'Zillow', 'tools/zillow\r\n', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_menu`
--
ALTER TABLE `api_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_menu`
--
ALTER TABLE `api_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
