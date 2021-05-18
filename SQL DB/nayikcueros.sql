-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2021 a las 14:40:18
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nayikcueros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(5, 'Bolsos'),
(6, 'Carteras'),
(7, 'Mochilas'),
(8, 'Camperas'),
(9, 'Sacos'),
(10, 'Billeteras'),
(11, 'Cintos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(30) NOT NULL,
  `dni_cliente` bigint(11) NOT NULL,
  `email_cliente` varchar(45) NOT NULL,
  `telefono_cliente` bigint(12) NOT NULL,
  `direccion_cliente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `dni_cliente`, `email_cliente`, `telefono_cliente`, `direccion_cliente`) VALUES
(23, 'Belen Gonzalez', 38596832, 'belen@hotmail.com', 3415123456, 'Paraguay 565'),
(24, 'Alan Ruiz', 22889376, 'alan.r@hotmail.com', 3415899553, 'Pj. Alvarez 1520'),
(30, 'Juan Perez', 35754852, 'juan.perez@hotmail.com', 3415462966, 'Mendoza 254'),
(35, 'Agustin Aguilar', 29854562, 'agustin@hotmail.com', 3412741258, 'Dorrego 854'),
(36, 'Alan Perez', 38456741, 'alan@hotmail.com', 3416852147, 'Italia 1535'),
(41, 'Juan Lorenzo Perez', 15963268, 'juan.l.perez@gmail.com', 3415695862, 'Dorrego 251'),
(44, 'Kevin Bredelis', 37831927, 'b.kevin@hotmail.es', 3415462966, 'Paraguay 344 '),
(46, 'Marcela Botta', 37831929, 'marcela@hotmail.com', 3415456789, 'Paraguay 123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `total_compra` varchar(15) NOT NULL,
  `vendedor_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `fecha_compra`, `total_compra`, `vendedor_id`, `proveedor_id`) VALUES
(174, '2021-04-20', '5000', 3, 2),
(175, '2021-04-21', '850', 3, 3),
(176, '2021-04-20', '12500', 3, 5),
(177, '2021-04-22', '2350', 3, 7),
(178, '2021-04-14', '550', 3, 6),
(179, '2021-04-21', '7000', 5, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_mp`
--

CREATE TABLE `compra_mp` (
  `id_compra_mp` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `materiaprima_id` int(11) NOT NULL,
  `cantidad_mp` int(11) NOT NULL,
  `precio_mp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra_mp`
--

INSERT INTO `compra_mp` (`id_compra_mp`, `compra_id`, `materiaprima_id`, `cantidad_mp`, `precio_mp`) VALUES
(164, 174, 76, 1, '2500'),
(165, 174, 73, 1, '2500'),
(166, 175, 83, 1, '850'),
(167, 176, 85, 5, '12500'),
(168, 177, 79, 2, '1650'),
(169, 177, 81, 1, '350'),
(170, 177, 82, 1, '350'),
(171, 178, 75, 1, '550'),
(172, 179, 87, 1, '2000'),
(173, 179, 88, 12, '5000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `nombre` varchar(25) NOT NULL,
  `razon_social` varchar(25) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasprimas`
--

CREATE TABLE `materiasprimas` (
  `id_materiaprima` int(11) NOT NULL,
  `nombre_materiaprima` varchar(30) NOT NULL,
  `existencia_materiaprima` varchar(15) NOT NULL,
  `medicion_materiaprima` varchar(25) NOT NULL,
  `id_prov_mp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materiasprimas`
--

INSERT INTO `materiasprimas` (`id_materiaprima`, `nombre_materiaprima`, `existencia_materiaprima`, `medicion_materiaprima`, `id_prov_mp`) VALUES
(73, 'Cuero Rojo', '1', 'Metros', 2),
(75, 'Bobina de Hilo', '1', 'Rollo', 6),
(76, 'Cuero Blanco', '1', 'Metros', 2),
(78, 'Parches', '15', 'x10 u', 12),
(79, 'Tela Negra', '2', 'Metros', 7),
(81, 'Hilo Blanco', '1', 'x 10u', 7),
(82, 'Hilo Rojo', '1', 'x 10u', 7),
(83, 'Tela Blanca', '1', 'Metros', 3),
(85, 'Cuero Teñido', '5', 'Rollo', 5),
(87, 'Cuero', '11', 'Metros', 13),
(88, 'Hilo', '22', 'x10u', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mp_por_prov`
--

CREATE TABLE `mp_por_prov` (
  `id_mp_prov` int(11) NOT NULL,
  `id_mp_pv` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mp_por_prov`
--

INSERT INTO `mp_por_prov` (`id_mp_prov`, `id_mp_pv`, `id_prov`) VALUES
(17, 73, 2),
(19, 75, 6),
(20, 76, 2),
(23, 79, 7),
(25, 81, 7),
(26, 82, 7),
(27, 83, 3),
(29, 85, 5),
(31, 87, 13),
(32, 88, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `sku_producto` varchar(10) NOT NULL,
  `nombre_producto` varchar(30) NOT NULL,
  `tipo_producto` int(15) NOT NULL,
  `precio_producto` varchar(15) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock_producto` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`sku_producto`, `nombre_producto`, `tipo_producto`, `precio_producto`, `id_producto`, `stock_producto`) VALUES
('525', 'Harlem', 8, '2500', 65, 0),
('582', 'London', 6, '3500', 68, 0),
('230', 'Lithium', 6, '2200', 83, 0),
('783', 'Power', 6, '2300', 84, 3),
('796', 'Plain', 7, '2300', 85, 4),
('178', 'Scoff', 6, '2300', 86, 0),
('348', 'Imagine', 8, '14000', 87, 0),
('256', 'Pride', 8, '14000', 88, 0),
('965', 'Stay', 8, '14000', 89, 0),
('346', 'Envolved', 9, '16000', 90, 2),
('145', 'Reputation', 9, '16000', 91, 7),
('159', 'Mermaid', 10, '1500', 93, 4),
('123', 'visa', 8, '10000', 94, 2),
('124', 'cabal', 8, '10000', 95, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(15) NOT NULL,
  `nombre_proveedor` varchar(20) NOT NULL,
  `telefono_proveedor` varchar(15) NOT NULL,
  `direccion_proveedor` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `telefono_proveedor`, `direccion_proveedor`) VALUES
(2, 'Rosario Cueros', '3414448855', 'Riobamba 1494'),
(3, 'Sederia Lafayette', '3414253150', 'San Luis 1760'),
(5, 'MIACITTA', ' 3412368853', 'Rioja 2040'),
(6, 'París Tejidos', '3414211176', 'España 1029'),
(7, 'Polibot', '3414218272', 'San Luis 1617'),
(13, 'Dante', '341512345', 'Salta 2585');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(10) NOT NULL,
  `nombre_rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `pass_usuario` varchar(20) NOT NULL,
  `usuario_email` varchar(25) NOT NULL,
  `telUsuario` varchar(12) NOT NULL,
  `rol_usuario` int(12) NOT NULL,
  `usuario_nomyape` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `pass_usuario`, `usuario_email`, `telUsuario`, `rol_usuario`, `usuario_nomyape`) VALUES
(3, 'alejandra', '12345', 'alejandra@hotmail.com', '3415462966', 1, 'Alejandra Passera'),
(5, 'kevin', '37831927k', 'b.kevin@hotmail.es', '3415462966', 1, 'Kevin Bredelis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_cliente_venta` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `total_venta` float NOT NULL,
  `fecha_venta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente_venta`, `id_vendedor`, `total_venta`, `fecha_venta`) VALUES
(131, 35, 5, 12000, '2021-01-27 13:53:14'),
(132, 23, 5, 3500, '2021-02-27 13:53:31'),
(135, 35, 5, 10500, '2021-02-27 13:55:50'),
(136, 24, 5, 5000, '2021-01-27 13:56:49'),
(137, 36, 5, 7000, '2021-03-27 13:57:23'),
(138, 41, 5, 14000, '2021-04-27 13:59:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_venta_producto` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_producto` varchar(15) NOT NULL,
  `precio_producto_venta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id_venta_producto`, `producto_id`, `cantidad_producto`, `precio_producto_venta`) VALUES
(131, 90, '1', '16000'),
(132, 68, '1', '3500'),
(135, 87, '1', '14000'),
(136, 65, '2', '5000'),
(137, 93, '5', '7500'),
(138, 93, '1', '1500'),
(138, 85, '1', '2300'),
(138, 84, '1', '2300'),
(138, 91, '1', '16000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `vendedor_id` (`vendedor_id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `compra_mp`
--
ALTER TABLE `compra_mp`
  ADD PRIMARY KEY (`id_compra_mp`),
  ADD KEY `materiaprima_id` (`materiaprima_id`),
  ADD KEY `compra_id` (`compra_id`);

--
-- Indices de la tabla `materiasprimas`
--
ALTER TABLE `materiasprimas`
  ADD PRIMARY KEY (`id_materiaprima`),
  ADD KEY `id_prov_mp` (`id_prov_mp`);

--
-- Indices de la tabla `mp_por_prov`
--
ALTER TABLE `mp_por_prov`
  ADD PRIMARY KEY (`id_mp_prov`),
  ADD KEY `id_prov` (`id_mp_pv`),
  ADD KEY `id_mp` (`id_prov`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `sku_producto` (`sku_producto`),
  ADD KEY `tipo_producto` (`tipo_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `nombreProveedor` (`nombre_proveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`),
  ADD KEY `nombreRol` (`nombre_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `rol_usuario` (`rol_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente_venta`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `id_venta_producto` (`id_venta_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de la tabla `compra_mp`
--
ALTER TABLE `compra_mp`
  MODIFY `id_compra_mp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de la tabla `materiasprimas`
--
ALTER TABLE `materiasprimas`
  MODIFY `id_materiaprima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `mp_por_prov`
--
ALTER TABLE `mp_por_prov`
  MODIFY `id_mp_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`vendedor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra_mp`
--
ALTER TABLE `compra_mp`
  ADD CONSTRAINT `compra_mp_ibfk_3` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id_compra`),
  ADD CONSTRAINT `compra_mp_ibfk_4` FOREIGN KEY (`materiaprima_id`) REFERENCES `materiasprimas` (`id_materiaprima`);

--
-- Filtros para la tabla `mp_por_prov`
--
ALTER TABLE `mp_por_prov`
  ADD CONSTRAINT `mp_por_prov_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mp_por_prov_ibfk_2` FOREIGN KEY (`id_mp_pv`) REFERENCES `materiasprimas` (`id_materiaprima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`tipo_producto`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_usuario`) REFERENCES `roles` (`idRol`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_4` FOREIGN KEY (`id_cliente_venta`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY (`id_venta_producto`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
