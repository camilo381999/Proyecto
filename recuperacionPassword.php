<?php


include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();

$componentes_url = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_url['path'];

$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);

if ($partes_ruta[1] == 'recuperacionPassword.php') {
    $url_personal = $partes_ruta[2];
    $ruta_elegida = 'recuperacionPassword.php';
}
$result = $ModeloUsuarios->url_secreta_existe($url_personal);
if ($result != null) {
    $id = $result['ID_USUARIO'];
    echo 'El id de usuario es: ' . $id;
} else {
    echo '404';
}
 
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- form start -->
            <form class="form-container" id="form-ingreso" autocomplete="off" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                <div class="title">
                    <h1>Crea una nueva contraseña</h1>
                </div>

                <div class="form-group">
                    <input name="Contrasena1" type="password" class="form-control" required="" autofocus placeholder="Nueva contraseña">

                </div>

                <div class="form-group">
                    <input name="Contrasena2" type="password" class="form-control" required="" placeholder="Escribe de nuevo la contraseña">
                </div>

                <button name="enviar" type="submit" class="btn btn-primary btn-block">Cambiar contraseña</button>
            </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
</div>

<?php
include_once('templates/terminar-html.php');
?>