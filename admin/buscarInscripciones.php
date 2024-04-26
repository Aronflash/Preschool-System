<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: ./cerrarsesion.php');
    }
    $cedula = $_GET['cedula'];
    require "../php/conexion.php";

    $sql = "SELECT * FROM inscripcion WHERE codigo_inscripcion LIKE '$cedula%';";
    $result = mysqli_query($conexion, $sql);
    $inscripcion = mysqli_fetch_assoc($result);

    // buscar grupo
    $sql2 = "SELECT A.codigo_nivelseccion, B.codigo_niveles, A.codigo_niveles, A.codigo_seccion, C.codigo_seccion, B.descripcion AS descripcion_b, C.nombre AS nombre_c
        FROM nivel_seccion  A
        JOIN niveles B
        ON B.codigo_niveles = A.codigo_niveles
        JOIN secciones C
        ON A.codigo_seccion = C.codigo_seccion
        WHERE A.codigo_nivelseccion = ".$inscripcion['codigo_nivelseccion'];
    $result2 = mysqli_query($conexion, $sql2);
    $resultados = mysqli_fetch_assoc($result2);

    $datos = array(
        'grupo' => $resultados['descripcion_b'],
        'seccion' => $resultados['nombre_c']
    );

    echo json_encode($datos);