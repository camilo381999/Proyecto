<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');
require_once('../Modelo/Estudiantes.php');
require_once('../../Metodos.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();

$Modelo = new Estudiantes();
$Id = $_GET['Id'];
$InformacionEstudiantes = $Modelo->getById($Id);

$Metodos = new Metodos();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>Editar estudiante</h1>
	<form method="POST" action="../Controladores/edit.php">
		<input type="hidden" name="Id" value="<?php echo $Id; ?>">
		<?php 
			if ($InformacionEstudiantes != null) {
				foreach ($InformacionEstudiantes as $Info) {
		 ?>
		Nombre <br>
		<input type="text" name="Nombre" required="" placeholder="Nombre" autocomplete="off" value="<?php echo $Info['NOMBRE']; ?>"><br><br>
		Apellido <br>
		<input type="text" name="Apellido" required="" placeholder="Apellido" autocomplete="off" value="<?php echo $Info['APELLIDO']; ?>"><br><br>
		Documento <br>
		<input type="text" name="Documento" required="" placeholder="Documento" autocomplete="off"  value="<?php echo $Info['DOCUMENTO']; ?>"><br><br>
		Correo <br>
		<input type="email" name="Correo" required="" placeholder="Correo" autocomplete="off"  value="<?php echo $Info['CORREO']; ?>"><br><br>
		Materia <br>
		<select name="Materia" required="">
			<option  value="<?php echo $Info['MATERIA']; ?>"><?php echo $Info['MATERIA']; ?></option>
				<?php 
				$Materias = $Metodos->getMaterias();
				if ($Materias != null) {
					foreach ($Materias as $Materia) {
			 ?>
			 <option value="<?php echo $Materia['MATERIA']; ?>"><?php echo $Materia['MATERIA']; ?></option>
			<?php 
				}
			}
			 ?>

		</select> <br><br>
		Docente <br>
		<select name="Docente" required="">
			<option  value="<?php echo $Info['DOCENTE']; ?>"><?php echo $Info['DOCENTE']; ?></option>
				<?php 
				$Docentes = $Metodos->getDocentes();
				if ($Docentes != null) {
					foreach ($Docentes as $Docente) {
			 ?>
			 <option value="<?php echo $Docente['NOMBRE'] . ' '. $Docente['APELLIDO']; ?>"><?php echo $Docente['NOMBRE'] . ' '. $Docente['APELLIDO']; ?></option>
			<?php 
				}
			}
			 ?>

		</select><br><br>
		Promedio <br>
		<input type="number" name="Promedio" required="" placeholder="Promedio" autocomplete="off"  value="<?php echo $Info['PROMEDIO']; ?>"><br><br>
		<?php 
			}
		}
		 ?>
		<input type="submit" value="Editar Estudiante">
	</form>
</body>
</html>