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
<style>
    .card {
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        display: none;
        margin-top: 20px;
    }

    .current-section {
        display: block;
    }

    .btn {
        cursor: pointer;
        padding: 10px;
        margin: 10px;
    }

    .form-section form {
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        /* Agregado para distribuir elementos en la misma línea */
    }

    .form-section h2 {
        text-align: center;
        width: 100%;
    }

    .form-section label {
        display: flex;
        margin-bottom: 15px;
        font-weight: bold;
        align-items: center;
        width: calc(48% - 5px);
        /* Ajustado para permitir espacio entre elementos */
        box-sizing: border-box;
    }

    .form-section input,
    .form-section select,
    .form-section textarea {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    .form-section .btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-section .btn:hover {
        background-color: #0056b3;
    }

    @media screen and (max-width: 600px) {
        .form-section label {
            width: 100%;
            margin-right: 0;
        }

        .form-section input,
        .form-section select,
        .form-section textarea {
            width: 100%;
            margin-right: 0;
        }
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
    <link rel="stylesheet" type="text/css" href="../../assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css"
        href="../../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
                    <h4 class="page-title">Editar Estudiantes</h4>
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
                            <a href="../estudiantes.php" type="button" class="btn btn-warning">Regresar</a>
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
                                        $sql = "SELECT * FROM estudiante where cedula_escolar='" . $id . "'";
                                        $resultado = mysqli_query($conexion, $sql);
                                        $r = mysqli_fetch_assoc($resultado);

                                        ?>
                                        <div id="estudiante" class="form-section current-section">
                                            <form action="../../php/editar/estudiante.php" method="post" autocomplete="off"
                                                enctype="multipart/form-data">
                                                <input type="hidden" id="cedula_escolar" name="cedula_escolar"
                                                    value="<?php echo $r['cedula_escolar']; ?>">
                                                <label>Cédula Escolar: <input type="text" id="cedula_escolar"
                                                        name="cedula_escolar" pattern="\d{11}"
                                                        title="Cédula escolar invalida, debe requerir 11 numeros." required
                                                        disabled value="<?php echo $r['cedula_escolar']; ?>"></label>
                                                <label>Apellidos: <input type="text" id="apellidos_estudiante"
                                                        name="apellidos_estudiante" pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+"
                                                        title="Solo letras y espacios permitidos." required minlength="5"
                                                        maxlength="25" value="<?php echo $r['apellidos']; ?>"></label>
                                                <label>Nombres: <input type="text" id="nombres_estudiante"
                                                        name="nombres_estudiante" pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+"
                                                        title="Solo letras y espacios permitidos." required minlength="3"
                                                        maxlength="25" value="<?php echo $r['nombres']; ?>"></label>
                                                <label>Fecha de Nacimiento: <input type="date" id="fecha_estudiante"
                                                        name="fecha_estudiante" max="<?php echo date('d-m-Y'); ?>"
                                                        onchange="calcularEdad()" required
                                                        value="<?php echo $r['fecha_nacimiento']; ?>"></label>
                                                <label>Edad: <input type="text" id="edad_estudiante" pattern="[0-9]{1,3}"
                                                        name="edad_estudiante" title="Ingrese una edad valida." required
                                                        readonly value="<?php echo $r['edad']; ?>"></label>
                                                <label>Lugar de Nacimiento: <input type="text" id="lugar_nacimiento"
                                                        name="lugar_nacimiento" pattern="[A-Za-z0-9-ñÑáéíóúüÁÉÍÓÚÜ ]+"
                                                        title="Solo se permiten letras, números, comas y puntos" required
                                                        minlength="5" maxlength="80"
                                                        value="<?php echo $r['lugar_nacimiento']; ?>"></label>
                                                <label>Estado: <input type="text" id="estado_estudiante"
                                                        name="estado_estudiante" pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+"
                                                        title="Solo letras y espacios permitidos" required maxlength="20"
                                                        value="<?php echo $r['estado']; ?>"></label>
                                                <label>Nacionalidad:
                                                    <?php
                                                    include_once '../../php/conexion.php';

                                                    $p = $r['cedula_escolar'];

                                                    $qtp = "SELECT * FROM nacionalidad";
                                                    $rqtp = mysqli_query($conexion, $qtp);

                                                    $siu = "SELECT * FROM estudiante WHERE cedula_escolar = $p";
                                                    $rsiu = mysqli_query($conexion, $siu);
                                                    $pt = mysqli_fetch_assoc($rsiu);

                                                    $ptp = $pt['codigo_nacionalidad'];
                                                    ?>
                                                    <select id="codigo_nacionalidad" name="codigo_nacionalidad">
                                                        <?php while ($rp = mysqli_fetch_assoc($rqtp)): ?>
                                                            <?php $selected = ($rp['codigo_nacionalidad'] == $ptp) ? 'selected' : ''; ?>
                                                            <option value="<?php echo $rp['codigo_nacionalidad']; ?>" <?php echo $selected; ?>>
                                                                <?php echo $rp['descripcion']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </label>
                                                <label>Procedencia: <input type="text" id="procedencia_estudiante"
                                                        pattern="[A-Za-z0-9 ]+"
                                                        title="Caracteres no permitidos, solo se aceptan letras y numeros."
                                                        name="procedencia_estudiante" required maxlength="50"
                                                        value="<?php echo $r['procedencia']; ?>"></label>
                                                <label>¿Tiene Hermanos?:
                                                    <select id="estado_hermano" name="estado_hermano">
                                                        <option value="Si" <?php echo ($r['estado_hermano'] == 'Si') ? 'selected' : ''; ?>>Sí</option>
                                                        <option value="No" <?php echo ($r['estado_hermano'] == 'No') ? 'selected' : ''; ?>>No</option>
                                                    </select>
                                                </label>
                                                <label>¿Cuántos Hermanos?: <input id="cantidad_hermano"
                                                        name="cantidad_hermano" type="text" pattern="[0-9]+"
                                                        title="Solo números permitidos" required minlength="1" maxlength="2"
                                                        value="<?php echo $r['cantidad_hermano']; ?>"></label>
                                                <label>Sexo:
                                                    <select id="sexo_hermano" name="sexo_hermano">
                                                        <option value="No" <?php echo ($r['sexo_hermano'] == 'No') ? 'selected' : ''; ?>>No</option>
                                                        <option value="V" <?php echo ($r['sexo_hermano'] == 'V') ? 'selected' : ''; ?>>Femenino</option>
                                                        <option value="H" <?php echo ($r['sexo_hermano'] == 'H') ? 'selected' : ''; ?>>Masculino</option>
                                                    </select>
                                                </label>
                                                <label>Lugar entre Hermanos: <input type="text" id="lugar_hermano"
                                                        pattern="[A-Za-z0-9 ]+" title="Caracteres no permitidos" required
                                                        maxlength="20" name="lugar_hermano"
                                                        value="<?php echo $r['lugar_hermano']; ?>">
                                                </label>
                                                <label>Representante Legal:
                                                    <?php
                                                    include_once '../../php/conexion.php';

                                                    $p = $r['cedula_escolar'];

                                                    $qtp = "SELECT * FROM representante_legal";
                                                    $rqtp = mysqli_query($conexion, $qtp);

                                                    $siu = "SELECT * FROM estudiante WHERE cedula_escolar = $p";
                                                    $rsiu = mysqli_query($conexion, $siu);
                                                    $pt = mysqli_fetch_assoc($rsiu);

                                                    $ptp = $pt['cedula_representante'];
                                                    ?>
                                                    <select id="cedula_representante" name="cedula_representante">
                                                        <?php while ($rp = mysqli_fetch_assoc($rqtp)): ?>
                                                            <?php $selected = ($rp['cedula_representante'] == $ptp) ? 'selected' : ''; ?>
                                                            <option value="<?php echo $rp['cedula_representante']; ?>" <?php echo $selected; ?>>
                                                                <?php echo $rp['nombres'] . ' ' . $rp['apellidos']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </label>
                                                <label>Mama:
                                                    <?php
                                                    include_once '../../php/conexion.php';

                                                    $p = $r['cedula_escolar'];

                                                    $qtp = "SELECT * FROM mama";
                                                    $rqtp = mysqli_query($conexion, $qtp);

                                                    $siu = "SELECT * FROM estudiante WHERE cedula_escolar = $p";
                                                    $rsiu = mysqli_query($conexion, $siu);
                                                    $pt = mysqli_fetch_assoc($rsiu);

                                                    $ptp = $pt['cedula_mama'];
                                                    ?>
                                                    <select id="cedula_mama" name="cedula_mama">
                                                        <?php while ($rp = mysqli_fetch_assoc($rqtp)): ?>
                                                            <?php $selected = ($rp['cedula_mama'] == $ptp) ? 'selected' : ''; ?>
                                                            <option value="<?php echo $rp['cedula_mama']; ?>" <?php echo $selected; ?>>
                                                                <?php echo $rp['nombres'] . ' ' . $rp['apellidos']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </label>
                                                <label>Papa:
                                                    <?php
                                                    include_once '../../php/conexion.php';

                                                    $p = $r['cedula_escolar'];

                                                    $qtp = "SELECT * FROM papa";
                                                    $rqtp = mysqli_query($conexion, $qtp);

                                                    $siu = "SELECT * FROM estudiante WHERE cedula_escolar = $p";
                                                    $rsiu = mysqli_query($conexion, $siu);
                                                    $pt = mysqli_fetch_assoc($rsiu);

                                                    $ptp = $pt['cedula_papa'];
                                                    ?>
                                                    <select id="cedula_papa" name="cedula_papa">
                                                        <?php while ($rp = mysqli_fetch_assoc($rqtp)): ?>
                                                            <?php $selected = ($rp['cedula_papa'] == $ptp) ? 'selected' : ''; ?>
                                                            <option value="<?php echo $rp['cedula_papa']; ?>" <?php echo $selected; ?>>
                                                                <?php echo $rp['nombres'] . ' ' . $rp['apellidos']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </label>
                                                <label>Caso Emergencia:
                                                    <?php
                                                    include_once '../../php/conexion.php';

                                                    $p = $r['cedula_escolar'];

                                                    $qtp = "SELECT * FROM caso_emergencia";
                                                    $rqtp = mysqli_query($conexion, $qtp);

                                                    $siu = "SELECT * FROM estudiante WHERE cedula_escolar = $p";
                                                    $rsiu = mysqli_query($conexion, $siu);
                                                    $pt = mysqli_fetch_assoc($rsiu);

                                                    $ptp = $pt['caso_emergencia'];
                                                    ?>
                                                    <select id="caso_emergencia" name="caso_emergencia">
                                                        <?php while ($rp = mysqli_fetch_assoc($rqtp)): ?>
                                                            <?php $selected = ($rp['codigo_emergencia'] == $ptp) ? 'selected' : ''; ?>
                                                            <option value="<?php echo $rp['codigo_emergencia']; ?>" <?php echo $selected; ?>>
                                                                <?php echo $rp['nombre'] ;?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </label>
                                                <button type="submit" class="btn">Siguiente</button>
                                            </form>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function calcularEdad() {
                    // Obtener la fecha actual
                    var fechaActual = new Date();

                    // Obtener la fecha de nacimiento ingresada por el usuario
                    var fechaNacimiento = new Date(document.getElementById('fecha_estudiante').value);

                    // Calcular la diferencia en años
                    var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

                    // Verificar si aún no ha cumplido años este año
                    if (fechaNacimiento.getMonth() > fechaActual.getMonth() ||
                        (fechaNacimiento.getMonth() === fechaActual.getMonth() && fechaNacimiento.getDate() > fechaActual.getDate())) {
                        edad--;
                    }

                    // Establecer el valor calculado en el campo de edad
                    document.getElementById('edad_estudiante').value = edad;
                }</script>
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
            <script src="../../assets/libs/toastr/build/toastr.min.js"></script>
            <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>