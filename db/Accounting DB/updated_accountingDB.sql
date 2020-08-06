-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2020 at 10:53 AM
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
  `transaction_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mailing_address` text NOT NULL,
  `terms` varchar(255) NOT NULL,
  `bill_date` date NOT NULL,
  `due_date` date NOT NULL,
  `bill_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accounting_check`
--

CREATE TABLE `accounting_check` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
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

INSERT INTO `accounting_check` (`id`, `transaction_id`, `vendor_id`, `bank_id`, `mailing_address`, `payment_date`, `check_number`, `print_later`, `permit_number`) VALUES
(6, 11, 1, 1, 'asdfsdfsadf', '2020-08-07', 2, 1, 1234);

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
-- Table structure for table `accounting_expense_category`
--

CREATE TABLE `accounting_expense_category` (
  `id` int(11) NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense_category`
--

INSERT INTO `accounting_expense_category` (`id`, `transaction_type_id`, `category`, `description`, `amount`) VALUES
(4, 6, 'Bad Debts', 'sadfasdfsd', '130.00');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense_transaction`
--

CREATE TABLE `accounting_expense_transaction` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense_transaction`
--

INSERT INTO `accounting_expense_transaction` (`id`, `type`, `date_created`, `date_modified`) VALUES
(11, 'Check', '2020-07-31 11:33:10', '2020-07-31 11:33:10');

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
-- Indexes for table `accounting_check`
--
ALTER TABLE `accounting_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense`
--
ALTER TABLE `accounting_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense_category`
--
ALTER TABLE `accounting_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense_transaction`
--
ALTER TABLE `accounting_expense_transaction`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounting_check`
--
ALTER TABLE `accounting_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `accounting_expense`
--
ALTER TABLE `accounting_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounting_expense_category`
--
ALTER TABLE `accounting_expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `accounting_expense_transaction`
--
ALTER TABLE `accounting_expense_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `accounting_vendor_credit`
--
ALTER TABLE `accounting_vendor_credit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
