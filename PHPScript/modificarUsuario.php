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
	if(!empty ($_POST['email'])){
		$email = $_POST['email'];
	}
	if(!empty ($_POST['name'])){
		$name = $_POST['name'];
	}
	if(!empty ($_POST['surname'])){
		$surname = $_POST['surname'];
	}
	print_r($_POST);
	if (!empty($username)  && !empty($email) && !empty($name) && !empty($surname)) {
		$answer = ResourceRepository::getInstance()->updateUserForm($email,$name,$surname,$username); 
		header("location: /Controller/eliminarUsuarios.php");
	}
		
}
?>
