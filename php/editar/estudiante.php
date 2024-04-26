<?php
require '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $cedula_escolar = $_POST['cedula_escolar'];
    $apellidos_estudiante = $_POST['apellidos_estudiante'];
    $nombres_estudiante = $_POST['nombres_estudiante'];
    $fecha_estudiante = $_POST['fecha_estudiante'];
    $edad_estudiante = $_POST['edad_estudiante'];
    $lugar_nacimiento = $_POST['lugar_nacimiento'];
    $estado_estudiante = $_POST['estado_estudiante'];
    $codigo_nacionalidad = $_POST['codigo_nacionalidad'];
    $procedencia_estudiante = $_POST['procedencia_estudiante'];
    $estado_hermano = $_POST['estado_hermano'];
    $cantidad_hermano = $_POST['cantidad_hermano'];
    $sexo_hermano = $_POST['sexo_hermano'];
    $lugar_hermano = $_POST['lugar_hermano'];
    $cedula_representante = $_POST['cedula_representante'];
    $cedula_mama = $_POST['cedula_mama'];
    $cedula_papa = $_POST['cedula_papa'];
    $caso_emergencia = $_POST['caso_emergencia'];

    // Realizar la actualización
    $sqlActualizarEstudiante = "UPDATE estudiante 
                                SET apellidos = '$apellidos_estudiante', 
                                    nombres = '$nombres_estudiante', 
                                    fecha_nacimiento = '$fecha_estudiante', 
                                    edad = '$edad_estudiante', 
                                    lugar_nacimiento = '$lugar_nacimiento', 
                                    estado = '$estado_estudiante', 
                                    codigo_nacionalidad = '$codigo_nacionalidad', 
                                    procedencia = '$procedencia_estudiante', 
                                    estado_hermano = '$estado_hermano', 
                                    cantidad_hermano = '$cantidad_hermano', 
                                    sexo_hermano = '$sexo_hermano', 
                                    lugar_hermano = '$lugar_hermano', 
                                    cedula_representante = '$cedula_representante', 
                                    cedula_mama = '$cedula_mama', 
                                    cedula_papa = '$cedula_papa', 
                                    caso_emergencia = '$caso_emergencia'
                                WHERE cedula_escolar = '$cedula_escolar'";

    if (mysqli_query($conexion, $sqlActualizarEstudiante)) {
        echo '<script>alert("Estudiante actualizado con éxito."); window.location.href="../../admin/estudiantes.php";</script>';
    } else {
        echo "Error al actualizar estudiante: " . mysqli_error($conexion);
    }
}
?>