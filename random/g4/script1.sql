using bases2;
CREATE TABLE IF NOT EXISTS `bitacora` (
  `usuario` varchar(50) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_bitacora`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristica`
--

CREATE TABLE IF NOT EXISTS `caracteristica` (
  `id_caracteristica` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `valor` varchar(50) DEFAULT NULL,
  `id_servicio` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_caracteristica`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id_comentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contenido` varchar(250) DEFAULT NULL,
  `calificacion` int(1) DEFAULT NULL,
  `id_establecimiento_servicio` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `id_establecimiento_servicio` (`id_establecimiento_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimension`
--

CREATE TABLE IF NOT EXISTS `dimension` (
  `id_dimension` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_dimension`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento`
--

CREATE TABLE IF NOT EXISTS `establecimiento` (
  `id_establecimiento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `longitud` float(6,6) DEFAULT NULL,
  `latitud` float(6,6) DEFAULT NULL,
  `oficial` int(1) NOT NULL,
  `calificacion_general` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_establecimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento_dimension`
--

CREATE TABLE IF NOT EXISTS `establecimiento_dimension` (
  `id_establecimiento` int(10) unsigned NOT NULL DEFAULT '0',
  `id_dimension` int(10) unsigned NOT NULL DEFAULT '0',
  `id_categoria` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_dimension`,`id_establecimiento`),
  KEY `id_establecimiento` (`id_establecimiento`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento_servicio`
--

CREATE TABLE IF NOT EXISTS `establecimiento_servicio` (
  `id_establecimiento_servicio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_establecimiento` int(10) unsigned DEFAULT NULL,
  `id_servicio` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_establecimiento_servicio`),
  KEY `id_servicio` (`id_servicio`),
  KEY `id_establecimiento` (`id_establecimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prereserva`
--

CREATE TABLE IF NOT EXISTS `prereserva` (
  `id_preresrva` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `horayfecha` datetime DEFAULT NULL,
  `cantpersonas` int(11) DEFAULT NULL,
  `id_establecimiento_servicio` int(10) unsigned DEFAULT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_preresrva`),
  KEY `id_establecimiento_servicio` (`id_establecimiento_servicio`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `id_servicio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `id_establecimiento` int(10) unsigned DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_establecimiento` (`id_establecimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD CONSTRAINT `caracteristica_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_establecimiento_servicio`) REFERENCES `establecimiento_servicio` (`id_establecimiento_servicio`);

--
-- Filtros para la tabla `establecimiento_dimension`
--
ALTER TABLE `establecimiento_dimension`
  ADD CONSTRAINT `establecimiento_dimension_ibfk_1` FOREIGN KEY (`id_dimension`) REFERENCES `dimension` (`id_dimension`),
  ADD CONSTRAINT `establecimiento_dimension_ibfk_2` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`),
  ADD CONSTRAINT `establecimiento_dimension_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `establecimiento_servicio`
--
ALTER TABLE `establecimiento_servicio`
  ADD CONSTRAINT `establecimiento_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`),
  ADD CONSTRAINT `establecimiento_servicio_ibfk_2` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`);

--
-- Filtros para la tabla `prereserva`
--
ALTER TABLE `prereserva`
  ADD CONSTRAINT `prereserva_ibfk_1` FOREIGN KEY (`id_establecimiento_servicio`) REFERENCES `establecimiento_servicio` (`id_establecimiento_servicio`),
  ADD CONSTRAINT `prereserva_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
