<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$Id = $ModeloUsuarios->getId();
$result = $ModeloUsuarios->getByIdTecnico($Id);

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12"></div>
        <div class="col-md-6 col-sm-4 col-xs-12">
            <!-- form start -->
            <form class="form-container" id="form-registro">
                <div class="title">
                    <h1>Mi Perfil</h1>
                </div>

                <div class="form-group">
                    <label>Cédula</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['ID_TECNICO'] ?>">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['NOMBRE'] ?>">
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['APELLIDO'] ?>">
                </div>
                <div class="form-group">
                    <label>Calificación</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['CALIFICACION'] ?>">
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['CORREO'] ?>">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['TELEFONO'] ?>">
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['ESTADO'] ?>">
                </div>
                <div class="form-group">
                    <label>Localidad</label>
                    <input class="form-control" disabled placeholder="<?php echo $result['LOCALIDAD'] ?>">
                </div>
        </div>
        </form>
        <div class="col-md-3 col-sm-4 col-xs-12"></div>
    </div>
</div>


<?php
include_once('templates/terminar-html.php');
?>