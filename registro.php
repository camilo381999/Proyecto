<?php

include_once('Clientes/validarReg.php');
//include_once('add.php');
include_once('Usuarios.php');

//Si el usuario le da al boton registrar
if (isset($_POST['registrar'])){

	//Se valida que todos los datos esten completos
	$validar = new ValidarRegistro($_POST['Nombre'], $_POST['Apellido'],
	 $_POST['Cedula'], $_POST['Correo'], $_POST['Telefono'], $_POST['Contrasena'] );

	 //Si el registro es valido se registra en la base de datos
	 if($validar->regis_valido()){
		$Modelo = new Usuarios();

		if($Modelo -> add($validar-> getNombre(),
		$validar-> getApellido(),
		$validar-> getCedula(),
		$validar-> getCorreo(),
		$validar-> getTelefono(),
		$validar-> getContrasena())){
			 header('Location: Clientes/index.php');
	   	}else{
		 header('Location: /registro.php');
	  	}  
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
			<form class="form-container" id="form-registro" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

				<?php
					if(isset($_POST['registrar'])){
						include_once('templates/reg_validado.php');
					}else{
						include_once('templates/reg_vacio.php');
					}
				?>

			</form>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12"></div>
	</div>
</div>

<?php
include_once('templates/terminar-html.php');
?>