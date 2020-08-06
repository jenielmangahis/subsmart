-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2020 at 01:09 PM
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
  `permit_number` int(11) NOT NULL,
  `memo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_bill`
--

INSERT INTO `accounting_bill` (`id`, `transaction_id`, `vendor_id`, `mailing_address`, `terms`, `bill_date`, `due_date`, `bill_number`, `permit_number`, `memo`) VALUES
(6, 12, 2, 'hello world', 'Net 30', '2020-08-05', '2020-08-08', 3665, 6655, '');

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
(6, 11, 1, 1, 'asdfsdfsadf', '2020-08-07', 2, 1, 1234),
(39, 53, 1, 3, 'asdfsadfsdf', '2020-08-27', 3, 1, 5555);

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
(71, 31, 'Bank text', 'Doesn\'t contain', 'sample text'),
(109, 0, 'Description', 'Contain', ''),
(110, 0, 'Bank text', 'Doesn\'t contain', 'sample text 2 '),
(111, 0, 'Description', 'Contain', '');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense`
--

CREATE TABLE `accounting_expense` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `payment_account` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `ref_number` int(11) NOT NULL,
  `permit_number` int(11) NOT NULL,
  `memo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense`
--

INSERT INTO `accounting_expense` (`id`, `transaction_id`, `vendor_id`, `payment_account`, `payment_date`, `payment_method`, `ref_number`, `permit_number`, `memo`) VALUES
(2, 13, 2, '2', '2020-08-06', 'Credit Card', 5464664, 6546464, '');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense_category`
--

CREATE TABLE `accounting_expense_category` (
  `id` int(11) NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense_category`
--

INSERT INTO `accounting_expense_category` (`id`, `transaction_type_id`, `category`, `description`, `amount`) VALUES
(4, 6, 'Bad Debts', 'sadfasdfsd', '130.00'),
(29, 39, 'Bank Charges', 'new text', '130.00'),
(30, 39, 'Bank Charges', 'new text', '130.00'),
(31, 39, 'Bank Charges', 'new text', '130.00'),
(32, 39, 'Bank Charges', 'new text', '130.00'),
(33, 39, 'Bank Charges', 'new text', '130.00');

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
(11, 'Check', '2020-07-31 11:33:10', '2020-07-31 11:33:10'),
(12, 'Bill', '2020-08-03 10:19:47', '2020-08-03 10:19:47'),
(13, 'Expense', '2020-08-03 11:12:22', '2020-08-03 11:12:22'),
(53, 'Check', '2020-08-04 11:07:16', '2020-08-04 11:07:16');

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
-- Indexes for table `accounting_conditions`
--
ALTER TABLE `accounting_conditions`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_bill`
--
ALTER TABLE `accounting_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `accounting_check`
--
ALTER TABLE `accounting_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `accounting_conditions`
--
ALTER TABLE `accounting_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `accounting_expense`
--
ALTER TABLE `accounting_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accounting_expense_category`
--
ALTER TABLE `accounting_expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `accounting_expense_transaction`
--
ALTER TABLE `accounting_expense_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
