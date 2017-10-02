<?php

session_start();

include("../include/datos_conection.php");

if( isset( $_POST['usuario'] ) && !empty( $_POST['usuario'] ) &&
	isset( $_POST['pw'] ) && !empty( $_POST['pw'] ) ){

	$conection = mysql_connect( $host, $user, $password )or die("problemas al conectar");

	mysql_select_db( $db )or die("Problemas al ingresar al la db");

	$has_pw = hash('sha512', $_POST['pw']);

	$seleccion = mysql_query("SELECT user,pw FROM usuarios WHERE user='$_POST[usuario]'", $conection);

	$session = mysql_fetch_array($seleccion);

	if( $has_pw == $session['pw'] ){
		$_SESSION['username'] = $_POST['usuario'];
		$data = array(
			'succes' => 'true',
			'data' => 'Session Iniciada'
		);

		echo json_encode($data);
	}else{
		$data = array(
			'succes' => 'false',
			'data' => 'Error en contraseña'
		);

		echo json_encode($data);
	}
}else{
	$data = array(
		'succes' => 'false',
		'data' => 'error al ingresar los datos'
	);

	echo json_encode($data);
	//echo "error al ingresar los datos";
}

?>