<?php
include_once '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedulaRepresentante = $_POST['cedulaRepresentante'];

    // Realizar la búsqueda en la base de datos
    $sql = "SELECT * FROM representante_legal WHERE cedula_representante = '$cedulaRepresentante'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // Representante encontrado, devolver la información en formato JSON
        $row = $result->fetch_assoc();
        $representanteInfo = array(
            'apellidos' => $row['apellidos'],
            'nombres' => $row['nombres'],
            'telefono' => $row['telefono'],
            'codigoParentesco' => $row['codigo_parentesco']
        );

        echo json_encode($representanteInfo);
    } else {
        require "./periodos_a_buscar.php";
        if($periodos != null){
            for($i = 0; $i < sizeof($periodos); $i++){
                $sql = "SELECT * FROM historico_representante WHERE cedula_representante = '$cedulaRepresentante' AND periodo = '$periodos[$i]';";
                $result = $conexion->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $representanteInfo = array(
                        'apellidos' => $row['apellidos'],
                        'nombres' => $row['nombres'],
                        'telefono' => $row['telefono'],
                        'codigoParentesco' => $row['codigo_parentesco']
                    );
                    break;
                }
            }
            echo json_encode($representanteInfo);
        }
        else{
            // Representante no encontrado, devolver null
            echo json_encode(null);
        }
    }
} else {
    // Si la solicitud no es de tipo POST, devolver error
    echo json_encode(array('error' => 'Solicitud no válida'));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
