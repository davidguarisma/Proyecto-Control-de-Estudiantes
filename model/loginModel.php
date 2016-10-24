<?php
include('../config/config.php');

function login_user($usuario,$password ){
    $mysqli = crearConexion();
    $usuario = clear_inputs(limpiarCadena($usuario));
    $password = clear_inputs(limpiarCadena($password));
    $_SESSION['user_password'] = $password ;


    $mensaje = array();

      $consulta = 'SELECT id_user,cedula,correo, clave FROM usuarios WHERE
        cedula="'.$usuario.'" AND clave ="'.md5($password).'"  OR correo="'.$usuario.'" AND clave ="'.md5($password).'" LIMIT 1';
      $resultado = $mysqli->query($consulta);
      $row = $resultado->fetch_array();

      if ($resultado->num_rows == 0) {
          $mensaje =1;
      }else {
        $_SESSION['id_register'] = $row['id_user'];
        $_SESSION['user_cedula'] = $row['cedula'];
        $_SESSION['user_correo'] = $row['correo'];
        $_SESSION['user_clave'] = $row['clave'];

       $mensaje =  2;
      }
    echo $mensaje;
  }

?>
