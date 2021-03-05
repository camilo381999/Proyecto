<?php
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionCliente();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
?>

<h1>Publicar servicio</h1>

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
    <select name="Producto" class="form-control">
        <option selected>Seleccionar Producto</option>
        <option value="Estufa">Estufa</option>
        <option value="Lavadora">Lavadora</option>
        <option value="Horno">Horno</option>
        <option value="Microondas">Microondas</option>
        <option value="Lavaplatos">Lavaplatos</option>
        <option value="Refrigerador">Refrigerador</option>
        <option value="Campana extractora">Campana extractora</option>
        <option value="Secadora">Secadora</option>
        <option value="Calefactor">Calefactor</option>
        <option value="Aire acondicionado">Aire acondicionado</option>
    </select>
</div>



<?php
include_once('templates/terminar-html.php');
?>