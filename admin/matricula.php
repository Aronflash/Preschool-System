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
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

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
    <link rel="stylesheet" href="../assets/libs/sweetAlerts2/sweetalert2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    include 'includes/navbar.php';
    include '../php/conexion.php';
    $sentencia = ("SELECT inscripcion.*, estudiante.nombres AS nombres_estudiante, estudiante.apellidos AS apellidos_estudiante,
    periodo_academico.fecha_inicio, periodo_academico.fecha_fin, niveles.descripcion AS nivel_descripcion, periodo_academico.nombre, secciones.nombre as seccion 
    FROM inscripcion
    INNER JOIN estudiante ON inscripcion.cedula_escolar = estudiante.cedula_escolar
    INNER JOIN periodo_academico ON inscripcion.codigo_periodo = periodo_academico.codigo_periodo
    INNER JOIN nivel_seccion ON inscripcion.codigo_nivelseccion = nivel_seccion.codigo_nivelseccion
    INNER JOIN niveles ON niveles.codigo_niveles=nivel_seccion.codigo_niveles
    INNER JOIN secciones ON secciones.codigo_seccion=nivel_seccion.codigo_seccion
    WHERE periodo_academico.actual = 1;");
    $mostrar = mysqli_query($conexion, $sentencia);
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Matricula</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-top">
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabla de Periodos Academicas</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Codigo Inscripcion</th>
                                            <th>Nombre Estudiante</th>
                                            <th>Apellido Estudiante</th>
                                            <th>Nivel</th>
                                            <th>Seccion</th>
                                            <th>Periodo</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Planilla Inscripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($r = mysqli_fetch_array($mostrar)) {
                                            $nivelDescripcion = $r['nivel_descripcion'];

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $r['codigo_inscripcion'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['nombres_estudiante'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['apellidos_estudiante'] ?>
                                                </td>

                                                <td>
                                                    <?php echo $nivelDescripcion ?>
                                                </td>

                                                <td>
                                                    <?php echo $r['seccion'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['nombre'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['fecha_inicio'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['fecha_fin'] ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?php echo "<a target='_blank' class='btn btn-outline-success btn-sm' style='border-radius:5px;' href='../php/generar_planillainscripcion.php?codigo_inscripcion=".$r['codigo_inscripcion']."'><i class='bi bi-file-earmark-person' style='font-size: 20px;text-align:center;'></i></a>"; ?>
                                                </td>
                                                <td  style="text-align:center;">
                                                    <?php
                                                        $data = array(
                                                            'codigo_inscripcion' => $r['codigo_inscripcion'],
                                                            'cedula_escolar' => $r['cedula_escolar'],
                                                            'nivelDescripcion' => $nivelDescripcion
                                                        );
                                                        echo "<button class='btn btn-outline-success btn-sm' style='border-radius:5px;' onclick='openAlert(".(json_encode($data)).")'><i class='bi bi-file-earmark-pdf' style='font-size: 20px;text-align:center;'></i></button>";
                                                    ?>
                                                </td>
                                            </tr>

                                            <?php
                                            include 'modales/eliminar_nivel.php';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/libs/sweetAlerts2/sweetalert2.min.js"></script>
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
        <script>
            $('#zero_config').DataTable();
        </script>
        <script src="./alertas.js"></script>
</body>

</html>