<?php
session_start();
// Unset a todas las variables de sesión
$_SESSION = array();
// Destruir sesión 
session_destroy();
echo "sesion cerrada";
?>