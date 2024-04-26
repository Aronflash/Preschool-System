<?php
    require "../../php/conexion.php";
    $codigo = $_POST['periodo'];
    $sql = "SELECT * FROM periodo_academico WHERE actual = 1;";
    $result = $conexion->query($sql);
    $periodo_actual = $result->fetch_assoc()['codigo_periodo'];
    $sql = "UPDATE periodo_academico 
    SET actual = 0 
    WHERE codigo_periodo = (SELECT codigo_periodo FROM periodo_academico WHERE actual = 1);";

    if(mysqli_query($conexion, $sql) == 1){
        $sql = "UPDATE periodo_academico 
        SET actual = 1
        WHERE codigo_periodo = $codigo;";
        if(mysqli_query($conexion, $sql) == 1){
            echo 200;
        }
        else{
            echo 100;
        }
    }
    else{
        echo 101;
    }


    //EXPERIMENTAL\\
    // DESDE ACA MIGRACION DE DATA\\

    //eliminacion

    //antecendentes paranatales
    $sql = "SELECT * FROM antecedentes_paranatales";
    $antecedentes = $conexion->query($sql);
    while($antecedente = $antecedentes->fetch_assoc()){
        $check_Antecedente = "SELECT * FROM historico_antecedentes WHERE periodo = $periodo_actual AND cedula_escolar = ".$antecedente['cedula_escolar'];
        $result_Antecedente = $conexion->query($check_Antecedente);
        if($result_Antecedente->num_rows == 1){
            $sql = "UPDATE historico_antecedentes
            SET codigo_antecedentes = '".$antecedente['codigo_antecedentes']."', enfermedad = '".$antecedente['enfermedad']."', hospitalizado = '".$antecedente['hospitalizado']."', alergias = '".$antecedente['alergias']."', condicion = '".$antecedente['condicion']."',  informe = '".$antecedente['informe']."', limitacion = '".$antecedente['limitacion']."', especialista = '".$antecedente['especialista']."', doctor = '".$antecedente['doctor']."', enfermar_facilidad = '".$antecedente['enfermar_facilidad']."' WHERE periodo = '$periodo_actual' AND cedula_escolar = '".$antecedente['cedula_escolar']."';";
        }
        else{
            $sql = "INSERT INTO historico_antecedentes(codigo_antecedentes, enfermedad, hospitalizado, alergias, condicion, informe, limitacion, especialista, doctor, enfermar_facilidad, cedula_escolar, periodo) VALUES('".$antecedente['codigo_antecedentes']."', '".$antecedente['enfermedad']."', '".$antecedente['hospitalizado']."', '".$antecedente['alergias']."', '".$antecedente['condicion']."', '".$antecedente['informe']."', '".$antecedente['limitacion']."', '".$antecedente['especialista']."', '".$antecedente['doctor']."', '".$antecedente['enfermar_facilidad']."', '".$antecedente['cedula_escolar']."', '$periodo_actual');";
        }
        if($conexion->query($sql)){
            $sql = "DELETE FROM antecedentes_paranatales WHERE codigo_antecedentes = ".$antecedente['codigo_antecedentes'];
            $conexion->query($sql);
        }
    }

    //inscripcion
    $sql = "SELECT * FROM inscripcion;";
    $inscripciones = $conexion->query($sql);
    while($inscripcion = $inscripciones->fetch_assoc()){
        $checkInscripcion = "SELECT * FROM historico_inscripcion 
        WHERE codigo_periodo = '$periodo_actual'
        AND cedula_escolar = '".$inscripcion['cedula_escolar']."';";
        $resultInscripcion = $conexion->query($checkInscripcion);

        if ($resultInscripcion->num_rows == 1) {
        // Actualizar
        $sql = "UPDATE historico_inscripcion
        SET codigo_inscripcion = {$inscripcion['codigo_inscripcion']},
        fecha = '{$inscripcion['fecha']}'
        WHERE codigo_periodo = '$periodo_actual'
        AND cedula_escolar = '{$inscripcion['cedula_escolar']}'
        AND codigo_nivelseccion = {$inscripcion['codigo_nivelseccion']};";
        } else {
        // Insertar
        $sql = "INSERT INTO historico_inscripcion(codigo_inscripcion, cedula_escolar, codigo_nivelseccion, codigo_periodo, fecha) 
        VALUES('{$inscripcion['codigo_inscripcion']}', '{$inscripcion['cedula_escolar']}', {$inscripcion['codigo_nivelseccion']}, {$inscripcion['codigo_periodo']}, '{$inscripcion['fecha']}');";
        }
        if($conexion->query($sql)){
            $sql = "DELETE FROM inscripcion 
            WHERE codigo_inscripcion = '{$inscripcion['codigo_inscripcion']}';";
            $conexion->query($sql);
        }

    }

    //estudiantes
    $sql = "SELECT * FROM estudiante";
    $estudiantes = $conexion->query($sql);
    while($estudiante = $estudiantes->fetch_assoc()){
        $checkEstudiante = "SELECT * FROM historico_estudiante WHERE periodo = $periodo_actual AND cedula_escolar = ".$estudiante['cedula_escolar'].";";
        $resultEstudiante = $conexion->query($checkEstudiante);
        if($resultEstudiante->num_rows == 1){
            $sql = "UPDATE historico_estudiante SET Nacionalidad = '".$estudiante['Nacionalidad']."', nombres = '".$estudiante['nombres']."', apellidos = '".$estudiante['apellidos']."', fecha_nacimiento = '".$estudiante['fecha_nacimiento']."', lugar_nacimiento = '".$estudiante['lugar_nacimiento']."', estado = '".$estudiante['estado']."', codigo_nacionalidad = '".$estudiante['codigo_nacionalidad']."', estado_hermano = '".$estudiante['estado_hermano']."', cantidad_hermano = '".$estudiante['cantidad_hermano']."', sexo_hermano = '".$estudiante['sexo_hermano']."', lugar_hermano = '".$estudiante['lugar_hermano']."', cedula_representante = '".$estudiante['cedula_representante']."', cedula_papa = '".$estudiante['cedula_papa']."', cedula_mama = '".$estudiante['cedula_mama']."', caso_emergencia = '".$estudiante['caso_emergencia']."', foto_estudiante = '".$estudiante['foto_estudiante']."', procedencia = '".$estudiante['procedencia']."', estado_estudiante = '".$estudiante['estado_estudiante']."', edad = '".$estudiante['edad']."' WHERE periodo = '$periodo_actual' AND cedula_escolar = '".$estudiante['cedula_escolar']."';";
        }
        else{
            $sql = "INSERT INTO historico_estudiante(cedula_escolar, Nacionalidad, nombres, apellidos, fecha_nacimiento, lugar_nacimiento, estado, codigo_nacionalidad, estado_hermano, cantidad_hermano, sexo_hermano, lugar_hermano, cedula_representante, cedula_papa, cedula_mama, caso_emergencia, foto_estudiante, procedencia, estado_estudiante, periodo, edad) VALUES('".$estudiante['cedula_escolar']."', '".$estudiante['Nacionalidad']."', '".$estudiante['nombres']."', '".$estudiante['apellidos']."', '".$estudiante['fecha_nacimiento']."', '".$estudiante['lugar_nacimiento']."', '".$estudiante['estado']."', '".$estudiante['codigo_nacionalidad']."', '".$estudiante['estado_hermano']."', '".$estudiante['cantidad_hermano']."', '".$estudiante['sexo_hermano']."', '".$estudiante['lugar_hermano']."', '".$estudiante['cedula_representante']."', '".$estudiante['cedula_papa']."', '".$estudiante['cedula_mama']."', '".$estudiante['caso_emergencia']."', '".$estudiante['foto_estudiante']."', '".$estudiante['procedencia']."', '".$estudiante['estado_estudiante']."', '$periodo_actual', '".$estudiante['edad']."');";
        }
            if($conexion->query($sql)){
            $sql = "DELETE FROM estudiante WHERE cedula_escolar = ".$estudiante['cedula_escolar'];
            $conexion->query($sql);

             // caso emergencia
             $sql = "SELECT * FROM estudiante WHERE caso_emergencia = ".$estudiante['caso_emergencia'].";";
            $result = $conexion->query($sql);
            if($result->num_rows == 0){
                $sql = "SELECT * FROM caso_emergencia WHERE codigo_emergencia = ".$estudiante['caso_emergencia'].";";
                $casos = $conexion->query($sql);
                $caso = $casos->fetch_assoc();
                $checkCaso = "SELECT * FROM historico_caso WHERE periodo = $periodo_actual AND codigo_emergencia = '".$estudiante['caso_emergencia']."';";
                $resultCaso = $conexion->query($checkCaso);
                if($resultCaso->num_rows == 1){
                    $sql = "UPDATE historico_caso SET nombre = '".$caso['nombre']."', foto_emergencia = '".$caso['foto_emergencia']."', parentesco = '".$caso['parentesco']."' WHERE periodo = '$periodo_actual' AND codigo_emergencia = '".$caso['codigo_emergencia']."';";
                }
                else{
                    $sql = "INSERT INTO historico_caso(codigo_emergencia, nombre, foto_emergencia, parentesco, periodo) VALUES ('".$caso['codigo_emergencia']."', '".$caso['nombre']."', '".$caso['foto_emergencia']."', '".$caso['parentesco']."', '$periodo_actual');";
                }
                if($conexion->query($sql)){
                    $sql = "DELETE FROM caso_emergencia WHERE codigo_emergencia = ".$caso['codigo_emergencia'].";";
                    $conexion->query($sql);
                }
            }
            


            //mama
            $sql = "SELECT * FROM estudiante WHERE cedula_mama = ".$estudiante['cedula_mama'].";";
            $checkMamas = $conexion->query($sql);
            if($checkMamas->num_rows == 0){
                $sql = "SELECT * FROM mama WHERE cedula_mama = ".$estudiante['cedula_mama'].";";
                $result = $conexion->query($sql);
                $mama = $result->fetch_assoc();
                $sql = "SELECT * FROM historico_mama WHERE cedula_mama = ".$mama['cedula_mama']." and periodo = '$periodo_actual';";
                $checkMama = $conexion->query($sql);
                if($checkMama->num_rows == 0){
                    $sql = "INSERT INTO historico_mama(cedula_mama, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_mama, codigo_estado, telefono, periodo, edad) VALUES('".$mama['cedula_mama']."', '".$mama['nombres']."', '".$mama['apellidos']."', '".$mama['codigo_estadocivil']."', '".$mama['codigo_nacionalidad']."', '".$mama['fecha_nacimiento']."', '".$mama['direccion_habitacion']."', '".$mama['telefono_habitacion']."', '".$mama['direccion_trabajo']."', '".$mama['telefono_trabajo']."', '".$mama['codigo_nivelacademico']."', '".$mama['ocupacion']."', '".$mama['profesion']."', '".$mama['correo']."', '".$mama['datos_extras']."', '".$mama['foto_mama']."', '".$mama['codigo_estado']."', '".$mama['telefono']."', '$periodo_actual', '".$mama['edad']."');";
                }
                else{
                    $sql = "UPDATE historico_mama SET nombres = '" . $mama['nombres'] . "', apellidos = '" . $mama['apellidos'] . "', codigo_estadocivil = '" . $mama['codigo_estadocivil'] . "', codigo_nacionalidad = '" . $mama['codigo_nacionalidad'] . "', fecha_nacimiento = '" . $mama['fecha_nacimiento'] . "', direccion_habitacion = '" . $mama['direccion_habitacion'] . "', telefono_habitacion = '" . $mama['telefono_habitacion'] . "', direccion_trabajo = '" . $mama['direccion_trabajo'] . "', telefono_trabajo = '" . $mama['telefono_trabajo'] . "', codigo_nivelacademico = '" . $mama['codigo_nivelacademico'] . "', ocupacion = '" . $mama['ocupacion'] . "', profesion = '" . $mama['profesion'] . "', correo = '" . $mama['correo'] . "', datos_extras = '" . $mama['datos_extras'] . "', foto_mama = '" . $mama['foto_mama'] . "', codigo_estado = '" . $mama['codigo_estado'] . "', telefono = '" . $mama['telefono'] . "', edad = '".$mama['edad']."' WHERE cedula_mama = '" . $mama['cedula_mama'] . "' AND periodo = '" . $periodo_actual . "';";
                }
                if($conexion->query($sql)){
                    $sql = "DELETE FROM mama WHERE cedula_mama = '".$mama['cedula_mama']."';";
                    $conexion->query($sql);
                }
            }

            //papa
            $sql = "SELECT * FROM estudiante WHERE cedula_papa = ".$estudiante['cedula_papa'].";";
            $checkPapas = $conexion->query($sql);
            if($checkPapas->num_rows == 0){
                $sql = "SELECT * FROM papa WHERE cedula_papa = ".$estudiante['cedula_papa'].";";
                $result = $conexion->query($sql);
                $papa = $result->fetch_assoc();
                $sql = "SELECT * FROM historico_papa WHERE cedula_papa = ".$papa['cedula_papa']." and periodo = '$periodo_actual';";
                $checkPapa = $conexion->query($sql);
                if($checkPapa->num_rows == 0){
                    $sql = "INSERT INTO historico_papa(cedula_papa, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_papa, codigo_estado, telefono, periodo, edad) VALUES('".$papa['cedula_papa']."', '".$papa['nombres']."', '".$papa['apellidos']."', '".$papa['codigo_estadocivil']."', '".$papa['codigo_nacionalidad']."', '".$papa['fecha_nacimiento']."', '".$papa['direccion_habitacion']."', '".$papa['telefono_habitacion']."', '".$papa['direccion_trabajo']."', '".$papa['telefono_trabajo']."', '".$papa['codigo_nivelacademico']."', '".$papa['ocupacion']."', '".$papa['profesion']."', '".$papa['correo']."', '".$papa['datos_extras']."', '".$papa['foto_papa']."', '".$papa['codigo_estado']."', '".$papa['telefono']."', '$periodo_actual', '".$papa['edad']."');";
                }
                else{
                    $sql = "UPDATE historico_papa SET nombres = '" . $papa['nombres'] . "', apellidos = '" . $papa['apellidos'] . "', codigo_estadocivil = '" . $papa['codigo_estadocivil'] . "', codigo_nacionalidad = '" . $papa['codigo_nacionalidad'] . "', fecha_nacimiento = '" . $papa['fecha_nacimiento'] . "', direccion_habitacion = '" . $papa['direccion_habitacion'] . "', telefono_habitacion = '" . $papa['telefono_habitacion'] . "', direccion_trabajo = '" . $papa['direccion_trabajo'] . "', telefono_trabajo = '" . $papa['telefono_trabajo'] . "', codigo_nivelacademico = '" . $papa['codigo_nivelacademico'] . "', ocupacion = '" . $papa['ocupacion'] . "', profesion = '" . $papa['profesion'] . "', correo = '" . $papa['correo'] . "', datos_extras = '" . $papa['datos_extras'] . "', foto_papa = '" . $papa['foto_papa'] . "', codigo_estado = '" . $papa['codigo_estado'] . "', telefono = '" . $papa['telefono'] . "', edad = '".$papa['edad']."' WHERE cedula_papa = '" . $papa['cedula_papa'] . "' AND periodo = '" . $periodo_actual . "';";
                }
                if($conexion->query($sql)){
                    $sql = "DELETE FROM papa WHERE cedula_papa = '".$papa['cedula_papa']."';";
                    $conexion->query($sql);
                }
            }

            // representante
            $sql = "SELECT * FROM estudiante WHERE cedula_representante = '".$estudiante['cedula_representante']."';";
            $checkRepres = $conexion->query($sql);
            if($checkRepres->num_rows == 0){
                $sql = "SELECT * FROM representante_legal WHERE cedula_representante = '".$estudiante['cedula_representante']."';";
                $result = $conexion->query($sql);
                $repre = $result->fetch_assoc();
                $sql = "SELECT * FROM historico_representante WHERE periodo = '$periodo_actual' AND cedula_representante = '".$repre['cedula_representante']."';";
                $checkRepre = $conexion->query($sql);
                if($checkRepre->num_rows == 0){
                    $sql = "INSERT INTO historico_representante(cedula_representante, nombres, apellidos, telefono, codigo_parentesco, foto_representante, codigo_estado, nacionalidad, periodo) VALUES('".$repre['cedula_representante']."', '".$repre['nombres']."', '".$repre['apellidos']."', '".$repre['telefono']."', '".$repre['codigo_parentesco']."', '".$repre['foto_representante']."', '".$repre['codigo_estado']."', '".$repre['nacionalidad']."', '$periodo_actual');";
                }else{
                    $sql = "UPDATE historico_representante SET nombres = '".$repre['nombres']."', apellidos = '".$repre['apellidos']."', telefono = '".$repre['telefono']."', codigo_parentesco = '".$repre['codigo_parentesco']."', foto_representante = '".$repre['foto_representante']."', codigo_estado = '".$repre['codigo_estado']."', nacionalidad = '".$repre['nacionalidad']."' WHERE cedula_representante = '".$repre['cedula_representante']."' AND periodo = '".$periodo_actual."';";
                }
                if($conexion->query($sql)){
                    $sql = "DELETE FROM representante_legal WHERE cedula_representante = '".$repre['cedula_representante']."';";
                    $conexion->query($sql);
                }
            }

        }
    }

    
        //nivel_seccion
        $sql = "SELECT * FROM nivel_seccion;";
        $transiciones = $conexion->query($sql);
        while($transicion = $transiciones->fetch_assoc()){
            $checkTransicion = "SELECT * FROM historico_nivel_seccion WHERE codigo_nivelseccion = '".$transicion['codigo_nivelseccion']."' AND periodo = '$periodo_actual';";
            $resultTransicion = $conexion->query($checkTransicion);
            if($resultTransicion->num_rows == 0){
                $sql = "INSERT INTO historico_nivel_seccion(codigo_nivelseccion, codigo_niveles, codigo_seccion, estado, periodo) VALUES('".$transicion['codigo_nivelseccion']."', '".$transicion['codigo_niveles']."', '".$transicion['codigo_seccion']."', '".$transicion['estado']."', '$periodo_actual');";
            }
            else{
                $sql = "UPDATE historico_nivel_seccion SET codigo_niveles = '".$transicion['codigo_niveles']."', codigo_seccion = '".$transicion['codigo_seccion']."', estado = '".$transicion['estado']."' WHERE codigo_nivelseccion = '".$transicion['codigo_nivelseccion']."' AND periodo = '$periodo_actual';";
            }
            if($conexion->query($sql)){
                $sql = "DELETE FROM nivel_seccion WHERE codigo_nivelseccion = '".$transicion['codigo_nivelseccion']."';";
                $conexion->query($sql);
            }
        }

        // secciones
        $sql = "SELECT * FROM secciones;";
        $secciones = $conexion->query($sql);
        while($seccion = $secciones->fetch_assoc()){
            $checkSecciones = "SELECT * FROM historico_secciones WHERE codigo_seccion = '".$seccion['codigo_seccion']."' AND periodo = '$periodo_actual';";
            $resultSecciones = $conexion->query($checkSecciones);
            if($resultSecciones->num_rows == 0){
                $sql = "INSERT INTO historico_secciones(codigo_seccion, nombre, periodo) VALUES('".$seccion['codigo_seccion']."', '".$seccion['nombre']."', '$periodo_actual');";
            }
            else{
                $sql = "UPDATE historico_secciones SET nombre = '".$seccion['nombre']."' WHERE codigo_seccion = '".$seccion['codigo_seccion']."' AND periodo = '$periodo_actual';";
            }
            if($conexion->query($sql)){
                $sql = "DELETE FROM secciones WHERE codigo_seccion = '".$seccion['codigo_seccion']."';";
                $conexion->query($sql);
            }
        }


        //obtener data
        
        // Secciones
        $sql = "INSERT INTO secciones(codigo_seccion, nombre)
        SELECT codigo_seccion, nombre FROM historico_secciones WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // nivel_seccion
        $sql = "INSERT INTO nivel_seccion(codigo_nivelseccion, codigo_niveles, codigo_seccion, estado)
        SELECT codigo_nivelseccion, codigo_niveles, codigo_seccion, estado FROM historico_nivel_seccion WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // caso_emergencia
        $sql = "INSERT INTO caso_emergencia(codigo_emergencia, nombre, foto_emergencia, parentesco)
        SELECT codigo_emergencia, nombre, foto_emergencia, parentesco FROM historico_caso WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // representante legal
        $sql = "INSERT INTO representante_legal(cedula_representante, nombres, apellidos, telefono, codigo_parentesco, foto_representante, codigo_estado, nacionalidad)
        SELECT cedula_representante, nombres, apellidos, telefono, codigo_parentesco, foto_representante, codigo_estado, nacionalidad FROM historico_representante WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // papa
        $sql = "INSERT INTO papa(cedula_papa, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_papa, codigo_estado, telefono, edad)
        SELECT cedula_papa, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_papa, codigo_estado, telefono, edad FROM historico_papa WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // mama
        $sql = "INSERT INTO mama(cedula_mama, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_mama, codigo_estado, telefono, edad)
        SELECT cedula_mama, nombres, apellidos, codigo_estadocivil, codigo_nacionalidad, fecha_nacimiento, direccion_habitacion, telefono_habitacion, direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion, profesion, correo, datos_extras, foto_mama, codigo_estado, telefono, edad FROM historico_mama WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // estudiante
        $sql = "INSERT INTO estudiante(cedula_escolar, Nacionalidad, nombres, apellidos, fecha_nacimiento, lugar_nacimiento, estado, codigo_nacionalidad, estado_hermano, cantidad_hermano, sexo_hermano, lugar_hermano, cedula_representante, cedula_papa, cedula_mama, caso_emergencia, foto_estudiante, procedencia, estado_estudiante, edad)
        SELECT cedula_escolar, Nacionalidad, nombres, apellidos, fecha_nacimiento, lugar_nacimiento, estado, codigo_nacionalidad, estado_hermano, cantidad_hermano, sexo_hermano, lugar_hermano, cedula_representante, cedula_papa, cedula_mama, caso_emergencia, foto_estudiante, procedencia, estado_estudiante, edad FROM historico_estudiante WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // antecedentes paranatales
        $sql = "INSERT INTO antecedentes_paranatales(codigo_antecedentes, enfermedad, hospitalizado, alergias, condicion, informe, limitacion, especialista, doctor, enfermar_facilidad, cedula_escolar)
        SELECT codigo_antecedentes, enfermedad, hospitalizado, alergias, condicion, informe, limitacion, especialista, doctor, enfermar_facilidad, cedula_escolar FROM historico_antecedentes WHERE periodo = '$codigo';";
        $conexion->query($sql);

        // inscripcion
        $sql = "INSERT INTO inscripcion(codigo_inscripcion, cedula_escolar, codigo_nivelseccion, codigo_periodo, fecha)
        SELECT codigo_inscripcion, cedula_escolar, codigo_nivelseccion, codigo_periodo, fecha FROM historico_inscripcion WHERE codigo_periodo = '$codigo';";
        $conexion->query($sql);