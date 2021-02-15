<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>Registrar Materia</h1>
	<form method="POST" action="../Controladores/add.php">
		Nombre <br>
		<input type="text" name="Nombre" required="" placeholder="Nombre" autocomplete="off"><br><br>
		<input type="submit" value="Registrar Materia">
	</form>
</body>
</html>