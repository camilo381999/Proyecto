<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionAdmin();

$Id = $_GET['Id'];

$Modelo = new Publicacion();

if ($Modelo->pqr_resuelto($Id)) {
		header("Location: index.php");
} else {
	
		echo "<script> Swal.fire('¡Error al resolver el pqr!').then(
			function() {
				window.location.href = 'index.php';
			});";
		echo "</script>";
}

include_once('templates/terminar-html.php');
