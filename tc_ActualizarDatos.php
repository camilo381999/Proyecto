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

<script text="text/javascript">
	var ver = document.getElementById('ojo');
    var input = document.getElementById('contrasena');

    ver.addEventListener('click', mostrarContraseña);

    function mostrarContraseña() {
        if (input.type == "password") {
            input.type = "text";
            ver.src = "img/cerrado.png";
            setTimeout("cerrado()", 3000);
        } else {
            input.type = "password";
            ver.src = "img/abierto.png";
        }
    }

    function cerrado() {
        input.type = "password";
        ver.src = "img/abierto.png";
    }

    var ver2 = document.getElementById('ojo2');
    var input2 = document.getElementById('contrasena2');

    ver2.addEventListener('click', mostrarContraseña2);

    function mostrarContraseña2() {
        if (input2.type == "password") {
            input2.type = "text";
            ver2.src = "img/cerrado.png";
            setTimeout("cerrado2()", 3000);
        } else {
            input2.type = "password";
            ver2.src = "img/abierto.png";
        }
    }

    function cerrado2() {
        input2.type = "password";
        ver2.src = "img/abierto.png";
    }
</script>

<?php
include_once('templates/terminar-html.php');
?>