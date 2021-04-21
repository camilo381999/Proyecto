<?php

include_once('Usuarios.php');

class ValidarLogin
{
    private $result;
    private $usuarios;
    private $error;

    public function __construct($correo, $contrasena){
        $this -> usuarios = new Usuarios();
        $this -> error = "";

        if(!$this-> var_iniciada($correo) || !$this-> var_iniciada($contrasena)){
            $this -> error = "Se debe introducir un correo y una contraseña";
        }else{
            $this -> result = $this -> usuarios-> login2($correo);
            if(is_null($this -> result) || !password_verify($contrasena,$this -> result['PASSWORD'])){
                $this -> error = "Datos incorrectos";
            }elseif(password_verify($contrasena,$this -> result['PASSWORD'])){
                $this -> result = $this->usuarios ->login($correo);
            }
        }
    }

    //Valida si la contraseña es null o vacia
    private function var_iniciada($var) {
        if( isset($var) && !empty($var)){
          return true;
        }else{
          return false;
        }
      }

    public function getResult(){
        return $this -> result; 
    }

    public function obtener_error(){
        return $this -> error; 
    }

    public function mostrar_error(){
        if($this -> error !== ""){
            echo "<div class='alert alert-primary' role='alert'>" . $this -> error ."</div>" ;
        }
    }
}
