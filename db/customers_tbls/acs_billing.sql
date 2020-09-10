-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2020 at 05:15 AM
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
-- Table structure for table `acs_billing`
--

CREATE TABLE `acs_billing` (
  `bill_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `card_fname` varchar(100) NOT NULL,
  `card_lname` varchar(100) NOT NULL,
  `card_address` varchar(250) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `mmr` decimal(10,2) NOT NULL,
  `bill_freq` varchar(30) NOT NULL,
  `bill_day` int(2) NOT NULL,
  `contract_term` int(2) NOT NULL,
  `bill_method` varchar(100) NOT NULL,
  `bill_start_date` varchar(20) NOT NULL,
  `bill_end_date` varchar(20) NOT NULL,
  `check_num` varchar(100) NOT NULL,
  `routing_num` varchar(100) NOT NULL,
  `acct_num` varchar(100) NOT NULL,
  `credit_card_num` int(20) NOT NULL,
  `credit_card_exp` varchar(10) NOT NULL,
  `credit_card_exp_mm_yyyy` varchar(20) NOT NULL,
  `collect_date` varchar(20) NOT NULL,
  `collect_amt` decimal(10,2) NOT NULL,
  `contract_ext_date` varchar(20) NOT NULL,
  `ssn` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_billing`
--
ALTER TABLE `acs_billing`
  ADD PRIMARY KEY (`bill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_billing`
--
ALTER TABLE `acs_billing`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
