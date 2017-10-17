<?php

/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class LoginHome extends TwigView {
    
    public function show($autenticacion) {
        echo self::getTwig()->render('base.html.twig',$autenticacion);
        
        
    }
    
}
