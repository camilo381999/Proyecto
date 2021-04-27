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

			if ($Correo == "administrador@tecniclick.com") {
				$_SESSION['NOMBRE'] = "Administrador";
				$_SESSION['ID'] = $result['ID_USUARIO'];
				$_SESSION['PERFIL'] = "Administrador";
				return $result;
			} else {
				//Obtener el nombre y el id del usuario
				$_SESSION['NOMBRE'] = $result['NOMBRE'] . " " . $result['APELLIDO'];
				$_SESSION['ID'] = $result['ID_USUARIO'];
				$_SESSION['PERFIL'] = "Usuario";
				return $result;
			}

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
				$_SESSION['ESTADO'] = $result['ESTADO'];

				return $result;
			}
		}
		return null;
	}

	public function login2($Correo)
	{
		$statement = $this->db->prepare("SELECT * FROM usuarios
		 WHERE CORREO = :Correo");
		$statement->bindParam(':Correo', $Correo);
		$statement->execute();

		if ($statement->rowCount() == 1) {
			$result = $statement->fetch();
			return $result;
		} else {
			$statement = $this->db->prepare("SELECT * FROM tecnicos
			 WHERE CORREO = :Correo AND ESTADO = 'Activo' ");

			$statement->bindParam(':Correo', $Correo);
			$statement->execute();
			if ($statement->rowCount() == 1) {
				$result = $statement->fetch();
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

	public function add_tecnico($Nombre, $Apellido, $Cedula, $Correo, $Telefono, $Password, $Localidad)
	{

		$statement = $this->db->prepare("INSERT INTO tecnicos (ID_TECNICO,NOMBRE,APELLIDO,
		PASSWORD,CALIFICACION,CORREO,TELEFONO,ESTADO,LOCALIDAD) VALUES (:Cedula, :Nombre, :Apellido,
		 :Password, 4 , :Correo, :Telefono, 'Activo', :Localidad)");

		$statement->bindParam(':Cedula', $Cedula);
		$statement->bindParam(':Nombre', $Nombre);
		$statement->bindParam(':Apellido', $Apellido);
		$statement->bindParam(':Password', $Password);
		$statement->bindParam(':Correo', $Correo);
		$statement->bindParam(':Telefono', $Telefono);
		$statement->bindParam(':Localidad', $Localidad);

		if ($statement->execute()) {
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

	public function updatePassword($Id, $Password)
	{
		$statement = $this->db->prepare("UPDATE usuarios SET PASSWORD =:Password WHERE ID_USUARIO =:Id");
		$statement->bindParam(':Id', $Id);
		$statement->bindParam(':Password', $Password);
		$statement->execute();

		/* $statement = $this->db->prepare("UPDATE tecnicos SET PASSWORD =:Password WHERE ID_TECNICO =:Id");
		$statement->bindParam(':Id', $Id);
		$statement->bindParam(':Password', $Password);
		$statement->execute(); */
	}

	public function updatePasswordTecnico($Id, $Password)
	{
		$statement = $this->db->prepare("UPDATE tecnicos SET PASSWORD =:Password WHERE ID_TECNICO =:Id");
		$statement->bindParam(':Id', $Id);
		$statement->bindParam(':Password', $Password);
		$statement->execute();
	} 

	public function estadoTecnico($id, $estado)
	{
		$statement = $this->db->prepare("UPDATE tecnicos SET ESTADO =:Estado WHERE ID_TECNICO =:Id");
		$statement->bindParam(':Id', $id);
		$statement->bindParam(':Estado', $estado);

		if ($statement->execute()) {
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

	public function getByCorreo($Correo)
	{
		$statement = $this->db->prepare("SELECT * FROM usuarios WHERE CORREO = :Correo");
		$statement->bindParam(':Correo', $Correo);
		$statement->execute();
		if ($statement->rowCount() == 1) {
			$result = $statement->fetch();
		}
		return $result;
	}

	public function getByCorreoTecnico($Correo)
	{
		$statement = $this->db->prepare("SELECT * FROM tecnicos WHERE CORREO = :Correo");
		$statement->bindParam(':Correo', $Correo);
		$statement->execute();
		if ($statement->rowCount() == 1) {
			$result = $statement->fetch();
		}
		return $result;
	}

	public function getUsuarioByidPublicacion($idPublicacion)
	{

		$statement = $this->db->prepare("SELECT USUARIOS_ID_USUARIO FROM requerimientos
		 WHERE ID_PUBLICACION  = :idPublicacion ");
		$statement->bindParam(':idPublicacion', $idPublicacion);
		$statement->execute();

		$result = $statement->fetch();
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

	public function existe_correoTecnico($Correo)
	{
		$existe_correo = true;
		try {
			$statement = $this->db->prepare("SELECT * FROM tecnicos WHERE CORREO = :Correo");
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

	public function url_secreta($idUsuario, $url)
	{
		$result = false;
		try {
			$statement = $this->db->prepare("INSERT INTO recuperacion_password(ID_USUARIO,URL_SECRETA,FECHA)
			  VALUES (:idUsuario, :url, NOW())");
			$statement->bindParam(':idUsuario', $idUsuario);
			$statement->bindParam(':url', $url);
			$result = $statement->execute();
		} catch (PDOException $ex) {
			print 'ERROR' . $ex->getMessage();
		}
		return $result;
	}

	public function url_secreta_existe($url)
	{
		try {
			$statement = $this->db->prepare("SELECT * FROM recuperacion_password WHERE URL_SECRETA = :url");
			$statement->bindParam(':url', $url);
			$statement->execute();

			//Comprueba si la consulta devuelve solo un usuario 
			if ($statement->rowCount() == 1) {
				$result = $statement->fetch();
			}
		} catch (PDOException $ex) {
			print 'ERROR' . $ex->getMessage();
		}
		return $result;
	}

	public function eliminar_url_secreta_existe($id)
	{
		$statement = $this->db->prepare("DELETE FROM recuperacion_password WHERE ID_RECUPERACION = :Id");
		$statement->bindParam(':Id', $id);

		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
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

	public function setEstado()
	{
		$_SESSION['ESTADO'] = 'Inactivo';
		$this->Salir2();
	}


	public function validateSessionTecnicos()
	{
		if ($_SESSION['ID'] == null) {
			header('location: ingresar.php');
		}
		if ($_SESSION['PERFIL'] == 'Usuario') {
			header('location: index-Clientes.php');
		}
		if ($_SESSION['PERFIL'] == 'Administrador') {
			header('location: index-Admin.php');
		}
		if ($_SESSION['ESTADO'] == 'Inactivo') {
			header('location: ingresar.php');
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

	public function Salir2()
	{
		$_SESSION['ID'] = null;
		$_SESSION['PERFIL'] = null;
		$_SESSION['NOMBRE'] = null;
		session_destroy();
		header('Location: index.php');
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
			if ($_SESSION['PERFIL'] == 'Administrador') {
				header('location: index-Admin.php');
			}
		}
	}

	public function validateSessionClientes()
	{
		if ($_SESSION['ID'] == null) {
			header('location: ingresar.php');
		}

		if ($_SESSION['PERFIL'] == 'Técnico') {
			header('location: index-Tecnicos.php');
		}
		if ($_SESSION['PERFIL'] == 'Administrador') {
			header('location: index-Admin.php');
		}
	}

	public function validateSessionAdmin()
	{
		if ($_SESSION['ID'] == null) {
			header('location: ingresar.php');
		}

		if ($_SESSION['PERFIL'] == 'Técnico') {
			header('location: index-Tecnicos.php');
		}
		if ($_SESSION['PERFIL'] == 'Usuario') {
			header('location: index-Clientes.php');
		}
	}
}
