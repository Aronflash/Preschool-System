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
    else{
        $cedulaEstudiante = htmlspecialchars($_GET['cedulaEstudiante']);
        include 'conexion.php';
        $sql = "SELECT * FROM estudiantes WHERE cedula_escolar = '$cedulaEstudiante';";
        $result = $conexion->query($sql);
        $status = $result->fetch_assoc();

        echo $status['estado_estudiante'];
    }
    
?>