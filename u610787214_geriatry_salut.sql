-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-11-2020 a las 20:32:51
-- Versión del servidor: 10.4.15-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u610787214_geriatry_salut`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curas`
--

CREATE TABLE `curas` (
  `id` int(11) NOT NULL,
  `cura` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fechaCura` date NOT NULL,
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `curas`
--

INSERT INTO `curas` (`id`, `cura`, `fechaCura`, `id_paciente`) VALUES
(1, 'Úlcera por presión:\r\nLimpio con suero fisiológico + intrasite + Aquacel Ag+ apósito.', '2020-10-27', 6),
(2, 'Escalp: Limpio con suero fisiológico + Betadine + apósito.', '2020-10-27', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `textColor` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `nombre_usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil_usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`, `nombre_usuario`, `perfil_usuario`) VALUES
(2, 'Recordar pedir dirección a un paciente', 'Cuanto antes.', '#265cd9', '#FFF', '2020-10-03 10:30:00', '2020-10-03 10:30:00', 'Marcos', 'Administrativo'),
(3, 'Pruebas', 'Este día se realizarán pruebas, cualquier incidencia que aparezcan mandar una incidencia.', '#6be240', '#FFF', '2020-11-02 10:30:00', '2020-11-02 10:30:00', 'Administrador', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiales`
--

CREATE TABLE `historiales` (
  `id` int(11) NOT NULL,
  `cirugias` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `resonancias` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historiales`
--

INSERT INTO `historiales` (`id`, `cirugias`, `resonancias`, `id_paciente`) VALUES
(1, 'Se le ha realizado una cirugía de rodilla y cadera, con colocación de prótesis', 'No se le ha realizado ninguna resonancia.', 1),
(2, 'cirugia111111mmmm', 'resonancia111mmm11', 2),
(3, 'Operación de cadera.\r\nOperación de cataratas.', '', 7),
(4, 'Operación de próstata.', 'Resonancia en columna vertebral.', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `fechaIncidencia` date DEFAULT NULL,
  `nombreIncidencia` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `estadoIncidencia` int(2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `fechaIncidencia`, `nombreIncidencia`, `estadoIncidencia`, `id_usuario`) VALUES
(1, '2020-11-03', 'Esto es una prueba de una incidencia mandada por el psicólogo.', 1, 80),
(2, '2020-11-03', 'Los seguimientos no funcionan', NULL, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `desayuno` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comida` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `merienda` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cena` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `noche` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `desayuno`, `comida`, `merienda`, `cena`, `noche`, `id_paciente`) VALUES
(1, 'Omeprazol, quetiapina, Motilium.', 'Motilium, Movicol.', '', 'Quetiapina', 'Lorazepam.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `paciente` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `sip` int(9) NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `nuss` int(9) NOT NULL,
  `nacimiento` date DEFAULT NULL,
  `provincia` varchar(18) COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(18) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `situacion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `familiar` int(11) NOT NULL,
  `civil` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `ingreso` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `demencia` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cronica` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alergias` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `suplementos` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `ingreso_hospital` int(2) NOT NULL DEFAULT 0,
  `escala_barthel` int(2) NOT NULL DEFAULT 0,
  `indice_lawton_brody` int(2) NOT NULL DEFAULT 0,
  `test_reloj_shulman` int(2) NOT NULL DEFAULT 0,
  `escala_depresion_yesavage` int(2) NOT NULL DEFAULT 0,
  `foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `paciente`, `sip`, `dni`, `nuss`, `nacimiento`, `provincia`, `localidad`, `domicilio`, `situacion`, `familiar`, `civil`, `genero`, `ingreso`, `demencia`, `cronica`, `alergias`, `suplementos`, `estado`, `ingreso_hospital`, `escala_barthel`, `indice_lawton_brody`, `test_reloj_shulman`, `escala_depresion_yesavage`, `foto`) VALUES
(1, 'Luis Miguel Peral ', 88125190, '77218291Y', 99281928, '1941-02-09', 'Alicante', 'Alicante', 'Reyes Catolicos', 'Independiente', 633939185, 'Viudo', 'Masculino', 'Voluntario', 'Ninguna', 'Ninguna', 'Al polvo.', 'Hierro.\r\n\r\n B12.', 1, 1, 0, 0, 0, 0, 'vista/img/pacientes/pepito/92.png'),
(2, 'Juan Reinaldo Perez', 29184753, '15952234F', 65973554, '1933-10-07', 'Alicante', 'Alicante', 'Serrano', 'Dependiente', 633524791, 'Viudo', 'Masculino', 'Voluntario', '', '', '', '', 1, 1, 0, 0, 0, 0, 'vista/img/pacientes/juan/52.png'),
(6, 'Jose Luis Gil Garcia', 67265519, '59327720A', 97342268, '1928-09-10', 'Alicante', 'Alicante', 'Reyes Católicos', '', 639562531, 'Casado', 'Masculino', 'Involuntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Jose Luis Gil Garcia/17.png'),
(7, 'Dolores Sanchez Perez', 67261138, '98637780V', 98264732, '1924-06-21', 'Alicante', 'Alicante', 'avenida de las nacio', '', 630578432, 'Casado', 'Femenino', 'Voluntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Dolores Sanchez Perez/11.png'),
(8, 'Ana Gomez Olivares', 65813589, '24692250T', 63592892, '1936-05-05', 'Alicante', 'San Vicente', 'Calle de la Huerta', '', 622965587, 'Soltero', 'Femenino', 'Involuntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Ana Gomez Olivares/94.png'),
(9, 'Juan Carlos de Borbón Ruiz', 69257615, '58927730E', 35195644, '1938-01-05', 'Valencia', 'Valencia', 'Calle Italia', '', 639586244, 'Divorciado', 'Masculino', 'Involuntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Juan Carlos de Borbón Ruiz/15.png'),
(10, 'Marcos Gimenez Lopez', 27553945, '98357720K', 65342901, '1922-01-31', 'Alicante', 'Elche', 'Mariano Benlliure', '', 633259831, 'Casado', 'Masculino', 'Voluntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Marcos Gimenez Lopez/22.png'),
(11, 'Luisa Castro Vázquez', 42885931, '74329943L', 48521963, '1936-02-14', 'Madrid', 'Madrid', 'Calle de la pasa', '', 622284138, 'Viudo', 'Femenino', 'Involuntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Luisa Castro Vázquez/69.png'),
(12, 'Genoveva Lopez Lopez', 87265842, '65973356D', 25983647, '1925-10-28', 'Alicante', 'Alicante', 'Calle Belando', '', 630269838, 'Casado', 'Femenino', 'Voluntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Genoveva Lopez Lopez/91.png'),
(13, 'Angela Carrasco LLoret', 52871655, '96552436M', 63951652, '1939-12-06', 'Alicante', 'San Vicente', 'Calle Ancha de Caste', '', 965284132, 'Divorciado', 'Femenino', 'Voluntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Angela Carrasco LLoret/26.png'),
(14, 'Antonia Lillo Gonzalez', 52158735, '89524460B', 48361829, '1930-05-07', 'Alicante', 'Elche', 'Avenida de la Libert', '', 966362841, 'Casado', 'Femenino', 'Involuntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Antonia Lillo Gonzalez/97.png'),
(15, 'Mariano Morales Jimenez', 68962287, '48239961X', 29675364, '1935-10-20', 'Alicante', 'Elche', 'Conrado del Campo', '', 639284165, 'Soltero', 'Masculino', 'Involuntario', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 'vista/img/pacientes/Mariano Morales Jimenez/52.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE `seguimientos` (
  `id` int(11) NOT NULL,
  `ingesta` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `miccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `defecacion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fechaSeguimiento` date NOT NULL,
  `id_paciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `seguimientos`
--

INSERT INTO `seguimientos` (`id`, `ingesta`, `miccion`, `defecacion`, `fechaSeguimiento`, `id_paciente`) VALUES
(1, 'Desayuna un vaso de leche con galletas, come un plato de puré y un yogur.', 'Micciona.', 'Una defecación.', '2020-10-27', 8),
(2, 'Desayuna bien pero en la comida no quiere nada.', 'Orina normal.', 'No defeca.', '2020-10-27', 1),
(3, 'Desayuna y come bien.', 'Orina muy oscura.', 'Una defecación líquida y abundante.', '2020-10-27', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `nacimiento` date NOT NULL,
  `provincia` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `civil` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `usuario`, `password`, `dni`, `email`, `perfil`, `foto`, `estado`, `ultimo_login`, `nacimiento`, `provincia`, `localidad`, `domicilio`, `civil`) VALUES
(1, 'Administrador', 'Serna Grimaldos', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', '779237418V', 'kaduceusxx@gmail.com', 'Administrador', 'vista/img/usuarios/admin/57.png', 1, '2020-11-03 20:38:22', '2020-09-11', '', '', '', ''),
(76, 'Marcos', 'Tena', 'marcos', '$2a$07$asxx54ahjppf45sd87a5auX4IT54pizeSIwloS4gnka8p4eQ81Xuy', '77281729Y', 'kaduceusxxx@gmail.com', 'Administrativo', 'vista/img/usuarios/marcos/671.jpeg', 1, '2020-11-03 19:02:51', '1990-01-24', 'Alicante', 'Alicante', 'Periodista Tirso', 'Soltero'),
(77, 'Sandra', 'Llopis', 'sandra', '$2a$07$asxx54ahjppf45sd87a5auC3pb4ToxZjdNYgW63UxMggr4pYKb.QK', '88272817Y', 'kaduceusxxxx@gmail.com', 'Auxiliar', 'vista/img/usuarios/sandra/389.jpeg', 1, '2020-11-03 20:37:48', '1992-10-14', 'Alicante', 'Elche', 'Pablo Picasso N41', 'Casado'),
(78, 'Fernando', 'Sanchez', 'fado', '$2a$07$asxx54ahjppf45sd87a5auqbOWR3dhGUnOwGWqDVcUAudZJGxPwle', '55492845D', 'fado@gmail.com', 'Medico', 'vista/img/usuarios/fado/215.jpeg', 1, '2020-11-03 19:31:11', '1990-09-25', 'Alicante', 'Alicante', 'San Vicente Del Raspeig', 'Soltero'),
(79, 'Maria Isabel', 'Moreno', 'maria', '$2a$07$asxx54ahjppf45sd87a5au/styESZTpqxpFPzgJF99YaIo877LNdy', '92312237X', 'maria@gmail.com', 'Enfermero', 'vista/img/usuarios/maria/103.jpeg', 1, '2020-11-03 19:34:11', '1994-08-14', 'Alicante', 'Alicante', 'Camino del faro11', 'Divorciado'),
(80, 'Ana', 'Lloret', 'ana', '$2a$07$asxx54ahjppf45sd87a5auLd2AxYsA/2BbmGKNk2kMChC3oj7V0Ca', '11283846R', 'ana@gmail.com', 'Psicologo', 'vista/img/usuarios/ana/251.jpeg', 1, '2020-11-03 19:59:37', '1987-12-05', 'Alicante', 'Alicante', 'Hermanos Alvarez Quintero', 'Viudo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curas`
--
ALTER TABLE `curas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historiales`
--
ALTER TABLE `historiales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sip` (`sip`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `nuss` (`nuss`);

--
-- Indices de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curas`
--
ALTER TABLE `curas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historiales`
--
ALTER TABLE `historiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curas`
--
ALTER TABLE `curas`
  ADD CONSTRAINT `curas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historiales`
--
ALTER TABLE `historiales`
  ADD CONSTRAINT `historiales_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `medicamentos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`u610787214_administrador`@`127.0.0.1` EVENT `truncateTable` ON SCHEDULE EVERY 6 MONTH STARTS '2020-11-03 18:49:58' ON COMPLETION NOT PRESERVE ENABLE DO TRUNCATE TABLE seguimientos$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
