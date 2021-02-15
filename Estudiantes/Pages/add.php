<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');
require_once('../../Metodos.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();

$ModeloMetodos = new Metodos();

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>Registrar estudiante</h1>
	<form method="POST" action="../Controladores/add.php">
		Nombre <br>
		<input type="text" name="Nombre" required="" placeholder="Nombre" autocomplete="off"><br><br>
		Apellido <br>
		<input type="text" name="Apellido" required="" placeholder="Apellido" autocomplete="off"><br><br>
		Documento <br>
		<input type="text" name="Documento" required="" placeholder="Documento" autocomplete="off"><br><br>
		Correo <br>
		<input type="email" name="Correo" required="" placeholder="Correo" autocomplete="off"><br><br>
		Materia <br>
		<select name="Materia" required="">
			<option>Seleccione</option>
			<?php 
				$Materias = $ModeloMetodos->getMaterias();
				if ($Materias != null) {
					foreach ($Materias as $Materia) {
			 ?>
			 <option><?php echo $Materia['MATERIA']; ?></option>
			<?php 
				}
			}
			 ?>

		</select> <br><br>
		Docente <br>
		<select name="Docente" required="">
			<option>Seleccione</option>
			<?php 
				$Docentes = $ModeloMetodos->getDocentes();
				if ($Docentes != null) {
					foreach ($Docentes as $Docente) {
			 ?>
			 <option><?php echo $Docente['NOMBRE'] . ' '. $Docente['APELLIDO']; ?></option>
			<?php 
				}
			}
			 ?>
		</select><br><br>
		Promedio <br>
		<input type="number" name="Promedio" required="" placeholder="Promedio" autocomplete="off"><br><br>
		<input type="submit" value="Registrar Estudiante">
	</form>
</body>
</html>