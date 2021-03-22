<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$idPublicacion = $_GET['Id'];
$Fecha = $_GET['Fecha'];
$Hora = $_GET['Hora'];

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$Modelo = new Publicacion();
$resultado = $Modelo->getPostByid($idPublicacion);


if (isset($_GET['aceptar'])) {
    $Modelo = new Publicacion();
    if ($Modelo->servicioPendiente("true", $idPublicacion, $_GET['Fecha'], $_GET['Hora'], $resultado['LOCALIDAD'])) {
        //redireccionar a alguna pagina
    }
}

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container">

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">

            <form class="form-container" id="form-cambioFechaHora" method="GET" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="title">
                    <h1>Proponer un horario diferentel</h1>
                </div>

                <div class="form-group">
                    <label>Nombre y ubicación del cliente</label>
                    <input type="text" class="form-control" disabled value="<?php echo $resultado['CLIENTE'] . ', ' . $resultado['LOCALIDAD']; ?>">
                </div>

                <div class="form-group">
                    <label>Producto y tipo de servicio</label>
                    <input type="text" class="form-control" disabled value="<?php echo $resultado['TIPO'] . ' marca ' . $resultado['MARCA'] . ', ' . $resultado['SERVICIO']; ?>">
                </div>
                
                
                <div class="form-group">
                    <label for="fecha">¿Qué día propones?:</label><br>
                    <input type="date" class="form-control" id="fecha" name="Fecha" value=<?php echo $resultado['FECHA'];?> min="2021-01-01" max="2025-12-31" required>
                </div>

                <div class="form-group">
                    <label for="hora">¿Qué hora propones?:</label><br>
                    <input type="time" class="form-control" id="hora" name="Hora" value=<?php echo $resultado['HORA'];?> min="09:00" max="18:00" required>
                </div>
            
                <button name="aceptar" type="submit" class="btn btn-primary btn-block">Aceptar</button>
                
            </form>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
    </div>

</div>

<?php
include_once('templates/terminar-html.php');
?>