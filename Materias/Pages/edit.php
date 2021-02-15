<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');
require_once('../Modelo/Materias.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();

$Modelo = new Materias();
$Id = $_GET['Id'];
$InformacionMaterias = $Modelo->getById($Id);

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>Editar Materia</h1>
	<form method="POST" action="../Controladores/edit.php">
		<input type="hidden" name="Id" value="<?php echo $Id; ?>">
		<?php 
			if ($InformacionMaterias != null) {
				foreach ($InformacionMaterias as $Info) {
		 ?>
		Nombre <br>
		<input type="text" name="Nombre" required="" placeholder="Nombre Materia" autocomplete="off" value="<?php echo $Info['MATERIA']; ?>"><br><br>
		<?php 
			}
		}
		 ?>
		<input type="submit" value="Editar Materia">
	</form>
</body>
</html>