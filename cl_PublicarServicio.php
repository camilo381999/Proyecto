<?php
include_once("Usuarios.php");
include_once("Publicacion.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');


if (isset($_POST['publicar'])) {
    $Modelo = new Publicacion();
    if ($Modelo->add($_POST['Direccion'], $_POST['Descripcion'], $_POST['Servicio'], $_POST['Marca'], $_POST['Producto'], $_POST['fecha'], $_POST['hora'])) {

        $validacionPost = true;

        //script del alert
        if ($validacionPost) {
            echo "<script> Swal.fire('¡Se ha publicado su requerimiento con éxito!');";
            //redireccionar a alguna pagina
           /*  echo "window.location.href = 'index.php';"; */
            echo "</script>";
        }
        //header('Location: index-Clientes.php');
    }
}


?>

<div class="container">

    <form class="form-container" id="form-publicacion" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

        <div class="title">
            <h1>Publicar servicio</h1>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">

                <div class="form-group">
                    <select name="Servicio" class="form-control">
                        <option selected>Seleccionar un servicio</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Reparación">Reparación</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="Marca" class="form-control">
                        <option selected>Seleccionar Marca</option>
                        <option value="Whirpool">Whirpool</option>
                        <option value="LG">LG</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Bosch">Bosch</option>
                        <option value="Electrolux">Electrolux</option>
                        <option value="Panasonic">Panasonic</option>
                        <option value="Black&Decker">Black&Decker</option>
                        <option value="Toshiba">Toshiba</option>
                        <option value="Sanyo">Sanyo</option>
                        <option value="Neff">Neff</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="Producto" class="form-control" required>
                        <option selected>Seleccionar Producto</option>
                        <option value="Estufa">Estufa</option>
                        <option value="Lavadora">Lavadora</option>
                        <option value="Horno">Horno</option>
                        <option value="Microondas">Microondas</option>
                        <option value="Lavavajillas">Lavavajillas</option>
                        <option value="Refrigerador">Refrigerador</option>
                        <option value="Campana extractora">Campana extractora</option>
                        <option value="Secadora">Secadora</option>
                        <option value="Calefactor">Calefactor</option>
                        <option value="Aire acondicionado">Aire acondicionado</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea name="Descripcion" class="form-control" placeholder="Añade una descripción" cols="200" rows="3" required></textarea>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                    <textarea name="Direccion" class="form-control" placeholder="Escribe tu dirección" cols="200" rows="1" required></textarea>
                </div>

                <label for="fecha">Escoge la fecha de tu servicio:</label><br>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php $hoy = date('Y-m-j');
                                                                                        echo $hoy; ?>" min="<?php $hoy = date('Y-m-j');
                                                                                                            echo $hoy; ?>" max="2021-12-31" required><br>

                <label for="hora">Escoge la hora de tu servicio:</label><br>
                <input type="time" class="form-control" id="hora" name="hora" min="09:00" max="18:00" required><br>
            </div>
        </div>
        <button name="publicar" type="submit" class="btn btn-primary btn-block">Publicar servicio</button>

    </form>
</div>

<?php
include_once('templates/terminar-html.php');
?>