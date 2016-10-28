<?php
  function  status_mate($v1,$v2){
    $mysqli = crearConexion();
    $consulta = 'SELECT `id_inscripcion` FROM `inscripcion` WHERE `user_id` = "'.$v1.'" and `id_semestre` = "'.$v2.'"';
    $resultado = $mysqli->query($consulta);

    $data = array();
    if ($resultado->num_rows != 0) {
        $data =1;
    }else {
     $data =  0;
    }

    return $data;
  }
function count_register(){
    $mysqli = crearConexion();
    $consulta = 'SELECT  COUNT(*) as contador
   FROM `inscripcion` WHERE `user_id` = "'.$_SESSION["id_register"].'" GROUP BY user_id';
  $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array();
    return $row['contador'];
}
