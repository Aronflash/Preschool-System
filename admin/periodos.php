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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="css/formulario.css" rel="stylesheet">
    <link rel="stylesheet" href="css/periodo_actual.css">
    <link rel="stylesheet" href="../assets/libs/sweetAlerts2/sweetalert2.css">
</head>

<body>
    <?php
    include 'includes/navbar.php';
    include '../php/conexion.php';
    $sentencia = ("SELECT * FROM periodo_academico");
    $mostrar = mysqli_query($conexion, $sentencia);
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Periodos Académicos</h4>
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
                        <div class="card-body">
                            <a href="acciones/agregar_periodos.php" type="button" class="btn btn-outline-primary">Agregar Nuevo Periodo</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabla de Periodos Academicas</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table">
                                        <?php

                                        while ($r = mysqli_fetch_array($mostrar)) {

                                        ?>
                                            <tr <?php echo $r['actual'] == 1 ? "id='periodo_actual'" : ""; ?>>
                                                <th><?php echo $r['codigo_periodo'] ?></th>
                                                <th><?php echo $r['nombre'] ?></th>
                                                <th><?php echo $r['fecha_inicio'] ?></th>
                                                <th><?php echo $r['fecha_fin'] ?></th>
                                                <th><?php echo "<a class='btn btn-success btn-sm'href='acciones/editar_periodo.php?id=" . $r['codigo_periodo'] . "'><i class='fa fa-edit'></i></a>";
                                                echo "<a class='btn btn-success btn-sm' style='margin-left:5px;'"; 
                                                echo ($r['actual'] == 0)? "onclick='set_periodo(" . $r['codigo_periodo'] . ")'": "";
                                                echo "><i class='bi bi-bookmark-check-fill'></i></a>"; ?>
                                                </th>
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
        <script src="./js/periodo.js"></script>
        <script>
            $('#zero_config').DataTable();
        </script>
        <script src="../assets/libs/sweetAlerts2/sweetalert2.min.js"></script>
</body>

</html>