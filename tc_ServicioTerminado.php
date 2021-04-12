<?php
include_once("Publicacion.php");

$idAgenda = $_GET['Id'];
$idPendiente = $_GET['IdPendiente'];
$idUsuario = $_GET['idUsuario'];
$idTecnico = $_GET['idTecnico'];
$Fecha = $_GET['Fecha'];
$Costo = $_GET['Costo'];

$Modelo = new Publicacion();
if($Modelo->servicioTerminado($idAgenda,$idPendiente,$idUsuario,$idTecnico,$Fecha,$Costo)){
    header('Location: tc_ConsultarAgenda.php');
}else{
    header('Location: index-Tecnicos.php');
}

?>