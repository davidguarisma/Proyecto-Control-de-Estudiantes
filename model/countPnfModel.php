<?php
function get_pnf_alumnos(){
    $mysqli = crearConexion();
    $consulta = 'SELECT id_materias, materia, nombre_semestre, trayecto, id_semestre,
			case pnf WHEN 1 THEN  "PNF en Electricidad"
				  WHEN 2 THEN  "PNF en Ingeniería de Mantenimiento"
		          WHEN 3 THEN  "PNF en Mecánica"
		          WHEN 4 THEN  "PNF en Informática"
		          WHEN 5 THEN  "PNF en Geociencia"
		          WHEN 6 THEN  "PNF en Sistemas de Calidad y Ambiente"
      		END AS pnfs,
			case apertura WHEN 0 THEN  "Cerrada"
	 		  	  WHEN 1 THEN  "Activa"
      		END AS apert,
      		case trayecto
      			  WHEN 1 THEN  "I"
				  WHEN 2 THEN  "II"
		          WHEN 3 THEN  "III"
		          WHEN 4 THEN  "IV"
      		END AS tray,
      		case nombre_semestre
      			  WHEN 1 THEN  "I"
				  WHEN 2 THEN  "II"
		          WHEN 3 THEN  "III"
		          WHEN 4 THEN  "IV"
		          WHEN 5 THEN  "V"
		          WHEN 6 THEN  "VI"
		          WHEN 7 THEN  "VII"
		          WHEN 8 THEN  "VIII"
      		END AS semestre
  		FROM materias INNER JOIN semestre on semestre_id = id_semestre AND nombre_semestre = "'. $_SESSION['semestre_user'].'"';

  $resultado = $mysqli->query($consulta);

  $data = array();
  while ( $row = $resultado->fetch_array()) {
  $data[] =$row;
  }
  return $data;
}
