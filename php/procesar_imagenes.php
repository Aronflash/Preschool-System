<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Aquí obtienes las variables del formulario
    $cedulaEscolar = $_POST['cedula_escolar'];
    $cedulaPapa = $_POST['cedula_papa'];
    $cedulaMama = $_POST['cedula_mama'];
    $cedulaRepresentante = $_POST['cedula_representante'];
    $codigoCasoEmergencia = $_POST['caso_emergencia'];

    $fotoEstudiante = isset($_FILES['fotoEstudiante']) ? addslashes(file_get_contents($_FILES['fotoEstudiante']['tmp_name'])) : '';
    $fotoPapa = isset($_FILES['fotoPapa']) ? addslashes(file_get_contents($_FILES['fotoPapa']['tmp_name'])) : '';
    $fotoMama = isset($_FILES['fotoMama']) ? addslashes(file_get_contents($_FILES['fotoMama']['tmp_name'])) : '';
    $fotoRepresentante = isset($_FILES['fotoRepresentante']) ? addslashes(file_get_contents($_FILES['fotoRepresentante']['tmp_name'])) : '';
    $fotoCasoEmergencia = isset($_FILES['fotoCasoEmergencia']) ? addslashes(file_get_contents($_FILES['fotoCasoEmergencia']['tmp_name'])) : '';

    // Aquí defines la conexión a tu base de datos
    include 'conexion.php';

    // Verificar y actualizar la foto del estudiante
    $resultEstudiante = $conexion->query("SELECT foto_estudiante FROM estudiante WHERE cedula_escolar = '$cedulaEscolar'");
    $rowEstudiante = $resultEstudiante->fetch_assoc();
    if (empty($rowEstudiante['foto_estudiante'])) {
        $sqlEstudiante = "UPDATE estudiante SET foto_estudiante = '$fotoEstudiante' WHERE cedula_escolar = '$cedulaEscolar'";
        if ($conexion->query($sqlEstudiante) === TRUE) {
            echo "Foto del estudiante actualizada con éxito.";
        } else {
            echo "Error al actualizar la foto del estudiante: " . $conexion->error;
        }
    }

    // Verificar y actualizar la foto del papá
    $resultPapa = $conexion->query("SELECT foto_papa FROM papa WHERE cedula_papa = '$cedulaPapa'");
    $rowPapa = $resultPapa->fetch_assoc();
    if (empty($rowPapa['foto_papa'])) {
        $sqlPapa = "UPDATE papa SET foto_papa = '$fotoPapa' WHERE cedula_papa = '$cedulaPapa'";
        if ($conexion->query($sqlPapa) === TRUE) {
            echo "Foto del papá actualizada con éxito.";
        } else {
            echo "Error al actualizar la foto del papá: " . $conexion->error;
        }
    }
    // Verificar y actualizar la foto de la mamá
    $resultMama = $conexion->query("SELECT foto_mama FROM mama WHERE cedula_mama = '$cedulaMama'");
    $rowMama = $resultMama->fetch_assoc();
    if (empty($rowMama['foto_mama'])) {
        $sqlMama = "UPDATE mama SET foto_mama = '$fotoMama' WHERE cedula_mama = '$cedulaMama'";
        if ($conexion->query($sqlMama) === TRUE) {
            echo "Foto de la mamá actualizada con éxito.";
        } else {
            echo "Error al actualizar la foto de la mamá: " . $conexion->error;
        }
    }
    // Verificar y actualizar la foto del representante legal
    $resultRepresentante = $conexion->query("SELECT foto_representante FROM representante_legal WHERE cedula_representante = '$cedulaRepresentante'");
    $rowRepresentante = $resultRepresentante->fetch_assoc();
    if (empty($rowRepresentante['foto_representante'])) {
        $sqlRepresentante = "UPDATE representante_legal SET foto_representante = '$fotoRepresentante' WHERE cedula_representante = '$cedulaRepresentante'";
        if ($conexion->query($sqlRepresentante) === TRUE) {
            echo "Foto del representante legal actualizada con éxito.";
        } else {
            echo "Error al actualizar la foto del representante legal: " . $conexion->error;
        }
    }
    // Verificar y actualizar la foto del caso de emergencia
    $resultCasoEmergencia = $conexion->query("SELECT foto_emergencia FROM caso_emergencia WHERE codigo_emergencia = '$codigoCasoEmergencia'");
    $rowCasoEmergencia = $resultCasoEmergencia->fetch_assoc();
    if (empty($rowCasoEmergencia['foto_emergencia'])) {
        $sqlCasoEmergencia = "UPDATE caso_emergencia SET foto_emergencia = '$fotoCasoEmergencia' WHERE codigo_emergencia = '$codigoCasoEmergencia'";
        if ($conexion->query($sqlCasoEmergencia) === TRUE) {
            echo "Foto del caso de emergencia actualizada con éxito.";
            header("Location: ../admin/inscripcion.php?cedulaEstudiante=$cedulaEscolar");
            exit();
        } else {
            echo "Error al actualizar la foto del caso de emergencia: " . $conexion->error;
        }
    }
    
    header("Location: ../admin/inscripcion.php?cedulaEstudiante=$cedulaEscolar");
    // Cierra la conexión
    $conexion->close();
}
?>