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
    // Verificar si se ha pasado el parámetro 'nota' por URL, en caso contrario, generar una nota aleatoria entre 0 y 10 (incluyendo decimales)
    $nota = isset($_GET['nota']) ? (float)$_GET['nota'] : rand(0, 100) / 10;

    // Mostrar la nota generada o recibida
    echo "Nota: " . $nota . "<br>";

    // Determinar la calificación usando el operador ternario
    $calificacion = ($nota < 5) ? "Suspenso" : (($nota >= 5 && $nota < 7) ? "Aprobado" : (($nota >= 7 && $nota < 9) ? "Notable" : "Sobresaliente"));

    // Mostrar la calificación
    echo "Calificación: " . $calificacion . "<br>";

    // Verificar si la nota es un número entero o tiene decimales
    echo (floor($nota) == $nota) ? "La nota es un número redondeado." : "La nota tiene decimales.";
    // otra forma es comprobando el tipo
    //echo(gettype($nota));
    /*switch (gettype($nota)){
        case "integer":
            echo "La nota es un número entero";
            break;
        case "double":
            echo "La nota tiene decimales";
            break;
    };*/
    ?>

</body>

</html>