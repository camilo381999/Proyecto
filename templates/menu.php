<?php
include_once('Usuarios.php');
$ControlSesion = new Usuarios();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="img/posible-logo.svg" width="150" height="70" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
            if ($ControlSesion->sesionIniciada()) {
            ?>
                <ul class="navbar-nav mr-auto"></ul>

                <ul class="nav navbar-nav navbar-right">

                    <?php
                    if ($ControlSesion->getPerfil() == 'Usuario') {
                    ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $ControlSesion->getNombre(); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="cl_Perfil.php">Mi perfil</a>
                                <a class="dropdown-item" href="cl_Calificacion.php">Calificar técnicos</a>
                            </div>
                        </li>

                        <li>
                            <a class="nav-link" href="Usuarios/Salir.php">Cerrar sesión</a>
                        </li>

                    <?php
                    } elseif ($ControlSesion->getPerfil() == 'Técnico') {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $ControlSesion->getNombre(); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="tc_Perfil.php">Mi perfil</a>
                            </div>
                        </li>

                        <li>
                            <a class="nav-link" href="Usuarios/Salir.php">Cerrar sesión</a>
                        </li>


                    <?php
                    } elseif ($ControlSesion->getPerfil() == 'Administrador') {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $ControlSesion->getNombre(); ?>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="Usuarios/Salir.php">Cerrar sesión</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            <?php
            } else {
            ?>
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a class="nav-link" href="#">Técnicos</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">Preguntas frecuentes</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="nav-link" href="ingresar.php">Iniciar sesión</a>
                    </li>
                    <li>
                        <a class="nav-link" href="registro.php">Registro</a>
                    </li>
                </ul>
            <?php
            }
            ?>
        </div>
    </div>
</nav>