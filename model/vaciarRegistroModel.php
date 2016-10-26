<?php
include('../config/config.php');
function vaciar_registros(){
  $mysqli = crearConexion();
  $mysqli->query('TRUNCATE historial');
}
