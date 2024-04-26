<?php

include("../conexion.php");

$cedula_representante=$_POST['cedula_representante'];

$sql="UPDATE representante_legal SET codigo_estado=2 WHERE cedula_representante='$cedula_representante'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/representante.php");
    }  
    else {
        $mensaje_error = "Error al eliminar el representante legal. Por favor, inténtalo de nuevo.";
        // Puedes personalizar el mensaje de error según tus necesidades
    
        // Redirige con un mensaje de error
        $url_redireccion = "../../admin/representante.php?error=" . urlencode($mensaje_error);
        echo "Redirigiendo a: " . $url_redireccion;
        Header("Location: " . $url_redireccion);
    }
?>
