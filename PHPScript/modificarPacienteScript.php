<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['paciente_update']))){
	$dni = $_POST['dni']; 

		if ($dni > 0) {
			$_SESSION['dni'] = $dni;
			$answer = ResourceRepository::getInstance()->getDatosPaciente($dni); 
			if($answer){
			   // Redirect to home page
				$_SESSION['nombre'] = $answer['nombre'];
				$_SESSION['apellido'] = $answer['apellido'];
				$_SESSION['nacimiento'] = $answer['nacimiento'];
				$_SESSION['domicilio'] = $answer['domicilio'];
				$_SESSION['telefono'] = $answer['telefono'];
				$_SESSION['obra'] = $answer['obra_social'];
				$_SESSION['gender'] = $answer['genero'];
				$_SESSION['tipoDocumento'] = $answer['Tipo_dni'];
			} else{
				$_SESSION['error'] = 'sistema';
			}      
		}else{
			$_SESSION['error'] = 'sistema';
		}
			header("Location: /Controller/updatePaciente.php");
}

?>
