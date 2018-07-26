-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2017 at 12:17 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ourmall`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test1` (IN `param` INT(3))  select test1 from storeList;$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `test2` (IN `param` INT(3))  begin
select * from storeList where storeId = param;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `test4` (IN `dat` DATE, IN `id` INT(3))  begin
update storeList set leaseStart = DATE_ADD(dat, INTERVAL 12 MONTH) where storeId = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDate` ()  BEGIN
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDate2` ()  begin
select * from storelist;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `usrID` varchar(30) NOT NULL,
  `passwd` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`usrID`, `passwd`) VALUES
('admin1', 'admin1'),
('admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `categorylist`
--

CREATE TABLE `categorylist` (
  `categoryId` int(3) NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorylist`
--

INSERT INTO `categorylist` (`categoryId`, `categoryName`) VALUES
(101, 'Fabric'),
(102, 'Shoes'),
(103, 'Electronic'),
(104, 'HomeStore'),
(105, 'Cosmetics');

-- --------------------------------------------------------

--
-- Table structure for table `customerlist`
--

CREATE TABLE `customerlist` (
  `userId` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `joinDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerlist`
--

INSERT INTO `customerlist` (`userId`, `passwd`, `joinDate`) VALUES
('user1', 'user1', '0000-00-00'),
('user2', 'user2', '0000-00-00'),
('user3', 'user3', '0000-00-00'),
('user4', 'user4', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `employeelist`
--

CREATE TABLE `employeelist` (
  `empId` int(3) NOT NULL,
  `empName` varchar(30) DEFAULT NULL,
  `empSex` char(1) DEFAULT NULL,
  `empSal` int(3) DEFAULT NULL,
  `storeId` int(3) NOT NULL,
  `joinDate` date NOT NULL,
  `dutyShift` char(1) NOT NULL,
  `phnNo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeelist`
--

INSERT INTO `employeelist` (`empId`, `empName`, `empSex`, `empSal`, `storeId`, `joinDate`, `dutyShift`, `phnNo`) VALUES
(1001, 'loal', 'M', 25000, 201, '0000-00-00', '', 0),
(1002, '1002', 'F', 27000, 201, '0000-00-00', '', 4555),
(1003, 'loloyuwu', 'M', 23000, 202, '0000-00-00', '', 9855666),
(1004, 'emp04', 'F', 30000, 202, '0000-00-00', '', 9696),
(1005, 'ee', 'M', 25000, 203, '0000-00-00', '', 0),
(1006, 'ff', 'F', 28000, 203, '0000-00-00', '', 0),
(1007, 'gg', 'M', 25000, 204, '0000-00-00', '', 0),
(1008, 'hh', 'F', 25000, 204, '0000-00-00', '', 0),
(1009, 'ii', 'F', 25000, 205, '0000-00-00', '', 0),
(1010, 'jj', 'M', 25000, 205, '0000-00-00', '', 0),
(1011, 'kk', 'M', 25000, 206, '0000-00-00', '', 0),
(1012, 'll', 'M', 25000, 206, '0000-00-00', '', 0),
(1013, 'mm', 'F', 25000, 207, '0000-00-00', '', 0),
(1014, 'nn', 'F', 25000, 207, '0000-00-00', '', 0),
(1015, 'oo', 'F', 25000, 208, '0000-00-00', '', 0),
(1016, 'pp', 'M', 25000, 208, '0000-00-00', '', 0),
(1017, 'qq', 'M', 25000, 209, '0000-00-00', '', 0),
(1018, 'rr', 'F', 25000, 209, '0000-00-00', '', 0),
(1019, 'ss', 'M', 25000, 210, '0000-00-00', '', 0),
(1020, 'tt', 'M', 25000, 210, '0000-00-00', '', 0),
(1021, 'uu', 'M', 25000, 211, '0000-00-00', '', 0),
(1022, 'vv', 'F', 25000, 211, '0000-00-00', '', 0),
(1023, 'ww', 'F', 25000, 212, '0000-00-00', '', 0),
(1024, 'xx', 'F', 25000, 212, '0000-00-00', '', 0),
(1025, 'yy', 'M', 25000, 213, '0000-00-00', '', 0),
(1026, 'zz', 'M', 25000, 213, '0000-00-00', '', 0),
(1027, 'aaa', 'F', 25000, 214, '0000-00-00', '', 0),
(1028, 'bbb', 'M', 25000, 214, '0000-00-00', '', 0),
(1030, 'aa', 'F', 125, 203, '0000-00-00', 'E', 0),
(1035, 'root', 'F', 125, 202, '0000-00-00', 'M', 32654),
(1040, 'fghj', 'F', 125, 201, '2017-11-23', 'M', 655),
(1041, 'fghj', 'F', 256, 202, '2017-11-23', 'E', 95),
(1042, 'myName', 'M', 85, 201, '2017-11-23', 'M', 97392);

--
-- Triggers `employeelist`
--
DELIMITER $$
CREATE TRIGGER `tgr1` AFTER INSERT ON `employeelist` FOR EACH ROW insert into employeelogin VALUES (new.empId, new.phnNo, new.empName)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employeelogin`
--

CREATE TABLE `employeelogin` (
  `empId` int(3) DEFAULT NULL,
  `empUserName` varchar(30) NOT NULL,
  `passwd` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeelogin`
--

INSERT INTO `employeelogin` (`empId`, `empUserName`, `passwd`) VALUES
(1003, 'emp3', 'emp3'),
(1004, 'emp4', 'emp4'),
(1005, 'emp5', 'emp5'),
(1006, 'emp6', 'emp6'),
(1042, 'myName', 'myName'),
(1001, 'name3', 'name'),
(1002, 'user1', 'lolp');

-- --------------------------------------------------------

--
-- Table structure for table `itemslist`
--

CREATE TABLE `itemslist` (
  `itemId` int(3) NOT NULL,
  `storeId` int(3) NOT NULL,
  `categoryId` int(3) NOT NULL,
  `itemName` varchar(60) NOT NULL,
  `color` varchar(30) NOT NULL,
  `size` int(1) NOT NULL,
  `price` int(3) NOT NULL,
  `quantity` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemslist`
--

INSERT INTO `itemslist` (`itemId`, `storeId`, `categoryId`, `itemName`, `color`, `size`, `price`, `quantity`) VALUES
(301, 201, 101, 'Solid Slim Fit Casual Shirt', 'grey', 30, 1699, 125),
(302, 201, 101, 'Solid Slim Fit Casual Shirt', 'black', 40, 1399, 10),
(303, 201, 101, 'Printed Slim Fit Casual Shirt', 'white', 40, 1499, 10),
(304, 201, 101, 'Solid Slim Fit Casual Trouser', 'Navy blue', 30, 1699, 10),
(305, 201, 101, 'Printed Slim Fit Polo T-Shirt', 'navy blue', 16, 1199, 105),
(306, 201, 101, 'Slim Fit V Neck T-Shirt', 'Peach', 16, 599, 10),
(307, 202, 101, 'Embroidered Kurta', 'Black', 16, 799, 10),
(308, 202, 101, ' Printed Cotton Kurta', 'Navy Blue', 18, 899, 10),
(309, 202, 101, ' Printed Cotton Kurta', 'Navy Blue', 16, 799, 10),
(310, 202, 101, 'Printed Kurta', 'Black', 16, 899, 10),
(311, 202, 101, 'Striped Cotton Kurta', 'Grey', 14, 1099, 10),
(312, 202, 101, 'Printed Kurta', 'multi color', 14, 1099, 10),
(313, 201, 101, 'Washed Slim Fit Jeans (65504)', 'light blue', 30, 3399, 10),
(314, 201, 101, 'Low Rise Skinny Fit Jeans', 'dark grey', 32, 3399, 10),
(315, 201, 101, 'Graphic Regular Fit Round Neck', 'navy-blue', 14, 1699, 10),
(316, 201, 101, 'Checked Regular Fit Casual Shi', 'multi-coloured', 18, 3399, 10),
(317, 201, 101, 'Striped Regular Fit Henley T-S', 'cream', 16, 1599, 10),
(318, 201, 101, 'Textured Regular Fit Casual Sh', 'blue', 30, 2599, 10),
(319, 203, 101, 'Washed Mid Rise Skinny Fit Jea', 'Blue', 30, 4699, 10),
(320, 203, 101, 'Printed Blouse', 'Yellow', 24, 1799, 10),
(321, 203, 101, 'Washed Mid Rise Slim Fit Jeans', 'Blue', 30, 3699, 10),
(322, 203, 101, 'Washed Mid Rise Slim Fit Jeans', 'Blue', 32, 4699, 10),
(323, 203, 101, 'Printed Shirt', 'Blue', 26, 1699, 10),
(324, 203, 101, 'Printed Regular Fit Round Neck T-Shirt', 'Off White', 24, 1299, 10),
(325, 203, 101, 'Washed Low Rise Slim Fit Jeans ', 'Blue', 28, 3999, 10),
(326, 203, 101, 'Solid Low Rise Skinny Fit Jeans', 'Navy Blue', 28, 3999, 10),
(327, 203, 101, 'Solid Slim Fit Casual Shirt', 'Black', 34, 2499, 10),
(328, 203, 101, 'Checked Regular Fit Casual Shirt', 'Navy Blue', 28, 2799, 10),
(329, 204, 102, 'Hush Puppies Formal Shoes', 'Black', 7, 3499, 10),
(330, 204, 102, 'Hush Puppies Sandals', 'Brown', 10, 3499, 10),
(331, 206, 102, 'Derby Formal Shoes', 'Black', 10, 3995, 10),
(332, 206, 102, 'Moccasins', 'Brown', 10, 3595, 10),
(333, 206, 102, 'Casual Sneakers', 'MultiColur', 36, 3995, 10),
(334, 206, 102, 'Red Tape Sandals', 'Copper', 36, 2595, 10);

-- --------------------------------------------------------

--
-- Table structure for table `leasedue`
--

CREATE TABLE `leasedue` (
  `storeId` int(3) NOT NULL,
  `leaseDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `managerlist`
--

CREATE TABLE `managerlist` (
  `mgrId` int(3) NOT NULL,
  `userId` varchar(30) NOT NULL,
  `passwd` varchar(30) NOT NULL,
  `storeId` int(3) NOT NULL,
  `empId` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `managerlist`
--

INSERT INTO `managerlist` (`mgrId`, `userId`, `passwd`, `storeId`, `empId`) VALUES
(2001, 'mgr1', 'mgr1', 201, 1002),
(2002, 'mgr2', 'mgr2', 202, 1004),
(2003, 'mgr3', 'mgr3', 203, 1006),
(2004, 'mgr4', 'mgr4', 204, 1008),
(2005, 'mgr5', 'mgr5', 205, 1010),
(2006, 'mgr6', 'mgr6', 206, 1012),
(2007, 'mgr7', 'mgr7', 207, 1014),
(2008, 'mgr8', 'mgr8', 208, 1016),
(2009, 'mgr9', 'mgr9', 209, 1018),
(2010, 'mgr10', 'mgr10', 210, 1020),
(2011, 'root', 'chj', 215, 1010),
(2011, 'root', 'ghj', 217, 1010),
(2011, 'ghj', 'ghj', 218, 1010),
(2011, 'root', 'gh', 244, 1010),
(2011, 'root', 'fgh', 245, 1010),
(2011, 'gg', 'fb', 259, 1010),
(2011, 'bnm', 'vbn', 1001, 1010);

-- --------------------------------------------------------

--
-- Table structure for table `storelist`
--

CREATE TABLE `storelist` (
  `storeId` int(3) NOT NULL,
  `categoryId` int(3) NOT NULL,
  `storeName` varchar(30) NOT NULL,
  `floor` int(1) NOT NULL,
  `leaseStart` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storelist`
--

INSERT INTO `storelist` (`storeId`, `categoryId`, `storeName`, `floor`, `leaseStart`) VALUES
(201, 101, 'John Miller', 1, '2017-11-23'),
(202, 101, 'Aurelia', 0, '2018-11-23'),
(203, 101, 'Levis', 4, '2018-11-23'),
(204, 102, 'Hush Puppier', 1, '2018-11-23'),
(205, 102, 'Carlton London', 1, '2018-11-23'),
(206, 102, 'Red Tape', 1, '2018-11-23'),
(207, 103, 'E-Zone', 3, '2018-11-23'),
(208, 103, 'Samsung', 2, '2018-11-23'),
(209, 103, 'Relience-Digital', 4, '2018-11-23'),
(210, 104, 'Home Zone', 3, '2018-11-23'),
(211, 104, 'Big Bazaar', 3, '2018-11-23'),
(212, 104, 'Future Homes', 3, '2018-11-23'),
(213, 105, 'Baby Lips', 0, '2018-11-23'),
(214, 105, 'L-OReal', 0, '2018-11-23'),
(215, 101, 'lsosl', 1, '2018-11-23'),
(216, 101, 'lsosl', 1, '2018-11-23'),
(217, 101, 'lsosl', 1, '2018-11-23'),
(218, 101, 'lsosl', 1, '2018-11-23'),
(244, 101, 'lsosl', 1, '2018-08-13'),
(245, 101, 'lsosl', 1, '2018-11-23'),
(248, 102, 'lsosl', 1, '2018-11-23'),
(259, 101, 'eee', 1, '2018-11-23'),
(1001, 101, 'lsosl', 1, '2018-11-23');

--
-- Triggers `storelist`
--
DELIMITER $$
CREATE TRIGGER `tgr2` AFTER INSERT ON `storelist` FOR EACH ROW insert into leasedue SELECT storeId, leaseStart from storelist where leaseStart = NOW()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`usrID`);

--
-- Indexes for table `categorylist`
--
ALTER TABLE `categorylist`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `customerlist`
--
ALTER TABLE `customerlist`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `employeelist`
--
ALTER TABLE `employeelist`
  ADD PRIMARY KEY (`empId`,`storeId`),
  ADD KEY `storeId` (`storeId`);

--
-- Indexes for table `employeelogin`
--
ALTER TABLE `employeelogin`
  ADD PRIMARY KEY (`empUserName`),
  ADD KEY `empId` (`empId`);

--
-- Indexes for table `itemslist`
--
ALTER TABLE `itemslist`
  ADD PRIMARY KEY (`itemId`,`storeId`,`categoryId`),
  ADD KEY `fk2` (`storeId`),
  ADD KEY `fk3` (`categoryId`);

--
-- Indexes for table `managerlist`
--
ALTER TABLE `managerlist`
  ADD PRIMARY KEY (`mgrId`,`storeId`),
  ADD KEY `storeId` (`storeId`);

--
-- Indexes for table `storelist`
--
ALTER TABLE `storelist`
  ADD PRIMARY KEY (`storeId`,`categoryId`),
  ADD KEY `fk1` (`categoryId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeelist`
--
ALTER TABLE `employeelist`
  ADD CONSTRAINT `employeelist_ibfk_1` FOREIGN KEY (`storeId`) REFERENCES `storelist` (`storeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employeelogin`
--
ALTER TABLE `employeelogin`
  ADD CONSTRAINT `employeelogin_ibfk_1` FOREIGN KEY (`empId`) REFERENCES `employeelist` (`empId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemslist`
--
ALTER TABLE `itemslist`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`storeId`) REFERENCES `storelist` (`storeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3` FOREIGN KEY (`categoryId`) REFERENCES `categorylist` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `managerlist`
--
ALTER TABLE `managerlist`
  ADD CONSTRAINT `managerlist_ibfk_1` FOREIGN KEY (`storeId`) REFERENCES `storelist` (`storeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `storelist`
--
ALTER TABLE `storelist`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`categoryId`) REFERENCES `categorylist` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
