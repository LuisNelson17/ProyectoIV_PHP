<?php
include "./includes/bd.php";
// Configuración de la base de datos
// podemos definir las constantes que podremos usar para la conexión a la base de datos
function conectar_DB(){
    //establecemos la conexion con la base de datos
 $conexion = mysqli_connect(BD_HOST, BD_USER,BD_PASS, BD_NAME);
 // Verificamos si hay error
 if (!$conexion) {
     die("Error al conectar a la base de datos: " . mysqli_connect_error());
 }
 return $conexion;
}

function cerrar_DB($conexion){
        mysqli_close($conexion);
}



?>