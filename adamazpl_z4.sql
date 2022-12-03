-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 03 Gru 2022, 04:00
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `adamazpl_z4`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `break_ins`
--

CREATE TABLE `break_ins` (
  `id` int(128) UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `ip` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `break_ins`
--

INSERT INTO `break_ins` (`id`, `datetime`, `ip`) VALUES
(1, '2022-12-02 18:21:04', '31.178.135.226'),
(2, '2022-12-02 18:21:18', '31.178.135.226'),
(3, '2022-12-02 18:21:37', '31.178.135.226');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `goscieportalu`
--

CREATE TABLE `goscieportalu` (
  `id` int(1) UNSIGNED NOT NULL,
  `ipaddress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `datetime` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `browser` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `screen` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `window` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `colors` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `cookies` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `java` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `language` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `goscieportalu`
--

INSERT INTO `goscieportalu` (`id`, `ipaddress`, `datetime`, `browser`, `screen`, `window`, `colors`, `cookies`, `java`, `language`) VALUES
(111, '31.178.135.226', '2022-12-02 17:01:16.317698', 'Chrome 107 | Windows 10', '3072x1729', '3072x1729', '24', 'true', 'false', 'pl-PL'),
(112, '31.178.135.226', '2022-12-02 17:08:02.069692', 'Chrome 107 | Windows 10', '3072x1729', '3072x1729', '24', 'true', 'false', 'pl-PL'),
(113, '31.178.135.226', '2022-12-02 20:38:08.461683', 'Chrome 107 | Windows 10', '3072x1729', '3072x1729', '24', 'true', 'false', 'pl-PL'),
(114, '31.178.135.226', '2022-12-03 00:34:06.002015', 'Chrome 107 | Windows 10', '3072x1729', '3072x1729', '24', 'true', 'false', 'pl-PL'),
(115, '31.178.135.226', '2022-12-03 00:36:29.179439', 'Chrome 107 | Windows 10', '3072x1729', '3072x1729', '24', 'true', 'false', 'pl-PL'),
(116, '31.178.135.226', '2022-12-03 01:08:17.363862', 'Chrome 107 | Windows 10', '3072x1729', '3072x1729', '24', 'true', 'false', 'pl-PL'),
(117, '31.178.135.226', '2022-12-03 03:54:54.996164', 'Chrome 107 | Windows 10', '3072x1729', '3072x1729', '24', 'true', 'false', 'pl-PL');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uploads`
--

CREATE TABLE `uploads` (
  `id` int(128) UNSIGNED NOT NULL,
  `user` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `icon` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `realName` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `parent` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `uploads`
--

INSERT INTO `uploads` (`id`, `user`, `icon`, `name`, `realName`, `date`, `deletion`, `parent`) VALUES
(22, 'user1', '<img src=\"media/file.png\" style=\"height: auto; width: 30px;\">', '<a href=\"media/user1/z4 MyCloud 2022-11-01.pdf\">z4 MyCloud 2022-11-01.pdf</a>', 'z4 MyCloud 2022-11-01.pdf', '2022-12-03 03:36:48', '<form method=\"post\" action=\"deleteFile.php\">\n                    <button type=\"submit\">\n                        <img src=\"media/delete.png\" style=\"height: auto; width: 30px;\">\n                    </button>\n                    <input style=\"display: none;\" type=\"text\" name=\"file\" id=\"file\" value=\"z4 MyCloud 2022-11-01.pdf\">\n                </form>', ''),
(23, 'user1', '<audio controls><source src=\"media/user1/ohio.mp3\" type=\"audio/mp3\"><a href=\"media/user1/ohio.mp3\">Download audio</a></audio>', '<a href=\"media/user1/ohio.mp3\">ohio.mp3</a>', 'ohio.mp3', '2022-12-03 03:37:14', '<form method=\"post\" action=\"deleteFile.php\">\n                    <button type=\"submit\">\n                        <img src=\"media/delete.png\" style=\"height: auto; width: 30px;\">\n                    </button>\n                    <input style=\"display: none;\" type=\"text\" name=\"file\" id=\"file\" value=\"ohio.mp3\">\n                </form>', ''),
(25, 'user1', '<img src=\"media/user1/Cat03.jpg\">', '<a href=\"media/user1/Cat03.jpg\">Cat03.jpg</a>', 'Cat03.jpg', '2022-12-03 03:37:57', '<form method=\"post\" action=\"deleteFile.php\">\n                    <button type=\"submit\">\n                        <img src=\"media/delete.png\" style=\"height: auto; width: 30px;\">\n                    </button>\n                    <input style=\"display: none;\" type=\"text\" name=\"file\" id=\"file\" value=\"Cat03.jpg\">\n                </form>', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` smallint(6) NOT NULL,
  `username` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user1', 'pass1'),
(2, 'user2', 'pass2'),
(4, 'adam', 'mazur'),
(9, 'admin', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `break_ins`
--
ALTER TABLE `break_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `goscieportalu`
--
ALTER TABLE `goscieportalu`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `break_ins`
--
ALTER TABLE `break_ins`
  MODIFY `id` int(128) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `goscieportalu`
--
ALTER TABLE `goscieportalu`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT dla tabeli `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(128) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
