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
	$dni = $_POST['dni']; 

		if ($dni >= 0) {
			$answer = ResourceRepository::getInstance()->datosDemPacienteConDNI($dni);
			if ($answer){
				$_SESSION['dni'] = $dni;
				$_SESSION['heladera'] = $answer['heladera'];
				$_SESSION['electricidad'] = $answer['electricidad'];
				$_SESSION['mascota'] = $answer['mascota'];
				$_SESSION['vivienda'] = $answer['vivienda'];
				$_SESSION['calefaccion'] = $answer['calefaccion'];
				$_SESSION['agua'] = $answer['agua'];
				header("location: /Controller/modificarDatosDemograficos.php");  
			}else{
				header("location: /Controller/mostrarPacientes.php");  
			}
		}
}
?>
