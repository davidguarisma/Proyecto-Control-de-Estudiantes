<?php
function get_pnf_alumnos(){
    $mysqli = crearConexion();
    $consulta = 'SELECT pnf_user, 	case pnf_user WHEN 1 THEN  "PNF en Electricidad"
  		  WHEN 2 THEN  "PNF en Ingeniería de Mantenimiento"
            WHEN 3 THEN  "PNF en Mecánica"
            WHEN 4 THEN  "PNF en Informática"
            WHEN 5 THEN  "PNF en Geociencia"
            WHEN 6 THEN  "PNF en Sistemas de Calidad y Ambiente"
    		END AS pnf_user,count(*) as contador FROM usuarios GROUP BY pnf_user';
  $resultado = $mysqli->query($consulta);

  $data = array();
  while ( $row = $resultado->fetch_array()) {
  $data[] =$row;
  }
  return $data;
}
