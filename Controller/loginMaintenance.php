<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/LoginMaintenance.php');

	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(!ResourceController::getInstance()->online($autenticacion)){
		if (($autenticacion['login']) == false){
			if(!isset($_SESSION['errorlogin'])){
				ResourceController::getInstance()->showView('LoginMaintenance');
			} else{
				ResourceController::getInstance()->showViewError('LoginMaintenance',$_SESSION['errorlogin'],$autenticacion);
			   	unset($_SESSION['errorlogin']);
			}
		}
	}

?>
