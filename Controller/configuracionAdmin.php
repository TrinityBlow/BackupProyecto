<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/Configuracion.php');

	$autenticacion = ResourceController::getInstance()->checkPermisos();	
	if(ResourceController::getInstance()->online($autenticacion)){
		if ((($autenticacion['login']) == true) && (isset($autenticacion['pagina_update']))){
			$autenticacion = array_merge($autenticacion,ResourceController::getInstance()->datosPagina());
			ResourceController::getInstance()->showView('Configuracion',$autenticacion);
		}
	}

?>
