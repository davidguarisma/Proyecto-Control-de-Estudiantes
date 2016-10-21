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
    foreach($_POST as $nombre_campo => $valor){
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
 //  //  echo $id_user;
 // eval($asignacion);
 $consulta = "UPDATE usuarios SET '".$asignacion."' WHERE id_user ='1'  LIMIT 1";
      $resultado = $mysqli->query($consulta);
      echo "listo ";
}
    // foreach ($_POST as $clave=>$valor)
   // 		{
    //     if($clave=="id_user") {
    //       echo $valor;
    //       $consulta = "UPDATE usuarios SET '".$clave."' = '".$valor."' WHERE id_user ='".$valor."'  LIMIT 1";
    //       $resultado = $mysqli->query($consulta);
    //       echo "listo ";
    //     }
   // 		}
  }
?>
