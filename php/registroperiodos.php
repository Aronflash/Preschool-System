<?php

include 'conexion.php';

$nombre = $_POST['nombre'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$query = "INSERT INTO periodo_academico(nombre, fecha_inicio, fecha_fin)
VALUES ('$nombre', '$fecha_inicio','$fecha_fin')";
$sql = "SELECT * FROM periodo_academico WHERE nombre = '$nombre' AND fecha_inicio = '$fecha_inicio' AND fecha_fin = '$fecha_fin';";
$verificando_codigo_periodo = $conexion->query($sql);


if (mysqli_num_rows($verificando_codigo_periodo) > 0) {

    echo '<script>
        alert("Esta codigo ya esta registrado, intenta con uno nuevo");           
        window.location = "../admin/acciones/agregar_periodos.php";
        </script>';
    exit();
}

$queri = $conexion->query($query);
$sql = "SELECT codigo_periodo FROM periodo_academico WHERE nombre = '$nombre' AND fecha_inicio = '$fecha_inicio' AND fecha_fin = '$fecha_fin';";
$codigo_periodo = $conexion->query($sql)->fetch_assoc()['codigo_periodo'];

if ($queri) {
    $sql = "INSERT INTO historico_secciones(codigo_seccion, nombre, periodo) VALUES
    (1, 'UNICA', '$codigo_periodo'),
    (2, 'A', '$codigo_periodo'),
    (3, 'B', '$codigo_periodo'),
    (4, 'C', '$codigo_periodo'),
    (5, 'D', '$codigo_periodo'),
    (6, 'E', '$codigo_periodo'),
    (7, 'F', '$codigo_periodo'),
    (8, 'G', '$codigo_periodo'),
    (9, 'H', '$codigo_periodo'),
    (10, 'I', '$codigo_periodo'),
    (11, 'J', '$codigo_periodo'),
    (12, 'K', '$codigo_periodo'),
    (13, 'L', '$codigo_periodo'),
    (14, 'M', '$codigo_periodo'),
    (15, 'N', '$codigo_periodo'),
    (16, 'Ñ', '$codigo_periodo'),
    (17, 'O', '$codigo_periodo'),
    (18, 'P', '$codigo_periodo'),
    (19, 'Q', '$codigo_periodo'),
    (20, 'R', '$codigo_periodo'),
    (21, 'S', '$codigo_periodo'),
    (22, 'T', '$codigo_periodo'),
    (23, 'U', '$codigo_periodo'),
    (24, 'V', '$codigo_periodo'),
    (25, 'W', '$codigo_periodo'),
    (26, 'X', '$codigo_periodo'),
    (27, 'Y', '$codigo_periodo'),
    (28, 'Z', '$codigo_periodo');";
    $conexion->query($sql);
    $sql = "SELECT * FROM historico_nivel_seccion";
    $result = $conexion->query($sql);
    $num = $result->num_rows;
    $sql = "INSERT INTO historico_nivel_seccion(codigo_niveles, codigo_seccion, estado, periodo) VALUES
    (1, 1, 1, '$codigo_periodo'),
    (2, 2, 1, '$codigo_periodo'),
    (2, 3, 1, '$codigo_periodo'),
    (3, 4, 1, '$codigo_periodo'),
    (3, 5, 1, '$codigo_periodo'),
    (4, 6, 1, '$codigo_periodo'),
    (4, 7, 1, '$codigo_periodo')";
    $conexion->query($sql);
    echo '
          <script>
          alert ("PERIODO REGISTRADO");
          window.location="../admin/periodos.php";
          </script>
      
      ';
} else {
    echo '
           <script>
           alert ("PERIODO NO REGISTRADO");
           window.location="../admin/acciones/agregar_periodos.php";
           </script>
      
      
      ';
}
mysqli_close($conexion);
