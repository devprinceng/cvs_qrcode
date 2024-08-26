-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 09:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obcms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(200) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Administrator', 'admin', 9123564987, 'admin@mail.com', '0192023a7bbd73250516f069df18b500', '2023-08-17 02:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `tblapplication`
--

CREATE TABLE `tblapplication` (
  `ID` int(10) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RegistrationID` int(200) NOT NULL,
  `FullName` varchar(200) NOT NULL,
  `Camname` varchar(200) NOT NULL,
  `Camloc` varchar(200) NOT NULL,
  `Department` varchar(200) NOT NULL,
  `Faculty` varchar(200) NOT NULL,
  `ayr` varchar(200) NOT NULL,
  `gyr` varchar(200) NOT NULL,
  `Dateofapply` timestamp NOT NULL DEFAULT current_timestamp(),
  `Remark` varchar(200) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblapplication`
--

INSERT INTO `tblapplication` (`ID`, `UserID`, `RegistrationID`, `FullName`, `Camname`, `Camloc`, `Department`, `Faculty`, `ayr`, `gyr`, `Dateofapply`, `Remark`, `Status`, `UpdationDate`) VALUES
(1, 0, 0, '0', '0', '0', '', '', '', '', '2024-08-16 04:36:40', '', '', '2024-08-16 04:31:46'),
(2, 0, 0, '0', '0', '0', '', '', '', '', '2024-08-16 04:36:40', '', '', '2024-08-16 04:31:46'),
(3, 3, 229349324, 'oko ben', '0', '0', 'chemistry', 'medicine', '2010', '2005', '2024-08-16 04:36:40', '', '', '2024-08-16 04:31:46'),
(4, 3, 769006928, 'scan ben', '0', '0', 'mathematics', 'science', '2011', '2015', '2024-08-16 04:36:40', '', '', '2024-08-16 04:31:46'),
(5, 3, 535295307, 'bass jaxy', '0', '0', 'computerScience', 'science', '2001', '2004', '2024-08-16 04:36:40', '', '', '2024-08-16 04:31:46'),
(6, 3, 577229756, 'belly bex', 'sweet', 'smile', 'computerScience', 'science', '2019', '2024', '2024-08-16 04:36:40', '', '', '2024-08-16 04:31:46'),
(7, 3, 321794508, 'tata boy', 'swiden', 'italy', 'computerScience', 'science', '2001', '2006', '2024-08-16 05:08:12', '', '', '2024-08-16 05:08:12'),
(8, 3, 759241909, 'BASSEY UBI EZE', 'UNIVERSITY OF CROSS RIVER STATE', 'CALABAR CAMPUS', 'computerScience', 'science', '2023', '2026', '2024-08-17 08:38:36', '', '', '2024-08-17 08:38:36'),
(9, 3, 233747490, 'GLADYS ENELI', 'NICO', 'MARIAN ROAD', 'psychology', 'nursing', '2023', '2025', '2024-08-17 09:02:11', '', '', '2024-08-17 09:02:11'),
(10, 3, 289451361, 'kaka', 'univeresity', 'Ekpo Abasi', 'biology', 'nursing', '2001', '2004', '2024-08-19 23:50:57', 'weldone', 'Verified', '2024-08-21 03:14:49'),
(11, 3, 609964375, 'tonbi jax', 'canana', 'slax', 'computerScience', 'science', '1992', '1995', '2024-08-19 23:55:55', '', '', '2024-08-19 23:55:55'),
(12, 3, 570315582, 'solo', 'calabatr', 'saouth', 'computerScience', 'science', '1989', '1993', '2024-08-20 00:10:34', '', '', '2024-08-20 00:10:34'),
(13, 3, 232575410, 'kalu jax', 'san', 'saba', 'engineering', 'engineering', '1823', '1827', '2024-08-20 00:18:37', '', '', '2024-08-20 00:18:37'),
(14, 3, 302957202, 'kaana abel', 'unversity of cross state', 'CALABAR CAMPUS', 'computerScience', 'science', '1990', '1994', '2024-08-20 14:20:17', '', '', '2024-08-20 14:20:17'),
(15, 3, 808292867, 'nsikak basr', 'UNIVERSITY OF CROSS RIVER STATE', 'calabar municipal', 'engineering', 'engineering', '2010', '2014', '2024-08-20 14:45:32', '', '', '2024-08-20 14:45:32'),
(16, 3, 450690235, 'GLADYS ENELI', 'UNIVERSITY OF CROSS RIVER STATE', 'CALABAR CAMPUS', 'computerScience', 'science', '2023', '2025', '2024-08-20 15:12:10', '', '', '2024-08-20 15:12:10'),
(17, 3, 276913633, 'BENSON XAC', 'UNIVERSITY OF CROSS RIVER STATE', 'CALABAR CAMPUS', 'business', 'education', '1823', '2014', '2024-08-20 15:55:02', '', '', '2024-08-20 15:55:02'),
(18, 12, 113632346, 'BENITA', 'ADAMS', 'UNILAG', 'computerScience', 'science', '2011', '2015', '2024-08-21 02:59:38', '', '', '2024-08-21 02:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FirstName` varchar(200) DEFAULT NULL,
  `LastName` varchar(200) DEFAULT NULL,
  `mobile` int(10) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `Email` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FirstName`, `LastName`, `mobile`, `Address`, `Password`, `RegDate`, `Email`) VALUES
(1, 'Mark', 'Cooper', 2147483647, 'Sample Address 101', 'c7162ff89c647f444fcaa5c635dac8c3', '2022-09-24 05:16:50', NULL),
(2, 'ubi', 'bassey', 706588870, 'marian', '827ccb0eea8a706c4c34a16891f84e7b', '2024-07-09 23:37:29', NULL),
(3, 'ubi', 'eze', 706501986, '23 marian road', 'd139686591cd2bcc2ffebbc3c80c20fa', '2024-08-05 12:29:37', NULL),
(4, 'BENSON', 'HOSANA', NULL, '10 EKONG', '448856a61287bd83d14b49dacba42a5d', '2024-08-21 00:51:46', NULL),
(5, 'GLORY', 'EDET', 2147483647, '110 AKPABOYO', '448856a61287bd83d14b49dacba42a5d', '2024-08-21 01:02:51', NULL),
(6, 'GLORY', 'EDET', 2147483647, '110 AKPABOYO', 'e3ceb5881a0a1fdaad01296d7554868d', '2024-08-21 01:07:10', NULL),
(7, 'kestine', 'shiet', 2147483647, 'marian', '448856a61287bd83d14b49dacba42a5d', '2024-08-21 01:25:46', NULL),
(8, 'kestine', 'shiet', 2147483647, 'marian', '448856a61287bd83d14b49dacba42a5d', '2024-08-21 01:41:14', NULL),
(9, 'kestine', 'shiet', 2147483647, 'marian', '448856a61287bd83d14b49dacba42a5d', '2024-08-21 01:41:53', NULL),
(10, 'user', 'userad', 2147483647, '17 xmen', '448856a61287bd83d14b49dacba42a5d', '2024-08-21 02:07:35', 'xmen@gmail.com'),
(11, 'AMANDA', 'OKON', 2147483647, 'ETETE', '154767cb6e94e4e765c0ca6e41fbe579', '2024-08-21 02:19:24', 'amanda@gmail.com'),
(12, 'BENITA', 'ADAMS', 606501986, 'BETA', '448856a61287bd83d14b49dacba42a5d', '2024-08-21 02:30:19', 'beta@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblapplication`
--
ALTER TABLE `tblapplication`
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblapplication`
--
ALTER TABLE `tblapplication`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
