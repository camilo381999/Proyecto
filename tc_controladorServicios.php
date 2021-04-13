<?php
include_once("Publicacion.php");

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
            echo "<script>";
            echo "alert('¡Usted ha aceptado este servicio!');" ;
            //redireccionar a alguna pagina
            echo "window.location.href = 'index.php';" ;
            echo "</script>"; 
        }
}else{
    $validacionPost=true;

    //script del alert
    if($validacionPost){
        echo "<script>";
        echo "alert('¡No see ha podido agendar este servicio!');" ;
        //redireccionar a alguna pagina
        echo "window.location.href = 'index.php';" ;
        echo "</script>"; 
    }
}

?>