-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2016 at 07:42 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopnowdeals`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `CompanyID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(150) NOT NULL,
  `CompanyLogo` varchar(5) NOT NULL,
  `CompanyDescription` text NOT NULL,
  `CompanyCreatedAt` datetime NOT NULL,
  `CompanyUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CompanyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`CompanyID`, `CompanyName`, `CompanyLogo`, `CompanyDescription`, `CompanyCreatedAt`, `CompanyUpdatedAt`) VALUES
(1, 'Zong', '', 'Test company......', '2016-08-19 04:00:00', '2016-08-19 14:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `DealID` bigint(20) NOT NULL AUTO_INCREMENT,
  `DealName` varchar(150) NOT NULL,
  `CompanyID` int(20) NOT NULL,
  `DealPrice` double NOT NULL,
  `DealDiscountPercent` double NOT NULL,
  `DealStart` datetime NOT NULL,
  `DealExpire` datetime NOT NULL,
  `DealDescription` text NOT NULL,
  `DealImageExten` varchar(5) NOT NULL,
  `DealAttachmentName` varchar(255) NOT NULL,
  `DealWeekly` int(1) NOT NULL,
  `DealTop` int(1) NOT NULL,
  `DealCreatedAt` datetime NOT NULL,
  `DealUpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`DealID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`DealID`, `DealName`, `CompanyID`, `DealPrice`, `DealDiscountPercent`, `DealStart`, `DealExpire`, `DealDescription`, `DealImageExten`, `DealAttachmentName`, `DealWeekly`, `DealTop`, `DealCreatedAt`, `DealUpdatedAt`) VALUES
(1, 'First Deal', 1, 50, 5, '2016-08-19 22:13:00', '2016-08-20 22:13:00', 'test...', 'png', 'logo.png', 0, 0, '2016-08-19 11:13:00', '2016-08-19 17:13:21'),
(2, 'Second Deal', 1, 70, 20, '2016-08-19 22:38:00', '2016-08-20 22:38:00', 'test second', 'png', 'logo.png', 0, 0, '2016-08-19 11:39:00', '2016-08-19 17:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `deals_download_log`
--

CREATE TABLE IF NOT EXISTS `deals_download_log` (
  `DownloadID` bigint(20) NOT NULL AUTO_INCREMENT,
  `DealID` bigint(20) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `IpAddress` varchar(20) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  PRIMARY KEY (`DownloadID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(150) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `Email`) VALUES
(1, 'admin', '24d169c0a4fa26dfdae23a33932abe21', 'admin@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
