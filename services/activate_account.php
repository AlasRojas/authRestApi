<?php


include("../include/datos_conection.php");

if( isset( $_POST['accesstoken'] ) && !empty( $_POST['accesstoken'] ) &&
	isset( $_POST['accesssecret'] ) && !empty( $_POST['accesssecret'] ) ){

	$conection = mysql_connect( $host, $user, $password )or die("problemas al conectar");

	mysql_select_db( $db )or die("Problemas al ingresar al la db");

	$seleccion = mysql_query("UPDATE usuarios SET active=1 WHERE accesstoken='$_POST[accesstoken]' AND accesssecret='$_POST[accesssecret]'", $conection)or die(mysql_error());

	//$session = mysql_fetch_array($seleccion);

	
		$data = array(
			'succes' => 'true',
			'data' => $seleccion
		);

		echo json_encode($data);
	
}else{
	$data = array(
		'succes' => 'false',
		'data' => 'error al ingresar los datos'
	);

	echo json_encode($data);
	//echo "error al ingresar los datos";
}

?>