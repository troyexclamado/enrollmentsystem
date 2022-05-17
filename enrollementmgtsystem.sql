-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 01:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enrollementmgtsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `accountID` int(10) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `middlename` varchar(256) NOT NULL,
  `position` varchar(20) NOT NULL,
  `studentNumber` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`accountID`, `email`, `password`, `firstname`, `lastname`, `middlename`, `position`, `studentNumber`) VALUES
(22004, 'qwerty@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'QWERY', 'QWERTY', 'QWERTY', 'student', 2022220004),
(22005, 'asd@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'asd', 'asd', 'asd', 'student', 20220026),
(22011, 'jdc@gmail.com', '447812a4f56887ac0395842ce13e6103', 'JUAN', 'DELA CRUZ', 'PENA', 'STUDENT', 20220029),
(22012, 'irr@gmail.com', '39d3202ec495577fd03ee14c24767dd9', 'IRR', 'IRR', 'IRR', 'STUDENT', 20220030),
(22014, 'troyexclamado@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'TROY', 'EXCLAMADO', 'DAZAL', 'STUDENT', 20220032),
(22015, 'qwe@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'QWE', 'QWE', 'QWE', 'STUDENT', 20220033),
(22017, 'new@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'NEW', 'NEW', 'NEW', 'STUDENT', 2022220033),
(22018, 'oldstudent@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'OLD', 'STUDENT', 'OLD', 'STUDENT', 2022220036),
(22019, 'oldstudent2@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'ANOTHER', 'OLD', 'STUDENT', 'STUDENT', 20220038),
(22025, 'erenyeager@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'EREN', 'YEAGER', 'ACKERMAN', 'STUDENT', 2022220038);

-- --------------------------------------------------------

--
-- Table structure for table `tblbacksubjects`
--

CREATE TABLE `tblbacksubjects` (
  `backsubjectID` int(11) NOT NULL,
  `subjectCode` varchar(50) NOT NULL,
  `accountID` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbacksubjects`
--

INSERT INTO `tblbacksubjects` (`backsubjectID`, `subjectCode`, `accountID`, `status`) VALUES
(14, 'CSE 102', 22011, 'Taken'),
(15, 'GEC 007', 22011, 'Taken'),
(16, 'CS 110', 22011, 'Taken'),
(17, 'GEC 008', 22011, 'Taken'),
(18, 'CS 108', 22011, 'Save'),
(19, 'CCS 116', 22011, 'Save'),
(20, 'CS 113', 22011, 'Save'),
(21, 'CCS 001', 22011, 'Required'),
(22, 'CCS 105', 22012, 'Taken'),
(23, 'CCS 104', 22012, 'Save'),
(24, 'CS 101', 22012, 'Save'),
(25, 'CS 102', 22012, 'Save'),
(26, 'CS 103', 22012, 'Save'),
(27, 'PR 002', 22012, 'Save'),
(28, 'GEC 002', 22012, 'Save'),
(29, 'CCS 001', 22012, 'Required'),
(31, 'PE 003', 22014, 'Save'),
(32, 'GEC 003', 22014, 'Save'),
(33, 'CSE 101', 22014, 'Save'),
(35, 'CS 104', 22014, 'Save'),
(36, 'CCS 110', 22014, 'Save'),
(37, 'CCS 106', 22014, 'Taken'),
(38, 'CCS 001', 22014, 'Required'),
(39, 'PR 003', 22018, 'Save'),
(40, 'PE 003', 22018, 'Save'),
(41, 'GEC 003', 22018, 'Save'),
(42, 'CSE 101', 22018, 'Save'),
(43, 'CS 105', 22018, 'Save'),
(44, 'CS 104', 22018, 'Save'),
(45, 'CCS 110', 22018, 'Save'),
(46, 'CCS 106', 22018, 'Save'),
(47, 'PE 001', 22018, 'Required'),
(48, 'CCS 003', 22018, 'Required'),
(49, 'PR 003', 22018, 'Save'),
(50, 'PE 003', 22018, 'Save'),
(51, 'GEC 003', 22018, 'Save'),
(52, 'CSE 101', 22018, 'Save'),
(53, 'CS 105', 22018, 'Save'),
(54, 'CS 104', 22018, 'Save'),
(55, 'CCS 110', 22018, 'Save'),
(56, 'CCS 106', 22018, 'Save'),
(57, 'CCS 001', 22018, 'Required'),
(58, 'CCS 108', 22018, 'Required'),
(59, 'PR 003', 22019, 'Save'),
(60, 'PE 003', 22019, 'Save'),
(61, 'GEC 003', 22019, 'Save'),
(62, 'CSE 101', 22019, 'Save'),
(63, 'CS 105', 22019, 'Save'),
(64, 'CS 104', 22019, 'Save'),
(65, 'CCS 110', 22019, 'Save'),
(66, 'CCS 106', 22019, 'Taken'),
(67, 'CCS 001', 22019, 'Required'),
(68, 'PE 001', 22019, 'Required');

-- --------------------------------------------------------

--
-- Table structure for table `tblcoursedetails`
--

CREATE TABLE `tblcoursedetails` (
  `courseID` int(10) NOT NULL,
  `courseDescription` varchar(256) NOT NULL,
  `courseAbbr` varchar(10) NOT NULL,
  `year` int(1) NOT NULL,
  `section` varchar(2) NOT NULL,
  `schoolYear` varchar(9) NOT NULL,
  `semester` int(1) NOT NULL,
  `totalstudents` int(10) NOT NULL,
  `availableslots` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcoursedetails`
--

INSERT INTO `tblcoursedetails` (`courseID`, `courseDescription`, `courseAbbr`, `year`, `section`, `schoolYear`, `semester`, `totalstudents`, `availableslots`) VALUES
(1, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 1, 'A', '2021-2022', 2, 0, 0),
(2, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 1, 'B', '2021-2022', 2, 0, 0),
(3, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 1, 'C', '2021-2022', 2, 0, 0),
(4, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 2, 'A', '2021-2022', 2, 0, 0),
(5, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 2, 'B', '2021-2022', 2, 0, 0),
(6, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 2, 'C', '2021-2022', 2, 0, 0),
(7, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 3, 'A', '2021-2022', 2, 0, 0),
(8, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 3, 'B', '2021-2022', 2, 0, 0),
(9, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 3, 'C', '2021-2022', 2, 0, 0),
(10, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 4, 'A', '2021-2022', 2, 0, 0),
(11, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 4, 'B', '2021-2022', 2, 0, 0),
(12, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 4, 'C', '2021-2022', 2, 0, 0),
(13, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 1, 'A', '2021-2022', 2, 0, 0),
(14, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 1, 'B', '2021-2022', 2, 0, 0),
(15, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 1, 'C', '2021-2022', 2, 0, 0),
(16, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 2, 'A', '2021-2022', 2, 0, 0),
(17, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 2, 'B', '2021-2022', 2, 0, 0),
(18, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 2, 'C', '2021-2022', 2, 0, 0),
(19, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 3, 'A', '2021-2022', 2, 0, 0),
(20, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 3, 'B', '2021-2022', 2, 0, 0),
(21, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 3, 'C', '2021-2022', 2, 0, 0),
(22, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 4, 'A', '2021-2022', 2, 0, 0),
(23, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 4, 'B', '2021-2022', 2, 0, 0),
(24, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 4, 'C', '2021-2022', 2, 0, 0),
(25, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 1, 'A', '2021-2022', 2, 0, 0),
(26, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 1, 'B', '2021-2022', 2, 0, 0),
(27, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 1, 'C', '2021-2022', 2, 0, 0),
(28, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 2, 'A', '2021-2022', 2, 0, 0),
(29, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 2, 'B', '2021-2022', 2, 0, 0),
(30, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 2, 'C', '2021-2022', 2, 0, 0),
(31, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 3, 'A', '2021-2022', 2, 0, 0),
(32, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 3, 'B', '2021-2022', 2, 0, 0),
(33, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 3, 'C', '2021-2022', 2, 0, 0),
(34, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 4, 'A', '2021-2022', 2, 0, 0),
(35, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 4, 'B', '2021-2022', 2, 0, 0),
(36, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 4, 'C', '2021-2022', 2, 0, 0),
(37, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 1, 'A', '2021-2022', 2, 0, 0),
(38, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 1, 'B', '2021-2022', 2, 0, 0),
(39, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 1, 'C', '2021-2022', 2, 0, 0),
(40, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 2, 'A', '2021-2022', 2, 0, 0),
(41, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 2, 'B', '2021-2022', 2, 0, 0),
(42, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 2, 'C', '2021-2022', 2, 0, 0),
(43, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 3, 'A', '2021-2022', 2, 0, 0),
(44, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 3, 'B', '2021-2022', 2, 0, 0),
(45, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 3, 'C', '2021-2022', 2, 0, 0),
(46, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 4, 'A', '2021-2022', 2, 0, 0),
(47, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 4, 'B', '2021-2022', 2, 0, 0),
(48, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 4, 'C', '2021-2022', 2, 0, 0),
(49, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 1, 'A', '2021-2022', 1, 0, 0),
(50, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 1, 'B', '2021-2022', 1, 0, 0),
(51, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 1, 'C', '2021-2022', 1, 0, 0),
(52, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 2, 'A', '2021-2022', 1, 0, 0),
(53, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 2, 'B', '2021-2022', 1, 0, 0),
(54, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 2, 'C', '2021-2022', 1, 0, 0),
(55, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 3, 'A', '2021-2022', 1, 0, 0),
(56, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 3, 'B', '2021-2022', 1, 0, 0),
(57, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 3, 'C', '2021-2022', 1, 0, 0),
(58, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 4, 'A', '2021-2022', 1, 0, 0),
(59, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 4, 'B', '2021-2022', 1, 0, 0),
(60, 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BSCS', 4, 'C', '2021-2022', 1, 0, 0),
(85, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 1, 'A', '2021-2022', 1, 0, 0),
(86, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 1, 'B', '2021-2022', 1, 0, 0),
(87, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 1, 'C', '2021-2022', 1, 0, 0),
(88, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 2, 'A', '2021-2022', 1, 0, 0),
(89, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 2, 'B', '2021-2022', 1, 0, 0),
(90, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 2, 'C', '2021-2022', 1, 0, 0),
(91, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 3, 'A', '2021-2022', 1, 0, 0),
(92, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 3, 'B', '2021-2022', 1, 0, 0),
(93, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 3, 'C', '2021-2022', 1, 0, 0),
(94, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 4, 'A', '2021-2022', 1, 0, 0),
(95, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 4, 'B', '2021-2022', 1, 0, 0),
(96, 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BSIT', 4, 'C', '2021-2022', 1, 0, 0),
(97, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 1, 'A', '2021-2022', 1, 0, 0),
(98, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 1, 'B', '2021-2022', 1, 0, 0),
(99, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 1, 'C', '2021-2022', 1, 0, 0),
(100, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 2, 'A', '2021-2022', 1, 0, 0),
(101, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 2, 'B', '2021-2022', 1, 0, 0),
(102, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 2, 'C', '2021-2022', 1, 0, 0),
(103, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 3, 'A', '2021-2022', 1, 0, 0),
(104, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 3, 'B', '2021-2022', 1, 0, 0),
(105, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 3, 'C', '2021-2022', 1, 0, 0),
(106, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 4, 'A', '2021-2022', 1, 0, 0),
(107, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 4, 'B', '2021-2022', 1, 0, 0),
(108, 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', 'BSIS', 4, 'C', '2021-2022', 1, 0, 0),
(109, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 1, 'A', '2021-2022', 1, 0, 0),
(110, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 1, 'B', '2021-2022', 1, 0, 0),
(111, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 1, 'C', '2021-2022', 1, 0, 0),
(112, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 2, 'A', '2021-2022', 1, 0, 0),
(113, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 2, 'B', '2021-2022', 1, 0, 0),
(114, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 2, 'C', '2021-2022', 1, 0, 0),
(115, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 3, 'A', '2021-2022', 1, 0, 0),
(116, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 3, 'B', '2021-2022', 1, 0, 0),
(117, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 3, 'C', '2021-2022', 1, 0, 0),
(118, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 4, 'A', '2021-2022', 1, 0, 0),
(119, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 4, 'B', '2021-2022', 1, 0, 0),
(120, 'BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING', 'BSEMC', 4, 'C', '2021-2022', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblenrolledsubjects`
--

CREATE TABLE `tblenrolledsubjects` (
  `studentNumber` int(8) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `scheduleID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblenrolledsubjects`
--

INSERT INTO `tblenrolledsubjects` (`studentNumber`, `subjectCode`, `scheduleID`) VALUES
(20220001, 'CCS 001', 1),
(20220001, 'CCS 002', 2),
(20220026, 'CS 107', 0),
(20220026, 'PE 003', 0),
(20220026, 'CS 109', 0),
(20220026, 'CS 111', 0),
(20220026, 'CS 112', 0),
(20220026, 'RES 001', 0),
(20220026, 'GEC 006', 0),
(20220027, 'CSE 102', 0),
(20220027, 'GEC 007', 0),
(20220027, 'CS 110', 0),
(20220027, 'GEC 008', 0),
(20220027, 'CS 108', 0),
(20220027, 'CCS 116', 0),
(20220027, 'CS 113', 0),
(20220029, 'CSE 102', 0),
(20220029, 'GEC 007', 0),
(20220029, 'CS 110', 0),
(20220029, 'GEC 008', 0),
(20220029, 'CS 108', 0),
(20220029, 'CCS 116', 0),
(20220029, 'CS 113', 0),
(20220030, 'CCS 105', 0),
(20220030, 'CCS 104', 0),
(20220030, 'CS 101', 0),
(20220030, 'CS 102', 0),
(20220030, 'CS 103', 0),
(20220030, 'PR 002', 0),
(20220030, 'GEC 002', 0),
(20220031, 'CS 107', 0),
(20220031, 'PE 003', 0),
(20220031, 'CS 109', 0),
(20220031, 'CS 111', 0),
(20220031, 'CS 112', 0),
(20220031, 'RES 001', 0),
(20220031, 'GEC 006', 0),
(20220032, 'PR 003', 0),
(20220032, 'PE 003', 0),
(20220032, 'GEC 003', 0),
(20220032, 'CSE 101', 0),
(20220032, 'CS 105', 0),
(20220032, 'CS 104', 0),
(20220032, 'CCS 110', 0),
(20220032, 'CCS 106', 0),
(20220033, 'PR 003', 0),
(20220033, 'PE 003', 0),
(20220033, 'GEC 003', 0),
(20220033, 'CSE 101', 0),
(20220033, 'CS 105', 0),
(20220033, 'CS 104', 0),
(20220033, 'CCS 110', 0),
(20220033, 'CCS 106', 0),
(20190323, 'PE 001', 0),
(20190323, 'PR 001', 0),
(20190323, 'CCS 103', 0),
(20190323, 'CCS 107', 0),
(20190323, 'CCS 108', 0),
(20190323, 'NSTP 102', 0),
(20190323, 'GEC 003', 0),
(20190323, 'LIT 001', 0),
(20220038, 'PR 003', 0),
(20220038, 'PE 003', 0),
(20220038, 'GEC 003', 0),
(20220038, 'CSE 101', 0),
(20220038, 'CS 105', 0),
(20220038, 'CS 104', 0),
(20220038, 'CCS 110', 0),
(20220038, 'CCS 106', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblenrollmentstatus`
--

CREATE TABLE `tblenrollmentstatus` (
  `schoolsemester` int(1) NOT NULL,
  `schoolyear` varchar(10) NOT NULL,
  `campus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblenrollmentstatus`
--

INSERT INTO `tblenrollmentstatus` (`schoolsemester`, `schoolyear`, `campus`) VALUES
(2, '2021-2022', 'CONGRESS');

-- --------------------------------------------------------

--
-- Table structure for table `tblmis`
--

CREATE TABLE `tblmis` (
  `MIS_ID` int(10) NOT NULL,
  `accountID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmis`
--

INSERT INTO `tblmis` (`MIS_ID`, `accountID`) VALUES
(2022001, 22002);

-- --------------------------------------------------------

--
-- Table structure for table `tblprofessors`
--

CREATE TABLE `tblprofessors` (
  `professorID` int(10) NOT NULL,
  `accountID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprofessors`
--

INSERT INTO `tblprofessors` (`professorID`, `accountID`) VALUES
(1001, 22002),
(1002, 22023),
(1003, 22024);

-- --------------------------------------------------------

--
-- Table structure for table `tblprofessorsubjects`
--

CREATE TABLE `tblprofessorsubjects` (
  `professorID` int(10) NOT NULL,
  `subjectCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprofessorsubjects`
--

INSERT INTO `tblprofessorsubjects` (`professorID`, `subjectCode`) VALUES
(1001, 'CCS 001'),
(1002, 'CCS 001'),
(1002, 'NSTP 101');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentaccounts`
--

CREATE TABLE `tblstudentaccounts` (
  `studentNumber` int(8) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudentaccounts`
--

INSERT INTO `tblstudentaccounts` (`studentNumber`, `firstname`, `middlename`, `lastname`, `password`) VALUES
(20220001, 'JUAN', 'FRANCISCO', 'DELA CRUZ', 'juan0001');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentdatastatus`
--

CREATE TABLE `tblstudentdatastatus` (
  `statusID` varchar(5) NOT NULL,
  `statusDescription` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudentdatastatus`
--

INSERT INTO `tblstudentdatastatus` (`statusID`, `statusDescription`) VALUES
('0', 'PENDING'),
('1', 'ACCEPTED'),
('3', 'REJECTED');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `accountID` int(10) NOT NULL,
  `studentNumber` int(8) NOT NULL,
  `address` varchar(512) NOT NULL,
  `birthday` date NOT NULL,
  `birthplace` varchar(256) NOT NULL,
  `contactNumber` varchar(256) NOT NULL,
  `lastSchoolAttended` varchar(256) NOT NULL,
  `lastSchoolYearAttended` varchar(256) NOT NULL,
  `lastSchoolAddress` varchar(256) NOT NULL,
  `courseID` int(10) NOT NULL,
  `statusID` varchar(5) NOT NULL,
  `studentType` varchar(20) NOT NULL,
  `scheme` int(1) NOT NULL,
  `dateOfEnrollment` date NOT NULL,
  `MIS_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`accountID`, `studentNumber`, `address`, `birthday`, `birthplace`, `contactNumber`, `lastSchoolAttended`, `lastSchoolYearAttended`, `lastSchoolAddress`, `courseID`, `statusID`, `studentType`, `scheme`, `dateOfEnrollment`, `MIS_ID`) VALUES
(22004, 2022220004, 'QWERTY', '2000-01-01', 'QWERTY', '1234567', 'QWERTY SCHOOL', '2018-2019', 'QWERTY QWERTY', 1, '0', 'REGULAR', 1, '2022-04-27', 0),
(22005, 20220026, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '1234567', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 7, '1', 'REGULAR', 1, '2022-04-28', 0),
(22011, 20220029, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '1234567', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 5, '1', 'IRREGULAR', 1, '2022-04-28', 0),
(22012, 20220030, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '1234567', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 2, '1', 'IRREGULAR', 1, '2022-04-28', 0),
(22014, 20220032, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '09123456789', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 4, '1', 'IRREGULAR', 1, '2022-04-28', 0),
(22015, 20220033, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '1234567', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 4, '1', 'REGULAR', 1, '2022-04-29', 0),
(22017, 2022220033, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '1234567', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 1, '0', 'REGULAR', 1, '2022-04-29', 0),
(22018, 2022220036, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '1234567', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 4, '0', 'IRREGULAR', 1, '2022-04-29', 0),
(22019, 20220038, 'CALOOCAN CITY', '2000-01-01', 'CALOOCAN CITY', '1234567', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 4, '1', 'IRREGULAR', 1, '2022-04-29', 0),
(22025, 2022220038, 'CALOOCAN CITY', '2000-01-05', 'CALOOCAN CITY', '09123456789', 'CALOOCAN HIGH SCOOL', '2018-2019', 'CALOOCAN CITY', 9, '0', 'REGULAR', 1, '2022-05-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudenttransactions`
--

CREATE TABLE `tblstudenttransactions` (
  `studentNumber` int(8) NOT NULL,
  `TF_OR` varchar(10) NOT NULL,
  `TF_AMOUNT` int(10) NOT NULL,
  `MF_OR` varchar(10) NOT NULL,
  `MF_AMOUNT` int(10) NOT NULL,
  `totalAmount` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `penalty` int(10) NOT NULL,
  `TNC` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudenttransactions`
--

INSERT INTO `tblstudenttransactions` (`studentNumber`, `TF_OR`, `TF_AMOUNT`, `MF_OR`, `MF_AMOUNT`, `totalAmount`, `balance`, `penalty`, `TNC`) VALUES
(20220001, '12345678', 700, '12345678', 300, 1000, 0, 0, 150);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `subjectDescription` varchar(256) NOT NULL,
  `subjectUnits` int(1) NOT NULL,
  `courseID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `subjectCode`, `subjectDescription`, `subjectUnits`, `courseID`) VALUES
(8, 'CCS 001', 'INTRODUCTION TO COMPUTING', 3, 49),
(9, 'NSTP 101', 'NSTP CWTS 1', 3, 49),
(10, 'GEC 004', 'MATHEMATICS IN THE MODERN WORLD', 3, 49),
(11, 'GEC 005', 'PURPOSIVE COMMUNICATION', 3, 49),
(12, 'GEC 001', 'UNDERSTANDING THE SELF', 3, 49),
(13, 'GEC 001', 'UNDERSTANDING THE SELF', 3, 50),
(14, 'GEC 001', 'UNDERSTANDING THE SELF', 3, 51),
(15, 'CCS 102', 'FUNDAMENTALS OF PROGRAMMING', 5, 49),
(16, 'CCS 102', 'FUNDAMENTALS OF PROGRAMMING', 5, 50),
(17, 'CCS 102', 'FUNDAMENTALS OF PROGRAMMING', 5, 51),
(18, 'CCS 105', 'INFORMATION MANAGEMENT', 5, 52),
(19, 'CCS 105', 'INFORMATION MANAGEMENT', 5, 53),
(20, 'CCS 105', 'INFORMATION MANAGEMENT', 5, 54),
(21, 'CCS 104', 'DATA STRUCTURES AND ALGORITHM', 3, 52),
(22, 'CCS 104', 'DATA STRUCTURES AND ALGORITHM', 3, 53),
(23, 'CCS 104', 'DATA STRUCTURES AND ALGORITHM', 3, 54),
(24, 'CS 101', 'PROGRAMMING LANGUAGES', 5, 52),
(25, 'CS 101', 'PROGRAMMING LANGUAGES', 5, 53),
(26, 'CS 101', 'PROGRAMMING LANGUAGES', 5, 54),
(27, 'CS 102', 'LOGIC CIRCUIT AND SWITCHING THEORY', 3, 52),
(28, 'CS 102', 'LOGIC CIRCUIT AND SWITCHING THEORY', 3, 53),
(29, 'CS 102', 'LOGIC CIRCUIT AND SWITCHING THEORY', 3, 54),
(30, 'CS 103', 'DISCRETE STRUCTURES 1', 3, 52),
(31, 'CS 103', 'DISCRETE STRUCTURES 1', 3, 53),
(32, 'CS 103', 'DISCRETE STRUCTURES 1', 3, 54),
(33, 'PR 002', 'DIFFERENTIAL CALCULUS', 3, 52),
(34, 'PR 002', 'DIFFERENTIAL CALCULUS', 3, 53),
(35, 'PR 002', 'DIFFERENTIAL CALCULUS', 3, 54),
(36, 'GEC 002', 'READING IN THE PHILIPPINE HISTORY', 3, 52),
(37, 'GEC 002', 'READING IN THE PHILIPPINE HISTORY', 3, 53),
(38, 'GEC 002', 'READING IN THE PHILIPPINE HISTORY', 3, 54),
(39, 'CSE 102', 'GRAPHICS AND VISUAL COMPUTING', 3, 55),
(40, 'CSE 102', 'GRAPHICS AND VISUAL COMPUTING', 3, 56),
(41, 'CSE 102', 'GRAPHICS AND VISUAL COMPUTING', 3, 57),
(42, 'GEC 007', 'SCIENCE, TECHNOLOGY AND SOCIETY', 3, 55),
(43, 'GEC 007', 'SCIENCE, TECHNOLOGY AND SOCIETY', 3, 56),
(44, 'GEC 007', 'SCIENCE, TECHNOLOGY AND SOCIETY', 3, 57),
(45, 'CS 110', 'NETWORKS AND COMMUNICATIONS', 3, 55),
(46, 'CS 110', 'NETWORKS AND COMMUNICATIONS', 3, 56),
(47, 'CS 110', 'NETWORKS AND COMMUNICATIONS', 3, 57),
(48, 'GEC 008', 'ETHICS', 3, 55),
(49, 'GEC 008', 'ETHICS', 3, 56),
(50, 'GEC 008', 'ETHICS', 3, 57),
(51, 'CS 108', 'SOFTWARE ENGINEERING', 3, 55),
(52, 'CS 108', 'SOFTWARE ENGINEERING', 3, 56),
(53, 'CS 108', 'SOFTWARE ENGINEERING', 3, 57),
(54, 'CCS 116', 'ADVANCE WEB SYSTEMS', 5, 4),
(55, 'CCS 116', 'ADVANCE WEB SYSTEMS', 5, 56),
(56, 'CCS 116', 'ADVANCE WEB SYSTEMS', 5, 57),
(57, 'CS 113', 'INFORMATION ASSURANCE AND SECURITY', 3, 55),
(58, 'CS 113', 'INFORMATION ASSURANCE AND SECURITY', 3, 56),
(59, 'CS 113', 'INFORMATION ASSURANCE AND SECURITY', 3, 57),
(60, 'CS 422', 'CURRENT TRENDS IN IT AND SEMINAR', 3, 58),
(61, 'CS 422', 'CURRENT TRENDS IN IT AND SEMINAR', 3, 59),
(62, 'CS 422', 'CURRENT TRENDS IN IT AND SEMINAR', 3, 60),
(63, 'CS 411', 'INTELLIGENT SYSTEMS', 3, 58),
(64, 'CS 411', 'INTELLIGENT SYSTEMS', 3, 59),
(65, 'CS 411', 'INTELLIGENT SYSTEMS', 3, 60),
(66, 'CS 412', 'SOCIAL ISSUES AND PROFESSIONAL PRACTICE 1', 3, 58),
(67, 'CS 412', 'SOCIAL ISSUES AND PROFESSIONAL PRACTICE 1', 3, 59),
(68, 'CS 412', 'SOCIAL ISSUES AND PROFESSIONAL PRACTICE 1', 3, 60),
(69, 'BOM 001', 'BUSINESS ORG AND MANAGEMENT', 3, 4),
(70, 'BOM 001', 'BUSINESS ORG AND MANAGEMENT', 3, 59),
(71, 'BOM 001', 'BUSINESS ORG AND MANAGEMENT', 3, 60),
(72, 'CS 414', 'CS THESIS', 5, 58),
(73, 'CS 414', 'CS THESIS', 5, 59),
(74, 'CS 414', 'CS THESIS', 5, 60),
(75, 'MAN 001', 'PHILIPPINE HISTORY', 3, 58),
(76, 'MAN 001', 'PHILIPPINE HISTORY', 3, 59),
(77, 'MAN 001', 'PHILIPPINE HISTORY', 3, 60),
(78, 'PE 001', 'PHYSICAL FITNESS AND WELLNESS', 2, 1),
(79, 'PE 001', 'PHYSICAL FITNESS AND WELLNESS', 2, 2),
(80, 'PE 001', 'PHYSICAL FITNESS AND WELLNESS', 2, 3),
(81, 'PR 001', 'COLLEGE ALGEBRA', 3, 1),
(82, 'PR 001', 'COLLEGE ALGEBRA', 3, 2),
(83, 'PR 001', 'COLLEGE ALGEBRA', 3, 3),
(84, 'CCS 103', 'INTERMEDIATE PROGRAMMING', 5, 1),
(85, 'CCS 103', 'INTERMEDIATE PROGRAMMING', 5, 2),
(86, 'CCS 103', 'INTERMEDIATE PROGRAMMING', 5, 3),
(87, 'CCS 107', 'WEB SYSTEMS', 5, 1),
(88, 'CCS 107', 'WEB SYSTEMS', 5, 2),
(89, 'CCS 107', 'WEB SYSTEMS', 5, 3),
(90, 'CCS 108', 'TECHNICAL COMPUTER CONCEPTS', 3, 1),
(91, 'CCS 108', 'TECHNICAL COMPUTER CONCEPTS', 3, 2),
(92, 'CCS 108', 'TECHNICAL COMPUTER CONCEPTS', 3, 3),
(93, 'NSTP 102', 'NSTP CWTS 2', 3, 1),
(94, 'NSTP 102', 'NSTP CWTS 2', 3, 2),
(95, 'NSTP 102', 'NSTP CWTS 2', 3, 3),
(96, 'GEC 003', 'CONTEMPORARY WORLD', 3, 1),
(97, 'GEC 003', 'CONTEMPORARY WORLD', 3, 2),
(98, 'GEC 003', 'CONTEMPORARY WORLD', 3, 3),
(99, 'LIT 001', 'PHILIPPINE LITERATURE IN ENGLISH', 3, 1),
(100, 'LIT 001', 'PHILIPPINE LITERATURE IN ENGLISH', 3, 2),
(101, 'LIT 001', 'PHILIPPINE LITERATURE IN ENGLISH', 3, 3),
(102, 'PR 003', 'INTEGRAL CALCULUS', 3, 4),
(103, 'PR 003', 'INTEGRAL CALCULUS', 3, 5),
(104, 'PR 003', 'INTEGRAL CALCULUS', 3, 6),
(105, 'PE 003', 'INDIVIDUAL AND DUAL SPORTS', 2, 4),
(106, 'PE 003', 'INDIVIDUAL AND DUAL SPORTS', 2, 5),
(107, 'PE 003', 'INDIVIDUAL AND DUAL SPORTS', 2, 6),
(108, 'GEC 003', 'CONTEMPORARY WORLD', 3, 4),
(109, 'GEC 003', 'CONTEMPORARY WORLD', 3, 5),
(110, 'GEC 003', 'CONTEMPORARY WORLD', 3, 6),
(111, 'CSE 101', 'SYSTEM FUNDAMENTALS', 3, 4),
(112, 'CSE 101', 'SYSTEM FUNDAMENTALS', 3, 5),
(113, 'CSE 101', 'SYSTEM FUNDAMENTALS', 3, 6),
(114, 'CS 105', 'OBJECT ORIENTED PROGRAMMING', 5, 4),
(115, 'CS 105', 'OBJECT ORIENTED PROGRAMMING', 5, 5),
(116, 'CS 105', 'OBJECT ORIENTED PROGRAMMING', 5, 6),
(117, 'CS 104', 'DISCRETE STRUCTURES 2', 3, 4),
(118, 'CS 104', 'DISCRETE STRUCTURES 2', 3, 5),
(119, 'CS 104', 'DISCRETE STRUCTURES 2', 3, 6),
(120, 'CCS 110', 'DIGITAL GRAPHICS', 3, 4),
(121, 'CCS 110', 'DIGITAL GRAPHICS', 3, 5),
(122, 'CCS 110', 'DIGITAL GRAPHICS', 3, 6),
(123, 'CCS 106', 'APPLICATIONS DEVELOPMENT AND EMERGING TECHNOLOGIES', 5, 4),
(124, 'CCS 106', 'APPLICATIONS DEVELOPMENT AND EMERGING TECHNOLOGIES', 5, 5),
(125, 'CCS 106', 'APPLICATIONS DEVELOPMENT AND EMERGING TECHNOLOGIES', 5, 6),
(126, 'CS 107', 'EMBEDDED PROGRAMMING', 5, 7),
(127, 'CS 107', 'EMBEDDED PROGRAMMING', 5, 8),
(128, 'CS 107', 'EMBEDDED PROGRAMMING', 5, 9),
(129, 'PE 003', 'INDIVIDUAL AND DUAL SPORTS', 5, 7),
(130, 'PE 003', 'INDIVIDUAL AND DUAL SPORTS', 5, 8),
(131, 'PE 003', 'INDIVIDUAL AND DUAL SPORTS', 5, 9),
(132, 'CS 109', 'SOFTWARE ENGINEERING 2', 3, 7),
(133, 'CS 109', 'SOFTWARE ENGINEERING 2', 3, 8),
(134, 'CS 109', 'SOFTWARE ENGINEERING 2', 3, 9),
(135, 'CS 111', 'ARCHITECTURE AND ORGANIZATION', 3, 7),
(136, 'CS 111', 'ARCHITECTURE AND ORGANIZATION', 3, 8),
(137, 'CS 111', 'ARCHITECTURE AND ORGANIZATION', 3, 9),
(138, 'CS 112', 'OPERATING SYSTEMS', 3, 7),
(139, 'CS 112', 'OPERATING SYSTEMS', 3, 8),
(140, 'CS 112', 'OPERATING SYSTEMS', 3, 9),
(141, 'RES 001', 'METHODS AND RESEARCH', 3, 7),
(142, 'RES 001', 'METHODS AND RESEARCH', 3, 8),
(143, 'RES 001', 'METHODS AND RESEARCH', 3, 9),
(144, 'GEC 006', 'ART APPRECIATION', 3, 7),
(145, 'GEC 006', 'ART APPRECIATION', 3, 8),
(146, 'GEC 006', 'ART APPRECIATION', 3, 9),
(147, 'CS 416', 'PRACTICUM 2', 3, 10),
(148, 'CS 416', 'PRACTICUM 2', 3, 11),
(149, 'CS 416', 'PRACTICUM 2', 3, 12),
(150, 'CS 415', 'PRACTICUM 1', 6, 10),
(151, 'CS 415', 'PRACTICUM 1', 6, 11),
(152, 'CS 415', 'PRACTICUM 1', 6, 12),
(153, 'SS 001', 'PGNC', 3, 10),
(154, 'SS 001', 'PGNC', 3, 11),
(155, 'SS 001', 'PGNC', 3, 12),
(156, 'HUM 002', 'SOCIAL ARTS', 3, 10),
(157, 'HUM 002', 'SOCIAL ARTS', 3, 11),
(158, 'HUM 002', 'SOCIAL ARTS', 3, 12),
(159, 'CS 424', 'CS THESIS 2', 5, 10),
(160, 'CS 424', 'CS THESIS 2', 5, 11),
(161, 'CS 424', 'CS THESIS 2', 5, 12),
(162, 'CS 421', 'AUTOMATA AND LANGUAGE THEORY', 3, 4),
(163, 'CS 421', 'AUTOMATA AND LANGUAGE THEORY', 3, 11),
(164, 'CS 421', 'AUTOMATA AND LANGUAGE THEORY', 3, 12),
(165, 'CS 423', 'HUMAN COMPUTER INTERACTION', 3, 10),
(166, 'CS 423', 'HUMAN COMPUTER INTERACTION', 3, 11),
(167, 'CS 423', 'HUMAN COMPUTER INTERACTION', 3, 12),
(168, 'TRO 001', 'TROY EXCLAMADO', 5, 49),
(169, 'TRO 001', 'TROY EXCLAMADO', 5, 50),
(170, 'TRO 001', 'TROY EXCLAMADO', 5, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectschedules`
--

CREATE TABLE `tblsubjectschedules` (
  `scheduleID` int(10) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `day` varchar(3) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `courseID` int(10) NOT NULL,
  `professorID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsubjectschedules`
--

INSERT INTO `tblsubjectschedules` (`scheduleID`, `subject`, `day`, `startTime`, `endTime`, `courseID`, `professorID`) VALUES
(1, 'CCS 001', 'MON', '10:00:00', '13:00:00', 7, 0),
(2, 'CCS 002', 'TUE', '10:00:00', '13:00:00', 7, 0),
(3, 'CCS 001', 'MON', '11:34:00', '14:34:00', 1, 1002),
(4, 'NSTP 101', 'MON', '11:40:00', '14:40:00', 1, 1002),
(5, 'NSTP 101', 'TUE', '11:59:00', '14:59:00', 1, 1002),
(6, 'CCS 001', 'WED', '12:57:00', '15:57:00', 1, 1002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `tblbacksubjects`
--
ALTER TABLE `tblbacksubjects`
  ADD PRIMARY KEY (`backsubjectID`);

--
-- Indexes for table `tblcoursedetails`
--
ALTER TABLE `tblcoursedetails`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `tblmis`
--
ALTER TABLE `tblmis`
  ADD PRIMARY KEY (`MIS_ID`);

--
-- Indexes for table `tblprofessors`
--
ALTER TABLE `tblprofessors`
  ADD PRIMARY KEY (`professorID`);

--
-- Indexes for table `tblstudentaccounts`
--
ALTER TABLE `tblstudentaccounts`
  ADD PRIMARY KEY (`studentNumber`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjectschedules`
--
ALTER TABLE `tblsubjectschedules`
  ADD PRIMARY KEY (`scheduleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `accountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22026;

--
-- AUTO_INCREMENT for table `tblbacksubjects`
--
ALTER TABLE `tblbacksubjects`
  MODIFY `backsubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tblcoursedetails`
--
ALTER TABLE `tblcoursedetails`
  MODIFY `courseID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `tblmis`
--
ALTER TABLE `tblmis`
  MODIFY `MIS_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2022002;

--
-- AUTO_INCREMENT for table `tblprofessors`
--
ALTER TABLE `tblprofessors`
  MODIFY `professorID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `tblsubjectschedules`
--
ALTER TABLE `tblsubjectschedules`
  MODIFY `scheduleID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
