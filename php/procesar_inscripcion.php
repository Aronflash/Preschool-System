<?php
// Verificar si se recibieron los datos del formulario

use FontLib\Table\Type\head;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "./calcularEdad.php";

    // Aquí obtienes las variables del formulario
    $cedulaEscolar = $_POST['cedula_escolar'];
    $codigoNivelseccion = $_POST['codigo_nivelseccion'];
    $codigoPeriodo = $_POST['codigo_periodo'];
    $fecha = date('Y/m/d');
    $periodo = isset($_POST['periodo_historico'])? $_POST['periodo_historico'] : "none";
    echo $periodo;
    include 'conexion.php';

    // Obtener el nombre del nivel directamente de la tabla nivel_seccion
    $sqlObtenerNivel = "SELECT niveles.descripcion
                        FROM nivel_seccion
                        INNER JOIN niveles ON nivel_seccion.codigo_niveles = niveles.codigo_niveles
                        WHERE nivel_seccion.codigo_nivelseccion = '$codigoNivelseccion'";
    
    $resultObtenerNivel = $conexion->query($sqlObtenerNivel);

    if ($resultObtenerNivel->num_rows > 0) {
        $rowNivel = $resultObtenerNivel->fetch_assoc();
        $nombreNivel = $rowNivel['descripcion'];

        // Verificar si ya existe una inscripción con la misma cédula escolar, nivel y periodo
        $sqlVerificarInscripcion = "SELECT * FROM inscripcion WHERE cedula_escolar = '$cedulaEscolar' AND codigo_periodo = '$codigoPeriodo'";
        $resultVerificarInscripcion = $conexion->query($sqlVerificarInscripcion);

        if ($resultVerificarInscripcion->num_rows == 1) {
            // Ya existe una inscripción para esta cédula y periodo
            echo '<script>alert("Ya existe una inscripción para esta cédula y periodo.");</script>';
            // echo '<script>window.location = "../admin/registroestudiante.php";</script>';
            echo '<script>window.location = "../admin/registroestudiante.php"</script>';
            exit();
        } else {
            // No existe una inscripción duplicada, procede con la inserción
        $codigoInscripcion = $cedulaEscolar . '-' . $codigoPeriodo . '-' . $codigoNivelseccion;
        $sql = "SELECT * FROM estudiante WHERE cedula_escolar = '$cedulaEscolar';";
        $resultado = $conexion->query($sql);
        if($resultado->num_rows == 0 && $periodo != 'none'){
            $sql = "SELECT * FROM historico_estudiante WHERE cedula_escolar = '$cedulaEscolar' AND periodo = '$periodo'";
            $resultado = $conexion->query($sql);
            $estudiante = $resultado->fetch_assoc();
                // caso_emergencia
            $sql = "SELECT * FROM caso_emergencia WHERE codigo_emergencia = '".$estudiante['caso_emergencia']."';";
            $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sql = "INSERT INTO caso_emergencia(codigo_emergencia, nombre, foto_emergencia, parentesco)
                SELECT codigo_emergencia, nombre, foto_emergencia, parentesco FROM historico_caso WHERE periodo = '$periodo' AND codigo_emergencia = '".$estudiante['caso_emergencia']."';";
                $conexion->query($sql);
            }
            // representante legal
            $sql = "SELECT * FROM representante_legal WHERE cedula_representante = '".$estudiante['cedula_representante']."';";
            $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sql = "INSERT INTO representante_legal(cedula_representante, nombres, apellidos, telefono, codigo_parentesco, foto_representante, codigo_estado, nacionalidad)
                SELECT cedula_representante, nombres, apellidos, telefono, codigo_parentesco, foto_representante, codigo_estado, nacionalidad FROM historico_representante WHERE periodo = '$periodo' AND cedula_representante = '".$estudiante['cedula_representante']."';";
                $conexion->query($sql);
            }

            // papa
            $sql = "SELECT * FROM papa WHERE cedula_papa = '".$estudiante['cedula_papa']."';";
            $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sql = "INSERT INTO papa(cedula_papa, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_papa, codigo_estado, telefono, edad)
                SELECT cedula_papa, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_papa, codigo_estado, telefono, edad FROM historico_papa WHERE periodo = '$periodo' AND cedula_papa = '".$estudiante['cedula_papa']."';";
                $conexion->query($sql);
                $sql = "SELECT * FROM papa WHERE cedula_papa = '".$estudiante['cedula_papa']."';";
                $result = $conexion->query($sql);
                $row = $result->fetch_assoc();
                $sql = "UPDATE papa SET edad = '".calcularEdad($row['fecha_nacimiento'])."' WHERE cedula_papa = '".$estudiante['cedula_papa']."';";
                $conexion->query($sql);
            }
        
            // mama
            $sql = "SELECT * FROM mama WHERE cedula_mama = '".$estudiante['cedula_mama']."';";
            $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sql = "INSERT INTO mama(cedula_mama, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_mama, codigo_estado, telefono, edad)
                SELECT cedula_mama, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_mama, codigo_estado, telefono, edad FROM historico_mama WHERE periodo = '$periodo' AND cedula_mama = '".$estudiante['cedula_mama']."';";
                $conexion->query($sql);
                $sql = "SELECT * FROM mama WHERE cedula_mama = '".$estudiante['cedula_mama']."';";
                $result = $conexion->query($sql);
                $row = $result->fetch_assoc();
                $sql = "UPDATE mama SET edad = '".calcularEdad($row['fecha_nacimiento'])."' WHERE cedula_mama = '".$estudiante['cedula_mama']."';";
                $conexion->query($sql);

            }

            // estudiante
            $sql = "SELECT * FROM estudiante WHERE cedula_escolar = '$cedulaEscolar';";
            $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sql = "INSERT INTO estudiante(cedula_escolar, Nacionalidad, nombres, apellidos, fecha_nacimiento, edad, lugar_nacimiento, estado, codigo_nacionalidad, estado_hermano, cantidad_hermano, sexo_hermano, lugar_hermano, cedula_representante, cedula_papa, cedula_mama, caso_emergencia, foto_estudiante, procedencia, estado_estudiante)
                SELECT cedula_escolar, Nacionalidad, nombres, apellidos, fecha_nacimiento, edad, lugar_nacimiento, estado, codigo_nacionalidad, estado_hermano, cantidad_hermano, sexo_hermano, lugar_hermano, cedula_representante, cedula_papa, cedula_mama, caso_emergencia, foto_estudiante, procedencia, estado_estudiante FROM historico_estudiante WHERE periodo = '$periodo' AND cedula_escolar = '$cedulaEscolar';";
                $conexion->query($sql);
                $sql = "SELECT * FROM estudiante WHERE cedula_escolar = '$cedulaEscolar';";
                $result = $conexion->query($sql);
                $row = $result->fetch_assoc();
                $sql = "UPDATE estudiante SET edad = '".calcularEdad($row['fecha_nacimiento'])."' WHERE cedula_escolar = '$cedulaEscolar';";
                $conexion->query($sql);
            }

            // antecedentes paranatales
            $sql = "SELECT * FROM antecedentes_paranatales WHERE cedula_escolar = '$cedulaEscolar';";
            $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sql = "INSERT INTO antecedentes_paranatales(codigo_antecedentes, enfermedad, hospitalizado, alergias, condicion, informe, limitacion, especialista, doctor, enfermar_facilidad, cedula_escolar)
                SELECT codigo_antecedentes, enfermedad, hospitalizado, alergias, condicion, informe, limitacion, especialista, doctor, enfermar_facilidad, cedula_escolar FROM historico_antecedentes WHERE periodo = '$periodo' AND cedula_escolar = '$cedulaEscolar';";
                $conexion->query($sql);
            }

        }

        $sql = "SELECT * FROM inscripcion WHERE codigo_inscripcion = '$codigoInscripcion';";
        $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sqlInscripcion = "INSERT INTO inscripcion (codigo_inscripcion, cedula_escolar, codigo_nivelseccion, codigo_periodo, fecha)
                VALUES ('$codigoInscripcion', '$cedulaEscolar', '$codigoNivelseccion', '$codigoPeriodo', '$fecha')";
            }
        

            if ($conexion->query($sqlInscripcion) === TRUE) {
                // Verificar si el nivel es "Grupo C" y cambiar el estado del estudiante a 2
                if ($nombreNivel == 'Grupo C') {
                    $sqlActualizarEstado = "UPDATE estudiante SET estado_estudiante = 2 WHERE cedula_escolar = '$cedulaEscolar'";
                    $conexion->query($sqlActualizarEstado);
                }
                require "./redirigir_inscripcion.php";
            } else {
                echo "Error al realizar la inscripción: " . $conexion->error;
            }
        }
    } else {
        echo "Error al obtener el nombre del nivel: " . $conexion->error;
    }

    // Cierra la conexión
    $conexion->close();
}
?>
