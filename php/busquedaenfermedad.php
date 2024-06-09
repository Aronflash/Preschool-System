<?php
// Incluye el archivo de conexión a la base de datos
include_once '../php/conexion.php';
require "./calcularEdad.php";

// Verifica si se ha enviado la cédula escolar del estudiante
if (isset($_POST['cedulaEscolar'])) 
{
    $cedulaEscolar = $_POST['cedulaEscolar'];

    // Query para buscar el estudiante por cédula escolar
    $sql = "SELECT * FROM `antecedentes_paranatales` WHERE cedula_escolar = '$cedulaEscolar';";
    $result = $conexion->query($sql);

    // Inicializa un array para almacenar la información del estudiante
    $estudianteEnfe = array();

    if ($result->num_rows > 0) {
        // El estudiante existe, obtén la información
        $row = $result->fetch_assoc();
        
        $estudianteEnfe['enfermedad'] = $row['enfermedad'];
        $estudianteEnfe['hospitalizado'] = $row['hospitalizado'];
        $estudianteEnfe['alergias'] = $row['alergias'];
        $estudianteEnfe['condicion'] = $row['condicion'];
        $estudianteEnfe['informe'] = $row['informe'];
        $estudianteEnfe['limitacion'] = $row['limitacion'];
        $estudianteEnfe['especialista'] = $row['especialista'];
        $estudianteEnfe['doctor'] = $row['doctor'];
        $estudianteEnfe['enfermar_facilidad'] = $row['enfermar_facilidad'];

       
        // Convierte el array a formato JSON y lo devuelve
        echo json_encode($estudianteEnfe);
    } 
    else {
        require "./periodos_a_buscar.php";
        if($periodos != null){
            for($i = 0; $i < sizeof($periodos); $i++){
                $sql="SELECT `codigo_antecedentes`, `enfermedad`, `hospitalizado`, `alergias`, `condicion`, `informe`, `limitacion`, `especialista`, `doctor`, `enfermar_facilidad`, `cedula_escolar`, `periodo` FROM `historico_antecedentes` WHERE `cedula_escolar`= '$cedulaEscolar' AND periodo = '$periodos[$i]';";               
                $result = $conexion->query($sql);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $estudianteEnfe['enfermedad'] = $row['enfermedad'];
                    $estudianteEnfe['hospitalizado'] = $row['hospitalizado'];
                    $estudianteEnfe['alergias'] = $row['alergias'];
                    $estudianteEnfe['condicion'] = $row['condicion'];
                    $estudianteEnfe['informe'] = $row['informe'];
                    $estudianteEnfe['limitacion'] = $row['limitacion'];
                    $estudianteEnfe['especialista'] = $row['especialista'];
                    $estudianteEnfe['doctor'] = $row['doctor'];
                    $estudianteEnfe['enfermar_facilidad'] = $row['enfermar_facilidad'];
                    break;
                }
            }
            echo json_encode($estudianteEnfe);
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