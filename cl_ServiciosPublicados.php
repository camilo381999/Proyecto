<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
$idCliente = $ModeloUsuarios->getId();

//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container">

    <div class="publicacion-title">
        <br>
        <h1>Servicios Publicados</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php

            $Modelo = new Publicacion();

            //Obtiene todas las publicaciones del cliente de tabla requerimientos
            $resultado = $Modelo->selectPublicacionXidCliente($idCliente);
            //print_r($resultado);

            echo "<br>";
            if ($resultado != null) {

                //toma el id de cada post para consultarlo en la tabla de pendientes
                foreach ($resultado as $idpost) {
                    $servAceptado = $Modelo->consultarServiciosAceptados($idpost['ID_PUBLICACION']);

                    //toma cada servicio que exista sin importar el estado
                    foreach ($servAceptado as $dato) {
                        $tecnicos = $Modelo->informacionTecnico($dato['ID_TECNICO']);

                        //muestra el srvicio para aceptar un tecnico si el estado es pendiente
                        if ($dato['ESTADO_SERVICIO'] == "Pendiente") {
                            /*echo $dato['ESTADO_SERVICIO'];*/ ?>
                            <div class="card">
                                <h5 class="card-header"><?php echo $dato['TIPO_SERVICIO']; ?></h5>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $tecnicos['NOMBRE'] . ' ' . $tecnicos['APELLIDO'] . ', ' . $tecnicos['LOCALIDAD'] ?></h5>
                                    <p class="card-text"><?php echo $dato['ID_TECNICO'] . ' - ' . $dato['ESTADO_SERVICIO'] ?></p>
                                    <p class="card-text"><?php echo $tecnicos['CORREO']  ?></p>
                                    <p class="card-text"><?php echo  '  Teléfono: ' . $tecnicos['TELEFONO'] ?></p>
                                    <p class="card-text"><?php echo '  Calificación:  ' . $tecnicos['CALIFICACION'] ?></p>
                                    <p class="card-text"><?php echo ' C.C: ' . $tecnicos['ID_TECNICO'] ?></p>
                                    <p class="card-text"><?php echo $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
                                    <p class="card-text"><?php
                                                            if ($dato['TIPO_SERVICIO'] == "Mantenimiento") {
                                                                echo "Costo del servicio: $30.000";
                                                            } else {
                                                                echo "Costo del servicio: $40.000";
                                                            }

                                                            ?></p>

                                    <a href="cl_controladorAceptar.php?IdTecnico=<?php echo $dato['ID_TECNICO']; ?>&
                                Fecha=<?php echo $dato['FECHA']; ?>&
                                Hora=<?php echo $dato['HORA']; ?>&
                                idPublicacion=<?php echo $idpost['ID_PUBLICACION']; ?>&
                                Servicio=<?php echo $dato['TIPO_SERVICIO']; ?>" class="btn btn-primary">Aceptar</a>

                                </div>
                            </div><br>

            <?php
                        }
                    }
                }
            } ?>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
    </div>

</div>

<?php
include_once('templates/terminar-html.php');
?>