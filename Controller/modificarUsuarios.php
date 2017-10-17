<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/ModificarUsuarios.php');


	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion)){
		if (($autenticacion['login']) == true){
			$autenticacion['modificarUsername'] = $_SESSION['modificarUsername'];
			$autenticacion['email'] = $_SESSION['email'];
			$autenticacion['name'] = $_SESSION['name'];
			$autenticacion['surname'] = $_SESSION['surname'];
			ResourceController::getInstance()->showView('ModificarUsuarios',$autenticacion);
		}
	}

?>
