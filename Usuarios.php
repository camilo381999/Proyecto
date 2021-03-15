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
	public function login($Correo)
	{
		$statement = $this->db->prepare("SELECT * FROM usuarios
		 WHERE CORREO = :Correo");

		$statement->bindParam(':Correo', $Correo);
		$statement->execute();

		//Comprueba si la consulta devuelve solo un usuario 
		if ($statement->rowCount() == 1) {
			$result = $statement->fetch();

			//Obtener el nombre y el id del usuario
			$_SESSION['NOMBRE'] = $result['NOMBRE'] . " " . $result['APELLIDO'];
			$_SESSION['ID'] = $result['ID_USUARIO'];
			$_SESSION['PERFIL'] = "Usuario";
			return $result;
		} else {
			$statement = $this->db->prepare("SELECT * FROM tecnicos
			 WHERE CORREO = :Correo");

			$statement->bindParam(':Correo', $Correo);
			$statement->execute();

			//Comprueba si la consulta devuelve solo un usuario 
			if ($statement->rowCount() == 1) {
				$result = $statement->fetch();
				//Obtener el nombre y el id del tecnico
				$_SESSION['NOMBRE'] = $result['NOMBRE'] . " " . $result['APELLIDO'];
				$_SESSION['ID'] = $result['ID_TECNICO'];
				$_SESSION['PERFIL'] = "Técnico";

				return $result;
			}
		}
		return null;
	}

	public function add($Nombre, $Apellido, $Cedula, $Correo, $Telefono, $Password, $Localidad)
	{

		$statement = $this->db->prepare("INSERT INTO usuarios (ID_USUARIO,NOMBRE,APELLIDO,
		PASSWORD,CORREO,TELEFONO,LOCALIDAD) VALUES (:Cedula, :Nombre, :Apellido,
		 :Password, :Correo, :Telefono, :Localidad)");

		$statement->bindParam(':Cedula', $Cedula);
		$statement->bindParam(':Nombre', $Nombre);
		$statement->bindParam(':Apellido', $Apellido);
		$statement->bindParam(':Password', $Password);
		$statement->bindParam(':Correo', $Correo);
		$statement->bindParam(':Telefono', $Telefono);
		$statement->bindParam(':Localidad', $Localidad);

		if ($statement->execute()) {
			$_SESSION['NOMBRE'] = $Nombre . " " . $Apellido;
			$_SESSION['ID'] = $Cedula;
			$_SESSION['PERFIL'] = "Usuario";

			return true;
		} else {
			return false;
		}
	}

	public function update($Id, $Nombre, $Apellido, $Telefono, $Password, $Localidad)
	{

		$statement = $this->db->prepare("UPDATE usuarios SET NOMBRE =:Nombre, APELLIDO =:Apellido, TELEFONO = :Telefono, PASSWORD 
			=:Password,LOCALIDAD =:Localidad WHERE ID_USUARIO = :Id");
		$statement->bindParam(':Id', $Id);
		$statement->bindParam(':Nombre', $Nombre);
		$statement->bindParam(':Apellido', $Apellido);
		$statement->bindParam(':Telefono', $Telefono);
		$statement->bindParam(':Password', $Password);
		$statement->bindParam(':Localidad', $Localidad);

		if ($statement->execute()) {
			$_SESSION['NOMBRE'] = $Nombre . " " . $Apellido;
			return true;
		} else {
			return false;
		}
	}

	public function updateTecnico($Id, $Nombre, $Apellido, $Telefono, $Password, $Localidad)
	{

		$statement = $this->db->prepare("UPDATE tecnicos SET NOMBRE =:Nombre, APELLIDO =:Apellido, TELEFONO = :Telefono, PASSWORD 
			=:Password,LOCALIDAD =:Localidad WHERE ID_TECNICO = :Id");
		$statement->bindParam(':Id', $Id);
		$statement->bindParam(':Nombre', $Nombre);
		$statement->bindParam(':Apellido', $Apellido);
		$statement->bindParam(':Telefono', $Telefono);
		$statement->bindParam(':Password', $Password);
		$statement->bindParam(':Localidad', $Localidad);

		if ($statement->execute()) {
			$_SESSION['NOMBRE'] = $Nombre . " " . $Apellido;
			return true;
		} else {
			return false;
		}
	}

	public function getById($Id)
	{
		$statement = $this->db->prepare("SELECT * FROM usuarios WHERE ID_USUARIO = :Id");
		$statement->bindParam(':Id', $Id);
		$statement->execute();
		if ($statement->rowCount() == 1) {
			$result = $statement->fetch();
		}
		return $result;
	}

	public function getByIdTecnico($Id)
	{
		$statement = $this->db->prepare("SELECT * FROM tecnicos WHERE ID_TECNICO = :Id");
		$statement->bindParam(':Id', $Id);
		$statement->execute();
		if ($statement->rowCount() == 1) {
			$result = $statement->fetch();
		}
		return $result;
	}

	public function existe_correo($Correo)
	{
		$existe_correo = true;
		try {
			$statement = $this->db->prepare("SELECT * FROM usuarios WHERE CORREO = :Correo");
			$statement->bindParam(':Correo', $Correo);
			$statement->execute();

			//Comprueba si la consulta devuelve solo un usuario 
			if ($statement->rowCount() > 0) {
				$existe_correo = true;
			} else {
				$existe_correo = false;
			}
		} catch (PDOException $ex) {
			print 'ERROR' . $ex->getMessage();
		}
		return $existe_correo;
	}

	public function existe_cedula($Cedula)
	{
		$existe_cedula = true;
		try {
			$statement = $this->db->prepare("SELECT * FROM usuarios WHERE ID_USUARIO = :Cedula");
			$statement->bindParam(':Cedula', $Cedula);
			$statement->execute();

			//Comprueba si la consulta devuelve solo un usuario 
			if ($statement->rowCount() > 0) {
				$existe_cedula = true;
			} else {
				$existe_cedula = false;
			}
		} catch (PDOException $ex) {
			print 'ERROR' . $ex->getMessage();
		}
		return $existe_cedula;
	}

	public function existe_telefono($Telefono)
	{
		$existe_telefono = true;
		try {
			$statement = $this->db->prepare("SELECT * FROM usuarios WHERE TELEFONO = :Telefono");
			$statement->bindParam(':Telefono', $Telefono);
			$statement->execute();

			//Comprueba si la consulta devuelve solo un usuario 
			if ($statement->rowCount() > 0) {
				$existe_telefono = true;
			} else {
				$existe_telefono = false;
			}
		} catch (PDOException $ex) {
			print 'ERROR' . $ex->getMessage();
		}
		return $existe_telefono;
	}



	public function getNombre()
	{
		return $_SESSION['NOMBRE'];
	}

	public function getId()
	{
		return $_SESSION['ID'];
	}

	public function getPerfil()
	{
		return $_SESSION['PERFIL'];
	}


	public function validateSessionTecnicos()
	{
		if ($_SESSION['ID'] == null) {
			header('location: /Proyecto/ingresar.php');
		}
		if ($_SESSION['PERFIL'] == 'Usuario') {
			header('location: index-Clientes.php');
		}
	}

	public function sesionIniciada()
	{
		if (isset($_SESSION['ID']) && isset($_SESSION['PERFIL'])) {
			return true;
		} else {
			return false;
		}
	}

	public function Salir()
	{
		$_SESSION['ID'] = null;
		$_SESSION['PERFIL'] = null;
		$_SESSION['NOMBRE'] = null;
		session_destroy();
		header('Location: ../index.php');
	}

	public function validateSessionIndex()
	{
		if ($this->sesionIniciada()) {
			if ($_SESSION['PERFIL'] == 'Técnico') {
				header('location: index-Tecnicos.php');
			}
			if ($_SESSION['PERFIL'] == 'Usuario') {
				header('location: index-Clientes.php');
			}
		}
	}

	public function validateSessionClientes()
	{
		if ($_SESSION['ID'] == null) {
			header('location: /Proyecto/ingresar.php');
		}

		if ($_SESSION['PERFIL'] == 'Técnico') {
			header('location: index-Tecnicos.php');
		}
	}
}
