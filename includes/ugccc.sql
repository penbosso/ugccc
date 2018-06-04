-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2018 at 01:06 PM
-- Server version: 10.2.14-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ugccc`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `content`, `image`, `created_by_user`, `date_created`) VALUES
(25, 'Vacation', 'School hdjhfjdhf', 'img_8402.jpeg', 4, '2018-05-29 10:12:05'),
(26, 'Shs outreach', 'bbgreber', 'img_7838.png', 4, '2018-05-29 10:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `assign_counsellor`
--

CREATE TABLE `assign_counsellor` (
  `id` int(11) NOT NULL,
  `counsel_id` int(11) DEFAULT NULL,
  `date_assigned` date DEFAULT NULL,
  `complaint_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assign_counsellor`
--

INSERT INTO `assign_counsellor` (`id`, `counsel_id`, `date_assigned`, `complaint_id`) VALUES
(46, 1, '2018-05-06', 89),
(47, 2, '2018-05-06', 90),
(48, 1, '2018-05-29', 91),
(49, 2, '2018-05-29', 92),
(50, 1, '2018-05-29', 93),
(51, 2, '2018-05-29', 94),
(52, 1, '2018-05-29', 95),
(53, 2, '2018-05-29', 96),
(54, 1, '2018-05-29', 97);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `scheduled_date` varchar(500) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `assign_counsellor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `scheduled_date`, `location_id`, `assign_counsellor_id`) VALUES
(33, '1525681800', 1, 46),
(34, '1525870800', 1, 47),
(35, '1528101000', 1, 48),
(37, '1527688800', 1, 49),
(38, '1528104600', 1, 50),
(39, '1527685200', 1, 51),
(40, '1528108200', 1, 52),
(41, '1527692400', 1, 53),
(42, '1528111800', 1, 54);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date_logged` date DEFAULT NULL,
  `date_couns_started` varchar(100) DEFAULT NULL,
  `date_couns_ended` varchar(100) DEFAULT NULL,
  `stressor` varchar(100) NOT NULL,
  `short_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `student_id`, `date_logged`, `date_couns_started`, `date_couns_ended`, `stressor`, `short_desc`) VALUES
(88, 3, '2018-05-04', '', '', 'Choose.....', ' '),
(89, 3, '2018-05-06', '2018-05-06 17:59:05', NULL, 'anxiety', 'kkkml '),
(90, 3, '2018-05-06', '', '', 'anxiety', 'kofi '),
(91, 3, '2018-05-29', '2018-05-29 10:46:14', '2018-05-29 10:47:04', 'anxiety', 'kdkkflv '),
(92, 3, '2018-05-29', '2018-05-29 07:30:27', NULL, 'anxiety', 'fkllv '),
(93, 3, '2018-05-29', '', '', 'anxiety', 'dffffg '),
(94, 3, '2018-05-29', '', '', 'anxiety', 'jhjhjhj '),
(95, 3, '2018-05-29', '', '', 'anxiety', 'fgggg '),
(96, 3, '2018-05-29', '', '', 'tension', 'vggbhh '),
(97, 6, '2018-05-29', '', '', 'anxiety', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `counsellor`
--

CREATE TABLE `counsellor` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `start_time` varchar(45) DEFAULT NULL,
  `end_time` varchar(45) DEFAULT NULL,
  `start_day` varchar(45) DEFAULT NULL,
  `end_day` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counsellor`
--

INSERT INTO `counsellor` (`id`, `type`, `start_time`, `end_time`, `start_day`, `end_day`, `user_id`) VALUES
(1, NULL, '8:30', '16:30', 'monday', 'friday', 2),
(2, NULL, '13:00', '16:00', 'wednesday', 'wednesday', 3);

-- --------------------------------------------------------

--
-- Table structure for table `counsellor_speciality`
--

CREATE TABLE `counsellor_speciality` (
  `id` int(11) NOT NULL,
  `counsel_id` int(11) DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counsellor_speciality`
--

INSERT INTO `counsellor_speciality` (`id`, `counsel_id`, `speciality_id`) VALUES
(1, 1, 6),
(2, 1, 1),
(3, 1, 7),
(4, 1, 2),
(5, 1, 13),
(6, 1, 8),
(7, 1, 9),
(8, 1, 10),
(9, 1, 11),
(10, 1, 12),
(21, 2, 6),
(22, 2, 7),
(23, 2, 1),
(24, 2, 2),
(25, 2, 3),
(26, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'CCC-UG main office'),
(2, 'Balme Library'),
(3, 'Jubilee'),
(4, 'City Campus');

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`id`, `name`) VALUES
(1, 'anxiety'),
(2, 'tension'),
(3, 'sleeplessness'),
(4, 'phobias'),
(5, 'stammering'),
(6, 'emotional problems'),
(7, 'psychological problems'),
(8, 'study skills'),
(9, 'career development'),
(10, 'career interest profiling'),
(11, 'general adjustment'),
(12, 'psychometric testing'),
(13, 'poor performance');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `other_names` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `hall_of_residence` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `course` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `last_name`, `first_name`, `other_names`, `telephone`, `email`, `hall_of_residence`, `department`, `course`, `password`) VALUES
(1, NULL, 'mensah', 'kofi', 'aba', '0554587986', 'kmens@gmail.com', 'mensah sarbah', 'computer science', 'IT', 'hokd '),
(3, '10518900', 'mensah', 'kofi', 'aba', '0500003941', 'kmens@gmail.com', 'mensah sarbah', 'computer science', 'IT', 'hokd'),
(4, '104556212', 'mensah', 'kofi', 'aba', '0554587986', 'kmens@gmail.com', 'mensah sarbah', 'computer science', 'IT', 'hokd '),
(5, '104556212', 'mensah', 'kofi', 'aba', '0554587986', 'kmens@gmail.com', 'mensah sarbah', 'computer science', 'IT', 'hokd '),
(6, '10516064', 'mensah', 'edinam', 'aba', '0554587986', 'kmens@gmail.com', 'mensah sarbah', 'computer science', 'IT', 'hokd '),
(7, '10516064', 'mensah', 'edinam', 'aba', '0554587986', 'kmens@gmail.com', 'mensah sarbah', 'computer science', 'IT', 'hokd '),
(8, '10516064', 'Sedo', 'Edinam', 'M', '0545515156', 'edised@gmail.com', 'au', 'comp sci', '1', 'jdfof '),
(9, '10516069', 'hyhy', 'efrg', 'yhyh', '05552525', 'ylodonu@gmail.com', 'au', 'computer science', 'bsc. comp', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `other_names` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `other_names`, `title`, `email`, `password`, `user_type`) VALUES
(2, 'Gladys', 'Setordzie', NULL, 'Mrs.', 'gladys@gmail.com', 'gladys', 'counsellor'),
(3, 'Frank', 'Banning', NULL, 'Dr.', 'frank@gmail.com', 'frank', 'counsellor'),
(4, 'yaa', 'mensah', 'ababio', 'mr', 'kmens@gmail.com', 'kmens', 'front_desk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `assign_counsellor`
--
ALTER TABLE `assign_counsellor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counsellor`
--
ALTER TABLE `counsellor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- Indexes for table `counsellor_speciality`
--
ALTER TABLE `counsellor_speciality`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `assign_counsellor`
--
ALTER TABLE `assign_counsellor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `counsellor`
--
ALTER TABLE `counsellor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `counsellor_speciality`
--
ALTER TABLE `counsellor_speciality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
