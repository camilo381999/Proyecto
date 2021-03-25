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
        <h1>Servicios Publicados</h1>
        <br>
    </div>
    
    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $Modelo = new Publicacion();
            $resultado = $Modelo->idPublicacion();
            if ($resultado != null) {
                $agenda = $Modelo->consultarServiciosAceptados($resultado['ID_PUBLICACION']);
                foreach ($agenda as $dato) {
                    $tecnicos = $Modelo->informacionTecnico($dato['ID_TECNICO']);
            ?>
                    <div class="card">
                        <h5 class="card-header"><?php echo $resultado['SERVICIO']; ?></h5>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $tecnicos['NOMBRE'] . ' ' . $tecnicos['APELLIDO'] . ', ' . $tecnicos['LOCALIDAD'] ?></h5>
                            <p class="card-text"><?php echo $dato['ID_TECNICO'] . ' - ' . $dato['ESTADO_SERVICIO'] ?></p>
                            <p class="card-text"><?php echo $tecnicos['CORREO']  ?></p>
                            <p class="card-text"><?php echo  '  Teléfono: ' . $tecnicos['TELEFONO'] ?></p>
                            <p class="card-text"><?php echo '  Calificación:  ' . $tecnicos['CALIFICACION'] ?></p>
                            <p class="card-text"><?php echo ' C.C: ' . $tecnicos['ID_TECNICO'] ?></p>
                            <p class="card-text"><?php echo $dato['FECHA'] . ' / ' . $dato['HORA'] ?></p>
                            <a href="cl_controladorAceptar.php?IdTecnico=<?php echo $dato['ID_TECNICO'];?>&
                            Fecha=<?php echo $dato['FECHA'];?>&
                            Hora=<?php echo $dato['HORA'];?>&
                            idPublicacion=<?php echo $resultado['ID_PUBLICACION'];?>" class="btn btn-primary">Aceptar</a>
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