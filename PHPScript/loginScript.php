<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

$username = $_POST['username']; 
$password = $_POST['password'];

try {
	$arrayLogin = ResourceRepository::getInstance()->loginForm($username,$password); 
	if(count($arrayLogin)){
		session_start();
		$_SESSION["username"] = $username;
		header("Location: /Controller/home.php");
	}else{
		header("Location: /Controller/login.php?error=errorlogin");
	}

	
}
catch(PDOException $e){
	echo "ERROR". $e->getMessage();
}



?>
