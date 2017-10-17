<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');

/**
 * Description of ResourceController
 *
 * @author fede
 */
class ResourceController {
    
    private static $instance;
	private static $pageLimit;

    public static function getPageLimit() {

        return ResourceRepository::getInstance()->getPaginacion();
    }



    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
	public function getPageLimitUsuarios($opciones){
		$resources = ResourceRepository::getInstance()->listLimiteUsuario($opciones['buscar'],$opciones['activo']);
		$cantPages = ceil(count($resources) / $this->getPageLimit());
		return $cantPages;
	}

	public function getPageLimitUsuariosEliminar($opciones){
		$resources = ResourceRepository::getInstance()->listLimiteUsuarioEliminar($opciones['buscar'],$opciones['activo']);
		$cantPages = ceil(count($resources) / $this->getPageLimit());
		return $cantPages;
	}


	public function getPageLimitPacientes(){
		$resources = ResourceRepository::getInstance()->listLimitePaciente();
		$cantPages = ceil(count($resources) / $this->getPageLimit());
		return $cantPages;
	}

    private function __construct() {
        
    }


	public function showPaginadoPacientes($viewName,$page,$autenticacion){
		$resources = ResourceRepository::getInstance()->listLimitePaciente();
		$this->terminarPaginado($viewName,$page,$resources,$autenticacion);
	}

	public function showPaginadoUsuarios($viewName,$opciones,$autenticacion){
        $resources = ResourceRepository::getInstance()->listLimiteUsuario($opciones['buscar'],$opciones['activo']);
		$this->terminarPaginado($viewName,$opciones['page'],$resources,$autenticacion);
	}




	public function showPaginadoUsuariosEliminar($viewName,$opciones,$autenticacion){
        $resources = ResourceRepository::getInstance()->listLimiteUsuarioEliminar($opciones['buscar'],$opciones['activo']);
		$this->terminarPaginado($viewName,$opciones['page'],$resources,$autenticacion);
	}


	private function terminarPaginado($viewName,$page,$resources,$autenticacion){
		$pageLimite = $this->getPageLimit();
		$cantPages = ceil(count($resources) / $pageLimite);
		$resources = array_slice($resources,($page-1)*$pageLimite,$pageLimite);
        $view = new $viewName();
        $view->show($resources,$cantPages,$autenticacion);
	}


	public function checkPermisos(){
		$autenticacion = [];
		session_start();
		if (isset($_SESSION['username'])){
			$autenticacion = $autenticacion + array('login' => true) + ResourceRepository::getInstance()->permisos($_SESSION['username']);
		} else{
			$autenticacion = $autenticacion + array('login' => false);
			
		}
		return $autenticacion;
	}
    

    public function showView($viewName,$datos = array()){
        $view = new $viewName();
        $view->show($datos);
    }

   public function showViewError($viewName,$error = [],$autenticacion){
        $view = new $viewName();
        $view->showError($error,$autenticacion);
    }

	public function datosPagina(){
		$datos = ResourceRepository::getInstance()->datosPagina();
		if($datos['online']){
			$datos['online'] = 'Online';
		} else{
			$datos['online'] = 'Mantenimineto';
		}
		return	$datos;
	}

	public function rolesDelUsuario($username){
		return ResourceRepository::getInstance()->buscarRolesDelUsuario($username);
	}

	public function online($autenticacion){
		$datos = ResourceRepository::getInstance()->datosPagina(); 
		if (!$datos['online']){
			if(isset($autenticacion['pagina_update'])){
				$datos['online'] = 1;
			}
		}

		return $datos['online'];
	}
}
