<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionIndex();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/tecniclickbanner1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/tecniclickbanner2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/tecniclickbanner3.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
</div>


<img src="img/vista-dispositivos.png" width="30%">

<?php
include_once('templates/terminar-html.php');
?>