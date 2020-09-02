-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 02:47 AM
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
-- Table structure for table `acs_address`
--

CREATE TABLE `acs_address` (
  `addr_id` int(11) NOT NULL,
  `fk_prof_id` int(2) NOT NULL,
  `fk_sa_id` int(2) NOT NULL,
  `company` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `cross_street` varchar(100) NOT NULL,
  `subdivision` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone_home` varchar(50) NOT NULL,
  `phone_cell` varchar(50) NOT NULL,
  `phone_alternate` varchar(50) NOT NULL,
  `contact1_firstname` varchar(100) NOT NULL,
  `contact1_lastname` varchar(11) NOT NULL,
  `contact1_phone` varchar(100) NOT NULL,
  `contact1_phone_type` varchar(10) NOT NULL,
  `contact1_relationship` varchar(100) NOT NULL,
  `contact2_firstname` varchar(100) NOT NULL,
  `contact2_lastname` varchar(100) NOT NULL,
  `contact2_phone` varchar(50) NOT NULL,
  `contact2_phone_type` varchar(10) NOT NULL,
  `contact2_relationship` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acs_address`
--

INSERT INTO `acs_address` (`addr_id`, `fk_prof_id`, `fk_sa_id`, `company`, `address`, `cross_street`, `subdivision`, `city`, `state`, `zip`, `country`, `phone_home`, `phone_cell`, `phone_alternate`, `contact1_firstname`, `contact1_lastname`, `contact1_phone`, `contact1_phone_type`, `contact1_relationship`, `contact2_firstname`, `contact2_lastname`, `contact2_phone`, `contact2_phone_type`, `contact2_relationship`) VALUES
(1, 3, 3, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asf', 'Canada', '345', '345', '34543', 'asd', 'sdfg', '564', 'Cell', 'EMP', 'fdgh', 'fghf', '546', 'Fax', 'DLR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_address`
--
ALTER TABLE `acs_address`
  ADD PRIMARY KEY (`addr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_address`
--
ALTER TABLE `acs_address`
  MODIFY `addr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
