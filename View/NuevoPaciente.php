<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class NuevoPaciente extends TwigView {
    
    public function show($autenticacion) {
        
        echo self::getTwig()->render('agregarPaciente.html.twig',$autenticacion);
        
        
    }


	public function showError($error,$autenticacion) {
        
        echo self::getTwig()->render('agregarPaciente.html.twig',$autenticacion + array('error' => $error));
        
    }
    
}
