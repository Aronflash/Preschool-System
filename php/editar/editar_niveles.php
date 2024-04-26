<?php

include("../conexion.php");

$codigo_niveles = $_POST['codigo_niveles'];
$descripcion = $_POST['descripcion'];

$codigo_estado = $_POST['codigo_estado'];

$sql="UPDATE niveles SET descripcion='$descripcion', codigo_estado='$codigo_estado' WHERE codigo_niveles='$codigo_niveles'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/niveles.php");
    }
exit;