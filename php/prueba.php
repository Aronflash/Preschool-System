<?php
    include "conexion.php";

    $sql = 'SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_NAME = "v_planillainscripcion";';
    $result = $conexion->query($sql);
    $row = $result->fetch_assoc();
    echo $row['VIEW_DEFINITION'];