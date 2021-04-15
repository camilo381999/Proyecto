<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$idCita=$_POST['idCita'];
$idTecnico=$_POST['idTecnico'];
$NombreTecnico=$_POST['NombreTecnico'];
$tipoServicio=$_POST['tipoServicio'];
    
    $pregunta1=$_POST['pregunta1'];
    $pregunta2=$_POST['pregunta2'];
    $pregunta3=$_POST['pregunta3'];
    $pregunta4=$_POST['pregunta4'];
    $pregunta5=$_POST['pregunta5'];
    $calificacion = $pregunta1+$pregunta2+$pregunta3+$pregunta4+$pregunta5;
    $comentario=$_POST['comentario'];

    $Modelo = new Publicacion();

    $usuario=new Usuarios();
    $idCliente= $usuario->getId(); 

    if ($Modelo->add_calificacion($idTecnico,$idCliente, $comentario,$calificacion,$tipoServicio,$idCita)) {

        echo "<script> Swal.fire('¡Se ha calificado al técnico!').then(
            function() {
                window.location.href = 'index.php';
            });";
        //redireccionar a alguna pagina
        //echo "window.location.href = 'index.php';"; 
        echo "</script>";
}

    //header('Location: index-Clientes.php');

//header('Location: index-Clientes.php');
include_once('templates/terminar-html.php');
?>