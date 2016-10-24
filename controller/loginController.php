<?php
$usuario=$_POST['usuario'];
$password = $_POST['clave'];

require_once('../model/loginModel.php');
login_user($usuario,$password );
 ?>
