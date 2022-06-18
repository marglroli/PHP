-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2020. Máj 05. 17:36
-- Kiszolgáló verziója: 5.5.62-0+deb8u1
-- PHP verzió: 7.1.33-13+0~20200224.34+debian8~1.gbp2471e1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vizsga`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `Hallgatok`
--

CREATE TABLE `Hallgatok` (
  `neptun` char(6) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'Hallgató Neptun kódja',
  `nev` varchar(64) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Hallgató neve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Hallgatók adatai';

--
-- A tábla adatainak kiíratása `Hallgatok`
--

INSERT INTO `Hallgatok` (`neptun`, `nev`) VALUES
('FA2S3D', 'Szalmon Ella'),
('A87654', 'Dil Emma'),
('A7F64H', 'Trab Antal'),
('ABC123', 'Pár Zoltán'),
('ASDFGH', 'Har Mónika'),
('GHGHGH', 'Zsíros B. Ödön'),
('PLKOIJ', 'Bac Ilus'),
('QWE987', 'Pop Simon'),
('QWERTZ', 'Git Áron'),
('YXCVBN', 'Heu Réka');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jelentkezesek`
--

CREATE TABLE `jelentkezesek` (
  `neptun` char(6) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Hallgató Neptun kódja',
  `zh` int(11) NOT NULL COMMENT 'ZH egyedi azonosítója',
  `pontszam` int(11) NOT NULL DEFAULT '-1' COMMENT 'Hallgató pontszáma. Ha -1, akkor még nincs lepontozva.',
  `vizsgazo` char(6) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Vizsgázó Neptun kódja, magyarázatot ld. a feladatlapon!'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='ZH jelentkezések nyilvántartása';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ZHidopontok`
--

CREATE TABLE `ZHidopontok` (
  `id` int(11) NOT NULL COMMENT 'ZH azonosító',
  `idopont` varchar(64) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'ZH meghirdetett időpontja',
  `letszamkorlat` int(3) NOT NULL COMMENT 'ZH létszámkorlátja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='ZH időpontok';

--
-- A tábla adatainak kiíratása `ZHidopontok`
--

INSERT INTO `ZHidopontok` (`id`, `idopont`, `letszamkorlat`) VALUES
(1, '2020. május 15., 13:00', 3),
(2, '2020. május 15., 15:00', 3),
(3, '2020. május 15., 17:00', 4),
(4, '2020. május 15., 19:00', 4);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `Hallgatok`
--
ALTER TABLE `Hallgatok`
  ADD PRIMARY KEY (`neptun`);

--
-- A tábla indexei `jelentkezesek`
--
ALTER TABLE `jelentkezesek`
  ADD PRIMARY KEY (`neptun`,`zh`,`vizsgazo`);

--
-- A tábla indexei `ZHidopontok`
--
ALTER TABLE `ZHidopontok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ZHidopontok`
--
ALTER TABLE `ZHidopontok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ZH azonosító', AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
