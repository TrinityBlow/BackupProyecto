<?php


class NuevoUsuario extends TwigView {
    
    public function show($autenticacion) {
        
        echo self::getTwig()->render('agregarUsuario.html.twig',$autenticacion);
        
        
    }    

	public function showError($error,$autenticacion) {
        
        echo self::getTwig()->render('agregarUsuario.html.twig',$autenticacion + array('error' => $error));
        
    }
    
}
