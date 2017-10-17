<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class LoginMaintenance extends TwigView {
    
    public function show() {
        
        echo self::getTwig()->render('loginMaintenance.html.twig');
        
        
    }


    public function showError($error,$autenticacion) {
        
        echo self::getTwig()->render('loginMaintenance.html.twig',array('error' => $error));
        
    }
    
}
