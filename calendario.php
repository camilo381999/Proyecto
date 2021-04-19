<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$idTecnico = $ModeloUsuarios->getId();

$fecha = $_GET['fecha'];
$fechaSplit = explode("/", $fecha);
$fechaFormat = $fechaSplit[2] . "-" . $fechaSplit[0] . "-" . $fechaSplit[1];


$publicacion = new Publicacion();

$pendiente = $publicacion->get_pendiente_idTecnico_fecha($idTecnico,$fechaFormat);

include_once('templates/iniciar-html.php');
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
                <div id="container">

                    <div id="header">
                        <div class="title">
                            <h2 id="monthDisplay"></h2>
                        </div>
                        <div>
                            <button id="backButton">Anterior</button>
                            <button id="nextButton">Siguiente</button>
                        </div>
                    </div>

                    <div id="weekdays">
                        <div>Domingo</div>
                        <div>Lunes</div>
                        <div>Martes</div>
                        <div>Miércoles</div>
                        <div>Jueves</div>
                        <div>Viernes</div>
                        <div>Sábado</div>
                    </div>

                    <div id="calendar"></div>
                </div>

                <div id="newEventModal">
                    <h2>New Event</h2>

                    <input id="eventTitleInput" placeholder="Event Title" />

                    <button id="saveButton">Save</button>
                    <button id="cancelButton">Cancel</button>
                </div>

                <div id="deleteEventModal">
                    <h2>Event</h2>

                    <p id="eventText"></p>

                    <button id="deleteButton">Delete</button>
                    <button id="closeButton">Close</button>
                </div>

                <div id="modalBackDrop"></div>

            </div>

        </div>

        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <h5 class="card-header" id="fecha"><?php echo $fecha; ?></h5>
                <div class="card-body">

                    <?php
                    foreach($pendiente as $dato){
                        $idRequerimiento= $publicacion->get_requerimiento_by_id($dato['REQUERIMIENTOS_ID_PUBLICACION']);
                    ?>
                        <p class="card-text"><?php echo $idRequerimiento['SERVICIO']."- ".$idRequerimiento['TIPO']." marca ".$idRequerimiento['MARCA']." - ".$idRequerimiento['HORA']; ?></p>
                    <?php
                    }
                    ?>

                    

                    
                </div>
            </div>
        </div>

    </div>

    <script src="js/script.js"></script>
    <?php
    include_once('templates/terminar-html.php');
    ?>