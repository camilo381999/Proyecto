<?php
include_once('Conexion.php');
include_once('Usuarios.php');
include_once('Publicacion.php');

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
		  (SELECT LOCALIDAD FROM usuarios WHERE ID_USUARIO = USUARIOS_ID_USUARIO) AS LOCALIDAD,
		   ID_PUBLICACION, DESCRIPCION, SERVICIO, MARCA, TIPO, FECHA, HORA, USUARIOS_ID_USUARIO FROM requerimientos");
        
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
	}

	public function selectPendiente() {

		$statement = $this->db->prepare("SELECT * FROM pendiente ");
        $statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function selectAceptadosPendienteByIdPost($idPublicacion) {

		$statement = $this->db->prepare("SELECT * FROM pendiente WHERE ESTADO_SERVICIO = 'Aceptado' AND REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion");
        $statement->bindParam(':idPublicacion', $idPublicacion);
		
		$statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function selectPendienteByIdPost($idPublicacion, $idTecnico) {
		$statement = $this->db->prepare("SELECT * FROM pendiente WHERE ID_TECNICO = :idTecnico AND REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion");
        $statement->bindParam(':idTecnico', $idTecnico);
		$statement->bindParam(':idPublicacion', $idPublicacion);
		
		$statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function servicioAceptado($Fecha, $Hora, $Ubicacion,$idTecnico,$idPendiente) {

		$statement = $this->db->prepare("INSERT INTO agenda (FECHA,HORA,UBICACION,
		TECNICOS_ID_TECNICO,ESTADO,PENDIENTE_ID_PENDIENTE) 
		VALUES (:Fecha, :Hora, :Ubicacion, :idTecnico, 'Aceptado', :idPendiente)");

		$statement->bindParam(':Fecha', $Fecha);
        $statement->bindParam(':Hora', $Hora);
        $statement->bindParam(':Ubicacion', $Ubicacion);
		$statement->bindParam(':idTecnico', $idTecnico);
		$statement->bindParam(':idPendiente', $idPendiente);

        if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function servicioPendiente($Boton, $idPublicacion, $Fecha, $Hora, $Ubicacion) {

        $usuario=new Usuarios();
		$idCl= $usuario->getUsuarioByidPublicacion($idPublicacion);
        $idTecnico= $usuario->getId();
		$nombreTecnico = $usuario->getNombre();
		$idCliente = $idCl['USUARIOS_ID_USUARIO'];

		$requerimiento= $this->publicacion($idCliente, $idPublicacion);

		$tipoServicio = $requerimiento['SERVICIO'];
		
		$tecnico=$usuario->getByIdTecnico($idTecnico);
		$correoTecnico = $tecnico['CORREO'];

		$statement = $this->db->prepare("INSERT INTO pendiente (NOMBRE_TECNICO, LOCALIDAD, TIPO_SERVICIO, ESTADO_SERVICIO, ID_TECNICO,
		ID_CLIENTE,CORREO_TECNICO, CAMBIOS_TECNICO, FECHA, HORA, REQUERIMIENTOS_ID_PUBLICACION) 
		VALUES (:NombreTecnico,:Ubicacion, :TipoServicio, 'Pendiente', :idTecnico, :idCliente, :CorreoTecnico, :Boton, :Fecha, :Hora, :idPublicacion)");

		$statement->bindParam(':NombreTecnico',$nombreTecnico);
		$statement->bindParam(':Ubicacion', $Ubicacion);
		$statement->bindParam(':TipoServicio',$tipoServicio);
		$statement->bindParam(':idTecnico', $idTecnico);
		$statement->bindParam(':idCliente',$idCliente);
		$statement->bindParam(':CorreoTecnico',$correoTecnico);
		$statement->bindParam(':Boton',$Boton);
		$statement->bindParam(':Fecha', $Fecha);
        $statement->bindParam(':Hora', $Hora);
		$statement->bindParam(':idPublicacion',$idPublicacion);

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

        $result = $statement->fetchAll();
        return $result;
	}

	public function getPendienteByidClient($idCliente) {
		$statement = $this->db->prepare("SELECT * FROM pendiente
		WHERE ID_CLIENTE  = :idUsuario AND ESTADO_SERVICIO = 'Pendiente' ");
        $statement->bindParam(':idUsuario', $idCliente);
        $statement->execute();

        $result = $statement->fetch();
		return $result;        
	}

	public function updateEstadoServicioPend($idPendiente) {
		
		$statement = $this->db->prepare("UPDATE pendiente SET ESTADO_SERVICIO = 'Aceptado'
		WHERE ID_PENDIENTE  = :idPendiente ");
        $statement->bindParam(':idPendiente', $idPendiente);
        $statement->execute();
	}	

	public function deleteRequerimiento($idCliente) {
		
		$statement = $this->db->prepare("DELETE FROM requerimientos
		WHERE USUARIOS_ID_USUARIO = :idCliente ");
        $statement->bindParam(':idCliente', $idCliente);
        $statement->execute();
	}	

	public function deletePendiente($idCliente) {
		
		$statement = $this->db->prepare("DELETE FROM pendiente
		WHERE ID_CLIENTE = :idCliente AND ESTADO_SERVICIO = 'Pendiente' ");
        $statement->bindParam(':idCliente', $idCliente);
        $statement->execute();
	}	

	public function getPostByid($idPublicacion) {

		$statement = $this->db->prepare("SELECT (SELECT CONCAT(NOMBRE, ' ', APELLIDO)
		FROM usuarios WHERE ID_USUARIO = USUARIOS_ID_USUARIO) AS CLIENTE,
		 (SELECT CONCAT(LOCALIDAD) FROM usuarios WHERE ID_USUARIO = USUARIOS_ID_USUARIO)
		  AS LOCALIDAD,ID_PUBLICACION, DESCRIPCION, SERVICIO, MARCA, TIPO, FECHA, HORA FROM requerimientos
		WHERE ID_PUBLICACION = :idPublicacion ");
        $statement->bindParam(':idPublicacion', $idPublicacion);
        $statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function publicacion($idUsuario, $idPublicacion) {

		$statement = $this->db->prepare("SELECT * FROM requerimientos
		WHERE USUARIOS_ID_USUARIO  = :idUsuario AND ID_PUBLICACION = :idRequerimiento ");
        $statement->bindParam(':idUsuario', $idUsuario);
		$statement->bindParam(':idRequerimiento', $idPublicacion);
        $statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function consultarServiciosAceptados($idPublicacion) {

		$statement = $this->db->prepare("SELECT * FROM pendiente
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