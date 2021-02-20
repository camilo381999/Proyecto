<?php 

require_once('../Modelo/Usuarios.php');

	if ($_POST) {
		$Usuario = $_POST['Usuario'];
		$Password = $_POST['Contrasena'];

		$Modelo = new Usuarios();
		
		if($Modelo->login($Usuario,$Password)) {
			header('Location: ../../Clientes/Pages/index.php');
		}else{
			header('Location: ../../ingresar.php');
		}
	}else{
		header('Location: ../../ingresar.php');
	}

 ?>