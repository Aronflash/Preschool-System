<?php

include("../conexion.php");

$cedula_papa=$_POST['cedula_papa'];

$sql="UPDATE papa SET codigo_estado=2 WHERE cedula_papa='$cedula_papa'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/padres.php");
    }  
    else {
        $mensaje_error = "Error al eliminar al Padre. Por favor, inténtalo de nuevo.";
        // Puedes personalizar el mensaje de error según tus necesidades
    
        // Redirige con un mensaje de error
        $url_redireccion = "../../admin/padres.php?error=" . urlencode($mensaje_error);
        echo "Redirigiendo a: " . $url_redireccion;
        Header("Location: " . $url_redireccion);
    }
?>
