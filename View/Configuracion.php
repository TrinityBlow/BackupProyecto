<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class Configuracion extends TwigView {
    
    public function show($autenticacion) {
        
        echo self::getTwig()->render('configuracion.html.twig',$autenticacion);
        
        
    }
    
}
