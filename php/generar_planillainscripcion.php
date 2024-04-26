<?php
    require 'fpdf/fpdf.php';
    include "./calcularEdad.php";
    session_start();
    if(!isset($_SESSION['codigo_usuario'])){
        header("Location: ../admin/cerrarsesion.php");
    }

    // Configuración de la conexión a la base de datos (reemplaza con tus propios datos)
    $codigoInscripcion = isset($_GET['codigo_inscripcion']) ? $_GET['codigo_inscripcion'] : '';
    // Verifica que el código de inscripción no esté vacío
    if (empty($codigoInscripcion)) {
        die("Error: Código de inscripción no válido.");
    }

    class PDF extends FPDF{
        function titulo($texto){
            $this->Ln(5);
            $this->SetFont('Arial', 'B', '15');
            $this->Cell(0, 5, utf8_decode($texto), 0, 1, 'C');
            $this->Ln(5);
            $this->SetFont('Arial', '', 7);
        }

        function resultado($texto){
            $this->SetFont('Arial', 'B', 7);
            $this->Write(5, utf8_decode(strtoupper($texto)));
            $this->SetFont('Arial', '', 7);
        }
        function Header(){
            $imagen1 = "./ministerio1.png";
            $imagen2 = "./oficial.png";
            $imagen3 = "./logoprees.png";
            $this->Image($imagen1, 10, -2, 40);
            $this->Image($imagen2, 95, 5, 25);
            $this->Image($imagen3, 170, 5, 35);
            $this->SetFont('Times', '', 10);
            $this->Ln(20);
            $this->Cell(0, 4, utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'), 0, 1, 'C');
            $this->Cell(0, 4, utf8_decode('MINISTERIO DEL PODER POPULAR PARA LA EDUCACION'), 0, 1, 'C');
            $this->Cell(0, 4, utf8_decode('C.E.I. SIMONCITO CONGRESO DE ANGOSTURA'), 0, 1, 'C');
            $this->Cell(0, 4, utf8_decode('SAN CRISTÓBAL ESTADO TÁCHIRA'), 0, 1, 'C');
            $this->Cell(0, 4, utf8_decode('CODIGO DE DEPENDENCIA 004102223'), 0, 1, 'C');
            $this->Cell(0, 4, utf8_decode('CODIGO DEA OD01252023'), 0, 1, 'C');
            $this->Ln(4);
            $this->SetFont('Arial', 'B', '20');
            $this->Cell(0, 4, utf8_decode("FICHA DE INSCRIPCIÓN"), 0, 1, 'C');
            $this->SetFontSize(15);
            $this->Ln(3);
            $this->Cell(0, 4, utf8_decode("AÑO ESCOLAR 2023-2024"), 0, 1, 'C');
            
        }

        function chart($y1, $y2){
            $this->Line(200, $y1, 200, $y2);
            $this->Line(170, $y1, 170, $y2);
            $this->Line(170, $y1, 200, $y1);
            $this->Line(170, $y2, 200, $y2);
        }
        function marcarX($x, $y){
            $this->SetFont('Arial', 'B', 7);
            $this->Text($x, $y-1, "X");
            $this->SetFont('Arial', '', 7);
        }
        function body($datos, $conn){

            //Datos ninos

            $interlineado = 4;
            $apellidosN = $datos['apellidos_b'];
            $nombresN = $datos['nombres_b'];
            $fnaN = date("d/m/Y", strtotime($datos['fna_b']));
            $edadN = $datos['edad_b'];
            $lnaN = $datos['lna_b'];
            $estadoN = $datos['estado_b'];
            $nacionalidadN = ($datos['nacionalidad_b'] == 1)? "Venezolano": "Extranjero";
            $cedulaN = $datos['nacionalidad_b'].$datos['cedula_estudiante'];
            $tieneHermanos = $datos['estadoHermano_b'];
            $cantidadHermanos = $datos['cantidadHermano_b'];
            $lugarHermanos = $datos['lugarHermano_b'];
            $procedenciaN = $datos['procedencia_b'];

            // datos representante

            $apellidosR = $datos['apellidos_r'];
            $nombresR = $datos['nombres_r'];
            $signoR = ($datos['nacionalidad_r'] == 1) ? "V" : "E";
            $cedulaR = $signoR.$datos['cedula_r'];
            $telefonoR = $datos['telefono_r'];
            $parentescoR = $datos['parentesco_r'];

            // datos mama

            $apellidosM = $datos['apellidos_m'];
            $nombresM = $datos['nombres_m'];
            $signoM = ($datos['nacionalidad_m'] == 1)? 'V' : 'E';
            $cedulaM = $signoM.$datos['cedula_m'];
            $telefonoM = $datos['telefono_m'];
            $aux = $datos['estadoCivil_m'];
            $sql = "SELECT descripcion FROM estado_civil WHERE codigo_estadocivil = $aux;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $estadoM = $row['descripcion'];
            $sql = "SELECT * FROM nacionalidad WHERE codigo_nacionalidad = ".$datos['nacionalidad_m'];
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nacionalidadM = $row['descripcion'];
            $edadM = $datos['edad_m'];
            $correoM = $datos['correo_m'];
            $direccionMT = $datos['dt_m'];
            $telefonoMT = $datos['tt_m'];
            $telefonoMH = $datos['th_m'];
            $direccionMH = $datos['dh_m'];
            $sql = "SELECT descripcion FROM nivel_academico WHERE codigo_nivelacademico =".$datos['nivelAcademico_m'];
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $educacionM = $row['descripcion'];
            $ocupacionM = $datos['ocupacion_m'];
            $profesionM = $datos['profesion_m'];
            $datosExtraM = $datos['datos_extra_m'];

            // datos papa

            $apellidosP = $datos['apellidos_pp'];
            $nombresP = $datos['nombres_pp'];
            $signoP = ($datos['nacionalidad_pp'] == 1)? 'V' : 'E';
            $cedulaP = $signoP.$datos['cedula_pp'];
            $telefonoP = $datos['telefono_pp'];
            $aux = $datos['estadoCivil_pp'];
            $sql = "SELECT descripcion FROM estado_civil WHERE codigo_estadocivil = $aux;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $estadoP = $row['descripcion'];
            $sql = "SELECT * FROM nacionalidad WHERE codigo_nacionalidad = ".$datos['nacionalidad_pp'];
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nacionalidadP = $row['descripcion'];
            $edadP = $datos['edad_pp'];
            $correoP = $datos['correo_pp'];
            $telefonoPT = $datos['tt_pp'];
            $direccionPT =$datos['dt_pp'];
            $telefonoPH = $datos['th_pp'];
            $direccionPH = $datos['dh_pp'];
            $sql = "SELECT descripcion FROM nivel_academico WHERE codigo_nivelacademico =".$datos['nivelAcademico_pp'];
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $educacionP = $row['descripcion'];
            $ocupacionP = $datos['ocupacion_pp'];
            $profesionP = $datos['profesion_pp'];
            $datosExtraP = $datos['datos_extra_pp'];
            $enfermedad = $datos['enfermedad_AP'];
            $hospitalizado = $datos['hospitalizado_AP'];
            $motivoHospitalizacion = ($hospitalizado == 0)? "": $hospitalizado;
            $alergia = $datos['alergias_AP'];
            $tipoalergia = ($alergia == 0)? "": strtoupper($alergia);
            $tieneCondicion = $datos['condicion_AP'];
            $condicion = ($tieneCondicion == 0)? "" : $tieneCondicion;
            $presentaInforme = $datos['informe_AP'];
            $esAtendido = strtoupper($datos['especialista_AP']);
            $limitacion = $datos['limitacion_AP'];
            $doctor = $datos['doctor_AP'];
            $autorizado = $datos['caso_emergencia'];
            $ef = $datos['enfermar_facilidad_AP'];
            $parentescoA = $datos['parentesco_emergencia'];
            $this->titulo('DATOS DEL NIÑO (A)');
            $this->Write(5, 'Apellidos: ');
            $this->resultado($apellidosN);
            $this->Line(22, $this->GetY()+4, 59, $this->GetY()+4);
            $this->SetX(63);
            $this->Write(5, 'Nombres: ');
            $this->Line(75, $this->GetY()+4, 128, $this->GetY()+4);
            $this->resultado($nombresN);
            $this->SetX(128);
            $this->Write(5, "Fecha de Nacimiento: ");
            $this->resultado($fnaN);
            $this->Line(154, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, "Edad: ");
            $this->resultado($edadN);
            $this->Line(18, $this->GetY()+4, 22, $this->GetY()+4);
            $this->chart(68, 103);
            $this->SetX(22);
            $this->Write(5, "Lugar de nacimiento: ");
            $this->resultado($lnaN);
            $this->Line(47, $this->GetY()+4, 89, $this->GetY()+4);
            $this->SetX(90);
            $this->Write(5, "Estado: ");
            $this->resultado($estadoN);
            $this->Line(100, $this->GetY()+4, 131, $this->GetY()+4);
            $this->SetX(132);
            $this->Write(5, "Nacionalidad: ");
            $this->resultado($nacionalidadN);
            $this->Line(149, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, "Procedencia: Hogar");
            $this->Line(33, $this->GetY()+4, 40, $this->GetY()+4);
            $this->SetX(40);
            $this->Write(5, "Del mismo plantel");
            $this->Line(61, $this->GetY()+4, 68, $this->GetY()+4);
            $this->SetX(68);
            $this->Write(5, "Otro plantel");
            switch($procedenciaN){
                case '0':
                    $this->marcarX(((33+40)/2)-1, $this->GetY()+4);
                    break;
                case '1':
                    $this->marcarX(((61+68)/2)-1, $this->GetY()+4);
                    break;
                default:
                    $this->SetX(82);
                    $this->resultado($procedenciaN);
                    break;
            }
            $this->Line(82, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Cédula escolar: "));
            $this->resultado($cedulaN);
            $this->Line(29, $this->GetY()+4, 47, $this->GetY()+4);
            $this->SetX(47);
            $this->Write(5, utf8_decode("¿Tiene hermanos? Si:"));
            $this->Line(73, $this->GetY()+4, 81, $this->GetY()+4);
            $this->SetX(82);
            $this->Write(5, "No:");
            $this->Line(88, $this->GetY()+4, 96, $this->GetY()+4);
            ($tieneHermanos == "Si")? $this->marcarX(((73+81)/2)-1, $this->GetY()+4) : $this->marcarX(((88+96)/2)-1, $this->GetY()+4);
            $this->SetX(97);
            $this->Write(5, utf8_decode("¿Cuántos? "));
            $this->Line(110, $this->GetY()+4, 121, $this->GetY()+4);
            $this->resultado($cantidadHermanos);
            $this->SetX(121);
            $this->Write(5, utf8_decode("Lugar entre hermanos: "));
            $this->Line(148, $this->GetY()+4, 166, $this->GetY()+4);
            $this->resultado($lugarHermanos);
            $this->Ln($interlineado*2);
            $this->SetFont('Arial', 'B', 8);
            $this->Line(11, $this->GetY()+4, 47, $this->GetY()+4);
            $this->Write(5, "Antecedentes Paranatales: ");
            $this->SetFont('Arial', '', 7);
            $this->Write(5, " Que enfermedad ha padecido: ");
            $this->resultado($enfermedad);
            $this->Line(83, $this->GetY()+4, 200, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode('¿Ha estado el niño(a) Hospitalizado?'));
            $this->SetX(51);
            $this->Write(5, utf8_decode("Si: "));
            $this->Line(55, $this->GetY()+4, 61, $this->GetY()+4);
            $this->SetX(60);
            $this->Write(5, utf8_decode("No: "));
            $this->Line(65, $this->GetY()+4, 72, $this->GetY()+4);
            ($hospitalizado != 0) ? $this->marcarX(((55+61)/2)-1, $this->GetY()+4) : $this->marcarX(((65+72)/2)-1, $this->GetY()+4);
            $this->SetX(71);
            $this->Write(5, utf8_decode("¿Por qué?: "));
            $this->Line(85, $this->GetY()+4, 200, $this->GetY()+4);
            ($hospitalizado != 0) ? $this->resultado($motivoHospitalizacion) : null;
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("¿Presenta alguna alergia a Medicamento, Polvo, Compuesto Alimenticio? Si:"));
            $this->Line(97, $this->GetY()+4, 101, $this->GetY()+4);
            $this->SetX(100);
            $this->Write(5, "No:");
            $this->Line(105, $this->GetY()+4, 109, $this->GetY()+4);
            ($alergia) ? $this->marcarX(((97+101)/2)-1, $this->GetY()+4) : $this->marcarX(((105+109)/2)-1, $this->GetY()+4);
            $this->SetX(109);
            $this->Write(5, utf8_decode("¿Cuál?: "));
            $this->Line(119, $this->GetY()+4, 200, $this->GetY()+4);
            ($alergia) ? $this->resultado($tipoalergia) : null;
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("¿Padece alguna Condición?"));
            $this->SetX(42);
            $this->Write(5, "Si:");
            $this->Line(46, $this->GetY()+4, 50, $this->GetY()+4);
            $this->SetX(50);
            $this->Write(5, "No:");
            $this->Line(54, $this->GetY()+4, 58, $this->GetY()+4);
            ($tieneCondicion != 0)? $this->marcarX(((46+50)/2)-1, $this->GetY()+4) : $this->marcarX(((54+58)/2)-1, $this->GetY()+4);
            $this->SetX(58);
            $this->Write(5, utf8_decode("¿Cuál?: "));
            $this->Line(68, $this->GetY()+4, 200, $this->GetY()+4);
            ($tieneCondicion != 0) ? $this->resultado($condicion) : null;
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("¿Presentó Informe?"));
            $this->SetX(32);
            $this->Write(5, "Si:");
            $this->Line(37, $this->GetY()+4, 42, $this->GetY()+4);
            $this->SetX(42);
            $this->Write(5, "No:       ;");
            $this->Line(47, $this->GetY()+4, 52, $this->GetY()+4);
            ($presentaInforme != 0)? $this->marcarX(((37+42)/2)-1, $this->GetY()+4) : $this->marcarX(((47+52)/2)-1, $this->GetY()+4);
            $this->SetX(52);
            $this->Write(5, utf8_decode("¿Padece alguna limitación?"));
            $this->SetX(83);
            $this->Write(5, "Motora:");
            $this->Line(93, $this->GetY()+4, 97, $this->GetY()+4);
            $this->SetX(96);
            $this->Write(5, "de Crecimiento:");
            $this->Line(115, $this->GetY()+4, 119, $this->GetY()+4);
            $this->SetX(119);
            $this->Write(5, "Auditiva:");
            $this->Line(130, $this->GetY()+4, 134, $this->GetY()+4);
            $this->SetX(134);
            $this->Write(5, "Visual:       ;");
            $this->Line(143, $this->GetY()+4, 147, $this->GetY()+4);
            $this->SetX(148);
            switch($limitacion){
                case 1:
                    $this->marcarX(((93+97)/2)-1, $this->GetY()+4);
                    break;
                case 2:
                    $this->marcarX(((115+119)/2)-1, $this->GetY()+4);
                    break;
                case 3:
                    $this->marcarX(((130+134)/2)-1, $this->GetY()+4);
                    break;
                case 4:
                    $this->marcarX(((143+147)/2)-1, $this->GetY()+4);
                    break;
            };
            $this->Write(5, utf8_decode("¿Es Atendido (a) por Especialista?: "));
            $this->Line(189, $this->GetY()+4, 200, $this->GetY()+4);
            $this->resultado(($esAtendido)? "SI":"NO");
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode(" Datos del Dr. "));
            $this->Line(27, $this->GetY()+4, 144, $this->GetY()+4);
            ($esAtendido)? $this->resultado($doctor): null;
            $this->SetX(144);
            $this->Write(5, utf8_decode("Tiende a enfermarse con facilidad"));
            $this->SetX(182);
            $this->Write(5, "Si");
            $this->Line(186, $this->GetY()+4, 190, $this->GetY()+4);
            $this->SetX(190);
            $this->Write(5, "No");
            $this->Line(195, $this->GetY()+4, 199, $this->GetY()+4);
            ($ef != 0)? $this->marcarX(((186+190)/2)-1, $this->GetY()+4) : $this->marcarX(((195+199)/2)-1, $this->GetY()+4);
            $this->Text(200, $this->GetY()+4, ".");
            $this->Ln($interlineado);

            //dATOS REPRESENTANTE
            $this->titulo("DATOS FAMILIARES");
            $this->resultado("Datos del Representante Legal:");
            $this->Line(11, $this->GetY()+4, 57, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, 'Apellidos: ');
            $this->resultado($apellidosR);
            $this->Line(22, $this->GetY()+4, 56, $this->GetY()+4);
            $this->SetX(57);
            $this->Write(5, 'Nombres: ');
            $this->resultado($nombresR);
            $this->Line(70, $this->GetY()+4, 109, $this->GetY()+4);
            $this->SetX(110);
            $this->Write(5, utf8_decode("Cédula: "));
            $this->resultado($cedulaR);
            $this->Line(120, $this->GetY()+4, 135, $this->GetY()+4);
            $this->SetX(135);
            $this->Write(5, utf8_decode("Teléfono: "));
            $this->resultado($telefonoR);
            $this->Line(147, $this->GetY()+4, 162, $this->GetY()+4);
            $this->SetX(162);
            $this->Write(5, "Parentezco: ");
            $this->resultado($parentescoR);
            $this->Line(177, $this->GetY()+4, 200, $this->GetY()+4);
            $this->Ln($interlineado*2);

            //mADRE
            //Cuadro madre
            $this->chart($this->GetY(), $this->GetY()+35);
            $this->resultado("Madre:");
            $this->Line(11, $this->GetY()+4, 20, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, 'Apellidos: ');
            $this->resultado($apellidosM);
            $this->Line(22, $this->GetY()+4, 56, $this->GetY()+4);
            $this->SetX(57);
            $this->Write(5, 'Nombres: ');
            $this->resultado($nombresM);
            $this->Line(70, $this->GetY()+4, 109, $this->GetY()+4);
            $this->SetX(110);
            $this->Write(5, utf8_decode("Cédula: "));
            $this->resultado($cedulaM);
            $this->Line(120, $this->GetY()+4, 138, $this->GetY()+4);
            $this->SetX(138);
            $this->Write(5, utf8_decode("Teléfono: "));
            $this->resultado($telefonoM);
            $this->Line(150, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Estado civil: "));
            $this->resultado($estadoM);
            $this->Line(25, $this->GetY()+4, 49, $this->GetY()+4);
            $this->SetX(50);
            $this->Write(5, "Nacionalidad: ");
            $this->resultado($nacionalidadM);
            $this->Line(67, $this->GetY()+4, 86, $this->GetY()+4);
            $this->SetX(87);
            $this->Write(5, "Edad: ");
            $this->resultado($edadM);
            $this->Line(95, $this->GetY()+4, 100, $this->GetY()+4);
            $this->SetX(100);
            $this->Write(5, "Correo: ");
            $this->resultado($correoM);
            $this->Line(110, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Dirección de Habitación: "));
            $this->resultado($direccionMH);
            $this->Line(39, $this->GetY()+4, 133, $this->GetY()+4);
            $this->SetX(133);
            $this->Write(5, utf8_decode("Teléfono: "));
            $this->resultado($telefonoMH);
            $this->Line(145, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Dirección de Trabajo: "));
            $this->resultado($direccionMT);
            $this->Line(35, $this->GetY()+4, 133, $this->GetY()+4);
            $this->SetX(133);
            $this->Write(5, utf8_decode("Teléfono: "));
            $this->resultado($telefonoMT);
            $this->Line(145, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Nivel académico: "));
            $this->resultado($educacionM);
            $this->Line(30, $this->GetY()+4, 60, $this->GetY()+4);
            $this->SetX(60);
            $this->Write(5, utf8_decode("Ocupación: "));
            $this->resultado($ocupacionM);
            $this->Line(74, $this->GetY()+4, 120, $this->GetY()+4);
            $this->SetX(120);
            $this->Write(5, utf8_decode("Profesión: "));
            $this->resultado($profesionM);
            $this->Line(133, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Otros datos de importancia sobre la situación familiar que se desee reflejar: "));
            $this->Line(94, $this->GetY()+$interlineado, 166, $this->GetY()+$interlineado);
            $this->resultado($datosExtraM);
            $this->Ln($interlineado);
            $this->Ln($interlineado);
            $this->Ln($interlineado);


            //PADRE
            //imagen padre
            $this->chart($this->GetY(), $this->GetY()+35);
            $this->resultado("Padre:");
            $this->Line(11, $this->GetY()+4, 20, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, 'Apellidos: ');
            $this->resultado($apellidosP);
            $this->Line(22, $this->GetY()+4, 56, $this->GetY()+4);
            $this->SetX(57);
            $this->Write(5, 'Nombres: ');
            $this->resultado($nombresP);
            $this->Line(70, $this->GetY()+4, 109, $this->GetY()+4);
            $this->SetX(110);
            $this->Write(5, utf8_decode("Cédula: "));
            $this->resultado($cedulaP);
            $this->Line(120, $this->GetY()+4, 138, $this->GetY()+4);
            $this->SetX(138);
            $this->Write(5, utf8_decode("Teléfono: "));
            $this->resultado($telefonoP);
            $this->Line(150, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Estado civil: "));
            $this->resultado($estadoP);
            $this->Line(25, $this->GetY()+4, 49, $this->GetY()+4);
            $this->SetX(50);
            $this->Write(5, "Nacionalidad: ");
            $this->resultado($nacionalidadP);
            $this->Line(67, $this->GetY()+4, 86, $this->GetY()+4);
            $this->SetX(87);
            $this->Write(5, "Edad: ");
            $this->resultado($edadP);
            $this->Line(95, $this->GetY()+4, 100, $this->GetY()+4);
            $this->SetX(100);
            $this->Write(5, "Correo: ");
            $this->resultado($correoP);
            $this->Line(110, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Dirección de Habitación: "));
            $this->resultado($direccionPH);
            $this->Line(39, $this->GetY()+4, 133, $this->GetY()+4);
            $this->SetX(133);
            $this->Write(5, utf8_decode("Teléfono: "));
            $this->resultado($telefonoPH);
            $this->Line(145, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Dirección de Trabajo: "));
            $this->resultado($direccionPT);
            $this->Line(35, $this->GetY()+4, 133, $this->GetY()+4);
            $this->SetX(133);
            $this->Write(5, utf8_decode("Teléfono: "));
            $this->resultado($telefonoPT);
            $this->Line(145, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Nivel académico: "));
            $this->resultado($educacionP);
            $this->Line(30, $this->GetY()+4, 60, $this->GetY()+4);
            $this->SetX(60);
            $this->Write(5, utf8_decode("Ocupación: "));
            $this->resultado($ocupacionP);
            $this->Line(74, $this->GetY()+4, 120, $this->GetY()+4);
            $this->SetX(120);
            $this->Write(5, utf8_decode("Profesión: "));
            $this->resultado($profesionP);
            $this->Line(133, $this->GetY()+4, 166, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Otros datos de importancia sobre la situación familiar que se desee reflejar: "));
            $this->Line(94, $this->GetY()+$interlineado, 166, $this->GetY()+$interlineado);
            $this->resultado($datosExtraP);
            $this->Ln($interlineado);
            $this->Ln($interlineado);
            $this->Ln($interlineado);
            $this->Write(5, utf8_decode("Persona autorizada para retirar el niño - niña de la Institución en Caso de Emergencias: "));
            $this->Line(11, $this->GetY()+4, 107, $this->GetY()+4);
            $this->Ln($interlineado*2);
            $this->Write(5, utf8_decode("Nombre: "));
            $this->resultado($autorizado);
            $this->Line(21, $this->GetY()+4, 100, $this->GetY()+4);
            $this->SetX(100);
            $this->Write(5, "Parentezco: ");
            $this->resultado($parentescoA);
            $this->Line(115, $this->GetY()+4, 130, $this->GetY()+4);
            $this->Ln($interlineado);
            $this->SetFont('Arial', '', 6);
            $this->Write(5, utf8_decode("Anexar la copia de la Cédula."));
            $this->SetFont('Arial', '', 7);
        }
        function footer(){
            require 'conexion.php';
            $sql = "SELECT * FROM v_planillainscripcion
            WHERE codigo_inscripcion = '".$_SESSION['transporte']."';";
            $result = mysqli_query($conexion, $sql);
            $datos = mysqli_fetch_assoc($result);
            $fecha = date('d/m/Y', strtotime($datos['fecha']));
            $fecha = explode('/', $fecha);
            $dia = $fecha[0];
            $mes = $fecha[1];
            $anio = $fecha[2];
            $this->SetY(-30);
            $this->SetX(100);
            $this->Write(5, "Directora (E)");
            $this->Line(90, $this->GetY(), 125, $this->GetY());
            $this->Ln(10);
            $this->SetX(60);
            $this->Write(5, "Docente");
            $this->Line(48, $this->GetY(), 83, $this->GetY());
            $this->SetX(135);
            $this->Write(5, "Representante Legal");
            $this->Line(130, $this->GetY(), 165, $this->GetY());
            $this->Ln(10);
            $this->SetFont('Arial', '', 7);
            $this->SetY(-10);
            $this->SetX(-45);
            $this->Cell(0, 5, utf8_decode("Dia: ".$dia. " Mes: ". $mes. " Año: ". $anio));
        }
    }
    require 'conexion.php';
    $sql = "SELECT * FROM v_planillainscripcion
    WHERE codigo_inscripcion = '$codigoInscripcion';";
    $result = mysqli_query($conexion, $sql);
    $valores = mysqli_fetch_assoc($result);
    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->body($valores, $conexion);
    $_SESSION['transporte'] = $codigoInscripcion;
    $pdf->Output();
?> 