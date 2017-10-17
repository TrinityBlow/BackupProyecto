<?php


class DatosDemograficos extends TwigView {
    
    public function show($autenticacion) {
        
        echo self::getTwig()->render('agregarDatosDemograficos.html.twig',$autenticacion);
        
        
    }
    
}
