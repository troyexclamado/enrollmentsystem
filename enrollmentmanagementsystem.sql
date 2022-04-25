-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 11:56 AM
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
-- Database: `enrollmentmanagementsystem`
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
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`accountID`, `email`, `password`, `firstname`, `lastname`, `middlename`, `position`) VALUES
(1, 'espinola.demverleen.bscs2019@gmail.com', '123', 'demverleen', 'espinola', 'rovira', '3'),
(2, 'espinoldanica@gmail.com', 'asd', 'danica', 'espinola', 'rovira', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tblcoursedetails`
--

CREATE TABLE `tblcoursedetails` (
  `courseID` int(10) NOT NULL,
  `courseDescription` varchar(256) NOT NULL,
  `courseAbbr` varchar(10) NOT NULL,
  `year` int(1) NOT NULL,
  `schoolYear` varchar(9) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblenrolledsubjects`
--

CREATE TABLE `tblenrolledsubjects` (
  `studentNumber` int(8) NOT NULL,
  `subjectCode` varchar(6) NOT NULL,
  `scheduleID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblmis`
--

CREATE TABLE `tblmis` (
  `MIS_ID` int(10) NOT NULL,
  `accountID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblprofessors`
--

CREATE TABLE `tblprofessors` (
  `professorID` int(10) NOT NULL,
  `accountID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblprofessorsubjects`
--

CREATE TABLE `tblprofessorsubjects` (
  `professorID` int(10) NOT NULL,
  `subjectCode` varchar(10) NOT NULL,
  `scheduleID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('0', 'Pending'),
('1', 'Accepted'),
('3', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentinfo`
--

CREATE TABLE `tblstudentinfo` (
  `pre_id` int(11) NOT NULL,
  `accountID` int(10) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `middlename` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `birthplace` varchar(50) NOT NULL,
  `email` varchar(55) NOT NULL,
  `contactNumber` varchar(11) NOT NULL,
  `lastSchoolAttended` varchar(100) NOT NULL,
  `lastSchoolYearAttended` varchar(100) NOT NULL,
  `lastSchoolAddress` varchar(100) NOT NULL,
  `courseID` varchar(5) NOT NULL,
  `statusID` varchar(5) NOT NULL,
  `dateOfApplication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudentinfo`
--

INSERT INTO `tblstudentinfo` (`pre_id`, `accountID`, `firstname`, `middlename`, `lastname`, `fullname`, `address`, `birthday`, `birthplace`, `email`, `contactNumber`, `lastSchoolAttended`, `lastSchoolYearAttended`, `lastSchoolAddress`, `courseID`, `statusID`, `dateOfApplication`) VALUES
(1, 1, 'demverleen', 'rovira', 'espinola', 'espinola,demverleen rovira', 'bagong silang caloocan city', '1999-10-07', 'caloocan city', 'espinola.demverleen.bscs2019@gmail.com', '09673222205', 'OLFU', '2018', 'Lagro quezon city', '1', '1', '2022-04-24'),
(2, 2, 'danica', 'rovira', 'espinola', 'espinola,danica rovira', 'bagong silang caloocan city', '2005-10-05', 'caloocan city', 'espinoladanica@gmail.com', '09123456789', 'tala', '2018', 'tala caloocan city', '1', '0', '2022-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `accountID` int(10) NOT NULL,
  `studentNumber` varchar(10) NOT NULL,
  `scheme` int(1) NOT NULL,
  `dateOfEnrollment` date NOT NULL,
  `MIS_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`accountID`, `studentNumber`, `scheme`, `dateOfEnrollment`, `MIS_ID`) VALUES
(1, '2022000001', 0, '2022-04-24', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `subjectCode` varchar(10) NOT NULL,
  `subjectDescription` varchar(256) NOT NULL,
  `subjectUnits` int(1) NOT NULL,
  `courseID` int(10) NOT NULL,
  `year` int(1) NOT NULL,
  `semester` int(1) NOT NULL,
  `section` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectschedules`
--

CREATE TABLE `tblsubjectschedules` (
  `scheduleID` int(10) NOT NULL,
  `day` varchar(3) NOT NULL,
  `startTime` varchar(5) NOT NULL,
  `endTime` varchar(5) NOT NULL,
  `courseID` int(10) NOT NULL,
  `section` varchar(1) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `tblmis`
--
ALTER TABLE `tblmis`
  ADD PRIMARY KEY (`MIS_ID`);

--
-- Indexes for table `tblstudentinfo`
--
ALTER TABLE `tblstudentinfo`
  ADD PRIMARY KEY (`pre_id`),
  ADD UNIQUE KEY `accountID` (`accountID`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`studentNumber`),
  ADD KEY `accountID` (`accountID`);

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
  MODIFY `accountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmis`
--
ALTER TABLE `tblmis`
  MODIFY `MIS_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstudentinfo`
--
ALTER TABLE `tblstudentinfo`
  MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblsubjectschedules`
--
ALTER TABLE `tblsubjectschedules`
  MODIFY `scheduleID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD CONSTRAINT `tblstudents_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `tblaccounts` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
