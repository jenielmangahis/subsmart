-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 05:18 PM
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
-- Table structure for table `accounting_reconcile_has_servicecharge_history`
--

CREATE TABLE `accounting_reconcile_has_servicecharge_history` (
  `id` int(11) NOT NULL,
  `reconcile_id` int(11) NOT NULL,
  `chart_of_accounts_id` int(11) DEFAULT NULL,
  `expense_account_sub` varchar(255) DEFAULT NULL,
  `service_charge_sub` varchar(255) DEFAULT NULL,
  `descp_sc_sub` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_reconcile_has_servicecharge_history`
--

INSERT INTO `accounting_reconcile_has_servicecharge_history` (`id`, `reconcile_id`, `chart_of_accounts_id`, `expense_account_sub`, `service_charge_sub`, `descp_sc_sub`) VALUES
(11, 4, 2, 'Cash on hand', '10.00', 'tendescp'),
(12, 4, 2, 'Cash on hand', '20.00', 'tendescp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_reconcile_has_servicecharge_history`
--
ALTER TABLE `accounting_reconcile_has_servicecharge_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reconcile_id` (`reconcile_id`),
  ADD KEY `chart_of_accounts_id` (`chart_of_accounts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_reconcile_has_servicecharge_history`
--
ALTER TABLE `accounting_reconcile_has_servicecharge_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
