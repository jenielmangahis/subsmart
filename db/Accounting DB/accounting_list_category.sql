-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2020 at 12:13 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admintom_nsmart_companies`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_list_category`
--

CREATE TABLE `accounting_list_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sub_account` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_list_category`
--

INSERT INTO `accounting_list_category` (`id`, `category_name`, `display_name`, `type`, `description`, `sub_account`, `date_created`, `status`) VALUES
(1, 'Advertising', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1),
(2, 'Bad Debts', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1),
(3, 'Bank Charges', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1),
(4, 'Commissions & Fees', '', 'Expenses', '', '', '0000-00-00 00:00:00', 1),
(6, 'Advertising/Promotional', 'Advertising/Promotional', 'Equity', '', 'Enter parent account', '2020-08-12 00:00:00', 1),
(7, 'Bank Charges', 'Bank Charges', 'Fixed assets', '', 'Enter parent account', '2020-08-12 04:53:10', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_list_category`
--
ALTER TABLE `accounting_list_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_list_category`
--
ALTER TABLE `accounting_list_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
