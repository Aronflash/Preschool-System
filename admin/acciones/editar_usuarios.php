<?php
session_start();

if (!isset($_SESSION['codigo_usuario'])) {
    echo '
    <script>
            alert("Por favor debes iniciar sesión");
            window.location = "../../index.php";
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
    <link rel="stylesheet" type="text/css" href="../../assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/libs/quill/dist/quill.snow.css">
    <link href="../../assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/formulario.css" />
</head>

<body>
    <?php
    include 'includes/navbar.php';
    ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Editar Usuarios</h4>
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
                            <a href="../usuarios.php" type="button" class="btn btn-warning">Regresar</a>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <?php
                                    include '../../php/conexion.php';
                                    if (isset($_POST['enviar'])) {
                                    } else {

                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM usuario where codigo_usuario='" . $id . "'";
                                        $resultado = mysqli_query($conexion, $sql);
                                        $r = mysqli_fetch_assoc($resultado);

                                    ?>
                                        <form class="form-horizontal" action="../../php/editar/editar_usuario.php" method="POST" enctype="multipart/form-data" id="formulario">
                                            <input type="hidden" id="codigo_usuario" name="codigo_usuario" value="<?php echo $r['codigo_usuario']; ?>">
                                            <div class="card-body">
                                                <h4 class="card-title">Usuarios</h4>
                                                <div class="form-group row formulario__grupo" id="grupo__codigo_usuario">

                                                    <label for="codigo_usuario" class="col-sm-3 text-right control-label col-form-label formulario__label">Codigo del Usuario:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="codigo_usuario" name="codigo_usuario" placeholder="" required value="<?php echo $r['codigo_usuario']; ?>" disabled>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">El codigo debe ser de 1 a 5 campos numericos.</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__nombre_usuario">
                                                    <label for="nombre_usuario" class="col-sm-3 text-right control-label col-form-label formulario__label">Nombre:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="" required value="<?php echo $r['nombre_usuario']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras y numeros. (Max 50 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__contrasena">
                                                    <label for="contrasena" class="col-sm-3 text-right control-label col-form-label formulario__label">Contraseña:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="contrasena" name="contrasena" placeholder="" required value="<?php echo $r['contrasena']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras y numeros. (Max 50 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__tipodeusuario">
                                                    <label for="tipodeusuario" class="col-sm-3 text-right control-label col-form-label formulario__label">Tipo de usuario:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <?php
                                                        include_once '../../php/conexion.php';

                                                        $p =  $r['codigo_usuario'];

                                                        $qtp = "SELECT * FROM tipo_de_usuario";
                                                        $rqtp = mysqli_query($conexion, $qtp);

                                                        $siu = "SELECT * FROM usuario WHERE codigo_usuario = $p";
                                                        $rsiu = mysqli_query($conexion, $siu);
                                                        $pt = mysqli_fetch_assoc($rsiu);

                                                        $ptp = $pt['tipodeusuario'];
                                                        ?>
                                                        <select class="form-control" id="tipodeusuario" name="tipodeusuario">
                                                            <?php while ($rp = mysqli_fetch_assoc($rqtp)) : ?>
                                                                <?php $selected = ($rp['codigo_tusuario'] == $ptp) ? 'selected' : ''; ?>
                                                                <option value="<?php echo $rp['codigo_tusuario']; ?>" <?php echo $selected; ?>><?php echo $rp['Tipodeusuario']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        <i class="formulario__validacion-estado fas fa-times-circle" style="margin-right: 25px;"></i>

                                                    </div>
                                                    <p class="formulario__input-error">Debe seleccionar un Tipo de Usuario.</p>
                                                </div><div class="form-group row formulario__grupo" id="grupo__codigo_estado">
                                                    <label for="codigo_estado" class="col-sm-3 text-right control-label col-form-label formulario__label">Estado:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <?php
                                                        include_once '../../php/conexion.php';

                                                        $p =  $r['codigo_usuario'];

                                                        $qtp = "SELECT * FROM estado";
                                                        $rqtp = mysqli_query($conexion, $qtp);

                                                        $siu = "SELECT * FROM usuario WHERE codigo_usuario = $p";
                                                        $rsiu = mysqli_query($conexion, $siu);
                                                        $pt = mysqli_fetch_assoc($rsiu);

                                                        $ptp = $pt['codigo_estado'];
                                                        ?>
                                                        <select class="form-control" id="codigo_estado" name="codigo_estado">
                                                            <?php while ($rp = mysqli_fetch_assoc($rqtp)) : ?>
                                                                <?php $selected = ($rp['codigo_estado'] == $ptp) ? 'selected' : ''; ?>
                                                                <option value="<?php echo $rp['codigo_estado']; ?>" <?php echo $selected; ?>><?php echo $rp['estado']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        <i class="formulario__validacion-estado fas fa-times-circle" style="margin-right: 25px;"></i>

                                                    </div>
                                                    <p class="formulario__input-error">Debe seleccionar un Estado.</p>
                                                </div>
                                            </div>
                                            <div class="border-top">
                                                <div class="card-body">
                                                    <div class="formulario__mensaje" id="formulario__mensaje">
                                                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellene el formulario correctamente. </p>
                                                    </div>
                                                    <br>
                                                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                                                        <button type="submit" class="btn btn-primary" id="enviar">Registrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
            <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
            <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
            <script src="../../dist/js/waves.js"></script>
            <script src="../../dist/js/sidebarmenu.js"></script>
            <script src="../../dist/js/custom.min.js"></script>
            <script src="../../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
            <script src="../../dist/js/pages/mask/mask.init.js"></script>
            <script src="../../assets/libs/select2/dist/js/select2.full.min.js"></script>
            <script src="../../assets/libs/select2/dist/js/select2.min.js"></script>
            <script src="../../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
            <script src="../../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
            <script src="../../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
            <script src="../../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
            <script src="../../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
            <script src="../../assets/libs/quill/dist/quill.min.js"></script>
            <script src="../validaciones/editar_usuario.js"></script>
            <script src="../../assets/libs/toastr/build/toastr.min.js"></script>
            <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>