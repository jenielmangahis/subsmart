-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 12:23 PM
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
-- Table structure for table `acs_devices`
--

CREATE TABLE `acs_devices` (
  `dev_id` int(11) NOT NULL,
  `fk_prof_id` int(11) NOT NULL,
  `device_name` varchar(250) NOT NULL,
  `sold_by` varchar(100) NOT NULL,
  `device_points` double(10,2) NOT NULL,
  `retail_cost` double(10,2) NOT NULL,
  `purch_price` double(10,2) NOT NULL,
  `device_qty` int(11) NOT NULL,
  `total_points` double(10,2) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `total_purch_price` double(10,2) NOT NULL,
  `device_net` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acs_devices`
--
ALTER TABLE `acs_devices`
  ADD PRIMARY KEY (`dev_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acs_devices`
--
ALTER TABLE `acs_devices`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
