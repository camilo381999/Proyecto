<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container">

    <div class="publicacion-title">
        <br>
        <h1>Bienvenido <?php echo $ModeloUsuarios->getNombre(); ?></h1>
        <h3>¿Qué deseas hacer?</h3>
        <br>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="cl_PublicarServicio.php" class="menu__option" id="btnPublicar">
                    <img class="option__image" src="img/icon-publicar.svg" alt="icon-publicar">
                    Publicar Servicio
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="cl_ServiciosPublicados.php" class="menu__option" id="btnPublicado">
                    <img class="option__image" src="img/icon-ConsultarPost.svg" alt="icon-publicar">
                    Perfiles de técnicos
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="cl_CancelarServicio.php" class="menu__option" id="btnCancelar">
                    <img class="option__image" src="img/icon-cancelar.svg" alt="icon-cancelar">
                    Servicios activos
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="cl_HistorialServicio.php" class="menu__option" id="btnHistorial">
                    <img class="option__image" src="img/icon-historial.svg" alt="icon-historial">
                    Historial de Servicios
                </a>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="cl_ActualizarDatos.php" class="menu__option" id="btnActualizar">
                    <img class="option__image" src="img/icon-actualizar.svg" alt="icon-actualizar">
                    Actualizar datos
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="main-menu__options">
                <a href="cl_PQRs.php" class="menu__option" id="btnPQRs">
                    <img class="option__image" src="img/icon-pqrs.svg" alt="icon-pqrs">
                    PQRs
                </a>
            </div>
        </div>
    </div>

</div>

<script>
Swal.fire({
    title: "Por favor califica a tu técnico",
    text: "Estas preguntas podrian ayudar a tu tecnico a mejorar su servicio",
    html: '<form action="<?php echo $_SERVER['PHP_SELF'] ?>" >'+
            '<div class="form-group">'+
                
                '<p>'+
                '¿Como describiría la presentacion personal del técnico?<br><br>'+
                '<label><input type="radio" name="pregunta1" id="pregunta1" value="1" required>Excelente </label>'+'    '+
                '<label><input type="radio" name="pregunta1" id="pregunta1" value="0.5">Regular </label>'+'    '+
                '<label><input type="radio" name="pregunta1" id="pregunta1" value="0">Mala </label><br>'+'    '+
                '</p>'+

                '<p>'+
                '¿Que tan atento fue el técnico al prestar el servicio?<br><br>'+
                '<label><input type="radio" name="pregunta2" value="1" required>Excelente</label>'+'    '+
                '<label><input type="radio" name="pregunta2" value="0.5">Regular</label>'+'    '+
                '<label><input type="radio" name="pregunta2" value="0">Malo</label><br>'+'    '+
                '</p>'+

                '<p>'+
                '¿Como calificaría la puntualidad del técnico?<br><br>'+
                '<label><input type="radio" name="pregunta3" value="1" required>Excelente</label>'+'    '+
                '<label><input type="radio" name="pregunta3" value="0.5">Regular</label>'+'    '+
                '<label><input type="radio" name="pregunta3" value="0">Malo</label><br>'+'    '+
                '</p>'+

                '<p>'+
                '¿Como describiría los conocimientos del tecnico para atender su requerimiento?<br><br>'+
                '<label><input type="radio" name="pregunta4" value="1" required>Excelente</label>'+'    '+
                '<label><input type="radio" name="pregunta4" value="0.5">Regular</label>'+'    '+
                '<label><input type="radio" name="pregunta4" value="0">Malo</label><br>'+'    '+
                '</p>'+

                '<p>'+
                '¿El técnico dió solución a su requerimiento?<br><br>'+
                '<label><input type="radio" name="pregunta5" value="1" required>Si</label>'+'    '+
                '<label><input type="radio" name="pregunta5" value="0">No</label><br>'+
                '</p>'+

                '<textarea name="comentario" class="form-control" placeholder="Añade un comentario sobre el tecnico" cols="200" rows="3" required></textarea>'+
            '</div>'+
          '</form>',
    preConfirm: () => {
        const pregunta1 = Swal.getPopup().querySelector('#pregunta1').value
        const pregunta2 = Swal.getPopup().querySelector('#pregunta2').value
        
        return { pregunta1: pregunta1, pregunta2: pregunta2 }
    }
}).then(
		function() {
			window.location.href = "cl_controladorCalificacion.php?pregunta1=$_GET['pregunta1']";
		});
</script>

<?php
include_once('templates/terminar-html.php');
?>