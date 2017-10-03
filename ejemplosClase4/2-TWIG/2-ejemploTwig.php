<?php 

require_once 'vendor/autoload.php';

$templateDir="./templates";
$loader = new Twig_Loader_Filesystem($templateDir);
$twig = new Twig_Environment($loader);
            
$template = $twig->loadTemplate("plantilla-2.twig.html");


$template->display(array('variable' => "mas variables",
						'arreglo' => array("Facultad de Informática",2,3),
						));

?>




