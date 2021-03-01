<?php
    include_once('templates/iniciar-html.php');
	include_once('templates/menu.php');
?>

<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12"></div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<!-- form start -->
				<form class="form-container" id="form-ingreso" autocomplete="off" method="POST" action="Usuarios/Login.php">
				
						<div class="ingreso-title">
						<h1>Inicio de Sesión</h1>
						</div>
				
						<div class="form-group">
							<input name="Correo" type="text"  class="form-control" required="" autocomplete="off" placeholder="Correo"> 
							<span class="help-block" id="error"></span>                     
						</div>
									
						<div class="form-group">
							<input name="Contrasena" type="password" class="form-control" required="" autocomplete="off" placeholder="Contraseña">

							<span class="help-block" id="error"></span>                     
						</div>

						<button type="submit" class="btn btn-primary btn-block">Inicia Sesión</button>
						<a href="">¿Olvidó su contraseña?</a>
				</form>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12"></div>
		</div>
	</div>
	

<?php
    include_once('templates/terminar-html.php');
?>