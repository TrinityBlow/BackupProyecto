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

		if ($dni >= 0) {
			$_SESSION['dni'] = $dni;
			header("location: /Controller/agregarDatosDemograficos.php"); 
		}
}

?>
