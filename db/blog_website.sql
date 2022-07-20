-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2022 at 10:55 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(4) NOT NULL,
  `title` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `postdate` date NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(225) NOT NULL,
  `tag` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(225) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(17, 'superadmin', 'admin', 'root', 'admin@gmail.com', '$2y$10$lapZDjwd7TQxuUYpj1.QR.oDYVUHVpSrIrE3Du9uYVdfut8LbeeFy', 'superadmin'),
(34, 'rohit', 'rohit', 'mishra', 'asd@fma.com', '$2y$10$3F9Ed09M.6XME1X4A8DjJeqUuKYaNgRl15Y2Hg6crzB.kyE63fSWi', 'admin'),
(33, 'admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$K2kbVo6EKfK3ohRczHeFTeQXp/QY1ntD6CYsE5HnnoXTRpHQxMmTS', 'admin'),
(32, 'Anita', 'Anita', 'Tripathi', 'Anita@news.com', '$2y$10$7KfUKekvwokLRG0knATc0Oz5HDT1nU7atLW1pdJcoEiISAwfPukfK', 'user'),
(30, 'Roshni', 'Roshni', 'Pathak', 'roshni@xolo.com', '$2y$10$amwr587NQMax/y6oo52tceGocu8UeR3ZFSZTikVplS6n7cGZvxS6S', 'user'),
(29, 'Anirban', 'Anirban', 'Dutta', 'anirban@fmail.cm', '$2y$10$1gC7/hXMInsGTViwqe4Rc.E04Wi8AZzd7HHVvLIMtcungTGZ.C1Me', 'user'),
(28, 'user', 'User', 'John', 'user@gmail.com', '$2y$10$t.iuj8gRymllrHDcVvzcLOwPilfxwNKknJH2rnLr3zFdwRVzQnR7q', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
