<?php

include 'conexion.php';

$cedula_papa = $_POST['cedula_papa'];
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
$foto_papa = addslashes(file_get_contents($_FILES['foto_papa']['tmp_name']));


$query = "INSERT INTO papa(cedula_papa, nombres, apellidos, codigo_estadocivil,
codigo_nacionalidad, edad, direccion_habitacion, telefono_habitacion, 
direccion_trabajo, telefono_trabajo, codigo_nivelacademico, ocupacion,
profesion, correo, datos_extras, foto_papa) 
VALUES ('$cedula_papa','$nombres','$apellidos','$codigo_estadocivil','$codigo_nacionalidad',
'$edad','$direccion_habitacion','$telefono_habitacion','$direccion_trabajo','$telefono_trabajo',
'$codigo_nivelacademico','$ocupacion','$profesion','$correo','$datos_extras','$foto_papa')";

$verificando_cedula_papa = mysqli_query($conexion, "SELECT * FROM papa where cedula_papa='$cedula_papa'");
if (mysqli_num_rows($verificando_cedula_papa) > 0) {

    echo '
   <script>
        alert("Esta cedula ya esta registrado, intenta con uno nuevo");           
        window.location = "../admin/acciones/agregar_papa.php";
        </script>

';
    exit();
}


$queri = mysqli_query($conexion, $query);
if ($queri) {

    echo '
          <script>
          alert ("PADRE REGISTRADO");
          window.location="../admin/padres.php";
          </script>
      
      ';
} else {
    echo '
           <script>
           alert ("PADRE NO REGISTRADO");
           window.location="../admin/acciones/agregar_padres.php";
           </script>
      
      
      ';
}
mysqli_close($conexion);
