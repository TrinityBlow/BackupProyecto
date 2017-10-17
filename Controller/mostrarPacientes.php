<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/MostrarPacientes.php');


	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion)){
		if (isset($_GET['page'])){
			$page = $_GET['page'];
		} else{
			$page = 1;
		}

		if (($autenticacion['login']) == true){
			if($page < ResourceController::getInstance()->getPageLimitPacientes()){
				$autenticacion['sigPage'] = 'mostrarPacientes.php?page='.(string)($page + 1);
			} else{
				$autenticacion['sigPage'] = 'mostrarPacientes.php?page='.(string)($page);
			}
			if($page > 1){
				$autenticacion['prevPage'] = 'mostrarPacientes.php?page='.(string)($page - 1);
			} else{
				$autenticacion['prevPage'] = 'mostrarPacientes.php?page=1';
			}
			ResourceController::getInstance()->showPaginadoPacientes('MostrarPacientes',$page,$autenticacion);
		}
	}

?>
