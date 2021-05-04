<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionIndex();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<style>
    body {
        background-color: #fff;
    }
</style>


<div class="container">

    <div class="row">
        <div class="col-md-7 col-sm-12 col-xs-12">
            <img src="img/vista-dispositivos.png" width="100%">
        </div>

        <div class="col-md-5 col-sm-12 col-xs-12">
            <br>
            <h2 class="h2-titulos">¿Cómo registrarte?</h2>
            <p style="text-align: justify;">Si eres un técnico especializado en productos de línea blanca y quieres trabajar con nosotros, debes enviar todos los datos que se piden en el siguiente enlace, y luego de esto serás contactado por uno de nuestros encargados.</p>

            <br>
            <h2 class="h2-titulos">¿Cómo ingresar a la aplicación?</h2>
            <p style="text-align: justify;">Ingresa en la opción "Iniciar sesión" que se encuentra en la parte superior derecha de la pantalla e ingresar con los datos que fueron enviados a tu correo electrónico. Después debes cambiar tu contraseña ya que la que fue enviada a tu correo electrónico está definida por el sistema.</p>
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
            <h3 class="h3-Subtitulos">1. Consulta el muro de servicios</h3>
            <p class="parrafo-Subtitulos">Aplica a los servicios publicados por los clientes que consideres que puedes atender, y espera a que estos te acepten para atender su solicitud.</p>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12">
            <img src="img/imgp2.png" width="90%" class="img-info">
            <h3 class="h3-Subtitulos">2. Consulta tu agenda</h3>
            <p class="parrafo-Subtitulos">Cuando un cliente haya aceptado tus servicios, podrás consultar tu agenda para revisar que días y a que hora tienes servicios agendados.</p>
        </div>

        <div class="col-md-4 col-sm-12 col-xs-12">
            <img src="img/imgp3.png" width="90%" class="img-info">
            <h3 class="h3-Subtitulos">3. Terminar servicio</h3>
            <p class="parrafo-Subtitulos">Realiza el servicio de mantenimiento o reparación solicitado por el cliente y recibe el pago en efectivo por tu servicio.</p>
        </div>
    </div>

    <footer class="page-footer font-small teal pt-4">

        <div class="container-fluid text-center text-md-left footer1">
            <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                    <h5 class="text-uppercase font-weight-bold h2-titulos">Contáctanos</h5><br>
                    <p class="footer-p">Correo: Tecniclick@gmail.com</p>
                    <p class="footer-p">Teléfono: 318923246</p>

                </div>
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <h5 class="text-uppercase font-weight-bold h2-titulos">Ya tienes cuenta?</h5><br>
                    <div class="row justify-content-center">
                        <a href="ingresar.php" class="btn btn-default btnFooter">Ingresar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-copyright text-center py-3">© 2021 Copyright:
            <a href="#"> Tecniclick.com</a>
        </div>

    </footer>




</div>



<?php
include_once('templates/terminar-html.php');
?>