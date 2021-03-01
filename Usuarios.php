<?php 

include_once('Conexion.php');
session_start();

class Usuarios extends Conexion
{
	
	function __construct()
	{
		$this->db = parent::__construct();
	}

	//Metodo para realizar el llamado a la base de datos y comprobar el inicio de sesion
	public function login($Correo,$Password){
		$statement = $this->db->prepare("SELECT * FROM usuarios
		 WHERE CORREO = :Correo AND PASSWORD = :Password");
		 
		$statement->bindParam(':Correo',$Correo);
		$statement->bindParam(':Password',$Password);
		$statement->execute();
		
		//Comprueba si la consulta devuelve solo un usuario 
		if ($statement->rowCount() == 1) {
			$result = $statement->fetch();
			
			//Obtener el nombre y el id del usuario
			$_SESSION['NOMBRE'] = $result['NOMBRE'] . " " . $result['APELLIDO'];
			$_SESSION['ID'] = $result['ID_USUARIO'];
			$_SESSION['PERFIL'] = "Usuario";
			return true;
		}else{
			$statement = $this->db->prepare("SELECT * FROM tecnicos
			 WHERE CORREO = :Correo AND PASSWORD = :Password");

			$statement->bindParam(':Correo',$Correo);
			$statement->bindParam(':Password',$Password);
			$statement->execute();

			//Comprueba si la consulta devuelve solo un usuario 
			if($statement->rowCount() == 1) {
				$result = $statement->fetch();
				//Obtener el nombre y el id del tecnico
				$_SESSION['NOMBRE'] = $result['NOMBRE'] . " " . $result['APELLIDO'];
				$_SESSION['ID'] = $result['ID_TECNICO'];
				$_SESSION['PERFIL'] = "Técnico";
				
				return true;
			}
		}
		return false;
	}

	public function add($Nombre, $Apellido, $Cedula, $Correo, $Telefono, $Password){

		$statement = $this->db->prepare("INSERT INTO usuarios (ID_USUARIO,NOMBRE,APELLIDO,
		PASSWORD,CORREO,TELEFONO) VALUES (:Cedula, :Nombre, :Apellido,
		 :Password, :Correo, :Telefono)");

		$statement->bindParam(':Cedula',$Cedula);
		$statement->bindParam(':Nombre',$Nombre);
		$statement->bindParam(':Apellido',$Apellido);
		$statement->bindParam(':Password',$Password);
		$statement->bindParam(':Correo',$Correo);
		$statement->bindParam(':Telefono',$Telefono);            

		if ($statement->execute()) {
			$_SESSION['NOMBRE'] = $Nombre . " " . $Apellido;
			$_SESSION['ID'] = $Cedula;
			$_SESSION['PERFIL'] = "Usuario";
			
			return true;
		}else{
			return false;
		}
	}

	public function getNombre(){
		return $_SESSION['NOMBRE'];
	}

	public function getId(){
		return $_SESSION['ID'];
	}

	public function getPerfil(){
		return $_SESSION['PERFIL'];
	}


	public function validateSession(){
		if ($_SESSION['ID'] == null) {
			header('location: /ingresar.php');
		}
	}

	public function Salir(){
		$_SESSION['ID'] = null;
		$_SESSION['PERFIL'] = null;
		$_SESSION['NOMBRE'] = null;
		session_destroy();
		header('Location: ../index.php');
	}

	public function validateSessionCliente(){
		if ($_SESSION['ID'] != null) {
			if ($_SESSION['PERFIL'] == 'Técnico' ) {
				header('location: ../Tecnicos/index.php');
			}
			
		}else{
					header('location: /ingresar.php');
		}


	}
}

 ?>