<?php 
 require_once('../../Usuarios/Modelo/Usuarios.php');

 if ($_POST) {
 	 $Modelo =  new Usuarios();

 	 $Nombre = $_POST['Nombre'];
 	 $Apellido = $_POST['Apellido'];
	 $Cedula = $_POST['Cedula'];
     $Correo = $_POST['Correo'];
     $Telefono = $_POST['Telefono'];
 	 $Password = $_POST['Contrasena'];

	  if($Modelo->add($Nombre, $Apellido, $Cedula, $Correo,
	   $Telefono, $Password)){
			header('Location: ../Pages/index.php');
	  }else{
		header('Location: ../../registro.php');
	  }

 }else{
 	header('Location: ../../registro.php');
 }




 ?>