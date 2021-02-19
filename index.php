<!DOCTYPE html >
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tecniclick</title>
</head>
<body>
 	<h1>Inicio de Sesión</h1>
 	<form method="POST" action="Usuarios/Controladores/Login.php">
 		Usuario <br>
 		<input type="text" name="Usuario" required="" autocomplete="off" placeholder="Usuario"> <br><br>
 		Contraseña <br>
 		<input type="password" name="Contrasena" required="" autocomplete="off" placeholder="Contraseña"><br><br>
 		<input type="submit" value="Inicia Sesión">

 	</form>
</body>
</html>
