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
        <div class="centrar">
            <section id="carousel-imagenes">

                <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a title="Registro" href="registro.php"><img class="d-block h-100" src="img/tecniclickbanner1.jpg" alt="First slide"></a>
                        </div>
                        <div class="carousel-item">
                            <a title="Registro" href="registro.php"><img class="d-block h-100" src="img/tecniclickbanner2.png" alt="Second slide"></a>
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
        </div>
        <br>
        <div class="container">

            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <img src="img/vista-dispositivos.png" width="100%">
                </div>

                <div class="col-md-5 col-sm-12 col-xs-12">
                    <br>
                    <h2 class="h2-titulos">¿Qué es TecniClick?</h2>
                    <p style="text-align: justify;">Es una aplicación web que busca establecer un enlace directo entre clientes y técnicos, para solicitar servicios de mantenimiento o reparación de productos de línea blanca.</p>

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
                    <p class="parrafo-Subtitulos">Selecciona un servicio entre mantenimiento y reparación, después describe tu requerimiento.</p>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <img src="img/imgp2.png" width="90%" class="img-info">
                    <h3 class="h3-Subtitulos">2. Escoge un técnico</h3>
                    <p class="parrafo-Subtitulos">Cuando un técnico muestre interés por atender tu requerimiento, podrás aceptarlo para agendar el servicio.</p>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <img src="img/imgp3.png" width="90%" class="img-info">
                    <h3 class="h3-Subtitulos">3. Recibe tu servicio</h3>
                    <p class="parrafo-Subtitulos">¡Listo! Espera al día de tu cita para que el técnico atienda tu solicitud.</p>
                </div>
            </div>
            <footer class="page-footer font-small teal pt-4">
                <div class="container-fluid text-center text-md-left">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h5 class="text-uppercase font-weight-bold h2-titulos">Contáctanos</h5><br>
                                <p class="footer-p">Correo: Tecniclick@gmail.com</p>
                                <p class="footer-p">Teléfono: 318923246</p>

                        </div>
                        <hr class="clearfix w-100 d-md-none pb-3">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <ul class="list-unstyled list-inline text-center py-2">
                                <li class="list-inline-item">
                                    <h5 class="mb-1">Registrate aquí: </h5>
                                </li>
                                <li class="list-inline-item">
                                    <a href="registro.php" class="btn btnFooter btn-rounded">Registrar</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled list-inline text-center py-2">
                                <li class="list-inline-item">
                                    <h5 class="mb-1">Ingresa aquí:</h5>
                                </li>
                                <li class="list-inline-item">
                                    <a href="ingresar.php" class="btn btnFooter btn-rounded">Ingresar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright text-center py-3">© 2021 Copyright:
                    <a href="#"> Tecniclick.com</a>
                </div>
            </footer>
        </div>

    </div>

    <div class="part2" data-background="#fff" id="divContenido" style="height: 60%;">
        <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->


    </div>




</div>


<?php
include_once('templates/terminar-html.php');
?>