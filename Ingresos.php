<?php
include_once('Conexion.php');
include_once('Usuarios.php');
include_once('Publicacion.php');

class Ingresos extends Conexion
{

	function __construct()
	{
		$this->db = parent::__construct();
	}

    public function calcular_ganancia_mensual($idTecnico, $fechaInicio, $fechaFinal) {
		$statement = $this->db->prepare("SELECT SUM(COSTO) AS ESTIMADO FROM agenda WHERE ESTADO = 'Terminado' AND TECNICOS_ID_TECNICO = :idTecnico AND (FECHA BETWEEN :fechaInicio AND :fechaFinal)");
		$statement->bindParam(':idTecnico', $idTecnico);
        $statement->bindParam(':fechaInicio', $fechaInicio);
        $statement->bindParam(':fechaFinal', $fechaFinal);
		$statement->execute();
		
        $result = $statement->fetch();
		return $result;
	}

    public function calcular_estimado_mensual($idTecnico, $fechaInicio, $fechaFinal) {
		$statement = $this->db->prepare("SELECT SUM(COSTO) AS ESTIMADO FROM agenda WHERE ESTADO = 'Aceptado' AND TECNICOS_ID_TECNICO = :idTecnico AND (FECHA BETWEEN :fechaInicio AND :fechaFinal)");
		$statement->bindParam(':idTecnico', $idTecnico);
        $statement->bindParam(':fechaInicio', $fechaInicio);
        $statement->bindParam(':fechaFinal', $fechaFinal);
		$statement->execute();
		
        $result = $statement->fetch();
		return $result;
	}


}