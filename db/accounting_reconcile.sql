-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2020 at 11:24 AM
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
-- Table structure for table `accounting_reconcile`
--

CREATE TABLE `accounting_reconcile` (
  `id` int(11) NOT NULL,
  `chart_of_accounts_id` int(11) NOT NULL,
  `ending_balance` varchar(255) NOT NULL,
  `ending_date` varchar(255) NOT NULL,
  `first_date` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `expense_account` varchar(255) NOT NULL,
  `second_date` varchar(255) NOT NULL,
  `interest_earned` varchar(255) NOT NULL,
  `income_account` varchar(255) NOT NULL,
  `adjustment_date` varchar(255) DEFAULT NULL,
  `CHRG` varchar(255) NOT NULL DEFAULT 'SVCCHRG',
  `memo_sc` varchar(255) NOT NULL DEFAULT 'Service Charge',
  `memo_it` varchar(255) NOT NULL DEFAULT 'Interest Earned',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_reconcile`
--

INSERT INTO `accounting_reconcile` (`id`, `chart_of_accounts_id`, `ending_balance`, `ending_date`, `first_date`, `service_charge`, `expense_account`, `second_date`, `interest_earned`, `income_account`, `adjustment_date`, `CHRG`, `memo_sc`, `memo_it`, `active`) VALUES
(2, 1, '2000', '28.08.2019', '28.08.2020', '200', 'Cash on hand', '20.08.2020', '20', 'Cash on hand', '08.08.2020', 'SVCCHRG', 'Service Charge', 'Interest Earned', 0),
(4, 2, '10000', '09.06.2020', '11.06.2020', '100', 'Corporate Account (XXXXXX 5850)', '20.06.2020', '300', 'Cash on hand', NULL, 'SVCCHRG', 'Service Charge', 'Interest Earned', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_reconcile`
--
ALTER TABLE `accounting_reconcile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chart_of_accounts_id` (`chart_of_accounts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_reconcile`
--
ALTER TABLE `accounting_reconcile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
