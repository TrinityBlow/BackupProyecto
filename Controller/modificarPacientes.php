<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/ModificarPacientes.php');

	$autenticacion = ResourceController::getInstance()->checkPermisos();	
	if(ResourceController::getInstance()->online($autenticacion)){
		$parametros = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
		if((strpos($parametros, 'page=') === 0)){
			if (($autenticacion['login']) == true){
				if (!isset($_GET['page'])){
					$page = 1;
				} else{
					$page = $_GET['page'];
				}
				if(!isset($_SESSION['error'])){
					$error = array();
				}else{
					$error = array($_SESSION['error']); 
				   	unset($_SESSION['error']);
				}
				if($page < ResourceController::getInstance()->getPageLimitPacientes()){
					$autenticacion['sigPage'] = 'modificarPacientes.php?page='.(string)($page + 1);
				} else{
					$autenticacion['sigPage'] = 'modificarPacientes.php?page='.(string)($page);
				}
				if($page > 1){
					$autenticacion['prevPage'] = 'modificarPacientes.php?page='.(string)($page - 1);
				} else{
					$autenticacion['prevPage'] = 'modificarPacientes.php?page=1';
				}
				ResourceController::getInstance()->showPaginadoPacientes('ModificarPacientes',$page,$autenticacion);
			}
		} else{
			$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) . '?page=1';
			header("Location: $path");
		}
	}
?>
