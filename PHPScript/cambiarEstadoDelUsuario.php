<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');


$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['usuario_update']))){
	$username = $_POST['username']; 
	if (!empty($username)){
		ResourceRepository::getInstance()->toggleEstadoUsuario($username); 
		header("location: /Controller/eliminarUsuarios.php");
	}
}

?>
