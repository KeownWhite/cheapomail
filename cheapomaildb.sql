-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2015 at 02:07 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapomail`
--

-- --------------------------------------------------------

--
-- Table structure for table `convomembers`
--

CREATE TABLE `convomembers` (
  `convoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `lastView` datetime NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convomembers`
--

INSERT INTO `convomembers` (`convoID`, `userID`, `lastView`, `deleted`) VALUES
(12, 18, '0000-00-00 00:00:00', 0),
(13, 12, '0000-00-00 00:00:00', 0),
(14, 18, '0000-00-00 00:00:00', 0),
(15, 12, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `convomsg`
--

CREATE TABLE `convomsg` (
  `msgID` int(11) NOT NULL,
  `convoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `msgTXT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convomsg`
--

INSERT INTO `convomsg` (`msgID`, `convoID`, `userID`, `date`, `msgTXT`) VALUES
(27, 21, 12, '2015-12-18 17:06:02', 'adsdasda'),
(28, 22, 12, '2015-12-18 17:12:38', '?'),
(29, 0, 12, '2015-12-18 17:16:09', ''),
(30, 0, 12, '2015-12-18 17:16:54', 'please'),
(31, 0, 12, '2015-12-18 17:18:56', ' DSADASDASD'),
(32, 0, 12, '2015-12-18 17:22:14', 'wooorrrkkk damit '),
(33, 23, 12, '2015-12-18 19:40:25', 'yes please ');

-- --------------------------------------------------------

--
-- Table structure for table `convos`
--

CREATE TABLE `convos` (
  `convoID` int(11) NOT NULL,
  `convoSub` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convos`
--

INSERT INTO `convos` (`convoID`, `convoSub`) VALUES
(21, 'asfdfasfdsad'),
(22, 'please work'),
(23, 'yes please ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `userPassword` varchar(40) NOT NULL,
  `userName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `userPassword`, `userName`) VALUES
(12, 'Keown', 'White', 'a95cd349054e619b28f42f55d1f68d6ae8bb6e22', 'kri'),
(18, 'Testing', 'Tester', 'a95cd349054e619b28f42f55d1f68d6ae8bb6e22', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `convomembers`
--
ALTER TABLE `convomembers`
  ADD PRIMARY KEY (`convoID`),
  ADD UNIQUE KEY `convo_id_3` (`convoID`,`userID`),
  ADD KEY `convo_id` (`convoID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `convo_id_2` (`convoID`,`userID`);

--
-- Indexes for table `convomsg`
--
ALTER TABLE `convomsg`
  ADD PRIMARY KEY (`msgID`),
  ADD KEY `msgID` (`msgID`);

--
-- Indexes for table `convos`
--
ALTER TABLE `convos`
  ADD PRIMARY KEY (`convoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `convomembers`
--
ALTER TABLE `convomembers`
  MODIFY `convoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `convomsg`
--
ALTER TABLE `convomsg`
  MODIFY `msgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `convos`
--
ALTER TABLE `convos`
  MODIFY `convoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
