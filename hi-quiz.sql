-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2018 at 10:37 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hi-quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_topic`) VALUES
(1, '1', '1'),
(2, '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `challenger`
--

CREATE TABLE `challenger` (
  `challenge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `follow_friends`
--

CREATE TABLE `follow_friends` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow_friends`
--

INSERT INTO `follow_friends` (`follow_id`, `user_id`, `status`) VALUES
(1, 2, NULL),
(3, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE `question_bank` (
  `ques_id` int(11) NOT NULL,
  `ques_name` text NOT NULL,
  `c1` varchar(255) NOT NULL,
  `c2` varchar(255) NOT NULL,
  `c3` varchar(255) NOT NULL,
  `c4` varchar(255) NOT NULL,
  `correct` varchar(255) NOT NULL,
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`ques_id`, `ques_name`, `c1`, `c2`, `c3`, `c4`, `correct`, `quiz_id`) VALUES
(4, 'c', 'c', 'c', 'b', 'b', '3', 5),
(5, 'd', 'd', 'b', 'd', 'b', '4', 5),
(6, 'b', 'b', 'b', 'b', 'b', '4', 6),
(7, 'b', 'b', 'b', 'b', 'b', '4', 6),
(8, 'aas', 'sdsd', 'dasd', 'adas', 'sdasd', '4', 7),
(9, 'asdsd', 'asdasd', 'dasd', 'sdasd', 'asdasd', '1', 8),
(10, 'adsad', 'dasd', 'dasd', 'dasd', 'dasd', '1', 9),
(11, 'adasd', 'dasd', 'dasd', 'dasd', 'dasd', '1', 10),
(12, 'Hi', 'a', 'b', 'c', 'd', '2', 11),
(13, 'Hi', 'a', 'b', 'c', 'd', '2', 11);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_time` time NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_time`, `cat_id`) VALUES
(4, '00:03:00', 1),
(5, '00:05:00', 2),
(6, '00:00:00', 1),
(7, '00:00:00', 1),
(8, '00:00:00', 1),
(9, '00:00:00', 1),
(10, '00:00:00', 1),
(11, '00:10:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question_score`
--

CREATE TABLE `quiz_question_score` (
  `quiz_id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `answer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_question_score`
--

INSERT INTO `quiz_question_score` (`quiz_id`, `ques_id`, `time_stamp`, `user_id`, `answer`) VALUES
(10, 11, '2018-03-12 10:25:32', 2, 2),
(11, 12, '2018-03-10 13:39:23', 2, 3),
(11, 13, '2018-03-10 13:39:09', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `user_pic` varchar(250) NOT NULL DEFAULT 'images/user.jpg',
  `online` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `user_email`, `is_admin`, `phone`, `address`, `gender`, `dob`, `active`, `user_pic`, `online`) VALUES
(2, 'admin', 'admin123', 'admin@hiquiz.com', 0, '+9231212412', 'asd', 'female', '0000-00-00', 1, 'images/user.jpg', 1),
(3, 'admin', 'admin123', 'admin@hiquiz.com', 0, '+9231212412', 'asd', 'female', '0000-00-00', 1, 'images/user.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `challenger`
--
ALTER TABLE `challenger`
  ADD PRIMARY KEY (`challenge_id`),
  ADD KEY `challenge_id` (`challenge_id`,`user_id`,`quiz_id`);

--
-- Indexes for table `follow_friends`
--
ALTER TABLE `follow_friends`
  ADD PRIMARY KEY (`follow_id`,`user_id`),
  ADD KEY `follow_id` (`follow_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD PRIMARY KEY (`ques_id`),
  ADD KEY `ques_id` (`ques_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `quiz_question_score`
--
ALTER TABLE `quiz_question_score`
  ADD PRIMARY KEY (`quiz_id`,`ques_id`,`user_id`),
  ADD KEY `quiz_id` (`quiz_id`,`ques_id`),
  ADD KEY `ques_id` (`ques_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `challenger`
--
ALTER TABLE `challenger`
  MODIFY `challenge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_friends`
--
ALTER TABLE `follow_friends`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question_bank`
--
ALTER TABLE `question_bank`
  MODIFY `ques_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow_friends`
--
ALTER TABLE `follow_friends`
  ADD CONSTRAINT `follow_friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD CONSTRAINT `question_bank_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `quiz_question_score`
--
ALTER TABLE `quiz_question_score`
  ADD CONSTRAINT `quiz_question_score_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `quiz_question_score_ibfk_2` FOREIGN KEY (`ques_id`) REFERENCES `question_bank` (`ques_id`),
  ADD CONSTRAINT `quiz_question_score_ibfk_3` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
