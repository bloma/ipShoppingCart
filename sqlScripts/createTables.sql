-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2016 at 04:59 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `BrandID` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierID` int(11) NOT NULL,
  `BrandName` varchar(25) NOT NULL,
  `SupplierName` varchar(25) NOT NULL,
  PRIMARY KEY (`BrandID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `CustomerName` varchar(25) NOT NULL,
  `CustomerSurname` varchar(25) NOT NULL,
  `CustomerTelephone` varchar(25) NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delieveries`
--

DROP TABLE IF EXISTS `delieveries`;
CREATE TABLE IF NOT EXISTS `delieveries` (
  `DeliveryID` int(11) NOT NULL AUTO_INCREMENT,
  `DistributorID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CourierName` varchar(25) NOT NULL,
  `RecipientName` varchar(25) NOT NULL,
  `DeliveryAddress` text NOT NULL,
  `DateDespatched` date NOT NULL,
  `DateDelivered` date NOT NULL,
  `TotalItems` int(11) NOT NULL,
  PRIMARY KEY (`DeliveryID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(25) NOT NULL,
  `TotalEmployees` int(11) NOT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

DROP TABLE IF EXISTS `distributors`;
CREATE TABLE IF NOT EXISTS `distributors` (
  `DistributorID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(25) NOT NULL,
  `ContactNumber` varchar(25) NOT NULL,
  `EmailAddress` varchar(25) NOT NULL,
  `PhysicalAddress` text NOT NULL,
  PRIMARY KEY (`DistributorID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeName` varchar(25) NOT NULL,
  `EmployeeSurname` varchar(25) NOT NULL,
  `Role` varchar(25) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(25) NOT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newproducts`
--

DROP TABLE IF EXISTS `newproducts`;
CREATE TABLE IF NOT EXISTS `newproducts` (
  `NewProductD` int(11) NOT NULL AUTO_INCREMENT,
  `BrandID` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `ProductName` varchar(25) NOT NULL,
  `ProductDescription` text NOT NULL,
  `ProductPrice` double NOT NULL,
  `Brand` varchar(25) NOT NULL,
  `Supplier` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Image` longblob NOT NULL,
  PRIMARY KEY (`NewProductD`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

DROP TABLE IF EXISTS `orderhistory`;
CREATE TABLE IF NOT EXISTS `orderhistory` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `CustomerName` varchar(25) NOT NULL,
  `CustomerSurname` varchar(25) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `TotalCost` double NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `BrandID` int(11) NOT NULL,
  `SuplierID` int(11) NOT NULL,
  `ProductName` int(11) NOT NULL,
  `ProductDescription` text NOT NULL,
  `Brand` varchar(25) NOT NULL,
  `Supplier` varchar(25) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` double NOT NULL,
  `InStock` tinyint(1) NOT NULL,
  `Image` longblob NOT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `ItemID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(25) NOT NULL,
  `Price` double NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`ItemID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `SupplierID` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierName` varchar(25) NOT NULL,
  `ContactNumber` varchar(25) NOT NULL,
  `EmailAddress` varchar(25) NOT NULL,
  `PhysicalAddress` text NOT NULL,
  PRIMARY KEY (`SupplierID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(25) NOT NULL,
  `Password` text NOT NULL,
  `AccountType` varchar(25) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
