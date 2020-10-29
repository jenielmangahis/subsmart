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
-- Table structure for table `accounting_addcheck`
--

CREATE TABLE `accounting_addcheck` (
  `id` int(11) NOT NULL,
  `reconcile_id` int(11) NOT NULL,
  `chart_of_accounts_id` int(11) NOT NULL,
  `check_payee_popup` varchar(255) DEFAULT NULL,
  `check_account_popup` varchar(255) DEFAULT NULL,
  `mailing_address` varchar(255) DEFAULT NULL,
  `checkno` varchar(255) DEFAULT NULL,
  `permitno` varchar(255) DEFAULT NULL,
  `memo_sc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_addcheck`
--

INSERT INTO `accounting_addcheck` (`id`, `reconcile_id`, `chart_of_accounts_id`, `check_payee_popup`, `check_account_popup`, `mailing_address`, `checkno`, `permitno`, `memo_sc`) VALUES
(5, 4, 2, '', '2', 'mailing add', 'SVCCHRG', '', ''),
(6, 4, 2, '', '2', 'mailing add', 'SVCCHRG', '', ''),
(7, 4, 2, '', '2', 'mailing add', 'SVCCHRG', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_addcheck`
--
ALTER TABLE `accounting_addcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reconcile_id` (`reconcile_id`),
  ADD KEY `chart_of_accounts_id` (`chart_of_accounts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_addcheck`
--
ALTER TABLE `accounting_addcheck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
