<?php
include('../config/config.php');

  function trash_setMate($id){
    $mysqli = crearConexion();
    $id = clear_inputs(limpiarCadena($id));

    $consulta = 'DELETE FROM semestre WHERE id_semestre ="'.$id.'"';

    if($mysqli->query($consulta)){
    	$userArray = array('status' => true);
    }else{
    	$userArray = array('status' => false);
    }
    	echo json_encode($userArray);
  }
?>
