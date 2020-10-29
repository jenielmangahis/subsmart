-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2020 at 01:47 PM
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
-- Table structure for table `accounting_reconcile_has_servicecharge_check`
--

CREATE TABLE `accounting_reconcile_has_servicecharge_check` (
  `id` int(11) NOT NULL,
  `mainid` int(11) NOT NULL,
  `reconcile_id` int(11) NOT NULL,
  `chart_of_accounts_id` int(11) NOT NULL,
  `expense_account_sub` varchar(255) NOT NULL,
  `service_charge_sub` varchar(255) DEFAULT NULL,
  `descp_sc_sub` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_reconcile_has_servicecharge_check`
--

INSERT INTO `accounting_reconcile_has_servicecharge_check` (`id`, `mainid`, `reconcile_id`, `chart_of_accounts_id`, `expense_account_sub`, `service_charge_sub`, `descp_sc_sub`) VALUES
(1, 5, 4, 2, 'Corporate Account (XXXXXX 5850)', '10', 'd'),
(2, 6, 4, 2, 'Cash on hand', '3', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_reconcile_has_servicecharge_check`
--
ALTER TABLE `accounting_reconcile_has_servicecharge_check`
  ADD PRIMARY KEY (`id`,`expense_account_sub`),
  ADD KEY `reconcile_id` (`reconcile_id`),
  ADD KEY `chart_of_accounts_id` (`chart_of_accounts_id`),
  ADD KEY `mainid` (`mainid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_reconcile_has_servicecharge_check`
--
ALTER TABLE `accounting_reconcile_has_servicecharge_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
