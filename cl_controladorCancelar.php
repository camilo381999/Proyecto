<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

$fecha = $_GET['Fecha'];
$hora = $_GET['Hora'];
$idPendiente = $_GET['idPendiente'];


$Modelo = new Publicacion();

if ($Modelo->cancelacionServicioPendiente($fecha, $hora, $idPendiente)) {
	$validacionPost = true;
	
	//script del alert
	if ($validacionPost) {
		echo "<script> Swal.fire('¡Se ha cancelado su servicio correctamente!').then(
			function() {
				window.location.href = 'index.php';
			});";
		echo "</script>";
	}
} else {
	$validacionPost = true;

	//script del alert
	if ($validacionPost) {
		echo "<script> Swal.fire('¡Quedan menos de 2 horas para su cita, por favor comuniquese con su técnico para cancelar!').then(
			function() {
				window.location.href = 'index.php';
			});";
		echo "</script>";
	}
}

include_once('templates/terminar-html.php');
