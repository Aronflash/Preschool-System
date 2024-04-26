<?php 
    require "../../php/conexion.php";
    $sql = "SELECT * FROM estudiante WHERE cedula_representante = ". $_GET['cedular'];
    $result = mysqli_query($conexion, $sql);
    $num = mysqli_num_rows($result);
    $hijos = array();
    while($hijo = mysqli_fetch_assoc($result)){
        array_push($hijos, $hijo);
    }
    echo json_encode($hijos);