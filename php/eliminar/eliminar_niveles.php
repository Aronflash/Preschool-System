<?php

include("../conexion.php");
//borre de la tabla inscripción
$codigo_niveles=$_POST['codigo_nivelseccion'];
$sql="DELETE FROM `inscripcion` WHERE codigo_nivelseccion=$codigo_niveles";
$query=mysqli_query($conexion,$sql);

//obteniendo el valor de la sección a eliminar
$sql="SELECT `codigo_nivelseccion`, `codigo_niveles`, `codigo_seccion`, `estado` FROM `nivel_seccion` WHERE `codigo_nivelseccion`='$codigo_niveles'";
$query=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_assoc($query);
$codigo_seccion=$fila['codigo_seccion'];

$sentencia = ("SELECT a.*, b.estado AS nom, c.*, d.* 
FROM niveles a
JOIN nivel_seccion d ON a.codigo_niveles = d.codigo_niveles
JOIN estado b ON d.estado = b.codigo_estado
JOIN secciones c ON c.codigo_seccion = d.codigo_seccion
ORDER BY d.estado ASC, c.nombre ASC, a.descripcion ASC");
$mostrar = mysqli_query($conexion, $sentencia);

//creando vectores
$resultados = array();
$secciones = array(); 
if($codigo_seccion>1)
{
    //guardando las secciones mayores a la que se va a eliminar
    while($fila1 = mysqli_fetch_assoc($mostrar))
    {      
    if($fila1['codigo_seccion']>$codigo_seccion)
    {
        $resultados[] = $fila1['codigo_nivelseccion']; 
        $secciones[] =  $fila1['codigo_seccion'];   
    }          
            
    }  

    $sql1="DELETE FROM `nivel_seccion` WHERE codigo_nivelseccion ='$codigo_niveles'";
    $query1=mysqli_query($conexion,$sql1);

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
else
{
    $sql="DELETE FROM `nivel_seccion` WHERE codigo_nivelseccion ='$codigo_niveles'";
    $query=mysqli_query($conexion,$sql);
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
