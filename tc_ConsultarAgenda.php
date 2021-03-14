<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?> 

<h1>Consultar agenda</h1>

<?php
    include_once('templates/terminar-html.php');
?>