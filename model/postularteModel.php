<?php
include('../config/config.php');

  function postularte_materia($id){
      $mysqli = crearConexion();
      $consulta = 'INSERT INTO `inscripcion` VALUES (NULL,"'.$_SESSION["id_register"].'","'.$id.'")';
       $mensaje =  array();
     if ($mysqli->query($consulta)) {
        $mensaje =  1;
     }else{
       $mensaje =  2;
     }
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
    echo $mensaje;
  }
 ?>
