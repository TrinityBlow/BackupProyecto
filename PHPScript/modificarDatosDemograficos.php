<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['paciente_update']))){
	$heladera = $_POST['heladera']; 
	$electricidad = $_POST['electricidad'];
	$mascota = $_POST['mascota'];
	$vivienda = $_POST['vivienda'];
	$calefaccion = $_POST['calefaccion'];
	$agua = $_POST['agua'];
	$dni= $_POST['dni'];

	if ( ($dni >= 0) && ($heladera >= 0) && ($electricidad >= 0) && ($mascota >= 0) && ($vivienda >= 0) && ($calefaccion >= 0) && ($agua >= 0)){
	//agregar fila
		$answer = ResourceRepository::getInstance()->updateDatosDemPacienteForm($heladera,$electricidad,$mascota,$vivienda,$calefaccion,$agua,$dni);
		if($answer){
		    // Redirect to home page
		    header("location: /Controller/mostrarPacientes.php");
	   	} else{
			$_SESSION['errorRegistrar'] = 'sistema';
			header("Location: /Controller/mostrarPacientes.php");
		}
	}else{
		$_SESSION['errorRegistrar'] = 'campoVacio';
		header("Location: /Controller/mostrarPacientes.php");
	}

}

?>
