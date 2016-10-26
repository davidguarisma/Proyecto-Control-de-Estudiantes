<?php
include('../config/config.php');
require_once('historialModel.php');
  function power_setMate($id){
    $mysqli = crearConexion();
    $id = clear_inputs(limpiarCadena($id));

    $consulta = 'UPDATE materias SET
				    apertura = CASE apertura
                        WHEN 1 THEN 0
                        WHEN 0 THEN 1 END
                WHERE id_materias = "'.$id.'"';

    if($mysqli->query($consulta)){
    	$userArray = array('status' => true);
    }else{
    	$userArray = array('status' => false);
    }
    post_historial($_SESSION['user_correo'],'333','Materia Activada','Activacion exitosa');
    	echo json_encode($userArray);
  }
?>
