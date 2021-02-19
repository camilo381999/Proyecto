<?php 
 require_once('../Modelo/Clientes.php');

 if ($_POST) {
 	 $Modelo =  new Clientes();

 	 $Nombre = $_POST['Nombre'];
 	 $Apellido = $_POST['Apellido'];
	 $Cedula = $_POST['Cedula'];
     $Correo = $_POST['Correo'];
     $Telefono = $_POST['Telefono'];
 	 $Usuario = $_POST['Usuario'];
 	 $Password = $_POST['Contrasena'];

 	 $Modelo->add($Nombre, $Apellido, $Cedula, $Correo, $Telefono, $Usuario, $Password);
 }else{
 	header('Location: ../../index.php');
 }




 ?>