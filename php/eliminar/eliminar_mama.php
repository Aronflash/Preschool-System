<?php

include("../conexion.php");

$cedula_mama=$_POST['cedula_mama'];

$sql="UPDATE mama SET codigo_estado=2 WHERE cedula_mama='$cedula_mama'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/madres.php");
    }  
    else {
        $mensaje_error = "Error al eliminar a la Madre. Por favor, inténtalo de nuevo.";
        // Puedes personalizar el mensaje de error según tus necesidades
    
        // Redirige con un mensaje de error
        $url_redireccion = "../../admin/madres.php?error=" . urlencode($mensaje_error);
        echo "Redirigiendo a: " . $url_redireccion;
        Header("Location: " . $url_redireccion);
    }
?>
