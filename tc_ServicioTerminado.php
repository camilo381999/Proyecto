<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$idAgenda = $_GET['Id'];
$idPendiente = $_GET['IdPendiente'];
$idUsuario = $_GET['idUsuario'];
$idTecnico = $_GET['idTecnico'];
$Fecha = $_GET['Fecha'];
$Costo = $_GET['Costo'];
$Correo = $_GET['Correo'];

$Modelo = new Publicacion();
if ($Modelo->servicioTerminado($idAgenda, $idPendiente, $idUsuario, $idTecnico, $Fecha, $Costo)) {

    // Envia correo al usuario de que se termino el servicio y debe calificar
    $asunto = "Tu servicio ha finalizado";
    $mensaje = "Tu técnico ha indicado que ha concluido tu servicio por un valor de: $Costo, por favor recuerda calificarlo. Esto ayudará a que mejore a futuro la calidad de su servicio.\n\n\nGracias por preferir TecniClick";
    $headers = "From: sender email";

    if (mail($Correo, $asunto, $mensaje, $headers)) {
        echo "<script> Swal.fire('¡Se ha finalizado este servicio!').then(
            function() {
                window.location.href = 'index.php';
            });";
        echo "</script>";
    } else {
        echo "<script> Swal.fire('¡No se pudo finalizar este servicio!').then(
            function() {
                window.location.href = 'index.php';
            });";
        echo "</script>";
    }

} else {
    echo "<script> Swal.fire('¡No se pudo finalizar este servicio!').then(
        function() {
            window.location.href = 'index.php';
        });";
    echo "</script>";
}
include_once('templates/terminar-html.php');
