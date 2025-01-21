-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 04:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_PASSWORD`) VALUES
('Maniesh', 'Maniesh123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOK_ID` int(11) NOT NULL,
  `CAR_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_PLACE` varchar(255) NOT NULL,
  `BOOK_DATE` date NOT NULL,
  `DURATION` int(11) NOT NULL,
  `PHONE_NUMBER` bigint(20) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `RETURN_DATE` date NOT NULL,
  `PRICE` int(11) NOT NULL,
  `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOK_ID`, `CAR_ID`, `EMAIL`, `BOOK_PLACE`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `DESTINATION`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`) VALUES
(72, 28, 'ramrai@gmail.com', 'pok', '2025-01-13', 7, 9811113286, 'dang', '2025-03-02', 22400, 'UNDER PROCESSING'),
(74, 32, 'ramrai@gmail.com', 'Lumbini', '2025-01-13', 10, 9832579316, 'Janakpur', '2025-01-29', 37000, 'UNDER PROCESSING'),
(76, 31, 'ramrai@gmail.com', 'Mustang ', '2025-02-09', 7, 9823076532, 'Lantang', '2025-03-08', 24500, 'Denied'),
(77, 29, 'ramrai@gmail.com', 'Suspura ', '2025-02-04', 8, 9811872392, 'Rukum', '2025-02-19', 29600, 'Denied'),
(78, 33, 'aji@gmail.com', 'ktm', '2025-03-03', 7, 987443137, 'palpa', '2025-03-09', 38500, 'DENIED'),
(79, 30, 'aji@gmail.com', 'Test Book', '2025-02-03', 18, 9873212739, 'Book Test', '2025-02-04', 61200, 'UNDER PROCESSING'),
(80, 34, 'aji@gmail.com', 'Userbook', '2025-02-04', 13, 9874323739, 'AdminUser', '2025-12-04', 84500, 'Denied'),
(81, 34, 'aji@gmail.com', 'kom', '2025-02-03', 23, 9392883992, 'jop', '2025-02-09', 149500, 'Denied'),
(82, 32, 'aji@gmail.com', 'kop', '2025-07-03', 9, 987432123, 'lip', '2025-09-03', 33300, 'Denied'),
(83, 32, 'rani@gmail.com', 'kp', '2025-01-29', 29, 2934801002, 'demo', '2025-03-29', 107300, 'Denied'),
(84, 38, 'ramrai@gmail.com', 'man', '2025-02-08', 9, 0, 'demo', '2025-02-28', 35100, 'Denied'),
(85, 30, 'ramrai@gmail.com', 'sad', '2025-02-09', 9, 1234789098, 'hope', '2025-02-18', 30600, 'Denied'),
(86, 39, 'rani@gmail.com', 'Pokhara', '2025-01-18', 2, 9882717143, 'Butwal', '2025-01-20', 5600, 'UNDER PROCESSING'),
(87, 34, 'sushant@gmail.com', 'Langtang', '2025-02-05', 10, 7483664366, 'KTM', '2025-02-15', 65000, 'UNDER PROCESSING'),
(88, 37, 'ramrai@gmail.com', 'kim', '2025-02-23', 21, 9874321237, 'fop', '2025-03-29', 88200, 'UNDER PROCESSING'),
(90, 38, 'rani@gmail.com', 'kim', '2025-02-21', 12, 1234789097, '34', '2025-03-29', 46800, 'Denied');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CAR_ID` int(11) NOT NULL,
  `CAR_NAME` varchar(255) NOT NULL,
  `FUEL_TYPE` varchar(255) NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CAR_IMG` varchar(255) NOT NULL,
  `AVAILABLE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CAR_ID`, `CAR_NAME`, `FUEL_TYPE`, `CAPACITY`, `PRICE`, `CAR_IMG`, `AVAILABLE`) VALUES
(28, 'Hyundai Creta EV', 'Electric', 4, 2300, 'IMG-67851ad770d164.51558389.jpg', 'Y'),
(29, 'Deepal L07', 'Electric', 4, 2800, 'IMG-67851b12bc0bb0.42542064.jpg', 'Y'),
(30, 'Toyota LC 250', 'Diesel', 5, 3400, 'IMG-67851bec7254e5.21397869.jpg', 'Y'),
(31, 'Renault Kwid', 'Petrol', 4, 3500, 'IMG-67851d0a27c768.27061834.png', 'Y'),
(32, 'TATA Nexon EV', 'Electric', 4, 3700, 'IMG-67852643ad39a8.71300700.jpg', 'Y'),
(33, 'THE LAND CRUISER', 'Diesel', 4, 5500, 'IMG-678527d15042e6.16662251.jpg', 'Y'),
(34, 'BMW X3', 'Petrol', 4, 6500, 'IMG-678530975292b2.83507432.jpg', 'Y'),
(35, 'Land Rover Defender', 'Petrol', 4, 6800, 'IMG-678531d05cb4a1.71212287.jpg', 'Y'),
(36, ' Porsche Taycan Turbo', 'Electric', 4, 7000, 'IMG-6787c0efa252d5.87680595.jpg', 'Y'),
(37, 'BYD Atto3', 'Electric', 5, 4200, 'IMG-67886ebed5f102.03152936.jpg', 'Y'),
(38, 'Isuzu Hi-Lander', 'Diesel', 5, 3900, 'IMG-6788715ca23782.36389301.webp', 'Y'),
(39, 'Mahindra Thar', 'Diesel', 5, 2800, 'IMG-678882521f81a5.22629095.webp', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FED_ID`, `EMAIL`, `COMMENT`) VALUES
(10, 'manish@gmail.com', '\r\nThis is the test Feedback by admin(Manish Neupane) ,as it is not implemented on UI or Client side. ');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAY_ID` int(11) NOT NULL,
  `BOOK_ID` int(11) NOT NULL,
  `CARD_NO` varchar(255) NOT NULL,
  `EXP_DATE` varchar(255) NOT NULL,
  `CVV` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PAY_ID`, `BOOK_ID`, `CARD_NO`, `EXP_DATE`, `CVV`, `PRICE`) VALUES
(27, 72, '98733dgjuj34cbvn', '01347', 983, 22400),
(29, 76, '98712fbvcdbnkkhc', '0912', 98, 24500),
(30, 77, '98832guigwp0op;j', '23489', 889, 29600),
(31, 78, '09jkdbmlkh489003', 'ji007', 789, 38500),
(32, 79, '920101hrjje47739', '39201', 233, 61200),
(33, 80, 'adminuser2349032', '40040', 223, 84500),
(34, 81, 'jgjkfooelle,w,w.', 'fkkgo', 0, 149500),
(35, 82, 'kio0987433700973', '98732', 988, 33300),
(36, 83, 'kkfoos,fm4782930', '22343', 443, 107300),
(37, 85, 'jopuffdsabnmllll', '9987', 343, 30600),
(38, 87, '3939482912029474', '48934', 353, 65000),
(39, 90, '3222930020020009', '34040', 444, 46800);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `LIC_NUM` varchar(255) NOT NULL,
  `PHONE_NUMBER` bigint(11) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FNAME`, `LNAME`, `EMAIL`, `LIC_NUM`, `PHONE_NUMBER`, `PASSWORD`, `GENDER`) VALUES
('bopn', 'ere', '1234@1234.com', '09874322', 987431233, '$2y$10$uC6LdoJ5Pop4SDPUEt4G3.OrIpLqUYkUPbT1Bga90m2qZkKAmmPHW', 'Male'),
('123', '123', '123@123.com', '32478901wer23444', 9874321123, '1bbd886460827015e5d605ed44252251', 'male'),
('2moon', '12suun', 'abc1@gmail.com', '0987433212', 987431233, '3f681242d69c0c85a5a6c45012bbbe69', 'male'),
('ajit', 'lal', 'aji@gmail.com', '998743fhj', 9874322480, 'a5cd196a08bb9051e9ba6735ccf71fa6', 'male'),
('rambhadur', 'rai', 'ramrai@gmail.com', '9823fjkc4', 9842279832, '7c8beab50719a9c193af382c90ec8c6c', 'male'),
('rani', 'nim', 'rani@gmail.com', '89743gjkk', 9874321, '1ccd2aab85cae93b22732a553f99ce6d', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `CAR_ID` (`CAR_ID`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CAR_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FED_ID`),
  ADD KEY `TEST` (`EMAIL`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAY_ID`),
  ADD UNIQUE KEY `BOOK_ID` (`BOOK_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
