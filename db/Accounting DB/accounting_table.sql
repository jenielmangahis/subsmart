-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 02:58 PM
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
-- Table structure for table `accounting_bill`
--

CREATE TABLE `accounting_bill` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mailing_address` text NOT NULL,
  `terms` varchar(255) NOT NULL,
  `bill_date` date NOT NULL,
  `due_date` date NOT NULL,
  `bill_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_bill`
--

INSERT INTO `accounting_bill` (`id`, `vendor_id`, `mailing_address`, `terms`, `bill_date`, `due_date`, `bill_number`, `permit_number`) VALUES
(1, 1, 'Abacus Accounting', 'Due on receipt', '2020-07-22', '2020-07-25', 123, 1234);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense`
--

CREATE TABLE `accounting_expense` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `payment_account` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `ref_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense`
--

INSERT INTO `accounting_expense` (`id`, `vendor_id`, `payment_account`, `payment_date`, `payment_method`, `ref_number`, `permit_number`) VALUES
(1, 1, 'Cash on hand', '2020-07-22', 'Cash', 4646, 6548);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_paydown`
--

CREATE TABLE `accounting_paydown` (
  `id` int(11) NOT NULL,
  `credit_card_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `date_payment` date NOT NULL,
  `payment_account` varchar(255) NOT NULL,
  `check_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_paydown`
--

INSERT INTO `accounting_paydown` (`id`, `credit_card_id`, `amount`, `date_payment`, `payment_account`, `check_number`) VALUES
(1, 1, '455.00', '2020-07-23', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_time_activity`
--

CREATE TABLE `accounting_time_activity` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `customer` varchar(255) NOT NULL,
  `service` text NOT NULL,
  `billable` int(3) NOT NULL,
  `start_end_times` int(3) NOT NULL,
  `time` time NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_time_activity`
--

INSERT INTO `accounting_time_activity` (`id`, `date`, `customer`, `service`, `billable`, `start_end_times`, `time`, `description`) VALUES
(1, '2020-07-22 00:00:00', 'BillieJoe', 'Credit', 0, 0, '17:05:00', 'Hello world');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_vendor_credit`
--

CREATE TABLE `accounting_vendor_credit` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mailing_address` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `ref_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_vendor_credit`
--

INSERT INTO `accounting_vendor_credit` (`id`, `vendor_id`, `mailing_address`, `payment_date`, `ref_number`, `permit_number`) VALUES
(1, 1, 'Abacus Accounting', '2020-07-22', 4646, 545464),
(2, 2, 'Absolute Power', '2020-07-22', 21534, 16498);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_bill`
--
ALTER TABLE `accounting_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense`
--
ALTER TABLE `accounting_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_paydown`
--
ALTER TABLE `accounting_paydown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_time_activity`
--
ALTER TABLE `accounting_time_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_vendor_credit`
--
ALTER TABLE `accounting_vendor_credit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_bill`
--
ALTER TABLE `accounting_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounting_expense`
--
ALTER TABLE `accounting_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounting_paydown`
--
ALTER TABLE `accounting_paydown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounting_time_activity`
--
ALTER TABLE `accounting_time_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounting_vendor_credit`
--
ALTER TABLE `accounting_vendor_credit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
