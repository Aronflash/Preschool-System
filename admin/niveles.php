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
    $sentencia = ("SELECT a.*, b.estado AS nom, c.*, d.* 
    FROM niveles a
    JOIN nivel_seccion d ON a.codigo_niveles = d.codigo_niveles
    JOIN estado b ON d.estado = b.codigo_estado
    JOIN secciones c ON c.codigo_seccion = d.codigo_seccion
    ORDER BY d.estado ASC, c.nombre ASC, a.descripcion ASC");
    $mostrar = mysqli_query($conexion, $sentencia);
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Niveles Academicos</h4>
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
                            <a href="acciones/agregar_niveles.php" type="button" class="btn btn-outline-primary" style="display:none;">Agregar
                                Nuevo Nivel</a>
                            <a href="acciones/agregar_nise.php" type="button" class="btn btn-outline-primary">Agregar un
                                Nuevo Nivel/Seccion</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabla de Niveles Academicos/Secciones</h5>
                            <div class="table-responsive">
                                <table   class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nivel</th>
                                            <th>Seccion</th>
                                            <th>Estado</th>                                            
                                            <th>Accion Nivel/Seccion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($r = mysqli_fetch_array($mostrar)) {
                                            $estado = $r['estado'];
                                            $clase_estado = ($estado == 1) ? 'badge badge-success custom-badge' : 'badge badge-danger custom-badge';

                                            if (isset($_GET['error'])) {
                                                $mensaje_error = urldecode($_GET['error']);
                                                echo '<div class="alert alert-danger">' . $mensaje_error . '</div>';
                                            }

                                            $nombreNivel = $r['descripcion'];
                                            $mostrarBotonEditar = ($nombreNivel != 'Grupo C');

                                            ?>
                                            <tr>
                                                <th>
                                                    <?php echo $r['codigo_nivelseccion'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['descripcion'] ?>
                                                </th>
                                                <th>
                                                    <?php echo $r['nombre'] ?>
                                                </th>
                                                <th>
                                                    <span class="<?php echo $clase_estado; ?>">
                                                        <?php echo $r['nom']; ?>
                                                    </span>
                                                </th>
                                                <!-- <th> -->
                                                    <?php
                                                    // if ($mostrarBotonEditar) {
                                                    //     echo "<a class='btn btn-success btn-sm' href='acciones/editar_niveles.php?id=" . $r['codigo_niveles'] . "'><i class='fa fa-edit'></i></a>";
                                                    // }
                                                    ?>
                                                <!-- </th> -->
                                                <th>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#elim<?php echo $r['codigo_nivelseccion']; ?>">Eliminar
                                                        &nbsp;<i class="fa fa-trash"></i></button>
                                                        
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#act<?php echo $r['codigo_nivelseccion']; ?>">Activar
                                                        &nbsp;<i class="fa fa-edit"></i></button>
                                                </th>
                                            </tr>

                                            <?php
                                            include 'modales/eliminar_nivel.php';
                                            include 'modales/activar_nivel.php';
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