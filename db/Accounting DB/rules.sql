-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2020 at 03:04 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

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
-- Table structure for table `accounting_category`
--

CREATE TABLE `accounting_category` (
  `id` int(11) NOT NULL,
  `rules_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accounting_conditions`
--

CREATE TABLE `accounting_conditions` (
  `id` int(11) NOT NULL,
  `rules_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `contain` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_conditions`
--

INSERT INTO `accounting_conditions` (`id`, `rules_id`, `description`, `contain`, `comment`) VALUES
(71, 31, 'Description', 'Contain', '');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_rules`
--

CREATE TABLE `accounting_rules` (
  `id` int(11) NOT NULL,
  `rules_name` varchar(255) NOT NULL,
  `banks` int(11) NOT NULL,
  `apply_type` varchar(255) NOT NULL,
  `include` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `memo` text NOT NULL,
  `auto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_rules`
--

INSERT INTO `accounting_rules` (`id`, `rules_name`, `banks`, `apply_type`, `include`, `transaction_type`, `payee`, `memo`, `auto`) VALUES
(31, 'Sample name', 1, 'in', 'all', 'Expenses', 'Advertising', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_category`
--
ALTER TABLE `accounting_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_conditions`
--
ALTER TABLE `accounting_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_rules`
--
ALTER TABLE `accounting_rules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_category`
--
ALTER TABLE `accounting_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `accounting_conditions`
--
ALTER TABLE `accounting_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `accounting_rules`
--
ALTER TABLE `accounting_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
