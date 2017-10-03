<?php

/**
 * Description of SimpleResourceList
 *
 * @author fede
 */


class Login extends TwigView {
    
    public function show() {
        
        echo self::getTwig()->render('login.html.twig');
        
    }

    public function showError($error) {
        
        echo self::getTwig()->render('login.html.twig',array('error' => $error));
        
    }


    
}
