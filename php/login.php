<?php
include 'conexion.php';
if (!empty($_POST['btningresar'])){
     if (!empty($_POST['usuario'] and !empty($_POST['contraseña']))){
          $usuario=$_POST['usuario'];
          $cCon_usu=$_POST['contraseña'];
          $sql=$conexion->query("SELECT * FROM usuario where nombre_usuario='$usuario' and contrasena='$cCon_usu' and codigo_estado=1");
          $datos=mysqli_fetch_assoc($sql);  
          if($datos['codigo_estado']==1){
               $_SESSION['codigo_usuario']=$datos['codigo_usuario'];
               $_SESSION['nombre_usuario']=$datos['nombre_usuario'];
               $_SESSION['tipodeusuario']=$datos['tipodeusuario'];
               header("location: admin/home.php");
          }
     
     else{
          
     }

}
}
