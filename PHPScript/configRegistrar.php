<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

$username = $_POST['username']; 
$password = $_POST['password'];
$confirm_password = $_POST['confirmar_password'];

	if (!empty($username) && !empty($password)  && !empty($confirm_password)) {
		if (!strcmp($password, $confirm_password)){
			// insertar una fila
			$answer = ResourceRepository::getInstance()->signupForm($username,$password); 
			if($answer){
		        // Redirect to login page
		        header("location: /Controller/login.php");
		    } else{
		        echo "Ocurrio un incoveniente, con base de datos.";
		    }        
		}else{
			echo "pasword diferentes.";
		}   
	}

?>
