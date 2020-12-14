-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 04:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `addone_uploadfiles`
--

CREATE TABLE `addone_uploadfiles` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` text NOT NULL,
  `fileexe` varchar(255) NOT NULL,
  `filedate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addone_uploadfiles`
--

INSERT INTO `addone_uploadfiles` (`id`, `filename`, `filepath`, `fileexe`, `filedate`) VALUES
(1, 'dp3.jpg', './uploads/', 'jpg', '2020-11-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addone_uploadfiles`
--
ALTER TABLE `addone_uploadfiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addone_uploadfiles`
--
ALTER TABLE `addone_uploadfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
