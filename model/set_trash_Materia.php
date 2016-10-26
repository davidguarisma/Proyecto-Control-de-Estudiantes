<?php
include('../config/config.php');
require_once('historialModel.php');
  function trash_setMate($id){
    $mysqli = crearConexion();
    $id = clear_inputs(limpiarCadena($id));

    $consulta = 'DELETE FROM semestre WHERE id_semestre ="'.$id.'"';

    if($mysqli->query($consulta)){
    	$userArray = array('status' => true);
    }else{
    	$userArray = array('status' => false);
    }
     post_historial($_SESSION['user_correo'],'333','ELiminar materia','Registro eliminado');
    	echo json_encode($userArray);
  }
?>
