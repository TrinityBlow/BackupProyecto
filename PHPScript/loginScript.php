<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && ($autenticacion['login	'] == false)){
	$username = $_POST['username']; 
	$password = $_POST['password'];

	try {
		if(!empty($username) and !empty($password)){
			$login = ResourceRepository::getInstance()->loginForm($username,$password); 
			if(!empty($login)){
				$_SESSION["username"] = $username;
				$_SESSION["rol"] = 'admin';
				header("Location: /Controller/home.php");
			}else{
				$_SESSION['errorlogin'] = 'errorlogin';
				header("Location: /Controller/login.php");
			}
		}else{
			$_SESSION['errorlogin'] = 'errorlogin';
			header("Location: /Controller/login.php");
		}
	
	}
	catch(PDOException $e){
		echo "ERROR". $e->getMessage();
	}

}



?>