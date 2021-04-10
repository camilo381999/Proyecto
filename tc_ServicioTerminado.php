<?php
include_once("Publicacion.php");

$idAgenda = $_GET['Id'];
$idPendiente = $_GET['IdPendiente'];

$Modelo = new Publicacion();
if($Modelo->servicioTerminado($idAgenda,$idPendiente)){
    header('Location: tc_ConsultarAgenda.php');
}else{
    header('Location: index-Tecnicos.php');
}

?>