<?php


class ModificarDatosDemograficos extends TwigView {
    
    public function show($autenticacion) {
        
        echo self::getTwig()->render('modificarDatosDemograficos.html.twig',$autenticacion);
        
        
    }
    
}
