<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class EliminarPacientes extends TwigView {
    
    public function show($resourceArray,$cantPages,$autenticacion) {
        
        echo self::getTwig()->render('eliminarPacientes.html.twig',array_merge(array('resources' => $resourceArray,
																					'cantPages' => $cantPages), 
																   				$autenticacion));
        
        
    }

    
}
