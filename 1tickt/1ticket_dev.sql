-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 05:34 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1ticket_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Film & Animation'),
(2, 'Autos & Vehicles'),
(3, 'Music'),
(4, 'Pets & Animals'),
(5, 'Sports'),
(6, 'Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(50) NOT NULL,
  `videoId` int(11) NOT NULL,
  `responseTo` int(11) NOT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postedBy`, `videoId`, `responseTo`, `body`, `datePosted`) VALUES
(1, 'mickey-123', 13, 0, '123', '2022-12-20 12:50:48'),
(9, 'mickey-123', 13, 0, '12354', '2022-12-20 18:56:34'),
(10, 'mickey-123', 13, 0, 'Hey', '2022-12-20 18:57:27'),
(11, 'mickey-123', 13, 0, 'New comment', '2022-12-20 19:14:19'),
(12, 'mickey-123', 13, 0, 'Hi everyone', '2022-12-20 19:15:39'),
(13, 'mickey-123', 13, 0, 'Submit comment', '2022-12-20 19:16:09'),
(14, 'mickey-123', 13, 0, 'Test', '2022-12-20 19:17:50'),
(15, 'mickey-123', 13, 0, 'Yoooo', '2022-12-20 19:25:27'),
(16, 'mickey-123', 13, 0, 'Yooo', '2022-12-20 19:25:58'),
(17, 'mickey-123', 13, 0, 'Yooo', '2022-12-20 19:26:20'),
(18, 'mickey-123', 13, 0, 'Testing section', '2022-12-20 19:26:52'),
(19, 'mickey-123', 13, 0, 'Section of reply', '2022-12-20 19:31:36'),
(20, 'mickey-123', 13, 0, 'Styling test', '2022-12-20 19:38:53'),
(21, 'mickey-123', 13, 0, 'Date Post test', '2022-12-20 19:50:18'),
(22, 'mickey-123', 13, 0, 'Timestamp', '2022-12-20 19:51:28'),
(23, 'mickey-123', 13, 0, 'Test for errors', '2022-12-20 20:00:27'),
(24, 'mickey-123', 13, 0, 'Test hidden form', '2022-12-20 20:03:44'),
(25, 'mickey-123', 13, 0, 'ajax like reply update', '2022-12-20 20:20:07'),
(26, 'mickey-123', 13, 0, 'Dislike test', '2022-12-20 20:21:32'),
(27, 'mickey-123', 13, 26, 'Sup dude', '2022-12-20 20:29:19'),
(28, 'mickey-123', 13, 27, 'Nested reply', '2022-12-20 20:38:37'),
(29, 'mickey-123', 13, 27, 'yooo', '2022-12-20 20:43:06'),
(30, 'mickey-123', 13, 27, 'yo2', '2022-12-20 20:43:52'),
(31, 'mickey-123', 12, 0, 'Yessirrrrr', '2022-12-24 21:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `commentId`, `videoId`) VALUES
(10, 'mickey-123', 0, 12),
(11, 'mickey-123', 25, 0),
(13, 'mickey-123', 26, 0),
(15, 'zhammy123', 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `userTo` varchar(50) NOT NULL,
  `userFrom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `userTo`, `userFrom`) VALUES
(3, 'donkeykong', 'mickey-123');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoId`, `filePath`, `selected`) VALUES
(1, 11, 'uploads/videos/thumbnails/11-638f9f605e5d2.jpg', 1),
(2, 11, 'uploads/videos/thumbnails/11-638f9f609b816.jpg', 0),
(3, 11, 'uploads/videos/thumbnails/11-638f9f60e57e6.jpg', 0),
(4, 12, 'uploads/videos/thumbnails/12-639d0a8a6aaae.jpg', 1),
(5, 12, 'uploads/videos/thumbnails/12-639d0a8a95819.jpg', 0),
(6, 12, 'uploads/videos/thumbnails/12-639d0a8aca4dd.jpg', 0),
(7, 13, 'uploads/videos/thumbnails/13-639e7d9db3362.jpg', 1),
(8, 13, 'uploads/videos/thumbnails/13-639e7d9e25d49.jpg', 0),
(9, 13, 'uploads/videos/thumbnails/13-639e7d9ebf702.jpg', 0),
(10, 14, 'uploads/videos/thumbnails/14-63a470f536165.jpg', 1),
(11, 14, 'uploads/videos/thumbnails/14-63a470f564b70.jpg', 0),
(12, 14, 'uploads/videos/thumbnails/14-63a470f5939d7.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `profilePic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'Mickey', 'Mouse', 'mickey-123', 'Mickey@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2022-12-10 22:44:21', 'assets/images/profilePictures/default.png'),
(2, 'Donkey', 'Kong', 'donkey-kong', 'dk@gmail.com', 'bed4efa1d4fdbd954bd3705d6a2a78270ec9a52ecfbfb010c61862af5c76af1761ffeb1aef6aca1bf5d02b3781aa854fabd2b69c790de74e17ecfec3cb6ac4bf', '2022-12-10 22:47:43', 'assets/images/profilePictures/default.png'),
(3, 'Donkey', 'Kong', 'donkeykong', 'dk123@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2022-12-17 21:39:55', 'assets/images/profilePictures/default.png'),
(4, 'Zian', 'Templeton', 'zhammy123', 'swp5372@gmail.com', '4f02e0126771735d7c9a46a2e1a70c73a204ba0c96df17a608db541047baa34097fa8de5526729fd683fef5cf449ba0cb0551eeeebf70645a00bd8472644dff0', '2023-03-15 00:22:52', 'assets/images/profilePictures/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL DEFAULT 0,
  `filePath` varchar(250) NOT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) NOT NULL DEFAULT 0,
  `duration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uploadedBy`, `title`, `description`, `privacy`, `filePath`, `category`, `uploadDate`, `views`, `duration`) VALUES
(11, 'REPLACEE-THIS', 'Thumbnail', 'generate thumbnail vid', 0, 'uploads/videos/638f9f5dcf03e.mp4', 1, '2022-12-06 15:00:29', 2, '00:21'),
(12, 'mickey-123', 'Quack', 'Duck', 0, 'uploads/videos/639d0a85343cd.mp4', 1, '2022-12-16 19:17:09', 69, '00:03'),
(13, 'donkeykong', 'Amogus', 'Sus', 1, 'uploads/videos/639e7d9521043.mp4', 6, '2022-12-17 21:40:21', 117, '00:20'),
(14, 'mickey-123', 'Family Guy', 'Peter Reverse Card', 0, 'uploads/videos/63a470ee9bad2.mp4', 6, '2022-12-22 09:59:58', 5, '00:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
