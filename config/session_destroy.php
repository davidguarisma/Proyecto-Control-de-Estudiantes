<?php
// session_name("iuteb");

session_start();
session_unset();
session_destroy();
header("Location: ../");
exit;

?>
