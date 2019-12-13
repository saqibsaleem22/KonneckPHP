-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2019 at 12:25 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konneck`
CREATE DATABASE konneck;
USE konneck;
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_profile` varchar(255) NOT NULL,
  `user_city` text NOT NULL,
  `user_gender` text NOT NULL,
  `forgotten_answer` varchar(100) NOT NULL,
  `log_in` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_profile`, `user_city`, `user_gender`, `forgotten_answer`, `log_in`) VALUES
(15, 'john23', 'phpmyadmin', 'example@gmail.com', '../images/2.jpg', 'Madrid', 'Male', 'saqib', 'Offline');

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_profile`, `user_city`, `user_gender`, `forgotten_answer`, `log_in`) VALUES
(16, 'max50', 'phpmyadmin', 'example2@gmail.com', '../images/2.jpg', 'Madrid', 'Male', 'saqib', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `users_chat`
--

CREATE TABLE `users_chat` (
  `msg_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `msg_status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `msg_type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_chat`
--
ALTER TABLE `users_chat`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users_chat`
--
ALTER TABLE `users_chat`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_chat`
--
ALTER TABLE `users_chat`
  ADD CONSTRAINT `users_chat_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `users_chat_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
