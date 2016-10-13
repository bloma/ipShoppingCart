-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2016 at 07:46 PM
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
  `brandID` int(11) NOT NULL AUTO_INCREMENT,
  `supplierID` int(11) NOT NULL,
  `brandName` varchar(25) NOT NULL,
  `supplierName` varchar(25) NOT NULL,
  PRIMARY KEY (`brandID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `customerName` varchar(25) NOT NULL,
  `customerSurname` varchar(25) NOT NULL,
  `customerTelephone` varchar(25) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `deliveryID` int(11) NOT NULL AUTO_INCREMENT,
  `distributorID` int(11) NOT NULL,
  `courierName` varchar(25) NOT NULL,
  `customerID` int(11) NOT NULL,
  `recipientName` varchar(25) NOT NULL,
  `delieveryAddress` text NOT NULL,
  `dateDespatched` date NOT NULL,
  `dateDelivered` date NOT NULL,
  `totalItems` int(11) NOT NULL,
  PRIMARY KEY (`deliveryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departmenrts`
--

DROP TABLE IF EXISTS `departmenrts`;
CREATE TABLE IF NOT EXISTS `departmenrts` (
  `departmentID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `totalEmplpyees` int(11) NOT NULL,
  PRIMARY KEY (`departmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

DROP TABLE IF EXISTS `distributors`;
CREATE TABLE IF NOT EXISTS `distributors` (
  `distributorID` int(11) NOT NULL,
  `companyName` varchar(25) NOT NULL,
  `contactNumber` varchar(25) NOT NULL,
  `emailAddress` varchar(25) NOT NULL,
  `physicalAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employeeID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `role` varchar(25) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `department` varchar(25) NOT NULL,
  PRIMARY KEY (`employeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newproducts`
--

DROP TABLE IF EXISTS `newproducts`;
CREATE TABLE IF NOT EXISTS `newproducts` (
  `newproductID` int(11) NOT NULL AUTO_INCREMENT,
  `brandID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `brand` varchar(25) NOT NULL,
  `supplier` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `image` longblob NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`newproductID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

DROP TABLE IF EXISTS `orderhistory`;
CREATE TABLE IF NOT EXISTS `orderhistory` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `customerName` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalcost` double NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `brandID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `brand` varchar(25) NOT NULL,
  `supplier` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `instock` tinyint(1) NOT NULL,
  `image` longblob NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `productName` varchar(25) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplierID` int(11) NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(25) NOT NULL,
  `contactNumber` varchar(25) NOT NULL,
  `emailAddress` varchar(25) NOT NULL,
  `physicalAddress` text NOT NULL,
  PRIMARY KEY (`supplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `accountType` varchar(25) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
