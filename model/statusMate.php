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
