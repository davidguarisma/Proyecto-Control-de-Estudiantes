<?php
include('../config/config.php');
require_once('historialModel.php');
function login_user($usuario,$password ){
    $mysqli = crearConexion();
    $usuario = clear_inputs(limpiarCadena($usuario));
    $password = clear_inputs(limpiarCadena($password));
    $_SESSION['user_password'] = $password ;


    $mensaje = array();

      $consulta = 'SELECT id_user,cedula,correo,semestre_user,pnf_user,clave FROM usuarios WHERE
        cedula="'.$usuario.'" AND clave ="'.md5($password).'"  OR correo="'.$usuario.'" AND clave ="'.md5($password).'" LIMIT 1';
      $resultado = $mysqli->query($consulta);
      $row = $resultado->fetch_array();

      if ($resultado->num_rows == 0) {
           $mensaje =1;
           post_historial($usuario,'333','Login','Logearse fallido');
      }else {
        $_SESSION['id_register'] = $row['id_user'];
        $_SESSION['user_cedula'] = $row['cedula'];
        $_SESSION['user_correo'] = $row['correo'];
        $_SESSION['user_clave'] = $row['clave'];
        $_SESSION['semestre_user'] = $row['semestre_user'];
        $_SESSION['pnf_user'] = $row['pnf_user'];
       $mensaje =  2;
       post_historial($usuario,'333','Login','Logearse exitoso');
      }
    echo $mensaje;
  }

?>
