<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');
require_once('../Modelo/Estudiantes.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();

$Modelo = new Estudiantes();

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>

	<?php 
		if ($ModeloUsuarios->getPerfil() =='Docente') {
	 ?>
	<h1>
		<a href="#">Estudiantes</a>-
		<a href="../../Usuarios/Controladores/Salir.php">Salir</a>
	</h1>
	<?php 
		}else{
	 ?>
		<h1>
		<a href="#">Estudiantes</a>-
		<a href="../../Docentes/Pages/index.php">Docentes</a>-
		<a href="../../Materias/Pages/index.php">Materias</a>-
		<a href="../../Administradores/Pages/index.php">Administradores</a>-
		<a href="../../Usuarios/Controladores/Salir.php">Salir</a>
	</h1>
	<?php } ?>

	<h3>Bienvenido:  <?php echo $ModeloUsuarios->getNombre(); ?> - <?php echo $ModeloUsuarios->getPerfil(); ?></h3>

	<a href="add.php" target="_blank">Registrar Estudiante</a>
	<table border="1">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Documento</th>
			<th>Correo</th>
			<th>Materia</th>
			<th>Docente</th>
			<th>Promedio</th>
			<th>Fecha de Registro</th>
			<th>Acciones</th>
		</tr>

		<?php 
			$Estudiantes = $Modelo->get();
			if ($Estudiantes != null) {
				foreach ($Estudiantes as $Estudiante) {
		 ?>
		<tr>
			<td><?php echo $Estudiante['ID_ESTUDIANTE'];?></td>
			<td><?php echo $Estudiante['NOMBRE'];?></td>
			<td><?php echo $Estudiante['APELLIDO'];?></td>
			<td><?php echo $Estudiante['DOCUMENTO'];?></td>
			<td><?php echo $Estudiante['CORREO'];?></td>
			<td><?php echo $Estudiante['MATERIA'];?></td>
			<td><?php echo $Estudiante['DOCENTE'];?></td>
			<td><?php echo $Estudiante['PROMEDIO'];?></td>
			<td><?php echo $Estudiante['FECHA_REGISTRO'];?></td> 
			<td>
				<a href="edit.php?Id=<?php echo $Estudiante['ID_ESTUDIANTE']; ?>" target="_blank">Editar</a>
				<a href="delete.php?Id=<?php echo $Estudiante['ID_ESTUDIANTE']; ?>" target="_blank">Eliminar</a>
			</td>
		</tr>

		<?php 
			}
		}
		 ?>
	</table>
</body>
</html>