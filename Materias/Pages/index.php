<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');
require_once('../Modelo/Materias.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSessionAdministrador();

$Modelo = new Materias();

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>
		<a href="#">Materias</a>-
		<a href="../../Docentes/Pages/index.php">Docentes</a>-
		<a href="../../Administradores/Pages/index.php">Administradores</a>-
		<a href="../../Estudiantes/Pages/index.php">Estudiantes</a>-
		<a href="../../Usuarios/Controladores/Salir.php">Salir</a>
	</h1>
	<h3>Bienvenido:  <?php echo $ModeloUsuarios->getNombre(); ?> - <?php echo $ModeloUsuarios->getPerfil(); ?></h3>
	<a href="add.php" target="_blank">Registrar Materia</a><br><br>
	<table border="1">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Acciones</th> 
		</tr>
		<?php 
				$Materias = $Modelo->get();
				if ($Materias != null) {
					foreach ($Materias as $Materia) {
			 ?>
		<tr>
			<td><?php echo $Materia['ID_MATERIA']; ?></td>
			<td><?php echo $Materia['MATERIA']; ?></td> 
			
			<td>
				<a href="edit.php?Id=<?php echo $Materia['ID_MATERIA']; ?>" target="_blank">Editar</a>
				<a href="delete.php?Id=<?php echo $Materia['ID_MATERIA']; ?>" target="_blank">Eliminar</a>
			</td>
		</tr>
		<?php 
				}
			}
			 ?>
	</table>
</body>
</html>