<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
$idTecnico= $ModeloUsuarios->getId();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container">

    <div class="publicacion-title">
        <br>
        <h1>Muro de publicaciones</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $Modelo = new Publicacion();
            
            //retorna todos los datos de la tabla "requerimientos"
            $resultado = $Modelo->consultarPublicaciones();
            
            //a cada fila de requerimientos la llama dato
            foreach ($resultado as $dato) {

                //comprueba si en pendientes ya existe un servicio aceptado por el tecnico
                $postEnPendientesTecnico=$Modelo->selectPendienteByIdPost($dato['ID_PUBLICACION'], $idTecnico);
                $postEnPendientes=$Modelo->getPendienteXIdPost($dato['ID_PUBLICACION']);
                
                //si el arreglo es vacio significa que el tecnico no ha aceptado ese servicio 
                if($postEnPendientesTecnico==null){

                    //si el arreglo es diferente de vacio significa que el estado es pendiente y ningun tecnico ha sido agendado para este servicio
                    if($postEnPendientes == null || $postEnPendientes['ESTADO_SERVICIO'] == "Pendiente"){
            ?>
                <div class="card">
                    <h5 class="card-header"><?php echo $dato['SERVICIO']; ?></h5>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $dato['CLIENTE'] . ', ' . $dato['LOCALIDAD'] ?></h5>
                        <p class="card-text"><?php echo $dato['TIPO'] . ' marca ' . $dato['MARCA'] ?></p>
                        <p class="card-text"><?php echo $dato['DESCRIPCION'] ?></p>
                        <p class="card-text"><?php echo $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
                        
                        <a href="tc_controladorServicios.php?Id=<?php echo $dato['ID_PUBLICACION'];?>&
                        Boton=<?php echo "false";?>&
                        Fecha=<?php echo $dato['FECHA'];?>&
                        Hora=<?php echo $dato['HORA'];?>&
                        Ubicacion=<?php echo $dato['LOCALIDAD'];?>" class="btn btn-primary">Aceptar</a>
                        
                        <a href="tc_cambiosFechaHora.php?Id=<?php echo $dato['ID_PUBLICACION'];?>&
                        Fecha=<?php echo $dato['FECHA'];?>&
                        Hora=<?php echo $dato['HORA'];?>&" class="btn btn-primary">
                            Proponer otro horario
                        </a>
                    </div>
                </div><br>

            <?php            
                    }/*else{
                        echo "el servicio no lo puede tomar 2 ";
                        echo $dato['ID_PUBLICACION'];
                        echo "<br>";
                    }*/
                }/*else{
                    echo "el servicio no lo puede tomar 1 ";
                    echo $dato['ID_PUBLICACION'];
                    echo "<br>";
                }*/
            }
            ?>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
    </div>

</div>

<?php
include_once('templates/terminar-html.php');
?>