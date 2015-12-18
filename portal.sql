SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `portal` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `portal`;

CREATE TABLE IF NOT EXISTS `noticies` (
  `codin` bigint(20) NOT NULL AUTO_INCREMENT,
  `titol` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` date NOT NULL,
  `descripcio` varchar(255) COLLATE utf8_bin NOT NULL,
  `tipus` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`codin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

CREATE TABLE IF NOT EXISTS `usuaris` (
  `nick` varchar(25) COLLATE utf8_bin NOT NULL,
  `nomcognoms` varchar(100) COLLATE utf8_bin NOT NULL,
  `contrasenya` varchar(100) COLLATE utf8_bin NOT NULL,
  `mail` varchar(50) COLLATE utf8_bin NOT NULL,
  `edat` int(3) NOT NULL,
  `nivell` varchar(10) COLLATE utf8_bin NOT NULL,
  `codie` int(10) NOT NULL,
  PRIMARY KEY (`nick`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
