<?php 

require_once('../../Conexion.php');
/**
 * 
 */
class Clientes extends Conexion
{
	function __construct()
	{
		$this->db = parent::__construct();
	}

	public function get(){
			$rows = null;
			$statement = $this->db->prepare("SELECT * FROM usuarios");
			$statement->execute();
			while ($result = $statement->fetch()) {
				$rows[] = $result;
			}
			return $rows;
		}

	public function getById($Id){
		$rows = null;
			$statement = $this->db->prepare("SELECT * FROM usuarios WHERE ID_USUARIO = :Id");
			$statement->bindParam(':Id',$Id);
			$statement->execute();
			while ($result = $statement->fetch()) {
				$rows[] = $result;
			}
			return $rows;
	}

	public function update($Id,$Nombre,$Apellido,$Usuario,$Password,$Correo,$Telefono){

			$statement = $this->db->prepare("UPDATE usuarios SET NOMBRE =:Nombre, APELLIDO =:Apellido, USUARIO = :Usuario, PASSWORD 
				=:Password,CORREO =:Correo,TELEFONO=:Telefono WHERE ID_USUARIO = :Id");
			$statement->bindParam(':Id',$Id);
			$statement->bindParam(':Nombre',$Nombre);
			$statement->bindParam(':Apellido',$Apellido);
			$statement->bindParam(':Usuario',$Usuario);
			$statement->bindParam(':Password',$Password);
			$statement->bindParam(':Correo',$Correo);
            $statement->bindParam(':Telefono',$Telefono);

			if ($statement->execute()) {
				header('Location: ../Pages/index.php');
			}else{
				header('Location: ../Pages/edit.php');
			}

		}

	public function delete($Id){
			$statement = $this->db->prepare("DELETE FROM usuarios WHERE ID_USUARIO = :Id");
			$statement->bindParam(':Id',$Id);

			if ($statement->execute()) {
				header('Location: ../Pages/index.php');
			}else{
				header('Location: ../Pages/delete.php');			}
		}
}


 ?>