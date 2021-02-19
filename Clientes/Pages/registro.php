
<!DOCTYPE html>
<html>
<head>
	<title>Tecniclick</title>
</head>
<body>
 	<h1>Registro de usuario</h1>
 	<form method="POST" action="../Controladores/add.php">
        Nombre <br>
 		<input type="text" name="Nombre" required="" autocomplete="off" placeholder="Nombre"> <br><br>

        Apellido <br>
 		<input type="text" name="Apellido" required="" autocomplete="off" placeholder="Apellido"> <br><br>

		Cedula <br>
 		<input type="text" name="Cedula" required="" autocomplete="off" placeholder="Cedula"> <br><br>

        Correo <br>
 		<input type="email" name="Correo" required="" autocomplete="off" placeholder="Correo"> <br><br>

        Telefono <br>
 		<input type="text" name="Telefono" required="" autocomplete="off" placeholder="Telefono"> <br><br>

        Usuario <br>
 		<input type="text" name="Usuario" required="" autocomplete="off" placeholder="Usuario"> <br><br>

 		Contraseña <br>
 		<input type="password" name="Contrasena" required="" autocomplete="off" placeholder="Contraseña"><br><br>

 		<input type="submit" value="Registrar">
 	</form>
	 
</body>
</html>