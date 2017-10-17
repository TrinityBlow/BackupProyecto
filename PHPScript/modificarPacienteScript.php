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
	$dni = $_POST['dni']; 

		if (!empty($dni)) {
			$_SESSION['dni'] = $dni;
			$answer = ResourceRepository::getInstance()->getDatosPaciente($dni); 
			$_SESSION['nombre'] = $nombre;
			$_SESSION['apellido'] = $apellido;
			$_SESSION['nacimiento'] = $nacimiento;
			$_SESSION['domicilio'] = $domicilio;
			$_SESSION['telefono'] = $telefono;
			$_SESSION['obra'] = $obra;
			$_SESSION['gender'] = $gender;
			$_SESSION['tipoDocumento'] = $tipoDocumento;
			
			if($answer){
			   // Redirect to home page
			    header("location: /Controller/updatePaciente.php");
			} else{
				$_SESSION['error'] = 'sistema';
				header("Location: /Controller/updatePaciente.php");
			}      
		}else{
			$_SESSION['error'] = 'sistema';
			header("Location: /Controller/updatePaciente.php");
		}
}

?>
