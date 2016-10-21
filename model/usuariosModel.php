<?php
include('../config/config.php');

function show_user(){
  $mysqli = crearConexion();
  $consulta = 'SELECT * FROM usuarios WHERE id_user!="'.$_SESSION["id_register"].'" ';
  $resultado = $mysqli->query($consulta);
   $datos=[];
  while ($row = $resultado->fetch_array()) {
      $datos[] =$row;
  }
  return $datos;
}
?>
