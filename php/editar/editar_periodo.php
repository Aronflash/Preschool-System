<?php

include("../conexion.php");

$codigo_periodo = $_POST['codigo_periodo'];
$nombre = $_POST['nombre'];

$fecha_inicio = $_POST['fecha_inicio'];

$fecha_fin = $_POST['fecha_fin'];

$sql="UPDATE periodo_academico SET nombre='$nombre', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin' WHERE codigo_periodo='$codigo_periodo'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/periodos.php");
    }
exit;