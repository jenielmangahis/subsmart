-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 10:42 AM
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
-- Table structure for table `accounting_existing_attachment`
--

CREATE TABLE `accounting_existing_attachment` (
  `id` int(11) NOT NULL,
  `attachment_id` int(11) NOT NULL,
  `attachment_from_id` int(11) NOT NULL,
  `trans_from_id` int(11) NOT NULL,
  `expenses_type` varchar(100) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `accounting_expense_attachment`
--

CREATE TABLE `accounting_expense_attachment` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_existing_attachment`
--
ALTER TABLE `accounting_existing_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_expense_attachment`
--
ALTER TABLE `accounting_expense_attachment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_existing_attachment`
--
ALTER TABLE `accounting_existing_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounting_expense_attachment`
--
ALTER TABLE `accounting_expense_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
