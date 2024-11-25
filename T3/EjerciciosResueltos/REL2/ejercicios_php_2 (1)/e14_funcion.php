<?php
    /**
    * Ejercicio realizado por P.Lluyot. 2DAW
    */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Definir la función que devuelve un número aleatorio entre 1 y 100
    function obtenerNumeroAleatorio()
    {
        $numeroAleatorio =  rand(1, 100); // Genera y devuelve un número aleatorio entre 1 y 100
        
        // Evaluar si el número es par o impar
        if ($numeroAleatorio % 2 == 0) {
            $mensaje= "El número $numeroAleatorio es par.<br>";
        } else {
            $mensaje= "El número $numeroAleatorio es impar.<br>";
        }
        $mensaje.= "<br>"; // Añadir un salto de línea para mejor legibilidad

        return $mensaje;
    }
    
    echo obtenerNumeroAleatorio();
    echo obtenerNumeroAleatorio();
    echo obtenerNumeroAleatorio();

    ?>

</body>

</html>