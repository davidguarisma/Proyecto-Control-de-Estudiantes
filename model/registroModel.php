<?php
include('../config/config.php');
require_once('historialModel.php');
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
           NULL,$cedula,$nombre,$apellido,$email,$telefono,$pnf,$trayecto,$semestre,md5($password),1 );
        if ( $mysqli->query($query)) {
            $id = $mysqli->insert_id;
            $_SESSION['id_register'] = $id;
            $_SESSION['user_cedula'] = $cedula;
            $_SESSION['user_correo'] = $email;
            $_SESSION['user_clave'] = md5($password);
            $_SESSION['semestre_user'] = $semestre;
            $_SESSION['pnf_user'] = $pnf;

             post_historial($email,'333','Registro de alumnos','Exitoso');
            $mensaje =1;
        }else{
           post_historial($email,'333','Registro de alumnos','Fallo el registro');
           $mensaje = 2;
           }
    }else {
       post_historial($email,'333','Registro de alumnos','Usuario registrado');
       $mensaje =3;
    }
    echo $mensaje;
}
?>
