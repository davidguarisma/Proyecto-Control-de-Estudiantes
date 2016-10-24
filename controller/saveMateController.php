<?php
    $mat=$_POST['mat'];
    $pnf=$_POST['pnf'];
    $tra=$_POST['tra'];
    $sem=$_POST['sem'];
    require_once('../model/save_materia.php');
    save_Mate($mat,$pnf,$tra,$sem);
 ?>
