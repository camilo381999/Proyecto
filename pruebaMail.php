<?php

$destinatario = "damit14449@kindbest.com";
$asunto = "prueba email";
$mensaje = "Esto es una prueba";

$exito = mail($destinatario, $asunto, $mensaje);

if ($exito) {
    echo 'email enviado';
} else {
    echo 'envio fallido';
}
