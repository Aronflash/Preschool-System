<?php
// Incluye el archivo de conexión a la base de datos
include_once '../php/conexion.php';
require "./calcularEdad.php";

// Verifica si se ha enviado la cédula escolar del estudiante
if (isset($_POST['cedulaEscolar'])) {
    $cedulaEscolar = $_POST['cedulaEscolar'];

    // Query para buscar el estudiante por cédula escolar
    $sql = "SELECT * FROM estudiante WHERE cedula_escolar = '$cedulaEscolar';";
    $result = $conexion->query($sql);

    // Inicializa un array para almacenar la información del estudiante
    $estudianteInfo = array();

    if ($result->num_rows > 0) {
        // El estudiante existe, obtén la información
        $row = $result->fetch_assoc();
        $estudianteInfo['apellidos'] = $row['apellidos'];
        $estudianteInfo['nombres'] = $row['nombres'];
        $estudianteInfo['fechaNacimiento'] = $row['fecha_nacimiento'];
        $estudianteInfo['edad'] = calcularEdad($row['fecha_nacimiento']);
        $estudianteInfo['lugarNacimiento'] = $row['lugar_nacimiento'];
        $estudianteInfo['estado'] = $row['estado'];
        $estudianteInfo['nacionalidad'] = $row['codigo_nacionalidad'];
        $estudianteInfo['procedencia'] = $row['procedencia'];
        $estudianteInfo['estadoHermano'] = $row['estado_hermano'];
        $estudianteInfo['cantidadHermano'] = $row['cantidad_hermano'];
        $estudianteInfo['sexoHermano'] = $row['sexo_hermano'];
        $estudianteInfo['lugarHermano'] = $row['lugar_hermano'];
        $estudianteInfo['estado_estudiante'] = $row['estado_estudiante'];

        // Convierte el array a formato JSON y lo devuelve
        echo json_encode($estudianteInfo);
    } else {
        require "./periodos_a_buscar.php";
        if($periodos != null){
            for($i = 0; $i < sizeof($periodos); $i++){
                $sql = "SELECT * FROM historico_estudiante WHERE cedula_escolar = '$cedulaEscolar' AND periodo = '$periodos[$i]';";
                $result = $conexion->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $estudianteInfo['apellidos'] = $row['apellidos'];
                    $estudianteInfo['nombres'] = $row['nombres'];
                    $estudianteInfo['fechaNacimiento'] = $row['fecha_nacimiento'];
                    $estudianteInfo['edad'] = calcularEdad($row['fecha_nacimiento']);
                    $estudianteInfo['lugarNacimiento'] = $row['lugar_nacimiento'];
                    $estudianteInfo['estado'] = $row['estado'];
                    $estudianteInfo['nacionalidad'] = $row['codigo_nacionalidad'];
                    $estudianteInfo['procedencia'] = $row['procedencia'];
                    $estudianteInfo['estadoHermano'] = $row['estado_hermano'];
                    $estudianteInfo['cantidadHermano'] = $row['cantidad_hermano'];
                    $estudianteInfo['sexoHermano'] = $row['sexo_hermano'];
                    $estudianteInfo['lugarHermano'] = $row['lugar_hermano'];
                    $estudianteInfo['estado_estudiante'] = $row['estado_estudiante'];
                    break;
                }
            }
            echo json_encode($estudianteInfo);
        }
        else{
           // Representante no encontrado, devolver null
            echo json_encode(null);  
        }
    }

} else {
    // Si no se ha enviado la cédula escolar, devuelve un mensaje de error
    echo "Error: No se ha proporcionado la cédula escolar del estudiante.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>