<?php
require_once('../config/config.php');

  function edit_setIdUser($id ){
    $mysqli = crearConexion();
    $id = clear_inputs(limpiarCadena($id));

    $consulta = 'SELECT id_user,nombres,apellidos,cedula,correo,tipo_usuario FROM usuarios WHERE id_user="'.$id.'"  LIMIT 1';
    $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array();
    $user = array();
    $user['id'] = $row['id_user'];
    $user['nombres'] = $row['nombres'];
    $user['apellidos'] = $row['apellidos'];
    $user['cedula'] = $row['cedula'];
    $user['correo'] = $row['correo'];
    $user['tipo_usuario'] = $row['tipo_usuario'];

    echo json_encode($user);
  }


  function update_set_user($post){
    $mysqli = crearConexion();
     $data = array();
     $data_id = array();
    foreach($post as $nombre_campo => $valor) {
       $data_id[] = " $nombre_campo = '$valor'";
        $data[] = "$nombre_campo = '$valor'";
    }
      $data_splice = array_splice($data, 0,1);
      $data_input = array_splice($data_id, 1,6);
      $datos=  join(',', $data);
      $consulta = "UPDATE usuarios SET $datos WHERE $data_id[0]  LIMIT 1";
      if ($mysqli->query($consulta)) {
          $mensaje = 1;
      }else{
         $mensaje = 2;
      }
      echo $mensaje;
  }

  function set_delete_user($id_user){
    $mysqli = crearConexion();
    $consulta = "DELETE FROM `usuarios` WHERE id_user='".$id_user."'  LIMIT 1";

      if ($mysqli->query($consulta)) {
          $mensaje = 1;
      }else{
         $mensaje = 2;
      }
      echo $mensaje;
  }
?>
