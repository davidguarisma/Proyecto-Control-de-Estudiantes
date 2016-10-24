<?php
include('../config/config.php');

  function mateSelect($pnf,$trayecto,$semestre){
	$mysqli = crearConexion();
    $consulta = '
    SELECT id_materias, materia FROM
	materias INNER JOIN semestre
	on semestre_id = id_semestre AND pnf = "'.$pnf.'" AND trayecto = "'.$trayecto.'" AND nombre_semestre = "'.$semestre.'" ORDER BY id_semestre DESC ';

  $resultado = $mysqli->query($consulta);

  $datos = array();

  while ($row = $resultado->fetch_array()){
    		$datos[] = $row;
  	}

    $num = mysqli_num_rows($resultado);
    $datos['valor'] = $num;
    	echo json_encode($datos);
}
?>
