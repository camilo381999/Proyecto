<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico

if ($ModeloUsuarios->getPerfil() == 'Usuario') {
    $ModeloUsuarios->validateSessionClientes();
} else {
    $ModeloUsuarios->validateSessionTecnicos();
}

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

if (isset($_POST['enviar'])) {
    $Modelo = new Publicacion();
    if ($Modelo->añadirPqr($_POST['Correo'], $_POST['Asunto'], $_POST['Descripcion'], $_POST['Nombre'])) {

        //script del alert
        echo "<script> Swal.fire({
                title: 'Solicitud enviada',
                text: 'Próximamente alguien se comunicará con usted!',
              }).then(
                function() {
                    window.location.href = 'index.php';
                });";
        echo "</script>";
    }
}
?>

<div class="publicacion-title">
    <br>
    <h1>PQRs</h1>
    <br>
    <h3>Hola <?php echo $ModeloUsuarios->getNombre(); ?></h3>
    <h2>¿Con qué podemos ayudarte?</h2>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- form start -->
            <form class="form-container2" autocomplete="off" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                <div class="title">
                    <h1>Enviar una solicitud</h1>
                </div>

                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input name="Correo" type="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>¿Cómo podemos ayudarte?</label>
                    <select name="Asunto" class="form-control" required>
                        <option selected>-</option>
                        <option value="Tengo una duda acerca de mi cuenta">Tengo una duda acerca de mi cuenta</option>
                        <option value="Tengo problemas con un técnico">Tengo problemas con un técnico</option>
                        <option value="Tengo problemas con un cliente">Tengo problemas con un cliente</option>
                        <option value="Tengo problemas con la aplicación">Tengo problemas con la aplicación</option>
                        <option value="Tengo problemas con la cuenta">Tengo problemas con la cuenta</option>
                        <option value="Quiero reportar un problema técnico">Quiero reportar un problema técnico</option>
                        <option value="Sugerencias">Sugerencias</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="Descripcion" class="form-control" cols="200" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label>Nombre</label>
                    <input name="Nombre" type="text" class="form-control" required>
                </div>

                <button name="enviar" type="submit" class="btn btn-primary btn-block">Enviar</button>
            </form>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
    </div>
</div>

<?php
include_once('templates/terminar-html.php');
?>