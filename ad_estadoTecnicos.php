<?php
include_once('Usuarios.php');
$Modelo = new Usuarios();;
//Validar la sesion si es cliente o tecnico
$Modelo->validateSessionAdmin();

//Si el usuario le da al boton registrar
if (isset($_POST['activar'])) {

    if ($Modelo->estadoTecnico($_POST['Cedula'],'Activo')) {
        header('Location: index-Admin.php');
    } else {
        echo "error";
    }
}

if (isset($_POST['desactivar'])) {

    if ($Modelo->estadoTecnico($_POST['Cedula'],'Inactivo')) {
        header('Location: index-Admin.php');
    } else {
        echo "error";
    }
}

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-3 col-xs-12"></div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <!-- form start -->
            <form class="form-container" id="form-registro" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="title">
                    <h1>Cambiar estado del técnico</h1>
                </div>

                <div class="form-group">
                    <label>Número de cédula:</label>
                    <input name="Cedula" type="text" class="form-control" required>
                </div>


                <button name="activar" type="submit" class="btn btn-primary"> Activar </button>

                <button name="desactivar" type="submit" class="btn btn-primary "> Desactivar </button>

            </form>
        </div>
        <div class="col-md-4 col-sm-3 col-xs-12"></div>
    </div>
</div>


<?php
include_once('templates/terminar-html.php');
?>