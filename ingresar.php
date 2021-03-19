<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionIndex();

include_once('validarLog.php');

if (isset($_POST['ingresar'])) {
	$validar = new ValidarLogin(
		$_POST['Correo'],
		$_POST['Contrasena']
	);

	if ($validar->obtener_error() === '' && !is_null($validar->getResult())) {
		header('Location: /Proyecto/index-Clientes.php');
	}
}


include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<!-- form start -->
			<form class="form-container" id="form-ingreso" autocomplete="off" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

				<div class="title">
					<h1>Inicio de Sesión</h1>
				</div>

				<div class="form-group">
					<input name="Correo" type="email" class="form-control" required="" autofocus placeholder="Correo" <?php
																														if (isset($_POST['ingresar']) && isset($_POST['Correo']) && !empty($_POST['Correo'])) {
																															echo 'value="' . $_POST['Correo'] . '"';
																														}
																														?>>

				</div>

				<div class="form-group">
					<input name="Contrasena" type="password" class="form-control" required="" placeholder="Contraseña">
				</div>

				<?php
				if (isset($_POST['ingresar'])) {
					$validar->mostrar_error();
				}
				?>

				<button name="ingresar" type="submit" class="btn btn-primary btn-block">Inicia Sesión</button>
				<a href="recuperar_password.php">¿Olvidó su contraseña?</a>
			</form>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
	</div>
</div>
</div>


<?php
include_once('templates/terminar-html.php');
?>