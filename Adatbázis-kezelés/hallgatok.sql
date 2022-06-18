-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2017. Ápr 05. 08:44
-- Kiszolgáló verziója: 5.5.54-0+deb8u1
-- PHP verzió: 7.0.15-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hallgatok`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hallgatok`
--

CREATE TABLE `hallgatok` (
  `neptun` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `nev` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `szuldatum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `hallgatok`
--
ALTER TABLE `hallgatok`
  ADD PRIMARY KEY (`neptun`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
