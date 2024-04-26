<?php

include("../conexion.php");

$codigo_usuario=$_POST['codigo_usuario'];

$sql="UPDATE usuario SET codigo_estado=2 WHERE codigo_usuario='$codigo_usuario'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/usuarios.php");
    }  
    else {
        $mensaje_error = "Error al eliminar el usuario. Por favor, inténtalo de nuevo.";
        // Puedes personalizar el mensaje de error según tus necesidades
    
        // Redirige con un mensaje de error
        $url_redireccion = "../../admin/usuarios.php?error=" . urlencode($mensaje_error);
        echo "Redirigiendo a: " . $url_redireccion;
        Header("Location: " . $url_redireccion);
    }
?>
