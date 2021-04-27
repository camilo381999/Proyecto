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
        ?>
        <script text="text/javascript">
        alert("¡Este correo no está registrado!");
        window.location.href = 'recuperar_password.php';
        </script>
        <?php

    }

    $nombre = $usuario['NOMBRE'] . " " . $usuario['APELLIDO'];
    $aleatorio = url(10);

    $url = hash('sha256', $aleatorio . $nombre); //cadena de 64 caracteres

    $peticion = $ModeloUsuarios->url_secreta($idUsuario,$url);

    //Si la url secreta se guardo en la base de datos envia el correo
    if($peticion){

       /*  $from_email = "tecniclickcolombia@gmail.com";
        $to_email = $email;
        $subject = "Recuperar contraseña";
        $body = "Hola $nombre se ha solicitado la restauración de la contraseña, para restaurarla dale click al siguiente enlace <a href= 'http://localhost/Proyecto/recuperacionPassword.php?key=$url'>Restaurar contraseña</a>";
    
        $headers = array(
            'Authorization: Bearer ',
            'Content-Type: application/json'
        );
    
        $data = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $to_email
                        )
                    )
                )
            ),
            "from" => array(
                "email" => $from_email
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            )
        );
    
        $curlHandler = curl_init();
        curl_setopt($curlHandler, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($curlHandler, CURLOPT_POST, 1);
        curl_setopt($curlHandler, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlHandler, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curlHandler);
        curl_close($curlHandler);
    
        echo $response; */
    
        header("Location: index.php");
    }
}
?>