<?php
  function get_historial(){
    include('../config/config.php');
    $mysqli = crearConexion();
    $consulta = 'SELECT * FROM `historial` ORDER BY id_historial DESC';
    $resultado = $mysqli->query($consulta);

    $data = array();
    while ( $row = $resultado->fetch_array()) {
    $data[] =$row;
    }
     post_historial($_SESSION['user_correo'],'ss','Historial','Ver registros');
    return $data;
}

function post_historial($user,$ip,$page,$msj){
  $mysqli = crearConexion();
  $consulta ="INSERT INTO `historial` VALUES (NULL,'".$user."','".$ip."','".$page."','".$msj."',NOW())";
  return $mysqli->query($consulta);
}
