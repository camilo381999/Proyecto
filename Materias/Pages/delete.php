<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();

$Id = $_GET['Id'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>Eliminar Materia</h1>
	<form method="POST" action="../Controladores/delete.php">
		<input type="hidden" name="Id" value="<?php echo $Id; ?>">
		<p>¿Etás seguro de eliminar esta materia?</p>
		<input type="submit" value="Eliminar Materia">
	</form>
</body>
</html>