<?php
require_once("../../Usuarios/Modelo/Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSession();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecniclcik</title>
</head>
<body>
    <h1>Inicio Tecnicos</h1>
    <h3>Bienvenido:  <?php echo $ModeloUsuarios->getNombre(); ?>
     - <?php echo $ModeloUsuarios->getPerfil(); ?></h3>
</body>
</html>


