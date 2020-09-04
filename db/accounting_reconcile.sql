-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2020 at 03:58 PM
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
  `adjustment_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_reconcile`
--

INSERT INTO `accounting_reconcile` (`id`, `chart_of_accounts_id`, `ending_balance`, `ending_date`, `first_date`, `service_charge`, `expense_account`, `second_date`, `interest_earned`, `income_account`, `adjustment_date`) VALUES
(2, 1, '2000', '28.08.2020', '28.08.2020', '200', 'Cash on hand', '20.08.2020', '20', 'Cash on hand', '20.08.2020');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
