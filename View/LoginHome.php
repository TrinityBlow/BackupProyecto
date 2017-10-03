<?php

/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class LoginHome extends TwigView {
    
    public function show($username) {
        
        echo self::getTwig()->render('loginHome.html.twig',array('nombre' => $username));
        
        
    }
    
}
