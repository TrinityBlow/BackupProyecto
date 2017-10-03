<?php

/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class Registrar extends TwigView {
    
    public function show() {
        
        echo self::getTwig()->render('registrar.html.twig');
        
        
    }
    
}
