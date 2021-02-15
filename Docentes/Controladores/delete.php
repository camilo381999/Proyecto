<?php 
 require_once('../Modelo/Docentes.php');

 if ($_POST) {
 	 $Modelo =  new Docentes();

 	 $Id = $_POST['Id'];
 	
 	 $Modelo->delete($Id);
 }else{
 	header('Location: ../../index.php');
 }




 ?>