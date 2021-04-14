<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

$Id = $ModeloUsuarios->getId();
$result = $ModeloUsuarios->getById($Id);
include_once('validarActu.php');

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

$validar = new ValidarActualizar(
    $result['NOMBRE'],
    $result['APELLIDO'],
    $result['TELEFONO'],
    $result['PASSWORD'],
    $result['LOCALIDAD']
);

if (isset($_POST['actualizar'])) {
    $validar = new ValidarActualizar(
        $_POST['Nombre'],
        $_POST['Apellido'],
        $_POST['Telefono'],
        $_POST['Contrasena'],
        $_POST['Localidad']
    );

    if ($validar->regis_valido()) {
        $ModeloUsuarios->update(
            $Id,
            $validar->getNombre(),
            $validar->getApellido(),
            $validar->getTelefono(),
            password_hash($validar->getContrasena(), PASSWORD_DEFAULT),
            $validar->getLocalidad()
        );
    }

    echo "<script> Swal.fire('¡Se han actualizado sus datos con éxito!');";
    //redireccionar a alguna pagina
    /*  echo "window.location.href = 'index.php';"; */
    echo "</script>";
}

?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12"></div>
        <div class="col-md-6 col-sm-4 col-xs-12">
            <!-- form start -->
            <form class="form-container" id="form-registro" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                <div class="title">
                    <h1>Actualizar datos</h1>
                </div>

                <div class="form-group">
                    <input name="Nombre" type="text" class="form-control" placeholder="Nombre" <?php $validar->mostrar_nombre(); ?>>
                    <?php
                    $validar->mostrar_error_nombre();
                    ?>
                </div>

                <div class="form-group">
                    <input name="Apellido" type="text" class="form-control" placeholder="Apellido" <?php $validar->mostrar_apellido(); ?>>
                    <?php
                    $validar->mostrar_error_apellido();
                    ?>
                </div>

                <div class="form-group">
                    <input name="Telefono" type="text" class="form-control" placeholder="Teléfono" <?php $validar->mostrar_telefono(); ?>>
                    <?php
                    if (isset($_POST['actualizar'])) {
                        $validar->mostrar_error_telefono();
                    }
                    ?>
                </div>

                <div class="form-group">
                    <select name="Localidad" class="form-control">
                        <option selected><?php $validar->mostrar_localidad(); ?></option>
                        <option value="Antonio Nariño">Antonio Nariño</option>
                        <option value="Barrios Unidos">Barrios Unidos</option>
                        <option value="Bosa">Bosa</option>
                        <option value="Chapinero">Chapinero</option>
                        <option value="Ciudad Bolívar">Ciudad Bolívar</option>
                        <option value="Engativá">Engativá</option>
                        <option value="Fontibón">Fontibón</option>
                        <option value="Kennedy">Kennedy</option>
                        <option value="La Candelaria">La Candelaria</option>
                        <option value="Los Mártires">Los Mártires</option>
                        <option value="Puente Aranda">Puente Aranda</option>
                        <option value="Rafael Uribe Uribe">Rafael Uribe Uribe</option>
                        <option value="San Cristóbal">San Cristóbal</option>
                        <option value="Santa Fe">Santa Fe</option>
                        <option value="Suba">Suba</option>
                        <option value="Sumapaz">Sumapaz</option>
                        <option value="Teusaquillo">Teusaquillo</option>
                        <option value="Tunjuelito">Tunjuelito</option>
                        <option value="Usaquén">Usaquén</option>
                        <option value="Usme">Usme</option>
                    </select>
                    <?php
                    $validar->mostrar_error_localidad();
                    ?>
                </div>

                <div class="form-group">
                    <input name="Contrasena" type="password" class="form-control" placeholder="Nueva contraseña o Actual">
                    <?php
                    $validar->mostrar_error_contrasena();
                    ?>
                </div>

                <button name="actualizar" type="submit" class="btn btn-primary btn-block">Actualizar</button>
            </form>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12"></div>
    </div>
</div>


<?php
include_once('templates/terminar-html.php');
?>