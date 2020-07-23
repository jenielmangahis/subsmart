-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 06:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admintom_nsmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `wizard`
--

CREATE TABLE `wizard` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wizard`
--

INSERT INTO `wizard` (`id`, `title`, `description`) VALUES
(1, 'sdfsdfrrrrr', 'sdfsdfds'),
(2, 'sdfsdffsddsffdsdfs', 'fdsdfsfsdfsfsdsdfdsffdsfds'),
(3, 'sdfsdf', 'dsfsdfsd'),
(4, 'sdfsdffsddsffdsdfs', 'fdsdfsfsdfsfsdsdfdsffdsfds'),
(5, 'sdfsdf', 'dsfsdfsd'),
(6, 'sdfsdffsddsffdsdfs', 'fdsdfsfsdfsfsdsdfdsffdsfds'),
(7, 'sdfsdf', 'dsfsdfsd'),
(8, 'sdfsdffsddsffdsdfs', 'fdsdfsfsdfsfsdsdfdsffdsfds'),
(9, 'sdfsdf', 'dsfsdfsd'),
(10, 'sdfsdffsddsffdsdfs', 'fdsdfsfsdfsfsdsdfdsffdsfds'),
(11, 'rrrrrrrrrav', 'dsfsdfsd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wizard`
--
ALTER TABLE `wizard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wizard`
--
ALTER TABLE `wizard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
