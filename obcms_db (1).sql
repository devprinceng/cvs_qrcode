-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 04:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO
    `tbladmin` (
        `ID`,
        `AdminName`,
        `UserName`,
        `MobileNumber`,
        `Email`,
        `Password`,
        `AdminRegdate`
    )
VALUES (
        1,
        'Administrator',
        'admin',
        9123564987,
        'admin@mail.com',
        '827ccb0eea8a706c4c34a16891f84e7b',
        '2023-08-17 02:38:26'
    );

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
    `certificate` varchar(50) NOT NULL,
    `Dateofapply` timestamp NOT NULL DEFAULT current_timestamp(),
    `Remark` varchar(200) NOT NULL,
    `Status` varchar(50) NOT NULL,
    `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `tblapplication`
--

INSERT INTO
    `tblapplication` (
        `ID`,
        `UserID`,
        `RegistrationID`,
        `FullName`,
        `Camname`,
        `Camloc`,
        `Department`,
        `Faculty`,
        `ayr`,
        `gyr`,
        `certificate`,
        `Dateofapply`,
        `Remark`,
        `Status`,
        `UpdationDate`
    )
VALUES (
        22,
        15,
        155687994,
        'PRINCE DEV',
        'UNICROSS CALABAR',
        'CALABAR',
        'computerScience',
        'science',
        '2021',
        '2025',
        'uploads/IMG-20240619-WA0002.jpg',
        '2024-08-21 10:48:40',
        'student approved successfully',
        'approved',
        '2024-08-21 12:00:14'
    ),
    (
        23,
        16,
        878426159,
        'test',
        'tets',
        'test',
        'art',
        'environment',
        '2020',
        '2024',
        'uploads/IMG-20240619-WA0002.jpg',
        '2024-08-21 12:34:24',
        'testting',
        'approved',
        '2024-08-21 14:16:08'
    );

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
    `ID` int(10) NOT NULL,
    `FirstName` varchar(200) DEFAULT NULL,
    `LastName` varchar(200) DEFAULT NULL,
    `mobile` varchar(11) DEFAULT NULL,
    `Address` mediumtext DEFAULT NULL,
    `Password` varchar(200) DEFAULT NULL,
    `RegDate` timestamp NULL DEFAULT current_timestamp(),
    `Email` varchar(120) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO
    `tbluser` (
        `ID`,
        `FirstName`,
        `LastName`,
        `mobile`,
        `Address`,
        `Password`,
        `RegDate`,
        `Email`
    )
VALUES (
        15,
        'dev',
        'prince',
        '09051458074',
        'calabar',
        '827ccb0eea8a706c4c34a16891f84e7b',
        '2024-08-21 09:59:17',
        'devprinceng@gmail.com'
    ),
    (
        16,
        'test',
        'test',
        '90959595959',
        'test',
        '098f6bcd4621d373cade4e832627b4f6',
        '2024-08-21 12:32:52',
        'test@test.com'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblapplication`
--
ALTER TABLE `tblapplication` ADD KEY `ID` (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser` ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `tblapplication`
--
ALTER TABLE `tblapplication`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 24;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 17;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;