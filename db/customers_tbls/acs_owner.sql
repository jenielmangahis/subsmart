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
-- Table structure for table `acs_owner`
--

CREATE TABLE `acs_owner` (
  `own_id` int(11) NOT NULL,
  `fk_prof_id` int(11) NOT NULL,
  `own_ssn` varchar(50) NOT NULL,
  `own_fname` varchar(100) NOT NULL,
  `own_lname` varchar(100) NOT NULL,
  `own_address` varchar(250) NOT NULL,
  `own_city` varchar(50) NOT NULL,
  `own_state` varchar(50) NOT NULL,
  `own_zip` varchar(20) NOT NULL,
  `own_pay_history` varchar(100) NOT NULL,
  `own_sign` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_owner`
--
ALTER TABLE `acs_owner`
  ADD PRIMARY KEY (`own_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_owner`
--
ALTER TABLE `acs_owner`
  MODIFY `own_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
