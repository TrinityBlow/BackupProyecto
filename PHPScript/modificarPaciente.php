<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');


$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['usuario_update']))){

	if (!empty($_POST['Nombre'])  && !empty($_POST['Apellido']) && !empty($_POST['nacimiento']) && !empty($_POST['modificarDocumento'])  && !empty($_POST['Documento'])  && !empty($_POST['Domicilio'])  && !empty($_POST['Telefono'])  && !empty($_POST['Obra'])  && !empty($_POST['gender']) && !empty($_POST['tipoDocumento'])) {
		$nombre = $_POST['Nombre']; 
		$apellido = $_POST['Apellido'];
		$nacimiento = $_POST['nacimiento'];
		$dni = $_POST['modificarDocumento'];
		$nuevoDocumento = $_POST['Documento'];
		$domicilio = $_POST['Domicilio'];
		$telefono = $_POST['Telefono'];
		$obra = $_POST['Obra'];
		$gender = $_POST['gender'];
		$tipoDocumento = $_POST['tipoDocumento'];
		$answer = ResourceRepository::getInstance()->updatePacienteForm($nombre,$apellido,$nacimiento,$domicilio,$telefono,$obra,$gender,$tipoDocumento,$nuevoDocumento,$dni); 
	}else{
		/*mensaje para que twig diga el error*/
	}
	
	header("location: /Controller/modificarPacientes.php");
		
}
?>
