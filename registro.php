<?php
include_once('Usuarios.php');
$Modelo = new Usuarios();;
//Validar la sesion si es cliente o tecnico
$Modelo->validateSessionIndex();

include_once('validarReg.php');

//Si el usuario le da al boton registrar
if (isset($_POST['registrar'])) {

	//Se valida que todos los datos esten completos
	$validar = new ValidarRegistro(
		$_POST['Nombre'],
		$_POST['Apellido'],
		$_POST['Cedula'],
		$_POST['Correo'],
		$_POST['Telefono'],
		$_POST['Contrasena'],
		$_POST['Localidad']
	);

	//Si el registro es valido se registra en la base de datos
	if ($validar->regis_valido()) {	

		//Dentro del if se encripta la contraseña antes de registrar el usuario
		if ($Modelo->add(
			$validar->getNombre(),
			$validar->getApellido(),
			$validar->getCedula(),
			$validar->getCorreo(),
			$validar->getTelefono(),
			password_hash($validar->getContrasena(), PASSWORD_DEFAULT),
			$validar->getLocalidad()
		)) {
			header('Location: index-Clientes.php');
		} else {
			header('Location: registro.php');
		}
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
			<form class="form-container" id="form-registro" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

				<?php
				if (isset($_POST['registrar'])) {
					include_once('templates/reg_validado.php');
				} else {
					include_once('templates/reg_vacio.php');
				}
				?>

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