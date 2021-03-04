<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionCliente();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?> 
 
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1>Bienvenido <?php echo $ModeloUsuarios->getNombre(); ?></h1>
                <h3>¿Qué deseas hacer?</h3>
            </div>
        </div>

		<div class="row">
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="main-menu__options">
                    <a href="#" class="menu__option" id="btnPublicar">
                        <img class="option__image" src="img/icon-publicar.svg" alt="icon-publicar"> 
                        Publicar Servicio
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="main-menu__options">
                    <a href="#" class="menu__option" id="btnCancelar">
                        <img class="option__image" src="img/icon-cancelar.svg" alt="icon-cancelar"> 
                        Cancelar Servicio
                    </a>
                </div>
            </div>  
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="main-menu__options">
                    <a href="#" class="menu__option" id="btnHistorial">
                        <img class="option__image" src="img/icon-historial.svg" alt="icon-historial"> 
                        Historial de Servicios
                    </a>
                </div>
            </div> 

            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="main-menu__options">
                    <a href="#" class="menu__option" id="btnActualizar">
                        <img class="option__image" src="img/icon-actualizar.svg" alt="icon-actualizar"> 
                        Actualizar datos
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="main-menu__options">
                    <a href="#" class="menu__option" id="btnPQRs">
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