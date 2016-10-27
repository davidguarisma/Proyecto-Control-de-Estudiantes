<?php
require_once('config/config.php');
$mysqli = crearConexion();

$mysqli->query("CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombres` char(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` char(50) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `pnf_user` int(11) NOT NULL,
  `trayecto_user` int(11) NOT NULL,
  `semestre_user` int(11) NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;");

$mysqli->query("CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `user` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `evento` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `mensaje` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci");

$mysqli->query("CREATE TABLE `materias` (
  `id_materias` int(11) NOT NULL,
  `materia` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `apertura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci");

$mysqli->query("CREATE TABLE `inscripcion` (
  `id_inscripcion` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;");

$mysqli->query("CREATE TABLE `semestre` (
  `id_semestre` int(11) NOT NULL AUTO_INCREMENT,
  `pnf` int(11) NOT NULL,
  `nombre_semestre` int(11) NOT NULL,
  `trayecto` int(11) NOT NULL,
  PRIMARY KEY (`id_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;");


$mysqli->query("ALTER TABLE `historial` ADD PRIMARY KEY (`id_historial`)");

$mysqli->query("ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`);");

$mysqli->query("ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT;");

$mysqli->query("ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materias`),
  ADD KEY `semestre_id` (`semestre_id`)");

$mysqli->query("ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id_semestre`),
  ADD KEY `user_id` (`user_id`)");

$mysqli->query("ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `cedula` (`cedula`)");

$mysqli->query("ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT");

$mysqli->query("ALTER TABLE `materias`
  MODIFY `id_materias` int(11) NOT NULL AUTO_INCREMENT");

$mysqli->query("ALTER TABLE `semestre`
  MODIFY `id_semestre` int(11) NOT NULL AUTO_INCREMENT");

$mysqli->query("ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT");

$mysqli->query("
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE");

$mysqli->query("ALTER TABLE `semestre` ADD CONSTRAINT `semestre_ibfk_1` FOREIGN KEY (`id_semestre`) REFERENCES `inscripcion` (`id_semestre`)");

$mysqli->query("ALTER TABLE `inscripcion`  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id_user`)");
 ?>
