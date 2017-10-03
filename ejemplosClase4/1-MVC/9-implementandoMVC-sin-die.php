<?php
//Conectamos a la Base
require("9-modelo-sin-die.php");
try
{
	$usuarios=obtener_usuarios();
} catch( Exception $e )
{
	$error = "Tuvimos un problemita: enseguida volvemos...";
}
//Cargo la vista
require_once("9-vista-sin-die.php");
?> 




