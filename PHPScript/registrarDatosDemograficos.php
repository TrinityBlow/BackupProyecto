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

	if (isset($dni) && isset($heladera) && isset($electricidad) && isset($mascota) && !empty($vivienda) && !empty($calefaccion) && !empty($agua)){
	//agregar fila
		$answer = ResourceRepository::getInstance()->signupDatosDemograficos($heladera,$electricidad,$mascota,$vivienda,$calefaccion,$agua,$dni);
		echo $answer;
			if($answer){
			    // Redirect to home page
			    header("location: /Controller/home.php");
		   	} else{
				$_SESSION['errorRegistrar'] = 'sistema';
				//header("Location: /Controller/agregarDatosDemograficos.php");
			}
			}else{
			$_SESSION['errorRegistrar'] = 'campoVacio';
			//header("Location: /Controller/agregarDatosDemograficos.php");
	}

}

?>
