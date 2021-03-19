<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();

include_once('validarLog.php');

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- form start -->
            <form class="form-container" id="form-ingreso" autocomplete="off" method="POST" action="generar_url.php">

                <div class="title">
                    <h1>Recuperar Contraseña</h1>
                </div><br>

                <p>Escriba el correo electrónico con el que se registró y enviaremos un email,
                    con el que se va poder restablecer la contraseña.</p><br>

                <div class="form-group">
                    <input name="Correo" type="email" class="form-control" required="" autofocus placeholder="Correo" >

                </div>

                <button name="recuperar" type="submit" class="btn btn-primary btn-block">Enviar</button>
            </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
</div>
</div>


<?php
include_once('templates/terminar-html.php');
?>