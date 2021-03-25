<?php
include_once("Usuarios.php");
$ModeloUsuarios = new Usuarios();

function url($longitud)
{
    $caracteres = '0123456789abcdefghijklmnñopqrstuvxyzABCDEFGHIJKLMNÑOPQRSTUVXYZ';
    $numero_caracteres = strlen($caracteres);
    $aleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $aleatorio = $caracteres[rand(0, $numero_caracteres - 1)];
    }

    return $aleatorio;
}

if (isset($_POST['recuperar'])) {
    $email = $_POST['Correo'];
    if ($ModeloUsuarios->existe_correo($email)) {
        $usuario = $ModeloUsuarios->getByCorreo($email);
        $idUsuario=$usuario['ID_USUARIO'];
    }elseif ($ModeloUsuarios->existe_correoTecnico($email)) {
        $usuario = $ModeloUsuarios->getByCorreoTecnico($email);
        $idUsuario=$usuario['ID_TECNICO'];
    }else{
        return;
    }

    $nombre = $usuario['NOMBRE'] . " " . $usuario['APELLIDO'];
    $aleatorio = url(10);

    $url = hash('sha256', $aleatorio . $nombre); //cadena de 64 caracteres

    $peticion = $ModeloUsuarios->url_secreta($idUsuario,$url);

    if($peticion){
        header('Location: index.php');
    }
}
?>