<?php
    require "../../php/conexion.php";
    $sql = "SELECT * FROM periodo_academico;";
    $result = mysqli_query($conexion, $sql);

    $periodos = array();

    while($periodo = mysqli_fetch_assoc($result)){
        array_push($periodos, $periodo);
    }
    echo json_encode($periodos);