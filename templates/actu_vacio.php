<div class="title">
    <h1>Actualizar datos</h1>
</div>

<div class="form-group">
    <label>Nombre:</label>
    <input name="Nombre" type="text" class="form-control" placeholder="Nombre" value="<?php echo $result['NOMBRE']; ?>">
</div>

<div class="form-group">
    <label>Apellido:</label>
    <input name="Apellido" type="text" class="form-control" placeholder="Apellido" value="<?php echo $result['APELLIDO']; ?>">
</div>

<div class="form-group">
    <label>Teléfono:</label>
    <input name="Telefono" type="text" class="form-control" placeholder="Teléfono" value="<?php echo $result['TELEFONO']; ?>">
</div>

<div class="form-group">
    <label>Localidad:</label>
    <select name="Localidad" class="form-control">
        <option selected><?php echo $result['LOCALIDAD']; ?></option>
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
</div>

<div class="form-group">
    <label>Contraseña:</label>
    <input name="Contrasena" type="password" class="form-control" placeholder="Contraseña actual">
</div>

<div class="form-group">
    <input name="ContrasenaNueva" type="password" class="form-control" placeholder="Nueva contraseña">

</div>

<button name="actualizar" type="submit" class="btn btn-primary btn-block">Actualizar</button>