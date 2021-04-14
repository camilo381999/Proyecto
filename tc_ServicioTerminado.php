<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");

$idAgenda = $_GET['Id'];
$idPendiente = $_GET['IdPendiente'];
$idUsuario = $_GET['idUsuario'];
$idTecnico = $_GET['idTecnico'];
$Fecha = $_GET['Fecha'];
$Costo = $_GET['Costo'];

$Modelo = new Publicacion();
if($Modelo->servicioTerminado($idAgenda,$idPendiente,$idUsuario,$idTecnico,$Fecha,$Costo)){
    echo "<script> Swal.fire('¡Se ha finalizado este servicio!').then(
        function() {
            window.location.href = 'index.php';
        });";
    echo "</script>";
}else{
    echo "<script> Swal.fire('¡No se pudo finalizar este servicio!').then(
        function() {
            window.location.href = 'index.php';
        });";
    echo "</script>";
}
include_once('templates/terminar-html.php');
?>