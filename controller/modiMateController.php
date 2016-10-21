<?php
    	$id = $_POST['id'];
      $mate = $_POST['mat'];
      $seme = $_POST['sem'];
      $tray = $_POST['tra'];
       $pnf = $_POST['pnf'];
    $id_sem = $_POST['idSem'];
    require_once('../model/set_modi_Materia.php');
    modi_setMate($id,$mate,$seme,$tray,$pnf,$id_sem);
 ?>
