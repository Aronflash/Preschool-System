<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "../php/calcularEdad.php";
    // Recupera los datos del estudiante
    $cedulaEstudiante = $_POST['cedulaEstudiante'];
    $apellidosEstudiante = $_POST['apellidosEstudiante'];
    $nombresEstudiante = $_POST['nombresEstudiante'];
    $fechaEstudiante = $_POST['fechaEstudiante'];
    $lugarNacimiento = $_POST['lugarNacimiento'];
    $estadoEstudiante = $_POST['estadoEstudiante'];
    $nacionalidadEstudiante = $_POST['nacionalidadEstudiante'];
    $procedenciaEstudiante = $_POST['procedenciaEstudiante'];
    $estadoHermano = $_POST['estadoHermano'];
    $cantidadHermano = $_POST['cantidadHermano'];
    $lugarHermano = $_POST['lugarHermano'];
    // Agrega el resto de los campos del estudiante...

    // Recupera los datos de antecedentes prenatales
    $enfermedad = $_POST['enfermedad'];
    $hospitalizado = $_POST['hospitalizado'];
    $hospitalizado = ($hospitalizado == 0)? $hospitalizado : htmlspecialchars($_POST['motivoHospitalizacion']);
    $presentaAlergia = $_POST['presentaAlergia'];
    $presentaAlergia = ($presentaAlergia == 0)? $presentaAlergia: strtolower($_POST['alergias']);
    $condicion = $_POST['padeceCondicion']; 
    $condicion = ($condicion == 0)? $condicion: htmlspecialchars($_POST['condicion']);
    $informe = $_POST['informe'];
    $limitacion = $_POST['limitacion'];
    $especialista = $_POST['especialista'];
    $doctor = $_POST['doctor'];
    $enfermarFacilidad = $_POST['enfermarFacilidad'];
    // Agrega el resto de los campos de antecedentes prenatales...

    // Recupera los datos del representante legal
    $cedulaRepresentante = $_POST['cedulaRepresentante'];
    $nacionalidadRepresentante = $_POST['nacionalidadRepresentante'];
    $apellidosRepresentante = $_POST['apellidosRepresentante'];
    $nombresRepresentante = $_POST['nombresRepresentante'];
    $telefonoRepresentante = $_POST['telefonoRepresentante'];
    $codigoParentesco = $_POST['codigoParentesco'];
    // Agrega el resto de los campos del representante legal...

    // Recupera los datos de la madre
    $cedulaMama = $_POST['cedulaMama'];
    $apellidosMama = $_POST['apellidosMama'];
    $nombresMama = $_POST['nombresMama'];
    $codigoCivilMama = $_POST['codigoCivilMama'];
    $nacionalidadMama = $_POST['nacionalidadMama'];
    $fechaMama = $_POST['fechaMama'];
    $direccionHMama = $_POST['direccionHMama'];
    $telefonoHMama = $_POST['telefonoHMama'];
    $direccionTMama = $_POST['direccionTMama'];
    $telefonoTMama = $_POST['telefonoTMama'];
    $nivelMama = $_POST['nivelMama'];
    $ocupacionMama = $_POST['ocupacionMama'];
    $profesionMama = $_POST['profesionMama'];
    $correoMama = $_POST['correoMama'];
    $datosMama = $_POST['datosMama'];
    $telefonoMama = $_POST['telefonoMama'];
    // Agrega el resto de los campos de la madre...

    // Recupera los datos del padre
    $cedulaPapa = $_POST['cedulaPapa'];
    $apellidosPapa = $_POST['apellidosPapa'];
    $nombresPapa = $_POST['nombresPapa'];
    $estadoPapa = $_POST['estadoPapa'];
    $nacionalidadPapa = $_POST['nacionalidadPapa'];
    $fechaPapa = $_POST['fechaPapa'];
    $direccionHPapa = $_POST['direccionHPapa'];
    $telefonoHPapa = $_POST['telefonoHPapa'];
    $direccionTPapa = $_POST['direccionTPapa'];
    $telefonoTPapa = $_POST['telefonoTPapa'];
    $nivelPapa = $_POST['nivelPapa'];
    $ocupacionPapa = $_POST['ocupacionPapa'];
    $profesionPapa = $_POST['profesionPapa'];
    $correoPapa = $_POST['correoPapa'];
    $datosPapa = $_POST['datosPapa'];
    $telefonoPapa = $_POST['telefonoPapa'];
    // Agrega el resto de los campos del padre...

    // Recupera los datos de emergencia
    $nombreCaso = $_POST['nombreCaso'];
    $parentescoCaso = $_POST['parentescoCaso'];

    include '../php/conexion.php';

    // Verificar si el estudiante ya existe
    $sqlEstudiante = "SELECT * FROM estudiante WHERE cedula_escolar = '$cedulaEstudiante'";
    $resultEstudiante = $conexion->query($sqlEstudiante);

    if ($resultEstudiante->num_rows > 0) {
        // El estudiante ya existe, obtener el código
        $rowEstudiante = $resultEstudiante->fetch_assoc();
        $codigoEstudiante = $rowEstudiante['cedula_escolar'];

        // Verificar si ya existen antecedentes parentales
        $sqlAntecedentesExist = "SELECT * FROM antecedentes_paranatales WHERE cedula_escolar = '$cedulaEstudiante'";
        $resultAntecedentesExist = $conexion->query($sqlAntecedentesExist);

        if ($resultAntecedentesExist->num_rows > 0) {
            // Ya existen antecedentes parentales, mostrar mensaje de éxito
            echo "Se ha inscrito exitosamente.";
        } else {
            // Agregar antecedentes parANAtales
            $sqlAntecedentes = "INSERT INTO antecedentes_paranatales (enfermedad, hospitalizado, alergias, condicion, informe, limitacion, especialista, doctor, enfermar_facilidad, cedula_escolar) VALUES ('$enfermedad', '$hospitalizado', '$presentaAlergia', '$condicion', '$informe', '$limitacion', '$especialista', '$doctor', '$enfermarFacilidad', '$codigoEstudiante')";
            $resultAntecedentes = $conexion->query($sqlAntecedentes);

            if ($resultAntecedentes) {
                // Éxito: mostrar mensaje o hacer cualquier otra cosa necesaria
                echo "Se ha inscrito exitosamente.";
            } else {
                // Error en antecedentes parentales
                echo "Error al agregar antecedentes parentales: " . $conexion->error;
            }
        }
    } else {
        // No existe, agregar nuevo estudiante y los registros asociados
        // Verificar y/o agregar representante_legal
        $sqlRepresentante = "SELECT * FROM representante_legal WHERE cedula_representante = '$cedulaRepresentante'";
        $resultRepresentante = $conexion->query($sqlRepresentante);

        if ($resultRepresentante->num_rows > 0) {
            // Ya existe, obtener el código
            $rowRepresentante = $resultRepresentante->fetch_assoc();
            $codigoRepresentante = $rowRepresentante['cedula_representante'];
        } else {
            // No existe, agregar nuevo registro
            $sqlAgregarRepresentante = "INSERT INTO representante_legal (cedula_representante, nombres, apellidos, telefono, codigo_parentesco, nacionalidad) VALUES ('$cedulaRepresentante', '$nombresRepresentante', '$apellidosRepresentante', '$telefonoRepresentante', '$codigoParentesco', $nacionalidadRepresentante)";
            $conexion->query($sqlAgregarRepresentante);

            // Obtener el código recién insertado
            $codigoRepresentante = $conexion->insert_id;
        }

        // Repetir el proceso para mama
        // Repetir el proceso para mama
        $sqlMama = "SELECT * FROM mama WHERE cedula_mama = '$cedulaMama'";
        $resultMama = $conexion->query($sqlMama);

        if ($resultMama->num_rows > 0) {
            // Ya existe, obtener el código
            $rowMama = $resultMama->fetch_assoc();
            $codigoMama = $rowMama['cedula_mama'];
        } else {
            // No existe, agregar nuevo registro
            $sqlAgregarMama = "INSERT INTO mama (cedula_mama, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, telefono, edad) VALUES ('$cedulaMama', '$nombresMama', '$apellidosMama', '$codigoCivilMama', '$nacionalidadMama', '$fechaMama', '$direccionHMama', '$telefonoHMama', '$direccionTMama', '$telefonoTMama', '$nivelMama', '$ocupacionMama', '$profesionMama', '$correoMama', '$datosMama', '$telefonoMama', '".calcularEdad($fechaMama)."')";
            $resultAgregarMama = $conexion->query($sqlAgregarMama);

            // Obtener el código recién insertado
            $codigoMama = $conexion->insert_id;
        }

        // Repetir el proceso para papa
        $sqlPapa = "SELECT * FROM papa WHERE cedula_papa = '$cedulaPapa'";
        $resultPapa = $conexion->query($sqlPapa);

        if ($resultPapa->num_rows > 0) {
            // Ya existe, obtener el código
            $rowPapa = $resultPapa->fetch_assoc();
            $codigoPapa = $rowPapa['cedula_papa'];
        } else {
            // No existe, agregar nuevo registro
            $sqlAgregarPapa = "INSERT INTO papa (cedula_papa, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, telefono, edad) VALUES ('$cedulaPapa', '$nombresPapa', '$apellidosPapa', '$estadoPapa', '$nacionalidadPapa', '$fechaPapa', '$direccionHPapa', '$telefonoHPapa', '$direccionTPapa', '$telefonoTPapa', '$nivelPapa', '$ocupacionPapa', '$profesionPapa', '$correoPapa', '$datosPapa', '$telefonoPapa', '".calcularEdad($fechaPapa)."')";
            $conexion->query($sqlAgregarPapa);

            // Obtener el código recién insertado
            $codigoPapa = $conexion->insert_id;
        }

        // Repetir el proceso para caso_emergencia
        $sqlCasoEmergencia = "SELECT * FROM caso_emergencia WHERE nombre = '$nombreCaso'";
        $resultCasoEmergencia = $conexion->query($sqlCasoEmergencia);

        if ($resultCasoEmergencia->num_rows > 0) {
            // Ya existe, obtener el código
            $rowCasoEmergencia = $resultCasoEmergencia->fetch_assoc();
            $codigoCasoEmergencia = $rowCasoEmergencia['codigo_emergencia'];
        } else {
            // No existe, agregar nuevo registro
            $sqlAgregarCasoEmergencia = "INSERT INTO caso_emergencia (nombre, parentesco) VALUES ('$nombreCaso', '$parentescoCaso')";
            $conexion->query($sqlAgregarCasoEmergencia);

            // Obtener el código recién insertado
            $codigoCasoEmergencia = $conexion->insert_id;
        }

        // Agregar nuevo estudiante
        $sql = "INSERT INTO estudiante (cedula_escolar, Nacionalidad, nombres, apellidos, fecha_nacimiento, lugar_nacimiento, estado, codigo_nacionalidad, procedencia, estado_hermano, cantidad_hermano, lugar_hermano, cedula_representante, cedula_mama, cedula_papa, caso_emergencia, edad) VALUES ('$cedulaEstudiante', '$nacionalidadEstudiante', '$nombresEstudiante', '$apellidosEstudiante', '$fechaEstudiante', '$lugarNacimiento', '$estadoEstudiante', '$nacionalidadEstudiante', '$procedenciaEstudiante', '$estadoHermano', '$cantidadHermano', '$lugarHermano', '$cedulaRepresentante', '$cedulaMama', '$cedulaPapa', '$codigoCasoEmergencia', '".calcularEdad($fechaEstudiante)."')";
        $resultEstudiante = $conexion->query($sql);

        if ($resultEstudiante) {
            // Agregar antecedentes parentales
            $sqlAntecedentes = "INSERT INTO antecedentes_paranatales (enfermedad, hospitalizado, alergias, condicion, informe, limitacion, especialista, doctor, enfermar_facilidad, cedula_escolar) VALUES ('$enfermedad', '$hospitalizado', '$presentaAlergia', '$condicion', '$informe', '$limitacion', '$especialista', '$doctor', '$enfermarFacilidad', '$cedulaEstudiante')";
            $resultAntecedentes = $conexion->query($sqlAntecedentes);

            if ($resultAntecedentes) {
                // Éxito: mostrar mensaje o hacer cualquier otra cosa necesaria
                echo "Se ha inscrito exitosamente.";
            } else {
                // Error en antecedentes parentales
                echo "Error al agregar antecedentes paranatales: " . $conexion->error;
            }
        } else {
            // Error en agregar estudiante
            echo "Error al agregar estudiante: " . $conexion->error;
        }
    }

} else {
    // Si no se ha enviado el formulario de la manera correcta, muestra un mensaje de error
    echo "Error: El formulario no ha sido enviado correctamente.";
}
?>