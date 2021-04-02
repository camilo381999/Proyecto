<?php
include_once("Publicacion.php");

$idAgenda = $_GET['Id'];

$Modelo = new Publicacion();
if($Modelo->servicioTerminado($idAgenda)){
    header('Location: tc_ConsultarAgenda.php');
}else{
    header('Location: index-Tecnicos.php');
}

?>