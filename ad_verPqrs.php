<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionAdmin();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

?>

<div class="container">
    <div class="publicacion-title">
        <br>
        <h1>PQRs</h1>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php
            $publicacion = new Publicacion();
            $pqrs = $publicacion->get_pqrs();
            if (!is_null($pqrs)) {
                foreach ($pqrs as $pqr) {
            ?>
                    <div class="card">
                        <h5 class="card-header"><?php echo $pqr['NOMBRE']; ?></h5>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $pqr['SELECCION_AYUDA']  ?></h5>
                            <p class="card-text"><?php echo  'Descripción: ' . $pqr['DESCRIPCION']; ?></p>
                            <p class="card-text"><?php echo 'Correo: ' . $pqr['CORREO']; ?></p>

                            <?php
                            echo "<br>";
                            ?>
                            <a href="controladorPqr.php?Id=<?php echo $pqr['ID_PQR']; ?>" class="btn btn-primary">Respondido</a>
                        </div>
                    </div><br>

            <?php
                }
            }else{
                echo "<script> Swal.fire('¡No hay pqrs por el momento!').then(
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