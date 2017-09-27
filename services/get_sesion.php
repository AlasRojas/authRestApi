<?php
session_start();

if(isset($_SESSION['username'])){

	include("../include/datos_conection.php");

	$conection = mysql_connect( $host, $user, $password )or die("problemas al conectar");

	mysql_select_db( $db )or die("Problemas al ingresar al la db");

	$seleccion = mysql_query("SELECT user FROM usuarios WHERE user='$_SESSION[username]'", $conection);

	$session = mysql_fetch_array($seleccion);

	$data = array(
		'succes' => 'true',
		'usuario' => $session['user']
	);

	echo json_encode($data);

}else{
	$data = array(
		'succes' => 'false',
		'type' => 'sesion no detectada'
	);
	echo json_encode($data);;
}

?>