<?php
function get_materias_alumnos(){
  $mysqli = crearConexion();
  $consulta = 'SELECT pnf, trayecto,nombre_semestre,id_semestre,
  materia,id_user,	case pnf WHEN 1 THEN  "PNF en Electricidad"
        WHEN 2 THEN  "PNF en Ingeniería de Mantenimiento"
        WHEN 3 THEN  "PNF en Mecánica"
        WHEN 4 THEN  "PNF en Informática"
        WHEN 5 THEN  "PNF en Geociencia"
        WHEN 6 THEN  "PNF en Sistemas de Calidad y Ambiente"
      END AS pnf,  case trayecto
            WHEN 1 THEN  "I"
            WHEN 2 THEN  "II"
            WHEN 3 THEN  "III"
            WHEN 4 THEN  "IV"
            END AS trayecto,  case nombre_semestre
            WHEN 1 THEN  "I"
            WHEN 2 THEN  "II"
            WHEN 3 THEN  "III"
            WHEN 4 THEN  "IV"
            WHEN 5 THEN  "V"
            WHEN 6 THEN  "VI"
            WHEN 7 THEN  "VII"
            WHEN 8 THEN  "VIII"
          END AS nombre_semestre,
          case apertura WHEN 0 THEN  "Cerrada"
              WHEN 1 THEN  "Activa"
             END AS apertura
            FROM materias m , semestre s, usuarios u WHERE m.apertura=1 ';
  $resultado = $mysqli->query($consulta);

  $data = array();
  while ( $row = $resultado->fetch_array()) {
  $data[] =$row;
  }
  return $data;
}

 ?>
