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
        <h1>Historial de Servicios</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $Modelo = new Publicacion();
            $resultado = $Modelo->get_agenda_historial($ModeloUsuarios->getId());
            if (is_null($resultado)) {
                echo "No hay servicios";
            } else {
                foreach ($resultado as $dato) {
                    $pendiente = $Modelo->get_pendiente_by_Id($dato['PENDIENTE_ID_PENDIENTE']);
                    $requerimiento = $Modelo->publicacion($pendiente['ID_CLIENTE'], $pendiente['REQUERIMIENTOS_ID_PUBLICACION']);
            ?>
                    <div class="card">
                        <h5 class="card-header"><?php echo $pendiente['TIPO_SERVICIO'] ?></h5>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo 'Localidad: '. $dato['UBICACION'] ?></h5>
                            <p class="card-text"><?php echo 'Producto: '. $requerimiento['TIPO'] . ' marca ' . $requerimiento['MARCA'] ?></p>
                            <p class="card-text"><?php echo "Descripción: " . $requerimiento['DESCRIPCION'] ?></p>
                            <p class="card-text"><?php echo 'Fecha y hora: '. $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
                            <p class="card-text"><?php
                                                    if ($pendiente['TIPO_SERVICIO'] == "Mantenimiento") {
                                                        echo "Costo del servicio: $30.000";
                                                    } else {
                                                        echo "Costo del servicio: $40.000";
                                                    }

                                                    ?></p>
                            <p class="card-text"><?php echo 'Estado: '. $dato['ESTADO'] ?></p>
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