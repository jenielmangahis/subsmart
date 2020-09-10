-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2020 at 05:14 AM
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
  `fk_sa_id_add` int(2) NOT NULL,
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
  MODIFY `addr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
