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
    // Definir un array con las edades de los estudiantes
    $edades = [15, 22, 17, 19, 24, 16, 30, 21];

    // Inicializar variables
    $indice = 0; // Contador para el índice del array
    $sumaEdades = 0; // Variable para almacenar la suma total de las edades
    $contadorMayores = 0; // Contador para estudiantes mayores de edad
    $totalEstudiantes = count($edades); // Total de estudiantes

    // Usar do...while para iterar sobre el array
    do {
        
        // Obtener la edad del estudiante actual
        $edadEstudiante = $edades[$indice];
        echo "Estudiante ".$indice+1 . " - edad: " . $edadEstudiante . "<br>";
        // Sumar la edad al total
        $sumaEdades += $edadEstudiante;

        // Contar si el estudiante es mayor de edad
        if ($edadEstudiante >= 18) {
            $contadorMayores++;
        }

        // Incrementar el índice para pasar al siguiente estudiante
        $indice++;
    } while ($indice < $totalEstudiantes);

    // Calcular la edad media
    $edadMedia = $totalEstudiantes > 0 ? $sumaEdades / $totalEstudiantes : 0;

    // Mostrar la edad media y cuántos son mayores de edad
    echo "Edad media de los estudiantes: " . number_format($edadMedia, 2) . "<br>";
    echo "Número de estudiantes mayores de edad: " . $contadorMayores;
    ?>

</body>

</html>