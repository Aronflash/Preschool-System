<?php
include 'conexion.php';

$codigo_niveles = mysqli_real_escape_string($conexion, $_POST['codigo_niveles']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);

// Verificar si el código ya existe
$verificando_codigo_niveles = mysqli_query($conexion, "SELECT * FROM niveles WHERE codigo_niveles='$codigo_niveles'");
if (mysqli_num_rows($verificando_codigo_niveles) > 0) {
    echo '
        <script>
            alert("Este código ya está registrado, intenta con uno nuevo");
            window.location = "../admin/acciones/agregar_niveles.php";
        </script>
    ';
    exit();
}

// Verificar si la descripción ya existe
$verificando_descripcion = mysqli_query($conexion, "SELECT * FROM niveles WHERE descripcion='$descripcion'");
if (mysqli_num_rows($verificando_descripcion) > 0) {
    echo '
        <script>
            alert("Esta descripción ya está registrada, intenta con una nueva");
            window.location = "../admin/acciones/agregar_niveles.php";
        </script>
    ';
    exit();
}

$query = "INSERT INTO niveles (codigo_niveles, descripcion) VALUES ('$codigo_niveles', '$descripcion')";

$queri = mysqli_query($conexion, $query);
if ($queri) {
    echo '
        <script>
            alert ("NIVEL REGISTRADO");
            window.location="../admin/niveles.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert ("NIVEL NO REGISTRADO");
            window.location="../admin/acciones/agregar_niveles.php";
        </script>
    ';
}

mysqli_close($conexion);
?>


