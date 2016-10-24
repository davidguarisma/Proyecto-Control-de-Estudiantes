<?php
  require_once('../model/reportMateModel.php');
  	$pnf      = $_POST['p'];
  	$trayecto = $_POST['t'];
  	$semestre = $_POST['s'];

    mateSelect($pnf,$trayecto,$semestre);

?>
