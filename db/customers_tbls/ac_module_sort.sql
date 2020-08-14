-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2020 at 03:23 AM
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
-- Table structure for table `ac_module_sort`
--

CREATE TABLE `ac_module_sort` (
  `ams_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `ams_values` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_module_sort`
--

INSERT INTO `ac_module_sort` (`ams_id`, `fk_user_id`, `ams_values`) VALUES
(1, 2, 'profile,office,score,tech,access,admin,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac_module_sort`
--
ALTER TABLE `ac_module_sort`
  ADD PRIMARY KEY (`ams_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ac_module_sort`
--
ALTER TABLE `ac_module_sort`
  MODIFY `ams_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
