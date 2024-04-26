<?php
session_start();

if (!isset($_SESSION['codigo_usuario'])) {
    echo '
    <script>
            alert("Por favor debes iniciar sesión");
            window.location = "../index.php";
    </script>';
    session_destroy();
    die();
}

// Recuperar la variable cedulaEstudiante de la URL
$cedulaEstudiante = isset($_GET['cedulaEstudiante']) ? $_GET['cedulaEstudiante'] : '';

include '../php/conexion.php';

// Consulta para obtener los datos del estudiante y las fotos
$sqlEstudiante = "SELECT *, estudiante.cedula_escolar as cedulaEstudiante,
                    representante_legal.foto_representante,
                    mama.foto_mama,
                    papa.foto_papa,
                    caso_emergencia.foto_emergencia
                  FROM estudiante
                  LEFT JOIN representante_legal ON estudiante.cedula_representante = representante_legal.cedula_representante
                  LEFT JOIN mama ON estudiante.cedula_mama = mama.cedula_mama
                  LEFT JOIN papa ON estudiante.cedula_papa = papa.cedula_papa
                  LEFT JOIN caso_emergencia ON estudiante.caso_emergencia = caso_emergencia.codigo_emergencia
                  WHERE estudiante.cedula_escolar = '$cedulaEstudiante'";

$resultEstudiante = $conexion->query($sqlEstudiante);

// Verificar si se encontraron resultados
if ($resultEstudiante->num_rows > 0) {
    // Obtener los datos del estudiante
    $datosEstudiante = $resultEstudiante->fetch_assoc();
    // Datos del estudiante
    $cedulaPapa = $datosEstudiante['cedula_papa'];
    $cedulaMama = $datosEstudiante['cedula_mama'];
    $cedulaRepresentante = $datosEstudiante['cedula_representante'];
    $codigoCasoEmergencia = $datosEstudiante['caso_emergencia'];
    $cedulaEscolar = $datosEstudiante['cedula_escolar'];

    // Rutas de las fotos
    $fotoEstudiante = base64_encode($datosEstudiante['foto_estudiante']); // Ajusta el nombre del campo según tu base de datos
    $fotoRepresentante = base64_encode($datosEstudiante['foto_representante']); // Ajusta el nombre del campo según tu base de datos
    $fotoMama = base64_encode($datosEstudiante['foto_mama']); // Ajusta el nombre del campo según tu base de datos
    $fotoPapa = base64_encode($datosEstudiante['foto_papa']); // Ajusta el nombre del campo según tu base de datos
    $fotoCasoEmergencia = base64_encode($datosEstudiante['foto_emergencia']); // Ajusta el nombre del campo según tu base de datos

} else {
    $sqlEstudiante = "SELECT *, a.cedula_escolar as cedulaEstudiante,
                    b.foto_representante,
                    c.foto_mama,
                    d.foto_papa,
                    e.foto_emergencia
                  FROM historico_estudiante a
                  LEFT JOIN historico_representante b ON a.cedula_representante = b.cedula_representante AND a.periodo = b.periodo
                  LEFT JOIN historico_mama c ON a.cedula_mama = c.cedula_mama AND a.periodo = c.periodo
                  LEFT JOIN historico_papa d ON a.cedula_papa = d.cedula_papa AND a.periodo = d.periodo
                  LEFT JOIN historico_caso e ON a.caso_emergencia = e.codigo_emergencia AND a.periodo = e.periodo
                  WHERE a.cedula_escolar = '$cedulaEstudiante' ORDER BY a.periodo DESC LIMIT 1";

    $resultEstudiante = $conexion->query($sqlEstudiante);
    if ($resultEstudiante->num_rows > 0) {
        // Obtener los datos del estudiante
        $datosEstudiante = $resultEstudiante->fetch_assoc();
    
        // Datos del estudiante
        $cedulaPapa = $datosEstudiante['cedula_papa'];
        $cedulaMama = $datosEstudiante['cedula_mama'];
        $cedulaRepresentante = $datosEstudiante['cedula_representante'];
        $codigoCasoEmergencia = $datosEstudiante['caso_emergencia'];
        $cedulaEscolar = $datosEstudiante['cedula_escolar'];
    
        // Rutas de las fotos
        $fotoEstudiante = base64_encode($datosEstudiante['foto_estudiante']); // Ajusta el nombre del campo según tu base de datos
        $fotoRepresentante = base64_encode($datosEstudiante['foto_representante']); // Ajusta el nombre del campo según tu base de datos
        $fotoMama = base64_encode($datosEstudiante['foto_mama']); // Ajusta el nombre del campo según tu base de datos
        $fotoPapa = base64_encode($datosEstudiante['foto_papa']); // Ajusta el nombre del campo según tu base de datos
        $fotoCasoEmergencia = base64_encode($datosEstudiante['foto_emergencia']); // Ajusta el nombre del campo según tu base de datos
    }
    else{
        // No se encontraron resultados
        echo "Error: No se encontró el estudiante con la cédula $cedulaEstudiante.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<style>
    /* Estilos para reducir el tamaño de las imágenes */
    img {
        max-width: 100px;
        /* Ajusta el tamaño máximo al ancho del contenedor */
        height: auto;
        /* Permite que la altura se ajuste proporcionalmente al ancho */
        display: block;
        /* Elimina el espacio adicional debajo de las imágenes */
        margin-bottom: 10px;
        /* Agrega un espacio entre las imágenes */
    }
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title></title>
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/extra-libs/multicheck/multicheck.css">
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="css/formulario.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'includes/navbar.php';
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Finalizar Inscripción</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb"></nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-top"></div>
                    <div class="card">
                        <div class="card-body">
                            <form action="../php/procesar_imagenes.php" method="post" enctype="multipart/form-data">
                                <h2>Formulario de Fotos</h2>
                                <!-- Hidden input fields for storing data -->
                                <input type="hidden" id="cedula_escolar" name="cedula_escolar"
                                    value="<?php echo $cedulaEscolar ?>">
                                <input type="hidden" id="cedula_papa" name="cedula_papa"
                                    value="<?php echo $cedulaPapa ?>">
                                <input type="hidden" id="cedula_mama" name="cedula_mama"
                                    value="<?php echo $cedulaMama ?>">
                                <input type="hidden" id="cedula_representante" name="cedula_representante"
                                    value="<?php echo $cedulaRepresentante ?>">
                                <input type="hidden" id="caso_emergencia" name="caso_emergencia"
                                    value="<?php echo $codigoCasoEmergencia ?>">

                                <!-- Photo sections -->
                                <?php

                                $photoSections = array(
                                    array("Estudiante", "fotoEstudiante"),
                                    array("Representante", "fotoRepresentante"),
                                    array("Mama", "fotoMama"),
                                    array("Papa", "fotoPapa"),
                                );
                                foreach ($photoSections as $section) {
                                    $sectionName = $section[0];
                                    $inputName = $section[1];
                                    $photoVariable = "foto" . $sectionName;

                                    echo "<div style='display: inline-block; margin-right: 20px;'>";
                                    echo "<h5 class='card-title'>Foto de $sectionName</h5>";

                                    if (!empty($$photoVariable)) {
                                        // If the photo exists, display it
                                        echo "<img src='data:image/png;base64," . $$photoVariable . "' alt='Foto de $sectionName' required>";
                                        echo "<input type='hidden' name='$inputName' value='" . $$photoVariable . "' required>";
                                    } else {
                                        // If the photo doesn't exist, provide an input to upload it
                                        echo "<input type='file' name='$inputName' accept='image/*' required>";
                                    }

                                    echo "</div>";
                                }
                                $sectionName = "Caso de Emergencia";
                                $inputName = "fotoCasoEmergencia";

                                echo "<div style='display: inline-block; margin-right: 20px;'>";
                                echo "<h5 class='card-title'>Foto de $sectionName</h5>";

                                if (!empty($fotoCasoEmergencia)) {
                                    // If the photo exists, display it
                                    echo "<img src='data:image/png;base64," . $fotoCasoEmergencia . "' alt='Foto de $sectionName' required>";
                                    echo "<input type='hidden' name='$inputName' value='" . $fotoCasoEmergencia . "' required>";
                                } else {
                                    // If the photo doesn't exist, provide an input to upload it
                                    echo "<input type='file' name='$inputName' accept='image/*' required>";
                                }

                                echo "</div>";
                                ?>
                                <?php
                                // Define the allImagesPresent function
                                function allImagesPresent()
                                {
                                    global $fotoEstudiante, $fotoRepresentante, $fotoMama, $fotoPapa, $fotoCasoEmergencia;

                                    // Check if all image variables are not empty
                                    return !empty($fotoEstudiante) && !empty($fotoRepresentante) && !empty($fotoMama) && !empty($fotoPapa) && !empty($fotoCasoEmergencia);
                                }
                                ?>

                                <!-- Use the allImagesPresent function to conditionally disable the button -->
                                <button class="btn btn-primary" type="submit" <?php echo (allImagesPresent()) ? "disabled" : ""; ?>>
                                    Subir Imágenes
                                </button>
                            </form>
                            <form action="../php/procesar_inscripcion.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="cedula_escolar" name="cedula_escolar"
                                    value="<?php echo $cedulaEscolar ?>">
                                <div style="margin-top: 20px;">
                                    <h2>Selección de Nivel y Período</h2>

                                    <!-- Select para Niveles -->
                                    <div style="display: inline-block; margin-right: 20px;">
                                        <label for="nivel">Selecciona el Nivel/Seccion:</label>
                                        <select class="form-control" id="codigo_nivelseccion" name="codigo_nivelseccion">
                                            <?php
                                            $sentencia = "SELECT a.*, b.*, c.* FROM nivel_seccion a, secciones b, niveles c
                                            where a.codigo_niveles=c.codigo_niveles and b.codigo_seccion=a.codigo_seccion and estado=1";
                                            $buscar = mysqli_query($conexion, $sentencia);
                                            while ($r = mysqli_fetch_array($buscar)) {
                                                $codigo = $r['codigo_nivelseccion'];
                                                $nombre = $r['descripcion'];
                                                $nombre1 = $r['nombre'];
                                                ?>
                                                <option required value="<?php echo $codigo ?>">
                                                    <?php echo $nombre ?>&nbsp;<?php echo $nombre1 ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Select para Períodos -->
                                    <div style="display: inline-block;">
                                        <label for="periodo">Selecciona el Período:</label>
                                        <select class="form-control" id="codigo_periodo" name="codigo_periodo">
                                            <?php
                                            $sentencia = "SELECT * FROM periodo_academico WHERE actual = 1";
                                            $buscar = mysqli_query($conexion, $sentencia);
                                            while ($r = mysqli_fetch_array($buscar)) {
                                                $codigo = $r['codigo_periodo'];
                                                $nombre = ($r['actual'] == '1')? "Periodo Actual" : $r['nombre'];
                                                ?>
                                                <option required value="<?php echo $codigo ?>">
                                                    <?php echo $nombre ?>
                                                </option>
                                                <?php
                                            }
                                            
                                            ?>
                                        </select>
                                    </div>
                                    <input type="text" id="periodo_historico" name="periodo_historico" style="display:none;">

                                    <script>
                                        document.getElementById('periodo_historico').value = <?php echo (!isset($datosEstudiante['periodo'])) ? '2' : $datosEstudiante['periodo'] ?>
                                    </script>

                                </div>
                                <button class="btn btn-primary" type="submit">Procesar Inscripcion</button>
                            </form>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="..//libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
        <script src="../dist/js/waves.js"></script>
        <script src="../dist/js/sidebarmenu.js"></script>
        <script src="../dist/js/custom.min.js"></script>
        <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
        <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
        <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
</body>

</html>