<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/NuevoUsuario.php');



	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion)){
		if (($autenticacion['login']) == true){
			if(!isset($_SESSION['errorRegistrar'])){
				ResourceController::getInstance()->showView('NuevoUsuario',$autenticacion);
			} else{
				ResourceController::getInstance()->showViewError('NuevoUsuario',$_SESSION['errorRegistrar'],$autenticacion);
			   	unset($_SESSION['errorRegistrar']);
			}
		}
	}


?>