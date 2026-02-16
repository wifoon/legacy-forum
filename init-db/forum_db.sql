-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2026 at 09:45 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `ID` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `section` int(11) DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `title`, `description`, `section`, `type`) VALUES
(1, 'Info', 'Nowości i ogłoszenia odnośnie forum', 1, 1),
(2, 'Tutorials', 'Nie jesteś pewien, jak się za coś zabrać? Sprawdź nasze poradniki', 1, 0),
(7, 'HTML', 'Naucz się programowania w przyjaznej atmosferze!', 2, 10),
(8, 'CSS', 'Naucz się programowania w przyjaznej atmosferze!', 2, 11),
(9, 'JavaScript', 'Naucz się programowania w przyjaznej atmosferze!', 2, 12),
(10, 'PHP', 'Naucz się programowania w przyjaznej atmosferze!', 2, 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `description`, `user_id`, `topic_id`, `date`) VALUES
(20, '<p>Hi!</p>', 1, 45, '2024-07-11 12:59:21');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `section`
--

CREATE TABLE `section` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`ID`, `title`) VALUES
(1, 'Informacje'),
(2, 'Programowanie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `topics`
--

CREATE TABLE `topics` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 1,
  `locked` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`ID`, `title`, `description`, `user_id`, `cat_id`, `locked`, `date`) VALUES
(45, 'New', '<p>dziurka</p>', 1, 1, 1, '2024-07-11 12:59:08'),
(46, 'Tutorial', '<p>How to create simple website in html?</p>', 1, 7, 0, '2024-07-11 12:59:53');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL DEFAULT 'Użytkownik',
  `pfp` varchar(255) NOT NULL DEFAULT 'default.png',
  `ban` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `rank`, `pfp`, `ban`) VALUES
(1, 'wifon', '81dc9bdb52d04dc20036dbd8313ed055', 'igorka05@interia.pl', 'Administrator', 'IMG-64051736ce5250.60075118.png', 0),
(2, 'bula', '202cb962ac59075b964b07152d234b70', 'igorkaa@interia.pl', 'Użytkownik', 'IMG-64077bd4d32f80.50970618.png', 0),
(3, 'mati', '202cb962ac59075b964b07152d234b70', 'igorka05@wp.pl', 'Użytkownik', 'IMG-6408da61323586.96521204.jpeg', 0),
(4, 'tofik', '202cb962ac59075b964b07152d234b70', 'wifon05@interia.pl', 'Użytkownik', 'IMG-64091147f25303.91459649.jpg', 1),
(5, 'major', '202cb962ac59075b964b07152d234b70', 'major@gmail.com', 'Użytkownik', 'IMG-640b6796b32379.95703431.jpeg', 1),
(7, 'dziurka', '202cb962ac59075b964b07152d234b70', 'dziura@ogur.pl', 'Użytkownik', 'default.png', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
