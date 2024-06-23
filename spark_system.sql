-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 04:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spark_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(100) NOT NULL,
  `admUsername` varchar(50) NOT NULL,
  `admpass` varchar(30) DEFAULT NULL,
  `admname` varchar(255) NOT NULL,
  `admphone` varchar(255) NOT NULL,
  `ppAdm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empid` int(100) NOT NULL,
  `empUsername` varchar(50) NOT NULL,
  `emppass` varchar(30) NOT NULL,
  `empname` varchar(255) NOT NULL,
  `empphone` varchar(20) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `ppEmp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empid`, `empUsername`, `emppass`, `empname`, `empphone`, `jobtitle`, `ppEmp`) VALUES
(2, 'PelukisJalanan', '1234', 'Teme Bin Abdullah', '018-2139632', 'STAFF', '');

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `parcelid` int(150) NOT NULL,
  `trackingNumber` int(255) NOT NULL,
  `courname` varchar(100) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `payStatus` varchar(255) NOT NULL,
  `studid` int(100) DEFAULT NULL,
  `empid` int(100) DEFAULT NULL,
  `adminid` int(100) DEFAULT NULL,
  `payid` int(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `proof` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payid` int(100) NOT NULL,
  `paymethod` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studid` int(100) NOT NULL,
  `studUsername` varchar(50) DEFAULT NULL,
  `studpass` varchar(30) NOT NULL,
  `studname` varchar(255) NOT NULL,
  `studaddress` varchar(700) NOT NULL,
  `email` varchar(255) NOT NULL,
  `studphone` varchar(20) DEFAULT NULL,
  `ppStud` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`parcelid`),
  ADD KEY `empid` (`empid`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `payid` (`payid`),
  ADD KEY `fk_studid` (`studid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `parcelid` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `fk_studid` FOREIGN KEY (`studid`) REFERENCES `student` (`studid`),
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`studid`) REFERENCES `student` (`studid`),
  ADD CONSTRAINT `parcel_ibfk_2` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`),
  ADD CONSTRAINT `parcel_ibfk_3` FOREIGN KEY (`adminid`) REFERENCES `admin` (`adminid`),
  ADD CONSTRAINT `parcel_ibfk_4` FOREIGN KEY (`payid`) REFERENCES `payment` (`payid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
