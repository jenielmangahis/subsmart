-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 01:36 PM
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
-- Table structure for table `accounting_check`
--

CREATE TABLE `accounting_check` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `mailing_address` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `check_number` int(11) NOT NULL,
  `print_later` tinyint(4) DEFAULT NULL,
  `permit_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_check`
--

INSERT INTO `accounting_check` (`id`, `vendor_id`, `bank_id`, `mailing_address`, `payment_date`, `check_number`, `print_later`, `permit_number`) VALUES
(3, 1, 1, 'sample', '2020-07-30', 1, 1, 46464);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_check`
--
ALTER TABLE `accounting_check`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_check`
--
ALTER TABLE `accounting_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
