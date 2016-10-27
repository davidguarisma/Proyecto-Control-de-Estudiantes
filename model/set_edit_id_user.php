<?php
require_once('../config/config.php');
require_once('historialModel.php');
  function edit_setIdUser($id ){
    $mysqli = crearConexion();
    $id = clear_inputs(limpiarCadena($id));

        $consulta = 'SELECT id_user,nombres,apellidos,cedula,correo,tipo_usuario,pnf_user
        ,trayecto_user,semestre_user FROM usuarios WHERE id_user="'.$id.'"  LIMIT 1';

        $resultado = $mysqli->query($consulta);
        $row = $resultado->fetch_array();
        $user = array();
        $user['id'] = $row['id_user'];
        $user['nombres'] = $row['nombres'];
        $user['apellidos'] = $row['apellidos'];
        $user['cedula'] = $row['cedula'];
        $user['correo'] = $row['correo'];
        $user['tipo_usuario'] = $row['tipo_usuario'];
        $user['pnf_user'] = $row['pnf_user'];
        $user['trayecto_user'] = $row['trayecto_user'];
        $user['semestre_user'] = $row['semestre_user'];
        post_historial($_SESSION['user_correo'],'333','Editar usuario','Exitoso');
        echo json_encode($user);
      }


  function update_set_user($post){
    $mysqli = crearConexion();

       $data = array();
       $clave = array();
       $data_id = array();
      foreach($post as $nombre_campo => $valor) {
         $data_id[] = " $nombre_campo = '$valor'";
          $data[] = " $nombre_campo = '$valor'";
          $clave[] = "$valor";
      }
      $data_splice = array_splice($data, 0,1);
      $data_input = array_splice($data_id, 1,6);
      $datos=  join(',', $data);
      $consulta = "UPDATE usuarios SET $datos WHERE $data_id[0]  LIMIT 1";

        if ($mysqli->query($consulta)) {
              $claves = md5($clave[5]);
             $consulta = "UPDATE usuarios SET clave='".$claves."' WHERE $data_id[0]  LIMIT 1";
             $mysqli->query($consulta);
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
       post_historial($_SESSION['user_correo'],'333','Eliminar','Eliminar registro de usuario');
    echo $mensaje;
  }
?>
