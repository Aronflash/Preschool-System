<?php
    include("../php/conexion.php");

    $cedulaEstudiante = $_GET["cedula_escolar"];
    $sql = "SELECT * FROM `estudiante` WHERE cedula_escolar = '$cedulaEstudiante'";
    $resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  // Convertir los resultados en un array asociativo
  $fila = $resultado->fetch_assoc();
  $cedular= $fila['cedula_representante'];
   echo $cedular;

  
}

?>