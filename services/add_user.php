<?php
//session_start();

//if(isset($_SESSION['username'])){

	include("../include/datos_conection.php");

	if( isset( $_POST['usuario'] ) && !empty( $_POST['usuario'] ) &&
		isset( $_POST['email'] ) && !empty( $_POST['email'] ) &&
		isset( $_POST['phone'] ) && !empty( $_POST['phone'] ) && 
		isset( $_POST['pw'] ) && !empty( $_POST['pw'] ) ){



		$conection = mysql_connect( $host, $user, $password )or die("problemas al conectar");

		mysql_select_db( $db, $conection )or die("Problemas al ingresar al la db ". mysql_error());

		$has_pw = hash('sha512', $_POST['pw']);

		mysql_query("INSERT INTO usuarios (user, pw, email, phone) VALUES ('$_POST[usuario]','".$has_pw."', '$_POST[email]','$_POST[phone]')", $conection);
		//echo "Datos insertados";

		$data = array(
			'succes' => 'true',
			'usuario' => $_POST['usuario'],
			'pw' => $has_pw
		);
/*
		$to = $_POST['email'];
		$subject = "My subject";
		$txt = "Hello world!";
		$headers = "From: webmaster@example.com";

		mail($to,$subject,$txt,$headers);
*/

		echo json_encode($data);

	}else{
		$data = array(
			'succes' => 'false',
			'error' => 'faltan datos'
		);

		echo json_encode($data);
	}
//}

?>