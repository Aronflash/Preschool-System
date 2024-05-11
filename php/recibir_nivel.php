<?php
include "conexion.php";
if (isset($_POST['nivelSeleccionado'])) {
    $nivelSeleccionado = $_POST['nivelSeleccionado'];
    
    // Consulta SQL para seleccionar las secciones no asociadas al nivel seleccionado
    $consulta = "SELECT s.codigo_seccion, s.nombre
                 FROM secciones s
                 WHERE NOT EXISTS (
                     SELECT 1
                     FROM nivel_seccion ns
                     WHERE ns.codigo_niveles = '$nivelSeleccionado'
                     AND ns.codigo_seccion = s.codigo_seccion
                 )";

    // Ejecutar la consulta
    $resultado = $conexion->query($consulta);

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Imprimir los resultados en formato JSON (puedes cambiar el formato según tus necesidades)
        $seccionesNoAsociadas = array();
        while ($fila = $resultado->fetch_assoc()) {
            $seccionesNoAsociadas[] = $fila;
        }
        echo json_encode($seccionesNoAsociadas);
    } else {
        echo "No hay secciones disponibles para este nivel.";
    }
} else {
    echo "No se recibió ningún nivel seleccionado.";
}
?>