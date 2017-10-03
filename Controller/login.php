<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/Login.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/Home.php');

	if(!isset($_GET["error"])){
		ResourceController::getInstance()->showView('Login');
	} else{
		if ($_GET["error"] == 'errorlogin'){
			ResourceController::getInstance()->showLoginError('Login','errorlogin');
		} else {
			ResourceController::getInstance()->showLoginError('Login','generico');
		}
	}

?>
