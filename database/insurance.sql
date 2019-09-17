-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2018 at 08:31 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `mobile`, `role`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin123', '$2y$10$MlMp/hBb2NN1FhDprevI9Oq4CwOQ.QLR5X9VnYF1dkR1wpqbzEz9a', '9586478047', 'admin'),
(2, 'john', 'doye', 'john@gmail.com', 'john123', '$2y$10$.rtU7.hs8QpmHDr9NO4xees5KijAhXJ4rP.ircNADODPtuAoH3iES', '9632587410', 'user'),
(4, 'testuser', 'test', 'test@test.com', 'test123', '$2y$10$kfw09zlCNZ2pY.OP5.b6x.8GJQQM7gUwfL3BkfBgGIWZvo3RV4hbu', '9899978787', 'user'),
(5, 'mike', 'blue', 'mike@gmail.com', 'mike01', '$2y$10$wuXy0R2L9b9LGf8T25WgXeUqN/X5pIc4/lO05tAVu5FMxrqwk5mXG', '9874563210', 'user'),
(6, 'testusre3', 'test', 'test@g.com', 'test3', '$2y$10$av2k9fdIWsvqh1BDuk0dgePAyvxwuC1RkdJMSe32vpk63ljFM8rRC', '9825098250', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
