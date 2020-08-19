-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 12:23 PM
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
-- Table structure for table `accounting_expense_attachment`
--

CREATE TABLE `accounting_expense_attachment` (
  `id` int(11) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting_expense_attachment`
--

INSERT INTO `accounting_expense_attachment` (`id`, `expenses_id`, `type`, `original_filename`, `attachment`, `date_created`, `status`) VALUES
(28, 3, 'Vendor Credit', 'us-bank-logo-vector.png', 'dad6baf870c8d87979454a2596a3ffe0.png', '2020-08-17 21:26:56', 1),
(31, 6, 'Check', 'Artboard_230-512.png', 'c44f1fa1ae630b4d76c63f26439e202d.png', '2020-08-17 22:18:44', 1),
(38, 3, 'Vendor Credit', 'Artboard_230-512.png', '0e52a8ba09e373b600f788e5215d7075.png', '2020-08-18 01:15:26', 1),
(39, 4, 'Vendor Credit', 'paypal_PNG20.png', '60849d48afa6b4c0d95d3128986b2863.png', '2020-08-18 02:13:57', 1),
(40, 2, 'Expense', 'Wells_Fargo_Logo_(2020).png', '6c27d49507aa2dc2da924290e672e1e5.png', '2020-08-18 03:10:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_expense_attachment`
--
ALTER TABLE `accounting_expense_attachment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_expense_attachment`
--
ALTER TABLE `accounting_expense_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
