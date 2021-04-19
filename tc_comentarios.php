<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$idTecnico = $_GET['idTecnico'];

$publicacion = new Publicacion();
$resultado = $publicacion->get_comentarios_tecnico($idTecnico);

$usuario = new Usuarios();
$tecnico = $usuario->getByIdTecnico($idTecnico);

?>

<div class="container">
    <div class="publicacion-title">
        <br>
        <h1>Comentarios</h1>
    </div>

    <div class="publicacion-title">
        <h3><?php echo $tecnico['NOMBRE'] . " " . $tecnico['APELLIDO'] . ", calificación: " . $tecnico['CALIFICACION'] ?></h3>
        <br>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-12 col-xs-12"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <?php

            
            if (is_null($resultado)) {
                echo "No hay comentarios";
            } else {
                foreach ($resultado as $dato) {
                    $cliente = $usuario->getById($dato['ID_CLIENTE']);
                    if (!is_null($cliente)) {
            ?>
                        <div class="card">
                            <h5 class="card-header"><?php echo $cliente['NOMBRE'] . " " . $cliente['APELLIDO']; ?></h5>
                            <div class="card-body">
                                <h6 class="card-title"><?php echo "Calificación: " . $dato['CALIFICACION'] ?></h6>
                                <h6 class="card-title"><?php echo "Comentario: " ?></h6>
                                <p class="card-text"><?php echo $dato['COMENTARIO'] ?></p>
                                <p class="card-text"><?php echo "Fecha del comentario: ".$dato['Fecha'] ?></p>
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