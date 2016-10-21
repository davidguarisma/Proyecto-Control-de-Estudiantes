<?php
require_once('config/config.php');
crearConexion();
  if (!empty($_GET['action'])) {
    $action = $_GET['action'];
  } else {
      $action = 'home';
  }
  if (is_file('controller/'.$action.'Controller.php')) {
    require_once('controller/'.$action.'Controller.php');
  }else{
    require_once('controller/errorController.php');
  }
?>
