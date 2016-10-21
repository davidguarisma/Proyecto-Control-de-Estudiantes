<?php
  $nombre=$_POST['nombre'];
  $apellido = $_POST['apellido'];
  $cedula = $_POST['cedula'];
  $email = $_POST['email'];
  $telefono =  $_POST['telefono'];
  $password = $_POST['clave'];

  require_once('../model/registroModel.php');
  registro_user($nombre, $apellido,$cedula,$email,$telefono,$password );
?>
