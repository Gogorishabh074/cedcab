-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 03, 2021 at 01:02 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Cedcab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `distance` varchar(200) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'CHARBAGH', '0', 1),
(2, 'INDIRANAGAR', '10', 1),
(3, 'BBD', '30', 1),
(4, 'BARABANKI', '60', 1),
(5, 'FAIZABAD', '100', 1),
(6, 'BASTI', '150', 1),
(7, 'GORAKHPUR', '210', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(20) NOT NULL,
  `ride_date` date DEFAULT NULL,
  `from` varchar(200) DEFAULT NULL,
  `to` varchar(200) DEFAULT NULL,
  `total_distance` varchar(20) DEFAULT NULL,
  `luggage` tinyint(1) DEFAULT NULL,
  `total_fare` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `customer_user_id` int(200) DEFAULT NULL,
  `cab_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`, `cab_type`) VALUES
(1, '2021-02-25', 'charbagh', 'bbd', '30', 10, '1000', 2, 3, 'CED MINI'),
(2, '2021-02-25', '  CHARBAGH', '  GORAKHPUR', ' 210', 65, ' 3460', 1, 13, 'CED SUV'),
(3, '2021-02-25', '  CHARBAGH', '  INDIRANAGAR', ' 10', 10, ' 860', 1, 15, 'CED ROYAL'),
(4, '2021-02-25', '  CHARBAGH', '  BARABANKI', ' 60', 98, ' 1885', 2, 12, 'CED SUV'),
(5, '2021-02-25', '  CHARBAGH', '  FAIZABAD', ' 100', 78, ' 1743', 1, 14, 'CED MINI'),
(6, '2021-02-25', '  CHARBAGH', '  GORAKHPUR', ' 210', 65, ' 3000', 1, 16, 'CED ROYAL'),
(7, '2021-02-25', ' CHARBAGH', ' BASTI', ' 150', 65, ' 2753', 2, 19, 'CED MINI'),
(16, '2021-02-27', ' BASTI', ' INDIRANAGAR', ' 140', 65, ' 2231', 0, 19, ' CED ROYAL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `email_id` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `dateofsignup` datetime(6) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `email_id`, `name`, `dateofsignup`, `mobile`, `status`, `password`, `is_admin`) VALUES
(1, 'admin@gmail.com', 'admin', '2021-02-20 13:51:38.000000', '8130702511', 1, 'Password123$', 1),
(2, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:11:31.000000', 'gogo', 1, '124986446', 0),
(3, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:14:28.000000', 'gogo', 1, '124986446', 0),
(4, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:14:39.000000', 'fvfvf', 1, '234e3', 0),
(5, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:15:35.000000', 'fvfvf', 1, '234e3', 0),
(6, '', '', '2021-02-22 13:17:57.000000', '', 1, '', 0),
(7, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:20:42.000000', 'gfbn', 1, '35434534', 0),
(8, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:24:56.000000', ',dvb v', 1, '34564', 0),
(9, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:32:31.000000', '45', 1, '454', 0),
(10, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:35:12.000000', '45r', 1, '45', 0),
(11, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 13:35:59.000000', 'vfsfv', 1, '234234', 0),
(12, 'aakashianrishabh01@gmail.com', 'Rishabh Maurya', '2021-02-22 14:11:18.000000', 'dvfcv', 1, '244', 0),
(13, 'aakashianrishabh@gmail.com', 'Rishabh Maurya', '2021-02-22 14:29:42.000000', 'gfbvd', 1, '4545', 0),
(14, 'qwerty@gmail.com', 'qwerty', '2021-02-22 19:20:31.000000', '', 1, '00000000', 0),
(15, 'wahid@gmail.com', 'wahid hussain', '2021-02-23 09:14:50.000000', '', 1, '258', 0),
(16, 'sagar.expertdev@gmail.com', 'Sagar', '2021-02-23 16:37:50.000000', '', 1, '9140545989', 0),
(19, 'gogo@com', 'Gogo', '2021-02-25 12:34:31.000000', '8130702511', 1, 'gogoaka', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `customer_user_id` (`customer_user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD CONSTRAINT `tbl_ride_ibfk_1` FOREIGN KEY (`customer_user_id`) REFERENCES `tbl_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
