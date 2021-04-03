<?php
include_once("Publicacion.php");

$fecha = $_GET['Fecha'];
$hora = $_GET['Hora'];
$idPendiente = $_GET['idPendiente'];

$Modelo = new Publicacion();
if($Modelo->cancelacionServicioPendiente($fecha, $hora, $idPendiente)){
    header('Location: index-Clientes.php');
}else{
    header('Location: index-Clientes.php');
}

?>