<?php
include_once("Publicacion.php");

$idPublicacion = $_GET['Id'];
$Fecha = $_GET['Fecha'];
$Hora = $_GET['Hora'];
$Ubicacion = $_GET['Ubicacion'];

$Modelo = new Publicacion();
if($Modelo->servicioAceptado($Fecha,$Hora,$Ubicacion,$idPublicacion)){
    header('Location: tc_MuroPublicaciones.php');
}else{
    header('Location: index-Tecnicos.php');
}

?>