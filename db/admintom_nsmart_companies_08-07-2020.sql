-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2020 at 02:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1= active',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_name`, `status`, `company_id`) VALUES
(1, 'Bank', 1, NULL),
(2, 'Income', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_has_account_details`
--

CREATE TABLE `accounts_has_account_details` (
  `account_id` int(11) NOT NULL,
  `acc_detail_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_has_account_details`
--

INSERT INTO `accounts_has_account_details` (`account_id`, `acc_detail_id`, `company_id`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(2, 7, NULL),
(2, 8, NULL),
(2, 9, NULL),
(2, 10, NULL),
(2, 11, NULL),
(2, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_detail`
--

CREATE TABLE `account_detail` (
  `acc_detail_id` int(11) NOT NULL,
  `acc_detail_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = active',
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_detail`
--

INSERT INTO `account_detail` (`acc_detail_id`, `acc_detail_name`, `status`, `company_id`) VALUES
(1, 'Cash on hand', 1, NULL),
(2, 'Checking', 1, NULL),
(3, 'Money market', 1, NULL),
(4, 'Rents Held in Trust', 1, NULL),
(5, 'Savings', 1, NULL),
(6, 'Trust account', 1, NULL),
(7, 'Discounts/Refunds Given', 1, NULL),
(8, 'Non-Profit Income', 1, NULL),
(9, 'Other Primary Income', 1, NULL),
(10, 'Sales of Product Income', 1, NULL),
(11, 'Service/Fee Income', 1, NULL),
(12, 'Unapplied Cash Payment Income', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_has_account_details`
--
ALTER TABLE `accounts_has_account_details`
  ADD PRIMARY KEY (`account_id`,`acc_detail_id`);

--
-- Indexes for table `account_detail`
--
ALTER TABLE `account_detail`
  ADD PRIMARY KEY (`acc_detail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `account_detail`
--
ALTER TABLE `account_detail`
  MODIFY `acc_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
