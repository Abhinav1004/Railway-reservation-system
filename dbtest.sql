-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2017 at 11:24 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `Index` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`Index`, `username`, `password`) VALUES
(1, 'Abhay13', '710dad2eae1c1b0a226344bec5cc3c36');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `TrainNumber` int(11) NOT NULL,
  `StopNumber` int(11) NOT NULL,
  `StationName` varchar(15) NOT NULL,
  `ArrivalTime` datetime NOT NULL,
  `DepartureTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`TrainNumber`, `StopNumber`, `StationName`, `ArrivalTime`, `DepartureTime`) VALUES
(100000, 1, 'New Delhi', '2017-03-23 20:30:00', '2017-03-23 20:35:00'),
(100000, 2, 'Aligarh Junc', '2017-03-23 22:32:00', '2017-03-23 22:34:00'),
(100000, 3, 'Kanpur Central', '2017-03-24 02:40:00', '2017-03-24 02:45:00'),
(100000, 4, 'Allahabad Junc', '2017-03-24 05:30:00', '2017-03-24 05:55:00'),
(100000, 5, 'Gyanpur Road', '2017-03-24 07:02:00', '2017-03-24 07:04:00'),
(100000, 6, 'Bhulanpur', '2017-03-24 08:00:00', '2017-03-24 08:01:00'),
(100000, 7, 'Varanasi Junc', '2017-03-24 08:25:00', '2017-03-24 08:35:00'),
(100000, 8, 'Aunrihar Junc', '2017-03-24 09:18:00', '2017-03-24 09:20:00'),
(100000, 9, 'Ghazipur City', '2017-03-24 09:50:00', '2017-03-24 09:55:00'),
(100000, 10, 'Yusufpur', '2017-03-24 10:15:00', '2017-03-24 10:17:00'),
(100000, 11, 'Ballia', '2017-03-24 11:05:00', '2017-03-24 11:10:00'),
(100000, 12, 'Suraimanpur', '2017-03-24 11:43:00', '2017-03-24 11:45:00'),
(100000, 13, 'Chhapra', '2017-03-24 12:45:00', '2017-03-24 13:00:00'),
(100000, 14, 'Sonpur Junc', '2017-03-24 13:53:00', '2017-03-24 13:55:00'),
(100000, 15, 'Hajipur Junc', '2017-03-24 14:08:00', '2017-03-24 14:10:00'),
(100000, 16, 'MuzaffarpurJunc', '2017-03-24 15:25:00', '2017-03-24 15:30:00'),
(100000, 17, 'Samastipur Junc', '2017-03-24 16:35:00', '2017-03-24 17:00:00'),
(100000, 18, 'Darbhanga Junc', '2017-03-24 17:50:00', '2017-03-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `pnr` int(11) NOT NULL,
  `passenger_name` varchar(40) NOT NULL,
  `TrainNumber` int(11) NOT NULL,
  `no_of_seats` int(11) NOT NULL,
  `train_status` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `booked_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`pnr`, `passenger_name`, `TrainNumber`, `no_of_seats`, `train_status`, `booking_date`, `booked_on`) VALUES
(125196, 'ankit', 100000, 2, 'confirm', '2017-03-25', '2017-04-29 12:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `TrainNumber` int(6) NOT NULL,
  `TrainName` varchar(20) NOT NULL,
  `Start` varchar(20) NOT NULL,
  `End` varchar(20) NOT NULL,
  `Category` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`TrainNumber`, `TrainName`, `Start`, `End`, `Category`) VALUES
(100000, 'Swatantra Senani', 'New Delhi', 'Darbhanga', 'Superfast'),
(100004, 'Shaheed Express', 'New Delhi', 'Patna', 'Express'),
(100005, 'Nagpur Mail', 'Nagpur', 'Mumbai Central', 'Passenger'),
(100006, 'Magadh Intercity', 'Patna', 'Patliputra', 'Intercity'),
(100007, 'Bhopal Rajdhani', 'New Delhi', 'Bhopal', 'Rajdhani'),
(100008, 'Chandigarh Shatabdi', 'New Delhi', 'Chandigarh', 'Shatabdi'),
(111005, 'GangaSagar Express', 'Howrah', 'Patna', 'Express'),
(111236, 'Tamil Nadu Express', 'New Delhi', 'Chennai', 'SuperFast'),
(100001, 'Garibbi', 'Delhi', 'Bihar', 'Express');

-- --------------------------------------------------------

--
-- Table structure for table `train_status`
--

CREATE TABLE `train_status` (
  `TrainNumber` int(11) NOT NULL,
  `available_seats` int(11) NOT NULL,
  `booked_seats` int(11) NOT NULL,
  `available_Date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `train_status`
--

INSERT INTO `train_status` (`TrainNumber`, `available_seats`, `booked_seats`, `available_Date`) VALUES
(100000, 298, 2, '2017-03-25'),
(100001, 200, 0, '2017-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `UserEmail` varchar(60) NOT NULL,
  `UserPass` varchar(255) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Age` int(11) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `UserEmail`, `UserPass`, `Gender`, `Age`, `Mobile`, `City`, `State`) VALUES
(1, 'abhinav', 'abhinav@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'M', 21, 800000000, 'Jamia', 'Delhi'),
(2, 'abhijeet', 'abhijeet@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'M', 22, 101010101, 'Dwarka', 'Delhi'),
(3, 'pradeep', 'pradeep@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'M', 55, 454654545, 'Gara', 'Mumbai'),
(4, 'chandana', 'ch@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'M', 32, 2329329392, 'Orla', 'Bangaluru'),
(5, 'abhilasha', 'abhilasha@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'F', 25, 1222222222, 'Dwarka', 'Delhi'),
(6, 'aloka', 'aloka@gmail.com', 'd9bfae29d57f6694f8dad49a92decf30193164bf7e853c547a0c2031f5feffc6', 'F', 20, 6767767676, 'Sata', 'Punjab'),
(7, 'Abhay', 'abhaycharan13@gmail.com', '0e82cdaae6ccba9b53eed0383bdebe37', 'M', 21, 8888888888, 'Goa', 'Goa'),
(9, 'Abhinav', 'abhinav1@gmail.com', '1fcb496b896c30460436fa030ffbc4e6', 'M', 23, 9999999999, 'Delhi', 'Delhi'),
(12, 'ankit', 'ankit@gmail.com', '447d2c8dc25efbc493788a322f1a00e7', 'M', 20, 99999999999, 'delhi', 'delhi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`Index`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`TrainNumber`,`StopNumber`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`pnr`);

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`TrainNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `userEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `Index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `StopNumber` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
