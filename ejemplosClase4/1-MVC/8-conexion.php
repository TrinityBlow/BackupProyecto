<?php
function obtener_conexion(){
	$db_host="db"; $db_user="user";
	$db_pass="pass"; $db_base="base"; 
	$link = mysqli_connect($db_host,$db_user,$db_pass,$db_base) or die("Error " . mysqli_error($link));
	$link->set_charset("utf8");
	return $link; }
?> 




