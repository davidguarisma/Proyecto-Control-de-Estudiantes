<?php
include('../config/config.php');
require_once('historialModel.php');
  function postularte_materia($id){
      $mysqli = crearConexion();
      $consulta = 'INSERT INTO `inscripcion` VALUES (NULL,"'.$_SESSION["id_register"].'","'.$id.'")';
       $mensaje =  array();
     if ($mysqli->query($consulta)) {
        $mensaje =  1;
     }else{
       $mensaje =  2;
     }
       post_historial($_SESSION['user_correo'],'333','Vista de Alumnos','Inscripcion de materia');
     echo $mensaje;
  }

  function get_inscription($action){
      $mysqli = crearConexion();
    $consulta = 'SELECT * FROM `inscripcion`';
    $resultado = $mysqli->query($consulta);
     $mensaje =  array();
    if ($resultado->num_rows != 0) {
        $mensaje =1;
    }else {
     $mensaje =  2;
    }
     post_historial($_SESSION['user_correo'],'333','Vista de Alumnos','Ver registro');
    echo $mensaje;
  }
 ?>
