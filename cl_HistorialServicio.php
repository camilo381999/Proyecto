<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>


<div class="container">
    <div class="publicacion-title">
        <br>
        <h1>Historial de servicios</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $Modelo = new Publicacion();
            //trae los servicios que tenga con el id del cliente en la tabla pendientes
            $resultado = $Modelo->get_pendiente_idClient($ModeloUsuarios->getId());
            if (is_null($resultado)) {
                echo "No hay servicios";
            } else {
                foreach ($resultado as $dato) {
                    $agenda = $Modelo->get_agenda_historial_cliente($dato['ID_PENDIENTE']);
                    if (!is_null($agenda)) {
                        $requerimiento = $Modelo->publicacion($dato['ID_CLIENTE'], $dato['REQUERIMIENTOS_ID_PUBLICACION']);
            ?>
                        <div class="card">
                            <h5 class="card-header"><?php echo $dato['TIPO_SERVICIO'] ?></h5>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $agenda['UBICACION'] ?></h5>
                                <p class="card-text"><?php echo $dato['NOMBRE_TECNICO'] ?></p>
                                <p class="card-text"><?php echo $requerimiento['TIPO'] . ' marca ' . $requerimiento['MARCA'] ?></p>
                                <p class="card-text"><?php echo "Descripción: " . $requerimiento['DESCRIPCION'] ?></p>
                                <p class="card-text"><?php echo $agenda['FECHA'] . ' / ' . $agenda['HORA'] ?></p>
                                <p class="card-text"><?php echo $agenda['ESTADO'] ?></p>
                            </div>
                        </div><br>
            <?php
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