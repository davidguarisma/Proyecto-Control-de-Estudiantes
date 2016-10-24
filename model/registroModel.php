<?php
include('../config/config.php');

function registro_user($nombre, $apellido,$cedula,$email,$telefono,$password,$pnf,$trayecto,$semestre ){
    $mysqli = crearConexion();
    $nombre = clear_inputs(limpiarCadena($nombre));
    $apellido = clear_inputs(limpiarCadena($apellido));
    $cedula = clear_inputs(limpiarCadena($cedula));
    $email = clear_inputs(limpiarCadena($email));
    $telefono = clear_inputs(limpiarCadena($telefono));
    $password = clear_inputs(limpiarCadena($password));
    $pnf = clear_inputs(limpiarCadena($pnf));
    $trayecto = clear_inputs(limpiarCadena($trayecto));
    $semestre = clear_inputs(limpiarCadena($semestre));

    $mensaje = array();

    $consulta = 'SELECT cedula, correo FROM usuarios WHERE cedula="'.$cedula.'" OR correo="'.$email.'"  LIMIT 1';
    $resultado = $mysqli->query($consulta);

    if ($resultado->num_rows == 0) {
         $query = sprintf("INSERT INTO usuarios VALUES
           (%d,%d,'%s','%s','%s','%s','%s','%s','%s','%s',%d)",
           NULL,$cedula,$nombre,$apellido,$email,$telefono,md5($password),$pnf,$semestre,$trayecto,1 );
        if ( $mysqli->query($query)) {
            $id = $mysqli->insert_id;
            $_SESSION['id_register'] = $id;
            $_SESSION['user_cedula'] = $cedula;
            $_SESSION['user_correo'] = $email;
            $_SESSION['user_clave'] = md5($password);
            $mensaje =1;
        }else{
           $mensaje = 2;
           }
    }else {
     $mensaje =3;
    }
    echo $mensaje;
}
?>
