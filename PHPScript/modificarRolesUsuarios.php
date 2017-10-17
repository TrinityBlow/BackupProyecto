<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['usuario_update']))){
	if(!empty ($_POST['username'])){
		$username = $_POST['username']; 
	}
	if (isset($_POST['roles'])){
		$roles = $_POST['roles'];
	} else{
		$roles = array();
	}

		if (isset($autenticacion['usuario_update'])) {
			$roles = array_diff($roles,array(1));
			ResourceRepository::getInstance()->modifyRolesDelUsuario($username,$roles);
			header("Location: /Controller/eliminarUsuarios.php");
		}
}
?>
