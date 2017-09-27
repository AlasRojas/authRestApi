<?php
//session_start();

//if(isset($_SESSION['username'])){

	include("../include/datos_conection.php");

	if( isset( $_POST['usuario'] ) && !empty( $_POST['usuario'] ) && 
		isset( $_POST['pw'] ) && !empty( $_POST['pw'] ) ){



		$conection = mysql_connect( $host, $user, $password )or die("problemas al conectar");

		mysql_select_db( $db )or die("Problemas al ingresar al la db");

		$has_pw = hash('sha512', $_POST['pw']);

		mysql_query("INSERT INTO usuarios (user, pw) VALUES ('$_POST[usuario]','".$has_pw."')", $conection);
		//echo "Datos insertados";

		$data = array(
			'succes' => 'true',
			'usuario' => $_POST['usuario'],
			'pw' => $has_pw
		);

		echo json_encode($data);

	}
//}

?>