<?php

include("../conexion.php");

$codigo_niveles=$_POST['codigo_nivelseccion'];
$sql="DELETE FROM `inscripcion` WHERE codigo_nivelseccion=$codigo_niveles";
$query=mysqli_query($conexion,$sql);

$sql="SELECT `codigo_nivelseccion`, `codigo_niveles`, `codigo_seccion`, `estado` FROM `nivel_seccion` WHERE `codigo_nivelseccion`='$codigo_niveles'";
$query=mysqli_query($conexion,$sql);
if(mysqli_num_rows($query)>0)
{
    $fila1 = mysqli_fetch_assoc($query);
    $permiso=$fila1['codigo_seccion'];
    if($permiso>1)
    {
            $sql="DELETE FROM `nivel_seccion` WHERE codigo_nivelseccion ='$codigo_niveles'";
            $query=mysqli_query($conexion,$sql);

            $sql="SELECT `codigo_nivelseccion`, `codigo_niveles`, `codigo_seccion`, `estado` FROM `nivel_seccion` WHERE `codigo_nivelseccion`>'$codigo_niveles'";
            $query=mysqli_query($conexion,$sql);
            $resultados = array();
            $secciones = array(); 

            if(mysqli_num_rows($query)>0)
            {
                while($fila1 = mysqli_fetch_assoc($query))
                {                
                $resultados[] = $fila1['codigo_nivelseccion']; 
                $secciones[] =  $fila1['codigo_seccion'];            
                }  
                foreach($resultados AS $resultado)
                {
                    $consulta = "SELECT * FROM nivel_seccion WHERE codigo_nivelseccion = '$resultado'";
                    $busqueda2=mysqli_query($conexion, $consulta);

                    $fila2 = mysqli_fetch_assoc($busqueda2);
                    if($fila2["codigo_seccion"]>2 )
                    {
                        $seccion=$fila2["codigo_seccion"]-1;            
                        
                            $actualizar = "UPDATE `nivel_seccion` SET codigo_seccion = '$seccion' WHERE codigo_nivelseccion = '$resultado'"; 
                            mysqli_query($conexion, $actualizar);   
                        
                    }                            
                }          
            }    

    }
    else
    {
        $sql="DELETE FROM `nivel_seccion` WHERE codigo_nivelseccion ='$codigo_niveles'";
        $query=mysqli_query($conexion,$sql);
    }    
}
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
