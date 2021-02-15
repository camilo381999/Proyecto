<?php 

require_once('../../Usuarios/Modelo/Usuarios.php');
require_once('../Modelo/Administradores.php');

$ModeloUsuarios = new Usuarios();
$ModeloUsuarios->validateSession();

$Modelo = new Administradores();
$Id = $_GET['Id'];
$InformacionAdministradores = $Modelo->getById($Id);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Notas</title>
</head>
<body>
	<h1>Editar Administrador</h1>
	<form method="POST" action="../Controladores/edit.php">
		<input type="hidden" name="Id" value="<?php echo $Id; ?>">

		<?php 
			if ($InformacionAdministradores != null) {
				foreach ($InformacionAdministradores as $Info) {
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
		<input type="submit" value="Editar Administrador">
	</form>
</body>
</html>