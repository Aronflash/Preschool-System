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
?><!DOCTYPE html>
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
                    <h4 class="page-title">Editar Padres</h4>
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
                            <a href="../padres.php" type="button" class="btn btn-warning">Regresar</a>
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
                                        $sql = "SELECT * FROM papa where cedula_papa='" . $id . "'";
                                        $resultado = mysqli_query($conexion, $sql);
                                        $r = mysqli_fetch_assoc($resultado);

                                    ?>
                                        <form class="form-horizontal" action="../../php/editar/editar_padres.php" method="POST" enctype="multipart/form-data" id="formulario">
                                            <input type="hidden" id="cedula_papa" name="cedula_papa" value="<?php echo $r['cedula_papa']; ?>">
                                            <div class="card-body">
                                                <div class="form-group row formulario__grupo" id="grupo__cedula_papa">
                                                    <label for="cedula_papa" class="col-sm-3 text-right control-label col-form-label formulario__label">Cedula:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="cedula_papa" name="cedula_papa" placeholder="" required value="<?php echo $r['cedula_papa']; ?>" disabled>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">La cedula del papa debe ser de 7 u 8 campos numericos.</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__nombres">
                                                    <label for="nombres" class="col-sm-3 text-right control-label col-form-label formulario__label">Nombres:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Juan" required value="<?php echo $r['nombres']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras. (Max 20 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__apellidos">
                                                    <label for="apellidos" class="col-sm-3 text-right control-label col-form-label formulario__label">Apellidos:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="" required value="<?php echo $r['apellidos']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras. (Max 30 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__codigo_estadocivil">
                                                    <label for="codigo_estadocivil" class="col-sm-3 text-right control-label col-form-label formulario__label">Estado Civil:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <?php
                                                        include_once '../../php/conexion.php';

                                                        $p =  $r['cedula_papa'];

                                                        $qtp = "SELECT * FROM estado_civil";
                                                        $rqtp = mysqli_query($conexion, $qtp);

                                                        $siu = "SELECT * FROM papa WHERE cedula_papa = $p";
                                                        $rsiu = mysqli_query($conexion, $siu);
                                                        $pt = mysqli_fetch_assoc($rsiu);

                                                        $ptp = $pt['codigo_estadocivil'];
                                                        ?>
                                                        <select class="form-control" id="codigo_estadocivil" name="codigo_estadocivil">
                                                            <?php while ($rp = mysqli_fetch_assoc($rqtp)) : ?>
                                                                <?php $selected = ($rp['codigo_estadocivil'] == $ptp) ? 'selected' : ''; ?>
                                                                <option value="<?php echo $rp['codigo_estadocivil']; ?>" <?php echo $selected; ?>><?php echo $rp['descripcion']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error">Debe seleccionar un estado civil.</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__codigo_nacionalidad">
                                                    <label for="codigo_nacionalidad" class="col-sm-3 text-right control-label col-form-label formulario__label">Nacionalidad:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <?php
                                                        include_once '../../php/conexion.php';

                                                        $p =  $r['cedula_papa'];

                                                        $qtp = "SELECT * FROM nacionalidad";
                                                        $rqtp = mysqli_query($conexion, $qtp);

                                                        $siu = "SELECT * FROM papa WHERE cedula_papa = $p";
                                                        $rsiu = mysqli_query($conexion, $siu);
                                                        $pt = mysqli_fetch_assoc($rsiu);

                                                        $ptp = $pt['codigo_nacionalidad'];
                                                        ?>
                                                        <select class="form-control" id="codigo_nacionalidad" name="codigo_nacionalidad">
                                                            <?php while ($rp = mysqli_fetch_assoc($rqtp)) : ?>
                                                                <?php $selected = ($rp['codigo_nacionalidad'] == $ptp) ? 'selected' : ''; ?>
                                                                <option value="<?php echo $rp['codigo_nacionalidad']; ?>" <?php echo $selected; ?>><?php echo $rp['descripcion']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error">Debe seleccionar una nacionalidad.</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__codigo_nivelacademico">
                                                    <label for="codigo_nivelacademico" class="col-sm-3 text-right control-label col-form-label formulario__label">Nivel Academico:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <?php
                                                        include_once '../../php/conexion.php';

                                                        $p =  $r['cedula_papa'];

                                                        $qtp = "SELECT * FROM nivel_academico";
                                                        $rqtp = mysqli_query($conexion, $qtp);

                                                        $siu = "SELECT * FROM papa WHERE cedula_papa = $p";
                                                        $rsiu = mysqli_query($conexion, $siu);
                                                        $pt = mysqli_fetch_assoc($rsiu);

                                                        $ptp = $pt['codigo_nivelacademico'];
                                                        ?>
                                                        <select class="form-control" id="codigo_nivelacademico" name="codigo_nivelacademico">
                                                            <?php while ($rp = mysqli_fetch_assoc($rqtp)) : ?>
                                                                <?php $selected = ($rp['codigo_nivelacademico'] == $ptp) ? 'selected' : ''; ?>
                                                                <option value="<?php echo $rp['codigo_nivelacademico']; ?>" <?php echo $selected; ?>><?php echo $rp['descripcion']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error">Debe seleccionar un nivel academico.</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__edad">
                                                    <label for="edad" class="col-sm-3 text-right control-label col-form-label formulario__label">Edad:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="edad" name="edad" placeholder="xxx" required value="<?php echo $r['edad']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan numeros. (Max 3 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__direccion_habitacion">
                                                    <label for="direccion_habitacion" class="col-sm-3 text-right control-label col-form-label formulario__label">Direccion de Habitacion:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <textarea class="form-control" id="direccion_habitacion" name="direccion_habitacion" placeholder="" required><?php echo $r['direccion_habitacion']; ?></textarea>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras, numeros, y caracteres especiales. (Max 80 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__telefono_habitacion">
                                                    <label for="telefono_habitacion" class="col-sm-3 text-right control-label col-form-label formulario__label">Telefono de Habitacion:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" required value="<?php echo $r['telefono_habitacion']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan numeros. (Max 11 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__direccion_trabajo">
                                                    <label for="direccion_trabajo" class="col-sm-3 text-right control-label col-form-label formulario__label">Direccion de Trabajo:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <textarea class="form-control" id="direccion_trabajo" name="direccion_trabajo" placeholder="" required><?php echo $r['direccion_trabajo']; ?></textarea>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras, numeros y caracteres especiales. (Max 80 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__telefono_trabajo">
                                                    <label for="telefono_trabajo" class="col-sm-3 text-right control-label col-form-label formulario__label">Telefono de Trabajo:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" required value="<?php echo $r['telefono_trabajo']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan numeros. (Max 11 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__ocupacion">
                                                    <label for="ocupacion" class="col-sm-3 text-right control-label col-form-label formulario__label">Ocupacion:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="ocupacion" name="ocupacion" placeholder="" required value="<?php echo $r['ocupacion']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras, numeros y caracteres especiales. (Max 50 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__profesion">
                                                    <label for="profesion" class="col-sm-3 text-right control-label col-form-label formulario__label">Profesion:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="text" class="form-control" id="profesion" name="profesion" placeholder="" required value="<?php echo $r['profesion']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras, numeros y caracteres especiales. (Max 50 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__correo">
                                                    <label for="correo" class="col-sm-3 text-right control-label col-form-label formulario__label">Correo:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <input type="email" class="form-control" id="correo" name="correo" placeholder="" required value="<?php echo $r['correo']; ?>">
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras, numeros y caracteres especiales y debe ingresar un correo electronico. (Max 50 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__datos_extras">
                                                    <label for="datos_extras" class="col-sm-3 text-right control-label col-form-label formulario__label">Datos extras:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <textarea type="text" class="form-control" id="datos_extras" name="datos_extras" placeholder="" required><?php echo $r['datos_extras']; ?></textarea>
                                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                                    </div>
                                                    <p class="formulario__input-error ">Solo se aceptan letras, numeros y caracteres especiales. (Max 100 caracteres)</p>
                                                </div>
                                                <div class="form-group row formulario__grupo" id="grupo__codigo_estado">
                                                    <label for="codigo_estado" class="col-sm-3 text-right control-label col-form-label formulario__label">Estado:</label>
                                                    <div class="col-sm-9 formulario__grupo-input">
                                                        <?php
                                                        include_once '../../php/conexion.php';

                                                        $p =  $r['cedula_papa'];

                                                        $qtp = "SELECT * FROM estado";
                                                        $rqtp = mysqli_query($conexion, $qtp);

                                                        $siu = "SELECT * FROM papa WHERE cedula_papa = $p";
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
                                    }
                                    ?>
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
            <script src="../validaciones/editar_padre.js"></script>
            <script src="../../assets/libs/toastr/build/toastr.min.js"></script>
            <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>