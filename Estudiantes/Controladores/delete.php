<?php 

require_once('../Modelo/Estudiantes.php');

if ($_POST) {
	$ModeloEstudiantes = new Estudiantes();	
	
	$Id = $_POST['Id'];
	
	$ModeloEstudiantes->delete($Id);
}else{
	header('Location: ../../index.php');
}




 ?>