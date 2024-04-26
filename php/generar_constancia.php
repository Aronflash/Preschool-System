<?php
require 'fpdf/fpdf.php';

// Configuración de la conexión a la base de datos (reemplaza con tus propios datos)
require 'conexion.php';
$codigoInscripcion = isset($_GET['codigo_inscripcion']) ? $_GET['codigo_inscripcion'] : '';
require 'meses.php';
// Verifica que el código de inscripción no esté vacío
if (empty($codigoInscripcion)) {
    die("Error: Código de inscripción no válido.");
}

// Obtén los datos de la inscripción y del estudiante
$sqlInscripcion = "SELECT inscripcion.*, niveles.descripcion as nivel, periodo_academico.nombre as periodo, secciones.nombre as seccion,
                   estudiante.fecha_nacimiento, estudiante.lugar_nacimiento, estudiante.*
                  FROM inscripcion
                  INNER JOIN nivel_seccion ON nivel_seccion.codigo_nivelseccion=inscripcion.codigo_nivelseccion
                  INNER JOIN niveles ON nivel_seccion.codigo_niveles = niveles.codigo_niveles
                  INNER JOIN periodo_academico ON inscripcion.codigo_periodo = periodo_academico.codigo_periodo
                  INNER JOIN secciones ON nivel_seccion.codigo_seccion=secciones.codigo_seccion
                  INNER JOIN estudiante ON inscripcion.cedula_escolar = estudiante.cedula_escolar    
                  WHERE inscripcion.codigo_inscripcion = '$codigoInscripcion'";

$resultInscripcion = $conexion->query($sqlInscripcion);

// Verificar si se encontraron resultados
if ($resultInscripcion->num_rows > 0) {
    $datosInscripcion = $resultInscripcion->fetch_assoc();
    // Datos de la inscripción
    $nivel = utf8_decode($datosInscripcion['nivel']);
    $periodo = utf8_decode($datosInscripcion['periodo']);
    $seccion = utf8_decode($datosInscripcion['seccion']);

    // Datos del estudiante
    $cedulaEstudiante = ($datosInscripcion['cedula_escolar']);
    $nombreEstudiante = ($datosInscripcion['nombres']);
    $apellidosEstudiante = ($datosInscripcion['apellidos']);
    $fechaNacimiento = date("d/m/Y", strtotime($datosInscripcion['fecha_nacimiento']));
    $estado_nacimiento = $datosInscripcion['estado'];
    
    $lugarNacimiento = ($datosInscripcion['lugar_nacimiento']);
} else {
    die("Error: No se encontró información de la inscripción con el código $codigoInscripcion.");
}

// Obtener la fecha actual
$fechaActual = date('d/m/Y');


// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Agregar estilos
$pdf->SetFont('Arial', '', 12);

// Contenido del PDF
$pdf->Image('logoprees.png', 170,8, 25);
$pdf->Image('oficial.png', 10,8, 25);
$pdf->Cell(0, 5, utf8_decode('REPÚBLICA BOLIVARIANA DE VENEZUELA'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('MINISTERIO DEL PODER POPULAR PARA LA EDUCACION'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('C.E.I. SIMONCITO CONGRESO DE ANGOSTURA'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('SAN CRISTÓBAL ESTADO TÁCHIRA'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('CODIGO DE DEPENDENCIA 004102223'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('CODIGO DEA OD01252023'), 0, 1, 'C');

$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, utf8_decode('CONSTANCIA DE INSCRIPCIÓN'), 0, 1, 'C');
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);

$pdf->MultiCell(0, 10, utf8_decode('     Quien suscribe, Msc. NELLY MENDEZ de Taylor, titular de la cédula de identidad V-10.154.625, en su condición de Director(a) del C.E.I. Simoncito "Congreso de Angostura", ubicado en el municipio San Cristóbal de la parroquia San Juan Bautista, hace constar por medio de la presente, que el(a) niño(a) ' . strtoupper($nombreEstudiante . ' ' . $apellidosEstudiante) . ' con cédula escolar Nº' . $cedulaEstudiante . ' nacido(a) en ' . strtoupper($lugarNacimiento) . ', estado '. strtoupper($estado_nacimiento). ' el ' . $fechaNacimiento . ', está inscrito(a) para cursar el ' . $nivel . ' Sección "' . $seccion . '" durante el, Año Escolar ' . $periodo . '.'), 0, 'J');
$pdf->Ln(10);
$pdf->MultiCell(0, 10, utf8_decode('     Certificación que se expide en San Cristóbal, a los '. date('d'). ' día(s) del mes de '. mes(). ' del año '. date('Y'). '.'), 0, 'J');
$pdf->Ln(40);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('________________________________'), 0, 1, 'C');
$pdf->Cell(0, 10, utf8_decode('Msc. NELLY MENDEZ DE TAYLOR'), 0, 1, 'C');
$pdf->Cell(0, 10, utf8_decode('Directora'), 0, 1, 'C');

// Mostrar el PDF
include("footer.php");
$pdf->Output();
?>