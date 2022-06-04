-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022 年 04 月 20 日 02:52
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `chat_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `msg` varchar(550) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `uuid`, `msg`, `created_on`) VALUES
(19, 'b09a5624-e239-4016-bfad-82c01269fcf3', 'hi', '2022-04-20 01:08:22'),
(20, '6e8fbe91-22f2-4e43-972d-c5747aac9e0c', 'hihi', '2022-04-20 01:39:27'),
(21, '6e8fbe91-22f2-4e43-972d-c5747aac9e0c', 'hi', '2022-04-20 01:39:47'),
(22, '6e8fbe91-22f2-4e43-972d-c5747aac9e0c', 'hi', '2022-04-20 01:39:48'),
(23, '6e8fbe91-22f2-4e43-972d-c5747aac9e0c', 'hi', '2022-04-20 01:39:49'),
(24, '6e8fbe91-22f2-4e43-972d-c5747aac9e0c', 'im eating \n', '2022-04-20 01:40:23'),
(25, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'ok', '2022-04-20 01:40:33'),
(26, '7c6dc6c0-fabd-47f2-b44b-874bb781bb63', 'hi', '2022-04-20 02:19:28'),
(27, '7c6dc6c0-fabd-47f2-b44b-874bb781bb63', 'im eating dinner', '2022-04-20 02:20:10'),
(28, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'ok', '2022-04-20 02:20:18'),
(29, 'a1cea7aa-6dd3-4f3d-80d0-0a3b35601f03', 'hihihihi', '2022-04-20 02:31:10'),
(30, 'a1cea7aa-6dd3-4f3d-80d0-0a3b35601f03', 'hihihi', '2022-04-20 02:31:42'),
(31, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'im eating dinner', '2022-04-20 02:31:52'),
(32, 'a1cea7aa-6dd3-4f3d-80d0-0a3b35601f03', 'ok ', '2022-04-20 02:31:58'),
(33, '3f6ed48e-fd25-4b38-bcec-798737501159', 'hihi', '2022-04-20 02:45:19');

-- --------------------------------------------------------

--
-- 資料表結構 `privatemessage`
--

CREATE TABLE `privatemessage` (
  `id` int(11) NOT NULL,
  `sender` varchar(30) NOT NULL,
  `receiver` varchar(30) NOT NULL,
  `msg` varchar(550) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `privatemessage`
--

INSERT INTO `privatemessage` (`id`, `sender`, `receiver`, `msg`, `created_on`) VALUES
(19, 'hochaklam1', 'jackyho27', 'hihih', '2022-04-20 12:52:12'),
(18, 'rindo2777', 'jackyho27', 'yooooo\n', '2022-04-18 10:20:49'),
(17, 'jackyho27', 'rindo2777', 'yoo ', '2022-04-18 10:20:07'),
(16, 'chaklam27', 'jackyho27', 'ok', '2022-04-17 07:36:36'),
(15, 'jackyho27', 'chaklam27', 'im eating dinner', '2022-04-17 07:36:34'),
(14, 'jackyho27', 'chaklam27', 'yoooooo', '2022-04-17 07:36:29'),
(9, 'jackyho27', 'chaklam27', 'wa', '2022-04-15 01:03:00'),
(13, 'chaklam27', 'jackyho27', 'yoooo', '2022-04-17 07:36:26'),
(11, 'jackyho27', 'chaklam27', 'wat', '2022-04-15 01:29:12'),
(12, 'rindo2777', 'chaklam27', 'eating dinner', '2022-04-15 01:38:42'),
(20, 'jackyho27', 'hochaklam1', 'asdasdsad', '2022-04-20 12:52:41'),
(21, 'hochaklam1', 'jackyho27', 'dasdasdsds', '2022-04-20 12:52:42'),
(22, 'hochaklam1', 'jackyho27', 'hi im eating ', '2022-04-20 12:52:47'),
(23, 'hochaklam11', 'jackyho27', 'hi', '2022-04-20 01:41:03'),
(24, 'hochaklam11', 'jackyho27', 'im eating dinner', '2022-04-20 01:42:23'),
(25, 'jackyho27', 'hochaklam11', 'ok', '2022-04-20 01:42:28'),
(26, 'hochaklam112', 'jackyho27', 'hi', '2022-04-20 02:32:42'),
(27, 'jackyho27', 'hochaklam112', 'hi wat are u doin', '2022-04-20 02:32:50'),
(28, 'hochaklam112', 'jackyho27', 'im sleeping now \n', '2022-04-20 02:32:56'),
(29, 'hochaklam111', 'rindo2777', 'hihihi', '2022-04-20 02:46:54'),
(30, 'rindo2777', 'hochaklam111', 'im eating dinner ', '2022-04-20 02:47:01'),
(31, 'hochaklam111', 'rindo2777', 'hi', '2022-04-20 02:47:05');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `user_token` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `uuid`, `firstname`, `lastname`, `gender`, `email`, `username`, `password`, `nickname`, `age`, `description`, `filename`, `status`, `user_token`) VALUES
(1, 'd428f25f-8990-4d77-8a05-b72d1d1c444d', 'Rindo', 'Sakura', 'male', 'rindo27@rindo.com', 'rindo2777', '$2y$10$KvODrclEgqxQdai5S/gQoO9Nh9zySlZJ2blSYZ.mmXh1VHIP6ydfS', 'rindo1111', NULL, 'iduysadkjasludklsahkl', 'testicon.png', 1, '$2y$10$AXzTqob.SmoY41HoQfYksOfdPqw3Ouvjpyqq4KQHbNKm66Z4JUTeW'),
(2, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'Jacky', 'Ho', 'male', 'jackyho27@jackyho27.com', 'jackyho27', '$2y$10$/QljRYliMnGoNDBanRk41eqzrKv1zs4.qYXgiOeLARQgn7gOKK13i', 'jackyho1111', NULL, NULL, 'testicon7.png', 0, '0'),
(7, '132dfb09-94fa-4d56-8b29-10c2731a250c', 'Peter', 'Lam', 'secret', 'peterlam1@peterlam1.com', 'peterlam1', '$2y$10$.3UKHIEW6A7dVd8aKXuRFezqivAMMhpPhG4LJYwB5vgEsxSPG0R/O', 'peterlam1', NULL, NULL, NULL, 0, '0'),
(3, '0386f484-8fe6-4ff8-8924-ef7e81ea88a1', 'Chak', 'Lam', 'secret', 'chaklam27@chaklam27.com', 'chaklam27', '$2y$10$KuPj55gprXGFjBLByDQVj.qYIsyd8Zv9za017mPvEBYd16bBdEaoy', 'chaklam1111', NULL, NULL, 'boss.jpg', 0, '0');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`uuid`),
  ADD KEY `fk_to_usersid` (`uuid`);

--
-- 資料表索引 `privatemessage`
--
ALTER TABLE `privatemessage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`sender`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`id`,`uuid`) USING BTREE;

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `privatemessage`
--
ALTER TABLE `privatemessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
