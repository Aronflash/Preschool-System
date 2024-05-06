<?php

include 'conexion.php';

$codigo_niveles = $_POST['codigo_niveles'];
$codigo_seccion = $_POST['codigo_seccion'];

// Validar si ya existe una entrada con los mismos valores
$consultaExistencia = "SELECT * FROM nivel_seccion WHERE codigo_niveles = '$codigo_niveles' AND codigo_seccion = '$codigo_seccion'";
$resultadoExistencia = mysqli_query($conexion, $consultaExistencia);

if (mysqli_num_rows($resultadoExistencia) > 0) {
    // Ya existe una entrada con los mismos valores
    echo '
        <script>
            alert("Ya existe un registro con este Nivel y Sección");
            window.location="../admin/acciones/agregar_nise.php";
        </script>
    ';
} 
else 
{    
        $consultaExistencias = "SELECT * FROM nivel_seccion WHERE codigo_seccion = '$codigo_seccion' AND codigo_seccion !=1";
        $resultadoExistencias = mysqli_query($conexion, $consultaExistencias);
        $resultados = array();
        $secciones = array();  
        if(mysqli_num_rows($resultadoExistencias)>0)
        {
            
            $fila = mysqli_fetch_assoc($resultadoExistencias);              
            $busqueda = "SELECT * FROM `nivel_seccion` WHERE codigo_seccion >= '$codigo_seccion'";
            $busqueda1=mysqli_query($conexion, $busqueda);
            while($fila1 = mysqli_fetch_assoc($busqueda1))
            {                
                $resultados[] = $fila1['codigo_nivelseccion']; 
                $secciones[] =  $fila1['codigo_seccion'];            
            }            
            
            foreach($resultados AS $resultado)
            {
                $consulta = "SELECT * FROM nivel_seccion WHERE codigo_nivelseccion = '$resultado'";
                $busqueda2=mysqli_query($conexion, $consulta);

                $fila2 = mysqli_fetch_assoc($busqueda2);
                $seccion=$fila2["codigo_seccion"]+1;                

                $actualizar = "UPDATE `nivel_seccion` SET codigo_seccion = '$seccion' WHERE codigo_nivelseccion = '$resultado'"; 
                mysqli_query($conexion, $actualizar);               
            }
            $query = "INSERT INTO nivel_seccion(codigo_niveles, codigo_seccion) VALUES ('$codigo_niveles', '$codigo_seccion')";
            $queri = mysqli_query($conexion, $query);
            if ($queri) {
            echo '
            <script>
                alert("NIVEL/SECCIÓN REGISTRADO");
                window.location="../admin/niveles.php";
            </script>
            ';
                } else {
                echo '
                    <script>
                        alert("NIVEL/SECCIÓN NO REGISTRADO");
                        window.location="../admin/acciones/agregar_nise.php";
                    </script>
                ';
            }
        }
        else
        {
           
            $query = "INSERT INTO nivel_seccion(codigo_niveles, codigo_seccion) VALUES ('$codigo_niveles', '$codigo_seccion')";
            $queri = mysqli_query($conexion, $query);

            if ($queri) {
            echo '
            <script>
                alert("NIVEL/SECCIÓN REGISTRADO");
                window.location="../admin/niveles.php";
            </script>
            ';
                } else {
                echo '
                    <script>
                        alert("NIVEL/SECCIÓN NO REGISTRADO");
                        window.location="../admin/acciones/agregar_nise.php";
                    </script>
                ';
            }
        }

    
}

mysqli_close($conexion);
?>
