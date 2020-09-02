-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2020 at 01:30 PM
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
-- Table structure for table `accounting_chart_of_accounts`
--

CREATE TABLE `accounting_chart_of_accounts` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `acc_detail_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sub_acc_id` int(11) DEFAULT NULL,
  `time` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `time_date` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_chart_of_accounts`
--

INSERT INTO `accounting_chart_of_accounts` (`id`, `account_id`, `acc_detail_id`, `name`, `description`, `sub_acc_id`, `time`, `balance`, `time_date`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 9, 'Other Primary Income', 'descp', 2, 'Other', '2000', '22.07.2020', 1, '2020-07-16 13:18:54', '0000-00-00 00:00:00'),
(2, 1, 5, 'Savings', 'descp', 2, 'Other', '3000', '30.07.2020', 1, '2020-07-16 13:19:05', '0000-00-00 00:00:00'),
(8, 1, 1, 'Cash on hand 1', 'descp', 1, 'Other', '1000', '14.07.2020', 1, '2020-07-28 13:20:53', '0000-00-00 00:00:00'),
(15, 2, 9, 'savings', 'descp123', 2, 'other', '4000', '31.07.2020', 1, '2020-08-01 10:17:16', '2020-08-01 10:17:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_chart_of_accounts`
--
ALTER TABLE `accounting_chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `acc_detail_id` (`acc_detail_id`),
  ADD KEY `sub_acc_id` (`sub_acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_chart_of_accounts`
--
ALTER TABLE `accounting_chart_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
