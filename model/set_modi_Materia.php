<?php
include('../config/config.php');

  function modi_setMate($id,$mate,$seme,$tray,$pnf,$id_sem){
    $mysqli = crearConexion();
    $id = clear_inputs(limpiarCadena($id));

    $consulta = 'UPDATE materias, semestre SET 
					materia="'.$mate.'",
				    nombre_semestre="'.$seme.'",
				    pnf= "'.$pnf.'",
				    trayecto= "'.$tray.'"
				WHERE id_materias = "'.$id.'" and id_semestre = "'.$id_sem.'"';
    
    if($mysqli->query($consulta)){
    	$userArray = array('status' => true);
    }else{
    	$userArray = array('status' => false);
    }
    	echo json_encode($userArray);
  }
?>
