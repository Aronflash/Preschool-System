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
</head>

<body>
    <?php
    include 'includes/navbar.php';
    include '../php/conexion.php';
    $sentencia = "SELECT
    e.*,
    rl.nombres as nombre_representante,
    rl.apellidos as apellido_representante,
    m.nombres as nombre_mama,
    m.apellidos as apellido_mama,
    p.nombres as nombre_papa,
    p.apellidos as apellido_papa,
    ce.nombre as nombre_caso_emergencia,
    n.descripcion as nacionalidad
    FROM v_estudiantesactivos e
    LEFT JOIN representante_legal rl ON e.cedula_representante = rl.cedula_representante
    LEFT JOIN mama m ON e.cedula_mama = m.cedula_mama
    LEFT JOIN papa p ON e.cedula_papa = p.cedula_papa
    LEFT JOIN caso_emergencia ce ON e.caso_emergencia = ce.codigo_emergencia
    LEFT JOIN nacionalidad n ON e.codigo_nacionalidad = n.codigo_nacionalidad";
    $mostrar = mysqli_query($conexion, $sentencia);
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Estudiantes</h4>
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabla de Estudiantes</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cedula Escolar</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Edad</th>
                                            <th>Datos de Nacimiento</th>
                                            <th>Datos Familiares</th>
                                            <th>Datos Extras</th>
                                            <th>Foto</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($r = mysqli_fetch_array($mostrar)) {

                                            ?>

                                            <tr>
                                                <th>
                                                    <?php echo $r['cedula_escolar'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['nombres'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['apellidos'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['edad'] ?>
                                                </th>
                                                <th><button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                        data-target="#datosn<?php echo $r['cedula_escolar']; ?>">Ver
                                                        datos</button></th>
                                                <th><button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                        data-target="#fami<?php echo $r['cedula_escolar']; ?>">Ver
                                                        datos</button></th>
                                                <th><button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                        data-target="#herm<?php echo $r['cedula_escolar']; ?>">Ver
                                                        Datos</button></th>
                                                <th><button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                        data-target="#foto<?php echo $r['cedula_escolar']; ?>">Ver
                                                        Foto</button>
                                                </th>
                                                <th class="<?php echo 'estado-' . $r['estado']; ?>">
                                                    <?php
                                                    // Mostrar el estado según el valor del campo "estado"
                                                    switch ($r['estado_estudiante']) {
                                                        case 1:
                                                            echo 'Estudiante Regular';
                                                            break;
                                                        case 2:
                                                            echo 'Estudiante en el último curso';
                                                            break;
                                                        case 3:
                                                            echo 'Estudiante Graduado';
                                                            break;
                                                        default:
                                                            echo 'Estado Desconocido';
                                                    }
                                                    ?>
                                                </th>
                                                <th>
                                                    <?php echo "<a class='btn btn-success btn-sm'href='acciones/editar_estudiantes.php?id=" . $r['cedula_escolar'] . "'><i class='fa fa-edit'></i></a>"; ?>

                                                </th>
                                            </tr>

                                            <?php
                                            include 'modales/estudiante/vernacimiento.php';
                                            include 'modales/estudiante/familiares.php';
                                            include 'modales/estudiante/hermano.php';
                                            include 'modales/estudiante/foto.php';
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
        <script>
            $('#zero_config').DataTable();
        </script>
</body>

</html>