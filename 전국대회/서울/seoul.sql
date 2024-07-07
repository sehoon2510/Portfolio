-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-07-07 09:40
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `seoul`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `festivalgoods`
--

CREATE TABLE `festivalgoods` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `festivals`
--

CREATE TABLE `festivals` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `img` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `company` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `ticketPrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `festivals`
--

INSERT INTO `festivals` (`id`, `uid`, `img`, `name`, `description`, `address`, `startDate`, `endDate`, `company`, `city`, `phone`, `ticketPrice`) VALUES
(1, 1, 'festivals/16.jpg', '울진 해양 축제', '울진에서 열리는 해양 생태 관광 축제에 참여해보세요. 다양한 해양 생물들과 함께 바다에서의 즐거운 시간을 보내보세요.', '경상북도 울진군 해양로 567', '2024-06-10 07:30:00', '2024-09-23 04:30:00', '포항 (Pohang)', '울진', '010-9876-5432', 10000),
(2, 2, 'festivals/1.jpg', '자연속 여행 축제', '경북에서 펼쳐지는 자연 속 여행을 즐길 수 있는 캠핑 행사입니다. 잔디밭 위에서 별빛 아래 즐기는 캠프파이어와 자연 속 트레킹을 즐겨보세요.', '경상북도 경주시 황리단길 123', '2024-05-01 08:30:00', '2024-08-09 05:00:00', '경산 (Gyeongsan)', '경주', '010-1234-5678', 0),
(3, 3, 'festivals/4.jpg', '베스트 자전거 축제', '경북에서 진행되는 자전거 투어에 참여해보세요. 아름다운 자연 풍경을 따라 자전거를 타며 신나는 여행을 떠나보세요.', '경상북도 안동시 도산로 321', '2024-05-08 07:45:00', '2024-08-22 05:45:00', '안동 (Andong)', '안동', '010-2345-6789', 0),
(4, 4, 'festivals/5.jpg', '전통 공연 체엄 축제', '경북에서 열리는 전통 공연을 즐겨보세요. 풍부한 문화와 예술이 어우러진 이색적인 공연이 여러분을 기다립니다.', '경상북도 경산시 박정로 234', '2024-05-10 08:30:00', '2024-08-24 03:30:00', '구미 (Gumi)', '경산', '010-8765-4321', 20000),
(5, 14, 'festivals/1720333739화면 캡처 2024-06-09 155045.png', '예술 창작 축제', '경북에서 열리는 예술 창작 워크숍에 참여해보세요. 전문 예술가들이 직접 가르치는 강의와 창작 활동이 준비되어 있습니다.', '경상북도 경주시 불국로 345', '2024-05-12 08:15:00', '2024-08-26 12:15:00', 'tester', '영천 (Yeongcheon)', '010-5432-1098', 10000),
(6, 6, 'festivals/7.jpg', '농업 체험 축제', '경북에서 열리는 자연 친화적인 농업 체험 프로그램에 참여해보세요. 농부들과 함께 논밭을 걷고 새콤달콤한 과일을 맛보세요.', '경상북도 영주시 영주산로 678', '2024-05-15 07:00:00', '2024-08-29 11:00:00', '경주 (Gyeongju)', '영주', '010-3210-9876', 8000),
(7, 7, 'festivals/8.jpg', '경주 베스트 특산품', '경북에서 열리는 다양한 특산품 시장에 참여해보세요. 지역 특산품과 소품들을 구경하고 맛보는 재미를 느껴보세요.', '경상북도 경주시 교동로 567', '2024-05-18 08:45:00', '2024-09-01 12:45:00', '경산 (Gyeongsan)', '경주', '010-6543-2109', 7000),
(8, 8, 'festivals/10.jpg', '포항시 미술 축제', '경북에서 열리는 미술 축제에 참여해보세요. 유명 작가들의 작품들과 함께하는 특별한 시간을 보내실 수 있습니다.', '경상북도 포항시 남구 우현로 890', '2024-05-22 07:15:00', '2024-09-05 10:15:00', '김천 (Gimcheon)', '포항', '010-1098-7654', 11000),
(9, 9, 'festivals/11.jpg', '산업 기술 축제', '경북에서 열리는 최신산업 기술을 소개하는 축제에 초대합니다. 혁신적인 기술들과 현대 산업의 흐름을 체험해보세요.', '경상북도 상주시 영남로 345', '2024-05-25 07:30:00', '2024-09-07 12:30:00', '영주 (Yeongju)', '상주', '010-8765-4321', 15000),
(10, 10, 'festivals/12.jpg', '김천 미술 축제', '김천에서 열리는 미술 축제에 참여해보세요. 지역 미술 작품들과 함께하는 특별한 시간을 보내실 수 있습니다.', '경상북도 김천시 예술로 678', '2024-05-28 07:45:00', '2024-09-10 11:45:00', '영천 (Yeongcheon)', '김천', '010-5432-1098', 8000),
(11, 11, 'festivals/3.jpg', '경북 사진 축제', '경북에서 열리는 사진 축제에 초대합니다. 지역 사진작가들의 아름다운 사진과 이야기를 감상해보세요.', '경상북도 구미시 송정로 789', '2024-05-05 07:15:00', '2024-08-13 02:15:00', '상주 (Sangju)', '구미', '010-9876-5432', 12000),
(12, 12, 'festivals/13.jpg', '영천 전통 시장 축제', '영천에서 열리는 전통 시장 축제에 참여해보세요. 다양한 먹거리와 특산품을 즐기며 오래된 전통을 느껴보세요.', '경상북도 영천시 시장로 234', '2024-05-31 08:00:00', '2024-09-13 04:00:00', '문경 (Mungyeong)', '영천', '010-2109-8765', 7000),
(13, 14, 'festivals/2.jpg', '포항 농구 축제', '경북에서 열리는 농구 대회에 참여해보세요. 다양한 연령대와 농구 애호가들이 모여서 열정적인 경기를 펼칩니다.', '경상북도 포항시 북구 중앙로 456', '2024-05-03 07:30:00', '2024-08-15 03:30:00', '김천 (Gimcheon)', '포항', '010-5678-1234', 5000),
(14, 5, 'festivals/14.jpg', '문경 역사 축제', '문경에서 역사를 즐겨보세요. 다양한 문화유적지와 역사적 장소들을 탐방하며 고즈넉한 시간을 보내보세요.', '경상북도 문경시 문화로 123', '2024-06-03 08:30:00', '2024-09-16 01:30:00', '경북 (Gyeongbuk)', '문경', '010-6543-2109', 6000),
(15, 4, 'festivals/15.jpg', '경북 문화 축제', '경북에서 열리는 다양한 문화 축제에 참여해보세요. 전통 음악, 무용, 미술 등 다채로운 프로그램이 준비되어 있습니다.', '경상북도 경주시 문화로 890', '2024-06-07 09:00:00', '2024-09-20 06:00:00', '울진 (Uljin)', '경북', '010-4321-0987', 15000),
(16, 7, 'festivals/9.jpg', '경북 파티', '경북에서 열리는 화려한 파티에 초대합니다. 다양한 음악과 먹거리, 특별한 이벤트로 여러분을 기다립니다.', '경상북도 구미시 장천로 789', '2024-05-20 07:30:00', '2024-09-03 02:30:00', '상주 (Sangju)', '구미', '010-2109-8765', 0),
(17, 14, 'festivals/1720246511127.0.0.1_5500_sub1.html (2) (2) (2) (1).png', '역시도영역', '역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역역시도영역', 'asdasd', '2024-07-05 03:14:00', '2024-07-24 11:14:00', '안동문화재단', '김천 (Gimcheon)', '111-1111-1111', 100000);

-- --------------------------------------------------------

--
-- 테이블 구조 `messageaccept`
--

CREATE TABLE `messageaccept` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `messageaccept`
--

INSERT INTO `messageaccept` (`id`, `uid`, `fid`) VALUES
(8, 13, 5),
(9, 15, 5);

-- --------------------------------------------------------

--
-- 테이블 구조 `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `msgType` text NOT NULL,
  `comment` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `messages`
--

INSERT INTO `messages` (`id`, `uid`, `fid`, `target`, `msgType`, `comment`, `type`, `date`) VALUES
(1, 14, 5, 0, '축제 질문', '에 대한 문의가 왔습니다', 1, '2024-07-07 16:05:27'),
(2, 14, 5, 0, '리뷰', '에 리뷰가 달렸습니다', 1, '2024-07-07 16:08:55'),
(3, 13, 5, 0, '축제 수정', '이/가 수정 되었습니다', 1, '2024-07-07 16:10:08'),
(4, 13, 5, 0, '축제 수정', '이/가 수정 되었습니다', 1, '2024-07-07 16:10:08'),
(5, 13, 5, 0, '축제 수정', '이/가 수정 되었습니다', 1, '2024-07-07 16:10:32'),
(6, 13, 5, 0, '축제 수정', '이/가 수정 되었습니다', 1, '2024-07-07 16:10:32'),
(7, 13, 5, 0, '축제 공지', '에 새로운 공지가 있습니다', 2, '2024-07-07 16:27:28'),
(8, 15, 5, 0, '축제 공지', '에 새로운 공지가 있습니다', 2, '2024-07-07 16:27:28');

-- --------------------------------------------------------

--
-- 테이블 구조 `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`files`)),
  `hit` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `notices`
--

INSERT INTO `notices` (`id`, `uid`, `fid`, `title`, `content`, `files`, `hit`, `date`) VALUES
(1, 14, 5, 'tester', '공지 테스트 입니다.', '[]', 11, '2024-07-07 11:48:16'),
(2, 14, 5, '공지 테스트입니다.', '공지 테스트입니다.', '[\"notices\\/17203267172024년+전국기능경기대회+채점기준_서울.hwp.pdf\",\"notices\\/17203267172024년+전국기능경기대회+과제(전남).hwp.pdf\",\"notices\\/1720326717대전_출제과제(경북그랜드+문화투어)_최종본.hwp.pdf\"]', 11, '2024-07-07 13:31:57'),
(3, 14, 5, '테스트 공지입니다.', '테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.', '[\"notices\\/1720336301htdocs-전남B-스탬프.zip\",\"notices\\/1720336301360-20240630T021801Z-001.zip\",\"notices\\/1720336301360-20240630T021757Z-001.zip\"]', 0, '2024-07-07 16:11:41'),
(4, 14, 5, '테스트 공지입니다.', '테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.', '[\"notices\\/1720336318htdocs-전남B-스탬프.zip\",\"notices\\/1720336318360-20240630T021801Z-001.zip\",\"notices\\/1720336318360-20240630T021757Z-001.zip\"]', 0, '2024-07-07 16:11:58'),
(5, 14, 5, '테스트 공지입니다.', '테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.', '[\"notices\\/1720336435htdocs-전남B-스탬프.zip\",\"notices\\/1720336435360-20240630T021801Z-001.zip\",\"notices\\/1720336435360-20240630T021757Z-001.zip\"]', 2, '2024-07-07 16:13:55'),
(6, 14, 5, '테스트 공지입니다.', '테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.', '[\"notices\\/1720337241htdocs-전남B-스탬프.zip\",\"notices\\/1720337241360-20240630T021801Z-001.zip\",\"notices\\/1720337241360-20240630T021757Z-001.zip\"]', 0, '2024-07-07 16:27:21'),
(7, 14, 5, '테스트 공지입니다.', '테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.테스트 공지입니다.', '[\"notices\\/1720337248htdocs-전남B-스탬프.zip\",\"notices\\/1720337248360-20240630T021801Z-001.zip\",\"notices\\/1720337248360-20240630T021757Z-001.zip\"]', 0, '2024-07-07 16:27:28');

-- --------------------------------------------------------

--
-- 테이블 구조 `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `target` int(11) DEFAULT NULL,
  `type` text NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `questions`
--

INSERT INTO `questions` (`id`, `uid`, `fid`, `target`, `type`, `content`, `date`) VALUES
(1, 13, 1, NULL, 'q', '테스트 질문', '2024-07-05 15:02:57'),
(2, 13, 1, NULL, 'q', '질문 2', '2024-07-05 15:03:13'),
(3, 13, 5, NULL, 'q', '질문 테스트 입니다.', '2024-07-07 09:50:54'),
(4, 14, 5, 3, 'a', '답변 테스트 입니다.', '2024-07-07 10:25:01'),
(5, 13, 5, NULL, 'q', '두번째 질문 테스트 입니다.', '2024-07-07 10:25:24'),
(6, 13, 5, NULL, 'q', '세번째 질문 테스트 입니다.', '2024-07-07 16:04:13'),
(7, 13, 5, NULL, 'q', '세번째 질문 테스트 입니다.', '2024-07-07 16:05:27');

-- --------------------------------------------------------

--
-- 테이블 구조 `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `content` text NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '[]' CHECK (json_valid(`images`)),
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `reviews`
--

INSERT INTO `reviews` (`id`, `uid`, `fid`, `score`, `content`, `images`, `date`) VALUES
(1, 13, 5, 5, 'ㅅㄷㄴㅅㄷㄱ', '[\"reviews\\/1720180656localhost_ (2).png\",\"reviews\\/1720180656barcode (1).png\",\"reviews\\/1720180656127.0.0.1_5500_index.html (5).png\",\"reviews\\/1720180656127.0.0.1_5500_index.html (2) (1).png\"]', '2024-07-05 20:57:36'),
(2, 13, 5, 12, '연습용 입니다.', '[\"reviews\\/1720224980캡처.PNG\",\"reviews\\/1720224980stamp_card (2).png\"]', '2024-07-06 09:16:20'),
(3, 13, 5, 28, 'teser2', '[]', '2024-07-06 11:35:01'),
(4, 13, 5, 4, 'yh', '[\"reviews\\/1720233321캡처.PNG\"]', '2024-07-06 11:35:21'),
(5, 13, 5, 26, '마지막 질문 테스트 입니다.', '[\"reviews\\/1720336035KR_CONTENT_03.png\",\"reviews\\/1720336035stamp_card (2).png\",\"reviews\\/1720336035stamp_card (1).png\",\"reviews\\/1720336035stamp_card.png\"]', '2024-07-07 16:07:15'),
(6, 13, 5, 26, '마지막 질문 테스트 입니다.', '[\"reviews\\/1720336135KR_CONTENT_03.png\",\"reviews\\/1720336135stamp_card (2).png\",\"reviews\\/1720336135stamp_card (1).png\",\"reviews\\/1720336135stamp_card.png\"]', '2024-07-07 16:08:55');

-- --------------------------------------------------------

--
-- 테이블 구조 `ticketbuy`
--

CREATE TABLE `ticketbuy` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `type` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `ticketbuy`
--

INSERT INTO `ticketbuy` (`id`, `uid`, `fid`, `count`, `price`, `type`) VALUES
(1, 13, 5, 6, 60000, 2),
(2, 13, 4, 11, 220000, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userID` text NOT NULL,
  `name` text NOT NULL,
  `pass` text NOT NULL,
  `type` text NOT NULL,
  `company` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `userID`, `name`, `pass`, `type`, `company`) VALUES
(1, 'manager1', '운영자일', 'manager1', '운영자', '안동문화재단'),
(2, 'manager2', '운영자이', 'manager2', '운영자', '경산문화재단'),
(3, 'manager3', '운영자삼', 'manager3', '운영자', '영주문화재단'),
(4, 'manager4', '운영자사', 'manager4', '운영자', '경주문화재단'),
(5, 'manager5', '운영자오', 'manager5', '운영자', '구미문화재단'),
(6, 'manager6', '운영자육', 'manager6', '운영자', '포항문화재단'),
(7, 'manager7', '운영자칠', 'manager7', '운영자', '상주문화재단'),
(8, 'manager8', '운영자팔', 'manager8', '운영자', '김천문화재단'),
(9, 'manager9', '운영자구', 'manager9', '운영자', '영천문화재단'),
(10, 'manager10', '운영자싶', 'manager10', '운영자', '문경문화재단'),
(11, 'manager11', '운영자싶일', 'manager11', '운영자', '경북문화재단'),
(12, 'manager12', '운영자싶이', 'manager12', '운영자', '울진문화재단'),
(13, 'user1234', '김세훈', 'shsh0626', '일반회원', NULL),
(14, 'user1233', '사용자2', 'shsh0626', '운영자', 'tester'),
(15, 'user12345', '테스트', 'qwer1234', '일반회원', NULL);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `festivalgoods`
--
ALTER TABLE `festivalgoods`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `festivals`
--
ALTER TABLE `festivals`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `messageaccept`
--
ALTER TABLE `messageaccept`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `ticketbuy`
--
ALTER TABLE `ticketbuy`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`) USING HASH;

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `festivalgoods`
--
ALTER TABLE `festivalgoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 테이블의 AUTO_INCREMENT `festivals`
--
ALTER TABLE `festivals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `messageaccept`
--
ALTER TABLE `messageaccept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `ticketbuy`
--
ALTER TABLE `ticketbuy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
