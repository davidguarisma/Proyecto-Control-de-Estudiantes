<?php
  function crearConexion(){
    if(!isset($_SESSION)) {
      session_start();
      $_POST = array();
    }
    $mysqli = new mysqli("localhost", "root", "root");
    if(!$mysqli->connect_error){
        $mysqli->query('CREATE DATABASE IF NOT EXISTS iuteb');
        $mysqli->select_db("iuteb");
        if(is_file('bd/iuteb.php')) {
          require_once('bd/iuteb.php');
        }
        date_default_timezone_set("America/Caracas");
        date_default_timezone_get();
    }else{
      die("Error en la conexion :".$conexion->connect_errno.
      "-".$mysqli->connect_error);
    }
    return $mysqli;
  }
  function limpiarCadena($valor){
     $valor = str_ireplace("SELECT","",$valor);
    $valor = str_ireplace("COPY","",$valor);
    $valor = str_ireplace("DELETE","",$valor);
    $valor = str_ireplace("DROP","",$valor);
    $valor = str_ireplace("DUMP","",$valor);
    $valor = str_ireplace(" OR ","",$valor);
    $valor = str_ireplace("%","",$valor);
    $valor = str_ireplace("LIKE","",$valor);
    $valor = str_ireplace("--","",$valor);
    $valor = str_ireplace("^","",$valor);
    $valor = str_ireplace("[","",$valor);
    $valor = str_ireplace("]","",$valor);
    $valor = str_ireplace("\\","",$valor);
    $valor = str_ireplace("!","",$valor);
    $valor = str_ireplace("¡","",$valor);
    $valor = str_ireplace("?","",$valor);
    $valor = str_ireplace("=","",$valor);
    $valor = str_ireplace("&","",$valor);
    $valor = addslashes($valor);
    return $valor;
 }

 function clear_inputs($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
 function string_ucfirst($string){
   return  ucfirst($string);
 }

 // NIVEL DE USUARIO
 // Administrador = 0;
 // Usuarios = 1;
// PNF
// 1 = 	PNF en Electricidad
// 2 = 	PNF en Ingeniería de Mantenimiento
// 3 = PNF en Mecánica
// 4 = PNF en Informática
// 5 = 	PNF en Geociencia
// 6 = PNF en Sistemas de Calidad y Ambiente
 ?>
