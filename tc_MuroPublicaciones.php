<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSession();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?> 

<div class="container">
    <h1>Muro de publicaciones</h1>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <?php
                $Modelo = new Publicacion();
                $resultado= $Modelo->consultarPublicaciones(); 

                foreach($resultado as $dato) {
            ?>
                    <div class="card">    
                        <h5 class="card-header"><?php echo $dato['SERVICIO']; ?></h5>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $dato['CLIENTE']. ', ' .$dato['LOCALIDAD'] ?></h5>
                            <p class="card-text"><?php echo $dato['TIPO']. ' marca ' .$dato['MARCA'] ?></p>
                            <p class="card-text"><?php echo $dato['DESCRIPCION']?></p>
                            <p class="card-text"><?php echo $dato['FECHA']. ' / ' .$dato['HORA'] ?></p>
                            <a href="#" class="btn btn-primary">Aceptar</a>
                        </div>
                    </div><br>
            <?php
                }
            ?>
        </div>
        
    </div>

</div>

<?php
    include_once('templates/terminar-html.php');
?>