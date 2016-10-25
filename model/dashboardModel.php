<?php
function nameLogeado(){
  $mysqli = crearConexion();
  $consulta = 'SELECT id_user,nombres,apellidos,tipo_usuario,CASE tipo_usuario WHEN 1 THEN  "estudiantes" WHEN 2 THEN  "administrador" END AS  tipo_user FROM usuarios WHERE id_user="'. $_SESSION['id_register'].'" LIMIT 1';
  $resultado = $mysqli->query($consulta);
  $row = $resultado->fetch_array();
  $_SESSION['tipo_user'] = $row['tipo_user'];
  echo string_ucfirst($row["nombres"]).' '.string_ucfirst($row["apellidos"]);
}
