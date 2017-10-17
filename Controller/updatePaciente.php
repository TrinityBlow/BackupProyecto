<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/UpdatePaciente.php');


	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion)){
		if (($autenticacion['login']) == true){
			$autenticacion['modificarDocumento'] = $_SESSION['dni'];
			$autenticacion['nombre'] = $_SESSION['nombre'];
			$autenticacion['apellido'] = $_SESSION['apellido'];
			$autenticacion['nacimiento'] = $_SESSION['nacimiento'];
			$autenticacion['domicilio'] = $_SESSION['domicilio'];
			$autenticacion['telefono'] = $_SESSION['telefono'];
			$autenticacion['obra'] = $_SESSION['obra'];
			$autenticacion['gender'] = $_SESSION['gender'];
			$autenticacion['tipoDocumento'] = $_SESSION['tipoDocumento'];
			
			ResourceController::getInstance()->showView('UpdatePaciente',$autenticacion);
		}
	}

?>
