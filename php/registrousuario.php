<?php

include 'conexion.php';

$codigo_usuario = $_POST['codigo_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];
$tipodeusuario = $_POST['tipodeusuario'];

$query = "INSERT INTO usuario(codigo_usuario, nombre_usuario, contrasena, tipodeusuario)
VALUES ('$codigo_usuario', '$nombre_usuario', '$contrasena', '$tipodeusuario')";

$verificando_codigo_usuario = mysqli_query($conexion, "SELECT * FROM usuario where codigo_usuario='$codigo_usuario'");
if (mysqli_num_rows($verificando_codigo_usuario) > 0) {

    echo '
   <script>
        alert("Esta codigo ya esta registrado, intenta con uno nuevo");           
        window.location = "../admin/acciones/agregar_usuario.php";
        </script>

';
    exit();
}


$queri = mysqli_query($conexion, $query);
if ($queri) {

    echo '
          <script>
          alert ("USUARIO REGISTRADO");
          window.location="../admin/usuarios.php";
          </script>
      
      ';
} else {
    echo '
           <script>
           alert ("USUARIO NO REGISTRADO");
           window.location="../admin/acciones/agregar_usuario.php";
           </script>
      
      
      ';
}
mysqli_close($conexion);
