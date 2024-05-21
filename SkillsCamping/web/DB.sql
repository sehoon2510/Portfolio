-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-11-15 07:42
-- 서버 버전: 10.4.27-MariaDB
-- PHP 버전: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `swjb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu` text NOT NULL,
  `buy` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `special` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `menus`
--

INSERT INTO `menus` (`id`, `menu`, `buy`, `unit`, `special`) VALUES
(1, '바비큐 그릴 대여', 10000, '대여', 1),
(2, '돼지고기 바비큐 세트', 12000, '인분', NULL),
(3, '해산물 바비큐 세트', 15000, '인분', NULL),
(4, '음료', 3000, '병', NULL),
(5, '주류', 5000, '병', 2),
(6, '과자 세트(3종)', 4000, '세트', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `orders`
--

CREATE TABLE `orders` (
  `rid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `state` char(10) NOT NULL DEFAULT '접수',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `orders`
--

INSERT INTO `orders` (`rid`, `mid`, `count`, `state`, `date`) VALUES
(3, 1, 1, '주문취소', '2023-09-18 20:42:16'),
(3, 2, 5, '주문취소', '2023-09-18 20:42:16'),
(3, 3, 2, '주문취소', '2023-09-18 20:42:16'),
(3, 4, 3, '주문취소', '2023-09-18 20:42:16'),
(3, 5, 2, '주문취소', '2023-09-18 20:42:16'),
(4, 1, 1, '배달완료', '2023-09-18 20:55:44'),
(4, 2, 3, '배달완료', '2023-09-18 20:55:44'),
(4, 3, 1, '배달완료', '2023-09-18 20:55:44'),
(4, 4, 1, '배달완료', '2023-09-18 20:55:44'),
(4, 5, 3, '배달완료', '2023-09-18 20:55:44'),
(4, 6, 4, '배달완료', '2023-09-18 20:55:44'),
(1, 1, 1, '주문취소', '2023-09-18 20:56:29'),
(1, 2, 9, '주문취소', '2023-09-18 20:56:29'),
(11, 1, 1, '접수', '2023-09-19 17:23:24'),
(11, 3, 4, '접수', '2023-09-19 17:23:24'),
(11, 5, 6, '접수', '2023-09-19 17:23:24'),
(11, 6, 1, '접수', '2023-09-19 17:23:24');

-- --------------------------------------------------------

--
-- 테이블 구조 `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `phone` text NOT NULL,
  `reservation_date` date NOT NULL,
  `seat` text NOT NULL,
  `buy` int(11) NOT NULL,
  `type` text NOT NULL,
  `admintype` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `reservation`
--

INSERT INTO `reservation` (`id`, `phone`, `reservation_date`, `seat`, `buy`, `type`, `admintype`, `date`) VALUES
(1, '010-1111-1111', '2023-09-22', 'A02', 25000, 'R', 'R', '2023-09-18 20:32:02'),
(2, '010-2222-2222', '2023-09-24', 'A07', 30000, 'R', 'R', '2023-09-18 20:32:27'),
(3, '010-3333-3333', '2023-09-23', 'A05', 30000, 'C', 'C', '2023-09-18 20:32:45'),
(4, '010-1111-1111', '2023-09-26', 'A03', 25000, 'R', 'R', '2023-09-18 20:34:25'),
(5, '010-4444-4444', '2023-09-25', 'T02', 15000, 'R', 'R', '2023-09-18 20:34:39'),
(6, '010-2222-2222', '2023-09-26', 'A06', 25000, 'C', 'C', '2023-09-18 20:35:06'),
(7, '010-5555-5555', '2023-09-27', 'T04', 15000, 'W', 'W', '2023-09-18 20:35:57'),
(8, '010-2222-2222', '2023-09-26', 'T06', 15000, 'W', 'W', '2023-09-18 20:36:11'),
(9, '010-3333-3333', '2023-09-26', 'T08', 15000, 'C', 'C', '2023-09-18 20:41:44'),
(10, '010-1111-1111', '2023-09-28', 'A06', 25000, 'W', 'W', '2023-09-18 20:45:15'),
(11, '010-8888-8888', '2023-09-28', 'A03', 25000, 'R', 'R', '2023-09-19 17:22:11'),
(12, '010-1111-1111', '2023-09-25', 'A03', 25000, 'R', 'R', '2023-09-19 17:33:01');

-- --------------------------------------------------------

--
-- 테이블 구조 `reservationjson`
--

CREATE TABLE `reservationjson` (
  `seat` text NOT NULL,
  `date` int(11) NOT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `reservationjson`
--

INSERT INTO `reservationjson` (`seat`, `date`, `type`) VALUES
('A01', 0, 'W'),
('A02', 0, 'W'),
('A03', 0, 'W'),
('A04', 0, 'W'),
('A05', 0, 'W'),
('A06', 0, 'W'),
('A07', 0, 'W'),
('T01', 0, 'W'),
('T02', 0, 'W'),
('T03', 0, 'W'),
('T04', 0, 'W'),
('T05', 0, 'W'),
('T06', 0, 'W'),
('T07', 0, 'W'),
('T08', 0, 'W'),
('T09', 0, 'W'),
('T10', 0, 'W');

-- --------------------------------------------------------

--
-- 테이블 구조 `special`
--

CREATE TABLE `special` (
  `id` int(11) NOT NULL,
  `class` text NOT NULL,
  `text` text NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `special`
--

INSERT INTO `special` (`id`, `class`, `text`, `color`) VALUES
(1, 'fa-circle-info', '도구 및 숯 등 포함', 'black'),
(2, 'fa-triangle-exclamation', '만 19세 미만 구매 불가', 'danger');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `userid` varchar(13) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`userid`, `username`, `password`) VALUES
('000-0000-0000', '관리자', '*B3943DDA1C8228C1C2C4D5EB72C08DFA19CFC45E'),
('010-1111-1111', '사용자1', '*82A5A203C1CD1A8A73EA66B6BA57C66B6CE6FC26'),
('010-2222-2222', '사용자2', '*6E52837FCB90DF8269598B145C9C353F6444EF24'),
('010-3333-3333', '사용자3', '*C785F75E5198385A1532A0845296E8649006CE7E'),
('010-4444-4444', '사용자4', '*8B7B8398D1ACA1651301C04C6C980EA145AE080B'),
('010-5555-5555', '사용자5', '*AAB6CE4929B3F23AB7119B253389602680C8154E'),
('010-8888-8888', '사용자8', '*7224FFE72B9A53B6D20916880DA2FC9E6C7DAA1E');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `special`
--
ALTER TABLE `special`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 테이블의 AUTO_INCREMENT `special`
--
ALTER TABLE `special`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
