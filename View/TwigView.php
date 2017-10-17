<?php

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

/**
 * Description of TwigView
 *
 * @author fede
 */
require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

abstract class TwigView {

    private static $twig;

    public static function getTwig() {

        if (!isset(self::$twig)) {

            Twig_Autoloader::register();
            $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'] . '/Templates');
            self::$twig = new Twig_Environment($loader);
        }
        return self::$twig;
    }

}