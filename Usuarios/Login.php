<?php 

include_once('../Usuarios.php');

	if ($_POST) {
		$Correo = $_POST['Correo'];
		$Password = $_POST['Contrasena'];

		$Modelo = new Usuarios();
		
		if($Modelo->login($Correo,$Password)) {
			header('Location: ../Clientes/index.php');
		}else{
			header('Location: ../ingresar.php');
		}
	}else{
		header('Location: ../ingresar.php');
	}

 ?>
 