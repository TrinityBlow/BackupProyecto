<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class Login extends TwigView {
    
    public function show() {
        
        echo self::getTwig()->render('login.html.twig');
        
        
    }


    public function showError($error,$autenticacion) {
        
        echo self::getTwig()->render('login.html.twig',array('error' => $error));
        
    }
    
}
