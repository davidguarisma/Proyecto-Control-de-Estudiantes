<?php
include('../config/config.php');

function show_user(){
  $mysqli = crearConexion();
  $consulta = '
  SELECT id_materias, materia, nombre_semestre, trayecto,
	case pnf WHEN 1 THEN  "PNF en Electricidad" 
			 WHEN 2 THEN  "PNF en Ingeniería de Mantenimiento" 
	         WHEN 3 THEN  "PNF en Mecánica"
	         WHEN 4 THEN  "PNF en Informática"
	         WHEN 5 THEN  "PNF en Geociencia"
	         WHEN 6 THEN  "PNF en Sistemas de Calidad y Ambiente"
        END AS pnfs,
	case apertura WHEN 0 THEN  "Cerrada" 
		 		  WHEN 1 THEN  "Activa" 
        END AS apert
    FROM materias INNER JOIN semestre on semestre_id = id_semestre';
  $resultado = $mysqli->query($consulta);
   $datos=[];
  while ($row = $resultado->fetch_array()) {
      $datos[] =$row;
  }
  return $datos;
}
?>
