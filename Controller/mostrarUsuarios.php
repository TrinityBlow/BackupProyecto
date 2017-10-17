<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/TwigView.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/View/MostrarUsuarios.php');

	$autenticacion = ResourceController::getInstance()->checkPermisos();
	if(ResourceController::getInstance()->online($autenticacion)){
		$opciones = array();	
		if (!isset($_GET['page'])){
			$opciones['page'] = 1;
		} else{
			$opciones['page'] = $_GET['page'];
		}

		if (!isset($_GET['buscar'])){
			$opciones['buscar'] = '';
		} else{
			$opciones['buscar'] = $_GET['buscar'];
		}

		if (!isset($_GET['activo'])){
			$opciones['activo'] = 0;
		} else{
			$opciones['activo'] = $_GET['activo'];
		}

		if (($autenticacion['login']) == true){
			$cantPaginas = ResourceController::getInstance()->getPageLimitUsuarios($opciones);
			$paginas = array();
			for ($x = 1; $x <= $cantPaginas; $x++){
				$paginas[] = array('page'=> ('mostrarUsuarios.php?page='."$x".'&buscar='.$opciones['buscar'].'&activo='.(int)$opciones['activo']),
									'num'=> $x);
			} 
			$autenticacion['paginas'] = $paginas;
			if($opciones['page'] < $cantPaginas){
				$autenticacion['sigPage'] = 'mostrarUsuarios.php?page='.((string)($opciones['page']	 + 1).'&buscar='.$opciones['buscar'].'&activo='.(int)$opciones['activo']);
			} else{
				$autenticacion['sigPage'] = 'mostrarUsuarios.php?page='.(string)($opciones['page'].'&buscar='.$opciones['buscar'].'&activo='.(int)$opciones['activo']);
			}
			if($opciones['page'] > 1){
				$autenticacion['prevPage'] = 'mostrarUsuarios.php?page='.((string)($opciones['page'] - 1).'&buscar='.$opciones['buscar'].'&activo='.(int)$opciones['activo']);
			} else{
				$autenticacion['prevPage'] = 'mostrarUsuarios.php?page=1'.'&buscar='.$opciones['buscar'].'&activo='.(int)$opciones['activo'];
			}
			ResourceController::getInstance()->showPaginadoUsuarios('MostrarUsuarios',$opciones,$autenticacion);
		}
	}
?>
