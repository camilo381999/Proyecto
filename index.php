<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionIndex();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="bg-color">
    <div class="part1" data-background="#118AB2" id="divBanners" style="height: 40%;">
        <section id="carousel-imagenes">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block h-100" src="img/tecniclickbanner1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block h-100" src="img/tecniclickbanner2.png" alt="Second slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <br>
        <div class="container">

            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <img src="img/vista-dispositivos.png" width="100%">
                </div>

                <div class="col-md-5 col-sm-12 col-xs-12">
                    <br>
                    <h2 class="h2-titulos">¿Qué es TecniClick?</h2>
                    <p style="text-align: justify;">Es una aplicación web que busca establecer un enlace directo entre clientes y técnicos, para solicitar servicios de mantenimiento o reparación de productos de linea blanca.</p>

                    <br>
                    <h2 class="h2-titulos">¿Por qué usar TecniClick?</h2>
                    <p style="text-align: justify;">Los clientes tienen la posibilidad de escoger a su técnico basados en la ubicación y calificación que este tenga y así evitar recomendaciones a ciegas de otras personas. Adicionalmente pueden consultar los comentarios del técnico para conocer mas sobre la opinión de otros clientes.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2 class="h2-titulos">¿Cómo funciona?</h2>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <img src="img/imgp1.png" width="90%" class="img-info">
                    <h3 class="h3-Subtitulos">1. Publica un servicio</h3>
                    <p class="parrafo-Subtitulos">Selecciona un servicio entre mantenimiento y reparación, despues describe tu requerimiento.</p>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <img src="img/imgp2.png" width="90%" class="img-info">
                    <h3 class="h3-Subtitulos">2. Escoge un técnico</h3>
                    <p class="parrafo-Subtitulos">Cuando un técnico muestre interes por atender tu requerimiento, podras aceptarlo para agendar el servicio.</p>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <img src="img/imgp3.png" width="90%" class="img-info">
                    <h3 class="h3-Subtitulos">3. Recibe tu servicio</h3>
                    <p class="parrafo-Subtitulos">¡Listo! Espera al dia de tu cita para que el técnico atienta tu solicitud.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="part2" data-background="#fff" id="divContenido" style="height: 60%;">

    </div>

</div>


<?php
include_once('templates/terminar-html.php');
?>