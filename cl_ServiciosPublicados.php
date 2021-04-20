<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
$idCliente = $ModeloUsuarios->getId();

//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

/* //script del alert
echo "<script> Swal.fire('¡Los perfiles que encuentra a continuación fueron los técnicos que aplicaron para atender su servicio, por favor seleccione el de su preferencia!');";
echo "</script>"; */
?>

<div class="container">

    <div class="publicacion-title">
        <br>
        <h1>Perfil de técnicos</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php

            $Modelo = new Publicacion();

            //Obtiene todas las publicaciones del cliente de tabla requerimientos
            $resultado = $Modelo->selectPublicacionXidCliente($idCliente);
            /* print_r($resultado); */

            if ($resultado != null) {

                //toma el id de cada post para consultarlo en la tabla de pendientes
                foreach ($resultado as $idpost) {
                    $servAceptado = $Modelo->consultarServiciosAceptados($idpost['ID_PUBLICACION']);

                    //toma cada servicio que exista sin importar el estado
                    foreach ($servAceptado as $dato) {
                        $tecnicos = $Modelo->informacionTecnico($dato['ID_TECNICO']);

                        //muestra el srvicio para aceptar un tecnico si el estado es pendiente
                        if ($dato['ESTADO_SERVICIO'] == "Pendiente") {
                            //script del alert
                            echo "<script> Swal.fire('¡Los perfiles que encuentra a continuación fueron los técnicos que aplicaron para atender su servicio, por favor seleccione el de su preferencia!');";
                            echo "</script>";
            ?>


                            <div class="card">
                                <h5 class="card-header"><?php echo $dato['TIPO_SERVICIO']; ?></h5>
                                <div class="card-body">
                                    <label>Técnico:</label>
                                   <u><a href="tc_comentarios.php?idTecnico=<?php echo $dato['ID_TECNICO']; ?>">
                                        <h5 class="card-title"><?php echo $tecnicos['NOMBRE'] . ' ' . $tecnicos['APELLIDO'] ?></h5>
                                    </a></u> 
                                    <?php
                                    if ($dato['CAMBIOS_TECNICO'] == "true") {
                                        echo "<div class='alert alert-primary' role='alert'>";
                                        echo "El técnico propone un cambio. Tu solicitud está para el " . $idpost['FECHA'] . " a las " . $idpost['HORA'];
                                        echo "</div>";
                                    }
                                    ?>
                                    <p class="card-text"><?php echo 'Localidad: ' . $tecnicos['LOCALIDAD'] ?></p>
                                    <p class="card-text"><?php echo 'Producto: ' . $idpost['TIPO']  . ' marca ' . $idpost['MARCA'] ?></p>
                                    <p class="card-text"><?php echo 'Correo: ' . $tecnicos['CORREO']  ?></p>
                                    <p class="card-text"><?php echo  'Teléfono: ' . $tecnicos['TELEFONO'] ?></p>
                                    <p class="card-text"><?php echo 'Calificación:  ' . $tecnicos['CALIFICACION'] ?></p>
                                    <p class="card-text"><?php echo 'Fecha y hora: ' . $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
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
                        } /* else {
                            //script del alert
                            echo "<script> Swal.fire('¡Ningún técnico ha aceptado tu solicitud por el momento, por favor revisa más tarde!').then(
                                function() {
                                    window.location.href = 'index.php';
                                });";
                            echo "</script>";
                        } */
                    }
                }
            }

            ?>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
    </div>

</div>

<?php
include_once('templates/terminar-html.php');
?>