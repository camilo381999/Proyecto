<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionCliente();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?> 
    <a href="Usuarios/Salir.php">Salir</a>
    
    <h1>Bienbenido</h1>
    <h3>Bienvenido x2:  <?php echo $ModeloUsuarios->getNombre(); ?>
     - <?php echo $ModeloUsuarios->getPerfil(); ?></h3>
<?php
    include_once('templates/terminar-html.php');
?>