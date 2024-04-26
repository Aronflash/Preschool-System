<?php

include 'conexion.php';

$cedula_representante = $_POST['cedula_representante'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$codigo_parentesco = $_POST['codigo_parentesco'];
$foto_representante = addslashes(file_get_contents($_FILES['foto_representante']['tmp_name']));


$query = "INSERT INTO representante_legal(cedula_representante, nombres, apellidos, telefono, foto_representante, codigo_parentesco)
VALUES ('$cedula_representante', '$nombres', '$apellidos', '$telefono', '$foto_representante', '$codigo_parentesco')";

$verificando_cedula_representante = mysqli_query($conexion, "SELECT * FROM representante_legal where cedula_representante='$cedula_representante'");
if (mysqli_num_rows($verificando_cedula_representante) > 0) {

    echo '
   <script>
        alert("Esta cedula ya esta registrado, intenta con uno nuevo");           
        window.location = "../admin/acciones/agregar_representante.php";
        </script>

';
    exit();
}


$queri = mysqli_query($conexion, $query);
if ($queri) {

    echo '
          <script>
          alert ("REPRESENTANTE REGISTRADO");
          window.location="../admin/representante.php";
          </script>
      
      ';
} else {
    echo '
           <script>
           alert ("REPRESENTANTE NO REGISTRADO");
           window.location="../admin/acciones/agregar_representante.php";
           </script>
      
      
      ';
}
mysqli_close($conexion);
