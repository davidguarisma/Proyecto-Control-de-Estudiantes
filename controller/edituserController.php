<?php
  require_once('../model/set_edit_id_user.php');
  if ($_POST['action']=="set_id") {
     edit_setIdUser($_POST['id']);
  }else{
    update_set_user($_POST);
  }

 ?>
