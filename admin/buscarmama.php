<?php
    include("../php/conexion.php");

    $cedulaEstudiante = $_GET["cedula_escolar"];
    $sql = "SELECT * FROM `estudiante` WHERE cedula_escolar = '$cedulaEstudiante'";
    $resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  
  $fila = $resultado->fetch_assoc();
  $cedulaMama = $fila['cedula_mama'];
   echo $cedulaMama;

  
}
else
{
  require "../php/periodos_a_buscar.php";
  if($periodos != null){
    for($i = 0; $i < sizeof($periodos); $i++){
        $sql = "SELECT * FROM historico_estudiante WHERE cedula_escolar = '$cedulaEstudiante' AND periodo = '$periodos[$i]';";
        $result = $conexion->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
           $cedulaMama= $row['cedula_mama'];
           echo $cedulaMama;
           
           break;
        }
    }
    
  }
}

?>