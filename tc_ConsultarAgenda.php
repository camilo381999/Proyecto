<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>
<div class="container">

    <div class="publicacion-title">
        <br>
        <h1>Consultar agenda</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $Modelo = new Publicacion();
            $resultado = $Modelo->get_agenda($ModeloUsuarios->getId());
            if (is_null($resultado)) {
                echo "No hay servicios";
            } else {
                foreach ($resultado as $dato) {
                    $pendiente = $Modelo->get_pendiente_by_Id($dato['PENDIENTE_ID_PENDIENTE']);
                    $requerimiento = $Modelo->publicacion($pendiente['ID_CLIENTE'], $pendiente['REQUERIMIENTOS_ID_PUBLICACION']);
                    $cliente = $ModeloUsuarios->getById($pendiente['ID_CLIENTE']);
            ?>
                    <div class="card">
                        <h5 class="card-header"><?php echo $pendiente['TIPO_SERVICIO'] ?></h5>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $cliente['NOMBRE'] . ' ' . $cliente['APELLIDO'] . ', ' . $dato['UBICACION'] ?></h5>
                            <p class="card-text"><?php echo "Teléfono: " . $cliente['TELEFONO'] ?></p>
                            <p class="card-text"><?php echo "Dirección: " . $requerimiento['DIRECCION'] ?></p>
                            <p class="card-text"><?php echo $requerimiento['TIPO'] . ' marca ' . $requerimiento['MARCA'] ?></p>
                            <p class="card-text"><?php echo "Descripción: " . $requerimiento['DESCRIPCION'] ?></p>
                            <p class="card-text"><?php echo $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
                            <p class="card-text"><?php
                                                    if ($pendiente['TIPO_SERVICIO'] == "Mantenimiento") {
                                                        echo "Costo del servicio: $30.000";
                                                    } else {
                                                        echo "Costo del servicio: $40.000";
                                                    }

                                                    ?></p>
                            <p class="card-text"><?php echo $dato['ESTADO'] ?></p>

                            <a href="tc_ServicioTerminado.php?Id=<?php echo $dato['ID_CITA']; ?>&IdPendiente=<?php echo $dato['PENDIENTE_ID_PENDIENTE']; ?>" class="btn btn-primary">
                                Terminar servicio
                            </a>

                            <a href="cl_controladorCancelar.php?Fecha=<?php echo $dato['FECHA']; ?>&
                            Hora=<?php echo $dato['HORA']; ?>&
                            idPendiente=<?php echo $dato['PENDIENTE_ID_PENDIENTE']; ?>" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div><br>
            <?php
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