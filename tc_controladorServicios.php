<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$idPublicacion = $_GET['Id'];
$Boton = $_GET['Boton'];
$Fecha = $_GET['Fecha'];
$Hora = $_GET['Hora'];
$Ubicacion = $_GET['Ubicacion'];

$Modelo = new Publicacion();
if($Modelo->servicioPendiente($Boton, $idPublicacion, $Fecha, $Hora, $Ubicacion)){
        $validacionPost=true;

        //script del alert
        if($validacionPost){
            echo "<script> Swal.fire('¡Usted ha aceptado este servicio!').then(
                function() {
                    window.location.href = 'index.php';
                });";
            echo "</script>";
            
        }
}else{
    $validacionPost=true;

    //script del alert
    if($validacionPost){
        echo "<script> Swal.fire('¡No se ha podido agendar este servicio!').then(
            function() {
                window.location.href = 'index.php';
            });";
        echo "</script>";
        
    }
}
include_once('templates/terminar-html.php');
?>