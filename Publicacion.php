<?php
include_once('Conexion.php');
include_once('Usuarios.php');
include_once('Publicacion.php');

class Publicacion extends Conexion {

    function __construct() {
		$this->db = parent::__construct();
	}

    public function add($Direccion,$Descripcion, $Servicio, $Marca, $Tipo, $Fecha,$Hora) {

        $usuario=new Usuarios();

        $idUsuario= $usuario->getId(); 
		$statement = $this->db->prepare("INSERT INTO requerimientos (DIRECCION,DESCRIPCION,SERVICIO,MARCA,
		TIPO,FECHA,HORA,USUARIOS_ID_USUARIO) VALUES (:Direccion,:Descripcion, :Servicio, :Marca, :Tipo,
		 :Fecha, :Hora, :idUsuario)");

		$statement->bindParam(':Direccion', $Direccion);
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
		print_r($result);
        return $result;
	}

	public function selectPendienteByIdPost($idPublicacion, $idTecnico) {

		$statement = $this->db->prepare("SELECT * FROM pendiente WHERE ID_TECNICO = :idTecnico AND REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion ");
        $statement->bindParam(':idTecnico', $idTecnico);
		$statement->bindParam(':idPublicacion', $idPublicacion);
		
		$statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function getPendienteXIdPost($idPublicacion) {

		$statement = $this->db->prepare("SELECT * FROM pendiente WHERE REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion ");
		$statement->bindParam(':idPublicacion', $idPublicacion);
		
		$statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function selectAceptadosPendienteByIdCliente($idCliente) {
		$statement = $this->db->prepare("SELECT * FROM pendiente WHERE ESTADO_SERVICIO = 'Aceptado' AND ID_CLIENTE = :idCliente");
        $statement->bindParam(':idCliente', $idCliente);
		
		$statement->execute();

        $result = $statement->fetchAll();
        return $result;
	}

	//Crea el nuevo dato en la agenda
	public function servicioAceptado($Fecha, $Hora, $Ubicacion,$idTecnico,$idPendiente,$costo) {
		echo $Fecha." - ".$Hora." - ".$idTecnico." - ".$idPendiente;
		$statement = $this->db->prepare("INSERT INTO agenda (FECHA,HORA,UBICACION,
		TECNICOS_ID_TECNICO,ESTADO,PENDIENTE_ID_PENDIENTE,COSTO) 
		VALUES (:Fecha, :Hora, :Ubicacion, :idTecnico, 'Aceptado', :idPendiente, :Costo)");

		$statement->bindParam(':Fecha', $Fecha);
        $statement->bindParam(':Hora', $Hora);
        $statement->bindParam(':Ubicacion', $Ubicacion);
		$statement->bindParam(':idTecnico', $idTecnico);
		$statement->bindParam(':idPendiente', $idPendiente);
		$statement->bindParam(':Costo', $costo);

        if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	//Actualiza el estado de pendiente a aceptado 
	public function updateEstadoServicioPend($idPendiente, $idTecnico) {
		//echo "UPDATE pendiente SET ESTADO_SERVICIO = 'Aceptado' WHERE ID_PENDIENTE  = ".$idPendiente." AND ID_TECNICO = ".$idTecnico;
		$statement = $this->db->prepare("UPDATE pendiente SET ESTADO_SERVICIO = 'Aceptado'
		WHERE ID_PENDIENTE  = :idPendiente AND ID_TECNICO = :idTecnico");
        $statement->bindParam(':idPendiente', $idPendiente);
		$statement->bindParam(':idTecnico', $idTecnico);
		$statement->execute();
	}

	//Borra las publicaciones que tengan el mismo id de requerimiento y su estado sea pendiente
	public function deletePendiente($idCliente,$idPublicacion) {
		
		$statement = $this->db->prepare("DELETE FROM pendiente
		WHERE ID_CLIENTE = :idCliente AND ESTADO_SERVICIO = 'Pendiente' AND REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion");
        $statement->bindParam(':idCliente', $idCliente);
		$statement->bindParam(':idPublicacion', $idPublicacion);
        $statement->execute();
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

	//busca las publicaciones en las que los tecnicos han aceptado pq quieren tomar ese servicio
	public function selectPublicacionXidCliente($idCliente) {
		$statement = $this->db->prepare("SELECT * FROM requerimientos WHERE USUARIOS_ID_USUARIO  = :idCliente ");
        $statement->bindParam(':idCliente', $idCliente);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
	}

	public function idPublicacion() {

        $usuario=new Usuarios();
        $idUsuario= $usuario->getId(); 
		$statement = $this->db->prepare("SELECT * FROM requerimientos WHERE USUARIOS_ID_USUARIO  = :idUsuario ");
        $statement->bindParam(':idUsuario', $idUsuario);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
	}

	public function getPendienteByidClient($idCliente,$idPublicacion,$idTecnico) {
		$statement = $this->db->prepare("SELECT * FROM pendiente
		WHERE ID_CLIENTE  = :idUsuario AND ID_TECNICO  = :idTecnico AND REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion AND ESTADO_SERVICIO = 'Pendiente' ");
        $statement->bindParam(':idUsuario', $idCliente);
		$statement->bindParam(':idTecnico', $idTecnico);
		$statement->bindParam(':idPublicacion', $idPublicacion);
        $statement->execute();

        $result = $statement->fetch();
		return $result;        
	}

	public function cancelacionServicioPendiente($fecha, $hora, $idPendiente){
		$statement = $this->db->prepare("SELECT IF( DATEDIFF(:fecha, CURRENT_DATE) >= 1 ,'true','false') AS DIFDATE");
		//echo "SELECT IF( DATEDIFF(".$fecha.", CURRENT_DATE) >= 1 ,'true','false') AS DIFDATE";
		$statement->bindParam(':fecha', $fecha);
        $statement->execute();
		$boolFechaQ = $statement->fetch();
		$boolFecha=$boolFechaQ['DIFDATE'];

		if($boolFecha=="true"){
			//echo "falta mas de un dia";
			$statement = $this->db->prepare("UPDATE pendiente SET ESTADO_SERVICIO = 'Cancelado'
			WHERE ID_PENDIENTE  = :idPendiente ");
			$statement->bindParam(':idPendiente', $idPendiente);
			$statement->execute();

			$statement = $this->db->prepare("UPDATE agenda SET ESTADO = 'Cancelado'
			WHERE PENDIENTE_ID_PENDIENTE  = :idPendiente ");
			$statement->bindParam(':idPendiente', $idPendiente);
			$statement->execute();
			return true;
		}else{
			//echo "en el mismo dia";
			$statement = $this->db->prepare("SELECT IF( TIMEDIFF(:hora, CURRENT_TIME) >= '2:00:00' ,'true','false') AS DIFTIME");
			$statement->bindParam(':hora', $hora);
			$statement->execute();
			$boolHoraQ = $statement->fetch();
			$boolHora=$boolHoraQ['DIFTIME'];
			//echo $boolHora;
			if($boolHora=="true"){
				$statement = $this->db->prepare("UPDATE pendiente SET ESTADO_SERVICIO = 'Cancelado'
				WHERE ID_PENDIENTE  = :idPendiente ");
				$statement->bindParam(':idPendiente', $idPendiente);
				$statement->execute();

				$statement = $this->db->prepare("UPDATE agenda SET ESTADO = 'Cancelado'
				WHERE PENDIENTE_ID_PENDIENTE  = :idPendiente ");
				$statement->bindParam(':idPendiente', $idPendiente);
				$statement->execute();
				return true;
			}else{
				//echo "La cancelacion de servicios debe realizarse con 2 horas de anticipacion, por fvor cominiquese con su tecnico";
				return false;
			}

		}

		
	}
	
	public function getPublicacionByidPost($idPublicacion) {

		$statement = $this->db->prepare("SELECT (SELECT CONCAT(NOMBRE, ' ', APELLIDO)
		FROM usuarios WHERE ID_USUARIO = USUARIOS_ID_USUARIO) AS CLIENTE,
		 (SELECT CONCAT(LOCALIDAD) FROM usuarios WHERE ID_USUARIO = USUARIOS_ID_USUARIO)
		  AS LOCALIDAD,ID_PUBLICACION, DESCRIPCION, SERVICIO, MARCA, TIPO, FECHA, HORA FROM requerimientos
		WHERE ID_PUBLICACION = :idPublicacion ");
        $statement->bindParam(':idPublicacion', $idPublicacion);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
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


	//Obtiene cada pendiente por el id de la publicacion
	public function consultarServiciosAceptados($idPublicacion) {

		$statement = $this->db->prepare("SELECT * FROM pendiente
		 WHERE REQUERIMIENTOS_ID_PUBLICACION = :idPublicacion");
        $statement->bindParam(':idPublicacion', $idPublicacion);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
	}

	public function informacionTecnico($idTecnico) {

		$statement = $this->db->prepare("SELECT * FROM tecnicos
		 WHERE ID_TECNICO = :idTecnico ");
        $statement->bindParam(':idTecnico', $idTecnico);
        $statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	public function get_agenda($Id)
	{
		$statement = $this->db->prepare("SELECT * FROM agenda
		 WHERE TECNICOS_ID_TECNICO = :Id AND ESTADO = 'Aceptado' ");
		$statement->bindParam(':Id', $Id);
		$statement->execute();
		$result = $statement->fetchAll();
        return $result;
	}

	public function get_agenda_historial($Id)
	{
		$statement = $this->db->prepare("SELECT * FROM agenda
		 WHERE TECNICOS_ID_TECNICO = :Id AND (ESTADO = 'Terminado' OR ESTADO = 'Cancelado')");
		$statement->bindParam(':Id', $Id);
		$statement->execute();
		$result = $statement->fetchAll();
        return $result;
	}

	public function get_agenda_historial_cliente($IdAgenda)
	{
		$statement = $this->db->prepare("SELECT * FROM agenda WHERE PENDIENTE_ID_PENDIENTE = :Id AND
		 (ESTADO = 'Terminado' OR ESTADO = 'Cancelado')");
		$statement->bindParam(':Id', $IdAgenda);
		$statement->execute();
		$result = $statement->fetch();
        return $result;
	}

	public function get_pendiente_by_Id($id) {

		$statement = $this->db->prepare("SELECT * FROM pendiente
		 WHERE ID_PENDIENTE = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        $result = $statement->fetch();
        return $result;
	}

	//Se cambia el estado del servicio a terminado en la tabla agenda y pendiente
	public function servicioTerminado($idAgenda,$idPendiente,$idUsuario,$idTecnico,$Fecha,$Costo) {
		
		$statement = $this->db->prepare("UPDATE agenda SET ESTADO = 'Terminado'
		WHERE ID_CITA  = :idAgenda ");
        $statement->bindParam(':idAgenda', $idAgenda);
		$statement->execute();	

		$statement = $this->db->prepare("UPDATE pendiente SET ESTADO_SERVICIO = 'Terminado'
		WHERE ID_PENDIENTE = :idPendiente ");
        $statement->bindParam(':idPendiente', $idPendiente);
		$statement->execute();

		$statement = $this->db->prepare("INSERT INTO factura (FECHA, COSTO, USUARIOS_ID_USUARIO, TECNICOS_ID_TECNICO) VALUES (:Fecha, :Costo, :idUsuario, :idTecnico)");
        $statement->bindParam(':Fecha', $Fecha);
        $statement->bindParam(':Costo', $Costo);
        $statement->bindParam(':idUsuario', $idUsuario);
        $statement->bindParam(':idTecnico', $idTecnico);
		if ($statement->execute()) {
			return true;
		} else {
			return false;
		}
	}

	//trae todos los servicios que tenga el cliente en la tabla de pendiente
	public function get_pendiente_idClient($idCliente) {
		$statement = $this->db->prepare("SELECT * FROM pendiente
		WHERE ID_CLIENTE  = :idUsuario AND (ESTADO_SERVICIO = 'Terminado' OR ESTADO_SERVICIO = 'Cancelado')");
        $statement->bindParam(':idUsuario', $idCliente);
        $statement->execute();

        $result = $statement->fetchAll();
		return $result;        
	}

}

?>