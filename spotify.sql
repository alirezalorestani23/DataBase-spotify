-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 03:32 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`) VALUES
(1),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `artist_id` int(11) NOT NULL,
  `genre` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `publish_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `artist_id`, `genre`, `publish_datetime`) VALUES
(1, 'zakharname', 4, 'comedy', '2020-07-29 19:33:06'),
(3, 'my album', 5, 'comedy', '2020-07-29 00:00:00'),
(4, 'khoone narim', 5, 'comedy', '0000-00-00 00:00:00'),
(6, 'album 4', 5, 'rap', '2020-10-16 00:00:00'),
(7, 'music 1', 5, 'rap', '2020-10-16 00:00:00'),
(8, 'album mamad', 5, 'rap', '2020-10-16 00:00:00'),
(9, 'Herman', 5, 'pop', '2020-07-15 17:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `user_id` int(11) NOT NULL,
  `name` varchar(254) COLLATE utf8mb4_persian_ci NOT NULL,
  `nationality` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `begin_year` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`user_id`, `name`, `nationality`, `begin_year`, `is_active`) VALUES
(4, 'dj mamad', 'iran', 2000, 1),
(5, 'AliReza Ghanari', 'usa', 1998, 1);

-- --------------------------------------------------------

--
-- Table structure for table `listener`
--

CREATE TABLE `listener` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(254) COLLATE utf8mb4_persian_ci NOT NULL,
  `last_name` varchar(254) COLLATE utf8mb4_persian_ci NOT NULL,
  `nationality` varchar(254) COLLATE utf8mb4_persian_ci NOT NULL,
  `birthday_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `listener`
--

INSERT INTO `listener` (`user_id`, `first_name`, `last_name`, `nationality`, `birthday_year`) VALUES
(1, 'alireza', 'lorestani', 'iran', 1377),
(4, 'kamal', 'barzegar', 'iran', 1348),
(5, 'reza', 'barzegar', 'iran', 1378);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `name` varchar(254) COLLATE utf8mb4_persian_ci NOT NULL,
  `album_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `name`, `album_id`, `duration`) VALUES
(1, 'tehran male mane', 1, 100),
(2, 'tabestoon kootahe', 1, 3),
(3, 'baran toee', 1, 50),
(6, 'kossher', 3, 6),
(7, 'kossher', 1, 6),
(9, 'music 1', 4, 100),
(10, 'music 2', 4, 178),
(11, 'music 3', 4, 85),
(16, 'music 1', 6, 100),
(17, 'music 2', 6, 178),
(18, 'music 3', 6, 85),
(20, 'music 1', 7, 100),
(21, 'music 1', 8, 100),
(22, 'music 2', 8, 37),
(23, 'Herman', 9, 10),
(24, 'Daricheye Tarik', 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `music_like`
--

CREATE TABLE `music_like` (
  `id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `music_like`
--

INSERT INTO `music_like` (`id`, `listener_id`, `music_id`, `datetime`) VALUES
(6, 1, 3, '2020-07-12 18:51:48'),
(7, 4, 6, '2020-07-07 18:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `music_play`
--

CREATE TABLE `music_play` (
  `id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `music_play`
--

INSERT INTO `music_play` (`id`, `listener_id`, `music_id`, `datetime`) VALUES
(51, 5, 1, '2020-07-05 00:00:00'),
(52, 5, 1, '2020-07-05 00:00:00'),
(53, 5, 1, '2020-07-05 00:00:00'),
(54, 5, 1, '2020-07-05 00:00:00'),
(56, 5, 1, '2020-07-04 00:00:00'),
(57, 5, 1, '2020-07-04 00:00:00'),
(58, 5, 1, '2020-07-05 00:00:00'),
(59, 5, 1, '2020-07-06 00:00:00'),
(62, 5, 1, '2020-07-11 00:00:00'),
(63, 5, 1, '2020-07-11 00:00:00'),
(64, 5, 1, '2020-07-11 00:00:00'),
(65, 5, 1, '2020-07-11 00:00:00'),
(66, 5, 1, '2020-07-11 00:00:00'),
(67, 5, 1, '2020-07-11 00:00:00'),
(68, 5, 1, '2020-07-01 00:00:00'),
(69, 5, 9, '2020-07-09 19:31:40'),
(70, 5, 6, '2020-07-12 19:31:40'),
(71, 5, 24, '2020-07-15 17:25:39'),
(72, 5, 23, '2020-07-16 17:25:39'),
(73, 5, 3, '2020-07-15 18:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `music_report`
--

CREATE TABLE `music_report` (
  `id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `listener_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `music_report`
--

INSERT INTO `music_report` (`id`, `music_id`, `listener_id`, `description`) VALUES
(3, 1, 5, 'قوانین کپی رایت رعایت نشده.'),
(4, 2, 5, 'قوانین کپی رایت رعایت نشده.');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(254) COLLATE utf8mb4_persian_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `author_id`, `name`, `datetime`) VALUES
(14, 5, 'playlist mamad2', '2020-07-08 00:00:00'),
(15, 5, 'rap playlist', '2020-09-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlist_like`
--

CREATE TABLE `playlist_like` (
  `id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `playlist_like`
--

INSERT INTO `playlist_like` (`id`, `listener_id`, `playlist_id`) VALUES
(4, 5, 14);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_music`
--

CREATE TABLE `playlist_music` (
  `id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `playlist_music`
--

INSERT INTO `playlist_music` (`id`, `playlist_id`, `music_id`, `date`) VALUES
(10, 14, 1, '2020-07-11'),
(11, 14, 2, '2020-07-11'),
(13, 15, 1, '2020-07-11'),
(14, 15, 3, '2020-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `playlist_user`
--

CREATE TABLE `playlist_user` (
  `id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `playlist_user`
--

INSERT INTO `playlist_user` (`id`, `listener_id`, `playlist_id`) VALUES
(11, 5, 14),
(12, 1, 14),
(13, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `premium_account`
--

CREATE TABLE `premium_account` (
  `id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `card_number` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `card_expire` date NOT NULL,
  `expiration_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `premium_account`
--

INSERT INTO `premium_account` (`id`, `listener_id`, `card_number`, `card_expire`, `expiration_datetime`) VALUES
(8, 5, '6037909038712345', '2024-11-23', '2021-12-11 08:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` text COLLATE utf8mb4_persian_ci NOT NULL,
  `recovery_question` text COLLATE utf8mb4_persian_ci NOT NULL,
  `recovery_answer` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `recovery_question`, `recovery_answer`) VALUES
(1, 'alireza', 'alireza@gmail.com', 'e49b5f8095a7ba4d373672dc6975a831', 'Favourite color?', 'red'),
(4, 'loriano', '', '3b85985f9cf855e504d65590e339f9ca', 'Favorite Color?', 'blue'),
(5, 'reza', '', 'a0a475cf454cf9a06979034098167b9e', 'Favorite Color?', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `user_follow`
--

CREATE TABLE `user_follow` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `user_follow`
--

INSERT INTO `user_follow` (`id`, `follower_id`, `followee_id`) VALUES
(13, 1, 5),
(16, 5, 1),
(17, 5, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `listener`
--
ALTER TABLE `listener`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`),
  ADD KEY `music_ibfk_1` (`album_id`);

--
-- Indexes for table `music_like`
--
ALTER TABLE `music_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listener_id` (`listener_id`),
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `music_play`
--
ALTER TABLE `music_play`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listener_id` (`listener_id`),
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `music_report`
--
ALTER TABLE `music_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `music_id` (`music_id`),
  ADD KEY `listener_id` (`listener_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `playlist_like`
--
ALTER TABLE `playlist_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listener_id` (`listener_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indexes for table `playlist_music`
--
ALTER TABLE `playlist_music`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listener_id` (`listener_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indexes for table `premium_account`
--
ALTER TABLE `premium_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listener_id` (`listener_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_follow`
--
ALTER TABLE `user_follow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `followee_id` (`followee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `music_like`
--
ALTER TABLE `music_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `music_play`
--
ALTER TABLE `music_play`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `music_report`
--
ALTER TABLE `music_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `playlist_like`
--
ALTER TABLE `playlist_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `playlist_music`
--
ALTER TABLE `playlist_music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `playlist_user`
--
ALTER TABLE `playlist_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `premium_account`
--
ALTER TABLE `premium_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_follow`
--
ALTER TABLE `user_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`user_id`);

--
-- Constraints for table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `artist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `listener`
--
ALTER TABLE `listener`
  ADD CONSTRAINT `listener_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_like`
--
ALTER TABLE `music_like`
  ADD CONSTRAINT `music_like_ibfk_1` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_like_ibfk_2` FOREIGN KEY (`music_id`) REFERENCES `music` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_play`
--
ALTER TABLE `music_play`
  ADD CONSTRAINT `music_play_ibfk_1` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_play_ibfk_2` FOREIGN KEY (`music_id`) REFERENCES `music` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `music_report`
--
ALTER TABLE `music_report`
  ADD CONSTRAINT `music_report_ibfk_1` FOREIGN KEY (`music_id`) REFERENCES `music` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_report_ibfk_2` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `listener` (`user_id`);

--
-- Constraints for table `playlist_like`
--
ALTER TABLE `playlist_like`
  ADD CONSTRAINT `playlist_like_ibfk_1` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_like_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `playlist_music`
--
ALTER TABLE `playlist_music`
  ADD CONSTRAINT `playlist_music_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_music_ibfk_2` FOREIGN KEY (`music_id`) REFERENCES `music` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD CONSTRAINT `playlist_user_ibfk_1` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_user_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `premium_account`
--
ALTER TABLE `premium_account`
  ADD CONSTRAINT `premium_account_ibfk_1` FOREIGN KEY (`listener_id`) REFERENCES `listener` (`user_id`);

--
-- Constraints for table `user_follow`
--
ALTER TABLE `user_follow`
  ADD CONSTRAINT `user_follow_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `listener` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_follow_ibfk_2` FOREIGN KEY (`followee_id`) REFERENCES `listener` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
