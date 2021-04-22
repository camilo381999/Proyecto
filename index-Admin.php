<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionAdmin();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

$idUsuario = $ModeloUsuarios->getId();

$publicacion = new Publicacion();

?>

<div class="container">
    <div class="publicacion-title">
        <br>
        <br>
        <br>
        <h1>Bienvenido Admin</h1>
        <h3>¿Qué deseas hacer?</h3>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="registrarTecnico.php" class="menu__option" id="btnPublicar">
                    <img class="option__image" src="img/icon-publicar.svg" alt="icon-publicar">
                    Registrar técnico
                </a>
            </div>
        </div>
       
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="verPqrs.php" class="menu__option" id="btnPQRs">
                    <img class="option__image" src="img/icon-pqrs.svg" alt="icon-pqrs">
                    PQRs
                </a>
            </div>
        </div>
    </div>

</div>



<?php
include_once('templates/terminar-html.php');
?>