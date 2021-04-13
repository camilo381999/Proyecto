<?php
include_once("Publicacion.php");

$idTecnico = $_GET['IdTecnico'];
$Fecha = $_GET['Fecha'];
$Hora = $_GET['Hora'];
$idPublicacion = $_GET['idPublicacion'];
$Servicio = $_GET['Servicio'];

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

if($Servicio == "Mantenimiento"){
    $Modelo->servicioAceptado($Fecha, $Hora, $publicacion['LOCALIDAD'],$idTecnico, $pendiente['ID_PENDIENTE'],'30000');
}else{
$Modelo->servicioAceptado($Fecha, $Hora, $publicacion['LOCALIDAD'],$idTecnico, $pendiente['ID_PENDIENTE'],'40000');
}

$validacionPost=true;

//script del alert
if($validacionPost){
    echo "<script>";
    echo "alert('¡Su cita se agendó correctamente con este tecnico!');" ;
    echo "window.location.href = 'index.php';" ;
    echo "</script>"; 

}

//header('Location: index-Clientes.php');
?>