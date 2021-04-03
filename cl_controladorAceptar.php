<?php
include_once("Publicacion.php");

$idTecnico = $_GET['IdTecnico'];
$Fecha = $_GET['Fecha'];
$Hora = $_GET['Hora'];
$idPublicacion = $_GET['idPublicacion'];

$Modelo = new Publicacion();

$usuario=new Usuarios();
$idCliente= $usuario->getId(); 

$publicacion=$Modelo->getPostByid($idPublicacion);

$pendiente=$Modelo->getPendienteByidClient($idCliente,$idPublicacion,$idTecnico);

//Actualiza el estado del servico a aceptado
$Modelo->updateEstadoServicioPend($pendiente['ID_PENDIENTE'], $idTecnico);

//Borrar de la tabla pendiente las demás solicitudes
$Modelo-> deletePendiente($idCliente,$idPublicacion);

//Agrega a la agenda
$Modelo->servicioAceptado($Fecha, $Hora, $publicacion['LOCALIDAD'],$idTecnico, $pendiente['ID_PENDIENTE']);

header('Location: index-Clientes.php');
?>