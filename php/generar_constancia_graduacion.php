<?php
require 'conexion.php';
require 'fpdf/fpdf.php';
require 'meses.php';
// Función para obtener el nombre del nivel
function obtenerNombreNivel($codigoNivel, $conexion)
{
    $sql = "SELECT descripcion FROM niveles WHERE codigo_niveles = '$codigoNivel'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['descripcion'];
    } else {
        return '';
    }
}

$cedulaEscolar = isset($_GET['cedula_escolar']) ? $_GET['cedula_escolar'] : '';

if (empty($cedulaEscolar)) {
    die("Error: Cédula escolar no válida.");
}

$sqlEstudiante = "SELECT * FROM estudiante WHERE cedula_escolar = '$cedulaEscolar'";
$resultEstudiante = $conexion->query($sqlEstudiante);



if ($resultEstudiante->num_rows > 0) {
    $datosEstudiante = $resultEstudiante->fetch_assoc();
    $nombreEstudiante = $datosEstudiante['nombres'] . ' ' . $datosEstudiante['apellidos'];
    $lugarNacimiento = $datosEstudiante['lugar_nacimiento'];
	//$fechaNacimiento = "SELECT DATE_FORMAT(fecha_nacimiento, '%d/%m/%Y') FROM estudiante";
    $fechaNacimiento = $datosEstudiante['fecha_nacimiento'];
    $estado = $datosEstudiante['estado'];
	
} else {
    die("Error: No se encontró información del estudiante con la cédula $cedulaEscolar.");
}
$codigoInscripcion = $_GET['codigo_inscripcion']; 

$sqlInscripcion = "SELECT inscripcion.*, niveles.codigo_niveles as codigo_nivel, periodo_academico.nombre as periodo, secciones.nombre as seccion
FROM inscripcion
INNER JOIN nivel_seccion ON nivel_seccion.codigo_nivelseccion=inscripcion.codigo_nivelseccion
INNER JOIN periodo_academico ON inscripcion.codigo_periodo = periodo_academico.codigo_periodo
INNER JOIN secciones ON nivel_seccion.codigo_seccion=secciones.codigo_seccion
INNER JOIN niveles ON nivel_seccion.codigo_niveles=niveles.codigo_niveles
WHERE inscripcion.cedula_escolar = '$cedulaEscolar'  AND inscripcion.codigo_inscripcion = '$codigoInscripcion'";
$resultInscripcion = $conexion->query($sqlInscripcion);

if ($resultInscripcion->num_rows > 0) {
    $datosInscripcion = $resultInscripcion->fetch_assoc();
    $codigoNivel = $datosInscripcion['codigo_nivel'];
    $nivelInscripcion = obtenerNombreNivel($codigoNivel, $conexion);
    $periodoInscripcion = $datosInscripcion['periodo'];
    $seccionInscripcion = $datosInscripcion['seccion'];
} else {
    die("Error: No se encontró información de inscripción para la cédula $cedulaEscolar.");
}

// Actualizar el estado del estudiante a 3
$sqlActualizarEstado = "UPDATE estudiante SET estado_estudiante = 3 WHERE cedula_escolar = '$cedulaEscolar'";
$conexion->query($sqlActualizarEstado);

$nombreDirector = mb_convert_encoding("Nelly Mendez de Taylor", 'ISO-8859-1', 'UTF-8');
$cedulaDirector = mb_convert_encoding("V-10.154.625", 'ISO-8859-1', 'UTF-8');
$ceiDirector = mb_convert_encoding("CEI Simoncito Congreso de Angostura", 'ISO-8859-1', 'UTF-8');


// Obtener la fecha actual
$fechaActual = date('d/m/Y');

class PDFCertificacion extends FPDF
{
    function Header()
    {   
        $this->Image('ministerio.png', 25, 0, 200);
        $this->Image('escudo.png', 100,40, 20);
        $this->Ln(60);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, utf8_decode('CONSTANCIA DE PROSECUCIÓN '), 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('EN EL NIVEL DE EDUCACIÓN INICIAL'), 0, 1, 'C');
    }

}


$pdfCertificacion = new PDFCertificacion();
$pdfCertificacion->AddPage();

$pdfCertificacion->SetFont('Arial', '', 12);
$pdfCertificacion->Ln(10);
$pdfCertificacion->MultiCell(0, 10, utf8_decode('     Quien suscribe ' . $nombreDirector . ' titular de la Cédula de Identidad Nº ' . $cedulaDirector . ' en su condición de Director(a) del ' . strtoupper($ceiDirector) . ', ubicado en el municipio San Cristóbal de la parroquia San Juan Bautista, adscrito a la Zona Educativa del estado Táchira, hace constar por medio de la presente que el niño(a) ' . strtoupper($nombreEstudiante) . ', portador de la Cédula Escolar Nº ' . $cedulaEscolar . ', nacido(a) en ' . $lugarNacimiento . ' Estado Táchira en fecha ' . date("d/m/Y", strtotime($fechaNacimiento)) . ', cursó el ' . $nivelInscripcion . ' de la etap Preescolar de Educación Inicial durante el período escolar ' . $periodoInscripcion . ' y continuará estudios en el 1er. Grado del Nivel de Educación Primaria, previo cumplimiento de los requisitos exigidos en la normativa legal vigente.'), 0, 'J');

$pdfCertificacion->Ln(10);


$pdfCertificacion->MultiCell(0, 10, utf8_decode('     Constancia que se expide en San Cristóbal, a los '. date('d'). ' día(s) del mes de '. mes(). ' del año '. date('Y'). '.'), 0, 'J');

$pdfCertificacion->Ln(9);

$pdfCertificacion->SetFont('Arial', 'B', 10);


// Cabecera de la tabla
$Ha = $pdfCertificacion->GetY();
$pdfCertificacion->Cell(5);
$pdfCertificacion->Cell(90, 10, 'PLANTEL', 0, 0, 'C');
$pdfCertificacion->Cell(90, 10, 'ZONA EDUCATIVA', 0, 0, 'C');
$pdfCertificacion->Ln(5);
$pdfCertificacion->Cell(5);
$pdfCertificacion->Cell(90, 10, utf8_decode('PARA VALIDEZ A NIVEL NACIONAL'), 0, 0, 'C');
$pdfCertificacion->Cell(90, 10, utf8_decode('VALIDEZ A NIVEL INTERNACIONAL'), 0, 0, 'C');
$pdfCertificacion->Line(15, $pdfCertificacion->GetY()+10, 195, $pdfCertificacion->GetY()+10);
$pdfCertificacion->Ln();

// Filas de la tabla (puedes sustituir los textos de ejemplo)

$pdfCertificacion->Cell(5);
$pdfCertificacion->Cell(90, 10, 'Director(a):', 0, 0, '');
$pdfCertificacion->Cell(90, 10, 'Director(a):', 0, 0, '');
$pdfCertificacion->Line(15, $pdfCertificacion->GetY()+10, 195, $pdfCertificacion->GetY()+10);
$pdfCertificacion->Ln(9);
$pdfCertificacion->Cell(5);
$pdfCertificacion->Cell(90, 10, 'Nombre y Apellido: '.utf8_decode("$nombreDirector"), 0, 0, '');
$pdfCertificacion->Cell(90, 10, 'Nombre y Apellido: ', 0, 0, '');
$pdfCertificacion->Line(15, $pdfCertificacion->GetY()+10, 195, $pdfCertificacion->GetY()+10);
$pdfCertificacion->Ln(9);
$pdfCertificacion->Cell(5);
$pdfCertificacion->Cell(90, 10,  utf8_decode('Cédula: ') . $cedulaDirector, 0, 0, '');
$pdfCertificacion->Cell(90, 10, utf8_decode('Cédula: '), 0, 0, '');
$pdfCertificacion->Line(15, $pdfCertificacion->GetY()+10, 195, $pdfCertificacion->GetY()+10);
$pdfCertificacion->Ln(9);
$pdfCertificacion->Cell(5);
$pdfCertificacion->Cell(90, 10, 'Firma y sello', 0, 0, '');
$pdfCertificacion->Cell(90, 10, 'Firma y sello', 0, 0, '');
$pdfCertificacion->Ln();
$pdfCertificacion->Ln();
$pdfCertificacion->Line(15, $Ha, 15, $pdfCertificacion->GetY());
$pdfCertificacion->Line(105, $Ha, 105, $pdfCertificacion->GetY());
$pdfCertificacion->Line(195, $Ha, 195, $pdfCertificacion->GetY());
$pdfCertificacion->Line(15, $Ha, 195, $Ha);
$pdfCertificacion->Line(15, $pdfCertificacion->GetY(), 195,  $pdfCertificacion->GetY());







// Establecer el tipo de contenido y los encabezados de charset
header('Content-Type: application/pdf; charset=utf-8');

// Salida del PDF directamente al navegador
$pdfCertificacion->Output();
?>