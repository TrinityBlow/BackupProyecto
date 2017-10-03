<?php
    require_once("9-conexion-sin-die.php");
    function obtener_usuarios(){
        $link=obtener_conexion();

        $resu=$link->query("select * from usuarios");
        while ($dato = mysqli_fetch_array($resu))  {
            $usuarios[]=$dato;
        }
    mysqli_close($link);
    return $usuarios; }
?> 




