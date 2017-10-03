<?php

/**
 * Description of ResourceController
 *
 * @author fede
 */
class ResourceController {
    
    private static $instance;
    private static $usuario

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    private function __construct() {
        
    }
    
    
    public function listResources(){
        $resources = ResourceRepository::getInstance()->listAll();
        $view = new SimpleResourceList();
        $view->show($resources);
    }
    
    public function showView($viewName){
        $view = new $viewName();
        $view->show();
    }

   public function showLogin($viewName,$parameters = []){
        $view = new $viewName();
        $view->show($parameters);
    }

   public function showLoginError($viewName,$parameters = []){
        $view = new $viewName();
        $view->showError($parameters);
    }

}
