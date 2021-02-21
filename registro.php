
<?php
    include_once('templates/iniciar-html.php');
	include_once('templates/menu.php');
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12"></div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<!-- form start -->
				<form class="form-container" id="form-registro" autocomplete="off" method="POST" action="Clientes/Controladores/add.php">
				
						<div class="registro-title">
							<h1>Registro</h1>
						</div>
			
						<div class="form-group">
								<input name="Nombre" type="text" class="form-control" required="" autocomplete="off"  placeholder="Nombre">			
						</div>
									
						<div class="form-group">
							<input name="Apellido" type="text" class="form-control" required="" autocomplete="off" placeholder="Apellido">
							
							<span class="help-block" id="error"></span>                     
						</div>
									
						<div class="form-group">
							<input name="Cedula" type="text" class="form-control" required="" autocomplete="off" placeholder="Cedula">
						
							<span class="help-block" id="error"></span>                     
						</div>
									
						<div class="form-group">
							
							<input name="Correo" type="email" class="form-control" required="" autocomplete="off" placeholder="Correo">
							
							<span class="help-block" id="error"></span>                     
						</div>

						<div class="form-group">
						
							<input name="Telefono" type="text" class="form-control" required="" autocomplete="off" placeholder="Telefono">
						
							<span class="help-block" id="error"></span>                     
						</div>	

						<div class="form-group">
						
							<input name="Usuario" type="text" class="form-control" required="" autocomplete="off" placeholder="Usuario">
						
							<span class="help-block" id="error"></span>                     
						</div>

						<div class="form-group">
						
							<input name="Contrasena" type="password" class="form-control" required="" autocomplete="off" placeholder="Contraseña">
					
							<span class="help-block" id="error"></span>                     
						</div>
									
							<button type="submit" class="btn btn-primary btn-block">Registrar</button>

				</form>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12"></div>
		</div>
	</div>
	 
<?php
    include_once('templates/terminar-html.php');
?>