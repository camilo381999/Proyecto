<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();

$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
//echo "http://" . $host . $url;

$url_personal = $_GET['key'];

$result = $ModeloUsuarios->url_secreta_existe($url_personal);
if ($result != null) {
    $id = $result['ID_USUARIO'];
    $idRegistro = $result['ID_RECUPERACION'];
    //echo 'El id de usuario es: ' . $id;
} else {
    header("Location: recuperar_password.php");
}

if (isset($_POST['enviar'])) {

    if ($_POST['Contrasena1'] == $_POST['Contrasena2']) {
        $clave = password_hash($_POST['Contrasena1'], PASSWORD_DEFAULT);
        if ($ModeloUsuarios->updatePassword($id, $clave) || $ModeloUsuarios->updatePasswordTecnico($id, $clave)) {
            if ($ModeloUsuarios->eliminar_url_secreta_existe($idRegistro)) {
                header("Location: ingresar.php");
            }
        }else{
            echo "hubo un problema";
        }

    } else {
        echo "error";
    }
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <!-- form start -->
            <form class="form-container" id="form-ingreso" autocomplete="off" method="POST" action="<?php echo $url ?>">

                <div class="title">
                    <h1>Crea una nueva contraseña</h1>
                </div>

                <div class="input-group">
                    <input name="Contrasena1" type="password" id="contrasena" class="form-control" required="" autofocus placeholder="Nueva contraseña">
                    <img src="img/abierto.png" id="ojo">
                </div>
                <br>

                <div class="input-group">
                    <input name="Contrasena2" type="password" id="contrasena2" class="form-control" required="" placeholder="Confirmar contraseña">
                    <img src="img/abierto.png" id="ojo2">
                </div>
                <br>

                <button name="enviar" type="submit" class="btn btn-primary btn-block" onClick="comprobarClave()">Cambiar contraseña</button>
            </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
</div>

<script text="text/javascript">
    function comprobarClave() {
        password1 = document.getElementById("contrasena").value;
        password2 = document.getElementById("contrasena2").value;

        if (password1 == password2) {
            alert("Las dos contraseñas son iguales");
        } else {
            alert("Las dos contraseñas son distintas");
        }
    }
</script>

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