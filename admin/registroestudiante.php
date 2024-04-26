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


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../assets/libs/select2/dist/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/libs/jquery-minicolors/jquery.minicolors.css">
  <link rel="stylesheet" type="text/css"
    href="../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/libs/quill/dist/quill.snow.css">
  <link href="../assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
  <link href="../dist/css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/formulario.css" />
  <link rel="stylesheet" href="../assets/libs/sweetAlerts2/sweetalert2.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
  <?php
  include 'includes/navbar.php';
  ?>
  <div class="page-wrapper">
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <h4 class="page-title">Registro de Inscripcion</h4>
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
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                  <!-- Estudiante -->
                  <div id="estudiante" class="form-section current-section">
                    <h2>DATOS ESTUDIANTE</h2><br>
                    <form autocomplete="off" enctype="multipart/form-data">
                      <label>Cédula Escolar: <input type="text" id="cedula_escolar" name="cedula_escolar" 
                      minlength="11" maxlength="11" pattern="\d{11}" title="Cédula escolar invalida, debe requerir 11 numeros." required></label>
                      <label>Apellidos: <input type="text" id="apellidos_estudiante" name="apellidos_estudiante"
                          pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+" title="Solo letras y espacios permitidos."
                          minlength="5" maxlength="35" required></label>
                      <label>Nombres: <input type="text" id="nombres_estudiante" name="nombres_estudiante"
                          pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+" title="Solo letras y espacios permitidos."
                          minlength="3" maxlength="35" required></label>
                      <label>Fecha de Nacimiento: <input type="date" id="fecha_estudiante" name="fecha_estudiante"
                          max="<?php echo date('d-m-Y'); ?>" required></label>
                      <label>Lugar de Nacimiento: <input type="text" id="lugar_nacimiento" name="lugar_nacimiento"
                          pattern="[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ, .]+" title="Solo se permiten letras, números, comas y puntos"
                          minlength="5" maxlength="80" required></label>
                      <label>Estado: <input type="text" id="estado_estudiante" name="estado_estudiante"
                          pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+" title="Solo letras y espacios permitidos"required
                          maxlength="20"></label>
                      <label>Nacionalidad:
                        <select id="nacionalidad_estudiante" name="nacionalidad_estudiante" required>
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM nacionalidad";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_nacionalidad'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Procedencia: <select id="procedencia_estudiante" required
                        name="procedencia_estudiante">
                        <option value="0">Hogar</option>
                        <option value="1">Del mismo plantel</option>
                        <option value="2">Otro Plantel</option>
                      </select>
                      <script>
                        const selectProcedencia = document.getElementById("procedencia_estudiante");
                        selectProcedencia.addEventListener('change', ()=> {
                          if(selectProcedencia.value == '2'){
                            document.getElementById('otroPlantel').disabled = false;
                          }
                          else{
                            document.getElementById('otroPlantel').disabled = true;
                          }
                        })
                      </script>
                      </label>
                      <label>Plantel: <input type="text" id="otroPlantel" pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+
                        title="Caracter no permitido. Solo se permiten numeros, letras, comas, puntos, entre otros." required
                        name="otroPlantel" maxlength="40" disabled>
                      </label>
                      <label>¿Tiene Hermanos?:
                        <select id="estado_hermano" name="estado_hermano" onchange="toggleCamposHermanos()">
                          <option value="Si">Sí</option>
                          <option value="No">No</option>
                        </select>
                      </label>
                      <label>¿Cuántos Hermanos?: <input id="cantidad_hermano" name="cantidad_hermano" type="text"
                          pattern="[0-9]+" title="Solo números permitidos" minlength="1" maxlength="2"
                          value=0></label>

                      <label>Lugar entre Hermanos: <input type="text" id="lugar_hermano" pattern="[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ]+"
                          title="Caracteres no permitidos" maxlength="10" name="lugar_hermano"
                          value=" "></label>
                      <script>
                        function toggleCamposHermanos() {
                          var estadoHermano = document.getElementById("estado_hermano").value;
                          var cantidadHermano = document.getElementById("cantidad_hermano");
                          var lugarHermano = document.getElementById("lugar_hermano");

                          if (estadoHermano === "No") {
                            cantidadHermano.disabled = true;
                            lugarHermano.disabled = true;
                          } else {
                            cantidadHermano.disabled = false;
                            lugarHermano.disabled = false;
                          }
                        }
                      </script>
                    </form>
                    <button id="originalBtn" class="btn"
                      onclick="validateAndShowSection('antecedentes', 'estudiante')">Siguiente</button>
                    <button id="redirigirBtn" class="btn" style="display:none;">Ir a inscripción</button>
                  </div>

                  <!-- Antecedentes Prenatales -->
                  <div id="antecedentes" class="form-section">
                    <h2>Antecedentes Paranetales</h2><br>
                    <form>
                      <label>¿Qué enfermedad ha padecido?: <input type="text" id="enfermedad" name="enfermedad"
                          pattern="[A-Za-z0-9,.ñÑáéíóúüÁÉÍÓÚÜ ]+" title="Solo se permiten letras, números, comas y puntos"
                          maxlength="50" required></label>
                      <label>¿Ha estado el niño hospitalizado?: <select id="hospitalizado" name="hospitalizado" required>
                          <option value="0">No</option>
                          <option value="1">Sí</option>
                        </select></label>
                      <label>Motivo de hospitalizacion: <input id="motivoHospitalizacion"
                        disabled type="text" pattern="[A-Za-z0-9,.ñÑáéíóúüÁÉÍÓÚÜ ]+"
                        title="Solo se permiten letras, números, comas y puntos" maxlength="40"
                        name="motivoHospitalizacion" required></label>
                        <label>¿Presenta alguna alergia a medicamento, polvo, compuesto alimenticio?: <select id="presentaAlergia" name="presentaAlergia" required>
                        <option value="0">No</option>
                          <option value="1">Sí</option>
                        </select></label>
                      <label>¿A qué presenta alergia?: <input id="alergias" disabled
                         type="text" pattern="[A-Za-z0-9,.ñÑáéíóúüÁÉÍÓÚÜ ]+"
                          title="Solo se permiten letras, números, comas y puntos" maxlength="30"
                          name="alergias" required></label>
                      <label>¿Padece alguna condición:?: <select id="padeceCondicion" name="padeceCondicion" required>
                      <option value="0">No</option>
                      <option value="1">Sí</option>
                      </select></label>
                      <label>¿Qué condición?: <input id="condicion" type="text" pattern="[A-Za-z0-9,.ñÑáéíóúüÁÉÍÓÚÜ ]+"
                          title="Solo se permiten letras, números, comas y puntos" maxlength="30" disabled required
                          name="condicion"></label>
                      <label>Presentó informe: 
                        <select id="informe" name="informe" required>
                          <option value="0">No</option>
                          <option value="1">Sí</option>
                        </select>
                      </label>
                      <label>Padece alguna limitación de algun tipo: <select id="limitacion" type="text"
                          pattern="[A-Za-z0-9,.ñÑáéíóúüÁÉÍÓÚÜ ]+" title="Solo se permiten letras, números, comas y puntos"
                          maxlength="50" name="limitacion" required>
                          <option value="null">Ninguna</option>
                          <option value="1">Motora</option>
                          <option value="2">de Crecimiento</option>
                          <option value="3">Auditiva</option>
                          <option value="4">Visual</option>
                        </select></label>
                      <label>¿Es atendido(a) por especialista?: <select id="especialista"
                         name="especialista" required>
                          <option value="0">No</option>
                          <option value="1">Si</option>
                        </select></label>
                      <label>Datos del Dr.: <input id="doctor" type="text" pattern="[A-Za-z0-9,.ñÑáéíóúüÁÉÍÓÚÜ ]+"disabled
                          title="Solo se permiten letras, números, comas y puntos" maxlength="50" required
                          name="doctor"></label>
                      <label>¿Tiene tendencia a enfermarse con facilidad?:
                        <select id="enfermar_facilidad" name="enfermar_facilidad" required>
                        <option value="0">No</option>
                          <option value="1">Sí</option>
                        </select>
                      </label>
                    </form>
                    <script>
                      const hospitalizadoInput = document.getElementById("hospitalizado");
                      const motivoHospitalizacionInput = document.getElementById("motivoHospitalizacion");
                      const presentaAlergiasInput = document.getElementById("presentaAlergia");
                      const alergiasInput = document.getElementById("alergias");
                      const presentaCondicionInput = document.getElementById("padeceCondicion");
                      const condicionInput = document.getElementById("condicion");
                      const especialistaInput = document.getElementById("especialista");
                      const doctorInput = document.getElementById("doctor");

                      changeInput(hospitalizadoInput, motivoHospitalizacionInput);
                      changeInput(presentaAlergiasInput, alergiasInput);
                      changeInput(presentaCondicionInput, condicionInput);
                      changeInput(especialistaInput, doctorInput)

                      function changeInput(select, detalles){
                        select.addEventListener('change', ()=>{
                        detalles.disabled = (detalles.disabled)? false: true;
                      });
                      }
                    </script>
                    <button class="btn" onclick="validateAndShowSection('estudiante', 'antecedentes')">Atrás</button>
                    <button class="btn"
                      onclick="validateAndShowSection('representante', 'antecedentes')">Siguiente</button>
                  </div>

                  <!-- Representante Legal -->
                  <div id="representante" class="form-section">
                    <h2>Datos del Representante Legal</h2><br>
                    <form enctype="multipart/form-data">
                      <label>Cédula: <input type="text" id="cedula_representante" pattern="\d{7,9}" required
                          title="Cédula inválida (debe tener entre 7 y 9 dígitos)" name="cedula_representante"></label>
                          <label>Nacionalidad:
                        <select id="nacionalidad_representante" name="nacionalidad_representante" required>
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM nacionalidad";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_nacionalidad'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Apellidos: <input type="text" id="apellidos_representante"
                          pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+" required title="Solo letras y espacios permitidos"
                          minlength="5" maxlength="25" name="apellidos_representante"></label>
                      <label>Nombres: <input type="text" id="nombres_representante" pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+"
                          required title="Solo letras y espacios permitidos" maxlength="20" minlength="3"
                          name="nombres_representante"></label>
                      <label>Teléfono: <input type="text" id="telefono_representante" pattern="[0-9]{11}" required
                          title="Teléfono inválido, debe contener 11 dígitos numéricos"
                          name="telefono_representante"></label>
                      <label>Parentesco:
                        <select id="codigo_parentesco" name="codigo_parentesco">
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM parentesco";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_parentesco'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                    </form>
                    <button class="btn" onclick="validateAndShowSection('antecedentes', 'representante')">Atrás</button>
                    <button class="btn" onclick="validateAndShowSection('madre', 'representante')">Siguiente</button>
                  </div>

                  <!-- Datos de la Madre -->
                  <div id="madre" class="form-section">
                    <h2>Datos de la Madre</h2><br>
                    <form enctype="multipart/form-data">
                      <label>Cédula: <input type="text" id="cedula_mama" pattern="\d{7,9}" required
                          title="Cédula inválida (debe tener entre 7 y 9 dígitos)" name="cedula_mama"></label>
                      <label>Apellidos: <input type="text" id="apellidos_mama" pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+"
                          required title="Solo letras y espacios permitidos" maxlength="25" minlength="5"
                          name="apellidos_mama"></label>
                      <label>Nombres: <input type="text" id="nombres_mama" pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+" required
                          title="Solo letras y espacios permitidos" minlength="3" maxlength="20"
                          name="nombres_mama"></label>
                      <label>Estado Civil:
                        <select id="codigo_civilmama" name="codigo_civilmama">
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM estado_civil";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_estadocivil'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Nacionalidad:
                        <select id="nacionalidad_mama" name="nacionalidad_mama">
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM nacionalidad";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_nacionalidad'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Fecha de Nacimiento: <input type="date" id="fecha_mama" name="fecha_mama"
                          max="<?php echo date('d-m-Y'); ?>"required></label>
                      <label>Teléfono: <input type="text" id="telefono_mama" pattern="[0-9]{11}" required
                        title="Teléfono inválido, debe contener 11 dígitos numéricos"
                        name="telefono_mama"></label>
                      <label>Dirección de Habitación: <textarea id="direccionh_mama" required maxlength="55"
                          name="direccionh_mama"></textarea></label>
                      <label>Teléfono de Habitación: <input type="text" id="telefonoh_mama" required pattern="[0-9]{11}"
                          title="Teléfono inválido, debe contener 11 dígitos numéricos" name="telefonoh_mama"></label>
                      <label>Dirección de Trabajo: <textarea id="direcciont_mama" required maxlength="55"
                          name="direcciont_mama"></textarea></label>
                      <label>Teléfono de Trabajo: <input type="text" id="telefonot_mama" required pattern="[0-9]{11}"
                          title="Teléfono inválido, debe contener 11 dígitos numéricos" name="telefonot_mama"></label>
                      <label>Nivel Académico:
                        <select id="nivel_mama" name="nivel_mama">
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM nivel_academico";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_nivelacademico'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Ocupación: <input type="text" id="ocupacion_mama" required pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+"
                          title="Caracteres no permitidos" maxlength="30" name="ocupacion_mama"></label>
                      <label>Profesión: <input type="text" id="profesion_mama" required pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+"
                          title="Caracteres no permitidos" maxlength="25" name="profesion_mama"></label>
                      <label>Correo Electrónico: <input type="email" id="correo_mama" required
                          title="Correo electrónico inválido" maxlength="50" name="correo_mama"></label>
                      <label>Datos Extras: <input type="text" id="datos_mama" required pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+"
                          title="Caracteres no permitidos" maxlength="47" name="datos_mama"></label>
                    </form>
                    <button class="btn" onclick="validateAndShowSection('representante', 'madre')">Atrás</button>
                    <button class="btn" onclick="validateAndShowSection('padre', 'madre')">Siguiente</button>
                  </div>
                  <!-- Datos del Padre -->
                  <div id="padre" class="form-section">
                    <h2>Datos del Padre</h2><br>
                    <form enctype="multipart/form-data">
                      <label>Cédula: <input type="text" pattern="\d{7,9}" required
                          title="Cédula inválida (debe tener entre 7 y 9 dígitos)" name="cedula_papa"
                          id="cedula_papa"></label>
                      <label>Apellidos: <input type="text" required pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+"
                          title="Solo letras y espacios permitidos" minlength="5" maxlength="25" name="apellidos_papa"
                          id="apellidos_papa"></label>
                      <label>Nombres: <input type="text" required pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+"
                          title="Solo letras y espacios permitidos" minlength="3" maxlength="25" name="nombres_papa"
                          id="nombres_papa"></label>
                      <label>Estado Civil:
                        <select id="estado_papa" name="estado_papa">
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM estado_civil";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_estadocivil'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Nacionalidad:
                        <select id="nacionalidad_papa" name="nacionalidad_papa">
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM nacionalidad";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_nacionalidad'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Fecha de Nacimiento: <input type="date" id="fecha_papa" name="fecha_papa"
                          max="<?php echo date('d-m-Y'); ?>"required></label>
                      <label>Teléfono: <input type="text" id="telefono_papa" pattern="[0-9]{11}" required
                        title="Teléfono inválido, debe contener 11 dígitos numéricos"
                        name="telefono_papa"></label>
                      <label>Dirección de Habitación: <textarea required maxlength="55" name="direccionh_papa"
                          id="direccionh_papa"></textarea></label>
                      <label>Teléfono de Habitación: <input required type="text" pattern="[0-9]{11}"
                          title="Teléfono inválido, debe contener 11 dígitos numéricos" name="telefonoh_papa"
                          id="telefonoh_papa"></label>
                      <label>Dirección de Trabajo: <textarea required maxlength="55" name="direcciont_papa"
                          id="direcciont_papa"></textarea></label>
                      <label>Teléfono de Trabajo: <input required type="text" pattern="[0-9]{11}"
                          title="Teléfono inválido, debe contener 11 dígitos numéricos" name="telefonot_papa"
                          id="telefonot_papa"></label>
                      <label>Nivel Académico:
                        <select id="nivel_papa" name="nivel_papa">
                          <?php
                          include_once '../php/conexion.php';
                          $sentencia = "SELECT * FROM nivel_academico";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_nivelacademico'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                      <label>Ocupación: <input type="text" required pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+"
                          title="Caracteres no permitidos" maxlength="30" name="ocupacion_papa"
                          id="ocupacion_papa"></label>
                      <label>Profesión: <input type="text" required pattern="^[A-Za-z0-9ñÑáéíóúüÁÉÍÓÚÜ ,.-]+"
                          title="Caracteres no permitidos" maxlength="30" name="profesion_papa"
                          id="profesion_papa"></label>
                      <label>Correo Electrónico: <input required type="email" title="Correo electrónico inválido"
                          maxlength="50" name="correo_papa" id="correo_papa"></label>
                      <label>Datos Extras: <input required type="text" pattern="[A-Za-z0-9 ]+"
                          title="Caracteres no permitidos" maxlength="47" name="datos_papa" id="datos_papa"></label>
                      <h2>Persona Autorizada para Retirar en Caso de Emergencia</h2><br>

                      <label>Nombre: <input type="text" required pattern="[A-Za-zñÑáéíóúüÁÉÍÓÚÜ ]+"
                          title="Solo letras y espacios permitidos" minlength="3" maxlength="30" name="nombre_caso"
                          id="nombre_caso"></label>
                      <label>Parentesco:
                        <select id="parentesco_emergencia" name="parentesco_emergencia">
                          <?php
                          $sentencia = "SELECT * FROM parentesco";
                          $buscar = mysqli_query($conexion, $sentencia);
                          while ($r = mysqli_fetch_array($buscar)) {
                            $codigo = $r['codigo_parentesco'];
                            $nombre = $r['descripcion'];
                            ?>
                            <option required value="<?php echo $codigo ?>">
                              <?php echo $nombre ?>
                            </option>
                            <?php
                          }
                          ?>
                        </select>
                      </label>
                    </form>
                    <button class="btn" onclick="validateAndShowSection('madre', 'padre')">Atrás</button>
                    <button class="btn" onclick="validateAndShowSection('emergencia', 'padre')">Siguiente</button>
                  </div>
                  <!-- Persona Autorizada para Retirar en Caso de Emergencia -->
                  <div id="emergencia" class="form-section">
                    <form>
                    </form>
                    <button class="btn" onclick="validateAndShowSection('padre', 'emergencia')">Atrás para
                      verificaciones.</button>
                    <button class="btn" onclick="completeForm()">Completar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>

        function showSection(sectionId) {
          var sections = document.getElementsByClassName('form-section');
          for (var i = 0; i < sections.length; i++) {
            sections[i].classList.remove('current-section');
          }
          document.getElementById(sectionId).classList.add('current-section');
        }

        function validateAndShowSection(nextSection, currentSection) {
          var form = document.getElementById(currentSection).querySelector('form');
          if (form.reportValidity()) {
            showSection(nextSection);
          }
        }
        function completeForm() {
          // Obtener los valores de los campos del estudiante
      
          var cedulaEstudiante = document.getElementById('cedula_escolar').value;
          var apellidosEstudiante = document.getElementById('apellidos_estudiante').value;
          var nombresEstudiante = document.getElementById('nombres_estudiante').value;
          var fechaEstudiante = document.getElementById('fecha_estudiante').value;
          var lugarNacimiento = document.getElementById('lugar_nacimiento').value;
          var estadoEstudiante = document.getElementById('estado_estudiante').value;
          var nacionalidadEstudiante = document.getElementById('nacionalidad_estudiante').value;
          var procedenciaEstudiante = document.getElementById('procedencia_estudiante').value;
          if(procedenciaEstudiante == 2){
            procedenciaEstudiante = document.getElementById('otroPlantel').value;
          }
          var estadoHermano = document.getElementById('estado_hermano').value;
          var cantidadHermano = document.getElementById('cantidad_hermano').value;
          var lugarHermano = document.getElementById('lugar_hermano').value;

          // Obtener los valores de los campos de antecedentes prenatales
          var enfermedad = document.getElementById('enfermedad').value;
          var hospitalizado = document.getElementById('hospitalizado').value;
          var motivoHospitalizacion =document.getElementById('motivoHospitalizacion').value;
          var presentaAlergia = document.getElementById('presentaAlergia').value;
          var alergias = document.getElementById('alergias').value;
          var padeceCondicion = document.getElementById('padeceCondicion').value;
          var condicion = document.getElementById('condicion').value;
          var informe = document.getElementById('informe').value;
          var limitacion = document.getElementById('limitacion').value;
          var especialista = document.getElementById('especialista').value;
          var doctor = document.getElementById('doctor').value;
          var enfermarFacilidad = document.getElementById('enfermar_facilidad').value;

          // Obtener los valores de los campos del representante legal
          var cedulaRepresentante = document.getElementById('cedula_representante').value;
          var apellidosRepresentante = document.getElementById('apellidos_representante').value;
          var nombresRepresentante = document.getElementById('nombres_representante').value;
          var telefonoRepresentante = document.getElementById('telefono_representante').value;
          var codigoParentesco = document.getElementById('codigo_parentesco').value;
          var nacionalidadRepresentante = document.getElementById('nacionalidad_representante').value;

          // Obtener los valores de los campos de la madre
          var cedulaMama = document.getElementById('cedula_mama').value;
          var apellidosMama = document.getElementById('apellidos_mama').value;
          var nombresMama = document.getElementById('nombres_mama').value;
          var codigoCivilMama = document.getElementById('codigo_civilmama').value;
          var nacionalidadMama = document.getElementById('nacionalidad_mama').value;
          var fechaMama = document.getElementById('fecha_mama').value;
          var direccionHMama = document.getElementById('direccionh_mama').value;
          var telefonoHMama = document.getElementById('telefonoh_mama').value;
          var direccionTMama = document.getElementById('direcciont_mama').value;
          var telefonoTMama = document.getElementById('telefonot_mama').value;
          var nivelMama = document.getElementById('nivel_mama').value;
          var ocupacionMama = document.getElementById('ocupacion_mama').value;
          var profesionMama = document.getElementById('profesion_mama').value;
          var correoMama = document.getElementById('correo_mama').value;
          var datosMama = document.getElementById('datos_mama').value;
          var telefonoMama = document.getElementById('telefono_mama').value;;

          // Obtener los valores de los campos del padre
          var cedulaPapa = document.getElementById('cedula_papa').value;
          var apellidosPapa = document.getElementById('apellidos_papa').value;
          var nombresPapa = document.getElementById('nombres_papa').value;
          var estadoPapa = document.getElementById('estado_papa').value;
          var nacionalidadPapa = document.getElementById('nacionalidad_papa').value;
          var fechaPapa = document.getElementById('fecha_papa').value;
          var direccionHPapa = document.getElementById('direccionh_papa').value;
          var telefonoHPapa = document.getElementById('telefonoh_papa').value;
          var direccionTPapa = document.getElementById('direcciont_papa').value;
          var telefonoTPapa = document.getElementById('telefonot_papa').value;
          var nivelPapa = document.getElementById('nivel_papa').value;
          var ocupacionPapa = document.getElementById('ocupacion_papa').value;
          var profesionPapa = document.getElementById('profesion_papa').value;
          var correoPapa = document.getElementById('correo_papa').value;
          var datosPapa = document.getElementById('datos_papa').value;
          var telefonoPapa = document.getElementById('telefono_papa').value;;

          // Obtener los valores de los campos de la persona autorizada en caso de emergencia
          var nombreCaso = document.getElementById('nombre_caso').value;
          var parentescoCaso = document.getElementById('parentesco_emergencia').value;
          // Enviar los datos a guardar_inscripcion.php

          // let request = new XMLHttpRequest();
          // request.open("POST", "guardar_inscripcion.php");
          // request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          // request.onload = function (){
          //   console.log(this.responseText);
          //   if(this.responseText.includes("Se ha inscrito exitosamente")){
          //     alert("Se ha inscrito el estudiante");
          //     var xhr = new XMLHttpRequest();
          //     xhr.open('GET', `getCodigoInscripcion.php?cedula=${cedulaEstudiante}`);
          //     xhr.onload = function(){
          //       window.location.href = (`../php/generar_planillainscripcion.php?codigoInscripcion=${this.responseText}`);
          //     }
          //     xhr.send();
          //   }
          // }
          // request.send(`cedulaEstudiante=${cedulaEstudiante}&apellidosEstudiante=${apellidosEstudiante}&nombresEstudiante=${nombresEstudiante}&fechaEstudiante=${fechaEstudiante}&edadEstudiante=${edadEstudiante}&lugarNacimiento=${lugarNacimiento}&estadoEstudiante=${estadoEstudiante}&nacionalidadEstudiante=${nacionalidadEstudiante}&procedenciaEstudiante=${procedenciaEstudiante}&estadoHermano=${estadoHermano}&cantidadHermano=${cantidadHermano}&sexoHermano=${sexoHermano}&lugarHermano=${lugarHermano}&enfermedad=${enfermedad}&hospitalizado=${hospitalizado}&motivoHospitalizacion=${motivoHospitalizacion}&presentaAlergia=${presentaAlergia}&alergias=${alergias}&padeceCondicion${padeceCondicion}&condicion=${condicion}&informe${informe}&limitacion=${limitacion}&especialista=${especialista}&doctor=${doctor}&enfermarFacilidad=${enfermarFacilidad}&cedulaRepresentante=${cedulaRepresentante}&apellidosRepresentante=${apellidosRepresentante}&nombresRepresentante=${nombresRepresentante}&telefonoRepresentante=${telefonoRepresentante}&codigoParentezco=${codigoParentesco}&cedulaMama=${cedulaMama}&apellidosMama=${apellidosMama}&nombresMama=${nombresMama}&codigoCivilMama=${codigoCivilMama}&nacionalidadMama=${nacionalidadMama}&edadMama=${edadMama}&direccionHMama=${direccionHMama}&telefonoHMama=${telefonoHMama}&direccionTMama=${direccionTMama}&telefonoTMama=${telefonoTMama}&nivelMama=${nivelMama}&ocupacionMama=${ocupacionMama}&profesionMama=${profesionMama}&correoMama=${correoMama}&datosMama=${datosMama}&cedulaPapa=${cedulaPapa}&apellidosPapa=${apellidosPapa}&nombresPapa=${nombresPapa}&estadoPapa=${estadoPapa}&nacionalidadPapa=${nacionalidadPapa}&edadPapa=${edadPapa}&direccionHPapa=${direccionHPapa}&telefonoHPapa=${telefonoHPapa}&direccionTPapa=${direccionTPapa}&telefonoTPapa=${telefonoTPapa}&nivelPapa=${nivelPapa}&ocupacionPapa=${ocupacionPapa}&profesionPapa=${profesionPapa}&correoPapa=${correoPapa}&datosPapa=${datosPapa}`);

          $.ajax({
            type: "POST",
            url: "guardar_inscripcion.php",
            data: {
              // Datos del estudiante
              cedulaEstudiante: cedulaEstudiante,
              apellidosEstudiante: apellidosEstudiante,
              nombresEstudiante: nombresEstudiante,
              fechaEstudiante: fechaEstudiante,
              lugarNacimiento: lugarNacimiento,
              estadoEstudiante: estadoEstudiante,
              nacionalidadEstudiante: nacionalidadEstudiante,
              procedenciaEstudiante: procedenciaEstudiante,
              estadoHermano: estadoHermano,
              cantidadHermano: cantidadHermano,
              lugarHermano: lugarHermano,

              // Antecedentes prenatales
              enfermedad: enfermedad,
              hospitalizado: hospitalizado,
              motivoHospitalizacion: motivoHospitalizacion,
              presentaAlergia: presentaAlergia,
              alergias: alergias,
              padeceCondicion: padeceCondicion,
              condicion: condicion,
              informe: informe,
              limitacion: limitacion,
              especialista: especialista,
              doctor: doctor,
              enfermarFacilidad: enfermarFacilidad,

              // Representante legal
              cedulaRepresentante: cedulaRepresentante,
              apellidosRepresentante: apellidosRepresentante,
              nombresRepresentante: nombresRepresentante,
              telefonoRepresentante: telefonoRepresentante,
              codigoParentesco: codigoParentesco,
              nacionalidadRepresentante: nacionalidadRepresentante,

              // Datos de la madre
              cedulaMama: cedulaMama,
              apellidosMama: apellidosMama,
              nombresMama: nombresMama,
              codigoCivilMama: codigoCivilMama,
              nacionalidadMama: nacionalidadMama,
              fechaMama: fechaMama,
              telefonoMama: telefonoMama,
              direccionHMama: direccionHMama,
              telefonoHMama: telefonoHMama,
              direccionTMama: direccionTMama,
              telefonoTMama: telefonoTMama,
              nivelMama: nivelMama,
              ocupacionMama: ocupacionMama,
              profesionMama: profesionMama,
              correoMama: correoMama,
              datosMama: datosMama,

              // Datos del padre
              cedulaPapa: cedulaPapa,
              apellidosPapa: apellidosPapa,
              nombresPapa: nombresPapa,
              estadoPapa: estadoPapa,
              nacionalidadPapa: nacionalidadPapa,
              fechaPapa: fechaPapa,
              telefonoPapa: telefonoPapa,
              direccionHPapa: direccionHPapa,
              telefonoHPapa: telefonoHPapa,
              direccionTPapa: direccionTPapa,
              telefonoTPapa: telefonoTPapa,
              nivelPapa: nivelPapa,
              ocupacionPapa: ocupacionPapa,
              profesionPapa: profesionPapa,
              correoPapa: correoPapa,
              datosPapa: datosPapa,

              // Persona autorizada en caso de emergencia
              nombreCaso: nombreCaso,
              parentescoCaso: parentescoCaso
            },
            success: function (response) {
              // Manejar la respuesta del servidor, si es necesario
              console.log(response);

              // Verificar si la respuesta es positiva
              if (response.includes("Se ha inscrito exitosamente.")) {
                alert("Se ha inscrito el estudiante");
                
                window.location.href = `./inscripcion.php?cedulaEstudiante=${cedulaEstudiante}`;
                
                
              } else {
                // Mostrar mensaje de error
                alert("Error en la inscripción:\n" + response);
              }
            },
            error: function (xhr, status, error) {
              // Manejar errores de la petición AJAX, si es necesario
              console.error(xhr.responseText);
              alert("Error en la solicitud AJAX");
            }
          });
        }</script>
      <script src="validaciones/busqueda.js"></script>
      <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
      <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
      <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
      <script src="../dist/js/waves.js"></script>
      <script src="../dist/js/sidebarmenu.js"></script>
      <script src="../dist/js/custom.min.js"></script>
      <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
      <script src="../dist/js/pages/mask/mask.init.js"></script>
      <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
      <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
      <script src="../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
      <script src="../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
      <script src="../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
      <script src="../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
      <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
      <script src="../assets/libs/quill/dist/quill.min.js"></script>
      <script src="../assets/libs/toastr/build/toastr.min.js"></script>
      <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="../assets/libs/sweetAlerts2/sweetalert2.min.js"></script>



</body>

</html>