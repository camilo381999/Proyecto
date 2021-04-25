<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$idTecnico = $ModeloUsuarios->getId();
$getFecha = $_GET['getFecha'];

$publicacion = new Publicacion();
$pendiente = $publicacion->get_pendiente_idTecnico($idTecnico);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecniclick</title>
    <link rel="shortcut icon" href="img/icono-tab.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="plugins/SweetAlert/dist/sweetalert2.min.css">

    <link href='fullcalendar/main.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>
    <script src='fullcalendar/lang/es.js'></script>

    <script>
        var i = 0;
        document.addEventListener('DOMContentLoaded', function() {
            var initialLocaleCode = 'es';
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'title',
                    right: 'prev next'
                },
                locale: initialLocaleCode,
                buttonIcons: true, // show the prev/next text
                navLinks: true, // can click day/week names to navigate views
                navLinkDayClick: function(date, jsEvent) {
                    dateStr=date.toISOString().split("T");
                    document.getElementById("fecha").innerText = dateStr[0];

                    let div = document.getElementById("divCardEventos");
                    const data = <?php echo $pendiente; ?>;

                    let limpiar = Array.prototype.slice.call(document.getElementsByClassName("servAgendado"), 0);

                    for (element of limpiar) {
                        element.remove();
                    }

                    data.forEach(obj => {
                        if (document.getElementById("fecha").innerText == obj.start) {
                            div.insertAdjacentHTML('afterbegin', '<div class="servAgendado"><a href="tc_ConsultarAgenda.php?idPendiente=' + obj.id + '" ><p class="card-text">' + obj.title + '</p></a><br></div>');
                        }
                    });
                },
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                select: function(arg) {
                    document.getElementById("fecha").innerText = arg.startStr;

                    let div = document.getElementById("divCardEventos");
                    const data = <?php echo $pendiente; ?>;

                    let limpiar = Array.prototype.slice.call(document.getElementsByClassName("servAgendado"), 0);

                    for (element of limpiar) {
                        element.remove();
                    }

                    data.forEach(obj => {
                        if (document.getElementById("fecha").innerText == obj.start) {
                            div.insertAdjacentHTML('afterbegin', '<div class="servAgendado"><a href="tc_ConsultarAgenda.php?idPendiente=' + obj.id + '" ><p class="card-text">' + obj.title + '</p></a><br></div>');
                        }
                    });
                },
                events: <?php echo $pendiente; ?>,
            });
            calendar.render();
        });
    </script>
</head>

<body>
    <?php
    include_once('templates/menu.php');
    ?>

    <div class="container">
        <div class="publicacion-title">
            <br>
            <h1>Consultar agenda</h1>

        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">

                <div class="form-calendar-container">
                    <div id='calendar'></div>
                </div>

            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
                <br>
                <div class="card">
                    <h5 class="card-header" id="fecha"><?php echo $getFecha; ?></h5>
                    <div class="card-body" id="divCardEventos">


                    </div>
                </div>
                <br>
            </div>

        </div>
    </div>

    <?php
    include_once('templates/terminar-html.php');
    ?>