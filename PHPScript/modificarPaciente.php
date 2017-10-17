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
	if(!empty ($_POST['Nombre'])){
		$nombre = $_POST['Nombre']; 
	}
	if(!empty ($_POST['Apellido'])){
		$apellido = $_POST['Apellido'];
	}
	if(!empty ($_POST['nacimiento'])){
		$nacimiento = $_POST['nacimiento'];
	}
	if(!empty ($_POST['modificarDocumento'])){
		$dni = $_POST['modificarDocumento'];
	}
	if(!empty ($_POST['Documento'])){
		$nuevoDocumento = $_POST['Documento'];
	}
	if(!empty ($_POST['Domicilio'])){
		$domicilio = $_POST['Domicilio'];
	}
	if(!empty ($_POST['Telefono'])){
		$telefono = $_POST['Telefono'];
	}
	if(!empty ($_POST['Obra'])){
		$obra = $_POST['Obra'];
	}
	if(!empty ($_POST['gender'])){
		$gender = $_POST['gender'];
	}
	if(!empty ($_POST['tipoDocumento'])){
		$tipoDocumento = $_POST['tipoDocumento'];
	}
	print_r($_POST);
	if (!empty($nombre)  && !empty($apellido) && !empty($nacimiento) && !empty($dni)  && !empty($domicilio)  && !empty($telefono)  && !empty($obra)  && !empty($gender)  && !empty($tipoDocumento)) {
		$answer = ResourceRepository::getInstance()->updatePacienteForm($nombre,$apellido,$nacimiento,$domicilio,$telefono,$obra,$gender,$tipoDocumento,$nuevoDocumento,$dni); 
		header("location: /Controller/mostrarPacientes.php");
	}
		
}
?>
