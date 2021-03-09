<?php
include_once('Conexion.php');
include_once('Usuarios.php');

class Publicacion extends Conexion {

    function __construct() {
		$this->db = parent::__construct();
	}

    public function add($Descripcion, $Marca, $Tipo, $Fecha,$Hora) {

        $usuario=new Usuarios();

        $idUsuario= $usuario->getId(); 
		$statement = $this->db->prepare("INSERT INTO requerimientos (DESCRIPCION,MARCA,
		TIPO,FECHA,HORA,USUARIOS_ID_USUARIO) VALUES (:Descripcion, :Marca, :Tipo,
		 :Fecha, :Hora, :idUsuario)");

		$statement->bindParam(':Descripcion', $Descripcion);
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



}

?>