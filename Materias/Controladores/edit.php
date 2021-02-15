<?php 

require_once('../Modelo/Materias.php');

if ($_POST) {
	$ModeloMaterias = new Materias();	
	
	$Id = $_POST['Id'];
	$Nombre = $_POST['Nombre'];

	$ModeloMaterias->update($Id,$Nombre);
}else{
	header('Location: ../../index.php');
}




 ?>