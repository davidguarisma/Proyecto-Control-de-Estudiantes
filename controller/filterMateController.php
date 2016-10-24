<?php
  $opt = $_POST['opt'];
  require_once('../model/filterMateModel.php');
  if($opt == 1){
  	$pnf      = $_POST['p'];
  	$trayecto = $_POST['t'];
  	$semestre = $_POST['s'];

    filterSelect($opt,$pnf,$trayecto,$semestre);
  }else if($opt == 2){
    listar();
  }
?>
