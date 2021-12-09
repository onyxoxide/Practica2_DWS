
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdpractica2php`
--
CREATE DATABASE IF NOT EXISTS `bdpractica2php` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `bdpractica2php`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ninos`
--

CREATE TABLE `ninos` (
  `idNino` int(11) NOT NULL,
  `nombreNino` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidosNino` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechaNacimientoNino` date NOT NULL,
  `buenoNino` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ninos`
--

INSERT INTO `ninos` (`idNino`, `nombreNino`, `apellidosNino`, `fechaNacimientoNino`, `buenoNino`) VALUES
(1, 'Alberto', 'Alcántara', '1994-10-13', 0),
(2, 'Beatriz', 'Bueno', '1982-04-18', 1),
(3, 'Carlos', 'Crepo', '1998-12-01', 1),
(4, 'Diana', 'Domínguez', '1987-09-02', 0),
(5, 'Emilio', 'Enamorado', '1996-08-12', 1),
(6, 'Francisca', 'Fernández', '1990-07-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piden`
--

CREATE TABLE `piden` (
  `idPedido` int(11) NOT NULL,
  `idNinoFK` int(11) NOT NULL,
  `idRegaloFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `piden`
--

INSERT INTO `piden` (`idPedido`, `idNinoFK`, `idRegaloFK`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 6),
(4, 2, 9),
(5, 3, 3),
(6, 3, 4),
(7, 3, 13),
(8, 4, 2),
(9, 5, 5),
(10, 5, 7),
(11, 5, 10),
(12, 6, 8),
(13, 6, 11),
(14, 6, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalos`
--

CREATE TABLE `regalos` (
  `idRegalo` int(11) NOT NULL,
  `nombreRegalo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precioRegalo` decimal(5,2) NOT NULL,
  `idReyMagoFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `regalos`
--

INSERT INTO `regalos` (`idRegalo`, `nombreRegalo`, `precioRegalo`, `idReyMagoFK`) VALUES
(1, 'Aula de ciencia: Robot Mini ERP', '159.95', 2),
(2, 'Carbón', '0.00', 1),
(3, 'Cochecito Classic', '99.95', 1),
(4, 'Consola PS4 1 TB', '349.90', 1),
(5, 'Lego Villa familiar modular', '64.99', 2),
(6, 'Magia Borrás Clásica 150 trucos con luz', '32.95', 2),
(7, 'Meccano Excavadora construcción', '30.99', 3),
(8, 'Nenuco Hace pompas', '29.95', 3),
(9, 'Peluche delfín rosa', '34.00', 3),
(10, 'Pequeordenador', '22.95', 1),
(11, 'Robot Coji', '69.95', 2),
(12, 'Telescopio astronómico terrestre', '72.00', 2),
(13, 'Twister', '17.95', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reymago`
--

CREATE TABLE `reymago` (
  `idReyMago` int(11) NOT NULL,
  `nombreReyMago` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reymago`
--

INSERT INTO `reymago` (`idReyMago`, `nombreReyMago`) VALUES
(1, 'Melchor'),
(2, 'Gaspar'),
(3, 'Baltasar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD PRIMARY KEY (`idNino`);

--
-- Indices de la tabla `piden`
--
ALTER TABLE `piden`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idRegaloFK3` (`idRegaloFK`),
  ADD KEY `idNinoFK2` (`idNinoFK`) USING BTREE;

--
-- Indices de la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD PRIMARY KEY (`idRegalo`),
  ADD KEY `idReyMagoFK1` (`idReyMagoFK`);

--
-- Indices de la tabla `reymago`
--
ALTER TABLE `reymago`
  ADD PRIMARY KEY (`idReyMago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ninos`
--
ALTER TABLE `ninos`
  MODIFY `idNino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `piden`
--
ALTER TABLE `piden`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `regalos`
--
ALTER TABLE `regalos`
  MODIFY `idRegalo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `reymago`
--
ALTER TABLE `reymago`
  MODIFY `idReyMago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `piden`
--
ALTER TABLE `piden`
  ADD CONSTRAINT `idRegaloFK3` FOREIGN KEY (`idRegaloFK`) REFERENCES `regalos` (`idRegalo`);

--
-- Filtros para la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD CONSTRAINT `idReyMagoFK1` FOREIGN KEY (`idReyMagoFK`) REFERENCES `reymago` (`idReyMago`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
