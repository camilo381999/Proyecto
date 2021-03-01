<?php 
 include_once('Usuarios.php');

 class Add{

	private $Nombre;
	private $Apellido;
   	private $Cedula;
   	private $Correo;
   	private $Telefono;
	private $Password;

	public function __construct($Nombre, $Apellido, $Cedula, $Correo,
	$Telefono, $Password)
	{
		$this -> Nombre = $Nombre;
		$this -> Apellido = $Apellido;
		$this -> Cedula = $Cedula;
		$this -> Correo = $Correo;
		$this -> Telefono = $Telefono;
		$this -> Password = $Password;

		$this->Insertar();
		
	}
	
	public function get_Nombre(){
		return $this -> Nombre;
	}
	public function get_Apellido(){
		return $this -> Apellido;
	}
	public function get_Cedula(){
		return $this -> Cedula;
	}
	public function get_Correo(){
		return $this -> Correo;
	}
	public function get_Telefono(){
		return $this -> Telefono;
	}
	public function get_Password(){
		return $this -> Password;
	}

	 public function Insertar(){
		$Modelo =  new Usuarios();

		if($Modelo->add($this->Nombre, $this -> Apellido,
		 $this -> Cedula, $this -> Correo,
		 $this -> Telefono, $this -> Password)){
			 header('Location: Clientes/Pages/index.php');
	   	}else{
		 header('Location: registro.php');
	  	}
	} 


 }

 /* if ($_POST) {
 	 $Modelo =  new Usuarios();

 	 $Nombre = $_POST['Nombre'];
 	 $Apellido = $_POST['Apellido'];
	 $Cedula = $_POST['Cedula'];
     $Correo = $_POST['Correo'];
     $Telefono = $_POST['Telefono'];
 	 $Password = $_POST['Contrasena'];

	  if($Modelo->add($Nombre, $Apellido, $Cedula, $Correo,
	   $Telefono, $Password)){
			header('Location: ../Pages/index.php');
	  }else{
		header('Location: ../../registro.php');
	  }

 }else{
 	header('Location: ../../registro.php');
 } */




 ?>