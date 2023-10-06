-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 01:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme23_jul`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `userid`, `pid`, `quantity`, `created_date`) VALUES
(108, 13, 50, 3, '2023-10-04 23:22:00'),
(109, 16, 36, 3, '2023-10-05 11:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` varchar(19) NOT NULL,
  `quantity` int(11) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `impath` text NOT NULL,
  `ordertime` timestamp NOT NULL DEFAULT current_timestamp(),
  `orderstatus` varchar(13) NOT NULL DEFAULT 'NOT DELIVERED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `pid`, `userid`, `name`, `price`, `quantity`, `uploaded_by`, `impath`, `ordertime`, `orderstatus`) VALUES
(43, 27, 16, 'Raven', '400,000,000', 3, 14, '../shared/images/14_1696445900.png', '2023-10-04 19:53:30', 'NOT DELIVERED'),
(44, 43, 16, 'Dominix Navy Issue', '600,000,000', 2, 17, '../shared/images/17_1696454713.png', '2023-10-04 23:19:14', 'DELIVERED'),
(45, 56, 16, 'Kronos', '1,440,000,000', 1, 12, '../shared/images/12_1696459342.png', '2023-10-04 23:19:14', 'NOT DELIVERED'),
(46, 50, 13, 'Nestor', '1,430,000,000', 3, 17, '../shared/images/17_1696456632.png', '2023-10-04 23:22:08', 'NOT DELIVERED'),
(47, 36, 16, 'Praxis', '185,000,000', 3, 17, '../shared/images/17_1696453073.png', '2023-10-05 11:44:49', 'NOT DELIVERED');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` varchar(19) NOT NULL,
  `detail` text NOT NULL,
  `impath` text NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `price`, `detail`, `impath`, `uploaded_by`, `created_date`) VALUES
(24, 'Abaddon', '380,000,000', 'Amarr Empire Battleship', '../shared/images/14_1696445231.png', 14, '2023-10-04 20:15:23'),
(25, 'Apocalypse', '375,000,000', 'Amarr Empire Battleship', '../shared/images/14_1696445647.png', 14, '2023-10-04 20:15:18'),
(26, 'Armageddon', '400,000,000', 'Amarr Empire Battleship', '../shared/images/14_1696445814.png', 14, '2023-10-04 20:15:14'),
(27, 'Raven', '400,000,000', 'Caldari State Battleship', '../shared/images/14_1696445900.png', 14, '2023-10-04 20:14:40'),
(28, 'Rokh', '485,000,000', 'Caldari State Battleship', '../shared/images/14_1696449511.png', 14, '2023-10-04 20:14:34'),
(29, 'Scorpion', '340,000,000', 'Caldari State Battleship', '../shared/images/14_1696449676.png', 14, '2023-10-04 20:14:28'),
(30, 'Megathron', '395,000,000', 'Gallente Federation Battleship', '../shared/images/14_1696449774.png', 14, '2023-10-04 20:13:58'),
(31, 'Hyperion', '415,000,000', 'Gallente Federation Battleship', '../shared/images/14_1696450065.png', 14, '2023-10-04 20:12:59'),
(32, 'Dominix ', '405,000,000', 'Gallente Federation Battleship', '../shared/images/14_1696450360.png', 14, '2023-10-04 20:12:40'),
(33, 'Tempest', '390,000,000', 'Minmatar Republic Battleship', '../shared/images/14_1696450713.png', 14, '2023-10-04 20:18:33'),
(34, 'Typhoon', '385,000,000', 'Minmatar Republic Battleship', '../shared/images/14_1696450968.png', 14, '2023-10-04 20:22:48'),
(35, 'Maelstrom', '335,000,000', 'Minmatar Republic Battleship', '../shared/images/14_1696451126.png', 14, '2023-10-04 20:25:26'),
(36, 'Praxis', '185,000,000', 'SOCT Battleship', '../shared/images/17_1696453073.png', 17, '2023-10-04 20:57:53'),
(37, 'Thunderchild', '1,300,000,000', 'EDENCOM Battleship', '../shared/images/17_1696453216.png', 17, '2023-10-04 21:00:16'),
(38, 'Leshak', '665,000,000', 'Triglavian Collective Battleship', '../shared/images/17_1696453350.png', 17, '2023-10-04 21:02:30'),
(39, 'Apocalypse Navy Issue', '665,000,000', 'Amarr Empire Navy Battleship', '../shared/images/17_1696453814.png', 17, '2023-10-04 21:20:02'),
(40, 'Armageddon Navy Issue', '590,000,000', 'Amarr Empire Navy Battleship', '../shared/images/17_1696454068.png', 17, '2023-10-04 21:19:54'),
(41, 'Raven Navy Issue', '655,000,000', 'Caldari State Navy Battleship', '../shared/images/17_1696454314.png', 17, '2023-10-04 21:19:23'),
(42, 'Scorpion Navy Issue', '585,000,000', 'Caldari Navy Battleship', '../shared/images/17_1696454565.png', 17, '2023-10-04 21:22:45'),
(43, 'Dominix Navy Issue', '600,000,000', 'Gallente Federation Navy Battleship', '../shared/images/17_1696454713.png', 17, '2023-10-04 21:25:13'),
(44, 'Megathron Navy Issue', '585,000,000', 'Gallente Federation Navy Battleship', '../shared/images/17_1696454892.png', 17, '2023-10-04 21:28:12'),
(45, 'Tempest Fleet Issue', '615,000,000', 'Minmatar Republic Navy Battleship', '../shared/images/17_1696455000.png', 17, '2023-10-04 21:30:00'),
(46, 'Typhoon Fleet Issue', '595,000,000', 'Minmatar Republic Navy Battleship', '../shared/images/17_1696455191.png', 17, '2023-10-04 21:33:11'),
(47, 'Barghest', '1,405,000,000', 'Mordu\'s Legion Faction Battleship', '../shared/images/17_1696455526.png', 17, '2023-10-04 22:12:21'),
(48, 'Bhaalgorn', '1,260,000,000', 'Blood Raider Covenant Faction Battleship', '../shared/images/17_1696456008.png', 17, '2023-10-04 21:46:48'),
(49, 'Machariel', '1,015,000,000', 'Angel Cartel Faction Battleship', '../shared/images/17_1696456149.png', 17, '2023-10-04 21:49:09'),
(50, 'Nestor', '1,430,000,000', 'Sisters of EVE Faction Battleship', '../shared/images/17_1696456632.png', 17, '2023-10-04 21:57:12'),
(51, 'Nightmare', '1,500,000,000', 'Sansha\'s Nation Faction Battleship', '../shared/images/17_1696457927.png', 17, '2023-10-04 22:20:08'),
(52, 'Rattlesnake', '1,850,000,000', 'Guristas Faction Battleship', '../shared/images/17_1696458198.png', 17, '2023-10-04 22:23:18'),
(53, 'Vindicator', '1,370,000,000', 'Serpentis Faction Battleship', '../shared/images/17_1696458381.png', 17, '2023-10-04 22:29:45'),
(54, 'Paladin', '1,395,000,000', 'Amarr Empire Marauder Battleship', '../shared/images/12_1696458858.png', 12, '2023-10-04 22:51:30'),
(55, 'Golem', '1,470,000,000', 'Caldari State Marauder Battleship', '../shared/images/12_1696459190.png', 12, '2023-10-04 22:51:03'),
(56, 'Kronos', '1,440,000,000', 'Gallente Federation Marauder Battleship', '../shared/images/12_1696459342.png', 12, '2023-10-04 22:50:46'),
(57, 'Vargur', '1,635,000,000', 'Minmatar Republic Marauder Battleship', '../shared/images/12_1696459543.png', 12, '2023-10-04 22:50:28'),
(58, 'Redeemer', '1,275,000,000', 'Amarr Empire Black Ops Battleship', '../shared/images/12_1696459811.png', 12, '2023-10-04 22:50:11'),
(59, 'Widow', '1,210,000,000', 'Caldari State Black Ops Battleship', '../shared/images/12_1696460044.png', 12, '2023-10-04 22:54:04'),
(60, 'Sin', '1,255,000,000', 'Gallente Federation Black Ops Battleship', '../shared/images/12_1696460189.png', 12, '2023-10-04 22:56:29'),
(61, 'Panther', '1,215,000,000', 'Minmatar Republic Black Ops Battleship', '../shared/images/12_1696460339.png', 12, '2023-10-04 22:58:59'),
(62, ' Marshal', '9,785,000,000', 'CONCORD Black Ops Battleship', '../shared/images/12_1696460626.png', 12, '2023-10-04 23:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `usertype`, `created_date`, `mobile`) VALUES
(12, 'Xel', '202cb962ac59075b964b07152d234b70', 'Vendor', '2023-09-29 08:37:52', '6544156454'),
(13, 'Mike', '202cb962ac59075b964b07152d234b70', 'Client', '2023-10-01 16:02:11', '8824124648'),
(14, 'Rock', '202cb962ac59075b964b07152d234b70', 'Vendor', '2023-10-01 19:42:42', '8645667453'),
(16, 'Tox', '202cb962ac59075b964b07152d234b70', 'Client', '2023-10-02 13:02:55', '4545645454'),
(17, 'Kion', '202cb962ac59075b964b07152d234b70', 'Vendor', '2023-10-04 20:44:20', '4515454151'),
(18, 'Admin', '0192023a7bbd73250516f069df18b500', 'Admin', '2023-10-05 06:56:46', 'NULL'),
(24, 'Xel\'', '202cb962ac59075b964b07152d234b70', 'Client', '2023-10-05 18:51:11', '5555555555');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`),
  ADD UNIQUE KEY `userid` (`userid`,`pid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`,`usertype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
