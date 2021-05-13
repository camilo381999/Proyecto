<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$idAgenda = $_GET['Id'];
$idPendiente = $_GET['IdPendiente'];
$idUsuario = $_GET['idUsuario'];
$idTecnico = $_GET['idTecnico'];
$Fecha = $_GET['Fecha'];
$Costo = $_GET['Costo'];
$Correo = $_GET['Correo'];

$Modelo = new Publicacion();
if ($Modelo->servicioTerminado($idAgenda, $idPendiente, $idUsuario, $idTecnico, $Fecha, $Costo)) {

    // Envia correo al usuario de que se termino el servicio y debe calificar
    //$asunto = "Tu servicio ha finalizado";
    //$mensaje = "Tu técnico ha indicado que ha concluido tu servicio por un valor de: $Costo, por favor recuerda calificarlo. Esto ayudará a que mejore a futuro la calidad de su servicio.\n\n\nGracias por preferir TecniClick";
    //$headers = "From: sender email";

   /*  $from_email = "tecniclickcolombia@gmail.com";
    $to_email = $Correo;
    $subject = "Tu servicio ha finalizado";
    $body = "Tu técnico ha indicado que ha concluido tu servicio por un valor de: $Costo, por favor recuerda calificarlo en la sección de Historial. Esto ayudará a que mejore a futuro la calidad de su servicio.\n\n\nGracias por preferir TecniClick";

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

    echo "<script> Swal.fire('¡Se ha finalizado este servicio!').then(
        function() {
            window.location.href = 'index.php';
        });
        </script>";

} else {
    echo "<script> Swal.fire('¡No se pudo finalizar este servicio!').then(
        function() {
            window.location.href = 'index.php';
        });";
    echo "</script>";
}
include_once('templates/terminar-html.php');
