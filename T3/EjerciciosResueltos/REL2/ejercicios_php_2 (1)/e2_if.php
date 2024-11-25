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
    // Verificar si se ha pasado el parámetro 'dia' por URL, en caso contrario, generar un valor aleatorio entre 1 y 7
    if (isset($_GET['dia'])) {
        $dia = (int)$_GET['dia'];  // Si está definido, tomar el valor de la URL
    } else {
        $dia = rand(1, 7);  // Generar un número aleatorio entre 1 y 7 si no se pasa por URL
    }

    // Mostrar el día generado o recibido
    echo "Día de la semana: " . $dia . "<br>";

    // Determinar si es un día laborable o fin de semana
    if ($dia >= 1 && $dia <= 5) {
        echo "Es un día laborable.";
    } elseif ($dia == 6 || $dia == 7) {
        echo "Es fin de semana.";
    } else {
        echo "El valor del día no es válido.";  // Control adicional para valores fuera de 1-7
    }
    ?>

</body>

</html>