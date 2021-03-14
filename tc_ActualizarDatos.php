<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="publicacion-title">
    <br>
    <h1>Actualizar datos</h1>
    <br>
</div>

<?php
include_once('templates/terminar-html.php');
?>