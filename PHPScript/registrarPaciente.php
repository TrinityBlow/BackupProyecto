<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');


	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['paciente_new'])) ){
		$nombre = $_POST['Nombre']; 
		$apellido = $_POST['Apellido'];
		$documento = $_POST['Documento'];
		$domicilio = $_POST['Domicilio'];
		$nacimiento = $_POST['nacimiento'];
		$telefono = $_POST['Telefono'];
		$obra = $_POST['Obra'];
		$gender = $_POST['gender'];
		$tipoDocumento = $_POST['tipoDocumento'];

			if (!empty($nombre) && !empty($apellido)  && !empty($nacimiento) && !empty($documento) && !empty($domicilio) && !empty($gender) && !empty($tipoDocumento)) {
				// insertar una fila
				$answer = ResourceRepository::getInstance()->signupPaciente($nombre,$apellido,$nacimiento,$documento,$domicilio,$telefono,$obra,$gender,$tipoDocumento); 
				if($answer){
					// Redirect to home page
					header("location: /Controller/home.php");
				} else{
					$_SESSION['errorRegistrar'] = 'sistema';
					header("Location: /Controller/agregarPaciente.php");
				}        
			}else{
				$_SESSION['errorRegistrar'] = 'campoVacio';
				header("Location: /Controller/agregarPaciente.php");
			}
	}

?>
