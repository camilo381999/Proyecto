<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$idCita=$_GET['idCita'];
$idTecnico=$_GET['idTecnico'];
$NombreTecnico=$_GET['NombreTecnico'];
$tipoServicio=$_GET['tipoServicio'];
?>

<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12"></div>
        <div class="col-md-6 col-sm-4 col-xs-12">
            
            <!-- form start -->
            <form class="form-container2" autocomplete="off" method="POST" action="cl_controladorCalificacion.php">
            <div class="title">
                <h1>Califica a tu técnico</h1>
            </div>
            <div class="form-group">  

                <input type="text" name="idCita" hidden value="<?php echo $idCita; ?>">
                <input type="text" name="idTecnico" hidden value="<?php echo $idTecnico; ?>">
                <input type="text" name="NombreTecnico" hidden value="<?php echo $NombreTecnico; ?>">
                <input type="text" name="tipoServicio" hidden value="<?php echo $tipoServicio ?>">

                <p>
                ¿Como describiría la presentación personal del técnico?<br>
                <label><input type="radio" name="pregunta1" id="pregunta1" value="1" required>Excelente </label>
                <label><input type="radio" name="pregunta1" id="pregunta1" value="0.5">Regular </label>
                <label><input type="radio" name="pregunta1" id="pregunta1" value="0">Mala </label><br>
                </p>

                <p>
                ¿Que tan atento fue el técnico al prestar el servicio?<br>
                <label><input type="radio" name="pregunta2" id="pregunta2" value="1" required>Excelente</label>
                <label><input type="radio" name="pregunta2" id="pregunta2" value="0.5">Regular</label>
                <label><input type="radio" name="pregunta2" id="pregunta2" value="0">Malo</label><br>
                </p>

                <p>
                ¿Como calificaría la puntualidad del técnico?<br>
                <label><input type="radio" name="pregunta3" value="1" required>Excelente</label>
                <label><input type="radio" name="pregunta3" value="0.5">Regular</label>
                <label><input type="radio" name="pregunta3" value="0">Malo</label><br>
                </p>

                <p>
                ¿Como describiría los conocimientos del técnico para atender su requerimiento?<br>
                <label><input type="radio" name="pregunta4" value="1" required>Excelente   </label>
                <label><input type="radio" name="pregunta4" value="0.5">Regular   </label>
                <label><input type="radio" name="pregunta4" value="0">Malo   </label><br>
                </p>

                <p>
                ¿El técnico dió solución a su requerimiento?<br>
                <label><input type="radio" name="pregunta5" value="1" required>Si   </label>
                <label><input type="radio" name="pregunta5" value="0">No   </label><br>
                </p>

                <textarea name="comentario" class="form-control" placeholder="Añade un comentario sobre el técnico" cols="200" rows="3" required></textarea><br>

                <button name="enviar" type="submit" class="btn btn-primary btn-block">Enviar</button>
            </div>
            </form>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12"></div>
    </div>
</div>


<?php
//header('Location: index-Clientes.php');
include_once('templates/terminar-html.php');
?>