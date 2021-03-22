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
        <h1>Muro de publicaciones</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $Modelo = new Publicacion();
            $resultado = $Modelo->consultarPublicaciones();

            foreach ($resultado as $dato) {
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
            }
            ?>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
    </div>

</div>

<?php
include_once('templates/terminar-html.php');
?>