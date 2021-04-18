<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

$idTecnico = $_GET['IdTecnico'];
$Fecha = $_GET['Fecha'];
$Hora = $_GET['Hora'];
$idPublicacion = $_GET['idPublicacion'];
$Servicio = $_GET['Servicio'];

$Modelo = new Publicacion();

$usuario = new Usuarios();
$idCliente = $usuario->getId();

$publicacion = $Modelo->getPostByid($idPublicacion);

$pendiente = $Modelo->getPendienteByidClient($idCliente, $idPublicacion, $idTecnico);

//Actualiza el estado del servico a aceptado
$Modelo->updateEstadoServicioPend($pendiente['ID_PENDIENTE'], $idTecnico);

//Borrar de la tabla pendiente las demás solicitudes
$Modelo->deletePendiente($idCliente, $idPublicacion);

//Agrega a la agenda

if ($Servicio == "Mantenimiento") {
    $Modelo->servicioAceptado($Fecha, $Hora, $publicacion['LOCALIDAD'], $idTecnico, $pendiente['ID_PENDIENTE'], '30000');
} else {
    $Modelo->servicioAceptado($Fecha, $Hora, $publicacion['LOCALIDAD'], $idTecnico, $pendiente['ID_PENDIENTE'], '40000');
}

$validacionPost = true;

//script del alert
if ($validacionPost) {

    

    echo "<script> 
        Swal.fire('¡Su cita se agendó correctamente con éste técnico!').then(
        function() {
            window.location.href = 'index.php';
        });";
    //echo "alert('¡Su cita se agendó correctamente con este tecnico!');" ;
    //redireccionar a alguna pagina
    /* echo "window.location.href = 'index.php';"; */
    echo "</script>";
    //header('Location: index-Clientes.php');

}

//header('Location: index-Clientes.php');
include_once('templates/terminar-html.php');
