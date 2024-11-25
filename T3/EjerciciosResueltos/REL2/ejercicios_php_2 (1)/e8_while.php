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
    // Definir un array con los nombres de los estudiantes
    $estudiantes = ["Juan", "María", "Pedro", "Isabella", "Fernando", "Sofía", "Ángel", "Gabriela"];
    $estudiantes = Array("Juan", "María", "Pedro", "Isabella", "Fernando", "Sofía", "Ángel", "Gabriela");

    // Inicializar variables
    $indice = 0; // Contador para el índice del array
    $totalEstudiantes = count($estudiantes); // Total de estudiantes
    $contadorLargoNombre = 0; // Contador para nombres con más de 5 letras

    // Usar while para iterar sobre el array
    while ($indice < $totalEstudiantes) {
        // Obtener el nombre del estudiante actual
        $nombreEstudiante = $estudiantes[$indice];

        // Mostrar el nombre del estudiante
        echo "Estudiante: " . $nombreEstudiante . "<br>";

        // Contar nombres con más de 5 letras
        if (strlen($nombreEstudiante) > 5) {
            $contadorLargoNombre++;
        }

        // Incrementar el índice para pasar al siguiente estudiante
        $indice++;
    }

    // Mostrar el total de estudiantes y cuántos tienen más de 5 letras
    echo "<br>Total de estudiantes: " . $totalEstudiantes . "<br>";
    echo "Estudiantes con más de 5 letras en su nombre: " . $contadorLargoNombre;
    ?>

</body>

</html>