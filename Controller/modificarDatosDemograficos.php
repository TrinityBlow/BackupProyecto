<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/ModificarDatosDemograficos.php');

	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion) && isset($autenticacion['paciente_update'])){
		if (isset($_SESSION['dni']) && isset($_SESSION['heladera']) && isset($_SESSION['electricidad']) && isset($_SESSION['mascota']) && isset($_SESSION['vivienda']) && isset($_SESSION['calefaccion']) && isset($_SESSION['agua'])){
			$autenticacion['dni'] = $_SESSION['dni'];
			$autenticacion['heladera'] = $_SESSION['heladera'];
			$autenticacion['electricidad'] = $_SESSION['electricidad'];
			$autenticacion['mascota'] = $_SESSION['mascota'];
			$autenticacion['vivienda'] = $_SESSION['vivienda'];
			$autenticacion['calefaccion'] = $_SESSION['calefaccion'];
			$autenticacion['agua'] = $_SESSION['agua'];
			ResourceController::getInstance()->showView('ModificarDatosDemograficos',$autenticacion);
		}
	}
?>
