<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

$fecha = $_GET['Fecha'];
$hora = $_GET['Hora'];
$idPendiente = $_GET['idPendiente'];
$correo = $_GET['Correo'];


$Modelo = new Publicacion();

if ($Modelo->cancelacionServicioPendiente($fecha, $hora, $idPendiente)) {
    $validacionPost = true;

    //script del alert
    if ($validacionPost) {
        // Envia correo al tecnico de que se cancelo el servicio
        //$asunto = "Cancelación de servicio";
        //$mensaje = "Se ha cancelado el servicio que estaba agendado en la fecha $fecha , a la hora $hora.\n\n\nGracias por preferir TecniClick";
        //$headers = "From: sender email";

       /*  $from_email = "tecniclickcolombia@gmail.com";
        $to_email = $correo;
        $subject = "Cancelación de servicio";
        $body = "Se ha cancelado el servicio que estaba agendado en la fecha $fecha , a la hora $hora.\n\n\nGracias por preferir TecniClick";

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
        curl_close($curlHandler); */

        echo "<script> Swal.fire('¡Se ha cancelado su servicio correctamente!').then(
			function() {
				window.location.href = 'index.php';
			});";
        echo "</script>";
    }
} else {
    $validacionPost = true;

    //script del alert
    if ($validacionPost) {
        echo "<script> Swal.fire('¡Quedan menos de 2 horas para su cita, por favor comuniquese con su técnico para cancelar!').then(
			function() {
				window.location.href = 'index.php';
			});";
        echo "</script>";
    }
}

include_once('templates/terminar-html.php');
