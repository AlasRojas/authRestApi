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
		//header('Location: index.php');
		echo "Session correcta";
	}else{
		echo "Error en password";
	}
}else{
	//header('Location: login.html');
	echo "error al ingresar los datos";
}

?>