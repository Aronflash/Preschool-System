<?php
// Incluye el archivo de conexión a la base de datos
include_once '../php/conexion.php';

// Verifica si se ha enviado la cédula de la madre
if (isset($_POST['cedulapapa'])) {
    $cedulapapa = $_POST['cedulapapa'];

    // Query para buscar la madre por cédula
    $sql = "SELECT * FROM papa WHERE cedula_papa = '$cedulapapa'";
    $result = $conexion->query($sql);

    // Inicializa un array para almacenar la información de la madre
    $papaInfo = array();

    if ($result->num_rows > 0) {
        // La madre existe, obtén la información
        $row = $result->fetch_assoc();
        $papaInfo['apellidos'] = $row['apellidos'];
        $papaInfo['nombres'] = $row['nombres'];
        $papaInfo['codigoCivil'] = $row['codigo_estadocivil'];
        $papaInfo['nacionalidad'] = $row['codigo_nacionalidad'];
        $papaInfo['fecha_papa'] = $row['fecha_nacimiento'];
        $papaInfo['telefono'] = $row['telefono'];
        $papaInfo['direccionHabitacion'] = $row['direccion_habitacion'];
        $papaInfo['telefonoHabitacion'] = $row['telefono_habitacion'];
        $papaInfo['direccionTrabajo'] = $row['direccion_trabajo'];
        $papaInfo['telefonoTrabajo'] = $row['telefono_trabajo'];
        $papaInfo['nivelAcademico'] = $row['codigo_nivelacademico'];
        $papaInfo['ocupacion'] = $row['ocupacion'];
        $papaInfo['profesion'] = $row['profesion'];
        $papaInfo['correo'] = $row['correo'];
        $papaInfo['datosExtras'] = $row['datos_extras'];
        // Convierte el array a formato JSON y lo devuelve

        echo json_encode($papaInfo);
    } else {
        require "./periodos_a_buscar.php";
        if($periodos != null){
            for($i = 0; $i < sizeof($periodos); $i++){
                $sql = "SELECT * FROM historico_papa WHERE cedula_papa = '$cedulapapa' AND periodo = '$periodos[$i]';";
                $result = $conexion->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $papaInfo['apellidos'] = $row['apellidos'];
                    $papaInfo['nombres'] = $row['nombres'];
                    $papaInfo['codigoCivil'] = $row['codigo_estadocivil'];
                    $papaInfo['nacionalidad'] = $row['codigo_nacionalidad'];
                    $papaInfo['fecha_papa'] = $row['fecha_nacimiento'];
                    $papaInfo['telefono'] = $row['telefono'];
                    $papaInfo['direccionHabitacion'] = $row['direccion_habitacion'];
                    $papaInfo['telefonoHabitacion'] = $row['telefono_habitacion'];
                    $papaInfo['direccionTrabajo'] = $row['direccion_trabajo'];
                    $papaInfo['telefonoTrabajo'] = $row['telefono_trabajo'];
                    $papaInfo['nivelAcademico'] = $row['codigo_nivelacademico'];
                    $papaInfo['ocupacion'] = $row['ocupacion'];
                    $papaInfo['profesion'] = $row['profesion'];
                    $papaInfo['correo'] = $row['correo'];
                    $papaInfo['datosExtras'] = $row['datos_extras'];
                    break;
                }
            }
            echo json_encode($papaInfo);
        }
        else{
            // Representante no encontrado, devolver null
            echo json_encode(null);
        }
    }

} else {
    // Si no se ha enviado la cédula, devuelve un mensaje de error
    echo "Error: No se ha proporcionado la cédula de la madre.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>