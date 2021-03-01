<?php

class ValidarRegistro{

    private $aviso_inicio;
    private $aviso_cierre;

    private $nombre;
    private $apellido;
    private $cedula;
    private $correo;
    private $telefono;
    private $contrasena1;

    private $error_nombre;
    private $error_apellido;
    private $error_cedula;
    private $error_correo;
    private $error_telefono;
    private $error_contrasena;

    public function __construct($nombre, $apellido, $cedula,$correo,$telefono, $contrasena) {
       
        $this -> aviso_inicio = "<br><div class='alert alert-primary' role='alert'>";
        $this -> aviso_cierre = "</div>";
       
        $this -> nombre = "";
        $this -> apellido = "";
        $this -> cedula = "";
        $this -> correo = "";
        $this -> telefono = "";
        $this -> contrasena1 = "";

        //llama los metodos y si hay error los guarda en cada variable
        $this ->error_nombre = $this -> validar_nom($nombre);
        $this ->error_apellido = $this -> validar_ape($apellido);
        $this ->error_cedula = $this -> validar_cedu($cedula);
        $this ->error_correo = $this -> validar_cor($correo);
        $this ->error_telefono = $this -> validar_tel($telefono);
        $this ->error_contrasena = $this -> validar_cont($contrasena);

        if($this->error_contrasena === ""){
            $this -> contrasena1 = $contrasena;
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

    //llama al metodo var_iniciada y si no esta vacia le asigna el valor a la variable 
    //si está vacia devuelve el error
    private function validar_nom($nombre){
        if(!$this -> var_iniciada($nombre)){
            return "Por favor escriba su nombre";
        }else{
            $this -> nombre = $nombre;
        }

        return "";
    }

    private function validar_ape($apellido){
        if(!$this -> var_iniciada($apellido)){
            return "Por favor escriba su apellido";
        }else{
            $this -> apellido = $apellido;
        }

        return "";
    }

    private function validar_cedu($cedula){
        if(!$this -> var_iniciada($cedula)){
            return "Por favor escriba su cédula";
        }else{
            $this -> cedula = $cedula;
        }

        return "";
    }

    private function validar_cor($correo){
        if(!$this -> var_iniciada($correo)){
            return "Por favor escriba su correo";
        }else{
            $this -> correo = $correo;
        }

        return "";
    }

    private function validar_tel($telefono){
        if(!$this -> var_iniciada($telefono)){
            return "Por favor escriba su teléfono";
        }else{
            $this -> telefono = $telefono;
        }

        return "";
    }

    private function validar_cont($contrasena){
        if(!$this -> var_iniciada($contrasena)){
            return "Por favor escriba su contraseña";
        }

        return "";
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getApellido(){
        return $this -> apellido;
    }
    public function getCedula(){
        return $this -> cedula;
    }
    public function getCorreo(){
        return $this -> correo;
    }
    public function getTelefono(){
        return $this -> telefono;
    }
    public function getContrasena(){
        return $this -> contrasena1;
    }


    public function get_error_nombre(){
        return $this -> error_nombre;
    }

    public function get_error_apellido(){
        return $this -> error_apellido;
    }
    public function get_error_cedula(){
        return $this -> error_cedula;
    }
    public function get_error_correo(){
        return $this -> error_correo;
    }
    public function get_error_telefono(){
        return $this -> error_telefono;
    }
    public function get_error_contrasena(){
        return $this -> error_contrasena;
    }

    //Muestra el nombre en value cuando se ha enviado el formulario y hay un error
    public function mostrar_nombre(){
        if($this -> nombre !== ""){
            echo 'value="'.$this -> nombre .'"';
        }
    }

    //muestra el error con bootstrap
    public function mostrar_error_nombre(){
        if($this -> error_nombre !== ""){
            echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
        }
    }

    public function mostrar_apellido(){
        if($this -> apellido !== ""){
            echo 'value="'.$this -> apellido .'"';
        }
    }

    public function mostrar_error_apellido(){
        if($this -> error_apellido !== ""){
            echo $this -> aviso_inicio . $this -> error_apellido . $this -> aviso_cierre;
        }
    }

    public function mostrar_cedula(){
        if($this -> cedula !== ""){
            echo 'value="'.$this -> cedula .'"';
        }
    }

    public function mostrar_error_cedula(){
        if($this -> error_cedula !== ""){
            echo $this -> aviso_inicio . $this -> error_cedula . $this -> aviso_cierre;
        }
    }

    public function mostrar_correo(){
        if($this -> correo !== ""){
            echo 'value="'.$this -> correo .'"';
        }
    }

    public function mostrar_error_correo(){
        if($this -> error_correo !== ""){
            echo $this -> aviso_inicio . $this -> error_correo . $this -> aviso_cierre;
        }
    }

    public function mostrar_telefono(){
        if($this -> telefono !== ""){
            echo 'value="'.$this -> telefono .'"';
        }
    }

    public function mostrar_error_telefono(){
        if($this -> error_telefono !== ""){
            echo $this -> aviso_inicio . $this -> error_telefono . $this -> aviso_cierre;
        }
    }

    public function mostrar_error_contrasena(){
        if($this -> error_contrasena !== ""){
            echo $this -> aviso_inicio . $this -> error_contrasena . $this -> aviso_cierre;
        }
    }

    public function regis_valido(){
        if($this -> error_nombre === "" &&
         $this -> error_apellido === "" &&
         $this -> error_cedula === "" &&
         $this -> error_correo === "" &&
         $this -> error_telefono === "" &&
         $this -> error_contrasena === "" ){
            return true;
         }else{
             return false;
         }
    }
}
?>