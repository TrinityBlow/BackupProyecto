<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/Home.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/LoginHome.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/Maintenance.php');


	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion)){
		if($autenticacion['login'] == true){
			ResourceController::getInstance()->showView('LoginHome',$autenticacion);
		} else{		
			ResourceController::getInstance()->showView('Home',$autenticacion);
		}
	} else{
		ResourceController::getInstance()->showView('Maintenance');
	}
?>
