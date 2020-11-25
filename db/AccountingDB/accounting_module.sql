-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2020 at 11:40 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `accounting_expense_category`
--

CREATE TABLE `accounting_expense_category` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense_category`
--

INSERT INTO `accounting_expense_category` (`id`, `transaction_id`, `expenses_id`, `category_id`, `description`, `amount`) VALUES
(1, 57, 3, 1, 'losi mo po1313', '120.00'),
(2, 57, 3, 2, 'losi mo po', '130.00'),
(7, 96, 61, 2, 'new text0123', '999.00'),
(8, 96, 61, 4, 'gjgjgjkgjgl', '1.00'),
(9, 91, 4, 3, 'sadfasdfsd', '4645.00');

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense_transaction`
--

CREATE TABLE `accounting_expense_transaction` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_expense_transaction`
--

INSERT INTO `accounting_expense_transaction` (`id`, `type`, `total`, `date_created`, `date_modified`) VALUES
(11, 'Check', 0.00, '2020-07-31 11:33:10', '2020-08-17 22:18:44'),
(13, 'Expense', 0.00, '2020-08-03 11:12:22', '2020-08-18 03:10:38'),
(57, 'Vendor Credit', 0.00, '2020-08-05 11:32:26', '2020-08-19 04:17:01'),
(90, 'Bill', 0.00, '2020-08-10 17:37:45', '2020-08-17 02:07:57'),
(91, 'Vendor Credit', 0.00, '2020-08-18 02:07:13', '2020-08-19 01:11:55'),
(96, 'Check', 0.00, '2020-08-18 20:27:51', '2020-08-19 00:45:06');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `accounting_expense_category`
--
ALTER TABLE `accounting_expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `accounting_expense_transaction`
--
ALTER TABLE `accounting_expense_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
