<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');
require_once('../Modelo/Docentes.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();

$Modelo = new Docentes();
$Id = $_GET['Id'];
$InformacionDocentes = $Modelo->getById($Id);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>Editar Docentes</h1>
	<form method="POST" action="../Controladores/edit.php">
		<input type="hidden" name="Id" value="<?php echo $Id; ?>">

		<?php 
			if ($InformacionDocentes != null) {
				foreach ($InformacionDocentes as $Info) {
		 ?>
		Nombre <br>
		<input type="text" name="Nombre" required="" placeholder="Nombre" autocomplete="off" value="<?php echo $Info['NOMBRE']; ?>"><br><br>
		Apellido <br>
		<input type="text" name="Apellido" required="" placeholder="Apellido" autocomplete="off" value="<?php echo $Info['APELLIDO']; ?>"><br><br>
		Usuario <br>
		<input type="text" name="Usuario" required="" placeholder="Usuario" autocomplete="off" value="<?php echo $Info['USUARIO']; ?>"><br><br>
		Password <br>
		<input type="password" name="Password" required="" placeholder="Password" autocomplete="off" value="<?php echo $Info['PASSWORD']; ?>"><br><br>
		Estado <br>
		<select name="Estado" required="">
			<option value="<?php echo $Info['ESTADO']; ?>"><?php echo $Info['ESTADO']; ?></option>
			<option value="Activo">Activo</option>
			<option value="Inactivo">Inactivo</option>
		</select><br><br> 
		<?php 
			}
		}
		?>
		<input type="submit" value="Editar Docente">
	</form>
</body>
</html>