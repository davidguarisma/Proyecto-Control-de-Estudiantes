<?php
include('../config/config.php');
require_once('historialModel.php');
  function save_Mate($mat,$pnf,$tra,$sem){
    $mysqli = crearConexion();

     $consulta1 = 'INSERT INTO semestre VALUES (0,"'.$pnf.'", "'.$sem.'", "'.$tra.'")';
     $mysqli->query($consulta1);

    $consulta2 = 'SELECT id_semestre FROM semestre  ORDER BY id_semestre DESC   LIMIT 1';
    $resultado = $mysqli->query($consulta2);
    while ($row = $resultado->fetch_array()){
    $id = $row['id_semestre'];
    }

    $consulta3 = 'INSERT INTO materias VALUES (0,"'.$mat.'","'.$id.'",0)';

    if($mysqli->query($consulta3)){
    	$mateArray = array('status' => true);
    }else{
    	$mateArray = array('status' => $tra);
    }
    post_historial($_SESSION['user_correo'],'333','Guardar materias','Exitoso');
    	echo json_encode($mateArray);
  }
?>
