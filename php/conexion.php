<?php
 $conexion=new mysqli("localhost","root","","comunitario_pagina");
 if($conexion->connect_errno){
     echo "fallo la conexion a la base de datos" . $conexion->connect_errno;

}
$conexion->set_charset("utf8")

?>