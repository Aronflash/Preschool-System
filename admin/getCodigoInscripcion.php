<?php
    include "../php/conexion.php";
    $cedula = htmlspecialchars($_GET['cedula']);
    $sql5 = "SELECT * FROM inscripcion WHERE cedula_escolar = '$cedulaEscolar';";
    $result5 = $conexion->query($sql5);
    $inscripcion5 = $result5->fetch_assoc();
    
    echo $inscripcion5['codigo_inscripcion'];
