<?php
include_once('Conexion.php');
include_once('Usuarios.php');

class Publicacion extends Conexion {

    function __construct() {
		$this->db = parent::__construct();
	}

    public function add($Descripcion, $Servicio, $Marca, $Tipo, $Fecha,$Hora) {

        $usuario=new Usuarios();

        $idUsuario= $usuario->getId(); 
		$statement = $this->db->prepare("INSERT INTO requerimientos (DESCRIPCION,SERVICIO,MARCA,
		TIPO,FECHA,HORA,USUARIOS_ID_USUARIO) VALUES (:Descripcion, :Servicio, :Marca, :Tipo,
		 :Fecha, :Hora, :idUsuario)");

		$statement->bindParam(':Descripcion', $Descripcion);
        $statement->bindParam(':Servicio', $Servicio);
		$statement->bindParam(':Marca', $Marca);
		$statement->bindParam(':Tipo', $Tipo);
		$statement->bindParam(':Fecha', $Fecha);
        $statement->bindParam(':Hora', $Hora);
		$statement->bindParam(':idUsuario', $idUsuario);

        if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

    public function consultarPublicaciones() {

        $usuario=new Usuarios();

        $idUsuario= $usuario->getId(); 
		$statement = $this->db->prepare("SELECT (SELECT CONCAT(NOMBRE, ' ', APELLIDO)
		 FROM usuarios WHERE ID_USUARIO = USUARIOS_ID_USUARIO) AS CLIENTE,
		  (SELECT CONCAT(LOCALIDAD) FROM usuarios WHERE ID_USUARIO = USUARIOS_ID_USUARIO)
		   AS LOCALIDAD,ID_PUBLICACION, DESCRIPCION, SERVICIO, MARCA, TIPO, FECHA, HORA FROM requerimientos");
        
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
	}

	public function servicioAceptado($Fecha, $Hora, $Ubicacion, $idPublicacion) {

        $usuario=new Usuarios();

        $idTecnico= $usuario->getId(); 
		$statement = $this->db->prepare("INSERT INTO agenda (FECHA,HORA,UBICACION,
		TECNICOS_ID_TECNICO,REQUERIMIENTOS_ID_PUBLICACION,ESTADO) 
		VALUES (:Fecha, :Hora, :Ubicacion, :idTecnico, :idPublicacion, 'pendiente')");

		$statement->bindParam(':Fecha', $Fecha);
        $statement->bindParam(':Hora', $Hora);
        $statement->bindParam(':Ubicacion', $Ubicacion);
		$statement->bindParam(':idTecnico', $idTecnico);
		$statement->bindParam(':idPublicacion', $idPublicacion);

        if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function idPublicacion() {

        $usuario=new Usuarios();
        $idUsuario= $usuario->getId(); 
		$statement = $this->db->prepare("SELECT * FROM requerimientos
		 WHERE USUARIOS_ID_USUARIO  = :idUsuario ");
        $statement->bindParam(':idUsuario', $idUsuario);
        $statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function consultarServiciosAceptados($idPublicacion) {

		$statement = $this->db->prepare("SELECT * FROM agenda
		 WHERE REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion");
        $statement->bindParam(':idPublicacion', $idPublicacion);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
	}

	public function informacionTecnico($idTecnico) {

		$statement = $this->db->prepare("SELECT * FROM tecnicos WHERE ID_TECNICO = :idTecnico ");
        $statement->bindParam(':idTecnico', $idTecnico);
        $statement->execute();

        $result = $statement->fetch();
        return $result;
	}

}

?>