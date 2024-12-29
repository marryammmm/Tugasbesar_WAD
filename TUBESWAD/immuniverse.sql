-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2024 at 02:24 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `immuniverse`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `video_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `summary`, `image_url`, `video_url`) VALUES
(5, 'Spirited Away', 'Film dari Ghibli', 'uploads/Night Train.jpg', 'https://www.youtube.com/watch?v=oswhW2fcDOY'),
(12, 'Mengatasi penyakit maag (Gerd)', 'Minum omeprazol 30 menit sebelum makan, makan yang teratur, kurangi stress, istirahat yang cukup', 'uploads/maag.jpg', 'https://www.youtube.com/watch?v=LNMFds-cCJ0');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_responses`
--

CREATE TABLE `chatbot_responses` (
  `id` int NOT NULL,
  `stage` varchar(255) NOT NULL,
  `user_input` varchar(255) NOT NULL,
  `bot_response` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chatbot_responses`
--

INSERT INTO `chatbot_responses` (`id`, `stage`, `user_input`, `bot_response`, `created_at`) VALUES
(2, 'greeting', 'Hai', 'Hallo, beritahu ke aku keluhan mu apa sajaa :D', '2024-12-25 10:11:05'),
(3, 'greeting', 'Hallo, aku punya beberapa keluhan', 'Hallo, beritahu ke aku keluhan mu apa sajaa :D', '2024-12-25 10:11:41'),
(4, 'greeting', 'Hallo', 'Hallo, beritahu ke aku keluhan mu apa sajaa :D', '2024-12-25 10:12:03'),
(5, 'greeting', 'Hai, aku punya beberapa keluhan', 'Hallo, beritahu ke aku keluhan mu apa sajaa :D', '2024-12-25 10:12:20'),
(6, 'greeting', 'Aku sakit', 'Beritahu ke aku keluhan mu apa sajaa :D', '2024-12-25 10:12:41'),
(7, 'check_health', 'Sakit Kepala', 'Istirahat yang cukup, Makan yang teratur, kurangi intensitas dengan gadget', '2024-12-25 10:58:31'),
(8, 'check_health', 'Mual', 'Minum obat yang sudah diresepkan oleh dokter, makan yang teratur serta istirahat yang cukup', '2024-12-25 10:59:12'),
(9, 'check_health', 'Demam', 'Istirahat yang cukup, minum obat paracetamol, makan yang teratur', '2024-12-25 14:12:53'),
(10, 'closing', 'Tidak ada keluhan', 'Terima kasih sudah menggunakan immuniverse bot, Have a Nice day!', '2024-12-25 14:34:10'),
(11, 'closing', 'Sudah cukup', 'Terima kasih sudah menggunakan immuniverse bot, Have a Nice day!', '2024-12-25 14:34:27'),
(12, 'closing', 'Nggak kenapa - kenapa', 'Terima kasih sudah menggunakan immuniverse bot, Have a Nice day!', '2024-12-25 14:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int NOT NULL,
  `user_input` text NOT NULL,
  `bot_response` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_input`, `bot_response`, `create_at`) VALUES
(1, 'halo', 'Hallo Immunitezen! :) Apa yang kamu rasakan hari ini? (sakit/sehat)', '2024-12-25 09:46:02'),
(2, 'iya', 'Mohon jawab dengan \'sakit\' atau \'sehat\'.', '2024-12-25 09:47:31'),
(3, 'hello', 'Mohon jawab dengan \'sakit\' atau \'sehat\'.', '2024-12-25 09:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int NOT NULL,
  `dokter_id` int NOT NULL,
  `jadwal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot_responses`
--
ALTER TABLE `chatbot_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chatbot_responses`
--
ALTER TABLE `chatbot_responses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
