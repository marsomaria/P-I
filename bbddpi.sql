-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2020 a las 11:07:12
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
/**/SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pibd`
--
-- DROP DATABASE IF EXISTS `pibs`; /* eliminamos database pibs si existe*/
DROP DATABASE IF EXISTS `pibd`; /* eliminamos database pibd si existe*/
CREATE DATABASE IF NOT EXISTS `pibd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; /*creamos database pibd si no existe*/
USE `pibd`; /* la utilizamos*/

/*GRANT ALL PRIVILEGES ON pibd.* to 'daw'@127.0.0.1 identified by 'daw'; damos privilegios al usuario daw */
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--
DROP TABLE IF EXISTS `albumes`;
CREATE TABLE `albumes` (
  `IdAlbum` int(11) NOT NULL,
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes`(`IdAlbum`,`Titulo`,`Descripcion`,`Usuario`) VALUES
(1, 'Excursiones', 'Fotos de mis excursiones por las montañas del norte de España', '1'),
(2, 'Agua' , 'Imágenes de mis aventuras con los peces', '2'),
(3, 'Friend', 'Imágenes alucinantes de nuestra vida', '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--
DROP TABLE IF EXISTS `estilos`;
CREATE TABLE `estilos` (
  `IdEstilos` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Fichero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos`(`IdEstilos`, `Nombre`,`Descripcion`, `Fichero`) VALUES
(1, 'movil', 'caracteristicas para la version movil', 'movil.css'),
(2, 'tablet', 'caracteristicas para la version tablet', 'tablet.css'),
(3, 'ordenador','caracteristicas para la version ordenador','ordenador.css'),
(4, 'altoContraste', 'Estilo con colores bien diferenciados', 'altoContraste.css'),
(5, 'Contraste mas letra', 'Estilo con colores bien diferenciados y letras grandes', 'contrasteMasLetra.css'),
(6, 'Base', 'Estilo original de la pagina web P&I', 'estilo.css'),
(7, 'Letra grande', 'Estilo base de la web con letras grandes', 'letraGrande.css'),
(8, 'Oscuro', 'Estilo base de la web en tonos y colores oscuros', 'oscuro.css'),
(9, 'Imprime', 'Estilo visual para ver como quedaria la version imprimible de la web', 'v_imprimir.css');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--
DROP TABLE IF EXISTS `fotos`;
CREATE TABLE `fotos` (
  `IdFoto` int(11) NOT NULL,
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Pais` int(11) DEFAULT NULL,
  `Album` int(11) NOT NULL,
  `Fichero` text NOT NULL,
  `Alternativo` text DEFAULT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos`(`IdFoto`, `Titulo`,`Descripcion`, `Fecha`,`Pais`,`Album`, `Fichero`,`Alternativo`,`FRegistro` ) VALUES
(1, 'Montañas verdes', 'Montañicas del Norte que vi en Agosto', '2010-06-23',1,1,'montañas.jpg','foto montañas Francia', '2020-10-01 10:34:09 '),
(2, 'Buceando', 'De cuando bucee en el Caribe con pececillos', '2019-07-31', 3, 2,'buceo.jpg', 'foto buceando en el mar', '2020-08-10 11:29:03 '),
(3, 'Viajar a lo desconocido', 'Vistas desde el techo del tren sin fin', '2005-11-13',6,1,'tren.jpg','foto tren niebla', '2020-09-01 14:44:09 '),
(4, 'La gran aurora', 'Vistas desde el glaciar de noche', '2019-10-03',5,1,'glaciar.jpg','foto aurora boreal', '2020-11-11 17:24:09 '),
(5, 'Vistas perfectas', 'Recuerdo de nuestra ruta de Galicia', '2018-12-23',2,3,'amigos.jpg','foto amigos en la montaña', '2020-12-01 04:14:09 '),
(6, 'Nieve y montaña', 'Recuerdo repes de nuestra ruta de Galicia', '2019-12-23',1,3,'amigos2.jpg','foto amigos en la montaña', '2010-12-01 04:14:09 '),
(7, 'Cerdito nadador', 'De cuando un bañista inesperado me sorprendio en el agua', '2019-08-31', 10, 2,'playa.jpg', 'Cerdito en el mar', '2020-098-02 15:19:13 ');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--
DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL ,
  `NomPais` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--
INSERT INTO `paises`(`IdPais`, `NomPais`) VALUES
(0,'_'),
(1, 'Francia'),
(2, 'España'),
(3, 'Portugal'),
(4, 'República Checa'),
(5, 'EEUU'),
(6, 'Dinamarca'),
(7, 'Alemania'),
(8,	'Andorra'),
(9, 'Eslovenia'),
(10, 'Finlandia'),
(11, 'India');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--
DROP TABLE IF EXISTS `solicitudes`;
CREATE TABLE `solicitudes` (
  `IdSolicitud` int(11) NOT NULL,
  `Album` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Apellidos` varchar(200) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Descripcion` varchar(4000) DEFAULT NULL,
  `Email` varchar(200) NOT NULL,
  `Direccion` text NOT NULL,
  `Color` text NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Coste` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes`
--
INSERT INTO `solicitudes`(`IdSolicitud`, `Album`, `Nombre`, `Apellidos`, `Titulo`, `Descripcion`, `Email`, `Direccion`, `Color`, `Copias`, `Resolucion`, `Fecha`,`IColor`, `FRegistro`, `Coste`) VALUES
(1,2,'Maria','Marti', 'Agua', 'Aventuras en el Agua', 'mm@ua.es', 'calle peru 1, puerta 5', '#fffa', 1, 300, '2020-12-12', 0, '2020-12-01 13:54:09', 10.56 );

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL ,
  `NomUsuario` varchar(15) NOT NULL,
  `Clave` varchar(20) NOT NULL,
  `Email` text NOT NULL,
  `Sexo` smallint(6) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` text NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` text NOT NULL,
  `FRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO `usuarios`(`IdUsuario`,`NomUsuario`, `Clave`,`Email`, `Sexo`,`FNacimiento`,`Ciudad`,`Pais`, `Foto`,`FRegistro`,`Estilo`) VALUES
(1, 'usu1', TO_BASE64('usuario1'),'usuario1@ua.es',1, '1990-10-11', 'Pamplona',2, 'usu1.png','2020-02-20 09:32:08 ', '6'),
(2, 'usu2', TO_BASE64('usuario2'),'usuario2@ua.es',1, '1990-05-16', 'Paris',1, 'usu2.png','2020-05-21 03:42:08 ', '9'),
(3, 'usu3', TO_BASE64('usuario3'),'usuario3@ua.es',1, '1996-11-01', 'Oporto',3, 'usu3.png','2020-10-20 11:22:18 ', '5'),
(4, 'usu4', TO_BASE64('usuario4'),'usuario4@ua.es',1, '1998-11-05', 'Praha',4, 'usu4.jpg','2020-10-23 11:38:09 ', '4'),
(5, 'migueldiecinueve', TO_BASE64('verde1979'), 'migueldiecinueve1@gmail.es',2, '1979-02-11', 'Santander',2, 'migui19.jpg','2020-03-25 10:32:08 ', '7'),
(6, 'bocavictor', TO_BASE64('boca12345'), 'victormboca@gmail.es',2, '1999-06-13', 'Washington D.C.',5, 'victor1.jpg','2020-03-25 10:32:08 ', '8');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`IdAlbum`),
  ADD KEY `IdUsuario`(`Usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`IdEstilos`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `IdAlbum`(`Album`),
  ADD KEY `IdPais`(`Pais`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`),
  ADD KEY `IdAlbum`(`Album`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `NomUsuario` (`NomUsuario`),
  ADD KEY `IdPais` (`Pais`),
  ADD KEY `IdEstilo` (`Estilo`);
COMMIT;

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes` 
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos` 
  MODIFY `IdEstilos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos` 
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises` 
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes` 
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `albumes_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fotos_ibfk_2` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Estilo`) REFERENCES `estilos` (`IdEstilos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;