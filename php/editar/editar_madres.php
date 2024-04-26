
<?php

include("../conexion.php");

$cedula_mama = $_POST['cedula_mama'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$codigo_estadocivil = $_POST['codigo_estadocivil'];
$codigo_nacionalidad = $_POST['codigo_nacionalidad'];
$edad = $_POST['edad'];
$direccion_habitacion = $_POST['direccion_habitacion'];
$telefono_habitacion = $_POST['telefono_habitacion'];
$direccion_trabajo = $_POST['direccion_trabajo'];
$telefono_trabajo  = $_POST['telefono_trabajo'];
$codigo_nivelacademico  = $_POST['codigo_nivelacademico'];
$ocupacion = $_POST['ocupacion'];
$profesion = $_POST['profesion'];
$correo = $_POST['correo'];
$datos_extras = $_POST['datos_extras'];
$codigo_estado  = $_POST['codigo_estado'];

$sql="UPDATE mama SET nombres='$nombres',apellidos='$apellidos',
codigo_estadocivil='$codigo_estadocivil',
codigo_nacionalidad='$codigo_nacionalidad',edad='$edad',
direccion_habitacion='$direccion_habitacion',
telefono_habitacion='$telefono_habitacion',direccion_trabajo='$direccion_trabajo',
telefono_trabajo='$telefono_trabajo',codigo_nivelacademico='$codigo_nivelacademico',
ocupacion='$ocupacion',profesion='$profesion',correo='$correo',
datos_extras='$datos_extras',codigo_estado='$codigo_estado' WHERE cedula_mama='$cedula_mama'";
$query=mysqli_query($conexion,$sql);

    if($query){
        Header("Location: ../../admin/madres.php");
    }
exit;