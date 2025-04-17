-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 07:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`) VALUES
(1, 'Smit Rana', 'smitrana8923@gmail.com', 'f68d233a78c0b0f7a613bad29695d108'),
(2, 'Smit', 'smitsoni1093@gmail.com', 'Smit@7904');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `cdoj` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`c_id`, `c_name`, `cdoj`) VALUES
(1, 'Adventure', '2025-04-07 16:04:26'),
(2, 'Family Trip', '2025-04-07 16:04:56'),
(3, 'Honeymoon', '2025-04-07 16:05:09'),
(4, 'Solo Travel', '2025-04-07 16:05:16'),
(5, 'Group Tours', '2025-04-07 16:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `destination_table`
--

CREATE TABLE `destination_table` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(50) NOT NULL,
  `cdoj` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination_table`
--

INSERT INTO `destination_table` (`d_id`, `d_name`, `cdoj`) VALUES
(1, 'Mumbai', '2025-04-06 21:59:21'),
(2, 'Mumbai', '0000-00-00 00:00:00'),
(3, 'Ahmedabad', '2025-04-07 17:06:43'),
(4, 'Mumbai', '2025-04-07 17:51:46'),
(5, 'Goa', '2025-04-07 17:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `name`, `address`, `city`, `state`, `country`, `contact_number`, `email`, `rating`, `description`, `image`, `status`, `created_at`) VALUES
(2, 'Smit Rana', 'C.G Road, Ahmedabad,Gujarat', 'Ahmedabad', 'Gujarat', 'India', '9510246043', 'smitrana8923@gmail.com', 4.5, '5 Star Hotel, ', 'manali.jpg', 'Active', '2025-04-08 10:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `detailed_description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `departure_cities` text DEFAULT NULL,
  `trip_dates` text DEFAULT NULL,
  `days` int(11) NOT NULL,
  `nights` int(11) NOT NULL,
  `itinerary` text DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `child_price` decimal(10,2) DEFAULT NULL,
  `included` text DEFAULT NULL,
  `not_included` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `gallery_images` text DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `is_featured` tinyint(1) DEFAULT 0,
  `cutoff_date` date DEFAULT NULL,
  `cancellation_policy` text DEFAULT NULL,
  `terms_conditions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_popular` tinyint(1) NOT NULL,
  `show_in_banner` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `short_description`, `detailed_description`, `category_id`, `destination_id`, `departure_cities`, `trip_dates`, `days`, `nights`, `itinerary`, `base_price`, `discount`, `child_price`, `included`, `not_included`, `cover_image`, `gallery_images`, `hotel_id`, `tags`, `status`, `is_featured`, `cutoff_date`, `cancellation_policy`, `terms_conditions`, `created_at`, `is_popular`, `show_in_banner`) VALUES
(1, 'ddfdfd', 'fdfdfd', 'fdddfdffdf', 1, 3, NULL, 'Array', 3, 2, NULL, 12500.00, 10.00, 8500.00, 'sffdf', 'ssdfddfdf', '../uploads/manali.jpg', '', NULL, 'sdfsdfffd', 'Active', 1, '2025-05-20', 'dsffdfdsf', 'sdfsfdfdfdfff', '2025-04-08 05:41:17', 0, 0),
(2, 'ddfdfd', 'fdfdfd', 'fdddfdffdf', 1, 3, NULL, 'Array', 3, 2, NULL, 12500.00, 10.00, 8500.00, 'sffdf', 'ssdfddfdf', '../uploads/manali.jpg', '', NULL, 'sdfsdfffd', 'Active', 1, '2025-05-20', 'dsffdfdsf', 'sdfsfdfdfdfff', '2025-04-08 06:54:44', 0, 0),
(7, 'Goa', 'mnjhggivucyc', 'jh  hi   bhbhbib', 3, 5, '0', NULL, 5, 6, '0', 12500.00, 10.00, 4526.00, '  lkmlkml', ', lk lklk', '../uploads/image.png', '', NULL, 'tcvjhjbjh', 'Active', 1, '0000-00-00', ', ,. lmlknjkln', 'kjuyvbibiu', '2025-04-11 19:40:30', 0, 0),
(8, 'Goa', 'mnjhggivucyc', 'jh  hi   bhbhbib', 3, 5, '0', NULL, 5, 6, '0', 12500.00, 10.00, 4526.00, '  lkmlkml', ', lk lklk', '../uploads/image.png', '', NULL, 'tcvjhjbjh', 'Active', 1, '0000-00-00', ', ,. lmlknjkln', 'kjuyvbibiu', '2025-04-11 19:42:55', 0, 0),
(9, 'ioweneiof', 'soifwnoefw', 'ieiwenfoeineo', 2, 2, '0', NULL, 4, 3, '0', 12500.00, 10.00, 8500.00, 'sdfsfdf', 'fsdffff', '../uploads/manali.jpg', '', NULL, '', 'Active', 0, '0000-00-00', 'fsdfsddssf', 'sdfsdsdfd', '2025-04-15 02:17:49', 0, 0),
(10, 'oihgiuiu', 'hbuyuvb', 'uyfyucjhjjhjh', 5, 5, '0', NULL, 4, 3, '0', 12500.00, 10.00, 1200.00, 'biguy', 'bugg', '../uploads/registration.jpg', '', 2, 'dfgfgfg', 'Active', 1, '0000-00-00', 'bhjbhvj', 'buvuvu', '2025-04-15 02:36:48', 1, 1),
(11, 'dfsdfsfsdff', 'dfsdfsdfdsf', 'dddfsdfdf', 3, 3, '0', NULL, 5, 4, '0', 120000.00, 20.00, 58000.00, 'fddfdf', 'dfdfdf', '../uploads/image.png', '../uploads/image.png,../uploads/registration.jpg', 2, 'xvcvcvv', 'Active', 1, '0000-00-00', 'dfdfds', 'dfsdfsdfds', '2025-04-15 06:20:00', 0, 0),
(12, 'Kashmir', 'Kashmir is wonderfull place in  earth .', 'Kasmir is a haven of earth', 2, 3, '0', NULL, 5, 3, '0', 25000.00, 10.00, 21500.00, 'hotel \r\ntaxi', 'drink \r\nfood', '../uploads/image.png', '../uploads/affordable.jpg,../uploads/coverage.jpg,../uploads/group.png,../uploads/startup.png,../uploads/support.jpg,../uploads/target.png,../uploads/team.jpg,../uploads/web.png', 2, 'Family,', 'Active', 1, '0000-00-00', '1 day before possible', '- pay first \r\n- full payment ', '2025-04-15 09:31:49', 1, 1),
(13, 'Mumbai', 'Mumbai', 'osfn os soisdf', 5, 2, '1', NULL, 5, 4, '0', 85000.00, 25.00, 75000.00, 'Soni ', 'Rana', '../uploads/affordable.jpg', '../uploads/startup.png,../uploads/support.jpg,../uploads/target.png', 2, 'Family', 'Active', 1, '0000-00-00', 'asodnos fh', 'slnoisnos os', '2025-04-15 09:56:50', 1, 1),
(14, 'sdfsddf', 'safdsfsd', 'sfsdfsff', 2, 5, '1', NULL, 4, 5, '0', 10000.00, 8.00, 8000.00, 'sdfsddfvsf', 'sfsasasdfsd', '../uploads/group.png', '../uploads/coverage.jpg,../uploads/group.png,../uploads/startup.png,../uploads/support.jpg', 2, 'aosidnoisdnoi', 'Active', 1, '0000-00-00', 'sdfadfes', 'sdfsfdff', '2025-04-15 10:17:27', 0, 0),
(15, 'sdfsddf', 'safdsfsd', 'sfsdfsff', 2, 5, '1', NULL, 4, 5, '0', 10000.00, 8.00, 8000.00, 'sdfsddfvsf', 'sfsasasdfsd', '../uploads/group.png', '../uploads/coverage.jpg,../uploads/group.png,../uploads/startup.png,../uploads/support.jpg', 2, 'aosidnoisdnoi', 'Active', 1, '0000-00-00', 'sdfadfes', 'sdfsfdff', '2025-04-15 10:21:03', 0, 0),
(16, 'sdfsddf', 'safdsfsd', 'sfsdfsff', 2, 5, '1', NULL, 4, 5, '0', 10000.00, 8.00, 8000.00, 'sdfsddfvsf', 'sfsasasdfsd', '../uploads/group.png', '../uploads/coverage.jpg,../uploads/group.png,../uploads/startup.png,../uploads/support.jpg', 2, 'aosidnoisdnoi', 'Active', 1, '0000-00-00', 'sdfadfes', 'sdfsfdff', '2025-04-15 10:21:45', 0, 0),
(17, 'sdfsddf', 'safdsfsd', 'sfsdfsff', 2, 5, '1', NULL, 4, 5, '0', 10000.00, 8.00, 8000.00, 'sdfsddfvsf', 'sfsasasdfsd', '../uploads/group.png', '../uploads/coverage.jpg,../uploads/group.png,../uploads/startup.png,../uploads/support.jpg', 2, 'aosidnoisdnoi', 'Active', 1, '0000-00-00', 'sdfadfes', 'sdfsfdff', '2025-04-15 10:22:41', 0, 0),
(18, 'sdfsddf', 'safdsfsd', 'sfsdfsff', 2, 5, '1', NULL, 4, 5, '0', 10000.00, 8.00, 8000.00, 'sdfsddfvsf', 'sfsasasdfsd', '../uploads/group.png', '../uploads/coverage.jpg,../uploads/group.png,../uploads/startup.png,../uploads/support.jpg', 2, 'aosidnoisdnoi', 'Active', 1, '0000-00-00', 'sdfadfes', 'sdfsfdff', '2025-04-15 10:22:59', 0, 0),
(19, 'sdfsddf', 'safdsfsd', 'sfsdfsff', 2, 5, '1', NULL, 4, 5, '0', 10000.00, 8.00, 8000.00, 'sdfsddfvsf', 'sfsasasdfsd', '../uploads/group.png', '../uploads/coverage.jpg,../uploads/group.png,../uploads/startup.png,../uploads/support.jpg', 2, 'aosidnoisdnoi', 'Active', 1, '0000-00-00', 'sdfadfes', 'sdfsfdff', '2025-04-15 10:23:28', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `package_departure_city`
--

CREATE TABLE `package_departure_city` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_departure_city`
--

INSERT INTO `package_departure_city` (`id`, `package_id`, `city_name`) VALUES
(1, 19, 'Mumbai'),
(2, 19, 'Ahmedabad'),
(3, 19, 'Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `package_trip_dates`
--

CREATE TABLE `package_trip_dates` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `trip_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_trip_dates`
--

INSERT INTO `package_trip_dates` (`id`, `package_id`, `trip_date`) VALUES
(3, 7, '2025-04-25'),
(4, 7, '2025-04-28'),
(5, 8, '2025-04-25'),
(6, 9, '2025-05-05'),
(7, 9, '2025-05-05'),
(8, 10, '2025-05-20'),
(9, 11, '2025-05-25'),
(10, 12, '2025-05-20'),
(11, 12, '0000-00-00'),
(12, 13, '2025-05-25'),
(13, 14, '2025-05-05'),
(14, 15, '2025-05-05'),
(15, 17, '2025-05-05'),
(16, 18, '2025-05-05'),
(17, 19, '2025-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_mobile` varchar(14) NOT NULL,
  `user_dob` date NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_doj` datetime NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_email`, `user_mobile`, `user_dob`, `user_password`, `user_doj`, `reset_token`) VALUES
(11, 'jitt', 'jitt@gmail.com', '7490941144', '2024-04-17', '$2y$10$zdA47CglS9gj/sfu.kb6.OVKQ4Kfb3jRWJO.NeDC70JpvRjZM7FfK', '2025-03-04 14:17:59', ''),
(12, 'jitendra', 'jitendra@gmail.com', '656562', '2024-08-02', '$2y$10$q0s4fU.KCpeSl57PWQGzteA/UEYUPgxkj6DCU/L4XClt7mAM.gJUu', '2025-03-04 14:26:39', ''),
(13, 'smitrana', 'smitrana8923@gmail.com', '9510246043', '2003-09-08', '$2y$10$ff2boctH9.AKgYhrz4Z3U.JVRDarS6V7G49a8XWnPl58MtMPygCAa', '2025-04-03 17:14:17', ''),
(15, 'Viral Rana', 'viralrana1498@gmail.com', '8000425981', '2003-09-08', '$2y$10$5X8.jeJaMXw/ACgr71.BgOWYdx30Pfr6ESGee19/helV1nsNSopYW', '2025-04-06 12:46:39', '4cb2816cd2e1e84ef2eee48c00582bb6988356e27dce72805aaa1fcbddc43bee178b5f3cd1fe6b36b68d68befcdd24bd7e98'),
(16, 'smitsoni1093@gmail.com', 'smitsoni1093@gmail.com', '8128538140', '2003-09-10', '$2y$10$GFQES1VfdNi3q9RN/JFC3O0xud0EgJgOVW.paNWWeccEzhByfc1MK', '2025-04-08 18:27:40', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `destination_table`
--
ALTER TABLE `destination_table`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `destination_id` (`destination_id`),
  ADD KEY `fk_hotel` (`hotel_id`);

--
-- Indexes for table `package_departure_city`
--
ALTER TABLE `package_departure_city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `package_trip_dates`
--
ALTER TABLE `package_trip_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `destination_table`
--
ALTER TABLE `destination_table`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `package_departure_city`
--
ALTER TABLE `package_departure_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_trip_dates`
--
ALTER TABLE `package_trip_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `fk_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`),
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_table` (`c_id`),
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destination_table` (`d_id`);

--
-- Constraints for table `package_departure_city`
--
ALTER TABLE `package_departure_city`
  ADD CONSTRAINT `package_departure_city_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_trip_dates`
--
ALTER TABLE `package_trip_dates`
  ADD CONSTRAINT `package_trip_dates_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
