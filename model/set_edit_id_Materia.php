<?php
include('../config/config.php');
require_once('historialModel.php');
  function edit_setIdMate($id ){
    $mysqli = crearConexion();
    $id = clear_inputs(limpiarCadena($id));

    $consulta = 'SELECT id_materias, materia, nombre_semestre, trayecto, pnf, id_semestre  FROM materias INNER JOIN semestre on semestre_id = id_semestre AND id_materias ="'.$id.'"';
    $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array();
    $userArray = array('id' =>$row["id_materias"], 'materia' =>$row["materia"], 'semestre' =>$row["nombre_semestre"], 'trayecto' =>$row["trayecto"], 'pnf' =>$row["pnf"], 'idSemestre' =>$row["id_semestre"]);
     post_historial($_SESSION['user_correo'],'333','Editar materias','Exitoso');
     echo json_encode($userArray);
  }
?>
