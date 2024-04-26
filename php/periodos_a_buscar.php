<?php
    include_once '../php/conexion.php';

    $sql = "SELECT * FROM periodo_academico 
    WHERE fecha_inicio < (SELECT fecha_inicio FROM periodo_academico WHERE actual = 1)
    ORDER BY fecha_inicio DESC;";
    $resultado = $conexion->query($sql);
    $periodos = array();
    if($resultado->num_rows >= 1){
        while($periodo = $resultado->fetch_assoc()){
            array_push($periodos, $periodo['codigo_periodo']);
        }
    }
    else{
        $periodos = null;
    }
    