<?php

include 'conexion.php';

$cedula_mama = $_POST['cedula_mama'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$codigo_estadocivil = $_POST['codigo_estadocivil'];
$codigo_nacionalidad = $_POST['codigo_nacionalidad'];
$edad = $_POST['edad'];
$direccion_habitacion = $_POST['direccion_habitacion'];
$telefono_habitacion = $_POST['telefono_habitacion'];
$direccion_trabajo = $_POST['direccion_trabajo'];
$telefono_trabajo  = $_POST['telefono_trabajo'];
$codigo_nivelacademico  = $_POST['codigo_nivelacademico'];
$ocupacion = $_POST['ocupacion'];
$profesion = $_POST['profesion'];
$correo = $_POST['correo'];
$datos_extras = $_POST['datos_extras'];
$foto_mama = addslashes(file_get_contents($_FILES['foto_mama']['tmp_name']));

$query = "INSERT INTO mama(cedula_mama, nombres, apellidos, codigo_estadocivil,
codigo_nacionalidad, edad, direccion_habitacion, telefono_habitacion, 
direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion,
profesion, correo, datos_extras, foto_mama) 
VALUES ('$cedula_mama','$nombres','$apellidos','$codigo_estadocivil','$codigo_nacionalidad',
'$edad','$direccion_habitacion','$telefono_habitacion','$direccion_trabajo','$telefono_trabajo',
'$codigo_nivelacademico','$ocupacion','$profesion','$correo','$datos_extras','$foto_mama')";
;

$verificando_cedula_mama = mysqli_query($conexion, "SELECT * FROM mama where cedula_mama='$cedula_mama'");
if (mysqli_num_rows($verificando_cedula_mama) > 0) {

    echo '
   <script>
        alert("Esta cedula ya esta registrado, intenta con uno nuevo");           
        window.location = "../admin/acciones/agregar_madres.php";
        </script>

';
    exit();
}


$queri = mysqli_query($conexion, $query);
if ($queri) {

    echo '
          <script>
          alert ("MADRE REGISTRADO");
          window.location="../admin/madres.php";
          </script>
      
      ';
} else {
    echo '
           <script>
           alert ("MADRE NO REGISTRADO");
           </script>
      
      
      ';
}
mysqli_close($conexion);
