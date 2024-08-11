-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Aug 11, 2024 at 01:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audit_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `tbl_id` int(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`tbl_id`, `Email`, `password`, `account_type`) VALUES
(1, 'admin@gmail.com', 'admin', 1),
(2, 'user@gmail.com', 'user', 2),
(3, 'Jonathanevora86@gmail.com', 'admin', 0),
(4, 'willyevora92@gmail.com', 'user', 0),
(5, 'clarenceevora17@gmail.com', 'user', 0),
(6, 'thanevora86@gmail.com', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_db`
--

CREATE TABLE `dashboard_db` (
  `audit_id` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `name_team` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `Time` varchar(11) NOT NULL,
  `Date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard_db`
--

INSERT INTO `dashboard_db` (`audit_id`, `description`, `name_team`, `department`, `Time`, `Date`) VALUES
(2, 'hatdog', 'hatdoghhhh', 'CSS', '', '2024-05-01'),
(4, 'gr', 'grgr', 'grgr', '', '2024-05-01'),
(7, 'hat', 'dwd', 'wddw', '7:53 PM', '2024-05-01'),
(12, 'Just a documents', 'Cardo', 'CSS', '10:56 PM', '2024-08-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`tbl_id`);

--
-- Indexes for table `dashboard_db`
--
ALTER TABLE `dashboard_db`
  ADD PRIMARY KEY (`audit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `tbl_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dashboard_db`
--
ALTER TABLE `dashboard_db`
  MODIFY `audit_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
