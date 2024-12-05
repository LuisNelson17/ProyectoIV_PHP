<?php
//función que devuelve la conexión con la base de datos
function conectar_bd()
{
   $host = "localhost";
   $usuario = "usuario_tienda";
   $password = "1234";
   $bd = 'tienda';


   //establecemos la conexion con la base de datos
   $conexion = mysqli_connect($host, $usuario, $password, $bd);
   // Verificamos si hay error
   if (!$conexion) {
       die("Error al conectar a la base de datos: " . mysqli_connect_error());
   }
   return $conexion;
}


//función que cierra la base de datos
function cerrar_bd($conexion){
   mysqli_close($conexion);
}
?>