<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/Home.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/LoginHome.php');


	session_start();
	if (!empty($_SESSION["username"])){
		ResourceController::getInstance()->showLogin('LoginHome',$_SESSION["username"]);
	} else {	
		ResourceController::getInstance()->showView('Home');
	}

?>
