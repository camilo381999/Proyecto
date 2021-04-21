<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionTecnicos();

$Id = $ModeloUsuarios->getId();
$result = $ModeloUsuarios->getByIdTecnico($Id);
include_once('validarActu.php');

if (isset($_POST['actualizar'])) {
    $validar = new ValidarActualizar(
        $_POST['Nombre'],
        $_POST['Apellido'],
        $_POST['Telefono'],
        $_POST['Contrasena'],
        $result['PASSWORD'],
        $_POST['ContrasenaNueva'],
        $_POST['Localidad']
    );

    if ($validar->regis_valido()) {
        $ModeloUsuarios->updateTecnico(
            $Id,
            $validar->getNombre(),
            $validar->getApellido(),
            $validar->getTelefono(),
            password_hash($validar->getContrasena(), PASSWORD_DEFAULT),
            $validar->getLocalidad()
        );

        echo "<script> Swal.fire('¡Se han actualizado sus datos con éxito!').then(
            function() {
                window.location.href = 'index.php';
            });";
        echo "</script>";
    }
}


?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- form start -->
            <form class="form-container" id="form-registro" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                <?php
                if (isset($_POST['actualizar'])) {
                    include_once('templates/actu_validado.php');
                } else {
                    include_once('templates/actu_vacio.php');
                }
                ?>

            </form>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
    </div>
</div>


<?php
include_once('templates/terminar-html.php');
?>