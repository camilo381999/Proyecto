<?php
//include_once('../Usuarios.php');
include_once('Usuarios.php');

class ValidarActualizar
{

    private $aviso_inicio;
    private $aviso_cierre;

    private $usuarios;

    private $nombre;
    private $apellido;
    private $telefono;
    private $contrasena1;
    private $localidad;

    private $error_nombre;
    private $error_apellido;
    private $error_telefono;
    private $error_contrasena;
    private $error_localidad;

    public function __construct($nombre, $apellido, $telefono, $contrasena, $contrasenaActual, $contrasenaNueva, $localidad)
    {

        $this->usuarios = new Usuarios();

        $this->aviso_inicio = "<br><div class='alert alert-primary' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->nombre = "";
        $this->apellido = "";
        $this->telefono = "";
        $this->contrasena1 = "";
        $this->localidad = "";

        //llama los metodos y si hay error los guarda en cada variable
        $this->error_nombre = $this->validar_nom($nombre);
        $this->error_apellido = $this->validar_ape($apellido);
        $this->error_telefono = $this->validar_tel($telefono);
        $this->error_contrasenaActual = $this->validar_cont($contrasena);
        $this->error_contrasenaNueva = $this->validar_contNew($contrasenaNueva);
        $this->error_localidad = $this->validar_local($localidad);

        /*    if($this->error_contrasena === ""){
            $this -> contrasena1 = $contrasena;
        }  */

        if (password_verify($contrasena, $contrasenaActual)) {
            if ($this->error_contrasenaNueva != "") {
                $this->contrasena1 = $contrasenaActual;
            } else {
                $this->contrasena1 = $contrasenaNueva;
            }
        } else {
            if($this->error_contrasenaActual === ""){
                $this->error_contrasenaActual = "Contraseña incorrecta";
            }else{
            $this->error_contrasenaActual = $this->validar_cont($contrasena);
            }
        }
    }

    //Valida si la contraseña es null o vacia
    private function var_iniciada($var)
    {
        if (isset($var) && !empty($var)) {
            return true;
        } else {
            return false;
        }
    }

    //llama al metodo var_iniciada y si no esta vacia le asigna el valor a la variable 
    //si está vacia devuelve el error
    private function validar_nom($nombre)
    {
        if (!$this->var_iniciada($nombre)) {
            return "Por favor escriba su nombre";
        } else {
            $this->nombre = $nombre;
        }

        return "";
    }

    private function validar_ape($apellido)
    {
        if (!$this->var_iniciada($apellido)) {
            return "Por favor escriba su apellido";
        } else {
            $this->apellido = $apellido;
        }

        return "";
    }

    private function validar_tel($telefono)
    {
        if (!$this->var_iniciada($telefono)) {
            return "Por favor escriba su teléfono";
        } else {
            $this->telefono = $telefono;
        }
        return "";
    }

    private function validar_cont($contrasena)
    {
        if (!$this->var_iniciada($contrasena)) {
            return "Por favor escriba su contraseña actual";
        }

        return "";
    }

    private function validar_contNew($contrasenaNueva)
    {
        if (!$this->var_iniciada($contrasenaNueva)) {
            return "Por favor escriba su nueva contraseña";
        }

        return "";
    }

    private function validar_local($localidad)
    {
        if ($localidad == "Seleccionar localidad") {
            return "Por favor ingrese su localidad";
        } else {
            $this->localidad = $localidad;
        }

        return "";
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getContrasena()
    {
        return $this->contrasena1;
    }
    public function getLocalidad()
    {
        return $this->localidad;
    }


    public function get_error_nombre()
    {
        return $this->error_nombre;
    }
    public function get_error_apellido()
    {
        return $this->error_apellido;
    }
    public function get_error_telefono()
    {
        return $this->error_telefono;
    }
    public function get_error_contrasenaActual()
    {
        return $this->error_contrasenaActual;
    }
    public function get_error_contrasenaNueva()
    {
        return $this->error_contrasenaNueva;
    }
    public function get_error_localidad()
    {
        return $this->error_localidad;
    }

    //Muestra el nombre en value cuando se ha enviado el formulario y hay un error
    public function mostrar_nombre()
    {
        if ($this->nombre !== "") {
            echo 'value="' . $this->nombre . '"';
        }
    }

    //muestra el error con bootstrap
    public function mostrar_error_nombre()
    {
        if ($this->error_nombre !== "") {
            echo $this->aviso_inicio . $this->error_nombre . $this->aviso_cierre;
        }
    }

    public function mostrar_apellido()
    {
        if ($this->apellido !== "") {
            echo 'value="' . $this->apellido . '"';
        }
    }

    public function mostrar_error_apellido()
    {
        if ($this->error_apellido !== "") {
            echo $this->aviso_inicio . $this->error_apellido . $this->aviso_cierre;
        }
    }

    public function mostrar_telefono()
    {
        if ($this->telefono !== "") {
            echo 'value="' . $this->telefono . '"';
        }
    }

    public function mostrar_error_telefono()
    {
        if ($this->error_telefono !== "") {
            echo $this->aviso_inicio . $this->error_telefono . $this->aviso_cierre;
        }
    }

    public function mostrar_localidad()
    {
        if ($this->localidad !== "") {
            echo $this->localidad;
        }
    }

    public function mostrar_error_localidad()
    {
        if ($this->get_error_localidad() !== "") {
            echo $this->aviso_inicio . $this->error_localidad . $this->aviso_cierre;
        }
    }

    public function mostrar_error_contrasenaNueva()
    {
        if ($this->error_contrasenaNueva !== "") {
            echo $this->aviso_inicio . $this->error_contrasenaNueva . $this->aviso_cierre;
        }
    }
    public function mostrar_error_contrasenaActual()
    {
        if ($this->error_contrasenaActual !== "") {
            echo $this->aviso_inicio . $this->error_contrasenaActual . $this->aviso_cierre;
        }
    }

    public function regis_valido()
    {
        if (
            $this->error_nombre === "" &&
            $this->error_apellido === "" &&
            $this->error_telefono === "" &&
            $this->error_contrasenaActual === "" &&
            $this->error_localidad === ""
        ) {
            return true;
        } else {
            return false;
        }
    }
}
