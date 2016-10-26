<?php
 include('../config/config.php');
 require_once('historialModel.php');

    function show_user(){
      $mysqli = crearConexion();
      $consulta = 'SELECT * FROM usuarios WHERE id_user!="'.$_SESSION["id_register"].'" ';
      $resultado = $mysqli->query($consulta);
       $datos=[];
      while ($row = $resultado->fetch_array()) {
          $datos[] =$row;
      }
       post_historial($_SESSION['user_correo'],'333','Usuarios','Ver registros');
      return $datos;
    }
    function post_user_new($post_user){
      $mysqli = crearConexion();
      $data = array();
      foreach($post_user as $nombre_campo => $valor) {
          $data[] = $valor;
      }
        $cedula = clear_inputs(limpiarCadena($data[0]));
        $email = clear_inputs(limpiarCadena($data[1]));
        $password = clear_inputs(limpiarCadena($data[2]));
        $tipo_user = clear_inputs(limpiarCadena($data[3]));

        $consulta = 'SELECT cedula, correo FROM usuarios WHERE cedula="'.$cedula.'" OR correo="'.$email.'"  LIMIT 1';
        $resultado = $mysqli->query($consulta);
        if ($resultado->num_rows == 0) {
       $query = sprintf("INSERT INTO usuarios VALUES
         (%d,%d,'%s','%s','%s','%s','%s',%d)",
         NULL,$cedula,"Administrador","Administrador",$email,"No menciona",md5($password),$tipo_user );
          if ( $mysqli->query($query)) {
                  $mensaje =1;
                  show_user();
              }else{
                 $mensaje = 2;
                 }
          }else {
           $mensaje =3;
          }
    post_historial($_SESSION['user_correo'],"33",'Nuevo usuarios','Registros exitoso');
  echo $mensaje;
}

function filter_user($action){
    $mysqli = crearConexion();
    $consulta = 'SELECT * FROM usuarios WHERE id_user="'.$_SESSION["id_register"].'" ';
    $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array();
    $user = array();
    $user['nombres'] = string_ucfirst($row['nombres']);
    $user['apellidos'] = string_ucfirst($row['apellidos']);
    $user['cedula'] = $row['cedula'];
    $user['correo'] = $row['correo'];
    $user['clave'] = $_SESSION['user_password'];

    echo json_encode($user);
}
function update_user_session($data_post){
  $mysqli = crearConexion();
  $data = array();
  foreach($data_post as $nombre_campo => $valor) {
      $data[] = $valor;
  }
    $nombres = clear_inputs(limpiarCadena($data[0]));
    $apellidos = clear_inputs(limpiarCadena($data[1]));
    $cedula = clear_inputs(limpiarCadena($data[2]));
    $email = clear_inputs(limpiarCadena($data[3]));
    $password = clear_inputs(limpiarCadena($data[4]));

    $consulta = 'UPDATE usuarios SET cedula = "'.$cedula.'", nombres = "'.$nombres.'",
    apellidos = "'.$apellidos.'",correo ="'.$email.'",clave = "'.md5($password).'"
    WHERE id_user="'.$_SESSION["id_register"].'"  LIMIT 1';

    if ($mysqli->query($consulta)) {
        $mensaje = 1;
    }else{
       $mensaje = 2;
    }
     post_historial($_SESSION['user_correo'],'44','actuzaliar usuario','Registro actualizado');
    echo $mensaje;
}
