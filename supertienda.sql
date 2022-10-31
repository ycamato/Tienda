-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2022 a las 05:02:09
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `supertienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `doc_cliente` int(11) NOT NULL,
  `nom_cliente` varchar(30) DEFAULT NULL,
  `apel_cliente` varchar(30) DEFAULT NULL,
  `telefono` bigint(10) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`doc_cliente`, `nom_cliente`, `apel_cliente`, `telefono`, `direccion`) VALUES
(212, 'Camila', 'Peña', 23332, 'calle 2'),
(355, 'Isa', 'Gonzales', 322, 'calle 8'),
(445, 'Samir', 'Castañeda', 4433, 'calle 90'),
(2332, 'Juan', 'Giraldo', 445332, 'calle 30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `detalle` int(12) NOT NULL,
  `id_factura` int(12) NOT NULL,
  `cod_producto` int(12) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_comple` int(10) NOT NULL,
  `doc_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`detalle`, `id_factura`, `cod_producto`, `cantidad`, `precio_comple`, `doc_user`) VALUES
(94, 91, 4, 3, 4200, 555),
(95, 91, 3, 6, 8400, 555),
(96, 91, 2, 3, 900, 333),
(97, 91, 1, 4, 8000, 333),
(101, 92, 4, 3, 4200, 555),
(102, 92, 3, 6, 8400, 555),
(103, 92, 3, 6, 8400, 555),
(104, 93, 4, 5, 7000, 212),
(105, 94, 2, 2, 600, 212),
(106, 94, 3, 2, 2800, 339),
(107, 94, 1, 1, 2000, 212),
(108, 94, 5, 2, 9000, 339),
(112, 95, 3, 3, 4200, 339),
(113, 96, 3, 2, 2800, 339),
(114, 97, 3, 5, 10000, 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_est` int(5) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_est`, `nombre`) VALUES
(1, 'Facturado'),
(2, 'Anulado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `fecha` date DEFAULT current_timestamp(),
  `doc_cliente` int(11) DEFAULT NULL,
  `doc_user` int(11) DEFAULT NULL,
  `id_est` int(5) NOT NULL,
  `valor_total` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `fecha`, `doc_cliente`, `doc_user`, `id_est`, `valor_total`) VALUES
(97, '2022-07-26', 212, 66, 2, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod_producto` int(11) NOT NULL,
  `nit_proveedor` int(11) NOT NULL,
  `nom_prod` varchar(30) NOT NULL,
  `existencia` int(3) NOT NULL,
  `precio` int(5) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod_producto`, `nit_proveedor`, `nom_prod`, `existencia`, `precio`, `fecha`) VALUES
(1, 333, 'Lentejas', 450, 1500, '2022-07-26'),
(2, 444, 'Frijol', 580, 2000, '2022-07-26'),
(3, 333, 'Arveja', 450, 2000, '2022-07-26'),
(4, 3030, 'Arroz', 450, 1800, '2022-07-26'),
(5, 3453, 'Azucar', 450, 1600, '2022-07-26'),
(6, 3453, 'Avena', 450, 1700, '2022-07-26'),
(7, 5550, 'Colgate', 450, 1800, '2022-07-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `nit_proveedor` int(11) NOT NULL,
  `nom_proveedor` varchar(30) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provedor`
--

INSERT INTO `provedor` (`nit_proveedor`, `nom_proveedor`, `telefono`, `direccion`) VALUES
(333, 'isabela', '3113', 'IBAGUE'),
(444, 'Alejandra', '8880', 'Fusa'),
(3030, 'Samir', '7770', 'Barrio el  porvenir 3'),
(3453, 'gustavo', '56565', 'providencia'),
(5550, 'Karen', '4555', 'Barrio  cogedera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE `temporal` (
  `detalle` int(12) NOT NULL,
  `id_factura` int(12) DEFAULT NULL,
  `cod_producto` int(12) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_comple` int(10) NOT NULL,
  `doc_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `rol` int(2) NOT NULL,
  `rol_nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`rol`, `rol_nom`) VALUES
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Auditor'),
(4, 'Bodeguero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `doc_user` int(11) NOT NULL,
  `nom_user` varchar(30) DEFAULT NULL,
  `rol` int(2) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `contraseña` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`doc_user`, `nom_user`, `rol`, `correo`, `contraseña`) VALUES
(55, 'Camila', 3, 'Camila@hotmail.co', '$2y$12$tYhs4zoKJHaHcBK8Aya0xumc69AP7rDNSPA6yvYTrZhHs0MsskcYu'),
(66, 'Karol', 2, 'Karol@hotmail.com', '$2y$12$1VwsHM9QfAZ1.DuS6644OOISJP.gaOdYoaMNo2oEYJgFS4KI6Id9G'),
(88, 'Arturo', 4, 'Arturo@hotmail.com', '$2y$12$nrxLQbc7Qlhf1yyEOlH/eucoNVD4FNV748oFYVC8jKdRvR1D49iym'),
(212, 'Lucia', 2, 'Lucia@hotmail.com', '$2y$12$gRCLCn/LYMzyITtqQ230quIvLnZ.rpGvuGVdJDQ3LbzGNzYnIUKtm'),
(280, 'Dany', 3, 'Dany@hotmail.com', '$2y$12$o./EzwOfPF6Avy6bNEC8Mub82V7veNfZ5OZ6TSl/uWEdeoiUDWVIa'),
(441, 'Santiago', 1, 'Santi@gmail.com', '$2y$12$iuxhNPTgvlWTVyGzFln/7e6BTt6OrOav5o3MOkQiLDVkWmp3Cc0Mu'),
(444, 'Miguel', 1, 'Miguel@hotmail.com', '$2y$12$r5iDoD2tAWCvsOEFsYWtk.QgXtkqk4XhWjp3yuEAKSB9LlYybuMjK'),
(561, 'Nicol', 3, 'Nicol@hotmail.co', '$2y$12$hbGlxz58x3nrPkJrxl9U9OpoERwGbpZuCl4oL7Zz96NK4fG4mbT8C'),
(666, 'Paula', 1, 'Paula@gmail.com', '$2y$12$zcDyKJszZf5.nbn/BCP.9udErJga74zrce1ED/oYsPOjCh2118yJ.'),
(707, 'Fabian', 1, 'Fabian@hotmail.com', '$2y$12$.Bh.H1lofS/9DIbL/lHIwu1RNpMCMZxQU6bkbPuSVJROWpnnEVDji'),
(747, 'Julian', 2, 'Julian@hotmail.com', '$2y$12$BNNUMHcg2/W099CLDS0UVuOWnKJpLh0x6NAbYau6s0XCpsb9OiKs6'),
(878, 'Diana', 1, 'Diana@hotmail.com', '$2y$12$y057KiIE/F5xDUCHT.4mr.e8cYFmvRxj1.5ySlulsPYaIOmfNgSj2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`doc_cliente`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`detalle`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `doc_cliente` (`doc_cliente`,`doc_user`),
  ADD KEY `factura_ibfk_1` (`doc_user`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod_producto`),
  ADD KEY `nit_proveedor` (`nit_proveedor`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`nit_proveedor`);

--
-- Indices de la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD PRIMARY KEY (`detalle`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`doc_user`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `detalle` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `temporal`
--
ALTER TABLE `temporal`
  MODIFY `detalle` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`doc_user`) REFERENCES `usuario` (`doc_user`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`doc_cliente`) REFERENCES `cliente` (`doc_cliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`nit_proveedor`) REFERENCES `provedor` (`nit_proveedor`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `tipo` (`rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
