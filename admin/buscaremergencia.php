<?php
    include("../php/conexion.php");

    $cedulaEstudiante = $_GET["cedula_escolar"];
    $sql = "SELECT * FROM `estudiante` WHERE cedula_escolar = '$cedulaEstudiante'";
    $resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  // Convertir los resultados en un array asociativo
  $fila = $resultado->fetch_assoc();
  $emergencia = $fila['caso_emergencia'];
  $sql = "SELECT `codigo_emergencia`, `nombre` FROM `caso_emergencia` WHERE `codigo_emergencia`='$emergencia'";
  $resultado = $conexion->query($sql);
  if ($resultado->num_rows > 0) 
  {
    $fila = $resultado->fetch_assoc();
    $persona = $fila['nombre'];
    echo $persona;
    } 
}

?>