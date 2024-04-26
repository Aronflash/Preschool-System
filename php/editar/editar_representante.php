<?php

include("../conexion.php");

$cedula_representante = $_POST['cedula_representante'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$codigo_parentesco = $_POST['codigo_parentesco'];
$codigo_estado = $_POST['codigo_estado'];

$sql="UPDATE representante_legal SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono', codigo_parentesco='$codigo_parentesco', codigo_estado='$codigo_estado' WHERE cedula_representante='$cedula_representante'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/representante.php");
    }
exit;