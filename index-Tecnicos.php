<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container">

    <div class="publicacion-title">
        <br>
        <h1>Bienvenido <?php echo $ModeloUsuarios->getNombre(); ?></h1>
        <h3>¿Qué deseas hacer?</h3>
        <br>
    </div>




    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="tc_MuroPublicaciones.php" class="menu__option" id="btnPublicaciones">
                    <img class="option__image" src="img/icon-publicaciones.svg" alt="icon-publicaciones">
                    Muro de Publicaciones
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="tc_ConsultarAgenda.php" class="menu__option" id="btnAgenda">
                    <img class="option__image" src="img/icon-agenda.svg" alt="icon-agenda.svg">
                    Consultar Agenda
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="tc_ConsultarIngresos.php" class="menu__option" id="btnIngresos">
                    <img class="option__image" src="img/icon-ingresos.svg" alt="icon-ingresos">
                    Consultar Ingresos Semanales
                </a>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="tc_ActualizarDatos.php" class="menu__option" id="btnActualizar">
                    <img class="option__image" src="img/icon-actualizar.svg" alt="icon-actualizar">
                    Actualizar datos
                </a>
            </div>
        </div>
    </div>

</div>

<?php
include_once('templates/terminar-html.php');
?>