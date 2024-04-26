<?php
session_start();

if (!isset($_SESSION['codigo_usuario'])) {
    echo '
  <script>
          alert("Por favor debes iniciar sesion");
          window.location = "../index.php";
  </script>
  
  
  ';
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

    <link href="../dist/css/style.min.css" rel="stylesheet">

</head>

<body>
    <?php
    include 'includes/navbar.php';
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Estadisticas</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Column -->
                <?php
                // Incluye el archivo de conexión a la base de datos
                include '../php/conexion.php';

                // Consulta SQL para contar el número de estudiantes
                $sql = "SELECT COUNT(*) as total_estudiantes FROM estudiante";
                $resultado = $conexion->query($sql);

                // Verifica si la consulta fue exitosa
                if ($resultado) {
                    // Obtiene el resultado de la consulta
                    $fila = $resultado->fetch_assoc();
                    $total_estudiantes = $fila['total_estudiantes'];
                } else {
                    // Manejar el error si la consulta falla
                    $total_estudiantes = "Error en la consulta: " . $conexion->error;
                }
                ?>

                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                            <h6 class="text-white">Estudiantes</h6>
                            <h6 class="text-white">
                                <?php echo $total_estudiantes; ?>
                            </h6>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <?php

                // Consulta SQL para contar el número de representantes
                $sql = "SELECT COUNT(*) as total_representantes FROM representante_legal";
                $resultado = $conexion->query($sql);

                // Verifica si la consulta fue exitosa
                if ($resultado) {
                    // Obtiene el resultado de la consulta
                    $fila = $resultado->fetch_assoc();
                    $total_representantes = $fila['total_representantes'];
                } else {
                    // Manejar el error si la consulta falla
                    $total_representantes = "Error en la consulta: " . $conexion->error;
                }
                ?>

                <div class="col-md-6 col-lg-4 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                            <h6 class="text-white">Representantes</h6>
                            <h6 class="text-white">
                                <?php echo $total_representantes; ?>
                            </h6>
                        </div>
                    </div>
                </div>

                <!-- Column -->
                <?php
                // Consulta SQL para contar el número de padres
                $sqlPadres = "SELECT COUNT(*) as total_padres FROM papa";
                $resultadoPadres = $conexion->query($sqlPadres);

                // Verifica si la consulta fue exitosa
                if ($resultadoPadres) {
                    // Obtiene el resultado de la consulta
                    $filaPadres = $resultadoPadres->fetch_assoc();
                    $totalPadres = $filaPadres['total_padres'];
                } else {
                    // Manejar el error si la consulta falla
                    $totalPadres = "Error en la consulta: " . $conexion->error;
                }
                ?>

                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                            <h6 class="text-white">Padres</h6>
                            <h6 class="text-white">
                                <?php echo $totalPadres; ?>
                            </h6>
                        </div>
                    </div>
                </div>

                <!-- Column -->
                <?php
                // Consulta SQL para contar el número de madres
                $sqlMadres = "SELECT COUNT(*) as total_madres FROM mama";
                $resultadoMadres = $conexion->query($sqlMadres);

                // Verifica si la consulta fue exitosa
                if ($resultadoMadres) {
                    // Obtiene el resultado de la consulta
                    $filaMadres = $resultadoMadres->fetch_assoc();
                    $totalMadres = $filaMadres['total_madres'];
                } else {
                    // Manejar el error si la consulta falla
                    $totalMadres = "Error en la consulta: " . $conexion->error;
                }
                ?>

                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                            <h6 class="text-white">Madres</h6>
                            <h6 class="text-white">
                                <?php echo $totalMadres; ?>
                            </h6>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <!-- Column -->
    </div>
    </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../dist/js/waves.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/libs/flot/excanvas.js"></script>
    <script src="../assets/libs/flot/jquery.flot.js"></script>
    <script src="../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../dist/js/pages/chart/chart-page-init.js"></script>

</body>

</html>