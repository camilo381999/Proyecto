<?php 

require_once('../Modelo/Materias.php');

if ($_POST) {
	$ModeloMaterias = new Materias();	
	
	$Id = $_POST['Id'];

	$ModeloMaterias->delete($Id);
}else{
	header('Location: ../../index.php');
}




 ?>