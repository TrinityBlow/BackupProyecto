<?php
function obtener_usuarios(){
	$db_host="db";
	$db_user="user";
	$db_pass="pass";
	$db_base="base"; 
	$link = mysqli_connect($db_host,$db_user,$db_pass,$db_base) or die("Error " . mysqli_error($link));
	$link->set_charset("utf8");
	$resu=$link->query("select * from usuarios");

	while ($dato = mysqli_fetch_array($resu))  {
		$usuarios[]=$dato;
	}
	// Cierro la conexión
	mysqli_close($link);
	return $usuarios;
}
?> 




