<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

 //script del alert
 echo "<script> Swal.fire('¡Estos son los servicios que usted ha agendado!');";
 echo "</script>";
?>

<div class="container">
    <div class="publicacion-title">
        <br>
        <h1>Servicios activos</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $Modelo = new Publicacion();
            $idCliente = $ModeloUsuarios->getId();
            $usuarioInfo = $ModeloUsuarios->getById($idCliente);
            $resultado = $Modelo->selectAceptadosPendienteByIdCliente($idCliente);
            //print_r($resultado);
            echo "<br>";
            if ($resultado != null) {
                foreach ($resultado as $idpost) {

                    $servAceptado = $Modelo->getPublicacionByidPost($idpost['REQUERIMIENTOS_ID_PUBLICACION']);
                    //print_r($servAceptado);
                    $tecnico = $Modelo->informacionTecnico($idpost['ID_TECNICO']);
                    foreach ($servAceptado as $dato) {

            ?>
                        <div class="card">
                            <h5 class="card-header"><?php echo "Servicio de " . $idpost['TIPO_SERVICIO']; ?></h5>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo 'Técnico: ' . $idpost['NOMBRE_TECNICO']  ?></h5>
                                <p class="card-text"><?php echo  'Localidad: ' . $idpost['LOCALIDAD']; ?></p>
                                <p class="card-text"><?php echo  'Correo: ' . $idpost['CORREO_TECNICO']; ?></p>
                                <p class="card-text"><?php echo  'Teléfono: ' . $tecnico['TELEFONO']; ?></p>
                                <p class="card-text"><?php echo 'Producto: ' . $dato['TIPO'] . ' marca ' . $dato['MARCA']; ?></p>
                                <p class="card-text"><?php echo 'Fecha y hora: ' . $dato['FECHA'] . ' / ' . $dato['HORA']; ?></p>
                                <p class="card-text"><?php
                                                        if ($idpost['TIPO_SERVICIO'] == "Mantenimiento") {
                                                            echo "Costo del servicio: $30.000";
                                                        } else {
                                                            echo "Costo del servicio: $40.000";
                                                        }

                                                        ?></p>
                                <?php
                                echo "<br>";
                                ?>
                                <a href="cl_controladorCancelar.php?Fecha=<?php echo $dato['FECHA']; ?>&
                            Hora=<?php echo $dato['HORA']; ?>&
                            idPendiente=<?php echo $idpost['ID_PENDIENTE']; ?>&
                            Correo=<?php echo $idpost['CORREO_TECNICO']; ?>" class="btn btn-primary">Cancelar</a>

                            </div>
                        </div><br>

            <?php }
                }
            }else{
                //script del alert
                echo "<script> Swal.fire('¡No hay servicios activos, por favor revisa más tarde!').then(
                    function() {
                        window.location.href = 'index.php';
                    });";
                echo "</script>";
            }

            ?>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
    </div>

</div>

<?php
include_once('templates/terminar-html.php');
?>