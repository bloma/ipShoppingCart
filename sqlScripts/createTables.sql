-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2016 at 06:46 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

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

CREATE TABLE `brands` (
  `brandID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `brandName` varchar(25) NOT NULL,
  `supplierName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `customerName` varchar(25) NOT NULL,
  `customerSurname` varchar(25) NOT NULL,
  `customerTelephone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `userID`, `customerName`, `customerSurname`, `customerTelephone`) VALUES
  (4, 13, 'Ijaaz', 'Lagardien', '0218622742');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `deliveryID` int(11) NOT NULL,
  `distributorID` int(11) NOT NULL,
  `courierName` varchar(25) NOT NULL,
  `customerID` int(11) NOT NULL,
  `recipientName` varchar(25) NOT NULL,
  `delieveryAddress` text NOT NULL,
  `dateDespatched` date NOT NULL,
  `dateDelivered` date NOT NULL,
  `totalItems` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departmenrts`
--

CREATE TABLE `departmenrts` (
  `departmentID` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `totalEmplpyees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
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

CREATE TABLE `employees` (
  `employeeID` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `role` varchar(25) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `department` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newproducts`
--

CREATE TABLE `newproducts` (
  `newproductID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `brand` varchar(25) NOT NULL,
  `supplier` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `image` longblob NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

CREATE TABLE `orderhistory` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `customerName` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalcost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `brand` varchar(25) NOT NULL,
  `supplier` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `instock` tinyint(1) NOT NULL,
  `image` longblob NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `itemID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(25) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(25) NOT NULL,
  `contactNumber` varchar(25) NOT NULL,
  `emailAddress` varchar(25) NOT NULL,
  `physicalAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `accountType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `userName`, `password`, `accountType`) VALUES
  (13, 'ijaazlagardien@gmail.com', '577a7067410efb20a0aedef4d8674718', 'Customer'),
  (14, 'ijaazlagardien@gmail.com', '577a7067410efb20a0aedef4d8674718', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`deliveryID`);

--
-- Indexes for table `departmenrts`
--
ALTER TABLE `departmenrts`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `newproducts`
--
ALTER TABLE `newproducts`
  ADD PRIMARY KEY (`newproductID`);

--
-- Indexes for table `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `deliveryID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departmenrts`
--
ALTER TABLE `departmenrts`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `newproducts`
--
ALTER TABLE `newproducts`
  MODIFY `newproductID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderhistory`
--
ALTER TABLE `orderhistory`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
