<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image:url('/Proyecto/img/MABE.jpg')">
                        <!-- <img src="/Proyecto/img/MABE.jpg" class="d-block w-100" alt="..."> -->
                    </div>
                    <div class="carousel-item" style="background-image:url('/Proyecto/img/tecnico2.jpg')">
<!--                         <img src="/Proyecto/img/tecnico2.jpg" class="d-block w-100" alt="...">
 -->                    </div>
                    <div class="carousel-item" style="background-image:url('/Proyecto/img/slider-linea-blanca.jpg')">
<!--                         <img src="/Proyecto/img/slider-linea-blanca.jpg" class="d-block w-100" alt="...">
 -->                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

<?php
include_once('templates/terminar-html.php');
?>