<?php

include("../conexion.php");

$codigo_usuario = $_POST['codigo_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];
$tipodeusuario = $_POST['tipodeusuario'];
$codigo_estado = $_POST['codigo_estado'];


$sql="UPDATE usuario SET nombre_usuario='$nombre_usuario', contrasena='$contrasena', tipodeusuario='$tipodeusuario', codigo_estado='$codigo_estado' WHERE codigo_usuario='$codigo_usuario'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/usuarios.php");
    }
exit;