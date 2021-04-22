<?php

$destinatario = "manuel-martinez2@upc.edu.co";
$asunto = "prueba email con php";
$mensaje = "Esto es una prueba php (Message part)";
$headers = "From: sender email";

if (mail($destinatario, $asunto, $mensaje,$headers)) {
    echo "email enviado to $destinatario";
} else {
    echo "envio fallido";
}
?>

