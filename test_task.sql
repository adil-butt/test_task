-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2019 at 02:09 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(255) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `company_address`, `company_email`, `company_phone`) VALUES
(6, 'XYZ', 'Lahore', 'xyz@xyz.com', '22222222222'),
(7, 'ABC', 'Lahore', 'abc@abc.com', '11111111111');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(255) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `company_id` int(255) NOT NULL,
  `default_person` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `person_name`, `company_id`, `default_person`) VALUES
(26, 'Shahzeb', 6, 1),
(28, 'Ahmad', 7, 1),
(29, 'Asad', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `person_address`
--

CREATE TABLE `person_address` (
  `id` int(255) NOT NULL,
  `address` varchar(150) NOT NULL,
  `person_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `person_address`
--
ALTER TABLE `person_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `person_address`
--
ALTER TABLE `person_address`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `person_address`
--
ALTER TABLE `person_address`
  ADD CONSTRAINT `person_address_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
