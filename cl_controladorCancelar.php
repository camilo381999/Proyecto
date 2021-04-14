<?php
include_once("Publicacion.php");

$fecha = $_GET['Fecha'];
$hora = $_GET['Hora'];
$idPendiente = $_GET['idPendiente'];

$Modelo = new Publicacion();
if ($Modelo->cancelacionServicioPendiente($fecha, $hora, $idPendiente)) {
	$validacionPost = true;
	include_once('templates/iniciar-html.php');
	include_once('templates/menu.php');
	//script del alert
	if ($validacionPost) {

		echo "<script> Swal.fire('¡Se ha cancelado su servicio correctamente!');";
		//redireccionar a alguna pagina
		/* echo "window.location.href = 'index.php';"; */
		echo "</script>";
		//header('Location: index-Clientes.php');
	}
} else {
	//header('Location: index-Clientes.php');
	$validacionPost = true;

	//script del alert
	if ($validacionPost) {
		echo "<script> Swal.fire('¡Quedan menos de 2 horas para su cita, por favor cominiquese con su técnico para cancelar!');";
		//redireccionar a alguna pagina
		/* echo "window.location.href = 'index.php';"; */
		echo "</script>";
		//header('Location: index-Clientes.php');
	}
}

include_once('templates/terminar-html.php');
