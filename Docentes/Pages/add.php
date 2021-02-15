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
	<h1>Registrar Docente</h1>
	<form method="POST" action="../Controladores/add.php">
		Nombre <br>
		<input type="text" name="Nombre" required="" placeholder="Nombre" autocomplete="off"><br><br>
		Apellido <br>
		<input type="text" name="Apellido" required="" placeholder="Apellido" autocomplete="off"><br><br>
		Usuario <br>
		<input type="text" name="Usuario" required="" placeholder="Usuario" autocomplete="off"><br><br>
		Password <br>
		<input type="password" name="Password" required="" placeholder="Password" autocomplete="off"><br><br>
		<input type="submit" value="Registrar Docente">
	</form>
</body>
</html>