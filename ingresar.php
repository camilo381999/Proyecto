<?php
    include_once('templates/iniciar-html.php');
?>
 	<h1>Inicio de Sesión</h1>
 	<form method="POST" action="Usuarios/Controladores/Login.php">
 		Usuario <br>
 		<input type="text" name="Usuario" required="" autocomplete="off" placeholder="Usuario"> <br><br>
 		Contraseña <br>
 		<input type="password" name="Contrasena" required="" autocomplete="off" placeholder="Contraseña"><br><br>
 		<input type="submit" value="Inicia Sesión">
 	</form>
	 <form method="POST" action="registro.php">
	 <input type="submit" value="Registrarse">
 	</form>
	
	<a href="">¿Olvidó su contraseña?</a>

<?php
    include_once('templates/terminar-html.php');
?>