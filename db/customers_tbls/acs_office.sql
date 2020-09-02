-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 02:48 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsmartrac`
--

-- --------------------------------------------------------

--
-- Table structure for table `acs_office`
--

CREATE TABLE `acs_office` (
  `off_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `welcome_sent` int(2) NOT NULL,
  `rebate` int(2) NOT NULL,
  `commision_scheme` int(2) NOT NULL,
  `rep_comm` decimal(10,2) NOT NULL,
  `rep_upfront_pay` decimal(10,2) NOT NULL,
  `tech_comm` decimal(10,2) NOT NULL,
  `tech_upfront_pay` decimal(10,2) NOT NULL,
  `rep_charge_back` decimal(10,2) NOT NULL,
  `rep_payroll_charge_back` decimal(10,2) NOT NULL,
  `pso` int(2) NOT NULL,
  `points_include` int(11) NOT NULL,
  `price_per_point` decimal(10,2) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `purchase_multiple` decimal(10,2) NOT NULL,
  `purchase_discount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_office`
--

INSERT INTO `acs_office` (`off_id`, `fk_prof_id`, `welcome_sent`, `rebate`, `commision_scheme`, `rep_comm`, `rep_upfront_pay`, `tech_comm`, `tech_upfront_pay`, `rep_charge_back`, `rep_payroll_charge_back`, `pso`, `points_include`, `price_per_point`, `purchase_price`, `purchase_multiple`, `purchase_discount`) VALUES
(1, 3, 0, 1, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1, 0, '0.00', '3456.00', '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_office`
--
ALTER TABLE `acs_office`
  ADD PRIMARY KEY (`off_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_office`
--
ALTER TABLE `acs_office`
  MODIFY `off_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
