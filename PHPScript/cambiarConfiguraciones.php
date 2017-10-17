<?php
// Include config file

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/Controller/ResourceController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/PDORepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Model/ResourceRepository.php');


$autenticacion = ResourceController::getInstance()->checkPermisos();
if(ResourceController::getInstance()->online($autenticacion) && (isset($autenticacion['pagina_update']))){
	if (isset($autenticacion['pagina_update'])) {
		if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
			ResourceRepository::getInstance()->modifyTitulo($_POST['titulo']);
	    } elseif(isset($_POST['email']) && !empty($_POST['email'])){
			ResourceRepository::getInstance()->modifyEmail($_POST['email']);
	    } elseif(isset($_POST['descripcion']) && !empty($_POST['descripcion'])){
			ResourceRepository::getInstance()->modifyDescripcion($_POST['descripcion']);
		} elseif(isset($_POST['paginacion']) && ($_POST['paginacion'] > 0)){
			ResourceRepository::getInstance()->modifyPaginacion($_POST['paginacion']);
		}else{   
			$_SESSION['errorRegistrar'] = 'sistema';
		}
		header("Location: /Controller/configuracionAdmin.php");
	}
}
?>
