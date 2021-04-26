<div class="title">
	<h1>Registro</h1>
</div>

<div class="form-group">
	<input name="Nombre" type="text" class="form-control" placeholder="Nombre" <?php $validar->mostrar_nombre(); ?>>
	<?php
	$validar->mostrar_error_nombre();
	?>
</div>

<div class="form-group">
	<input name="Apellido" type="text" class="form-control" placeholder="Apellido" <?php $validar->mostrar_apellido(); ?>>
	<?php
	$validar->mostrar_error_apellido();
	?>
</div>

<div class="form-group">
	<input name="Cedula" type="text" class="form-control" placeholder="Cédula" <?php $validar->mostrar_cedula(); ?>>
	<?php
	$validar->mostrar_error_cedula();
	?>
</div>

<div class="form-group">
	<input name="Correo" type="email" class="form-control" placeholder="Correo" <?php $validar->mostrar_correo(); ?>>
	<?php
	$validar->mostrar_error_correo();
	?>
</div>

<div class="form-group">
	<input name="Telefono" type="text" class="form-control" placeholder="Teléfono" <?php $validar->mostrar_telefono(); ?>>
	<?php
	$validar->mostrar_error_telefono();
	?>
</div>

<div class="form-group">
	<select name="Localidad" class="form-control">
		<option selected><?php $validar->mostrar_localidad(); ?></option>
		<option value="Antonio Nariño">Antonio Nariño</option>
		<option value="Barrios Unidos">Barrios Unidos</option>
		<option value="Bosa">Bosa</option>
		<option value="Chapinero">Chapinero</option>
		<option value="Ciudad Bolívar">Ciudad Bolívar</option>
		<option value="Engativá">Engativá</option>
		<option value="Fontibón">Fontibón</option>
		<option value="Kennedy">Kennedy</option>
		<option value="La Candelaria">La Candelaria</option>
		<option value="Los Mártires">Los Mártires</option>
		<option value="Puente Aranda">Puente Aranda</option>
		<option value="Rafael Uribe Uribe">Rafael Uribe Uribe</option>
		<option value="San Cristóbal">San Cristóbal</option>
		<option value="Santa Fe">Santa Fe</option>
		<option value="Suba">Suba</option>
		<option value="Sumapaz">Sumapaz</option>
		<option value="Teusaquillo">Teusaquillo</option>
		<option value="Tunjuelito">Tunjuelito</option>
		<option value="Usaquén">Usaquén</option>
		<option value="Usme">Usme</option>
	</select>
	<?php
	$validar->mostrar_error_localidad();
	?>
</div>

<div class="input-group">
	<input name="Contrasena" id="contrasena" type="password" class="form-control" placeholder="Contraseña">
	<img src="img/abierto.png" id="ojo">
	<?php
	$validar->mostrar_error_contrasena();
	?>
</div>
<br>

<button name="registrar" type="submit" class="btn btn-primary btn-block">Registrar</button>