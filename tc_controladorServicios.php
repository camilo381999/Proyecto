<?php
include_once("Publicacion.php");

$idPublicacion = $_GET['Id'];
$Boton = $_GET['Boton'];
$Fecha = $_GET['Fecha'];
$Hora = $_GET['Hora'];
$Ubicacion = $_GET['Ubicacion'];

$Modelo = new Publicacion();
if($Modelo->servicioPendiente($Boton, $idPublicacion, $Fecha, $Hora, $Ubicacion)){
    header('Location: tc_MuroPublicaciones.php');
}else{
    header('Location: index-Tecnicos.php');
}

?>