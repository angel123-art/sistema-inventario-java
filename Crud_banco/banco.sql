-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2025 a las 18:49:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` varchar(15) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `idlogin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `apellido`, `dni`, `telefono`, `idlogin`) VALUES
(11, 'Estevan', 'Espinozaa', '5436723', '902387', NULL),
(12, 'luan', '12345', '00000000', '123456789', 17),
(18, 'Aracely', 'Espinoza', '876543', '90239883', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deposito`
--

CREATE TABLE `deposito` (
  `iddeposito` int(11) NOT NULL,
  `deposito` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `deposito`
--

INSERT INTO `deposito` (`iddeposito`, `deposito`, `fecha`, `idcliente`) VALUES
(15, 2000.00, '2025-02-13 19:37:30', 12),
(16, 1000.00, '2025-02-14 01:45:26', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `idlogin` int(11) NOT NULL,
  `users` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`idlogin`, `users`, `password`) VALUES
(1, 'usuario1', '$2y$10$Xb1PhHpUjk2iFbZHEJ5tA.O1TqErzebheD/FO0M1NEJmHiXGmnpM2'),
(2, 'angel_01', '$2y$10$XyVzmVeEKMuZApxLos/8NO1GAFfY2NfcvYOUGs1VGCJkXlcvsElFS'),
(14, 'Angel', '$2y$10$ee8neSBqsY6VRU.4eeNkDODjCPINV8AwLmW0/a.awOauP8Wa94Kgy'),
(15, 'benito', '$2y$10$s.5rKi92CNwa.EBSzROvNO8EsJ74gP4uoSStTUPaxUS1I4gbq9bXG'),
(16, 'pepe', '$2y$10$Iiisj04qZkQcLPSL0qKp0eQUr5Is7Vbvl6caHBjT.wbCRYoSh7rgq'),
(17, 'luan', '$2y$10$HgePc/IhHE/pR9M6IT/SyOpb8c7xMBnrDCsayS35H32ojhwqA25sC'),
(19, 'Marcos', '$2y$10$72i4/Ako8hN3YwAuxiu/ZufbQDWOIKSKXWdqXYUMrJiYmr7Ymzahy'),
(21, 'maria', '$2y$10$rClDoJiu/uKyXNQO18I3/epYrRIYh.bVhyBayY.qtGlO7ywRfyCge'),
(22, 'Gabriel', '$2y$10$xyhlRKtR5eITHmfSBkMpjOyqOSBMznvbOQmwf2Dkj4zTQquSe4FGq'),
(24, 'Veronica', '$2y$10$j8veun32o1UMsw6/s0Zgq.lk0BuudOR0tmjY5Kdf2QhtcSO.oBjlq'),
(25, 'Aracely', '$2y$10$pGm888GUv7nreVRt2NEk8emypInn5pPZoeC3CwgcMEfw9btomW5Z.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiro`
--

CREATE TABLE `retiro` (
  `idretiro` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `idcliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `retiro`
--

INSERT INTO `retiro` (`idretiro`, `monto`, `fecha`, `idcliente`) VALUES
(16, 1000.00, '2025-02-13 19:37:37', 12),
(17, 500.00, '2025-02-14 01:47:14', 18);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `idlogin` (`idlogin`);

--
-- Indices de la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD PRIMARY KEY (`iddeposito`),
  ADD KEY `deposito_ibfk_1` (`idcliente`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idlogin`),
  ADD UNIQUE KEY `users` (`users`);

--
-- Indices de la tabla `retiro`
--
ALTER TABLE `retiro`
  ADD PRIMARY KEY (`idretiro`),
  ADD KEY `idcliente` (`idcliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `deposito`
--
ALTER TABLE `deposito`
  MODIFY `iddeposito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `idlogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `retiro`
--
ALTER TABLE `retiro`
  MODIFY `idretiro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idlogin`) REFERENCES `login` (`idlogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD CONSTRAINT `deposito_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retiro`
--
ALTER TABLE `retiro`
  ADD CONSTRAINT `retiro_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
