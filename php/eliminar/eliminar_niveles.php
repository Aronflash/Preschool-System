<?php

include("../conexion.php");

$codigo_niveles=$_POST['codigo_nivelseccion'];

$sql="UPDATE nivel_seccion SET estado=2 WHERE codigo_nivelseccion='$codigo_niveles'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/niveles.php");
    }  
    else {
        $mensaje_error = "Error al eliminar el niveles. Por favor, inténtalo de nuevo.";
        // Puedes personalizar el mensaje de error según tus necesidades
    
        // Redirige con un mensaje de error
        $url_redireccion = "../../admin/niveles.php?error=" . urlencode($mensaje_error);
        echo "Redirigiendo a: " . $url_redireccion;
        Header("Location: " . $url_redireccion);
    }
?>
