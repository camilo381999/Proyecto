<?php 

require_once('../Modelo/Usuarios.php');

	if ($_POST) {
		$Correo = $_POST['Correo'];
		$Password = $_POST['Contrasena'];

		$Modelo = new Usuarios();
		
		if($Modelo->login($Correo,$Password)) {
			header('Location: ../../Clientes/Pages/index.php');
		}else{
			header('Location: ../../ingresar.php');
		}
	}else{
		header('Location: ../../ingresar.php');
	}

 ?>