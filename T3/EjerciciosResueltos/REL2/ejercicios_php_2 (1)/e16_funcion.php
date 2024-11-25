<?php
/**
* Ejercicio realizado por P.Lluyot. 2DAW
*/
require_once("misfunciones.php");

// 1. Definición de la función para calcular la media
function calcularMedia($notas)
{
    $totalNotas = 0;      // Variable para acumular la suma de las notas
    $cantidadNotas = 0;   // Contador de notas válidas

    /*foreach ($notas as $nota) {
        // Verificamos que la nota esté en el rango válido
        if ($nota >= 0 && $nota <= 10) {
            $totalNotas += $nota; // Sumar la nota al total
            $cantidadNotas++; // Contar la nota válida
        }
    }*/
    //supuestamente se han validado ya las notas entre 0 y 10 por lo que podríamos hacer
    $totalNotas = array_sum($notas);
    $cantidadNotas = count($notas);

    // Evitar la división por cero
    /*if ($cantidadNotas === 0) {
        return 0; // Si no hay notas válidas, retornamos 0
    }*/

    return $totalNotas / $cantidadNotas; // Retornar la media
}

$mensajes = "";
$error = false; // Variable para detectar error


// 2. Obtener las notas desde la URL y convertirlas a un array
if (isset($_GET['notas']) && !empty($_GET['notas'])) {
    $notas = explode(',', $_GET['notas']); // Convertimos la cadena a un array

    // Inicializar variables para la clasificación
    $cantidadAprobadas = 0;
    $cantidadSuspendidas = 0;

    // 3. Validar las notas y clasificar
    foreach ($notas as $nota) {
        $nota = floatval($nota); // Convertir a número decimal

        // Verificamos si la nota está dentro del rango válido
        if ($nota < 0 || $nota > 10) {
            $mensajes .= "Las notas deben estar entre 0 y 10. Nota inválida: $nota<br>";
            $error = true; // Marcamos que hay un error
            break ; // Salimos si encontramos una nota inválida
        }

        // Clasificar la nota
        if ($nota >= 5) {
            $cantidadAprobadas++; // Incrementar contador de aprobadas
        } else {
            $cantidadSuspendidas++; // Incrementar contador de suspendidas
        }
    }
    if (!$error){
        // 4. Calcular la media usando la función definida
        $media = calcularMedia($notas);
        // 5. Mostrar resultados
        $mensajes .= "Media de las notas: " . number_format($media, 2) . "<br>"; // Mostrar la media

        // Clasificación de resultados
        if ($media >= 5) {
            $mensajes .= "El grupo ha aprobado.<br>";
        } else {
            $mensajes .= "El grupo ha suspendido.<br>";
        }
        // Mostrar cantidad de aprobadas y suspendidas
        $mensajes .= "Notas aprobadas: $cantidadAprobadas<br>";
        $mensajes .= "Notas suspendidas: $cantidadSuspendidas<br>";
    }
} else {
    $mensajes = "No se han proporcionado notas.";
    //exit; // Salimos si no se han pasado notas
}
$textoarray = print_array($notas);

?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>P.Lluyot</title>
    <link rel='stylesheet' href='https://cdn.simplecss.org/simple.min.css'>
</head>

<body>

    <head>
        <h3></h3>
    </head>
    <main>
        <!-- código php -->
        <?php
            echo "<p class='notice'>$mensajes</p>";
            echo $textoarray;
        ?>
    </main>
    <footer>P.Lluyot</footer>
</body>

</html>