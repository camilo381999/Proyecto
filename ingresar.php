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
		header('Location: index-Clientes.php');
	}
}

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-sm-3 col-xs-12"></div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<!-- form start -->
			<form class="form-container" id="form-ingreso" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

				<div class="title">
					<h1>Inicio de Sesión</h1>
				</div>

				<div class="input-group">
					<input name="Correo" id="correo" type="email" class="form-control" required="" autofocus placeholder="Correo" <?php
																																	if (isset($_POST['ingresar']) && isset($_POST['Correo']) && !empty($_POST['Correo'])) {
																																		echo 'value="' . $_POST['Correo'] . '"';
																																	}
																																	?>>

					<img src="img/mail.png" id="mail">
				</div>
				<br>

				<div class="input-group">
					<input name="Contrasena" id="contrasena" type="password" class="form-control" required="" placeholder="Contraseña">
					<img src="img/abierto.png" id="ojo">
				</div>
				<br>
				<?php
				if (isset($_POST['ingresar'])) {
					$validar->mostrar_error();
				}
				?>
				<button name="ingresar" type="submit" class="btn btn-primary btn-block">Inicia Sesión</button>
				<a href="recuperar_password.php">¿Olvidó su contraseña?</a>
			</form>
		</div>
		<div class="col-md-4 col-sm-3 col-xs-12"></div>
	</div>
</div>

<script text="text/javascript">
	var ver = document.getElementById('ojo');
	var input = document.getElementById('contrasena');

	ver.addEventListener('click', mostrarContraseña);

	function mostrarContraseña() {
		if (input.type == "password") {
			input.type = "text";
			ver.src = "img/cerrado.png";
			setTimeout("cerrado()", 3000);
		} else {
			input.type = "password";
			ver.src = "img/abierto.png";
		}
	}

	function cerrado() {
		input.type = "password";
		ver.src = "img/abierto.png";
	}
</script>

<?php
include_once('templates/terminar-html.php');
?>