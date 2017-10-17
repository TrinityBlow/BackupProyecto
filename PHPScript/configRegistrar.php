<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['usuario_new']))){
	$username = $_POST['username']; 
	$password = $_POST['password'];
	$confirm_password = $_POST['confirmar_password'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];


	if (isset($_POST['roles'])){
		$roles = $_POST['roles'];
	} else{
		$roles = array();
	}



		if (!empty($username) && !empty($password)  && !empty($email) && !empty($confirm_password) && !empty($name) && !empty($surname)) {
			if (!strcmp($password, $confirm_password)){
				// insertar una fila
				$answer = ResourceRepository::getInstance()->signupForm($username,$password,$email,$name,$surname,$roles); 
				if($answer){
				    // Redirect to home page
				    header("location: /Controller/home.php");
				} else{
				
					$_SESSION['errorRegistrar'] = 'sistema';
					header("Location: /Controller/agregarUsuario.php");
				}        
			}else{
				$_SESSION['errorRegistrar'] = 'passwordDiferente';
				header("Location: /Controller/agregarUsuario.php");
			}   
		}else{
			$_SESSION['errorRegistrar'] = 'campoVacio';
			header("Location: /Controller/agregarUsuario.php");
		}
}

?>
