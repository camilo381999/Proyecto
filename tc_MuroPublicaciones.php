<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
$idTecnico = $ModeloUsuarios->getId();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container">

    <div class="publicacion-title">
        <br>
        <h1>Muro de servicios</h1>
        <br>
    </div>

    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-Todas" data-toggle="pill" href="#Todas" role="tab" aria-controls="Todas" aria-selected="true">Todas</a>
        </li>
        <?php

        $Modelo = new Publicacion();
        $tipos = array('Todas');
        //retorna todos los datos de la tabla "requerimientos"
        $resultado = $Modelo->consultarPublicaciones();
        //a cada fila de requerimientos la llama dato
        foreach ($resultado as $dato) {
            $contador = 0;

            //comprueba si en pendientes ya existe un servicio aceptado por el tecnico
            $postEnPendientesTecnico = $Modelo->selectPendienteByIdPost($dato['ID_PUBLICACION'], $idTecnico);
            $postEnPendientes = $Modelo->getPendienteXIdPost($dato['ID_PUBLICACION']);

            //si el arreglo es vacio significa que el tecnico no ha aceptado ese servicio 
            if ($postEnPendientesTecnico == null) {

                //si el arreglo es diferente de vacio significa que el estado es pendiente y ningun tecnico ha sido agendado para este servicio
                if ($postEnPendientes == null || $postEnPendientes['ESTADO_SERVICIO'] == "Pendiente") {

                    foreach ($tipos as $tipo) {
                        if ($dato['TIPO'] == $tipo) {
                            $contador++;
                            //print_r("entra ");
                        }
                    }

                    if ($contador == 0) {
                        //$tipos->add($dato['TIPO']);
                        array_push($tipos, $dato['TIPO']);
                    }
                }/*  else {
                    //script del alert
                    echo "<script> Swal.fire('¡No hay servicios publicados, por favor revisa más tarde!').then(
                            function() {
                                window.location.href = 'index.php';
                            });";
                    echo "</script>";
                } */
            }
        }
        //print_r($tipos);
        foreach ($tipos as $tipo) {
            if ($tipo != 'Todas') {
        ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link " id="pills-<?php if ($tipo == 'Aire acondicionado') {
                                                        echo 'Aire';
                                                    } else if ($tipo == 'Campana extractora') {
                                                        echo 'Campana';
                                                    } else {
                                                        echo $tipo;
                                                    } ?>" href="#<?php if ($tipo == 'Aire acondicionado') {
                                                                        echo 'Aire';
                                                                    } else if ($tipo == 'Campana extractora') {
                                                                        echo 'Campana';
                                                                    } else {
                                                                        echo $tipo;
                                                                    } ?>" data-toggle="pill" role="tab" aria-controls="<?php if ($tipo == 'Aire acondicionado') {
                                                                                                            echo 'Aire';
                                                                                                        } else if ($tipo == 'Campana extractora') {
                                                                                                            echo 'Campana';
                                                                                                        } else {
                                                                                                            echo $tipo;
                                                                                                        } ?>" aria-selected="false"><?php echo $tipo ?></a>
                </li>

        <?php
            }
        }
        ?>
    </ul><br>
    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="Todas" role="tabpanel" aria-labelledby="pills-Todas">
                    <?php
                    //retorna todos los datos de la tabla "requerimientos"
                    $resultado = $Modelo->consultarPublicaciones();

                    //a cada fila de requerimientos la llama dato
                    foreach ($resultado as $dato) {

                        //comprueba si en pendientes ya existe un servicio aceptado por el tecnico
                        $postEnPendientesTecnico = $Modelo->selectPendienteByIdPost($dato['ID_PUBLICACION'], $idTecnico);
                        $postEnPendientes = $Modelo->getPendienteXIdPost($dato['ID_PUBLICACION']);

                        //si el arreglo es vacio significa que el tecnico no ha aceptado ese servicio 
                        if ($postEnPendientesTecnico == null) {

                            //si el arreglo es diferente de vacio significa que el estado es pendiente y ningun tecnico ha sido agendado para este servicio
                            if ($postEnPendientes == null || $postEnPendientes['ESTADO_SERVICIO'] == "Pendiente") {
                    ?>
                                <div class="card">
                                    <h5 class="card-header"><?php echo $dato['SERVICIO']; ?></h5>
                                    <div class="card-body">
                                        <label>Cliente:</label>
                                        <h5 class="card-title"><?php echo $dato['CLIENTE'] ?></h5>
                                        <p class="card-text"><?php echo 'Localidad: ' . $dato['LOCALIDAD'] ?></p>
                                        <p class="card-text"><?php echo 'Producto: ' . $dato['TIPO'] . ' marca ' . $dato['MARCA'] ?></p>
                                        <p class="card-text"><?php echo 'Descripción: ' . $dato['DESCRIPCION'] ?></p>
                                        <p class="card-text"><?php echo 'Fecha y hora: ' . $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
                                        <p class="card-text"><?php
                                                                if ($dato['SERVICIO'] == "Mantenimiento") {
                                                                    echo "Costo del servicio: $30.000";
                                                                } else {
                                                                    echo "Costo del servicio: $40.000";
                                                                }
                                                                ?></p>

                                        <a href="tc_controladorServicios.php?Id=<?php echo $dato['ID_PUBLICACION']; ?>&
                        Boton=<?php echo "false"; ?>&
                        Fecha=<?php echo $dato['FECHA']; ?>&
                        Hora=<?php echo $dato['HORA']; ?>&
                        Ubicacion=<?php echo $dato['LOCALIDAD']; ?>" class="btn btn-primary">Aceptar</a>

                                        <a href="tc_cambiosFechaHora.php?Id=<?php echo $dato['ID_PUBLICACION']; ?>&
                        Fecha=<?php echo $dato['FECHA']; ?>&
                        Hora=<?php echo $dato['HORA']; ?>&" class="btn btn-primary">
                                            Proponer otro horario
                                        </a>
                                    </div>
                                </div><br>

                    <?php
                            }
                        }
                    }
                    ?>
                </div>
                <?php
                foreach ($tipos as $tipo) {
                    if ($tipo != 'Todas') {
                ?>
                        <div class="tab-pane fade" id="<?php if ($tipo == 'Aire acondicionado') {
                                                            echo 'Aire';
                                                        } else if ($tipo == 'Campana extractora') {
                                                            echo 'Campana';
                                                        } else {
                                                            echo $tipo;
                                                        } ?>" role="tabpanel" aria-labelledby="pills-<?php if ($tipo == 'Aire acondicionado') {
                                                                                                            echo 'Aire';
                                                                                                        } else if ($tipo == 'Campana extractora') {
                                                                                                            echo 'Campana';
                                                                                                        } else {
                                                                                                            echo $tipo;
                                                                                                        } ?>">
                            <?php
                            $result = $Modelo->get_tipo_producto($tipo);
                            //print_r($result);
                            foreach ($result as $dato) {
                                //comprueba si en pendientes ya existe un servicio aceptado por el tecnico
                                $postEnPendientesTecnico = $Modelo->selectPendienteByIdPost($dato['ID_PUBLICACION'], $idTecnico);
                                $postEnPendientes = $Modelo->getPendienteXIdPost($dato['ID_PUBLICACION']);

                                //si el arreglo es vacio significa que el tecnico no ha aceptado ese servicio 
                                if ($postEnPendientesTecnico == null) {

                                    //si el arreglo es diferente de vacio significa que el estado es pendiente y ningun tecnico ha sido agendado para este servicio
                                    if ($postEnPendientes == null || $postEnPendientes['ESTADO_SERVICIO'] == "Pendiente") {
                            ?>
                                        <div class="card">
                                            <h5 class="card-header"><?php echo $dato['SERVICIO']; ?></h5>
                                            <div class="card-body">
                                                <label>Cliente:</label>
                                                <h5 class="card-title"><?php echo $dato['CLIENTE'] ?></h5>
                                                <p class="card-text"><?php echo 'Localidad: ' . $dato['LOCALIDAD'] ?></p>
                                                <p class="card-text"><?php echo 'Producto: ' . $dato['TIPO'] . ' marca ' . $dato['MARCA'] ?></p>
                                                <p class="card-text"><?php echo 'Descripción: ' . $dato['DESCRIPCION'] ?></p>
                                                <p class="card-text"><?php echo 'Fecha y hora: ' . $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
                                                <p class="card-text"><?php
                                                                        if ($dato['SERVICIO'] == "Mantenimiento") {
                                                                            echo "Costo del servicio: $30.000";
                                                                        } else {
                                                                            echo "Costo del servicio: $40.000";
                                                                        }
                                                                        ?></p>

                                                <a href="tc_controladorServicios.php?Id=<?php echo $dato['ID_PUBLICACION']; ?>&
                                                    Boton=<?php echo "false"; ?>&
                                                    Fecha=<?php echo $dato['FECHA']; ?>&
                                                    Hora=<?php echo $dato['HORA']; ?>&
                                                    Ubicacion=<?php echo $dato['LOCALIDAD']; ?>" class="btn btn-primary">Aceptar</a>

                                                <a href="tc_cambiosFechaHora.php?Id=<?php echo $dato['ID_PUBLICACION']; ?>&
                                                    Fecha=<?php echo $dato['FECHA']; ?>&
                                                    Hora=<?php echo $dato['HORA']; ?>&" class="btn btn-primary">
                                                    Proponer otro horario
                                                </a>
                                            </div>
                                        </div><br>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12"></div>
        </div>
    </div>
</div>

<?php
include_once('templates/terminar-html.php');
?>