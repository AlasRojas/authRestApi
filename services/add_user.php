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

		$has_pw = hash('sha512', $_POST['pw'] );

		$has_accesstoken = hash('sha512', $_POST['email'] );
		$has_accesssecret = hash('sha512', $_POST['pw'] . $_POST['email'] );

		$saveData = mysql_query("INSERT INTO usuarios (user, pw, accesstoken, accesssecret, email, phone) VALUES ('$_POST[usuario]', '".$has_pw."', '".$has_accesstoken."', '".$has_accesssecret."', '$_POST[email]', '$_POST[phone]')", $conection);
					//mysql_query("INSERT INTO usuarios (user, pw, accesstoken, accesssecret, email, phone) VALUES ('$_POST[usuario]', '".$has_pw."', '1')", $conection);

		//echo "Datos insertados";

		$data = array(
			'succes' => 'true',
			'usuario' => $_POST['usuario'],
			'accesstoken' => $has_accesstoken,
			'accesssecret' => $has_accesssecret,
			'demo' => $saveData,
			'pw' => $has_pw
		);

		if ( $saveData ) {
			$to = $_POST['email'];
			$subject = "My subject";
			$txt = "Hello world!<br><a href='http://alpharouge.com/authRestApi/index.html#accesstoken=".$has_accesstoken."&accesssecret=".$has_accesssecret."'>Confirmar</a>";
			$headers = "From: webmaster@example.com";

			mail($to,$subject,$txt,$headers);
		}

		


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